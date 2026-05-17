@extends('emails.layout')

@section('subject', 'অর্ডার নিশ্চিতকরণ — আমঘর')
@section('heading', '🎉 ধন্যবাদ! আপনার অর্ডার নিশ্চিত হয়েছে')

@section('content')
    <p>প্রিয় <strong>{{ $order->user->name ?? 'গ্রাহক' }}</strong>,</p>

    <p>আপনার অর্ডারটি আমরা গ্রহণ করেছি। শীঘ্রই আমাদের প্রতিনিধি আপনার সাথে যোগাযোগ করবেন।</p>

    <table width="100%" cellpadding="10" cellspacing="0" border="0"
           style="background:#f0faf4;border-radius:12px;margin:16px 0;">
        <tr>
            <td style="font-size:13px;color:#2F5D2F;">
                <strong>অর্ডার নম্বর:</strong> #{{ $order->id ?? 'XXXX' }}<br>
                <strong>মোট পরিমাণ:</strong> ৳{{ number_format($order->total ?? 0, 0) }}<br>
                <strong>অর্ডারের তারিখ:</strong> {{ optional($order->created_at ?? now())->format('d M Y') }}
            </td>
        </tr>
    </table>

    <p style="font-size:13px;color:#6c757d;">
        🌿 ১০০% গাছে পাকা • ✅ কার্বাইড মুক্ত • 🚚 সারা বাংলাদেশে ডেলিভারি
    </p>
@endsection

@section('cta_url', url('/orders/' . ($order->id ?? '')))
@section('cta_label', '📦 অর্ডার ট্র্যাক করুন')
