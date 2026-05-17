@extends('layouts.app')

@php
    $catName = request('category') && ($selectedCat = $categories->firstWhere('id', request('category'))) ? $selectedCat->name : null;
    $pageTitle = $catName
        ? $catName . ' আম কিনুন — আমঘর'
        : 'সব আমের তালিকা — আমঘর | রাজশাহীর গাছে পাকা আম';
    $pageDesc = $catName
        ? "আমঘর থেকে {$catName} আম অর্ডার করুন — ১০০% গাছে পাকা, কার্বাইড মুক্ত, রাজশাহীর বাগান থেকে সরাসরি। সারা বাংলাদেশে হোম ডেলিভারি।"
        : 'রাজশাহীর সব ধরনের গাছে পাকা আম এক জায়গায় — গোপালভোগ, হিমসাগর, ল্যাংড়া, রুপালি, ফজলি। কার্বাইড মুক্ত, বাগান থেকে সরাসরি, সারা বাংলাদেশে হোম ডেলিভারি।';
@endphp

@section('title', $pageTitle)
@section('description', $pageDesc)
@section('og_title', $pageTitle)
@section('og_description', $pageDesc)

@push('styles')
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "হোম",
            "item": "{{ url('/') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": "আমের তালিকা",
            "item": "{{ route('shop.index') }}"
        }@if($catName),
        {
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $catName }}",
            "item": "{{ route('shop.index', ['category' => request('category')]) }}"
        }@endif
    ]
}
</script>
@endpush

@section('content')
<div class="container py-4">
    <h1 class="visually-hidden">{{ $pageTitle }}</h1>
    <div class="row g-4">

        {{-- Sidebar Filter --}}
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-bold mb-3"><i class="bi bi-funnel me-1"></i>ফিল্টার</h6>
                    <form method="GET" action="{{ route('shop.index') }}">
                        {{-- Search --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">পণ্য খুঁজুন</label>
                            <input type="text" name="search" class="form-control form-control-sm"
                                placeholder="পণ্যের নাম লিখুন..." value="{{ request('search') }}">
                        </div>

                        {{-- Category --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">ক্যাটাগরি</label>
                            <select name="category" class="form-select form-select-sm">
                                <option value="">সব ক্যাটাগরি</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Price Range --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">দাম (৳)</label>
                            <div class="row g-1">
                                <div class="col-6">
                                    <input type="number" name="min_price" class="form-control form-control-sm"
                                        placeholder="সর্বনিম্ন" value="{{ request('min_price') }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" name="max_price" class="form-control form-control-sm"
                                        placeholder="সর্বোচ্চ" value="{{ request('max_price') }}">
                                </div>
                            </div>
                        </div>

                        {{-- Sort --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">সাজান</label>
                            <select name="sort" class="form-select form-select-sm">
                                <option value="">ডিফল্ট</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>দাম: কম থেকে বেশি</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>দাম: বেশি থেকে কম</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>নতুন আগে</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>রেটিং অনুযায়ী</option>
                            </select>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-sm">ফিল্টার করুন</button>
                            <a href="{{ route('shop.index') }}" class="btn btn-outline-secondary btn-sm">রিসেট</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Products --}}
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">
                    পণ্য সমূহ
                    <span class="badge bg-secondary ms-2">{{ $products->total() }}</span>
                </h5>
            </div>

            @if($products->count())
                <div class="row g-3">
                    @foreach($products as $product)
                        @include('partials.product-card', ['product' => $product])
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $products->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-search fs-1 text-muted"></i>
                    <p class="text-muted mt-3">কোনো পণ্য পাওয়া যায়নি।</p>
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-primary">সব পণ্য দেখুন</a>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
