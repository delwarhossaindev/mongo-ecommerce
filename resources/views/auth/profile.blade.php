@extends('layouts.app')

@section('title', 'প্রোফাইল - ShopBD')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <h4 class="fw-bold mb-4"><i class="bi bi-person-circle me-2"></i>প্রোফাইল</h4>

            {{-- Update Profile --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">ব্যক্তিগত তথ্য</h6>
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">নাম</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', Auth::user()->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">ইমেইল</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', Auth::user()->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">ফোন</label>
                            <input type="text" name="phone" class="form-control"
                                value="{{ old('phone', Auth::user()->phone ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">তথ্য সংরক্ষণ করুন</button>
                    </form>
                </div>
            </div>

            {{-- Change Password --}}
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">পাসওয়ার্ড পরিবর্তন</h6>
                    <form method="POST" action="{{ route('profile.password') }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">বর্তমান পাসওয়ার্ড</label>
                            <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                            @error('current_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">নতুন পাসওয়ার্ড</label>
                            <input type="password" name="new_password" class="form-control @error('new_password') is-invalid @enderror" required>
                            @error('new_password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">নতুন পাসওয়ার্ড নিশ্চিত করুন</label>
                            <input type="password" name="new_password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-warning">পাসওয়ার্ড পরিবর্তন করুন</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
