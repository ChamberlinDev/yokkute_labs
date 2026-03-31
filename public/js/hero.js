(function () {
    var animationFrameId = null;
    var resizeHandler = null;
    var stepsObserver = null;
    var maturityObserver = null;

    function destroyHeroScene() {
        if (animationFrameId !== null) {
            window.cancelAnimationFrame(animationFrameId);
            animationFrameId = null;
        }

        if (resizeHandler) {
            window.removeEventListener('resize', resizeHandler);
            resizeHandler = null;
        }

        if (stepsObserver) {
            stepsObserver.disconnect();
            stepsObserver = null;
        }

        if (maturityObserver) {
            maturityObserver.disconnect();
            maturityObserver = null;
        }
    }

    function initHeroScene() {
        destroyHeroScene();

        var canvas = document.getElementById('bgCanvas');
        if (!(canvas instanceof HTMLCanvasElement)) {
            return;
        }

        var parent = canvas.parentElement;
        var ctx = canvas.getContext('2d');

        if (!parent || !ctx) {
            return;
        }

        function resize() {
            canvas.width = parent.offsetWidth || 1200;
            canvas.height = parent.offsetHeight || window.innerHeight;
        }

        resizeHandler = resize;
        resize();
        window.addEventListener('resize', resizeHandler);

        var PARTICLE_COUNT = 55;
        var particles = [];

        for (var i = 0; i < PARTICLE_COUNT; i++) {
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

        var orbs = [
            { x: 0.75, y: 0.25, r: 220, color: '46,204,113', alpha: 0.07, speed: 0.0004, angle: 0 },
            { x: 0.85, y: 0.7, r: 160, color: '46,204,113', alpha: 0.05, speed: 0.0006, angle: 1.5 },
            { x: 0.55, y: 0.5, r: 100, color: '100,255,160', alpha: 0.04, speed: 0.001, angle: 3.0 }
        ];

        var tick = 0;

        function drawAurora() {
            var w = canvas.width;
            var h = canvas.height;

            for (var index = 0; index < 3; index++) {
                var offset = index * 0.6;
                var gradient = ctx.createLinearGradient(w * 0.4, 0, w, h);
                gradient.addColorStop(0, 'rgba(46,204,113,0)');
                gradient.addColorStop(0.4 + 0.1 * Math.sin(tick * 0.0008 + offset), 'rgba(46,204,113,' + (0.04 - index * 0.01) + ')');
                gradient.addColorStop(1, 'rgba(46,204,113,0)');

                ctx.beginPath();
                ctx.moveTo(w * 0.4, 0);

                for (var x = w * 0.4; x <= w; x += 4) {
                    var wave = Math.sin((x / w) * Math.PI * 2 + tick * 0.001 + offset) * 40
                        + Math.sin((x / w) * Math.PI * 4 + tick * 0.0015 + offset * 1.3) * 20;
                    var y = h * (0.3 + 0.15 * index) + wave;
                    ctx.lineTo(x, y);
                }

                ctx.lineTo(w, h);
                ctx.lineTo(w * 0.4, h);
                ctx.closePath();
                ctx.fillStyle = gradient;
                ctx.fill();
            }
        }

        function draw() {
            tick++;

            var w = canvas.width;
            var h = canvas.height;

            ctx.clearRect(0, 0, w, h);
            ctx.fillStyle = '#050e08';
            ctx.fillRect(0, 0, w, h);
            drawAurora();

            orbs.forEach(function (orb) {
                orb.angle += orb.speed * tick * 0.01;

                var cx = orb.x * w + Math.sin(orb.angle) * 30;
                var cy = orb.y * h + Math.cos(orb.angle * 0.7) * 20;
                var gradient = ctx.createRadialGradient(cx, cy, 0, cx, cy, orb.r);

                gradient.addColorStop(0, 'rgba(' + orb.color + ',' + orb.alpha + ')');
                gradient.addColorStop(1, 'rgba(' + orb.color + ',0)');

                ctx.beginPath();
                ctx.arc(cx, cy, orb.r, 0, Math.PI * 2);
                ctx.fillStyle = gradient;
                ctx.fill();
            });

            particles.forEach(function (particle) {
                particle.x += particle.vx;
                particle.y += particle.vy;
                particle.pulse += particle.pulseSpeed;

                if (particle.x < 0) {
                    particle.x = w;
                } else if (particle.x > w) {
                    particle.x = 0;
                }

                if (particle.y < 0) {
                    particle.y = h;
                } else if (particle.y > h) {
                    particle.y = 0;
                }

                var alpha = particle.alpha * (0.6 + 0.4 * Math.sin(particle.pulse));

                ctx.beginPath();
                ctx.arc(particle.x, particle.y, particle.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(46,204,113,' + alpha + ')';
                ctx.fill();
            });

            for (var particleIndex = 0; particleIndex < particles.length; particleIndex++) {
                for (var neighborIndex = particleIndex + 1; neighborIndex < particles.length; neighborIndex++) {
                    var dx = particles[particleIndex].x - particles[neighborIndex].x;
                    var dy = particles[particleIndex].y - particles[neighborIndex].y;
                    var dist = Math.sqrt(dx * dx + dy * dy);

                    if (dist < 90) {
                        ctx.beginPath();
                        ctx.moveTo(particles[particleIndex].x, particles[particleIndex].y);
                        ctx.lineTo(particles[neighborIndex].x, particles[neighborIndex].y);
                        ctx.strokeStyle = 'rgba(46,204,113,' + (0.12 * (1 - dist / 90)) + ')';
                        ctx.lineWidth = 0.5;
                        ctx.stroke();
                    }
                }
            }

            animationFrameId = window.requestAnimationFrame(draw);
        }

        draw();

        var steps = document.querySelectorAll('[data-step]');
        if (steps.length && 'IntersectionObserver' in window) {
            stepsObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    var delay = parseInt(entry.target.dataset.delay || '0', 10) || 0;

                    window.setTimeout(function () {
                        entry.target.classList.add('visible');
                    }, delay);
                });
            }, { threshold: 0.15 });

            steps.forEach(function (step) {
                stepsObserver.observe(step);
            });
        }

        var maturityFill = document.getElementById('maturityFill');
        var approcheSection = document.querySelector('.approche');

        if (maturityFill && approcheSection && 'IntersectionObserver' in window) {
            maturityObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        window.setTimeout(function () {
                            maturityFill.style.width = '78%';
                        }, 300);
                        maturityObserver.disconnect();
                        maturityObserver = null;
                    }
                });
            }, { threshold: 0.3 });

            maturityObserver.observe(approcheSection);
        }
    }

    document.addEventListener('DOMContentLoaded', initHeroScene, { once: true });
    document.addEventListener('turbo:load', initHeroScene);
    document.addEventListener('turbo:before-cache', destroyHeroScene);

    if (document.readyState !== 'loading') {
        initHeroScene();
    }
})();
