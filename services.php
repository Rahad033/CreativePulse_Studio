<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | CreativePulse Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

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
            <a href="index.php">Home</a>
            <a href="services.php" class="active-link">Services</a>
            <a href="quote.php">Get Quote</a>
            <a href="track.php">Track Order</a>
            <a href="index.php#portfolios">Portfolios</a>
            <a href="index.php#about">About</a>
            <a href="index.php#contact">Contact</a>
            <a href="login.php" class="nav-btn">Admin Portal</a>
        </div>
    </nav>

    <div class="page-banner">
        <h1>Our Digital Agency Services</h1>
        <p>Review what we offer in each discipline below, then click a service to proceed directly to your project quote.</p>
    </div>

    <div class="container">
        <div class="services-detailed">
            <!-- 1. Web Design & Dev -->
            <div class="service-detail-card">
                <div>
                    <div class="card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                            <line x1="2" y1="20" x2="22" y2="20"></line>
                            <line x1="12" y1="17" x2="12" y2="20"></line>
                            <polyline points="8 7 5 10 8 13"></polyline>
                            <polyline points="16 7 19 10 16 13"></polyline>
                        </svg>
                    </div>
                    <h3>Web Design &amp; Dev</h3>
                    <p class="service-lead">Fast, secure, and mobile-responsive websites engineered for modern businesses.</p>
                    <ul class="service-points">
                        <li>Custom landing pages &amp; multi-page corporate sites</li>
                        <li>Full-stack PHP &amp; MySQL dynamic web portals</li>
                        <li>E-commerce storefronts &amp; admin dashboards</li>
                        <li>Mobile-first responsive layout &amp; speed optimization</li>
                        <li>Domain setup, SSL &amp; live server deployment</li>
                    </ul>
                </div>
                <a href="quote.php?service=Web+Design" class="service-select-btn">Select &amp; Request Quote →</a>
            </div>

            <!-- 2. UI/UX Design -->
            <div class="service-detail-card">
                <div>
                    <div class="card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="3"></rect>
                            <line x1="3" y1="9" x2="21" y2="9"></line>
                            <line x1="9" y1="21" x2="9" y2="9"></line>
                            <circle cx="15" cy="15" r="2"></circle>
                        </svg>
                    </div>
                    <h3>UI/UX Design</h3>
                    <p class="service-lead">Intuitive, user-centered interfaces designed to maximize clarity and conversion.</p>
                    <ul class="service-points">
                        <li>User journey mapping &amp; information architecture</li>
                        <li>Low-fidelity &amp; high-fidelity wireframes</li>
                        <li>Interactive clickable web &amp; mobile app prototypes</li>
                        <li>Modern design systems, typography &amp; color tokens</li>
                        <li>Usability review &amp; developer-ready handoff files</li>
                    </ul>
                </div>
                <a href="quote.php?service=UI%2FUX+Design" class="service-select-btn">Select &amp; Request Quote →</a>
            </div>

            <!-- 3. Branding & Logo -->
            <div class="service-detail-card">
                <div>
                    <div class="card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                            <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                            <path d="M2 2l7.5 7.5"></path>
                            <circle cx="11" cy="11" r="1"></circle>
                        </svg>
                    </div>
                    <h3>Branding &amp; Logo</h3>
                    <p class="service-lead">Distinctive visual identities that make your company recognizable everywhere.</p>
                    <ul class="service-points">
                        <li>Primary custom logo mark, wordmark &amp; favicon</li>
                        <li>Curated brand color palette &amp; font pairing</li>
                        <li>Brand style guide &amp; visual usage rules</li>
                        <li>Business cards, letterheads &amp; stationery kits</li>
                        <li>High-resolution vector source files (SVG, PNG, PDF)</li>
                    </ul>
                </div>
                <a href="quote.php?service=Branding%2FLogo" class="service-select-btn">Select &amp; Request Quote →</a>
            </div>

            <!-- 4. Social Media Management -->
            <div class="service-detail-card">
                <div>
                    <div class="card-icon">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                            <polyline points="17 6 23 6 23 12"></polyline>
                        </svg>
                    </div>
                    <h3>Social Media Management</h3>
                    <p class="service-lead">Consistent content systems and visual campaigns built to grow your audience.</p>
                    <ul class="service-points">
                        <li>Monthly content calendar &amp; campaign planning</li>
                        <li>Custom Instagram &amp; Facebook post/carousel graphics</li>
                        <li>Short-form reels concepts &amp; promotional banners</li>
                        <li>Profile optimization, bio copy &amp; hashtag strategy</li>
                        <li>Audience engagement &amp; monthly growth reporting</li>
                    </ul>
                </div>
                <a href="quote.php?service=Social+Media" class="service-select-btn">Select &amp; Request Quote →</a>
            </div>
        </div>
    </div>

    <footer class="site-footer">
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
                    <li><a href="services.php">Services</a></li>
                    <li><a href="quote.php">Request Quote</a></li>
                    <li><a href="track.php">Live Order Tracker</a></li>
                    <li><a href="index.php#portfolios">Portfolios</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Services</h4>
                <ul>
                    <li><a href="quote.php?service=Web+Design">Web Design &amp; Dev</a></li>
                    <li><a href="quote.php?service=UI%2FUX+Design">UI/UX Design</a></li>
                    <li><a href="quote.php?service=Branding%2FLogo">Branding &amp; Logo</a></li>
                    <li><a href="quote.php?service=Social+Media">Social Media Management</a></li>
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

</body>
</html>