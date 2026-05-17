<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('subject', 'আমঘর — AamGhor')</title>
</head>
<body style="margin:0;padding:0;background:#fffdf5;font-family:'Hind Siliguri','Segoe UI',sans-serif;color:#1b4332;">

<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#fffdf5;padding:30px 10px;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"
                   style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 6px 24px rgba(0,0,0,.06);">

                {{-- Header --}}
                <tr>
                    <td align="center" style="background:linear-gradient(135deg,#2F5D2F 0%,#1b4332 100%);padding:30px 20px;">
                        <table role="presentation" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td valign="middle" style="padding-right:12px;">
                                    {{-- Inline SVG (most modern email clients support inline SVG; fallback below) --}}
                                    <div style="width:60px;height:60px;background:#fff;border-radius:50%;padding:6px;display:inline-block;">
                                        @include('partials.logo-mark', ['size' => 48])
                                    </div>
                                </td>
                                <td valign="middle">
                                    <div style="font-family:Georgia,serif;font-weight:800;font-size:28px;line-height:1;">
                                        <span style="color:#F4B128;">Aam</span><span style="color:#ffffff;">Ghor</span>
                                    </div>
                                    <div style="color:#a8d5b5;font-size:12px;margin-top:4px;letter-spacing:1px;">আমঘর • রাজশাহী</div>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                {{-- Subject Title --}}
                @hasSection('heading')
                <tr>
                    <td style="padding:28px 32px 6px;">
                        <h1 style="margin:0;font-size:22px;color:#2F5D2F;font-weight:700;">@yield('heading')</h1>
                    </td>
                </tr>
                @endif

                {{-- Body --}}
                <tr>
                    <td style="padding:20px 32px 30px;font-size:15px;line-height:1.7;color:#333;">
                        @yield('content')
                    </td>
                </tr>

                {{-- CTA fallback --}}
                @hasSection('cta_url')
                <tr>
                    <td align="center" style="padding:0 32px 30px;">
                        <a href="@yield('cta_url')"
                           style="display:inline-block;background:#F4B128;color:#ffffff;padding:14px 32px;
                                  border-radius:30px;text-decoration:none;font-weight:700;font-size:15px;">
                            @yield('cta_label', 'বিস্তারিত দেখুন')
                        </a>
                    </td>
                </tr>
                @endif

                {{-- Footer --}}
                <tr>
                    <td style="background:#fff3cd;padding:24px 32px;border-top:3px solid #F4B128;">
                        <p style="margin:0 0 8px;font-size:13px;color:#2F5D2F;font-weight:700;">
                            📞 01329335577 &nbsp;•&nbsp;
                            <a href="https://wa.me/8801797384242" style="color:#25D366;text-decoration:none;">💬 WhatsApp 01797384242</a>
                        </p>
                        <p style="margin:0 0 8px;font-size:13px;color:#2F5D2F;">
                            ✉️ info@aamghor.com
                        </p>
                        <p style="margin:0 0 4px;font-size:12px;color:#6c757d;">
                            🚛 কুরিয়ার পার্টনার: Sundarban • AJR • Janani • SA Paribahan
                        </p>
                        <p style="margin:0;font-size:12px;color:#6c757d;">
                            ডেলিভারি: ঢাকার ভিতরে ৭৫–৮০৳/কেজি • ঢাকার বাইরে ৯০৳/কেজি
                        </p>
                    </td>
                </tr>

                {{-- Brand Footer --}}
                <tr>
                    <td align="center" style="background:#1b4332;padding:18px;">
                        <p style="margin:0;font-size:11px;color:#a8d5b5;">
                            &copy; {{ date('Y') }} <span style="color:#F4B128;font-family:Georgia,serif;font-weight:700;">AamGhor</span> — রাজশাহীর স্বাদ আপনার দরজায়
                        </p>
                        <p style="margin:6px 0 0;font-size:10px;color:#6c757d;">
                            আপনি এই ইমেইল পেয়েছেন কারণ আপনি আমঘর-এ অ্যাকাউন্ট খুলেছেন।
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
