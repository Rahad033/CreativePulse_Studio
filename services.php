<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Services | CreativePulse Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .services-hero {
            max-width: 1140px;
            margin: 44px auto 34px;
            padding: 0 20px;
            text-align: center;
        }
        .services-hero h1 {
            font-size: 2.3rem;
            font-weight: 800;
            color: #151C26;
            margin: 0 0 12px;
        }
        .services-hero p {
            color: #525B6B;
            font-size: 1.02rem;
            max-width: 680px;
            margin: 0 auto;
            line-height: 1.6;
        }
        .services-grid {
            max-width: 1140px;
            margin: 0 auto 72px;
            padding: 0 20px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 24px;
        }
        .service-detail-card {
            background: #FAF6F5;
            border: 1px solid #E5DCD9;
            border-radius: 20px;
            padding: 32px 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .service-detail-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 28px rgba(21, 28, 38, 0.08);
        }
        .service-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            background: #EFE1DE;
            color: #73332D;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
        }
        .service-detail-card h2 {
            font-size: 1.32rem;
            font-weight: 800;
            color: #151C26;
            margin: 0 0 10px;
        }
        .service-detail-card p {
            color: #525B6B;
            font-size: 0.92rem;
            line-height: 1.58;
            margin: 0 0 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #EAE0DD;
        }
        .service-list {
            list-style: none;
            padding: 0;
            margin: 0 0 26px;
        }
        .service-list li {
            position: relative;
            padding-left: 22px;
            margin-bottom: 11px;
            font-size: 0.89rem;
            color: #151C26;
            font-weight: 500;
            line-height: 1.45;
        }
        .service-list li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #A66658;
            font-weight: 800;
        }
        .btn-order-service {
            display: block;
            text-align: center;
            background: #73332D;
            color: #FFFFFF;
            padding: 13px 18px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.92rem;
            text-decoration: none;
            transition: background 0.25s ease;
        }
        .btn-order-service:hover {
            background: #A66658;
        }

        @media (max-width: 960px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (max-width: 640px) {
            .services-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <nav>
        <a href="index.php" class="brand-wrapper">
            <div class="brand-badge">Cp</div>
            <div class="brand-name">CreativePulse Studio</div>
        </a>
        <div class="nav-menu">
            <a href="index.php">Home</a>
            <a href="services.php" class="active">Services</a>
            <a href="index.php#portfolios">Portfolios</a>
            <a href="index.php#about">About</a>
            <a href="index.php#contact">Contact</a>
            <div class="nav-actions">
                <?php if (isset($_SESSION['client_id'])): ?>
                    <a href="client_dashboard.php" class="nav-btn-outline">Client Dashboard</a>
                <?php else: ?>
                    <a href="client_login.php" class="nav-btn-outline">Client Portal</a>
                <?php endif; ?>
                <a href="login.php" class="nav-btn">Admin Portal</a>
            </div>
        </div>
    </nav>

    <div class="services-hero">
        <h1>Agency Services &amp; Deliverables</h1>
        <p>Browse our core capabilities below. Select any service to log in to your Client Portal, set your required completion deadline, and submit your project brief.</p>
    </div>

    <div class="services-grid">

        <!-- 1. Web Design & Dev -->
        <div class="service-detail-card">
            <div>
                <div class="service-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="2" y1="20" x2="22" y2="20"></line><polyline points="9 8 6 10 9 12"></polyline><polyline points="15 8 18 10 15 12"></polyline></svg>
                </div>
                <h2>Web Design &amp; Dev</h2>
                <p>Fast, secure, and mobile-responsive websites engineered for modern businesses.</p>
                <ul class="service-list">
                    <li>Custom landing pages &amp; multi-page corporate sites</li>
                    <li>Full-stack PHP &amp; MySQL dynamic web portals</li>
                    <li>E-commerce storefronts &amp; admin dashboards</li>
                    <li>Mobile-first responsive layout &amp; speed optimization</li>
                    <li>Domain setup, SSL &amp; live server deployment</li>
                </ul>
            </div>
            <a href="quote.php?service=Web%20Design%20%26%20Dev" class="btn-order-service">Select &amp; Request Quote &rarr;</a>
        </div>

        <!-- 2. UI/UX Design -->
        <div class="service-detail-card">
            <div>
                <div class="service-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg>
                </div>
                <h2>UI/UX Design</h2>
                <p>Intuitive, user-centered interfaces designed to maximize clarity and conversion.</p>
                <ul class="service-list">
                    <li>User journey mapping &amp; information architecture</li>
                    <li>Low-fidelity &amp; high-fidelity wireframes</li>
                    <li>Interactive clickable web &amp; mobile app prototypes</li>
                    <li>Modern design systems, typography &amp; color tokens</li>
                    <li>Usability review &amp; developer-ready handoff files</li>
                </ul>
            </div>
            <a href="quote.php?service=UI%2FUX%20Design" class="btn-order-service">Select &amp; Request Quote &rarr;</a>
        </div>

        <!-- 3. Branding & Logo -->
        <div class="service-detail-card">
            <div>
                <div class="service-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19l7-7 3 3-7 7-3-3z"></path><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path><path d="M2 2l7.586 7.586"></path><circle cx="11" cy="11" r="2"></circle></svg>
                </div>
                <h2>Branding &amp; Logo</h2>
                <p>Distinctive visual identities that make your company recognizable everywhere.</p>
                <ul class="service-list">
                    <li>Primary custom logo mark, wordmark &amp; favicon</li>
                    <li>Curated brand color palette &amp; font pairing</li>
                    <li>Brand style guide &amp; visual usage rules</li>
                    <li>Business cards, letterheads &amp; stationery kits</li>
                    <li>High-resolution vector source files (SVG, PNG, PDF)</li>
                </ul>
            </div>
            <a href="quote.php?service=Branding%20%26%20Logo" class="btn-order-service">Select &amp; Request Quote &rarr;</a>
        </div>

        <!-- 4. Social Media Management -->
        <div class="service-detail-card">
            <div>
                <div class="service-icon-box">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                </div>
                <h2>Social Media Management</h2>
                <p>Consistent content systems and visual campaigns built to grow your audience.</p>
                <ul class="service-list">
                    <li>Monthly content calendar &amp; campaign strategy</li>
                    <li>Custom carousel &amp; promotional post graphics</li>
                    <li>Short-form video hooks &amp; story templates</li>
                    <li>Active audience engagement &amp; profile optimization</li>
                    <li>Monthly reach, engagement &amp; growth analytics</li>
                </ul>
            </div>
            <a href="quote.php?service=Social%20Media%20Management" class="btn-order-service">Select &amp; Request Quote &rarr;</a>
        </div>

    </div>

    <footer>
        <div class="footer-bottom">
            Make your customer the hero of your stories
        </div>
    </footer>

</body>
</html>