@extends('layouts.app')

@section('title', 'চেকআউট - ShopBD')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold mb-4"><i class="bi bi-credit-card me-2"></i>চেকআউট</h4>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            {{-- Shipping Address --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="bi bi-geo-alt me-1"></i>শিপিং ঠিকানা</h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small">নাম *</label>
                                <input type="text" name="shipping_name" class="form-control @error('shipping_name') is-invalid @enderror"
                                    value="{{ old('shipping_name', Auth::user()->name) }}" required>
                                @error('shipping_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">ফোন *</label>
                                <input type="text" name="shipping_phone" class="form-control @error('shipping_phone') is-invalid @enderror"
                                    value="{{ old('shipping_phone', Auth::user()->phone ?? '') }}" required>
                                @error('shipping_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label small">ইমেইল</label>
                                <input type="email" name="shipping_email" class="form-control"
                                    value="{{ old('shipping_email', Auth::user()->email) }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label small">ঠিকানা *</label>
                                <input type="text" name="shipping_address" class="form-control @error('shipping_address') is-invalid @enderror"
                                    value="{{ old('shipping_address') }}" placeholder="বাড়ি/ফ্ল্যাট নম্বর, রাস্তা" required>
                                @error('shipping_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">শহর *</label>
                                <input type="text" name="shipping_city" class="form-control @error('shipping_city') is-invalid @enderror"
                                    value="{{ old('shipping_city') }}" required>
                                @error('shipping_city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">জেলা *</label>
                                <input type="text" name="shipping_state" class="form-control @error('shipping_state') is-invalid @enderror"
                                    value="{{ old('shipping_state') }}" required>
                                @error('shipping_state')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">পোস্ট কোড</label>
                                <input type="text" name="shipping_zip" class="form-control" value="{{ old('shipping_zip') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small">দেশ</label>
                                <input type="text" name="shipping_country" class="form-control" value="Bangladesh" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="bi bi-chat-text me-1"></i>অতিরিক্ত নোট</h6>
                        <textarea name="notes" class="form-control" rows="3"
                            placeholder="অর্ডার সম্পর্কে কোনো নির্দেশনা থাকলে লিখুন...">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">অর্ডার সারসংক্ষেপ</h6>
                        @foreach($cart->items as $item)
                            <div class="d-flex justify-content-between mb-2 small">
                                <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                <span>৳{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                            </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">সাবটোটাল</span>
                            <span>৳{{ number_format($cart->subtotal, 0) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">ডেলিভারি চার্জ</span>
                            <span class="text-success">বিনামূল্যে</span>
                        </div>
                        @if($cart->discount > 0)
                            <div class="d-flex justify-content-between mb-1 text-success">
                                <span>ছাড়</span>
                                <span>- ৳{{ number_format($cart->discount, 0) }}</span>
                            </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between fw-bold fs-5">
                            <span>মোট পরিশোধ</span>
                            <span class="text-danger">৳{{ number_format($cart->total, 0) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Payment Method --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3"><i class="bi bi-wallet2 me-1"></i>পেমেন্ট পদ্ধতি</h6>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                            <label class="form-check-label" for="cod">
                                <i class="bi bi-cash me-1"></i>ক্যাশ অন ডেলিভারি
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" value="sslcommerz" id="ssl">
                            <label class="form-check-label" for="ssl">
                                <i class="bi bi-credit-card me-1"></i>অনলাইন পেমেন্ট (SSLCommerz)
                            </label>
                        </div>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-bag-check me-2"></i>অর্ডার নিশ্চিত করুন
                    </button>
                </div>
                <p class="text-muted small text-center mt-2">অর্ডার দিলে আমাদের শর্তাবলী মেনে নেওয়া হয়েছে বলে গণ্য হবে।</p>
            </div>
        </div>
    </form>
</div>
@endsection
