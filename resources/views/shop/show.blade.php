@extends('layouts.app')

@php
    $productImages = is_array($product->images) ? $product->images : [];
    $firstImage    = $productImages[0] ?? asset('images/og-image.svg');
    $metaDesc      = $product->short_description
        ?: ($product->description
            ? \Illuminate\Support\Str::limit(strip_tags($product->description), 160)
            : "{$product->name} অর্ডার করুন আমঘর থেকে — রাজশাহীর ১০০% গাছে পাকা, কার্বাইড মুক্ত আম। ৳" . number_format($product->effective_price, 0) . "/কেজি। সারা বাংলাদেশে হোম ডেলিভারি।");
    $pageTitle = $product->name . ' — আমঘর | রাজশাহীর গাছে পাকা আম';
@endphp

@section('title', $pageTitle)
@section('description', $metaDesc)
@section('og_title', $product->name . ' — ৳' . number_format($product->effective_price, 0))
@section('og_description', $metaDesc)

@push('styles')
{{-- Product Schema (Google Rich Results) --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Product",
    "name": @json($product->name),
    "description": @json($metaDesc),
    "image": @json($productImages ?: [asset('images/og-image.svg')]),
    @if($product->sku) "sku": @json($product->sku), @endif
    @if($product->category) "category": @json($product->category->name), @endif
    "brand": {
        "@type": "Brand",
        "name": "আমঘর"
    },
    "offers": {
        "@type": "Offer",
        "url": "{{ route('shop.show', $product->id) }}",
        "priceCurrency": "BDT",
        "price": "{{ number_format($product->effective_price, 2, '.', '') }}",
        "availability": "{{ $product->stock > 0 ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}",
        "itemCondition": "https://schema.org/NewCondition",
        "seller": {
            "@type": "Organization",
            "name": "আমঘর — AamGhor"
        }
    }
    @if($product->rating > 0 && $product->review_count > 0)
    ,"aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "{{ $product->rating }}",
        "reviewCount": "{{ $product->review_count }}"
    }
    @endif
}
</script>

{{-- Breadcrumb Schema --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        { "@type": "ListItem", "position": 1, "name": "হোম", "item": "{{ url('/') }}" },
        { "@type": "ListItem", "position": 2, "name": "আমের তালিকা", "item": "{{ route('shop.index') }}" }
        @if($product->category)
        ,{ "@type": "ListItem", "position": 3, "name": @json($product->category->name), "item": "{{ route('shop.index', ['category' => $product->category_id]) }}" }
        ,{ "@type": "ListItem", "position": 4, "name": @json($product->name), "item": "{{ route('shop.show', $product->id) }}" }
        @else
        ,{ "@type": "ListItem", "position": 3, "name": @json($product->name), "item": "{{ route('shop.show', $product->id) }}" }
        @endif
    ]
}
</script>
@endpush

@section('content')
<div class="container py-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">হোম</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">পণ্য</a></li>
            @if($product->category)
                <li class="breadcrumb-item">
                    <a href="{{ route('shop.index', ['category' => $product->category_id]) }}">{{ $product->category->name }}</a>
                </li>
            @endif
            <li class="breadcrumb-item active">{{ Str::limit($product->name, 40) }}</li>
        </ol>
    </nav>

    <div class="row g-4">
        {{-- Product Images --}}
        <div class="col-md-5">
            @php $images = is_array($product->images) ? $product->images : []; @endphp
            @if(count($images) > 0)
                <img src="{{ $images[0] }}" class="img-fluid rounded shadow-sm w-100"
                     style="max-height:400px;object-fit:cover;"
                     alt="{{ $product->name }} — রাজশাহীর গাছে পাকা আম | আমঘর"
                     id="mainImg" width="600" height="400" fetchpriority="high">
                @if(count($images) > 1)
                    <div class="d-flex gap-2 mt-2 flex-wrap">
                        @foreach($images as $idx => $img)
                            <img src="{{ $img }}" class="rounded border"
                                 style="width:60px;height:60px;object-fit:cover;cursor:pointer;"
                                 alt="{{ $product->name }} — ছবি {{ $idx + 1 }}"
                                 loading="lazy" width="60" height="60"
                                 onclick="document.getElementById('mainImg').src='{{ $img }}'">
                        @endforeach
                    </div>
                @endif
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:400px;">
                    <i class="bi bi-image fs-1 text-muted"></i>
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="col-md-7">
            @if($product->category)
                <span class="badge bg-primary mb-2">{{ $product->category->name }}</span>
            @endif
            <h1 class="fw-bold h3">{{ $product->name }}</h1>

            @if($product->rating > 0)
                <div class="text-warning mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star{{ $i <= round($product->rating) ? '-fill' : '' }}"></i>
                    @endfor
                    <span class="text-muted small">({{ $product->review_count }} রিভিউ)</span>
                </div>
            @endif

            <div class="mb-3">
                <span class="fs-2 fw-bold text-danger">৳{{ number_format($product->effective_price, 0) }}</span>
                @if($product->sale_price > 0 && $product->price > $product->sale_price)
                    <span class="text-muted text-decoration-line-through ms-2">৳{{ number_format($product->price, 0) }}</span>
                    <span class="badge bg-danger ms-2">
                        {{ round((1 - $product->sale_price / $product->price) * 100) }}% ছাড়
                    </span>
                @endif
            </div>

            @if($product->short_description)
                <p class="text-muted">{{ $product->short_description }}</p>
            @endif

            <div class="mb-3">
                @if($product->stock > 0)
                    <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>স্টকে আছে ({{ $product->stock }}টি)</span>
                @else
                    <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>স্টক নেই</span>
                @endif
                @if($product->sku)
                    <span class="text-muted small ms-3">SKU: {{ $product->sku }}</span>
                @endif
            </div>

            @if($product->stock > 0)
                <form action="{{ route('cart.add') }}" method="POST" class="d-flex gap-3 align-items-center mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div style="width:100px;">
                        <input type="number" name="quantity" class="form-control" value="1" min="1" max="{{ $product->stock }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="bi bi-cart-plus me-2"></i>কার্টে যোগ করুন
                    </button>
                </form>
            @endif

            {{-- Tags --}}
            @if(is_array($product->tags) && count($product->tags))
                <div class="mb-3">
                    @foreach($product->tags as $tag)
                        <span class="badge bg-light text-dark border me-1">{{ $tag }}</span>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    {{-- Description --}}
    @if($product->description)
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <h5 class="fw-bold border-bottom pb-2 mb-3">পণ্যের বিবরণ</h5>
                <div>{{ $product->description }}</div>
            </div>
        </div>
    @endif

    {{-- Related Products --}}
    @if($relatedProducts->count())
        <div class="mt-5">
            <h5 class="section-title">সম্পর্কিত পণ্য</h5>
            <div class="row g-3">
                @foreach($relatedProducts as $related)
                    @include('partials.product-card', ['product' => $related])
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
