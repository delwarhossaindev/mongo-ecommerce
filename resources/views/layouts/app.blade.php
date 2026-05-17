<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Primary Meta --}}
    <title>@yield('title', 'আমঘর — রাজশাহীর ১০০% গাছে পাকা আম')</title>
    <meta name="description" content="@yield('description', 'আমঘর — রাজশাহীর বাগান থেকে সরাসরি ১০০% গাছে পাকা, কার্বাইড মুক্ত আম। গোপালভোগ, হিমসাগর, ল্যাংড়া, ফজলি সহ সব জাত। সারা বাংলাদেশে হোম ডেলিভারি।')">
    <meta name="keywords" content="আমঘর, AamGhor, রাজশাহীর আম, গাছে পাকা আম, কার্বাইড মুক্ত আম, হিমসাগর, ল্যাংড়া, ফজলি, গোপালভোগ, রানীপছন্দ, রুপালি, সুরমা ফজলি, mango Bangladesh, Rajshahi mango, online mango order, mango delivery Dhaka">
    <meta name="author" content="আমঘর — AamGhor">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#2F5D2F">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- Favicon --}}
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    {{-- Open Graph (Facebook, LinkedIn, WhatsApp) --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="আমঘর — AamGhor">
    <meta property="og:title" content="@yield('og_title', 'আমঘর — রাজশাহীর ১০০% গাছে পাকা আম')">
    <meta property="og:description" content="@yield('og_description', 'রাজশাহীর বাগান থেকে সরাসরি ১০০% গাছে পাকা, কার্বাইড মুক্ত আম। সারা বাংলাদেশে হোম ডেলিভারি। 📞 01329335577')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-image.svg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="bn_BD">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'আমঘর — রাজশাহীর ১০০% গাছে পাকা আম')">
    <meta name="twitter:description" content="@yield('og_description', 'রাজশাহীর বাগান থেকে সরাসরি, কার্বাইড মুক্ত আম। সারা বাংলাদেশে ডেলিভারি।')">
    <meta name="twitter:image" content="{{ asset('images/og-image.svg') }}">

    {{-- Structured Data (JSON-LD for Local Business) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "LocalBusiness",
        "name": "আমঘর — AamGhor",
        "image": "{{ asset('images/og-image.svg') }}",
        "description": "রাজশাহীর বাগান থেকে সরাসরি ১০০% গাছে পাকা, কার্বাইড মুক্ত আম। সারা বাংলাদেশে হোম ডেলিভারি।",
        "telephone": ["+8801329335577", "+8801797384242"],
        "email": "info@aamghor.com",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+8801797384242",
            "contactType": "customer service",
            "contactOption": "WhatsApp",
            "availableLanguage": ["Bengali", "bn"]
        },
        "url": "{{ url('/') }}",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "রাজশাহী",
            "addressCountry": "BD"
        },
        "priceRange": "৳৳"
    }
    </script>

    {{-- Performance: Preconnect to CDNs --}}
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">

    {{-- Stylesheets --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --mango: #f5a623;
            --mango-dark: #d4881a;
            --green: #2d6a4f;
            --green-light: #40916c;
            --green-bg: #f0faf4;
        }
        body { font-family: 'Hind Siliguri', 'Segoe UI', sans-serif; background: #fffdf5; }
        .navbar-brand { font-weight: 800; font-size: 1.4rem; }
        .navbar { box-shadow: 0 2px 10px rgba(0,0,0,.08); background: #fff !important; }
        .navbar .nav-link { color: #2d6a4f !important; font-weight: 500; }
        .navbar .nav-link.active, .navbar .nav-link:hover { color: #f5a623 !important; }
        .product-card { transition: transform .2s, box-shadow .2s; border: none; }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.12); }
        .product-img { height: 220px; object-fit: cover; }
        .price-badge { font-size: 1.1rem; font-weight: 700; color: #e63946; }
        .original-price { text-decoration: line-through; color: #aaa; font-size: .9rem; }
        .hero-section {
            background:
                linear-gradient(135deg, rgba(27,67,50,.85) 0%, rgba(45,106,79,.75) 100%),
                url('/images/gallery/mango-tree-cluster.jpg') center/cover no-repeat;
            color: #fff; padding: 100px 0; position: relative; overflow: hidden;
        }
        .hero-section::before { content: '🥭'; font-size: 200px; position: absolute; right: -20px; top: -30px; opacity: .08; }
        /* Gallery */
        .gallery-card { border-radius: 16px; overflow: hidden; position: relative; cursor: pointer; transition: transform .3s ease, box-shadow .3s ease; }
        .gallery-card:hover { transform: translateY(-6px); box-shadow: 0 12px 28px rgba(0,0,0,.18); }
        .gallery-card img { width: 100%; height: 280px; object-fit: cover; display: block; transition: transform .5s ease; }
        .gallery-card:hover img { transform: scale(1.06); }
        .gallery-card .gallery-overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(180deg, transparent 0%, rgba(0,0,0,.75) 100%); color: #fff; padding: 30px 16px 14px; }
        .gallery-card .gallery-title { font-weight: 700; margin-bottom: 2px; font-size: .95rem; }
        .gallery-card .gallery-sub { font-size: .75rem; opacity: .85; }
        .gallery-card .gallery-badge { position: absolute; top: 10px; right: 10px; background: #f5a623; color: #fff; padding: 4px 10px; border-radius: 20px; font-size: .7rem; font-weight: 700; }
        /* Bengali-safe image fallback (replaces broken placehold.co with proper Unicode rendering) */
        .gallery-fallback { width: 100%; height: 280px; display: flex; flex-direction: column; align-items: center; justify-content: center; background: linear-gradient(135deg, #2d6a4f 0%, #1b4332 100%); color: #fff; font-family: 'Hind Siliguri', sans-serif; }
        .gallery-fallback .fallback-emoji { font-size: 4rem; line-height: 1; margin-bottom: 8px; opacity: .9; }
        .gallery-fallback .fallback-title { font-size: 1rem; font-weight: 700; color: #f5a623; text-align: center; padding: 0 12px; }
        .gallery-fallback .fallback-sub { font-size: .75rem; opacity: .7; margin-top: 4px; }
        /* Splash screen — shown on initial page load, fades out after window load */
        #aamghor-splash {
            position: fixed; inset: 0; z-index: 9999;
            background: linear-gradient(135deg, #fffdf5 0%, #fff3cd 100%);
            display: flex; align-items: center; justify-content: center;
            flex-direction: column; gap: 16px;
            transition: opacity .5s ease, visibility .5s ease;
        }
        #aamghor-splash.hide { opacity: 0; visibility: hidden; pointer-events: none; }
        #aamghor-splash .splash-logo { animation: splashBounce 1.2s ease-in-out infinite; }
        #aamghor-splash .splash-text {
            font-family: Georgia, serif; font-weight: 800; font-size: 1.6rem;
            animation: splashFade 1.5s ease-in-out infinite;
        }
        #aamghor-splash .splash-sub {
            font-family: 'Hind Siliguri', sans-serif; color: #2F5D2F;
            font-size: .9rem; letter-spacing: 2px; opacity: .8;
        }
        #aamghor-splash .splash-dots span {
            display: inline-block; width: 8px; height: 8px; border-radius: 50%;
            background: #F4B128; margin: 0 3px;
            animation: splashDots 1.2s ease-in-out infinite;
        }
        #aamghor-splash .splash-dots span:nth-child(2) { animation-delay: .2s; }
        #aamghor-splash .splash-dots span:nth-child(3) { animation-delay: .4s; }
        @keyframes splashBounce {
            0%, 100% { transform: translateY(0) scale(1); }
            50%      { transform: translateY(-12px) scale(1.05); }
        }
        @keyframes splashFade {
            0%, 100% { opacity: 1; }
            50%      { opacity: .7; }
        }
        @keyframes splashDots {
            0%, 100% { transform: scale(.6); opacity: .4; }
            50%      { transform: scale(1.2); opacity: 1; }
        }
        @media (prefers-reduced-motion: reduce) {
            #aamghor-splash .splash-logo,
            #aamghor-splash .splash-text,
            #aamghor-splash .splash-dots span { animation: none; }
        }
        /* Floating WhatsApp button */
        .wa-float {
            position: fixed; bottom: 24px; right: 24px; z-index: 1040;
            display: flex; align-items: center; gap: 0;
            background: #25D366; color: #fff; padding: 14px 16px;
            border-radius: 50px; text-decoration: none;
            box-shadow: 0 6px 20px rgba(37,211,102,.45);
            transition: all .3s ease;
            overflow: hidden; max-width: 60px;
        }
        .wa-float:hover {
            color: #fff; max-width: 280px; gap: 10px;
            box-shadow: 0 10px 30px rgba(37,211,102,.6);
            transform: translateY(-2px);
        }
        .wa-float .wa-icon { font-size: 1.7rem; line-height: 1; flex-shrink: 0; }
        .wa-float .wa-text {
            white-space: nowrap; font-weight: 700; font-size: .95rem;
            opacity: 0; transition: opacity .2s ease .1s;
        }
        .wa-float:hover .wa-text { opacity: 1; }
        .wa-float::before {
            content: ''; position: absolute; top: -4px; right: -4px;
            width: 16px; height: 16px; background: #25D366;
            border-radius: 50%; border: 2px solid #fff;
            animation: waPulse 2s ease-in-out infinite;
        }
        @keyframes waPulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50%      { transform: scale(1.3); opacity: .6; }
        }
        @media (max-width: 576px) {
            .wa-float { bottom: 16px; right: 16px; padding: 12px 14px; }
        }
        .cart-badge { font-size: .65rem; }
        .category-card { cursor: pointer; transition: transform .15s; border: none; }
        .category-card:hover { transform: scale(1.03); }
        .category-img { height: 130px; object-fit: cover; }
        .section-title { font-weight: 700; border-left: 4px solid var(--mango); padding-left: 12px; margin-bottom: 1.5rem; color: var(--green); }
        footer { background: #1b4332; color: #ccc; }
        footer a { color: #aaa; text-decoration: none; }
        footer a:hover { color: #f5a623; }
        .btn-cart { background: var(--green); color: #fff; border: none; }
        .btn-cart:hover { background: var(--green-light); color: #fff; }
        .btn-primary { background: var(--green) !important; border-color: var(--green) !important; }
        .btn-primary:hover { background: var(--green-light) !important; border-color: var(--green-light) !important; }
        .btn-outline-primary { color: var(--green) !important; border-color: var(--green) !important; }
        .btn-outline-primary:hover { background: var(--green) !important; color: #fff !important; }
        .text-primary { color: var(--green) !important; }
        .bg-primary { background: var(--green) !important; }
        .border-primary { border-color: var(--green) !important; }
        .badge.bg-primary { background: var(--green) !important; }
        .status-badge { font-size: .8rem; padding: 4px 10px; border-radius: 20px; }
        /* Schedule Modal */
        .schedule-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; }
        .schedule-header { background: linear-gradient(135deg, #2d6a4f, #1b4332); color: #fff; padding: 20px; text-align: center; }
        .schedule-row { display: flex; justify-content: space-between; align-items: center; padding: 10px 16px; border-bottom: 1px solid #e8f5e9; }
        .schedule-row:last-child { border-bottom: none; }
        .schedule-row:nth-child(even) { background: #f0faf4; }
        .schedule-date { background: #f5a623; color: #fff; padding: 3px 12px; border-radius: 20px; font-weight: 700; font-size: .85rem; }
        .feature-icon { width: 64px; height: 64px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.8rem; margin: 0 auto 10px; }
    </style>
    @stack('styles')

    {{-- Bengali-safe image fallback — must be defined before any <img onerror> in body --}}
    <script>
        function aamghorImgFallback(img, title, sub) {
            const div = document.createElement('div');
            div.className = 'gallery-fallback';
            const safe = (s) => String(s || '').replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
            div.innerHTML =
                '<div class="fallback-emoji">🥭</div>' +
                '<div class="fallback-title">' + safe(title || 'আমঘর') + '</div>' +
                (sub ? '<div class="fallback-sub">' + safe(sub) + '</div>' : '');
            img.replaceWith(div);
        }
    </script>
</head>
<body>

{{-- Splash screen — auto-hides on window load --}}
<div id="aamghor-splash" aria-hidden="true">
    <div class="splash-logo">
        @include('partials.logo-mark', ['size' => 100])
    </div>
    <div class="splash-text">
        <span style="color:#F4B128;">Aam</span><span style="color:#2F5D2F;">Ghor</span>
    </div>
    <div class="splash-sub">রাজশাহীর স্বাদ আপনার দরজায়</div>
    <div class="splash-dots" aria-hidden="true">
        <span></span><span></span><span></span>
    </div>
</div>
<script>
    // Hide splash as soon as DOM is ready (don't wait for all images)
    (function () {
        function hideSplash() {
            var s = document.getElementById('aamghor-splash');
            if (s) s.classList.add('hide');
        }
        if (document.readyState === 'complete' || document.readyState === 'interactive') {
            setTimeout(hideSplash, 400);
        } else {
            document.addEventListener('DOMContentLoaded', function () { setTimeout(hideSplash, 400); });
        }
        // Hard fallback: never let splash stick around more than 3s
        setTimeout(hideSplash, 3000);
    })();
</script>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}" style="color: var(--green);">
            @include('partials.logo-wordmark', ['size' => 48])
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}" href="{{ route('home') }}">হোম</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop.*') ? 'active fw-bold' : '' }}" href="{{ route('shop.index') }}">আমের তালিকা</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#scheduleModal" style="color: var(--mango) !important; font-weight:600;">🗓️ সময়সূচি</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto align-items-center gap-2">
                <li class="nav-item">
                    <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                        <i class="bi bi-cart3 fs-5"></i>
                        @auth
                            @if(session('cart_count', 0) > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-badge">
                                    {{ session('cart_count', 0) }}
                                </span>
                            @endif
                        @endauth
                    </a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="btn btn-outline-primary btn-sm" href="{{ route('login') }}">লগিন</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm" href="{{ route('register') }}">রেজিস্ট্রেশন</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i>প্রোফাইল</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="bi bi-bag me-2"></i>আমার অর্ডার</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>লগআউট
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-0 rounded-0" role="alert">
        <div class="container">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show mb-0 rounded-0" role="alert">
        <div class="container">
            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<main>
    @yield('content')
</main>

{{-- Floating WhatsApp Button --}}
<a href="https://wa.me/8801797384242?text={{ urlencode('আমঘর থেকে রাজশাহীর গাছে পাকা আম অর্ডার করতে চাই।') }}"
   class="wa-float" target="_blank" rel="noopener" aria-label="WhatsApp-এ অর্ডার করুন">
    <span class="wa-icon">
        <svg width="28" height="28" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
    </span>
    <span class="wa-text">WhatsApp-এ অর্ডার</span>
</a>

{{-- Mango Schedule Modal --}}
<div class="modal fade schedule-modal" id="scheduleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg">
            <div class="modal-header border-0 p-0">
                <div class="schedule-header w-100">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                    <div class="mb-2 d-inline-flex align-items-center justify-content-center"
                         style="width:70px;height:70px;background:#fff;border-radius:50%;border:3px solid #F4B128;padding:6px;">
                        @include('partials.logo-mark', ['size' => 50])
                    </div>
                    <h5 class="fw-bold mb-1">আমঘর</h5>
                    <h4 class="fw-bold" style="color:#f5a623;">আম সংগ্রহের</h4>
                    <h5 class="fw-bold">সম্ভাব্য সময়সূচি ২০২৬</h5>
                    <p class="small mb-0 mt-1" style="color:#a8d5b5;">রাজশাহীর বাগান থেকে নিরাপদ ও গাছে পাকা আম সংগ্রহের সম্ভাব্য সময়সূচি</p>
                </div>
            </div>
            <div class="modal-body p-0">
                @php
                $schedule = [
                    ['name' => '🥭 গোপালভোগ',      'date' => '২২ মে'],
                    ['name' => '🥭 রানীপছন্দ',     'date' => '২৫ মে'],
                    ['name' => '🥭 হিমসাগর',       'date' => '৩০ মে'],
                    ['name' => '🥭 ল্যাংড়া',       'date' => '১০ জুন'],
                    ['name' => '🥭 রুপালি',        'date' => '১৫ জুন'],
                    ['name' => '🥭 সুরমা ফজলি',    'date' => '২০ জুন'],
                ];
                @endphp
                @foreach($schedule as $item)
                    <div class="schedule-row">
                        <span class="fw-semibold" style="color:#2d6a4f;">{{ $item['name'] }}</span>
                        <span class="schedule-date">{{ $item['date'] }}</span>
                    </div>
                @endforeach

                {{-- Delivery Charge --}}
                <div class="row g-0 text-center" style="background:#fff3cd;border-top:2px solid #f5a623;">
                    <div class="col-6 p-3 border-end">
                        <div style="font-size:1.3rem;">🏙️</div>
                        <div style="font-size:.75rem;color:#2d6a4f;font-weight:700;">ঢাকার ভিতরে</div>
                        <div style="font-size:.9rem;color:#e63946;font-weight:800;">৭৫-৮০ ৳/কেজি</div>
                    </div>
                    <div class="col-6 p-3">
                        <div style="font-size:1.3rem;">🚚</div>
                        <div style="font-size:.75rem;color:#2d6a4f;font-weight:700;">ঢাকার বাইরে</div>
                        <div style="font-size:.9rem;color:#e63946;font-weight:800;">৯০ ৳/কেজি</div>
                    </div>
                </div>

                {{-- Courier Partners --}}
                <div class="text-center p-3" style="background:#fff;border-bottom:1px solid #e8f5e9;">
                    <div style="font-size:.75rem;color:#2d6a4f;font-weight:700;margin-bottom:6px;">
                        🚛 কুরিয়ার পার্টনার
                    </div>
                    <div class="d-flex flex-wrap gap-1 justify-content-center">
                        <span class="badge" style="background:#f0faf4;color:#2d6a4f;border:1px solid #2d6a4f;font-size:.7rem;font-weight:600;">Sundarban</span>
                        <span class="badge" style="background:#f0faf4;color:#2d6a4f;border:1px solid #2d6a4f;font-size:.7rem;font-weight:600;">AJR</span>
                        <span class="badge" style="background:#f0faf4;color:#2d6a4f;border:1px solid #2d6a4f;font-size:.7rem;font-weight:600;">Janani</span>
                        <span class="badge" style="background:#f0faf4;color:#2d6a4f;border:1px solid #2d6a4f;font-size:.7rem;font-weight:600;">SA Paribahan</span>
                    </div>
                </div>
                <div class="row g-0 text-center" style="background:#f0faf4;">
                    <div class="col-3 p-3 border-end">
                        <div style="font-size:1.5rem;">🌿</div>
                        <div style="font-size:.7rem;color:#2d6a4f;font-weight:600;">১০০% গাছে পাকা আম</div>
                    </div>
                    <div class="col-3 p-3 border-end">
                        <div style="font-size:1.5rem;">✅</div>
                        <div style="font-size:.7rem;color:#2d6a4f;font-weight:600;">কার্বাইড মুক্ত</div>
                    </div>
                    <div class="col-3 p-3 border-end">
                        <div style="font-size:1.5rem;">🏡</div>
                        <div style="font-size:.7rem;color:#2d6a4f;font-weight:600;">সরাসরি বাগান থেকে</div>
                    </div>
                    <div class="col-3 p-3">
                        <div style="font-size:1.5rem;">🚚</div>
                        <div style="font-size:.7rem;color:#2d6a4f;font-weight:600;">সারা বাংলাদেশে হোম ডেলিভারি</div>
                    </div>
                </div>

                <div class="text-center p-3" style="background:#2d6a4f;">
                    <p class="mb-2 text-white small fw-semibold">
                        📞 01329335577 &nbsp;•&nbsp; 💬 WhatsApp: 01797384242
                    </p>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="{{ route('shop.index') }}" class="btn btn-sm" style="background:#f5a623;color:#fff;font-weight:700;" data-bs-dismiss="modal">
                            🛒 অর্ডার করুন
                        </a>
                        <a href="https://wa.me/8801797384242?text={{ urlencode('আমঘর থেকে রাজশাহীর গাছে পাকা আম অর্ডার করতে চাই।') }}"
                           target="_blank" rel="noopener" class="btn btn-sm"
                           style="background:#25D366;color:#fff;font-weight:700;">
                            💬 WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="d-inline-flex align-items-center gap-2 p-2 mb-2"
                     style="background:#fff;border-radius:12px;">
                    @include('partials.logo-mark', ['size' => 50])
                    <span style="font-weight:800;font-family:Georgia,serif;font-size:1.4rem;line-height:1;">
                        <span style="color:#F4B128;">Aam</span><span style="color:#2F5D2F;">Ghor</span>
                    </span>
                </div>
                <p class="small mb-1" style="color:#a8d5b5;">রাজশাহীর স্বাদ আপনার দরজায়</p>
                <p class="small">রাজশাহীর বাগান থেকে সরাসরি আপনার দরজায়। ১০০% গাছে পাকা, কার্বাইড মুক্ত আম।</p>
                <p class="small mb-1"><i class="bi bi-telephone-fill me-1" style="color:#f5a623;"></i> 01329335577</p>
                <p class="small mb-1">
                    <a href="https://wa.me/8801797384242" target="_blank" rel="noopener" style="color:#25D366;text-decoration:none;font-weight:600;">
                        <i class="bi bi-whatsapp me-1"></i> 01797384242 (WhatsApp)
                    </a>
                </p>
                <p class="small mb-0"><i class="bi bi-truck me-1" style="color:#f5a623;"></i> ডেলিভারি: ঢাকায় ৭৫-৮০৳, ঢাকার বাইরে ৯০৳ /কেজি</p>
            </div>
            <div class="col-md-2">
                <h6 class="text-white">লিংক</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('home') }}">হোম</a></li>
                    <li><a href="{{ route('shop.index') }}">আমের তালিকা</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-white">অ্যাকাউন্ট</h6>
                <ul class="list-unstyled small">
                    @guest
                        <li><a href="{{ route('login') }}">লগিন</a></li>
                        <li><a href="{{ route('register') }}">রেজিস্ট্রেশন</a></li>
                    @else
                        <li><a href="{{ route('profile') }}">প্রোফাইল</a></li>
                        <li><a href="{{ route('orders.index') }}">আমার অর্ডার</a></li>
                    @endguest
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-white">যোগাযোগ</h6>
                <p class="small mb-1"><i class="bi bi-telephone me-1"></i> 01329335577</p>
                <p class="small mb-1">
                    <a href="https://wa.me/8801797384242" target="_blank" rel="noopener" style="color:#25D366;text-decoration:none;">
                        <i class="bi bi-whatsapp me-1"></i> 01797384242
                    </a>
                </p>
                <p class="small mb-1"><i class="bi bi-envelope me-1"></i> info@aamghor.com</p>
                <p class="small mb-2"><i class="bi bi-geo-alt me-1"></i> রাজশাহী, বাংলাদেশ</p>
                <h6 class="text-white mt-3" style="font-size:.85rem;">🚛 কুরিয়ার পার্টনার</h6>
                <p class="small mb-0" style="line-height:1.6;">
                    Sundarban • AJR<br>
                    Janani • SA Paribahan
                </p>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <p class="text-center small mb-0">&copy; {{ date('Y') }} আমঘর. সর্বস্বত্ব সংরক্ষিত।</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Auto-show schedule modal on homepage (once per session)
    document.addEventListener('DOMContentLoaded', function () {
        const isHome = {{ request()->routeIs('home') ? 'true' : 'false' }};
        if (isHome && !sessionStorage.getItem('scheduleShown')) {
            setTimeout(function () {
                new bootstrap.Modal(document.getElementById('scheduleModal')).show();
                sessionStorage.setItem('scheduleShown', '1');
            }, 800);
        }
    });
</script>
@stack('scripts')
</body>
</html>
