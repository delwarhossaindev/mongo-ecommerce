@extends('layouts.app')

@section('title', 'আমঘর — রাজশাহীর ১০০% গাছে পাকা আম হোম ডেলিভারি')
@section('description', 'রাজশাহীর বাগান থেকে সরাসরি গাছে পাকা আম অর্ডার করুন। গোপালভোগ, রানীপছন্দ, হিমসাগর, ল্যাংড়া, রুপালি, সুরমা ফজলি — সব জাত। ঢাকার ভিতরে ৭৫-৮০৳, বাইরে ৯০৳ /কেজি। কুরিয়ার: Sundarban, AJR, Janani, SA Paribahan।')
@section('og_title', 'আমঘর — রাজশাহীর স্বাদ আপনার দরজায় 🥭')
@section('og_description', 'রাজশাহীর বাগান থেকে সরাসরি ১০০% গাছে পাকা, কার্বাইড মুক্ত আম। সারা বাংলাদেশে হোম ডেলিভারি। 📞 01329335577')

@section('content')

{{-- Hero --}}
<section class="hero-section text-center">
    <div class="container position-relative">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <p class="mb-2" style="color:#a8d5b5;font-size:.9rem;letter-spacing:2px;">🌿 রাজশাহীর বাগান থেকে সরাসরি আপনার দরজায়</p>
                <h1 class="display-5 fw-bold mb-3">আমঘর — রাজশাহীর ১০০% গাছে পাকা আম</h1>
                <p class="lead mb-2">কার্বাইড মুক্ত • বাগান থেকে সরাসরি • সারা বাংলাদেশে হোম ডেলিভারি</p>
                <div class="d-inline-flex flex-wrap gap-2 mb-3 justify-content-center">
                    <span class="badge px-3 py-2" style="background:rgba(245,166,35,.2);color:#f5a623;font-weight:600;font-size:.85rem;">
                        🏙️ ঢাকার ভিতরে: ৭৫-৮০ ৳/কেজি
                    </span>
                    <span class="badge px-3 py-2" style="background:rgba(245,166,35,.2);color:#f5a623;font-weight:600;font-size:.85rem;">
                        🚚 ঢাকার বাইরে: ৯০ ৳/কেজি
                    </span>
                </div>
                <p class="mb-4" style="color:#f5a623;font-weight:600;font-size:1.1rem;">
                    📞 কল: 01329335577 &nbsp;•&nbsp; 💬 WhatsApp: 01797384242
                </p>
                <div class="d-flex gap-2 justify-content-center flex-wrap">
                    <a href="{{ route('shop.index') }}" class="btn btn-lg px-4" style="background:#f5a623;color:#fff;font-weight:700;border:none;">
                        🛒 এখনই অর্ডার করুন
                    </a>
                    <a href="https://wa.me/8801797384242?text={{ urlencode('আমঘর থেকে রাজশাহীর গাছে পাকা আম অর্ডার করতে চাই।') }}"
                       target="_blank" rel="noopener" class="btn btn-lg px-4"
                       style="background:#25D366;color:#fff;font-weight:700;border:none;">
                        💬 WhatsApp
                    </a>
                    <a href="#" class="btn btn-lg btn-outline-light px-4" data-bs-toggle="modal" data-bs-target="#scheduleModal">
                        🗓️ সময়সূচি
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Trust Badges --}}
<section style="background:#2d6a4f;" class="py-3">
    <div class="container">
        <div class="row text-center text-white">
            <div class="col-6 col-md-3 py-2">
                <span class="fw-semibold" style="font-size:.9rem;">🌿 ১০০% গাছে পাকা</span>
            </div>
            <div class="col-6 col-md-3 py-2">
                <span class="fw-semibold" style="font-size:.9rem;">✅ কার্বাইড মুক্ত</span>
            </div>
            <div class="col-6 col-md-3 py-2">
                <span class="fw-semibold" style="font-size:.9rem;">🏡 সরাসরি রাজশাহীর বাগান</span>
            </div>
            <div class="col-6 col-md-3 py-2">
                <span class="fw-semibold" style="font-size:.9rem;">🚚 সারা বাংলাদেশে ডেলিভারি</span>
            </div>
        </div>
    </div>
</section>

{{-- Courier Partners --}}
<section class="py-4" style="background:#fff;border-bottom:1px solid #f0e8d6;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-3 text-center text-md-start mb-3 mb-md-0">
                <h6 class="mb-0 fw-bold" style="color:#2d6a4f;">
                    🚛 আমাদের কুরিয়ার পার্টনার
                </h6>
                <small class="text-muted">যেকোনোটি দিয়ে ডেলিভারি নিতে পারবেন</small>
            </div>
            <div class="col-md-9">
                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-md-end">
                    @php
                    $couriers = [
                        ['name' => 'Sundarban Courier',  'icon' => '🌳'],
                        ['name' => 'AJR Parcel',         'icon' => '📦'],
                        ['name' => 'Janani Express',     'icon' => '🚐'],
                        ['name' => 'SA Paribahan',       'icon' => '🚚'],
                    ];
                    @endphp
                    @foreach($couriers as $c)
                    <span class="badge px-3 py-2 d-inline-flex align-items-center gap-2"
                          style="background:#f0faf4;color:#2d6a4f;border:1px solid #2d6a4f;font-weight:600;font-size:.85rem;border-radius:20px;">
                        <span style="font-size:1rem;">{{ $c['icon'] }}</span>
                        {{ $c['name'] }}
                    </span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Mango Schedule Preview --}}
