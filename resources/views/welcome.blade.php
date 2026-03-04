@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    /* ── Hero canvas ── */
    #hero-canvas {
        position: fixed;
        inset: 0;
        z-index: 0;
        pointer-events: none;
    }

    /* ── Holographic grid overlay ── */
    .holo-grid {
        position: fixed; inset: 0; z-index: 1; pointer-events: none;
        background-image:
            linear-gradient(0deg,  rgba(255,255,255,0.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255,255,255,0.018) 1px, transparent 1px);
        background-size: 52px 52px;
        mix-blend-mode: overlay; opacity: 0.55;
        animation: gridDrift 12s linear infinite;
    }
    @keyframes gridDrift {
        0%   { background-position: 0 0, 0 0 }
        100% { background-position: 260px 0, 0 260px }
    }

    /* ── Scanlines ── */
    .scanlines {
        position: fixed; inset: 0; z-index: 2; pointer-events: none;
        background-image: repeating-linear-gradient(
            180deg, rgba(0,0,0,0.055) 0 2px, transparent 2px 4px
        );
        opacity: 0.45;
    }

    /* ── Hero section ── */
    .hero-section {
        position: relative;
        z-index: 3;
        min-height: calc(100vh - 52px);
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem 1rem 5rem;
    }

    .hero-inner { max-width: 760px; width: 100%; }

    /* Eyebrow chip */
    .hero-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(0,240,255,0.08);
        border: 1px solid rgba(0,240,255,0.22);
        border-radius: 999px;
        padding: 5px 16px;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.72rem;
        letter-spacing: 2px;
        color: #00f0ff;
        text-transform: uppercase;
        margin-bottom: 1.75rem;
    }
    .hero-chip-dot {
        width: 7px; height: 7px; border-radius: 50%;
        background: #00f0ff;
        box-shadow: 0 0 6px #00f0ff;
        animation: pulse-dot 2s ease-in-out infinite;
    }
    @keyframes pulse-dot {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.5; transform: scale(0.7); }
    }

    /* Main headline */
    .hero-title {
        font-family: 'JetBrains Mono', monospace;
        font-size: clamp(2rem, 6vw, 3.8rem);
        font-weight: 700;
        line-height: 1.15;
        color: #dde8ff;
        margin: 0 0 1.25rem;
    }
    .hero-title .grad {
        background: linear-gradient(90deg, #00f0ff 0%, #ff00d0 50%, #7cffcb 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Sub */
    .hero-sub {
        font-size: clamp(0.92rem, 2.5vw, 1.08rem);
        color: #6a7a9a;
        max-width: 560px;
        margin: 0 auto 2.25rem;
        line-height: 1.75;
    }

    /* CTA buttons */
    .hero-ctas {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 3.5rem;
    }
    .cta-primary {
        background: linear-gradient(90deg, #00f0ff, #ff00d0);
        color: #000 !important;
        font-weight: 700;
        border: none;
        border-radius: 10px;
        padding: 13px 30px;
        font-size: 0.92rem;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: filter 0.2s, transform 0.2s;
        font-family: 'Inter', sans-serif;
    }
    .cta-primary:hover { filter: brightness(1.1); transform: translateY(-2px); }
    .cta-secondary {
        background: transparent;
        border: 1px solid rgba(0,240,255,0.3);
        color: #00f0ff !important;
        border-radius: 10px;
        padding: 13px 30px;
        font-size: 0.92rem;
        text-decoration: none !important;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }
    .cta-secondary:hover { background: rgba(0,240,255,0.07); border-color: #00f0ff; transform: translateY(-2px); }

    /* Stats strip */
    .hero-stats { display: flex; justify-content: center; gap: 2.5rem; flex-wrap: wrap; }
    .hero-stat  { text-align: center; }
    .hero-stat-val {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.55rem; font-weight: 700; color: #00f0ff; line-height: 1; display: block;
    }
    .hero-stat-lbl {
        font-size: 0.68rem; color: #6a7a9a; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-top: 4px;
    }
    .stat-divider { width: 1px; height: 36px; background: rgba(255,255,255,0.07); align-self: center; }

    /* ── Sections ── */
    .content-section { position: relative; z-index: 3; padding: 4rem 0 5rem; }

    .section-label {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem; letter-spacing: 3px; color: #ff00d0; text-transform: uppercase;
        text-align: center; display: block; margin-bottom: 0.5rem;
    }
    .section-title  { font-size: clamp(1.4rem, 4vw, 1.9rem); font-weight: 700; color: #dde8ff; text-align: center; margin-bottom: 0.5rem; }
    .section-sub    { text-align: center; color: #6a7a9a; font-size: 0.88rem; margin-bottom: 2.75rem; }

    /* Feature card */
    .feat-card {
        background: #13131a; border: 1px solid rgba(255,255,255,0.07); border-radius: 14px;
        padding: 1.75rem 1.5rem; height: 100%; transition: border-color .25s, transform .25s;
    }
    .feat-card:hover { border-color: rgba(0,240,255,0.25); transform: translateY(-4px); }
    .feat-icon  { font-size: 1.6rem; margin-bottom: 1rem; }
    .feat-title { font-weight: 700; font-size: 1rem; color: #dde8ff; margin-bottom: 0.5rem; }
    .feat-desc  { font-size: 0.83rem; color: #6a7a9a; line-height: 1.65; margin: 0; }

    /* Ex preview card */
    .ex-prev-card {
        background: #13131a; border: 1px solid rgba(255,255,255,0.07); border-radius: 14px;
        padding: 1.5rem; height: 100%; transition: border-color .25s, transform .25s;
        text-decoration: none; display: block; color: inherit;
    }
    .ex-prev-card:hover { border-color: rgba(0,240,255,0.25); transform: translateY(-3px); color: inherit; text-decoration: none; }

    /* CTA banner */
    .cta-banner { position: relative; z-index: 3; padding: 0 0 5rem; }
    .cta-box {
        background: linear-gradient(135deg, rgba(0,240,255,0.06) 0%, rgba(255,0,208,0.04) 100%);
        border: 1px solid rgba(0,240,255,0.15); border-radius: 18px; padding: 3rem 2rem; text-align: center;
    }
    .cta-box h2 { font-size: clamp(1.4rem, 4vw, 2rem); font-weight: 700; color: #dde8ff; margin-bottom: 0.75rem; }
    .cta-box p  { color: #6a7a9a; font-size: 0.9rem; margin-bottom: 1.75rem; }

    /* Scroll reveal */
    .reveal { opacity: 0; transform: translateY(20px); transition: opacity 0.55s ease, transform 0.55s ease; }
    .reveal.visible { opacity: 1; transform: none; }
</style>
@endpush

@section('content')

{{-- ── Background elements ── --}}
<canvas id="hero-canvas" aria-hidden="true"></canvas>
<div class="holo-grid"></div>
<div class="scanlines"></div>

{{-- ══════════════════ HERO ══════════════════ --}}
<section class="hero-section" aria-label="Hero">
    <div class="hero-inner">

        <div class="hero-chip">
            <span class="hero-chip-dot"></span>
            Laravel Lab &nbsp;&bull;&nbsp; Web Security Course
        </div>

        <h1 class="hero-title">
            Learn <span class="grad">Laravel</span> &amp; Web Security<br>from the ground up
        </h1>

        <p class="hero-sub">
            Hands-on Blade exercises, dynamic routing, and PHP algorithms —
            everything a junior developer needs to build secure, real-world web applications.
        </p>

        <div class="hero-ctas">
            <a href="/exercises" class="cta-primary">
                <i class="fas fa-flask"></i> Start Exercises
            </a>
            <a href="/hello" class="cta-secondary">
                <i class="fas fa-user-astronaut"></i> About Ahmed
            </a>
        </div>

        <div class="hero-stats">
            <div class="hero-stat">
                <span class="hero-stat-val">3</span>
                <span class="hero-stat-lbl">Exercises</span>
            </div>
            <div class="stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-val">PHP</span>
                <span class="hero-stat-lbl">Language</span>
            </div>
            <div class="stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-val">Blade</span>
                <span class="hero-stat-lbl">Templating</span>
            </div>
            <div class="stat-divider"></div>
            <div class="hero-stat">
                <span class="hero-stat-val">100%</span>
                <span class="hero-stat-lbl">Hands-on</span>
            </div>
        </div>

    </div>
</section>

{{-- ══════════════════ WHAT YOU'LL LEARN ══════════════════ --}}
<section class="content-section reveal">
    <span class="section-label">Curriculum</span>
    <h2 class="section-title">What you'll learn</h2>
    <p class="section-sub">Core skills for every junior Laravel developer</p>

    <div class="row g-4">
        <div class="col-sm-6 col-lg-3">
            <div class="feat-card">
                <div class="feat-icon">⚙️</div>
                <div class="feat-title">Blade Directives</div>
                <p class="feat-desc">
                    Write clean views using <code style="color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:3px">@@foreach</code>,
                    <code style="color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:3px">@@if</code>, and
                    <code style="color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:3px">@@php</code> — no raw PHP tags needed.
                </p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="feat-card">
                <div class="feat-icon">🔀</div>
                <div class="feat-title">Dynamic Routing</div>
                <p class="feat-desc">
                    Pass data through URL segments with Laravel route parameters and
                    <code style="color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:3px">->where()</code> constraint validation.
                </p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="feat-card">
                <div class="feat-icon">🧠</div>
                <div class="feat-title">PHP Algorithms</div>
                <p class="feat-desc">
                    Implement real algorithms — even/odd detection, primality testing,
                    and multiplication tables with nested loops.
                </p>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="feat-card">
                <div class="feat-icon">🛡️</div>
                <div class="feat-title">Web Security Basics</div>
                <p class="feat-desc">
                    Sanitise and constrain user input at the route level — your first step
                    in building secure web applications.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════ EXERCISE PREVIEW ══════════════════ --}}
<section class="content-section reveal" style="padding-top:0">
    <span class="section-label">Lab</span>
    <h2 class="section-title">Three hands-on exercises</h2>
    <p class="section-sub">Each exercise teaches a different core concept — start from the top</p>

    <div class="row g-3">
        <div class="col-md-4">
            <a href="/exercises/even-numbers" class="ex-prev-card">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem">
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:2px;color:#ff00d0;text-transform:uppercase">Exercise 01</span>
                    <span style="font-size:1.4rem">🔢</span>
                </div>
                <div style="font-weight:700;color:#dde8ff;margin-bottom:0.4rem;font-size:1rem">Even Numbers</div>
                <div style="font-size:0.82rem;color:#6a7a9a;line-height:1.65;margin-bottom:1rem">
                    Loop 1–100 and highlight even numbers using the modulus operator inside a
                    <code style="color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:3px">@@foreach</code>.
                </div>
                <div style="font-size:0.8rem;color:#00f0ff"><i class="fas fa-arrow-right me-1"></i>Run exercise</div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/exercises/prime-numbers" class="ex-prev-card">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem">
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:2px;color:#ff00d0;text-transform:uppercase">Exercise 02</span>
                    <span style="font-size:1.4rem">🧮</span>
                </div>
                <div style="font-weight:700;color:#dde8ff;margin-bottom:0.4rem;font-size:1rem">Prime Numbers</div>
                <div style="font-size:0.82rem;color:#6a7a9a;line-height:1.65;margin-bottom:1rem">
                    Write an <code style="color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:3px">isPrime()</code> function
                    and call it in Blade — connect it to RSA cryptography.
                </div>
                <div style="font-size:0.8rem;color:#00f0ff"><i class="fas fa-arrow-right me-1"></i>Run exercise</div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="/exercises/multiplication/5" class="ex-prev-card">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:1rem">
                    <span style="font-family:'JetBrains Mono',monospace;font-size:0.68rem;letter-spacing:2px;color:#ff00d0;text-transform:uppercase">Exercise 03</span>
                    <span style="font-size:1.4rem">✖️</span>
                </div>
                <div style="font-weight:700;color:#dde8ff;margin-bottom:0.4rem;font-size:1rem">Multiplication Table</div>
                <div style="font-size:0.82rem;color:#6a7a9a;line-height:1.65;margin-bottom:1rem">
                    Navigate to <code style="color:#ff00d0;background:#1c1c26;padding:1px 5px;border-radius:3px">/exercises/multiplication/{n}</code>
                    and see the full grid for any number.
                </div>
                <div style="font-size:0.8rem;color:#00f0ff"><i class="fas fa-arrow-right me-1"></i>Run exercise</div>
            </a>
        </div>
    </div>
</section>

{{-- ══════════════════ CTA BANNER ══════════════════ --}}
<section class="cta-banner reveal">
    <div class="cta-box">
        <h2>Ready to start coding?</h2>
        <p>Jump straight into the exercises lab and learn by doing.</p>
        <a href="/exercises" class="cta-primary" style="display:inline-flex">
            <i class="fas fa-rocket"></i> Go to Exercises
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
/* ── AI network canvas background ── */
(function () {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let w, h, nodes;

    function resize() {
        w = canvas.width  = innerWidth;
        h = canvas.height = innerHeight;
        init();
    }
    function rand(a, b) { return Math.random() * (b - a) + a; }
    function init() {
        const count = Math.max(8, Math.round((w * h) / 85000));
        nodes = Array.from({ length: count }, () => ({
            x: rand(0, w), y: rand(0, h),
            vx: rand(-0.22, 0.22), vy: rand(-0.22, 0.22),
            r: rand(1.5, 3.2), phase: rand(0, Math.PI * 2)
        }));
    }
    function draw() {
        ctx.clearRect(0, 0, w, h);
        const maxD = 150;
        for (let i = 0; i < nodes.length; i++) {
            for (let j = i + 1; j < nodes.length; j++) {
                const a = nodes[i], b = nodes[j];
                const dx = a.x - b.x, dy = a.y - b.y;
                const d = Math.sqrt(dx * dx + dy * dy);
                if (d < maxD) {
                    const t = 1 - d / maxD;
                    ctx.strokeStyle = `hsla(${180 + Math.random() * 120},100%,60%,${0.06 + t * 0.2})`;
                    ctx.lineWidth = t;
                    ctx.beginPath(); ctx.moveTo(a.x, a.y); ctx.lineTo(b.x, b.y); ctx.stroke();
                }
            }
        }
        for (const n of nodes) {
            const pr = n.r * (0.88 + 0.16 * Math.sin(n.phase + Date.now() / 900));
            ctx.beginPath();
            ctx.fillStyle   = 'rgba(0,240,255,0.8)';
            ctx.shadowColor = 'rgba(0,240,255,0.7)';
            ctx.shadowBlur  = 10;
            ctx.arc(n.x, n.y, pr, 0, Math.PI * 2);
            ctx.fill();
            ctx.shadowBlur = 0;
        }
    }
    function step() {
        for (const n of nodes) {
            n.x += n.vx; n.y += n.vy; n.phase += 0.018;
            if (n.x < -20) n.x = w + 20; if (n.x > w + 20) n.x = -20;
            if (n.y < -20) n.y = h + 20; if (n.y > h + 20) n.y = -20;
            n.vx += rand(-0.015, 0.015); n.vy += rand(-0.015, 0.015);
            n.vx = Math.max(-0.55, Math.min(0.55, n.vx));
            n.vy = Math.max(-0.55, Math.min(0.55, n.vy));
        }
        draw();
        requestAnimationFrame(step);
    }
    window.addEventListener('resize', resize);
    resize();
    step();
})();

/* ── Scroll reveal ── */
(function () {
    const els = document.querySelectorAll('.reveal');
    const io = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    els.forEach(el => io.observe(el));
})();
</script>
@endpush
