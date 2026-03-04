<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Ahmed — Cyberpunk Welcome</title>
	<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
	<style>
		:root{
			--bg1:#05030a; --bg2:#0b0b12; --neon-cyan:#00f0ff; --neon-mag:#ff00d0; --accent:#7cffcb;
		}
		html,body{height:100%;}
		body{
			margin:0; font-family:'Roboto',system-ui,Segoe UI,Arial; height:100%;
			background: radial-gradient(ellipse at 20% 10%, rgba(0,240,255,0.06) 0%, transparent 20%),
						radial-gradient(ellipse at 80% 90%, rgba(255,0,208,0.04) 0%, transparent 20%),
						linear-gradient(180deg,var(--bg1),var(--bg2));
			color:#cfd8ff; overflow:hidden; display:flex; align-items:center; justify-content:center;
			padding-top:52px; /* offset for fixed navbar */
		}
		/* Holographic grid */
		.grid {
			position:fixed; inset:0; z-index:0; pointer-events:none;
			background-image:
				linear-gradient(0deg, rgba(255,255,255,0.03) 1px, transparent 1px),
				linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
			background-size: 48px 48px, 48px 48px;
			mix-blend-mode: overlay; opacity:0.6;
			transform: translateZ(0);
			animation: gridShift 10s linear infinite;
		}
		@keyframes gridShift{ 0%{background-position:0 0,0 0}100%{background-position:240px 0,0 240px} }

		/* Scanlines */
		.scanlines {
			position:fixed; inset:0; z-index:1; pointer-events:none;
			background-image: repeating-linear-gradient(180deg, rgba(0,0,0,0.06) 0 2px, transparent 2px 4px);
			mix-blend-mode: multiply; opacity:0.5;
		}

		.container{
			position:relative; z-index:2; width:min(920px,92vw); padding:48px; border-radius:12px;
			background: linear-gradient(180deg, rgba(10,10,16,0.6), rgba(5,5,10,0.45));
			box-shadow: 0 10px 60px rgba(0,0,0,0.6), 0 0 40px rgba(0,240,255,0.06);
			border:1px solid rgba(255,255,255,0.04);
			overflow:hidden; backdrop-filter: blur(6px);
			display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center;
		}

		/* Neon headline */
		.headline-wrap{display:flex;align-items:center;justify-content:center;flex-direction:column; width:100%; max-width:820px; padding:0 12px}
		.typing-headline{
			font-family:'Orbitron',sans-serif; font-weight:700; font-size:3.2rem; color:var(--neon-cyan); text-transform:uppercase;
			letter-spacing:4px; margin:0; position:relative; line-height:1; text-shadow:
				0 0 8px rgba(0,240,255,0.18), 0 0 32px rgba(0,240,255,0.06), 0 8px 30px rgba(0,0,0,0.6);
		}
		.typing-headline::after{ content:''; display:inline-block; width:6px; height:1.05em; background:var(--neon-mag); margin-left:8px; vertical-align:middle; animation:blink 1s steps(2) infinite; box-shadow:0 0 8px var(--neon-mag); }
		@keyframes blink{50%{opacity:0}} 

		/* Glitch layers */
		.glow {
			position:relative;
		}
		.glow::before, .glow::after{
			content:attr(data-text); position:absolute; left:0; top:0; width:100%;
			clip-path: inset(0 0 0 0);
			opacity:0.85; pointer-events:none;
		}
		.glow::before{ color:var(--neon-mag); transform:translate(4px,-2px); filter:blur(6px); mix-blend-mode: screen; }
		.glow::after{ color:var(--accent); transform:translate(-6px,2px); filter:blur(8px); mix-blend-mode: screen; }

		/* Subtitle */
		.subtitle{ color: #9fb2ff; opacity:0.9; margin-top:12px; font-size:1.05rem; }

		/* Neon button */
		.btn{ display:inline-block; margin-top:26px; padding:12px 28px; border-radius:999px; text-decoration:none; color:#001018; font-weight:700;
			background: linear-gradient(90deg,var(--neon-cyan),var(--neon-mag)); box-shadow: 0 8px 30px rgba(0,240,255,0.08), 0 0 32px rgba(255,0,208,0.08); border: none; }
		.btn:hover{ transform:translateY(-3px); filter:brightness(1.05); }

		/* Floating neon bars */
		.bars{ position:absolute; inset:0; z-index:0; pointer-events:none; }
		.bar{ position:absolute; width:2px; height:40vh; background:linear-gradient(180deg, rgba(0,240,255,0.95), rgba(255,0,208,0.2)); opacity:0.08; filter:blur(8px); }
		.bar.b1{ left:8%; top:20%; transform:rotate(6deg); animation:barMove 8s linear infinite; }
		.bar.b2{ left:86%; top:30%; transform:rotate(-6deg); animation:barMove 10s linear infinite reverse; }
		@keyframes barMove{ 0%{transform:translateY(0) rotate(6deg)}50%{transform:translateY(-8vh) rotate(6deg)}100%{transform:translateY(0) rotate(6deg)} }

		/* Small particles */
		.particles{ position:absolute; inset:0; z-index:1; pointer-events:none; }
		.particle{ position:absolute; width:4px; height:4px; background:var(--neon-cyan); border-radius:50%; opacity:0.7; filter:blur(2px); }

		/* Glitch animation */
		.glitch { animation: glitchAnim 3s linear infinite; }
		@keyframes glitchAnim{
			0%{transform:none;opacity:1}
			7%{transform:translate(-2px,-1px)}
			10%{transform:translate(2px,1px)}
			20%{transform:none}
			30%{transform:skew(-0.5deg) translate(-1px,2px)}
			35%{transform:none}
			100%{transform:none}
		}

		@media (max-width:1000px){ .typing-headline{font-size:2.6rem; letter-spacing:3px} }
		@media (max-width:700px){ .typing-headline{font-size:2rem; letter-spacing:2px} .container{padding:24px} .btn{padding:12px 20px} }
		@media (max-width:420px){ .typing-headline{font-size:1.4rem; letter-spacing:1.5px} .container{padding:18px} .btn{display:block;width:100%;text-align:center;padding:12px 16px;margin-top:18px} }
	</style>
</head>
<body>

	<!-- ── Navigation bar ── -->
	<nav style="
		position:fixed;top:0;left:0;right:0;z-index:9999;
		background:rgba(5,3,10,0.88);backdrop-filter:blur(14px);
		-webkit-backdrop-filter:blur(14px);
		border-bottom:1px solid rgba(255,255,255,0.06);
		display:flex;align-items:center;justify-content:space-between;
		padding:0 2rem;height:52px;
	" aria-label="Site navigation">
		<a href="/" style="font-family:'Orbitron',sans-serif;font-size:0.82rem;color:var(--neon-cyan);text-decoration:none;letter-spacing:2px;font-weight:700">
			&#x2022; LARAVEL LAB
		</a>
		<div style="display:flex;gap:6px;align-items:center">
			<a href="/" style="color:rgba(160,180,255,0.7);text-decoration:none;font-size:0.8rem;padding:5px 12px;border-radius:7px;transition:all .2s" onmouseover="this.style.color='#00f0ff';this.style.background='rgba(0,240,255,0.08)'" onmouseout="this.style.color='rgba(160,180,255,0.7)';this.style.background='transparent'">Home</a>
			<a href="/hello" style="color:#00f0ff;text-decoration:none;font-size:0.8rem;padding:5px 12px;border-radius:7px;background:rgba(0,240,255,0.1)">About</a>
			<a href="/exercises" style="color:rgba(160,180,255,0.7);text-decoration:none;font-size:0.8rem;padding:5px 14px;border-radius:7px;background:linear-gradient(90deg,rgba(0,240,255,0.12),rgba(255,0,208,0.08));border:1px solid rgba(0,240,255,0.2);transition:all .2s" onmouseover="this.style.color='#00f0ff'" onmouseout="this.style.color='rgba(160,180,255,0.7)'">⚗ Exercises</a>
		</div>
	</nav>

	<canvas id="ai-canvas" aria-hidden="true"></canvas>
	<div class="grid"></div>
	<div class="scanlines"></div>

	<div class="bars">
		<div class="bar b1"></div>
		<div class="bar b2"></div>
	</div>

	<div class="particles" aria-hidden>
		<div class="particle" style="left:10%;top:20%;opacity:0.6"></div>
		<div class="particle" style="left:30%;top:70%;opacity:0.35;background:var(--neon-mag)"></div>
		<div class="particle" style="left:78%;top:40%;opacity:0.5"></div>
		<div class="particle" style="left:55%;top:18%;opacity:0.4;background:var(--accent)"></div>
	</div>

	<main class="container" role="main">
		<div class="headline-wrap">
			<h1 id="headline" class="typing-headline glow" data-text=""></h1>
			<div class="subtitle" id="subtitle">A neon cyber-welcome — crafted for creators & builders.</div>
			<a href="https://laravel.com/docs" class="btn" target="_blank">Docs — Dive In</a>
			<div style="margin-top:18px;color:#a7f5e6;font-weight:600;opacity:0.9">Ahmed — Creator of this page</div>
		</div>
	</main>

	<script>
	// Typing + glitch effect
	(function(){
		const text = "👋 HI, I'M AHMED — CYBER CREATOR";
		const el = document.getElementById('headline');
		el.setAttribute('data-text', text);
		let idx = 0;
		const minDelay = 40, maxDelay = 90;

		function randDelay(){ return Math.floor(Math.random()*(maxDelay-minDelay))+minDelay }

		function type(){
			if(idx <= text.length){
				el.textContent = text.slice(0, idx);
				idx++;
				// occasional longer pause after punctuation
				const ch = text[idx-1]||'';
				const pause = (ch===','||ch==='—'||ch==='!')? 220 : randDelay();
				setTimeout(type, idx===1?700:pause);
			} else {
				el.classList.add('glitch');
				// brief flicker then keep subtle glitch
				setTimeout(()=> el.classList.remove('glitch'), 900);
				// periodic micro glitches
				setInterval(()=>{
					el.classList.add('glitch');
					setTimeout(()=>el.classList.remove('glitch'), 400 + Math.random()*300);
				}, 4200 + Math.random()*3000);
			}
		}
		document.addEventListener('DOMContentLoaded', type);
	})();
	</script>
	<script>
	// AI-network background: moving nodes & connecting lines
	(function(){
		const canvas = document.getElementById('ai-canvas');
		const ctx = canvas.getContext('2d');
		let w = canvas.width = innerWidth;
		let h = canvas.height = innerHeight;

		window.addEventListener('resize', ()=>{
			w = canvas.width = innerWidth;
			h = canvas.height = innerHeight;
			init();
		});

		const opts = {
			count: Math.round((w*h)/90000), // density
			maxDist: 160,
			nodeRadius: 2.2,
			hueStart: 180,
			hueEnd: 300
		};

		let nodes = [];

		function rand(min,max){ return Math.random()*(max-min)+min }

		function init(){
			nodes = [];
			const count = Math.max(6, opts.count);
			for(let i=0;i<count;i++){
				nodes.push({
					x: rand(0,w), y: rand(0,h),
					vx: rand(-0.25,0.25), vy: rand(-0.25,0.25),
					r: opts.nodeRadius + Math.random()*1.8,
					phase: Math.random()*Math.PI*2
				});
			}
		}

		function draw(){
			ctx.clearRect(0,0,w,h);
			// subtle background glow
			const g = ctx.createLinearGradient(0,0,w,h);
			g.addColorStop(0,'rgba(0,240,255,0.02)');
			g.addColorStop(1,'rgba(255,0,208,0.01)');
			ctx.fillStyle = g; ctx.fillRect(0,0,w,h);

			// draw connections
			for(let i=0;i<nodes.length;i++){
				const a = nodes[i];
				for(let j=i+1;j<nodes.length;j++){
					const b = nodes[j];
					const dx = a.x-b.x, dy = a.y-b.y;
					const dist = Math.sqrt(dx*dx+dy*dy);
					if(dist < opts.maxDist){
						const t = 1 - (dist/opts.maxDist);
						const hue = opts.hueStart + (opts.hueEnd-opts.hueStart)*Math.random();
						ctx.strokeStyle = `hsla(${hue},100%,60%,${0.08 + t*0.25})`;
						ctx.lineWidth = 1 * t;
						ctx.beginPath(); ctx.moveTo(a.x,a.y); ctx.lineTo(b.x,b.y); ctx.stroke();
					}
				}
			}

			// draw nodes
			for(const n of nodes){
				// pulsing
				const pr = n.r * (0.9 + 0.15*Math.sin(n.phase + Date.now()/800));
				const hue = opts.hueStart + (opts.hueEnd-opts.hueStart)*0.5;
				ctx.beginPath();
				ctx.fillStyle = `rgba(0,240,255,0.85)`;
				ctx.shadowColor = 'rgba(0,240,255,0.8)';
				ctx.shadowBlur = 12;
				ctx.arc(n.x, n.y, pr, 0, Math.PI*2);
				ctx.fill();
				ctx.shadowBlur = 0;
			}
		}

		function step(){
			for(const n of nodes){
				n.x += n.vx; n.y += n.vy; n.phase += 0.02;
				if(n.x < -20) n.x = w+20; if(n.x > w+20) n.x = -20;
				if(n.y < -20) n.y = h+20; if(n.y > h+20) n.y = -20;
				// slight wander
				n.vx += rand(-0.02,0.02); n.vy += rand(-0.02,0.02);
				n.vx = Math.max(Math.min(n.vx,0.6),-0.6);
				n.vy = Math.max(Math.min(n.vy,0.6),-0.6);
			}
			draw();
			requestAnimationFrame(step);
		}

		init();
		step();
	})();
	</script>
</body>
</html>