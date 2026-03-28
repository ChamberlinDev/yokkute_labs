  /* ── HERO CANVAS ANIMATION ── */
  const canvas = document.getElementById('bgCanvas');
  const ctx = canvas.getContext('2d');
 
  function resize() {
    canvas.width  = canvas.parentElement.offsetWidth  || 1200;
    canvas.height = canvas.parentElement.offsetHeight || window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);
 
  const PARTICLE_COUNT = 55;
  const particles = [];
  for (let i = 0; i < PARTICLE_COUNT; i++) {
    particles.push({
      x: Math.random() * canvas.width,
      y: Math.random() * canvas.height,
      r: Math.random() * 1.8 + 0.4,
      vx: (Math.random() - 0.5) * 0.35,
      vy: (Math.random() - 0.5) * 0.35,
      alpha: Math.random() * 0.5 + 0.1,
      pulse: Math.random() * Math.PI * 2,
      pulseSpeed: Math.random() * 0.02 + 0.008
    });
  }
 
  const orbs = [
    { x: 0.75, y: 0.25, r: 220, color: '46,204,113', alpha: 0.07, speed: 0.0004, angle: 0 },
    { x: 0.85, y: 0.7,  r: 160, color: '46,204,113', alpha: 0.05, speed: 0.0006, angle: 1.5 },
    { x: 0.55, y: 0.5,  r: 100, color: '100,255,160', alpha: 0.04, speed: 0.001,  angle: 3.0 },
  ];
 
  let tick = 0;
 
  function drawAurora() {
    const w = canvas.width, h = canvas.height;
    for (let i = 0; i < 3; i++) {
      const offset = i * 0.6;
      const grad = ctx.createLinearGradient(w * 0.4, 0, w, h);
      grad.addColorStop(0, 'rgba(46,204,113,0)');
      grad.addColorStop(0.4 + 0.1 * Math.sin(tick * 0.0008 + offset), `rgba(46,204,113,${0.04 - i * 0.01})`);
      grad.addColorStop(1, 'rgba(46,204,113,0)');
      ctx.beginPath();
      ctx.moveTo(w * 0.4, 0);
      for (let x = w * 0.4; x <= w; x += 4) {
        const wave = Math.sin((x / w) * Math.PI * 2 + tick * 0.001 + offset) * 40
                   + Math.sin((x / w) * Math.PI * 4 + tick * 0.0015 + offset * 1.3) * 20;
        const y = h * (0.3 + 0.15 * i) + wave;
        ctx.lineTo(x, y);
      }
      ctx.lineTo(w, h); ctx.lineTo(w * 0.4, h);
      ctx.closePath(); ctx.fillStyle = grad; ctx.fill();
    }
  }
 
  function draw() {
    tick++;
    const w = canvas.width, h = canvas.height;
    ctx.clearRect(0, 0, w, h);
    ctx.fillStyle = '#050e08'; ctx.fillRect(0, 0, w, h);
    drawAurora();
    orbs.forEach(o => {
      o.angle += o.speed * tick * 0.01;
      const cx = o.x * w + Math.sin(o.angle) * 30;
      const cy = o.y * h + Math.cos(o.angle * 0.7) * 20;
      const g = ctx.createRadialGradient(cx, cy, 0, cx, cy, o.r);
      g.addColorStop(0, `rgba(${o.color},${o.alpha})`);
      g.addColorStop(1, `rgba(${o.color},0)`);
      ctx.beginPath(); ctx.arc(cx, cy, o.r, 0, Math.PI * 2);
      ctx.fillStyle = g; ctx.fill();
    });
    particles.forEach(p => {
      p.x += p.vx; p.y += p.vy; p.pulse += p.pulseSpeed;
      if (p.x < 0) p.x = w; if (p.x > w) p.x = 0;
      if (p.y < 0) p.y = h; if (p.y > h) p.y = 0;
      const a = p.alpha * (0.6 + 0.4 * Math.sin(p.pulse));
      ctx.beginPath(); ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = `rgba(46,204,113,${a})`; ctx.fill();
    });
    for (let i = 0; i < particles.length; i++) {
      for (let j = i + 1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const dist = Math.sqrt(dx * dx + dy * dy);
        if (dist < 90) {
          ctx.beginPath();
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.strokeStyle = `rgba(46,204,113,${0.12 * (1 - dist / 90)})`;
          ctx.lineWidth = 0.5; ctx.stroke();
        }
      }
    }
    requestAnimationFrame(draw);
  }
  draw();
 
  /* ── SCROLL REVEAL — étapes approche ── */
  const steps = document.querySelectorAll('[data-step]');
  const maturityFill = document.getElementById('maturityFill');
 
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const delay = parseInt(entry.target.dataset.delay) || 0;
        setTimeout(() => entry.target.classList.add('visible'), delay);
      }
    });
  }, { threshold: 0.15 });
 
  steps.forEach(el => observer.observe(el));
 
  /* Maturity bar — déclenché quand la section entre dans le viewport */
  const maturityObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        setTimeout(() => { maturityFill.style.width = '78%'; }, 300);
        maturityObserver.disconnect();
      }
    });
  }, { threshold: 0.3 });
 
  maturityObserver.observe(document.querySelector('.approche'));
 