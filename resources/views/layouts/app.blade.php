<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Lab') — Laravel Lab</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --bg:       #0b0b10;
            --surface:  #13131a;
            --surface2: #1c1c26;
            --border:   rgba(255,255,255,0.07);
            --cyan:     #00f0ff;
            --mag:      #ff00d0;
            --green:    #39ff14;
            --accent:   #7cffcb;
            --text:     #dde8ff;
            --muted:    #6a7a9a;
        }

        *, *::before, *::after { box-sizing: border-box; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Navbar ── */
        .site-nav {
            background: rgba(10,10,16,0.97) !important;
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        .site-nav .navbar-brand {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1rem;
            font-weight: 700;
            color: var(--cyan) !important;
            letter-spacing: 1px;
        }
        .site-nav .nav-link {
            color: var(--muted) !important;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.4rem 0.9rem !important;
            border-radius: 6px;
            transition: color 0.2s, background 0.2s;
        }
        .site-nav .nav-link:hover {
            color: var(--cyan) !important;
            background: rgba(0,240,255,0.06);
        }
        .site-nav .nav-link.active {
            color: var(--cyan) !important;
            background: rgba(0,240,255,0.1);
        }
        .site-nav .navbar-toggler {
            border-color: var(--border);
        }

        /* ── Page wrap ── */
        .page-wrap {
            flex: 1;
            padding: 2.5rem 0 4rem;
        }

        /* ── Section header ── */
        .section-head {
            margin-bottom: 2rem;
        }
        .section-head .eyebrow {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.72rem;
            letter-spacing: 3px;
            color: var(--mag);
            text-transform: uppercase;
            margin-bottom: 0.4rem;
        }
        .section-head h1 {
            font-size: 1.9rem;
            font-weight: 700;
            color: var(--cyan);
            margin-bottom: 0.4rem;
        }
        .section-head p {
            color: var(--muted);
            font-size: 0.92rem;
            margin: 0;
        }

        /* ── Breadcrumb ── */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin-bottom: 1.5rem;
            font-size: 0.82rem;
        }
        .breadcrumb-item a {
            color: var(--cyan);
            text-decoration: none;
        }
        .breadcrumb-item a:hover { text-decoration: underline; }
        .breadcrumb-item.active { color: var(--muted); }
        .breadcrumb-item + .breadcrumb-item::before { color: var(--muted); }

        /* ── Lab card (exercise container) ── */
        .lab-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }
        .lab-card > .lab-card-header {
            background: var(--surface2);
            border-bottom: 1px solid var(--border);
            padding: 0.75rem 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .lab-card > .lab-card-header .dot {
            width: 10px; height: 10px; border-radius: 50%;
        }
        .lab-card > .lab-card-header .dot.red   { background: #ff5f57; }
        .lab-card > .lab-card-header .dot.yellow { background: #febc2e; }
        .lab-card > .lab-card-header .dot.green  { background: #28c840; }
        .lab-card > .lab-card-header .tab-label {
            margin-left: 0.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            color: var(--muted);
        }
        .lab-card > .lab-card-body {
            padding: 1.75rem;
        }

        /* ── Exercise index cards ── */
        .ex-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 14px;
            padding: 1.75rem 1.5rem;
            text-decoration: none;
            color: var(--text);
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            transition: border-color 0.25s, transform 0.25s, box-shadow 0.25s;
            height: 100%;
        }
        .ex-card:hover {
            border-color: var(--cyan);
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(0,240,255,0.08);
            color: var(--text);
        }
        .ex-card .ex-icon {
            font-size: 2.2rem;
            margin-bottom: 0.25rem;
        }
        .ex-card .ex-num {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            letter-spacing: 2px;
            color: var(--mag);
            text-transform: uppercase;
        }
        .ex-card .ex-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--text);
        }
        .ex-card .ex-desc {
            font-size: 0.84rem;
            color: var(--muted);
            flex: 1;
        }
        .ex-card .ex-arrow {
            color: var(--cyan);
            font-size: 0.82rem;
            margin-top: 0.5rem;
        }
        .ex-card .ex-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        .ex-tag {
            background: rgba(0,240,255,0.07);
            border: 1px solid rgba(0,240,255,0.18);
            color: var(--cyan);
            border-radius: 999px;
            font-size: 0.7rem;
            padding: 2px 10px;
            font-family: 'JetBrains Mono', monospace;
        }

        /* ── Number badges ── */
        .num-badge {
            display: inline-block;
            width: 44px;
            text-align: center;
            padding: 4px 0;
            border-radius: 7px;
            margin: 2px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82rem;
            font-weight: 600;
        }
        .num-badge.highlight {
            background: linear-gradient(135deg, #0099ff 0%, #00ccff 100%);
            color: #fff;
            box-shadow: 0 2px 8px rgba(0,153,255,0.3);
        }
        .num-badge.prime-highlight {
            background: linear-gradient(135deg, #00c9a7 0%, #39ff14 100%);
            color: #000;
            box-shadow: 0 2px 8px rgba(57,255,20,0.25);
        }
        .num-badge.dim {
            background: var(--surface2);
            color: var(--muted);
            border: 1px solid var(--border);
        }

        /* ── Legend ── */
        .legend {
            display: flex;
            align-items: center;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.25rem;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: var(--muted);
        }
        .legend-swatch {
            width: 14px; height: 14px;
            border-radius: 4px;
        }
        .swatch-even   { background: linear-gradient(135deg, #0099ff, #00ccff); }
        .swatch-prime  { background: linear-gradient(135deg, #00c9a7, #39ff14); }
        .swatch-dim    { background: var(--surface2); border: 1px solid var(--border); }

        /* ── Stats bar ── */
        .stats-row {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }
        .stat-box {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            text-align: center;
        }
        .stat-box .stat-val {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--cyan);
        }
        .stat-box .stat-lbl {
            font-size: 0.72rem;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ── Multiplication table ── */
        .mult-wrap {
            overflow-x: auto;
        }
        .mult-table {
            border-collapse: separate;
            border-spacing: 4px;
            white-space: nowrap;
        }
        .mult-table th, .mult-table td {
            width: 70px;
            height: 50px;
            text-align: center;
            vertical-align: middle;
            border-radius: 8px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9rem;
        }
        .mult-table th {
            background: linear-gradient(135deg, #0066cc, #0099ff);
            color: #fff;
            font-weight: 700;
            font-size: 0.85rem;
        }
        .mult-table td {
            background: var(--surface2);
            color: var(--text);
            border: 1px solid var(--border);
        }
        .mult-table td.result-cell {
            background: linear-gradient(135deg, rgba(0,240,255,0.12), rgba(255,0,208,0.08));
            color: var(--cyan);
            font-weight: 700;
            border: 1px solid rgba(0,240,255,0.2);
            font-size: 1rem;
        }

        /* ── Form elements ── */
        .input-cyber {
            background: var(--surface2);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 8px;
            padding: 0.5rem 0.85rem;
            font-family: 'JetBrains Mono', monospace;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .input-cyber:focus {
            outline: none;
            border-color: var(--cyan);
            box-shadow: 0 0 0 3px rgba(0,240,255,0.12);
            background: var(--surface2);
            color: var(--text);
        }

        .btn-cyber {
            background: linear-gradient(90deg, var(--cyan), var(--mag));
            color: #000;
            font-weight: 700;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-size: 0.88rem;
            cursor: pointer;
            transition: filter 0.2s, transform 0.2s;
        }
        .btn-cyber:hover {
            filter: brightness(1.1);
            transform: translateY(-1px);
            color: #000;
        }

        .btn-outline-cyber {
            background: transparent;
            border: 1px solid var(--cyan);
            color: var(--cyan);
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-size: 0.88rem;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.2s;
        }
        .btn-outline-cyber:hover {
            background: var(--cyan);
            color: #000;
        }

        /* ── Info alert ── */
        .info-box {
            background: rgba(0,240,255,0.05);
            border: 1px solid rgba(0,240,255,0.2);
            border-radius: 10px;
            padding: 0.9rem 1.2rem;
            font-size: 0.85rem;
            color: var(--text);
        }
        .info-box code {
            background: var(--surface2);
            border: 1px solid var(--border);
            border-radius: 4px;
            padding: 1px 6px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.82rem;
            color: var(--mag);
        }

        /* ── Footer ── */
        .site-footer {
            border-top: 1px solid var(--border);
            padding: 1.25rem 0;
            color: var(--muted);
            font-size: 0.78rem;
            text-align: center;
        }
        .site-footer span { color: var(--cyan); }
    </style>

    @stack('styles')
</head>
<body>

<!-- ── Navigation ── -->
<nav class="navbar navbar-expand-lg site-nav sticky-top">
    <div class="container">
        <a class="navbar-brand" href="/">
            <i class="fas fa-terminal me-2"></i>Laravel Lab
        </a>
        <button class="navbar-toggler border-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#mainNav"
                aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars text-secondary"></i>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto gap-1 align-items-lg-center mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('/')) active @endif" href="/">
                        <i class="fas fa-home fa-sm me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('hello')) active @endif" href="/hello">
                        <i class="fas fa-user-astronaut fa-sm me-1"></i>About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('exercises*')) active @endif" href="/exercises">
                        <i class="fas fa-flask fa-sm me-1"></i>Exercises
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->is('lab-exercises*')) active @endif" href="/lab-exercises">
                        <i class="fas fa-microscope fa-sm me-1"></i>Lab Exercises
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- ── Main content ── -->
<main class="page-wrap">
    <div class="container">
        @yield('content')
    </div>
</main>

<!-- ── Footer ── -->
<footer class="site-footer">
    <div class="container">
        Laravel Lab &mdash; Junior Student Exercises &nbsp;&bull;&nbsp;
        Web Security &amp; Laravel Basics &nbsp;&bull;&nbsp;
        Powered by <span>Laravel</span>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