<section class="py-5" style="background:#fffdf5;">
    <div class="container">
        <h4 class="section-title">আম সংগ্রহের সময়সূচি ২০২৬</h4>
        <div class="row g-3">
            @php
            $varieties = [
                ['name' => 'গোপালভোগ',     'date' => '২২ মে',   'emoji' => '🥭', 'color' => '#fff3cd'],
                ['name' => 'রানীপছন্দ',    'date' => '২৫ মে',   'emoji' => '🥭', 'color' => '#d1f2eb'],
                ['name' => 'হিমসাগর',      'date' => '৩০ মে',   'emoji' => '🥭', 'color' => '#fde8e8'],
                ['name' => 'ল্যাংড়া',      'date' => '১০ জুন',  'emoji' => '🥭', 'color' => '#e8f4fd'],
                ['name' => 'রুপালি',       'date' => '১৫ জুন',  'emoji' => '🥭', 'color' => '#fef9e7'],
                ['name' => 'সুরমা ফজলি',   'date' => '২০ জুন',  'emoji' => '🥭', 'color' => '#fde2e4'],
            ];
            @endphp
            @foreach($varieties as $v)
            <div class="col-6 col-md-4 col-lg-2">
                <div class="card border-0 shadow-sm text-center h-100 p-3" style="background:{{ $v['color'] }}; border-radius:12px;">
                    <div style="font-size:2rem;">{{ $v['emoji'] }}</div>
                    <h6 class="fw-bold mt-2 mb-1" style="font-size:.85rem;color:#2d6a4f;">{{ $v['name'] }}</h6>
                    <span class="badge" style="background:#f5a623;color:#fff;font-size:.8rem;">{{ $v['date'] }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-3">
            <a href="#" data-bs-toggle="modal" data-bs-target="#scheduleModal" class="btn btn-sm btn-outline-success">
                পূর্ণ সময়সূচি দেখুন →
            </a>
        </div>
    </div>
</section>

{{-- Mango Categories --}}
@if($categories->count())
<section class="py-4" style="background:#fff;">
    <div class="container">
        <h4 class="section-title">আমের ধরন</h4>
        <div class="row g-3">
            @foreach($categories as $category)
            <div class="col-6 col-md-3 col-lg-2">
                <a href="{{ route('shop.index', ['category' => $category->id]) }}" class="text-decoration-none">
                    <div class="card category-card text-center shadow-sm h-100" style="border-radius:12px;border:2px solid transparent;" onmouseover="this.style.borderColor='#f5a623'" onmouseout="this.style.borderColor='transparent'">
                        @if($category->image)
                            <img src="{{ $category->image }}" class="card-img-top category-img" style="border-radius:10px 10px 0 0;" alt="{{ $category->name }}">
                        @else
                            <div class="category-img d-flex align-items-center justify-content-center" style="background:#f0faf4;border-radius:10px 10px 0 0;">
                                <span style="font-size:3rem;">🥭</span>
                            </div>
                        @endif
                        <div class="card-body py-2">
                            <p class="card-text fw-semibold mb-0" style="color:#2d6a4f;font-size:.9rem;">{{ $category->name }}</p>
                            <p class="text-muted mb-0" style="font-size:.75rem;">{{ $category->products_count }} প্রকার</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured Products --}}
@if($featuredProducts->count())
<section class="py-5" style="background:#f9fdf5;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="section-title mb-0">বিশেষ আমের প্যাকেজ</h4>
            <a href="{{ route('shop.index', ['featured' => 1]) }}" class="btn btn-sm" style="background:#f5a623;color:#fff;border:none;">সব দেখুন</a>
        </div>
        <div class="row g-3">
            @foreach($featuredProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Latest Products --}}
