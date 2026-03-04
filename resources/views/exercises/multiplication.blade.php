@extends('layouts.app')

@section('title')
Multiplication Table &times; {{ $number }}
@endsection

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/exercises"><i class="fas fa-flask me-1"></i>Exercises</a></li>
        <li class="breadcrumb-item active">Multiplication Table</li>
    </ol>
</nav>

<div class="section-head">
    <div class="eyebrow">Exercise 03</div>
    <h1>Multiplication Table &times; {{ $number }}</h1>
    <p>
        Accessed via route parameter:
        <span style="font-family:'JetBrains Mono',monospace;font-size:0.82rem;color:#ff00d0;background:#1c1c26;padding:2px 8px;border-radius:5px">
            /exercises/multiplication/{{ $number }}
        </span>
    </p>
</div>

{{-- Number switcher --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">Switch Number (route parameter)</span>
    </div>
    <div class="lab-card-body">
        <p class="text-muted mb-3" style="font-size:0.85rem">
            Enter a number (1–20) and press Go to navigate to a new URL — demonstrating how
            Laravel route parameters work.
        </p>
        <div class="d-flex gap-2 align-items-center flex-wrap">
            <input type="number" id="numInput" value="{{ $number }}" min="1" max="20"
                   class="input-cyber" style="width:90px">
            <button class="btn-cyber" onclick="goTable()">
                <i class="fas fa-arrow-right me-1"></i> Go
            </button>
            {{-- Quick access buttons --}}
            <div class="d-flex gap-1 flex-wrap ms-2">
                @foreach([2,3,5,7,10,12] as $q)
                    <a href="/exercises/multiplication/{{ $q }}"
                       class="{{ $q == $number ? 'btn-cyber' : 'btn-outline-cyber' }}"
                       style="padding:4px 12px;font-size:0.8rem">{{ $q }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- The table --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">multiplication.blade.php — {{ $number }} &times; 1 through 12</span>
    </div>
    <div class="lab-card-body">
        <div class="mult-wrap">
            <table class="mult-table">
                <thead>
                    <tr>
                        <th>×</th>
                        @foreach(range(1, 12) as $col)
                            <th>{{ $col }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>{{ $number }}</th>
                        @foreach(range(1, 12) as $col)
                            <td class="result-cell">{{ $number * $col }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Full grid: 1–12 × 1–12 with the chosen number highlighted --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">Full grid (1–12) with {{ $number }} highlighted</span>
    </div>
    <div class="lab-card-body">
        <div class="mult-wrap">
            <table class="mult-table">
                <thead>
                    <tr>
                        <th style="background:var(--surface2);color:var(--muted)">×</th>
                        @foreach(range(1, 12) as $col)
                            <th style="{{ $col == $number ? 'background:linear-gradient(135deg,#00f0ff,#ff00d0);color:#000' : '' }}">
                                {{ $col }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach(range(1, 12) as $row)
                        <tr>
                            <th style="{{ $row == $number ? 'background:linear-gradient(135deg,#00f0ff,#ff00d0);color:#000' : '' }}">
                                {{ $row }}
                            </th>
                            @foreach(range(1, 12) as $col)
                                @if($row == $number || $col == $number)
                                    <td class="result-cell">{{ $row * $col }}</td>
                                @else
                                    <td>{{ $row * $col }}</td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Code explanation --}}
<div class="lab-card mb-4">
    <div class="lab-card-header">
        <div class="dot red"></div>
        <div class="dot yellow"></div>
        <div class="dot green"></div>
        <span class="tab-label">How it works — Route parameter</span>
    </div>
    <div class="lab-card-body">
        <div class="info-box mb-3">
            <i class="fas fa-route me-1" style="color:#00f0ff"></i>
            In <code>web.php</code>, the route captures <code>{number}</code> from the URL and
            validates it with <code>->where('number', '[0-9]+')</code> to ensure only digits are accepted —
            a basic but important <strong>input validation</strong> technique.
        </div>
        <pre style="background:var(--surface2);border:1px solid var(--border);border-radius:10px;padding:1.25rem;overflow-x:auto;margin:0"><code style="font-family:'JetBrains Mono',monospace;font-size:0.82rem;color:#dde8ff"><span style="color:#6a7a9a">// web.php</span>
Route::get('/exercises/multiplication/{number}', function ($number) {
    $number = max(1, min(20, (int)$number)); <span style="color:#6a7a9a">// clamp 1–20</span>
    return view('exercises.multiplication', compact('number'));
})->where('number', '[0-9]+'); <span style="color:#6a7a9a">// only digits allowed</span>

<span style="color:#6a7a9a">// multiplication.blade.php</span>
@<!---->foreach(range(1, 12) as $col)
    &lt;td&gt;&#123;&#123; $number * $col &#125;&#125;&lt;/td&gt;
@<!---->endforeach</code></pre>
    </div>
</div>

{{-- Security note --}}
<div class="info-box mb-4">
    <i class="fas fa-shield-halved me-1" style="color:#00f0ff"></i>
    <strong style="color:#00f0ff">Web Security Note:</strong>
    Always validate and sanitise route parameters. The <code>->where()</code>
    constraint rejects non-numeric input before it reaches your code.
    Never trust user-supplied data — even from a URL segment.
</div>

{{-- Navigation --}}
<div class="d-flex justify-content-between align-items-center">
    <a href="/exercises/prime-numbers" class="btn-outline-cyber">
        <i class="fas fa-arrow-left me-1"></i> Prime Numbers
    </a>
    <a href="/exercises" class="btn-cyber">
        <i class="fas fa-flask me-1"></i> All Exercises
    </a>
</div>

@endsection

@push('scripts')
<script>
function goTable() {
    const n = parseInt(document.getElementById('numInput').value) || {{ $number }};
    const safe = Math.min(Math.max(n, 1), 20);
    window.location.href = '/exercises/multiplication/' + safe;
}
document.getElementById('numInput').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') goTable();
});
</script>
@endpush
