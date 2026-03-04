@extends('layouts.app')

@section('title', 'Even Numbers')

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/exercises"><i class="fas fa-flask me-1"></i>Exercises</a></li>
        <li class="breadcrumb-item active">Even Numbers</li>
    </ol>
</nav>

<div class="section-head">
    <div class="eyebrow">Exercise 01</div>
    <h1>Even Numbers</h1>
    <p>Numbers 1–100 — even numbers are highlighted, odd numbers are dimmed.</p>
</div>

{{-- Stats --}}
@php $evenCount = 0; $oddCount = 0;
     foreach(range(1,100) as $n){ $n%2==0 ? $evenCount++ : $oddCount++; } @endphp

<div class="stats-row">
    <div class="stat-box">
        <div class="stat-val">100</div>
        <div class="stat-lbl">Total numbers</div>
    </div>
    <div class="stat-box">
        <div class="stat-val" style="color:#00ccff">{{ $evenCount }}</div>
        <div class="stat-lbl">Even</div>
    </div>
    <div class="stat-box">
        <div class="stat-val" style="color:#6a7a9a">{{ $oddCount }}</div>
        <div class="stat-lbl">Odd</div>
    </div>
</div>

{{-- Legend --}}
<div class="legend">
    <div class="legend-item">
        <div class="legend-swatch swatch-even"></div> Even number
    </div>
    <div class="legend-item">
        <div class="legend-swatch swatch-dim"></div> Odd number
    </div>
</div>

{{-- Number grid --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">even-numbers.blade.php</span>
    </div>
    <div class="lab-card-body">
        <div>
            @foreach (range(1, 100) as $i)
                @if($i % 2 == 0)
                    <span class="num-badge highlight">{{ $i }}</span>
                @else
                    <span class="num-badge dim">{{ $i }}</span>
                @endif
            @endforeach
        </div>
    </div>
</div>

{{-- Code explanation --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">How it works</span>
    </div>
    <div class="lab-card-body">
        <div class="info-box mb-3">
            <i class="fas fa-lightbulb me-1" style="color:#febc2e"></i>
            The <strong>modulus operator</strong> <code>%</code> returns the remainder of a division.
            If <code>$i % 2 == 0</code>, there is no remainder, meaning the number is divisible by 2 — i.e. it is <strong>even</strong>.
        </div>
        <pre style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:1.25rem;overflow-x:auto;margin:0"><code style="font-family:'JetBrains Mono',monospace;font-size:0.82rem;color:#dde8ff">@verbatim
@foreach (range(1, 100) as $i)
    @if($i % 2 == 0)
        &lt;span class="badge bg-primary"&gt;{{ $i }}&lt;/span&gt;   {{-- even --}}
    @else
        &lt;span class="badge bg-secondary"&gt;{{ $i }}&lt;/span&gt;  {{-- odd --}}
    @endif
@endforeach
@endverbatim</code></pre>
    </div>
</div>

{{-- Navigation --}}
<div class="d-flex justify-content-between align-items-center">
    <a href="/exercises" class="btn-outline-cyber">
        <i class="fas fa-arrow-left me-1"></i> All Exercises
    </a>
    <a href="/exercises/prime-numbers" class="btn-cyber">
        Next: Prime Numbers <i class="fas fa-arrow-right ms-1"></i>
    </a>
</div>

@endsection
