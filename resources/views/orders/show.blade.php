@extends('layouts.app')

@section('title', 'অর্ডার ' . $order->order_number . ' - ShopBD')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="bi bi-receipt me-2"></i>অর্ডার বিস্তারিত</h4>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>ফিরে যান
        </a>
    </div>

    <div class="row g-4">
        {{-- Order Info --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <h6 class="text-muted small">অর্ডার নম্বর</h6>
                            <p class="fw-bold">{{ $order->order_number }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted small">অর্ডারের তারিখ</h6>
                            <p>{{ $order->created_at->format('d M Y, h:i A') }}</p>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted small">অর্ডার স্ট্যাটাস</h6>
                            @php
                                $statusLabels = ['pending'=>'অপেক্ষমাণ','processing'=>'প্রক্রিয়াধীন','shipped'=>'পাঠানো হয়েছে','delivered'=>'ডেলিভারি হয়েছে','cancelled'=>'বাতিল','refunded'=>'ফেরত'];
                                $statusColors = ['pending'=>'warning','processing'=>'info','shipped'=>'primary','delivered'=>'success','cancelled'=>'danger','refunded'=>'secondary'];
                            @endphp
                            <span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }} status-badge">
                                {{ $statusLabels[$order->status] ?? $order->status }}
                            </span>
                        </div>
                        <div class="col-sm-6">
                            <h6 class="text-muted small">পেমেন্ট স্ট্যাটাস</h6>
                            @php
                                $payColors = ['pending'=>'warning','paid'=>'success','failed'=>'danger','refunded'=>'secondary'];
                                $payLabels = ['pending'=>'বাকি','paid'=>'পেইড','failed'=>'ব্যর্থ','refunded'=>'ফেরত'];
                            @endphp
                            <span class="badge bg-{{ $payColors[$order->payment_status] ?? 'secondary' }} status-badge">
                                {{ $payLabels[$order->payment_status] ?? $order->payment_status }}
                            </span>
                        </div>
                    </div>

                    <h6 class="fw-bold border-bottom pb-2 mb-3">পণ্য তালিকা</h6>
                    @foreach($order->items as $item)
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <div>
                                <p class="mb-0 fw-semibold">{{ $item['name'] }}</p>
                                <small class="text-muted">পরিমাণ: {{ $item['quantity'] }} × ৳{{ number_format($item['price'], 0) }}</small>
                            </div>
                            <span class="fw-bold">৳{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                        </div>
                    @endforeach

                    <div class="mt-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">সাবটোটাল</span>
                            <span>৳{{ number_format($order->subtotal, 0) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">শিপিং চার্জ</span>
                            <span>৳{{ number_format($order->shipping_cost, 0) }}</span>
                        </div>
                        @if($order->discount > 0)
                            <div class="d-flex justify-content-between mb-1 text-success">
                                <span>ছাড়</span>
                                <span>- ৳{{ number_format($order->discount, 0) }}</span>
                            </div>
                        @endif
                        @if($order->tax > 0)
                            <div class="d-flex justify-content-between mb-1">
                                <span>ট্যাক্স</span>
                                <span>৳{{ number_format($order->tax, 0) }}</span>
                            </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>মোট</span>
                            <span class="text-danger">৳{{ number_format($order->total, 0) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Cancel --}}
            @if($order->status === 'pending')
                <form action="{{ route('orders.cancel', $order->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger"
                        onclick="return confirm('অর্ডারটি বাতিল করবেন?')">
                        <i class="bi bi-x-circle me-1"></i>অর্ডার বাতিল করুন
                    </button>
                </form>
            @endif
        </div>

        {{-- Shipping Address --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt me-1"></i>শিপিং ঠিকানা</h6>
                    @php $addr = $order->shipping_address ?? []; @endphp
                    <p class="mb-1 fw-semibold">{{ $addr['name'] ?? '-' }}</p>
                    <p class="mb-1 small text-muted">{{ $addr['phone'] ?? '' }}</p>
                    <p class="mb-1 small">{{ $addr['address'] ?? '' }}</p>
                    <p class="mb-0 small">{{ $addr['city'] ?? '' }}, {{ $addr['state'] ?? '' }}, {{ $addr['country'] ?? '' }}</p>
                </div>
            </div>

            @if($order->notes)
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2"><i class="bi bi-chat-text me-1"></i>নোট</h6>
                        <p class="text-muted small mb-0">{{ $order->notes }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
