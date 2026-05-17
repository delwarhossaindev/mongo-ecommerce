<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'ত্রুটি') — আমঘর</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Hind Siliguri', 'Segoe UI', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #fffdf5 0%, #fff3cd 100%);
            display: flex; flex-direction: column;
            align-items: center; justify-content: center;
            padding: 20px; color: #1b4332;
        }
        .err-card {
            background: #fff; border-radius: 20px; padding: 40px 30px;
            max-width: 520px; width: 100%; text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,.08);
            border-top: 6px solid #F4B128;
        }
        .err-logo { margin-bottom: 16px; }
        .err-code {
            font-family: Georgia, serif; font-size: 5rem; font-weight: 800;
            line-height: 1; margin: 12px 0 6px;
            background: linear-gradient(135deg, #F4B128 0%, #2F5D2F 100%);
            -webkit-background-clip: text; background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .err-emoji { font-size: 3rem; margin: 10px 0; }
        .err-title { font-size: 1.5rem; font-weight: 700; color: #2F5D2F; margin-bottom: 10px; }
        .err-msg { color: #6c757d; margin-bottom: 24px; line-height: 1.6; }
        .err-actions { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
        .err-btn {
            display: inline-block; padding: 10px 22px; border-radius: 30px;
            font-weight: 600; text-decoration: none; transition: transform .15s, box-shadow .15s;
            font-size: .95rem;
        }
        .err-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 16px rgba(0,0,0,.12); }
        .err-btn-primary { background: #2F5D2F; color: #fff; }
        .err-btn-outline { background: #fff; color: #2F5D2F; border: 2px solid #2F5D2F; }
        .err-btn-wa { background: #25D366; color: #fff; }
        .err-brand { margin-top: 24px; font-size: .8rem; color: #6c757d; }
        .err-brand a { color: #F4B128; font-weight: 700; text-decoration: none; font-family: Georgia, serif; }
    </style>
</head>
<body>
    <div class="err-card">
        <div class="err-logo">
            @include('partials.logo-mark', ['size' => 80])
        </div>
        <div class="err-code">@yield('code')</div>
        <div class="err-emoji">@yield('emoji', '🥭')</div>
        <h1 class="err-title">@yield('heading')</h1>
        <p class="err-msg">@yield('message')</p>
        <div class="err-actions">
            <a href="{{ url('/') }}" class="err-btn err-btn-primary">🏠 হোমে ফিরুন</a>
            <a href="tel:01329335577" class="err-btn err-btn-outline">📞 01329335577</a>
            <a href="https://wa.me/8801797384242" target="_blank" rel="noopener" class="err-btn err-btn-wa">💬 WhatsApp</a>
        </div>
        <div class="err-brand">
            <a href="{{ url('/') }}">AamGhor</a> — রাজশাহীর স্বাদ আপনার দরজায়
        </div>
    </div>
</body>
</html>
