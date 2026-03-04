@extends('layouts.app')

@section('title', 'Product Catalog')

@push('styles')
<style>
    /* ── Product card ── */
    .product-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: border-color 0.25s, transform 0.25s, box-shadow 0.25s;
    }
    .product-card:hover {
        border-color: rgba(0,240,255,0.3);
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0,240,255,0.08);
    }

    /* Image wrapper */
    .product-img-wrap {
        position: relative;
        height: 210px;
        overflow: hidden;
        background: var(--surface2);
    }
    .product-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }
    .product-card:hover .product-img-wrap img { transform: scale(1.05); }

    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        padding: 3px 12px;
        border-radius: 999px;
        font-size: 0.7rem;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
        background: rgba(0,0,0,0.65);
        border: 1px solid;
        backdrop-filter: blur(6px);
    }

    /* Body */
    .product-body {
        padding: 1.25rem 1.25rem 0.75rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .product-name {
        font-size: 0.97rem;
        font-weight: 700;
        color: var(--text);
        line-height: 1.35;
    }
    .product-desc {
        font-size: 0.82rem;
        color: var(--muted);
        line-height: 1.65;
        flex: 1;
    }
    .product-price {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--cyan);
        margin-top: 0.25rem;
    }
    .product-price small {
        font-size: 0.75rem;
        color: var(--muted);
        font-weight: 400;
    }

    /* Footer / add-to-cart */
    .product-footer {
        padding: 0.9rem 1.25rem 1.25rem;
        border-top: 1px solid var(--border);
    }
    .btn-add-cart {
        width: 100%;
        background: linear-gradient(90deg, var(--cyan), var(--mag));
        color: #000;
        font-weight: 700;
        border: none;
        border-radius: 8px;
        padding: 0.6rem 1rem;
        font-size: 0.875rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: filter 0.2s, transform 0.2s;
        font-family: 'Inter', sans-serif;
        text-decoration: none;
    }
    .btn-add-cart:hover {
        filter: brightness(1.1);
        transform: translateY(-1px);
        color: #000;
    }
    .btn-add-cart:active { transform: scale(0.98); }

    /* Cart counter (demo only) */
    .cart-bar {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 0.75rem 1.25rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        font-size: 0.88rem;
    }
    .cart-count {
        font-family: 'JetBrains Mono', monospace;
        color: var(--cyan);
        font-weight: 700;
        font-size: 1rem;
    }
    #cart-items-count {
        display: inline-block;
        background: var(--cyan);
        color: #000;
        font-weight: 700;
        font-size: 0.75rem;
        padding: 1px 7px;
        border-radius: 999px;
        margin-left: 4px;
        vertical-align: middle;
    }
</style>
@endpush

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/lab-exercises">Lab Exercises</a></li>
        <li class="breadcrumb-item active">Products</li>
    </ol>
</nav>

{{-- Section header --}}
<div class="section-head">
    <p class="eyebrow">Lab Exercise 03</p>
    <h1><i class="fas fa-boxes me-2"></i>Product Catalog</h1>
    <p>A responsive product grid generated from an array passed from the route / controller.</p>
</div>

{{-- Cart bar --}}
<div class="cart-bar">
    <div>
        <i class="fas fa-shopping-cart me-2" style="color:var(--cyan)"></i>
        Shopping Cart &mdash; <span class="cart-count"><span id="cart-items-count">0</span> item(s)</span>
    </div>
    <div style="color:var(--muted);font-size:0.82rem">
        Total: <span id="cart-total" style="font-family:'JetBrains Mono',monospace;color:var(--text);font-weight:700">$0.00</span>
    </div>
</div>

{{-- Products grid --}}
<div class="row g-4">
    @foreach ($products as $product)
        <div class="col-sm-6 col-lg-4">
            <div class="product-card">

                {{-- Image --}}
                <div class="product-img-wrap">
                    <img src="{{ $product['image'] }}"
                         alt="{{ $product['name'] }}"
                         loading="lazy">
                    @if ($product['badge'])
                        <span class="product-badge"
                              style="color: {{ $product['badge_color'] }}; border-color: {{ $product['badge_color'] }}">
                            {{ $product['badge'] }}
                        </span>
                    @endif
                </div>

                {{-- Body --}}
                <div class="product-body">
                    <div class="product-name">{{ $product['name'] }}</div>
                    <div class="product-desc">{{ $product['description'] }}</div>
                    <div class="product-price">
                        ${{ number_format($product['price'], 2) }}
                        <small>USD</small>
                    </div>
                </div>

                {{-- Add to cart --}}
                <div class="product-footer">
                    <button class="btn-add-cart"
                            onclick="addToCart({{ $product['id'] }}, '{{ addslashes($product['name']) }}', {{ $product['price'] }}, this)">
                        <i class="fas fa-cart-plus"></i>
                        Add to Cart
                    </button>
                </div>

            </div>
        </div>
    @endforeach
</div>

{{-- Back link --}}
<div class="text-center mt-5">
    <a href="/lab-exercises" class="btn-outline-cyber">
        <i class="fas fa-arrow-left me-2"></i>Back to Lab Exercises
    </a>
</div>

@endsection

@push('scripts')
<script>
    /* ── Simple in-page cart (no backend needed for this exercise demo) ── */
    const cart = {};

    function addToCart(id, name, price, btn) {
        if (cart[id]) {
            cart[id].qty++;
        } else {
            cart[id] = { name, price, qty: 1 };
        }

        /* Button feedback */
        btn.innerHTML = '<i class="fas fa-check"></i> Added!';
        btn.style.background = 'linear-gradient(90deg,#39ff14,#00f0ff)';
        setTimeout(() => {
            btn.innerHTML = '<i class="fas fa-cart-plus"></i> Add to Cart';
            btn.style.background = '';
        }, 1200);

        updateCartBar();
    }

    function updateCartBar() {
        const totalItems = Object.values(cart).reduce((s, i) => s + i.qty, 0);
        const totalPrice = Object.values(cart).reduce((s, i) => s + i.price * i.qty, 0);
        document.getElementById('cart-items-count').textContent = totalItems;
        document.getElementById('cart-total').textContent = '$' + totalPrice.toFixed(2);
    }
</script>
@endpush
