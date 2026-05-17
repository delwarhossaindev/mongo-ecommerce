@extends('layouts.app')

@section('title', 'রেজিস্ট্রেশন - ShopBD')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-person-plus fs-1 text-primary"></i>
                        <h4 class="fw-bold mt-2">নতুন অ্যাকাউন্ট তৈরি করুন</h4>
                        <p class="text-muted small">ShopBD-তে যোগ দিন বিনামূল্যে</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">পূর্ণ নাম *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="আপনার পূর্ণ নাম" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ইমেইল *</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="আপনার ইমেইল" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ফোন নম্বর</label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                value="{{ old('phone') }}" placeholder="+880 1XXXXXXXXX">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">পাসওয়ার্ড *</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="কমপক্ষে ৮ অক্ষর" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">পাসওয়ার্ড নিশ্চিত করুন *</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="পুনরায় পাসওয়ার্ড দিন" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">রেজিস্ট্রেশন করুন</button>
                        </div>
                    </form>

                    <hr class="my-4">
                    <p class="text-center mb-0">
                        ইতিমধ্যে অ্যাকাউন্ট আছে?
                        <a href="{{ route('login') }}" class="text-primary fw-semibold">লগিন করুন</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
