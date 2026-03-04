@extends('layouts.app')

@section('title', 'Student Transcript')

@push('styles')
<style>
    .transcript-card {
        background: var(--surface);
        border: 1px solid var(--border);
        border-radius: 16px;
        overflow: hidden;
        max-width: 860px;
        margin: 0 auto;
    }

    /* University header */
    .trans-header {
        background: linear-gradient(135deg, rgba(0,240,255,0.1) 0%, rgba(124,255,203,0.06) 100%);
        border-bottom: 1px solid var(--border);
        padding: 2rem 2rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }
    .uni-logo {
        width: 64px; height: 64px;
        background: linear-gradient(135deg, var(--cyan), #7cffcb);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        flex-shrink: 0;
    }
    .uni-info h2 {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--cyan);
        margin: 0 0 2px;
    }
    .uni-info p {
        color: var(--muted);
        font-size: 0.82rem;
        margin: 0;
    }
    .trans-title {
        margin-left: auto;
        text-align: right;
    }
    .trans-title h3 {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1rem;
        font-weight: 700;
        color: var(--text);
        margin: 0 0 2px;
        text-transform: uppercase;
        letter-spacing: 2px;
    }
    .trans-title p {
        color: var(--muted);
        font-size: 0.8rem;
        margin: 0;
    }

    /* Student info grid */
    .student-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 0;
        border-bottom: 1px solid var(--border);
    }
    .info-cell {
        padding: 0.9rem 1.5rem;
        border-right: 1px solid var(--border);
        font-size: 0.83rem;
    }
    .info-cell:last-child { border-right: none; }
    .info-cell .label {
        color: var(--muted);
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-family: 'JetBrains Mono', monospace;
        display: block;
        margin-bottom: 4px;
    }
    .info-cell .value { color: var(--text); font-weight: 600; }

    /* Transcript table */
    .trans-body { padding: 1.75rem 2rem; }
    .trans-table { width: 100%; border-collapse: collapse; }
    .trans-table thead th {
        background: var(--surface2);
        color: var(--muted);
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.72rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        padding: 0.7rem 1rem;
        border-bottom: 1px solid var(--border);
    }
    .trans-table tbody tr { transition: background 0.15s; }
    .trans-table tbody tr:hover { background: rgba(255,255,255,0.025); }
    .trans-table tbody td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid rgba(255,255,255,0.04);
        font-size: 0.88rem;
        color: var(--text);
    }
    .trans-table td.code-col {
        font-family: 'JetBrains Mono', monospace;
        color: var(--cyan);
        font-size: 0.82rem;
    }
    .grade-badge {
        display: inline-block;
        padding: 3px 12px;
        border-radius: 6px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.82rem;
        font-weight: 700;
    }
    .grade-a  { background: rgba(57,255,20,0.12);  color: #39ff14; border: 1px solid rgba(57,255,20,0.3); }
    .grade-b  { background: rgba(0,240,255,0.10);  color: #00f0ff; border: 1px solid rgba(0,240,255,0.25); }
    .grade-c  { background: rgba(254,188,46,0.10); color: #febc2e; border: 1px solid rgba(254,188,46,0.25); }
    .grade-d  { background: rgba(255,95,87,0.10);  color: #ff5f57; border: 1px solid rgba(255,95,87,0.25); }
    .grade-f  { background: rgba(255,0,0,0.12);    color: #ff3333; border: 1px solid rgba(255,0,0,0.3); }

    /* GPA summary */
    .gpa-strip {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }
    .gpa-box {
        flex: 1;
        min-width: 130px;
        background: var(--surface2);
        border: 1px solid var(--border);
        border-radius: 10px;
        padding: 1rem 1.25rem;
        text-align: center;
    }
    .gpa-box .gpa-val {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--cyan);
        display: block;
    }
    .gpa-box .gpa-lbl {
        font-size: 0.7rem;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 1.5px;
        display: block;
        margin-top: 4px;
    }
    .gpa-box.highlight-box {
        border-color: rgba(0,240,255,0.3);
        background: rgba(0,240,255,0.05);
    }
    .gpa-box.highlight-box .gpa-val { font-size: 2rem; }

    .standing-badge {
        display: inline-block;
        margin-top: 0.5rem;
        padding: 4px 14px;
        border-radius: 999px;
        font-size: 0.75rem;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 700;
    }
    .standing-excellent { background: rgba(57,255,20,0.12); color: #39ff14; border: 1px solid rgba(57,255,20,0.3); }
    .standing-good      { background: rgba(0,240,255,0.10); color: #00f0ff; border: 1px solid rgba(0,240,255,0.25); }
    .standing-average   { background: rgba(254,188,46,0.10);color: #febc2e; border: 1px solid rgba(254,188,46,0.25); }
    .standing-poor      { background: rgba(255,95,87,0.10); color: #ff5f57; border: 1px solid rgba(255,95,87,0.25); }
</style>
@endpush

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/lab-exercises">Lab Exercises</a></li>
        <li class="breadcrumb-item active">Transcript</li>
    </ol>
</nav>

{{-- Section header --}}
<div class="section-head">
    <p class="eyebrow">Lab Exercise 02</p>
    <h1><i class="fas fa-graduation-cap me-2"></i>Student Transcript</h1>
    <p>Academic transcript generated from arrays passed directly out of the route / controller.</p>
</div>

{{-- Transcript card --}}
<div class="transcript-card">

    {{-- University header --}}
    <div class="trans-header">
        <div class="uni-logo">🎓</div>
        <div class="uni-info">
            <h2>Laravel University</h2>
            <p>Faculty of Computer Science &amp; Engineering</p>
            <p>Official Academic Transcript &mdash; Confidential</p>
        </div>
        <div class="trans-title">
            <h3>Transcript</h3>
            <p>{{ $student['semester'] }}</p>
        </div>
    </div>

    {{-- Student info row --}}
    <div class="student-info-grid">
        <div class="info-cell">
            <span class="label">Student Name</span>
            <span class="value">{{ $student['name'] }}</span>
        </div>
        <div class="info-cell">
            <span class="label">Student ID</span>
            <span class="value" style="font-family:'JetBrains Mono',monospace;color:var(--cyan)">{{ $student['id'] }}</span>
        </div>
        <div class="info-cell">
            <span class="label">Major</span>
            <span class="value">{{ $student['major'] }}</span>
        </div>
        <div class="info-cell">
            <span class="label">Advisor</span>
            <span class="value">{{ $student['advisor'] }}</span>
        </div>
    </div>

    {{-- Courses table --}}
    <div class="trans-body">
        @php
            $totalCredits  = 0;
            $totalPoints   = 0;
        @endphp

        <table class="trans-table">
            <thead>
                <tr>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th class="text-center">Credits</th>
                    <th class="text-center">Grade</th>
                    <th class="text-center">Points</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    @php
                        $totalCredits += $course['credits'];
                        $totalPoints  += $course['credits'] * $course['points'];

                        $gradeClass = match(true) {
                            str_starts_with($course['grade'], 'A') => 'grade-a',
                            str_starts_with($course['grade'], 'B') => 'grade-b',
                            str_starts_with($course['grade'], 'C') => 'grade-c',
                            str_starts_with($course['grade'], 'D') => 'grade-d',
                            default                                 => 'grade-f',
                        };
                    @endphp
                    <tr>
                        <td class="code-col">{{ $course['code'] }}</td>
                        <td>{{ $course['name'] }}</td>
                        <td class="text-center">{{ $course['credits'] }}</td>
                        <td class="text-center">
                            <span class="grade-badge {{ $gradeClass }}">{{ $course['grade'] }}</span>
                        </td>
                        <td class="text-center" style="font-family:'JetBrains Mono',monospace">
                            {{ number_format($course['points'], 1) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- GPA strip --}}
        @php
            $gpa = $totalCredits > 0 ? $totalPoints / $totalCredits : 0;
            $standing = match(true) {
                $gpa >= 3.7 => ['label' => 'Excellent', 'class' => 'standing-excellent'],
                $gpa >= 3.0 => ['label' => 'Good Standing', 'class' => 'standing-good'],
                $gpa >= 2.0 => ['label' => 'Satisfactory', 'class' => 'standing-average'],
                default     => ['label' => 'Academic Probation', 'class' => 'standing-poor'],
            };
        @endphp

        <div class="gpa-strip">
            <div class="gpa-box">
                <span class="gpa-val">{{ $totalCredits }}</span>
                <span class="gpa-lbl">Total Credits</span>
            </div>
            <div class="gpa-box">
                <span class="gpa-val">{{ count($courses) }}</span>
                <span class="gpa-lbl">Courses Taken</span>
            </div>
            <div class="gpa-box highlight-box" style="flex:2">
                <span class="gpa-val">{{ number_format($gpa, 2) }} / 4.00</span>
                <span class="gpa-lbl">Cumulative GPA</span>
                <span class="standing-badge {{ $standing['class'] }}">{{ $standing['label'] }}</span>
            </div>
        </div>
    </div>

</div>

{{-- Back link --}}
<div class="text-center mt-4">
    <a href="/lab-exercises" class="btn-outline-cyber">
        <i class="fas fa-arrow-left me-2"></i>Back to Lab Exercises
    </a>
</div>

@endsection
