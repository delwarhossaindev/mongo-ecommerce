@extends('layouts.app')

@section('title', 'আমার অর্ডার - ShopBD')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4"><i class="bi bi-bag me-2"></i>আমার অর্ডার</h4>

    @if($orders->count())
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>অর্ডার নম্বর</th>
                                <th>তারিখ</th>
                                <th>পণ্য</th>
                                <th class="text-center">মোট</th>
                                <th class="text-center">স্ট্যাটাস</th>
                                <th class="text-center">পেমেন্ট</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td><span class="fw-semibold">{{ $order->order_number }}</span></td>
                                <td><small class="text-muted">{{ $order->created_at->format('d M Y') }}</small></td>
                                <td><small>{{ count($order->items ?? []) }} টি পণ্য</small></td>
                                <td class="text-center fw-bold">৳{{ number_format($order->total, 0) }}</td>
                                <td class="text-center">
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'processing' => 'info',
                                            'shipped' => 'primary',
                                            'delivered' => 'success',
                                            'cancelled' => 'danger',
                                            'refunded' => 'secondary',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'অপেক্ষমাণ',
                                            'processing' => 'প্রক্রিয়াধীন',
                                            'shipped' => 'পাঠানো হয়েছে',
                                            'delivered' => 'ডেলিভারি হয়েছে',
                                            'cancelled' => 'বাতিল',
                                            'refunded' => 'ফেরত',
                                        ];
                                        $color = $statusColors[$order->status] ?? 'secondary';
                                        $label = $statusLabels[$order->status] ?? $order->status;
                                    @endphp
                                    <span class="badge bg-{{ $color }} status-badge">{{ $label }}</span>
                                </td>
                                <td class="text-center">
                                    @php
                                        $payColors = ['pending' => 'warning', 'paid' => 'success', 'failed' => 'danger', 'refunded' => 'secondary'];
                                        $payLabels = ['pending' => 'বাকি', 'paid' => 'পেইড', 'failed' => 'ব্যর্থ', 'refunded' => 'ফেরত'];
                                        $pc = $payColors[$order->payment_status] ?? 'secondary';
                                        $pl = $payLabels[$order->payment_status] ?? $order->payment_status;
                                    @endphp
                                    <span class="badge bg-{{ $pc }} status-badge">{{ $pl }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-primary btn-sm">বিস্তারিত</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-3">{{ $orders->links() }}</div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-bag-x fs-1 text-muted"></i>
            <h5 class="mt-3 text-muted">কোনো অর্ডার নেই</h5>
            <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-shop me-1"></i>কেনাকাটা করুন
            </a>
        </div>
    @endif
</div>
@endsection