@if($latestProducts->count())
<section class="py-5" style="background:#fff;">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="section-title mb-0">সব আম দেখুন</h4>
            <a href="{{ route('shop.index') }}" class="btn btn-sm btn-outline-success">আরও দেখুন</a>
        </div>
        <div class="row g-3">
            @foreach($latestProducts as $product)
                @include('partials.product-card', ['product' => $product])
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Gallery — বাগান থেকে দেখুন --}}
<section class="py-5" style="background:#fffdf5;">
    <div class="container">
        <div class="text-center mb-4">
            <h4 class="section-title d-inline-block">🌳 আমাদের বাগান থেকে</h4>
            <p class="text-muted mb-0">রাজশাহীর তাজা গাছে পাকা আম — বাগান থেকে সরাসরি আপনার ঘরে</p>
        </div>
        @php
        $gallery = [
            ['img' => 'mango-tree-single.jpg',  'title' => 'গাছে পাকা আম',         'sub' => 'সরাসরি গাছ থেকে',         'badge' => '১০০% প্রাকৃতিক'],
            ['img' => 'mango-tree-cluster.jpg', 'title' => 'রাজশাহীর বাগান',       'sub' => 'পুকুর পাড়ের আম গাছ',     'badge' => 'বাগান ফ্রেশ'],
            ['img' => 'mango-hand.jpg',         'title' => 'পাকার অপেক্ষায়',       'sub' => 'নিখুঁত সাইজ ও ওজন',        'badge' => 'প্রিমিয়াম'],
            ['img' => 'mango-crate.jpg',        'title' => 'সংগ্রহ করা আম',        'sub' => 'যত্ন সহকারে বাছাই করা',   'badge' => 'হাতে বাছাই'],
            ['img' => 'mango-pile.jpg',         'title' => 'প্যাকেজিং রেডি',       'sub' => 'কার্বাইড ছাড়াই পাকানো',   'badge' => 'কেমিক্যাল মুক্ত'],
        ];
        @endphp
        <div class="row g-3">
            @foreach($gallery as $i => $g)
                @php
                    // 2 big cards in row 1 (col-lg-6), 3 medium cards in row 2 (col-lg-4)
                    $lgCol = $i < 2 ? 'col-lg-6' : 'col-lg-4';
                @endphp
                <div class="col-12 col-sm-6 {{ $lgCol }}">
                    <div class="gallery-card shadow-sm">
                        <img src="{{ asset('images/gallery/' . $g['img']) }}"
                             alt="{{ $g['title'] }} — রাজশাহীর গাছে পাকা আম | আমঘর"
                             loading="lazy" width="600" height="280"
                             onerror="aamghorImgFallback(this, {{ \Illuminate\Support\Js::from($g['title']) }}, {{ \Illuminate\Support\Js::from($g['sub']) }})">
                        <span class="gallery-badge">{{ $g['badge'] }}</span>
                        <div class="gallery-overlay">
                            <div class="gallery-title">{{ $g['title'] }}</div>
                            <div class="gallery-sub">{{ $g['sub'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Why Choose Us --}}
<section class="py-5" style="background:linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%); color:#fff;">
    <div class="container">
        <h4 class="text-center fw-bold mb-5" style="color:#f5a623;">কেন আমাদের বেছে নেবেন?</h4>
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="feature-icon" style="background:rgba(245,166,35,.15);">🌿</div>
                <h6 class="fw-bold">১০০% প্রাকৃতিক</h6>
                <p class="small" style="color:#a8d5b5;">গাছেই পাকানো, কোনো কেমিক্যাল ছাড়া</p>
            </div>
            <div class="col-md-3">
                <div class="feature-icon" style="background:rgba(245,166,35,.15);">🏡</div>
                <h6 class="fw-bold">সরাসরি বাগান থেকে</h6>
                <p class="small" style="color:#a8d5b5;">মাঝখানে কোনো দালাল নেই</p>
            </div>
            <div class="col-md-3">
                <div class="feature-icon" style="background:rgba(245,166,35,.15);">🚚</div>
                <h6 class="fw-bold">দ্রুত ডেলিভারি</h6>
                <p class="small" style="color:#a8d5b5;">সারা বাংলাদেশে সর্বোচ্চ ৪৮ ঘণ্টায়</p>
            </div>
            <div class="col-md-3">
                <div class="feature-icon" style="background:rgba(245,166,35,.15);">📦</div>
                <h6 class="fw-bold">নিরাপদ প্যাকেজিং</h6>
                <p class="small" style="color:#a8d5b5;">আম ভালো রাখার বিশেষ প্যাকেজিং</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-5 text-center" style="background:#fffdf5;">
    <div class="container">
        <h3 class="fw-bold" style="color:#2d6a4f;">এখনই অর্ডার করুন!</h3>
        <p class="text-muted mb-4">রাজশাহীর তাজা আম আপনার দরজায় পৌঁছে দেব</p>
        <div class="d-flex gap-2 justify-content-center flex-wrap">
            <a href="{{ route('shop.index') }}" class="btn btn-lg px-4" style="background:#2d6a4f;color:#fff;font-weight:700;">
                🛒 অর্ডার করুন
            </a>
            <a href="tel:01329335577" class="btn btn-lg px-4" style="background:#f5a623;color:#fff;font-weight:700;">
                📞 01329335577
            </a>
            <a href="https://wa.me/8801797384242?text={{ urlencode('আমঘর থেকে রাজশাহীর গাছে পাকা আম অর্ডার করতে চাই।') }}"
               target="_blank" rel="noopener" class="btn btn-lg px-4"
               style="background:#25D366;color:#fff;font-weight:700;">
                💬 WhatsApp: 01797384242
            </a>
        </div>
    </div>
</section>

@endsection
