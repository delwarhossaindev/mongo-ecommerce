@extends('layouts.app')

@section('title', 'লগিন - ShopBD')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <i class="bi bi-shop fs-1 text-primary"></i>
                        <h4 class="fw-bold mt-2">আবার স্বাগতম!</h4>
                        <p class="text-muted small">আপনার অ্যাকাউন্টে লগিন করুন</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">ইমেইল</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" placeholder="আপনার ইমেইল" required autofocus>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">পাসওয়ার্ড</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                placeholder="আপনার পাসওয়ার্ড" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">মনে রাখুন</label>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">লগিন করুন</button>
                        </div>
                    </form>

                    <hr class="my-4">
                    <p class="text-center mb-0">
                        অ্যাকাউন্ট নেই?
                        <a href="{{ route('register') }}" class="text-primary fw-semibold">রেজিস্ট্রেশন করুন</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
