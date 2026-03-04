@extends('layouts.app')

@section('title', 'Prime Numbers')

@section('content')

@php
/**
 * isPrime — checks whether a given integer is prime.
 * A prime number is greater than 1 and divisible only by 1 and itself.
 */
function isPrime(int $number): bool
{
    if ($number <= 1) return false;
    if ($number === 2) return true;
    if ($number % 2 === 0) return false;
    // Only check divisors up to √number for efficiency
    $limit = (int) sqrt($number);
    for ($i = 3; $i <= $limit; $i += 2) {
        if ($number % $i === 0) return false;
    }
    return true;
}

// Pre-calculate stats
$primeCount    = 0;
$notPrimeCount = 0;
foreach (range(1, 100) as $n) {
    isPrime($n) ? $primeCount++ : $notPrimeCount++;
}
@endphp

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/exercises"><i class="fas fa-flask me-1"></i>Exercises</a></li>
        <li class="breadcrumb-item active">Prime Numbers</li>
    </ol>
</nav>

<div class="section-head">
    <div class="eyebrow">Exercise 02</div>
    <h1>Prime Numbers</h1>
    <p>Numbers 1–100 — prime numbers are highlighted in green, composite numbers are dimmed.</p>
</div>

{{-- Stats --}}
<div class="stats-row">
    <div class="stat-box">
        <div class="stat-val">100</div>
        <div class="stat-lbl">Total numbers</div>
    </div>
    <div class="stat-box">
        <div class="stat-val" style="color:#39ff14">{{ $primeCount }}</div>
        <div class="stat-lbl">Prime</div>
    </div>
    <div class="stat-box">
        <div class="stat-val" style="color:#6a7a9a">{{ $notPrimeCount }}</div>
        <div class="stat-lbl">Not prime</div>
    </div>
</div>

{{-- Legend --}}
<div class="legend">
    <div class="legend-item">
        <div class="legend-swatch swatch-prime"></div> Prime
    </div>
    <div class="legend-item">
        <div class="legend-swatch swatch-dim"></div> Not prime
    </div>
</div>

{{-- Number grid --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">prime-numbers.blade.php</span>
    </div>
    <div class="lab-card-body">
        <div>
            @foreach (range(1, 100) as $i)
                @if(isPrime($i))
                    <span class="num-badge prime-highlight" title="{{ $i }} is prime">{{ $i }}</span>
                @else
                    <span class="num-badge dim">{{ $i }}</span>
                @endif
            @endforeach
        </div>
    </div>
</div>

{{-- Primes list summary --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">All primes between 1 and 100</span>
    </div>
    <div class="lab-card-body" style="font-family:'JetBrains Mono',monospace;font-size:0.88rem;color:#7cffcb;letter-spacing:0.5px">
        @foreach(range(1, 100) as $i)
            @if(isPrime($i))
                {{ $i }}@if(!$loop->last),&nbsp;@endif
            @endif
        @endforeach
    </div>
</div>

{{-- Code explanation --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">How it works — isPrime() function</span>
    </div>
    <div class="lab-card-body">
        <div class="info-box mb-3">
            <i class="fas fa-lightbulb me-1" style="color:#febc2e"></i>
            A <strong>prime number</strong> is only divisible by 1 and itself.
            The optimised approach checks divisors only up to <code>√n</code> (square root of n),
            which is much faster than checking up to <code>n−1</code>.
            We also skip all even divisors after checking for 2.
        </div>
        <pre style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:1.25rem;overflow-x:auto;margin:0"><code style="font-family:'JetBrains Mono',monospace;font-size:0.82rem;color:#dde8ff">@verbatim
@php
function isPrime(int $number): bool
{
    if ($number <= 1) return false;   // 0 and 1 are not prime
    if ($number === 2) return true;    // 2 is the only even prime
    if ($number % 2 === 0) return false; // skip other evens

    $limit = (int) sqrt($number);     // only check up to √n
    for ($i = 3; $i <= $limit; $i += 2) {
        if ($number % $i === 0) return false;
    }
    return true;
}
@endphp

@foreach (range(1, 100) as $i)
    @if(isPrime($i))
        &lt;span class="badge bg-success"&gt;{{ $i }}&lt;/span&gt;
    @else
        &lt;span class="badge bg-secondary"&gt;{{ $i }}&lt;/span&gt;
    @endif
@endforeach
@endverbatim</code></pre>
    </div>
</div>

{{-- Security note --}}
<div class="info-box mb-4">
    <i class="fas fa-shield-halved me-1" style="color:#00f0ff"></i>
    <strong style="color:#00f0ff">Web Security Note:</strong>
    Prime numbers are fundamental to modern cryptography. RSA encryption — used to
    secure HTTPS connections — relies on the mathematical difficulty of factoring large
    numbers that are products of two primes.
</div>

{{-- Navigation --}}
<div class="d-flex justify-content-between align-items-center">
    <a href="/exercises/even-numbers" class="btn-outline-cyber">
        <i class="fas fa-arrow-left me-1"></i> Even Numbers
    </a>
    <a href="/exercises/multiplication/5" class="btn-cyber">
        Next: Multiplication Table <i class="fas fa-arrow-right ms-1"></i>
    </a>
</div>

@endsection
