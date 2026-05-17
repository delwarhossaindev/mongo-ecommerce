@php
    $size      = $size      ?? 48;
    $textSize  = $textSize  ?? '1.25rem';
    $subSize   = $subSize   ?? '.7rem';
    $showSub   = $showSub   ?? true;
@endphp
<span class="d-inline-flex align-items-center gap-2">
    @include('partials.logo-mark', ['size' => $size])
    <span class="d-flex flex-column lh-1">
        <span style="font-weight:800;font-family:Georgia,serif;font-size:{{ $textSize }};">
            <span style="color:#F4B128;">Aam</span><span style="color:#2F5D2F;">Ghor</span>
        </span>
        @if($showSub)
            <small style="font-size:{{ $subSize }};color:#2F5D2F;letter-spacing:1px;font-weight:600;">আমঘর • রাজশাহী</small>
        @endif
    </span>
</span>
