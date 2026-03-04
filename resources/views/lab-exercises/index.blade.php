@extends('layouts.app')

@section('title', 'Lab Exercises')

@section('content')

<div class="section-head">
    <p class="eyebrow">Lab</p>
    <h1><i class="fas fa-microscope me-2"></i>Lab Exercises</h1>
    <p>Three practical web-development exercises — each one covers a different real-world pattern.</p>
</div>

<div class="row g-4">

    {{-- MiniTest --}}
    <div class="col-md-4">
        <a href="/lab-exercises/mini-test" class="ex-card">
            <div class="ex-icon">🧾</div>
            <div class="ex-num">Lab Exercise 01</div>
            <div class="ex-title">Supermarket Bill (MiniTest)</div>
            <div class="ex-desc">
                Display a formatted supermarket receipt table. Bill data is passed from the route,
                including itemised products, quantities, prices, tax, and discount.
            </div>
            <div class="ex-tags">
                <span class="ex-tag">Blade</span>
                <span class="ex-tag">Bootstrap Table</span>
                <span class="ex-tag">Arithmetic</span>
            </div>
            <div class="ex-arrow"><i class="fas fa-arrow-right me-1"></i>Open exercise</div>
        </a>
    </div>

    {{-- Transcript --}}
    <div class="col-md-4">
        <a href="/lab-exercises/transcript" class="ex-card">
            <div class="ex-icon">🎓</div>
            <div class="ex-num">Lab Exercise 02</div>
            <div class="ex-title">Student Transcript</div>
            <div class="ex-desc">
                Render a full academic transcript. Courses and grade data are passed as an array from the
                route and displayed in a styled Bootstrap table with GPA calculation.
            </div>
            <div class="ex-tags">
                <span class="ex-tag">Blade</span>
                <span class="ex-tag">Arrays</span>
                <span class="ex-tag">GPA Calc</span>
            </div>
            <div class="ex-arrow"><i class="fas fa-arrow-right me-1"></i>Open exercise</div>
        </a>
    </div>

    {{-- Products --}}
    <div class="col-md-4">
        <a href="/lab-exercises/products" class="ex-card">
            <div class="ex-icon">🛒</div>
            <div class="ex-num">Lab Exercise 03</div>
            <div class="ex-title">Product Catalog</div>
            <div class="ex-desc">
                Build a responsive product catalog with name, image, price, description, and an
                "Add to Cart" button. All product data is passed as an array from the route.
            </div>
            <div class="ex-tags">
                <span class="ex-tag">Blade</span>
                <span class="ex-tag">Bootstrap Cards</span>
                <span class="ex-tag">Arrays</span>
            </div>
            <div class="ex-arrow"><i class="fas fa-arrow-right me-1"></i>Open exercise</div>
        </a>
    </div>

</div>

@endsection
