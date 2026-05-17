<div class="col-6 col-md-4 col-lg-3">
    <div class="card product-card shadow-sm h-100" style="border-radius:12px;overflow:hidden;">
        <a href="{{ route('shop.show', $product->id) }}" title="{{ $product->name }} — অর্ডার করুন">
            @php $images = is_array($product->images) ? $product->images : []; @endphp
            @if(count($images) > 0)
                <img src="{{ $images[0] }}" class="card-img-top product-img"
                     alt="{{ $product->name }} — ৳{{ number_format($product->effective_price, 0) }} | আমঘর"
                     loading="lazy" width="300" height="220">
            @else
                <div class="product-img d-flex align-items-center justify-content-center" style="background:#f0faf4;"
                     role="img" aria-label="{{ $product->name }} (ছবি নেই)">
                    <span style="font-size:4rem;" aria-hidden="true">🥭</span>
                </div>
            @endif
        </a>
        @if($product->is_featured)
            <div class="position-absolute top-0 start-0 m-2">
                <span class="badge" style="background:#f5a623;font-size:.7rem;">⭐ বিশেষ</span>
            </div>
        @endif
        <div class="card-body d-flex flex-column">
            @if($product->category)
                <span class="badge mb-1" style="background:#e8f5e9;color:#2d6a4f;font-size:.7rem;width:fit-content;">{{ $product->category->name }}</span>
            @endif
            <h6 class="card-title mb-1">
                <a href="{{ route('shop.show', $product->id) }}" class="text-decoration-none" style="color:#1b4332;">{{ Str::limit($product->name, 50) }}</a>
            </h6>
            @if($product->short_description)
                <p class="text-muted small mb-1" style="font-size:.78rem;">{{ Str::limit($product->short_description, 60) }}</p>
            @endif
            <div class="mt-auto pt-2">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="price-badge">৳{{ number_format($product->effective_price, 0) }}</span>
                    @if($product->sale_price > 0 && $product->price > $product->sale_price)
                        <span class="original-price">৳{{ number_format($product->price, 0) }}</span>
                        <span class="badge bg-danger" style="font-size:.65rem;">{{ round((1 - $product->sale_price / $product->price) * 100) }}% ছাড়</span>
                    @endif
                </div>
                @if($product->rating > 0)
                    <div class="text-warning small mb-2">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= round($product->rating) ? '-fill' : '' }}"></i>
                        @endfor
                        <span class="text-muted">({{ $product->review_count }})</span>
                    </div>
                @endif
                @if($product->stock > 0)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn btn-sm w-100 fw-semibold" style="background:#2d6a4f;color:#fff;border-radius:8px;">
                            🛒 অর্ডার করুন
                        </button>
                    </form>
                @else
                    <button class="btn btn-secondary btn-sm w-100" disabled>স্টক নেই</button>
                @endif
            </div>
        </div>
    </div>
</div>
