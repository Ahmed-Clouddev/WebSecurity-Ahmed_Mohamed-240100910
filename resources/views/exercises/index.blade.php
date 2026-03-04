@extends('layouts.app')

@section('title', 'Exercises')

@section('content')

<div class="section-head">
    <div class="eyebrow"><i class="fas fa-flask me-1"></i> Lab</div>
    <h1>PHP &amp; Blade Exercises</h1>
    <p>Three hands-on exercises to practice Blade templating, PHP logic, and dynamic routing.</p>
</div>

<!-- ── Exercise Cards ── -->
<div class="row g-4 mb-5">

    {{-- Exercise 1: Even Numbers --}}
    <div class="col-md-4">
        <a href="/exercises/even-numbers" class="ex-card">
            <div class="ex-icon">🔢</div>
            <div class="ex-num">Exercise 01</div>
            <div class="ex-title">Even Numbers</div>
            <div class="ex-desc">
                Loop through numbers 1–100 and highlight even numbers using a
                <code style="font-size:0.78rem;color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:4px">@@if</code>
                condition inside a
                <code style="font-size:0.78rem;color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:4px">@@foreach</code>
                loop.
            </div>
            <div class="ex-tags">
                <span class="ex-tag">@@foreach</span>
                <span class="ex-tag">@@if</span>
                <span class="ex-tag">Modulus %</span>
            </div>
            <div class="ex-arrow"><i class="fas fa-arrow-right me-1"></i>Start Exercise</div>
        </a>
    </div>

    {{-- Exercise 2: Prime Numbers --}}
    <div class="col-md-4">
        <a href="/exercises/prime-numbers" class="ex-card">
            <div class="ex-icon">🧮</div>
            <div class="ex-num">Exercise 02</div>
            <div class="ex-title">Prime Numbers</div>
            <div class="ex-desc">
                Write an <code style="font-size:0.78rem;color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:4px">isPrime()</code>
                function and use it inside a Blade view — called inside
                <code style="font-size:0.78rem;color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:4px">@@if</code> — to highlight all primes 1–100.
            </div>
            <div class="ex-tags">
                <span class="ex-tag">Functions</span>
                <span class="ex-tag">@@php</span>
                <span class="ex-tag">Loops</span>
            </div>
            <div class="ex-arrow"><i class="fas fa-arrow-right me-1"></i>Start Exercise</div>
        </a>
    </div>

    {{-- Exercise 3: Multiplication Table --}}
    <div class="col-md-4">
        <a href="/exercises/multiplication/5" class="ex-card">
            <div class="ex-icon">✖️</div>
            <div class="ex-num">Exercise 03</div>
            <div class="ex-title">Multiplication Table</div>
            <div class="ex-desc">
                Pass a number through the URL route parameter and display its
                full multiplication table — demonstrating dynamic routing in Laravel.
            </div>
            <div class="ex-tags">
                <span class="ex-tag">Route Params</span>
                <span class="ex-tag">Dynamic URL</span>
                <span class="ex-tag">Tables</span>
            </div>
            <div class="ex-arrow"><i class="fas fa-arrow-right me-1"></i>Start Exercise</div>
        </a>
    </div>

</div>

{{-- ── Quick Launch: Multiplication ── --}}
<div class="lab-card mb-5">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">Quick Launch — Exercise 03</span>
    </div>
    <div class="lab-card-body">
        <p class="text-muted mb-3" style="font-size:0.88rem;">
            Enter any number below to jump straight to its multiplication table.
            This exercises Laravel route parameters: <code style="font-size:0.8rem;color:#ff00d0;background:#1c1c26;padding:1px 6px;border-radius:4px">/exercises/multiplication/{number}</code>
        </p>
        <form action="#" method="GET" id="multForm" class="d-flex gap-2 align-items-center flex-wrap">
            <input type="number" id="multInput" min="1" max="20" value="5" placeholder="1 – 20"
                   class="input-cyber" style="width:100px">
            <button type="submit" class="btn-cyber" onclick="goMult(event)">
                <i class="fas fa-arrow-right me-1"></i> View Table
            </button>
        </form>
    </div>
</div>

{{-- ── Learning notes ── --}}
<div class="row g-3">
    <div class="col-md-4">
        <div class="info-box">
            <div style="font-weight:700;margin-bottom:0.4rem;color:#00f0ff"><i class="fas fa-lightbulb me-1"></i>Blade Directives</div>
            Use <code>@@foreach</code>, <code>@@if</code>, <code>@@php</code>
            instead of raw PHP tags inside Blade views. Cleaner, safer, and more readable.
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <div style="font-weight:700;margin-bottom:0.4rem;color:#00f0ff"><i class="fas fa-route me-1"></i>Route Parameters</div>
            Define dynamic segments with <code>/route/{param}</code> in
            <code>web.php</code> and receive them as function arguments in the closure or controller.
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <div style="font-weight:700;margin-bottom:0.4rem;color:#00f0ff"><i class="fas fa-shield-halved me-1"></i>Input Validation</div>
            Always validate route parameters! Use <code>->where()</code> constraints and
            cast types to prevent unexpected input — a key web security habit.
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function goMult(e) {
    e.preventDefault();
    const n = parseInt(document.getElementById('multInput').value) || 5;
    const safe = Math.min(Math.max(n, 1), 20);
    window.location.href = '/exercises/multiplication/' + safe;
}
</script>
@endpush
