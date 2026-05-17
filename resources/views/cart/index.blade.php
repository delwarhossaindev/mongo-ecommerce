@extends('layouts.app')

@section('title', 'কার্ট - ShopBD')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4"><i class="bi bi-cart3 me-2"></i>আমার কার্ট</h4>

    @if($cart && count($cart->items ?? []) > 0)
        <div class="row g-4">
            {{-- Cart Items --}}
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>পণ্য</th>
                                        <th class="text-center">দাম</th>
                                        <th class="text-center">পরিমাণ</th>
                                        <th class="text-center">মোট</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cart->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                @php $imgs = is_array($item['images'] ?? null) ? $item['images'] : []; @endphp
                                                @if(count($imgs))
                                                    <img src="{{ $imgs[0] }}" style="width:60px;height:60px;object-fit:cover;" class="rounded">
                                                @else
                                                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                                        <i class="bi bi-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <p class="mb-0 fw-semibold">{{ $item['name'] }}</p>
                                                    <small class="text-muted">SKU: {{ $item['sku'] ?? '-' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center">৳{{ number_format($item['price'], 0) }}</td>
                                        <td class="text-center" style="min-width:130px;">
                                            <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="d-flex align-items-center justify-content-center gap-1">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item['quantity'] }}"
                                                    min="1" class="form-control form-control-sm text-center" style="width:60px;">
                                                <button type="submit" class="btn btn-outline-secondary btn-sm" title="আপডেট">
                                                    <i class="bi bi-arrow-clockwise"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center fw-bold">৳{{ number_format($item['price'] * $item['quantity'], 0) }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" title="সরান">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>কেনাকাটা চালিয়ে যান
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger"
                            onclick="return confirm('কার্ট খালি করবেন?')">
                            <i class="bi bi-trash me-1"></i>কার্ট খালি করুন
                        </button>
                    </form>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">অর্ডার সারসংক্ষেপ</h6>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">সাবটোটাল</span>
                            <span>৳{{ number_format($cart->subtotal, 0) }}</span>
                        </div>
                        @if($cart->discount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>ছাড়</span>
                                <span>- ৳{{ number_format($cart->discount, 0) }}</span>
                            </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>মোট</span>
                            <span class="text-danger">৳{{ number_format($cart->total, 0) }}</span>
                        </div>
                        <div class="d-grid mt-3">
                            <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg">
                                <i class="bi bi-credit-card me-2"></i>চেকআউট করুন
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5">
            <i class="bi bi-cart-x fs-1 text-muted"></i>
            <h5 class="mt-3 text-muted">আপনার কার্ট খালি</h5>
            <a href="{{ route('shop.index') }}" class="btn btn-primary mt-3">
                <i class="bi bi-shop me-1"></i>কেনাকাটা শুরু করুন
            </a>
        </div>
    @endif
</div>
@endsection
