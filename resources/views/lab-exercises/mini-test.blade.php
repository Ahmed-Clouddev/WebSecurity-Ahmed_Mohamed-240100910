@extends('layouts.app')

@section('title', 'MiniTest — Supermarket Bill')

@push('styles')
<style>
    .receipt-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        max-width: 780px;
        margin: 0 auto;
    }
    .receipt-header {
        background: linear-gradient(135deg, rgba(0,240,255,0.12) 0%, rgba(255,0,208,0.08) 100%);
        border-bottom: 1px solid var(--border);
        padding: 2rem 2rem 1.5rem;
        text-align: center;
    }
    .receipt-header .store-name {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--cyan);
        letter-spacing: 3px;
        text-transform: uppercase;
    }
    .receipt-header .store-sub {
        color: var(--muted);
        font-size: 0.82rem;
        margin-top: 4px;
    }
    .receipt-meta {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.5rem;
        padding: 1rem 2rem;
        background: var(--surface2);
        border-bottom: 1px solid var(--border);
        font-size: 0.83rem;
        color: var(--muted);
        font-family: 'JetBrains Mono', monospace;
    }
    .receipt-meta span { color: var(--text); }
    .receipt-body { padding: 1.5rem 2rem 2rem; }

    .bill-table { width: 100%; border-collapse: collapse; }
    .bill-table thead th {
        background: var(--surface2);
        color: var(--muted);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.65rem 0.85rem;
        border-bottom: 1px solid var(--border);
    }
    .bill-table tbody tr { transition: background 0.15s; }
    .bill-table tbody tr:hover { background: rgba(255,255,255,0.03); }
    .bill-table tbody td {
        padding: 0.7rem 0.85rem;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        font-size: 0.88rem;
        color: var(--text);
    }
    .bill-table tbody td.item-name { font-weight: 500; }
    .bill-table tbody td.text-end  { font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; }
    .bill-table .total-row td {
        font-weight: 700;
        color: var(--cyan);
        font-family: 'JetBrains Mono', monospace;
        border-top: 2px solid rgba(0,240,255,0.25);
        border-bottom: none;
        padding-top: 1rem;
    }

    .summary-box {
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1.25rem 1.5rem;
        margin-top: 1.5rem;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.88rem;
        padding: 0.3rem 0;
        color: var(--muted);
    }
    .summary-row span:last-child { font-family: 'JetBrains Mono', monospace; color: var(--text); }
    .summary-row.discount span:last-child { color: #39ff14; }
    .summary-row.tax     span:last-child { color: #febc2e; }
    .summary-row.grand   {
        border-top: 1px solid var(--border);
        margin-top: 0.5rem;
        padding-top: 0.75rem;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text);
    }
    .summary-row.grand span:last-child { color: var(--cyan); font-size: 1.2rem; }

    .receipt-footer {
        text-align: center;
        border-top: 1px dashed rgba(255,255,255,0.1);
        padding: 1.25rem 2rem 1.5rem;
        color: var(--muted);
        font-size: 0.78rem;
        font-family: 'JetBrains Mono', monospace;
        letter-spacing: 1px;
    }
</style>
@endpush

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/lab-exercises">Lab Exercises</a></li>
        <li class="breadcrumb-item active">MiniTest — Supermarket Bill</li>
    </ol>
</nav>

{{-- Header --}}
<div class="section-head">
    <p class="eyebrow">Lab Exercise 01</p>
    <h1><i class="fas fa-receipt me-2"></i>Supermarket Bill</h1>
    <p>A formatted receipt generated from bill data passed directly from the route function.</p>
</div>

{{-- Receipt card --}}
<div class="receipt-card">

    {{-- Store header --}}
    <div class="receipt-header">
        <div class="store-name"><i class="fas fa-shopping-basket me-2"></i>FreshMart</div>
        <div class="store-sub">Your neighbourhood supermarket &bull; Thank you for shopping with us!</div>
    </div>

    {{-- Meta row --}}
    <div class="receipt-meta">
        <div>Customer: <span>{{ $bill['customer'] }}</span></div>
        <div>Invoice: <span>{{ $bill['invoice'] }}</span></div>
        <div>Date: <span>{{ $bill['date'] }}</span></div>
    </div>

    {{-- Items table --}}
    <div class="receipt-body">
        <table class="bill-table">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th>Item</th>
                    <th class="text-center" style="width:80px">Qty</th>
                    <th class="text-end" style="width:110px">Unit Price</th>
                    <th class="text-end" style="width:110px">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach ($bill['items'] as $i => $item)
                    @php
                        $lineTotal = $item['qty'] * $item['price'];
                        $subtotal += $lineTotal;
                    @endphp
                    <tr>
                        <td class="text-muted" style="font-family:'JetBrains Mono',monospace;font-size:0.8rem">
                            {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                        </td>
                        <td class="item-name">{{ $item['name'] }}</td>
                        <td class="text-center">{{ $item['qty'] }}</td>
                        <td class="text-end">${{ number_format($item['price'], 2) }}</td>
                        <td class="text-end">${{ number_format($lineTotal, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="4" class="text-end">SUBTOTAL</td>
                    <td class="text-end">${{ number_format($subtotal, 2) }}</td>
                </tr>
            </tbody>
        </table>

        {{-- Summary --}}
        @php
            $discount   = $bill['discount'];
            $afterDisc  = $subtotal - $discount;
            $tax        = $afterDisc * $bill['tax_rate'];
            $grandTotal = $afterDisc + $tax;
        @endphp
        <div class="summary-box">
            <div class="summary-row">
                <span>Subtotal</span>
                <span>${{ number_format($subtotal, 2) }}</span>
            </div>
            <div class="summary-row discount">
                <span>Discount</span>
                <span>-${{ number_format($discount, 2) }}</span>
            </div>
            <div class="summary-row tax">
                <span>Tax ({{ $bill['tax_rate'] * 100 }}%)</span>
                <span>${{ number_format($tax, 2) }}</span>
            </div>
            <div class="summary-row grand">
                <span>Total</span>
                <span>${{ number_format($grandTotal, 2) }}</span>
            </div>
        </div>
    </div>

    <div class="receipt-footer">
        *** Thank you for shopping at FreshMart — Have a great day! ***
    </div>
</div>

{{-- Back link --}}
<div class="text-center mt-4">
    <a href="/lab-exercises" class="btn-outline-cyber">
        <i class="fas fa-arrow-left me-2"></i>Back to Lab Exercises
    </a>
</div>

@endsection
