<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreativePulse Studio | Digital Agency</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- 2-Second Welcome Splash Screen -->
    <div class="splash-screen" id="welcomeSplash">
        <div class="splash-badge">Cp</div>
        <div class="splash-title">Welcome to <span>CreativePulse</span></div>
        <div class="splash-sub">Digital Design &amp; Engineering Studio</div>
    </div>

    <!-- Top Navigation Bar Across All Pages -->
    <nav>
        <a href="index.php" class="brand-wrapper">
            <div class="brand-badge">
                <?php if (file_exists('logo.png')): ?>
                    <img src="logo.png" alt="Cp Logo" class="logo-img">
                <?php else: ?>
                    <span>Cp</span>
                <?php endif; ?>
            </div>
            <div class="brand-name">CreativePulse Studio</div>
        </a>

        <div class="nav-menu">
            <a href="index.php" class="active-link">Home</a>
            <a href="services.php">Services</a>
            <a href="quote.php">Get Quote</a>
            <a href="track.php">Track Order</a>
            <a href="#portfolios">Portfolios</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="login.php" class="nav-btn">Admin Portal</a>
        </div>
    </nav>

    <!-- Hero Banner + Wireframe Globe -->
    <header class="globe-hero">
        <div class="hero-eyebrow">CREATIVEPULSE DIGITAL AGENCY</div>
        <h1>Elevate Your Brand, Elevate Your Success</h1>
        <p>We craft bespoke websites, intuitive digital interfaces, memorable brand identities, and high-converting social campaigns.</p>

        <div class="hero-cta-row">
            <a href="services.php" class="btn-solid">Explore Our Services</a>
            <a href="quote.php" class="btn-outline">Request a Project Quote</a>
        </div>

        <div class="globe-canvas-wrap">
            <canvas id="wireframeGlobe"></canvas>
        </div>
    </header>

    <!-- About Our Website & Agency -->
    <section class="section-block" id="about">
        <div class="about-grid">
            <div>
                <div class="section-kicker">ABOUT CREATIVEPULSE STUDIO</div>
                <h3>Where Creative Strategy Meets Full-Stack Engineering</h3>
                <p>CreativePulse Studio is a multidisciplinary digital agency dedicated to helping startups, local enterprises, and modern brands build a commanding digital presence.</p>
                <p>Through our dedicated Client &amp; Order Management Portal, clients can inspect detailed service packages, submit project briefs in seconds, and monitor real-time production milestones from initial review to final delivery.</p>
                <a href="services.php" class="work-link">Browse Service Packages →</a>
            </div>
            <div class="about-metrics">
                <div class="metric-box">
                    <h4>4+</h4>
                    <span>Core Digital Disciplines</span>
                </div>
                <div class="metric-box">
                    <h4>24h</h4>
                    <span>Brief Review Turnaround</span>
                </div>
                <div class="metric-box">
                    <h4>100%</h4>
                    <span>Live Pipeline Visibility</span>
                </div>
                <div class="metric-box">
                    <h4>24/7</h4>
                    <span>Online Order Tracking</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Work Covering All Four Services -->
    <section class="sand-band" id="portfolios">
        <div class="section-block">
            <div class="section-header">
                <div class="section-kicker">FEATURED PORTFOLIO</div>
                <h2>Selected Works Across Our Four Core Services</h2>
                <p>Explore recent client deliverables spanning full-stack web platforms, UI/UX systems, visual branding, and social media growth.</p>
            </div>

            <div class="featured-grid">
                <div class="work-card">
                    <div class="work-banner wb-1">
                        <span class="work-pill">WEB DESIGN &amp; DEV</span>
                        <strong>The Artisan Collective</strong>
                    </div>
                    <div class="work-body">
                        <div>
                            <h4>Custom E-Commerce Portal</h4>
                            <p>Responsive storefront with integrated inventory management and streamlined checkout workflows.</p>
                        </div>
                        <a href="quote.php?service=Web+Design" class="work-link">Order Web Design →</a>
                    </div>
                </div>

                <div class="work-card">
                    <div class="work-banner wb-2">
                        <span class="work-pill">UI/UX DESIGN</span>
                        <strong>Flow Capital App</strong>
                    </div>
                    <div class="work-body">
                        <div>
                            <h4>FinTech Mobile &amp; Web Interface</h4>
                            <p>User-centered wireframes, interactive prototypes, and clean dashboard architecture.</p>
                        </div>
                        <a href="quote.php?service=UI%2FUX+Design" class="work-link">Order UI/UX Design →</a>
                    </div>
                </div>

                <div class="work-card">
                    <div class="work-banner wb-3">
                        <span class="work-pill">BRANDING &amp; LOGO</span>
                        <strong>AeroSpace Ventures</strong>
                    </div>
                    <div class="work-body">
                        <div>
                            <h4>Complete Visual Identity Kit</h4>
                            <p>Custom monogram logo mark, editorial typography, and cohesive brand color guidelines.</p>
                        </div>
                        <a href="quote.php?service=Branding%2FLogo" class="work-link">Order Branding →</a>
                    </div>
                </div>

                <div class="work-card">
                    <div class="work-banner wb-4">
                        <span class="work-pill">SOCIAL MEDIA</span>
                        <strong>Pulse Commerce Growth</strong>
                    </div>
                    <div class="work-body">
                        <div>
                            <h4>Campaign &amp; Content Strategy</h4>
                            <p>High-retention visual grid templates, short-form video hooks, and audience engagement systems.</p>
                        </div>
                        <a href="quote.php?service=Social+Media" class="work-link">Order Social Media →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- WHAT SETS US APART -->
    <section class="section-block">
        <div class="section-header">
            <div class="section-kicker">WHY PARTNER WITH US</div>
            <h2>WHAT SETS US APART</h2>
        </div>

        <div class="apart-grid">
            <div class="apart-card">
                <div class="apart-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                        <polyline points="17 6 23 6 23 12"></polyline>
                    </svg>
                </div>
                <h3>Results Driven</h3>
                <p>With focused digital expertise, we provide data-backed insights and innovative solutions that keep your brand ahead.</p>
            </div>

            <div class="apart-card">
                <div class="apart-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"></circle>
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                    </svg>
                </div>
                <h3>Industry Expertise</h3>
                <p>We work alongside you, crafting personalized strategies. Our mission isn't done until you're thrilled with the final deliverable.</p>
            </div>

            <div class="apart-card">
                <div class="apart-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Dedicated Team</h3>
                <p>Our passionate designers and engineers become an extension of your team, delivering transparent milestones every step of the way.</p>
            </div>
        </div>
    </section>

    <!-- Multi-Column Footer -->
    <footer class="site-footer" id="contact">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-row">
                    <div class="brand-badge">Cp</div>
                    <div class="brand-name">CreativePulse Studio</div>
                </div>
                <div class="footer-cta-heading">
                    READY TO ELEVATE<br>YOUR <span>BUSINESS?</span>
                </div>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#portfolios">Portfolios</a></li>
                    <li><a href="services.php">Services</a></li>
                    <li><a href="quote.php">Request Quote</a></li>
                    <li><a href="track.php">Live Order Tracker</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="services.php">Web Design &amp; Dev</a></li>
                    <li><a href="services.php">UI/UX Design</a></li>
                    <li><a href="services.php">Branding &amp; Logo</a></li>
                    <li><a href="services.php">Social Media Management</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Contact</h4>
                <ul>
                    <li>Khulna, Bangladesh</li>
                    <li><a href="mailto:hello@creativepulse.studio">hello@creativepulse.studio</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; <?php echo date("Y"); ?> CreativePulse Studio. Field Work / Industrial Training (CSE 4100). All Rights Reserved.
        </div>
    </footer>

    <script>
        const canvas = document.getElementById('wireframeGlobe');
        const ctx = canvas.getContext('2d');
        let angle = 0;

        function resizeGlobe() {
            canvas.width = canvas.parentElement.offsetWidth;
            canvas.height = canvas.parentElement.offsetHeight;
        }
        window.addEventListener('resize', resizeGlobe);
        resizeGlobe();

        const points = [];
        const numPoints = 190;
        for (let i = 0; i < numPoints; i++) {
            const phi = Math.acos(-1 + (2 * i) / numPoints);
            const theta = Math.sqrt(numPoints * Math.PI) * phi;
            points.push({
                x: Math.cos(theta) * Math.sin(phi),
                y: Math.sin(theta) * Math.sin(phi),
                z: Math.cos(phi)
            });
        }

        function drawGlobe() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            const radius = Math.min(canvas.width * 0.44, 320);
            const cx = canvas.width / 2;
            const cy = canvas.height + radius * 0.32;

            const grad = ctx.createRadialGradient(cx, cy, radius * 0.85, cx, cy, radius * 1.08);
            grad.addColorStop(0, 'rgba(149, 172, 191, 0.15)');
            grad.addColorStop(0.7, 'rgba(166, 102, 88, 0.45)');
            grad.addColorStop(1, 'rgba(239, 225, 222, 0)');
            ctx.beginPath();
            ctx.arc(cx, cy, radius * 1.06, Math.PI, 2 * Math.PI);
            ctx.fillStyle = grad;
            ctx.fill();

            ctx.beginPath();
            ctx.arc(cx, cy, radius, Math.PI, 2 * Math.PI);
            ctx.strokeStyle = '#A66658';
            ctx.lineWidth = 2.5;
            ctx.stroke();

            const projected = points.map(p => {
                const rotX = p.x * Math.cos(angle) - p.z * Math.sin(angle);
                const rotZ = p.x * Math.sin(angle) + p.z * Math.cos(angle);
                return {
                    x: cx + rotX * radius,
                    y: cy + p.y * radius,
                    z: rotZ
                };
            });

            for (let i = 0; i < projected.length; i++) {
                if (projected[i].z < -0.15 || projected[i].y > canvas.height) continue;
                for (let j = i + 1; j < projected.length; j++) {
                    if (projected[j].z < -0.15 || projected[j].y > canvas.height) continue;
                    const dx = projected[i].x - projected[j].x;
                    const dy = projected[i].y - projected[j].y;
                    const dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < radius * 0.24) {
                        ctx.beginPath();
                        ctx.moveTo(projected[i].x, projected[i].y);
                        ctx.lineTo(projected[j].x, projected[j].y);
                        ctx.strokeStyle = 'rgba(21, 28, 38, 0.26)';
                        ctx.lineWidth = 1;
                        ctx.stroke();
                    }
                }
                ctx.beginPath();
                ctx.arc(projected[i].x, projected[i].y, 2.2, 0, Math.PI * 2);
                ctx.fillStyle = projected[i].z > 0.3 ? '#73332D' : '#95ACBF';
                ctx.fill();
            }

            angle += 0.0035;
            requestAnimationFrame(drawGlobe);
        }
        drawGlobe();
    </script>

</body>
</html>