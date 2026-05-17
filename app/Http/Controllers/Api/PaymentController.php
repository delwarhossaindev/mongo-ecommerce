<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    private string $storeId;
    private string $storePassword;
    private bool   $isLive;
    private string $baseUrl;

    public function __construct()
    {
        $this->storeId       = config('sslcommerz.store_id');
        $this->storePassword = config('sslcommerz.store_password');
        $this->isLive        = config('sslcommerz.is_live', false);
        $this->baseUrl       = $this->isLive
            ? 'https://securepay.sslcommerz.com'
            : 'https://sandbox.sslcommerz.com';
    }

    public function initiate(Request $request, string $orderId): JsonResponse
    {
        $order = Order::where('user_id', $request->user()->id)->findOrFail($orderId);

        if ($order->payment_status === 'paid') {
            return response()->json(['message' => 'Order already paid'], 422);
        }

        $shippingAddress = $order->shipping_address;
        $user            = $request->user();

        $postData = [
            'store_id'             => $this->storeId,
            'store_passwd'         => $this->storePassword,
            'total_amount'         => $order->total,
            'currency'             => 'BDT',
            'tran_id'              => 'TXN-' . $order->id . '-' . time(),
            'success_url'          => route('payment.success'),
            'fail_url'             => route('payment.fail'),
            'cancel_url'           => route('payment.cancel'),
            'ipn_url'              => route('payment.ipn'),
            'cus_name'             => $shippingAddress['name'] ?? $user->name,
            'cus_email'            => $user->email,
            'cus_phone'            => $shippingAddress['phone'] ?? $user->phone,
            'cus_add1'             => $shippingAddress['address'],
            'cus_city'             => $shippingAddress['city'],
            'cus_country'          => $shippingAddress['country'],
            'ship_name'            => $shippingAddress['name'],
            'ship_add1'            => $shippingAddress['address'],
            'ship_city'            => $shippingAddress['city'],
            'ship_country'         => $shippingAddress['country'],
            'shipping_method'      => 'Courier',
            'product_name'         => 'Order #' . $order->order_number,
            'product_category'     => 'ecommerce',
            'product_profile'      => 'general',
            'value_a'              => (string) $order->id,
            'value_b'              => (string) $user->id,
            'emi_option'           => 0,
            'num_of_item'          => count($order->items),
        ];

        $response = Http::asForm()->post(
            $this->baseUrl . '/gwprocess/apitest.php',
            $postData
        );

        $data = $response->json();

        if (!isset($data['status']) || $data['status'] !== 'SUCCESS') {
            Log::error('SSLCommerz initiation failed', $data);
            return response()->json(['message' => 'Payment initiation failed'], 500);
        }

        Payment::create([
            'order_id'         => (string) $order->id,
            'user_id'          => (string) $user->id,
            'transaction_id'   => $postData['tran_id'],
            'amount'           => $order->total,
            'currency'         => 'BDT',
            'method'           => 'sslcommerz',
            'status'           => 'pending',
            'gateway_response' => $data,
        ]);

        return response()->json([
            'payment_url'    => $data['GatewayPageURL'],
            'session_key'    => $data['sessionkey'],
            'transaction_id' => $postData['tran_id'],
        ]);
    }

    public function success(Request $request)
    {
        $validationUrl = $this->baseUrl . '/validator/api/validationserverAPI.php'
            . '?val_id=' . $request->val_id
            . '&store_id=' . $this->storeId
            . '&store_passwd=' . $this->storePassword
            . '&format=json';

        $response = Http::get($validationUrl);
        $data     = $response->json();

        if (!in_array($data['status'] ?? '', ['VALID', 'VALIDATED'])) {
            return redirect()->away(config('app.frontend_url') . '/payment/fail');
        }

        $orderId = $data['value_a'];
        $order   = Order::find($orderId);

        if ($order) {
            $order->update([
                'payment_status' => 'paid',
                'status'         => Order::STATUS_PROCESSING,
            ]);

            Payment::where('transaction_id', $request->tran_id)->update([
                'val_id'           => $data['val_id'],
                'status'           => 'paid',
                'gateway_response' => $data,
                'paid_at'          => now(),
            ]);
        }

        return redirect()->away(config('app.frontend_url') . '/payment/success?order_id=' . $orderId);
    }

    public function fail(Request $request)
    {
        Payment::where('transaction_id', $request->tran_id)->update([
            'status'           => 'failed',
            'gateway_response' => $request->all(),
        ]);

        $orderId = $request->value_a;
        return redirect()->away(config('app.frontend_url') . '/payment/fail?order_id=' . $orderId);
    }

    public function cancel(Request $request)
    {
        $orderId = $request->value_a;
        return redirect()->away(config('app.frontend_url') . '/payment/cancel?order_id=' . $orderId);
    }

    public function ipn(Request $request): JsonResponse
    {
        if (!in_array($request->status, ['VALID', 'VALIDATED'])) {
            return response()->json(['message' => 'Invalid payment']);
        }

        $orderId = $request->value_a;
        $order   = Order::find($orderId);

        if ($order && $order->payment_status !== 'paid') {
            $order->update([
                'payment_status' => 'paid',
                'status'         => Order::STATUS_PROCESSING,
            ]);

            Payment::where('transaction_id', $request->tran_id)->update([
                'val_id'           => $request->val_id,
                'status'           => 'paid',
                'gateway_response' => $request->all(),
                'paid_at'          => now(),
            ]);
        }

        return response()->json(['message' => 'IPN processed']);
    }
}
