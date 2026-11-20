<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CreativePulse Studio | Digital Design & Development Agency</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        html {
            scroll-behavior: smooth;
        }

        /* --- 2-Second Welcome Splash Screen --- */
        #splash-screen {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #E7D4CF 0%, #DFC8C2 100%);
            color: #151C26;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        #splash-screen.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .splash-badge {
            width: 78px;
            height: 78px;
            border-radius: 18px;
            background: #A66658;
            color: #FFFFFF;
            font-size: 2.15rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 14px 32px rgba(166, 102, 88, 0.28);
            animation: pulsePop 0.9s ease-out forwards;
        }
        .splash-title {
            font-size: 1.9rem;
            font-weight: 800;
            color: #151C26;
            letter-spacing: -0.02em;
            margin: 0;
            animation: fadeUpIn 0.9s ease-out forwards;
        }
        .splash-sub {
            margin: 8px 0 0;
            color: #73332D;
            font-size: 0.95rem;
            font-weight: 600;
            animation: fadeUpIn 1.1s ease-out forwards;
        }
        @keyframes pulsePop {
            0% { transform: scale(0.75); opacity: 0; }
            70% { transform: scale(1.06); opacity: 1; }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes fadeUpIn {
            0% { transform: translateY(12px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        /* --- Centered Editorial Hero + Flanked Earth Globe Stage --- */
        .hero-editorial {
            text-align: center;
            padding: 38px 24px 36px;
            max-width: 1220px;
            min-height: calc(100vh - 72px);
            margin: 0 auto 36px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }
        .hero-top-content {
            width: 100%;
        }
        .hero-pill {
            display: inline-block;
            background: #D9D3C7;
            color: #525B6B;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 7px 18px;
            border-radius: 999px;
            margin-bottom: 16px;
        }
        .hero-editorial h1 {
            font-size: 2.25rem;
            font-weight: 800;
            color: #151C26;
            line-height: 1.25;
            letter-spacing: -0.02em;
            max-width: 1050px;
            margin: 0 auto 14px;
        }
        .hero-editorial > .hero-top-content > p {
            color: #525B6B;
            font-size: 1.02rem;
            line-height: 1.65;
            max-width: 580px;
            margin: 0 auto 22px;
        }
        .hero-buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 18px;
        }
        .btn-hero-solid {
            background: #73332D;
            color: #FFFFFF;
            padding: 13px 28px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.92rem;
            text-decoration: none;
            transition: background 0.25s ease, transform 0.2s ease;
        }
        .btn-hero-solid:hover {
            background: #A66658;
            transform: translateY(-1px);
        }
        .btn-hero-outline {
            background: transparent;
            color: #151C26;
            border: 1.5px solid #151C26;
            padding: 12px 26px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.92rem;
            text-decoration: none;
            transition: all 0.25s ease;
        }
        .btn-hero-outline:hover {
            background: #151C26;
            color: #FFFFFF;
        }

        /* --- 3-Column Showcase Around Earth Globe with Curved SVG Connectors --- */
        .hero-showcase-row {
            position: relative;
            width: 100%;
            max-width: 1140px;
            display: grid;
            grid-template-columns: 1fr 420px 1fr;
            align-items: center;
            gap: 16px;
            margin-top: 4px;
        }
        .connector-svg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 3;
        }
        .hero-side-col {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .hero-side-left {
            align-items: flex-start;
            padding-left: 16px;
        }
        .hero-side-right {
            align-items: flex-end;
            padding-right: 16px;
        }
        .glass-stat-card {
            position: relative;
            background: rgba(250, 246, 245, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(217, 211, 199, 0.95);
            border-radius: 18px;
            padding: 18px 20px;
            width: 245px;
            text-align: left;
            box-shadow: 0 12px 28px rgba(21, 28, 38, 0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .glass-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(115, 51, 45, 0.12);
        }

        /* 24/7 Wide Card with Mini Order Tracker UI Preview */
        .glass-tracker-card {
            width: 280px;
            display: grid;
            grid-template-columns: 1.05fr 0.95fr;
            gap: 12px;
            align-items: center;
            padding: 16px 18px;
        }
        .glass-tracker-card h3 {
            font-size: 1.65rem;
            font-weight: 800;
            color: #151C26;
            margin: 0 0 4px;
            line-height: 1.1;
        }
        .glass-tracker-card p {
            margin: 0;
            font-size: 0.82rem;
            font-weight: 600;
            color: #525B6B;
            line-height: 1.35;
        }
        .mini-tracker-ui {
            background: #FFFFFF;
            border: 1px solid #E5DCD9;
            border-radius: 11px;
            padding: 9px 10px;
            box-shadow: 0 4px 12px rgba(21, 28, 38, 0.05);
        }
        .mini-ui-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 7px;
        }
        .mini-ui-dots {
            display: flex;
            gap: 3px;
        }
        .mini-ui-dots span {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            background: #D9D3C7;
        }
        .mini-ui-check {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #73332D;
            color: #FFFFFF;
            font-size: 0.6rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .mini-ui-bar {
            height: 6px;
            border-radius: 4px;
            background: #EFE1DE;
            margin-bottom: 6px;
            overflow: hidden;
        }
        .mini-ui-bar-fill {
            height: 100%;
            border-radius: 4px;
            background: #A66658;
        }
        .mini-ui-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 7px;
        }
        .mini-ui-tag {
            background: #EFE1DE;
            color: #73332D;
            font-size: 0.56rem;
            font-weight: 800;
            padding: 2px 6px;
            border-radius: 4px;
        }
        .mini-ui-ring {
            width: 13px;
            height: 13px;
            border-radius: 50%;
            border: 2px solid #95ACBF;
            border-top-color: #73332D;
        }

        .glass-card-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4px;
        }
        .glass-stat-card h3 {
            font-size: 1.65rem;
            font-weight: 800;
            color: #151C26;
            margin: 0;
            line-height: 1.1;
        }
        .glass-mini-badge {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            background: #EFE1DE;
            color: #73332D;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .glass-stat-card p {
            margin: 4px 0 0;
            font-size: 0.84rem;
            font-weight: 600;
            color: #525B6B;
            line-height: 1.4;
        }

        /* Center Globe Stage + Radiant Terracotta Halo + Orbital Pills */
        .hero-globe-stage {
            position: relative;
            z-index: 2;
            width: 410px;
            height: 390px;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            background: radial-gradient(
                circle,
                rgba(166, 102, 88, 0.36) 0%,
                rgba(166, 102, 88, 0.18) 48%,
                rgba(239, 225, 222, 0) 72%
            );
        }
        #earthGlobe {
            width: 360px;
            height: 360px;
            cursor: grab;
        }
        #earthGlobe:active {
            cursor: grabbing;
        }
        .orbit-pill {
            position: absolute;
            background: rgba(250, 246, 245, 0.94);
            border: 1px solid #D9D3C7;
            color: #151C26;
            font-size: 0.78rem;
            font-weight: 700;
            padding: 6px 15px;
            border-radius: 999px;
            text-decoration: none;
            box-shadow: 0 6px 16px rgba(21, 28, 38, 0.06);
            transition: all 0.2s ease;
            z-index: 4;
        }
        .orbit-pill:hover {
            background: #73332D;
            color: #FFFFFF;
            border-color: #73332D;
        }
        .pill-web { top: 24px; right: -26px; }
        .pill-uiux { bottom: 112px; right: -34px; }
        .pill-brand { bottom: 24px; left: -34px; }

        /* --- About CreativePulse Studio Card --- */
        .about-wrapper {
            max-width: 1140px;
            margin: 0 auto 76px;
            padding: 28px 20px 0;
            scroll-margin-top: 76px;
        }
        .about-card {
            background: #FAF6F5;
            border: 1px solid #E5DCD9;
            border-radius: 22px;
            padding: 48px 44px;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 40px;
            align-items: center;
        }
        .eyebrow-terracotta {
            display: block;
            color: #A66658;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 12px;
        }
        .about-card h2 {
            font-size: 2rem;
            font-weight: 800;
            color: #151C26;
            line-height: 1.25;
            margin: 0 0 18px;
        }
        .about-card p {
            color: #525B6B;
            font-size: 0.96rem;
            line-height: 1.68;
            margin: 0 0 16px;
        }
        .link-arrow {
            display: inline-block;
            margin-top: 6px;
            color: #73332D;
            font-weight: 700;
            font-size: 0.94rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .link-arrow:hover {
            color: #A66658;
        }
        .about-metrics-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .metric-box {
            background: #EFE1DE;
            border: 1px solid #E2D1CD;
            border-radius: 16px;
            padding: 28px 18px;
            text-align: center;
        }
        .metric-box h3 {
            font-size: 1.85rem;
            font-weight: 800;
            color: #73332D;
            margin: 0 0 6px;
        }
        .metric-box p {
            margin: 0;
            font-size: 0.84rem;
            font-weight: 700;
            color: #151C26;
        }

        /* --- Featured Portfolio Band --- */
        .portfolio-band {
            background: #D9D3C7;
            padding: 72px 20px;
            margin-bottom: 72px;
            scroll-margin-top: 72px;
        }
        .portfolio-band-inner {
            max-width: 1140px;
            margin: 0 auto;
        }
        .section-center-head {
            text-align: center;
            max-width: 660px;
            margin: 0 auto 42px;
        }
        .section-center-head h2 {
            font-size: 2.05rem;
            font-weight: 800;
            color: #151C26;
            line-height: 1.25;
            margin: 0 0 12px;
        }
        .section-center-head p {
            color: #525B6B;
            font-size: 0.96rem;
            line-height: 1.6;
            margin: 0;
        }
        .featured-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 22px;
        }
        .featured-card {
            background: #FAF6F5;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 10px 24px rgba(21, 28, 38, 0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .featured-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 32px rgba(21, 28, 38, 0.12);
        }
        .featured-banner {
            padding: 20px 22px 24px;
            min-height: 138px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: #FFFFFF;
        }
        .banner-web {
            background: linear-gradient(135deg, #27323F 0%, #839BB0 100%);
        }
        .banner-uiux {
            background: linear-gradient(135deg, #6E322C 0%, #A66658 100%);
        }
        .banner-brand {
            background: linear-gradient(135deg, #9C6961 0%, #98AEBF 100%);
        }
        .banner-social {
            background: linear-gradient(135deg, #21252D 0%, #6A302A 100%);
        }
        .banner-chip {
            display: inline-block;
            align-self: flex-start;
            background: rgba(255, 255, 255, 0.18);
            color: #FFFFFF;
            font-size: 0.68rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 5px 11px;
            border-radius: 999px;
        }
        .featured-banner h3 {
            margin: 0;
            font-size: 1.15rem;
            font-weight: 800;
            color: #FFFFFF;
        }
        .featured-body {
            padding: 22px;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .featured-body h4 {
            font-size: 1.02rem;
            font-weight: 800;
            color: #151C26;
            margin: 0 0 8px;
        }
        .featured-body p {
            font-size: 0.88rem;
            color: #525B6B;
            line-height: 1.55;
            margin: 0 0 18px;
        }
        .featured-link {
            color: #73332D;
            font-size: 0.86rem;
            font-weight: 700;
            text-decoration: none;
        }
        .featured-link:hover {
            color: #A66658;
        }

        /* --- Why Partner With Us / What Sets Us Apart --- */
        .partner-section {
            max-width: 1140px;
            margin: 0 auto 80px;
            padding: 0 20px;
        }
        .partner-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
            gap: 24px;
        }
        .partner-card {
            background: #FAF6F5;
            border: 1px solid #E5DCD9;
            border-radius: 20px;
            padding: 38px 28px;
            text-align: center;
        }
        .partner-circle {
            width: 58px;
            height: 58px;
            border-radius: 50%;
            background: #A66658;
            color: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 8px 20px rgba(166, 102, 88, 0.25);
        }
        .partner-card h3 {
            color: #73332D;
            font-size: 1.22rem;
            font-weight: 800;
            margin: 0 0 12px;
        }
        .partner-card p {
            color: #525B6B;
            font-size: 0.93rem;
            line-height: 1.65;
            margin: 0;
        }

        /* --- Editorial Dark Footer --- */
        .site-footer {
            background: #151C26;
            color: #EFE1DE;
            padding: 56px 24px 28px;
        }
        .footer-inner {
            max-width: 1140px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1.4fr 1fr 1fr 1fr;
            gap: 32px;
            padding-bottom: 36px;
            border-bottom: 1px solid rgba(239, 225, 222, 0.14);
        }
        .footer-brand-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 800;
            font-size: 1.15rem;
            color: #FFFFFF;
            margin-bottom: 14px;
        }
        .footer-headline {
            font-size: 1.35rem;
            font-weight: 800;
            line-height: 1.3;
            color: #FFFFFF;
            margin: 0;
        }
        .footer-headline span {
            color: #95ACBF;
        }
        .footer-col h4 {
            color: #A66658;
            margin: 0 0 14px;
            font-size: 0.95rem;
        }
        .footer-col a, .footer-col p {
            display: block;
            color: #D9D3C7;
            text-decoration: none;
            font-size: 0.9rem;
            margin: 0 0 10px;
            transition: color 0.2s;
        }
        .footer-col a:hover {
            color: #FFFFFF;
        }

        @media (max-width: 1040px) {
            .hero-editorial {
                min-height: auto;
            }
            .hero-editorial h1 {
                font-size: 1.85rem;
            }
            .hero-showcase-row {
                grid-template-columns: 1fr;
                justify-items: center;
            }
            .connector-svg {
                display: none;
            }
            .hero-side-left, .hero-side-right {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
                align-items: stretch;
                padding: 0;
            }
            .about-card {
                grid-template-columns: 1fr;
                padding: 32px 24px;
            }
            .footer-inner {
                grid-template-columns: 1fr 1fr;
            }
        }
        @media (max-width: 540px) {
            .footer-inner {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- 2-Second Welcome Splash Screen -->
    <div id="splash-screen">
        <div class="splash-badge">Cp</div>
        <h2 class="splash-title">Welcome to CreativePulse</h2>
        <p class="splash-sub">Digital Design, Branding &amp; Engineering Studio</p>
    </div>

    <!-- Navigation Bar -->
    <nav>
        <a href="index.php" class="brand-wrapper">
            <div class="brand-badge">Cp</div>
            <div class="brand-name">CreativePulse Studio</div>
        </a>
        <div class="nav-menu">
            <a href="index.php" class="active">Home</a>
            <a href="services.php">Services</a>
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

    <!-- 1. Centered Hero Section + Flanked High-Detail Earth Globe -->
    <section class="hero-editorial">
        <div class="hero-top-content">
            <span class="hero-pill">CREATIVEPULSE DIGITAL AGENCY</span>
            <h1>ELEVATE YOUR BRAND, ELEVATE YOUR SUCCESS</h1>
            <p>We craft bespoke websites, intuitive digital interfaces, memorable brand identities, and high-converting social campaigns.</p>
            <div class="hero-buttons">
                <a href="services.php" class="btn-hero-solid">Explore Our Services</a>
                <a href="quote.php" class="btn-hero-outline">Request a Project Quote</a>
            </div>
        </div>

        <div class="hero-showcase-row">
            <!-- Curved S-Shaped Dotted SVG Connector Lines Touching the Globe Edge -->
            <svg class="connector-svg" viewBox="0 0 1140 390" preserveAspectRatio="none">
                <!-- Left Top Card (24/7) to Globe Edge -->
                <path d="M 304 125 C 365 125, 378 133, 438 133" fill="none" stroke="rgba(166,102,88,0.5)" stroke-width="1.5" stroke-dasharray="3,4"/>
                <circle cx="304" cy="125" r="3" fill="#A66658" opacity="0.7"/>
                <circle cx="438" cy="133" r="3.5" fill="#73332D"/>

                <!-- Left Bottom Card (4+) to Lower Globe Edge -->
                <path d="M 270 258 C 345 258, 368 264, 441 264" fill="none" stroke="rgba(166,102,88,0.5)" stroke-width="1.5" stroke-dasharray="3,4"/>
                <circle cx="270" cy="258" r="3" fill="#A66658" opacity="0.7"/>
                <circle cx="441" cy="264" r="3.5" fill="#73332D"/>

                <!-- Branding Pill to Globe Edge -->
                <path d="M 426 346 Q 456 336, 486 315" fill="none" stroke="rgba(166,102,88,0.5)" stroke-width="1.5" stroke-dasharray="3,4"/>
                <circle cx="486" cy="315" r="3.5" fill="#73332D"/>

                <!-- Web Design Pill to Globe Edge -->
                <path d="M 698 44 Q 678 60, 660 80" fill="none" stroke="rgba(166,102,88,0.5)" stroke-width="1.5" stroke-dasharray="3,4"/>
                <circle cx="660" cy="80" r="3.5" fill="#73332D"/>

                <!-- UI/UX Pill to Globe Edge -->
                <path d="M 744 260 Q 724 256, 705 250" fill="none" stroke="rgba(166,102,88,0.5)" stroke-width="1.5" stroke-dasharray="3,4"/>
                <circle cx="705" cy="250" r="3.5" fill="#73332D"/>

                <!-- Right Top Card (100%) to Globe Edge -->
                <path d="M 870 132 C 800 132, 780 150, 709 150" fill="none" stroke="rgba(166,102,88,0.5)" stroke-width="1.5" stroke-dasharray="3,4"/>
                <circle cx="870" cy="132" r="3" fill="#A66658" opacity="0.7"/>
                <circle cx="709" cy="150" r="3.5" fill="#73332D"/>

                <!-- Right Bottom Card (24h) to Globe Edge -->
                <path d="M 870 268 C 795 268, 765 293, 678 293" fill="none" stroke="rgba(166,102,88,0.5)" stroke-width="1.5" stroke-dasharray="3,4"/>
                <circle cx="870" cy="268" r="3" fill="#A66658" opacity="0.7"/>
                <circle cx="678" cy="293" r="3.5" fill="#73332D"/>
            </svg>

            <!-- Left Floating Metric Cards -->
            <div class="hero-side-col hero-side-left">
                <!-- 24/7 Card with Mini Tracker Preview -->
                <div class="glass-stat-card glass-tracker-card">
                    <div>
                        <h3>24/7</h3>
                        <p>Real-Time Tracking</p>
                    </div>
                    <div class="mini-tracker-ui" aria-hidden="true">
                        <div class="mini-ui-header">
                            <div class="mini-ui-dots"><span></span><span></span><span></span></div>
                            <span class="mini-ui-check">✓</span>
                        </div>
                        <div class="mini-ui-bar"><div class="mini-ui-bar-fill" style="width: 78%;"></div></div>
                        <div class="mini-ui-bar" style="width: 72%;"><div class="mini-ui-bar-fill" style="width: 100%; background: #95ACBF;"></div></div>
                        <div class="mini-ui-row">
                            <span class="mini-ui-tag">ACTIVE</span>
                            <span class="mini-ui-ring"></span>
                        </div>
                    </div>
                </div>

                <!-- 4+ Card -->
                <div class="glass-stat-card">
                    <div class="glass-card-top">
                        <h3>4+</h3>
                        <span class="glass-mini-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>
                        </span>
                    </div>
                    <p>Core Disciplines</p>
                </div>
            </div>

            <!-- Center Interactive 3D Earth Globe + Tight Geodesic Cage + Orbital Pills -->
            <div class="hero-globe-stage">
                <a href="services.php" class="orbit-pill pill-web">Web Design</a>
                <a href="services.php" class="orbit-pill pill-uiux">UI/UX</a>
                <a href="services.php" class="orbit-pill pill-brand">Branding</a>
                <canvas id="earthGlobe" width="360" height="360"></canvas>
            </div>

            <!-- Right Floating Metric Cards -->
            <div class="hero-side-col hero-side-right">
                <div class="glass-stat-card">
                    <div class="glass-card-top">
                        <h3>100%</h3>
                        <span class="glass-mini-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </span>
                    </div>
                    <p>Live pipeline visibility</p>
                </div>

                <div class="glass-stat-card">
                    <div class="glass-card-top">
                        <h3>24h</h3>
                        <span class="glass-mini-badge">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        </span>
                    </div>
                    <p>Brief review turnaround</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. About CreativePulse Studio Section -->
    <section id="about" class="about-wrapper">
        <div class="about-card">
            <div>
                <span class="eyebrow-terracotta">ABOUT CREATIVEPULSE STUDIO</span>
                <h2>Where Creative Strategy Meets Full-Stack Engineering</h2>
                <p>CreativePulse Studio is a multidisciplinary digital agency dedicated to helping startups, local enterprises, and modern brands build a commanding digital presence.</p>
                <p>Through our dedicated Client &amp; Order Management Portal, clients can inspect detailed service packages, submit project briefs in seconds, and monitor real-time production milestones from initial review to final delivery.</p>
                <a href="services.php" class="link-arrow">Browse Service Packages &rarr;</a>
            </div>
            <div class="about-metrics-grid">
                <div class="metric-box">
                    <h3>4+</h3>
                    <p>Core Digital Disciplines</p>
                </div>
                <div class="metric-box">
                    <h3>24h</h3>
                    <p>Brief Review Turnaround</p>
                </div>
                <div class="metric-box">
                    <h3>100%</h3>
                    <p>Live Pipeline Visibility</p>
                </div>
                <div class="metric-box">
                    <h3>24/7</h3>
                    <p>Online Order Tracking</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Featured Portfolio Band -->
    <section id="portfolios" class="portfolio-band">
        <div class="portfolio-band-inner">
            <div class="section-center-head">
                <span class="eyebrow-terracotta">FEATURED PORTFOLIO</span>
                <h2>Selected Works Across Our Four Core Services</h2>
                <p>Explore recent client deliverables spanning full-stack web platforms, UI/UX systems, visual branding, and social media growth.</p>
            </div>

            <div class="featured-grid">
                <div class="featured-card">
                    <div class="featured-banner banner-web">
                        <span class="banner-chip">WEB DESIGN &amp; DEV</span>
                        <h3>The Artisan Collective</h3>
                    </div>
                    <div class="featured-body">
                        <div>
                            <h4>Custom E-Commerce Portal</h4>
                            <p>Responsive storefront with integrated inventory management and streamlined checkout workflows.</p>
                        </div>
                        <a href="quote.php?service=Web%20Design%20%26%20Dev" class="featured-link">Order Web Design &rarr;</a>
                    </div>
                </div>

                <div class="featured-card">
                    <div class="featured-banner banner-uiux">
                        <span class="banner-chip">UI/UX DESIGN</span>
                        <h3>Flow Capital App</h3>
                    </div>
                    <div class="featured-body">
                        <div>
                            <h4>FinTech Mobile &amp; Web Interface</h4>
                            <p>User-centered wireframes, interactive prototypes, and clean dashboard architecture.</p>
                        </div>
                        <a href="quote.php?service=UI%2FUX%20Design" class="featured-link">Order UI/UX Design &rarr;</a>
                    </div>
                </div>

                <div class="featured-card">
                    <div class="featured-banner banner-brand">
                        <span class="banner-chip">BRANDING &amp; LOGO</span>
                        <h3>AeroSpace Ventures</h3>
                    </div>
                    <div class="featured-body">
                        <div>
                            <h4>Complete Visual Identity Kit</h4>
                            <p>Custom monogram logo mark, editorial typography, and cohesive brand color guidelines.</p>
                        </div>
                        <a href="quote.php?service=Branding%20%26%20Logo" class="featured-link">Order Branding &rarr;</a>
                    </div>
                </div>

                <div class="featured-card">
                    <div class="featured-banner banner-social">
                        <span class="banner-chip">SOCIAL MEDIA</span>
                        <h3>Pulse Commerce Growth</h3>
                    </div>
                    <div class="featured-body">
                        <div>
                            <h4>Campaign &amp; Content Strategy</h4>
                            <p>High-retention visual grid templates, short-form video hooks, and audience engagement systems.</p>
                        </div>
                        <a href="quote.php?service=Social%20Media%20Management" class="featured-link">Order Social Media &rarr;</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Why Partner With Us / What Sets Us Apart -->
    <section class="partner-section">
        <div class="section-center-head">
            <span class="eyebrow-terracotta">WHY PARTNER WITH US</span>
            <h2>WHAT SETS US APART</h2>
        </div>

        <div class="partner-grid">
            <div class="partner-card">
                <div class="partner-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                </div>
                <h3>Results Driven</h3>
                <p>With focused digital expertise, we provide data-backed insights and innovative solutions that keep your brand ahead.</p>
            </div>

            <div class="partner-card">
                <div class="partner-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"></circle><path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path></svg>
                </div>
                <h3>Industry Expertise</h3>
                <p>We work alongside you, crafting personalized strategies. Our mission isn't done until you're thrilled with the final deliverable.</p>
            </div>

            <div class="partner-card">
                <div class="partner-circle">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <h3>Dedicated Team</h3>
                <p>Our passionate designers and engineers become an extension of your team, delivering transparent milestones every step of the way.</p>
            </div>
        </div>
    </section>

    <!-- 5. Contact / Footer -->
    <footer id="contact" class="site-footer">
        <div class="footer-inner">
            <div>
                <div class="footer-brand-title">
                    <div class="brand-badge">Cp</div>
                    <span>CreativePulse Studio</span>
                </div>
                <p class="footer-headline">READY TO ELEVATE YOUR <span>BUSINESS?</span></p>
            </div>
            <div class="footer-col">
                <h4>Company</h4>
                <a href="index.php">Home</a>
                <a href="index.php#portfolios">Portfolios</a>
                <a href="services.php">Services</a>
                <a href="client_login.php">Client Portal</a>
            </div>
            <div class="footer-col">
                <h4>Services</h4>
                <a href="services.php">Web Design &amp; Dev</a>
                <a href="services.php">UI/UX Design</a>
                <a href="services.php">Branding &amp; Logo</a>
                <a href="services.php">Social Media Management</a>
            </div>
            <div class="footer-col">
                <h4>Contact</h4>
                <p>Khulna, Bangladesh</p>
                <p>hello@creativepulse.studio</p>
            </div>
        </div>
        <div class="footer-bottom" style="margin-top:22px;">
            Make your customer the hero of your stories
        </div>
    </footer>

    <script>
        // Exact 2-Second Welcome Splash Animation
        window.addEventListener('load', () => {
            setTimeout(() => {
                const splash = document.getElementById('splash-screen');
                if (splash) splash.classList.add('hidden');
            }, 2000);
        });

        // High-Detail Interactive 3D Earth Globe + Tight Outer Geodesic Wireframe Cage
        (function () {
            const canvas = document.getElementById('earthGlobe');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            const w = canvas.width;
            const h = canvas.height;
            const cx = w / 2;
            const cy = h / 2;
            const earthR = 141;
            const cageR  = 146;

            // High-Detail Continental Coastline Polygons (lat, lon in degrees)
            const rawContinents = [
                // North America
                [[71,-156],[70,-140],[69,-133],[72,-125],[74,-95],[68,-82],[62,-78],[58,-63],[52,-56],[47,-53],[44,-64],[41,-70],[35,-76],[25,-80],[25,-82],[30,-85],[29,-95],[21,-97],[18,-92],[21,-87],[15,-84],[9,-79],[8,-78],[14,-92],[19,-104],[23,-106],[31,-114],[24,-111],[32,-117],[38,-123],[48,-125],[58,-137],[60,-148],[55,-162],[61,-166],[66,-168]],
                // Greenland
                [[60,-44],[65,-38],[72,-22],[81,-18],[83,-35],[78,-68],[72,-56],[65,-52]],
                // South America
                [[11,-74],[10,-62],[6,-53],[0,-50],[-5,-35],[-13,-38],[-23,-42],[-34,-53],[-41,-63],[-52,-68],[-55,-67],[-52,-75],[-42,-74],[-30,-71],[-18,-70],[-5,-81],[2,-78],[8,-77]],
                // Europe
                [[36,-9],[37,-6],[43,-9],[43,-2],[48,-5],[51,2],[54,8],[58,10],[55,13],[60,18],[65,25],[70,28],[70,52],[62,58],[52,55],[46,48],[44,39],[41,29],[38,24],[37,15],[41,16],[44,12],[43,5],[39,0]],
                // UK & Ireland
                [[50,-5],[53,-4],[58,-5],[58,-2],[53,1],[51,1]],
                // Africa
                [[35,-6],[37,10],[33,12],[32,20],[31,32],[22,37],[12,44],[11,51],[2,45],[-4,40],[-11,40],[-16,36],[-24,35],[-34,26],[-34,18],[-28,16],[-17,12],[-6,12],[4,9],[6,2],[5,-8],[11,-16],[15,-17],[21,-17],[28,-13]],
                // Madagascar
                [[-13,49],[-16,50],[-25,47],[-25,44],[-17,44]],
                // Asia
                [[41,29],[42,41],[46,48],[55,60],[68,58],[73,80],[76,104],[72,130],[67,170],[60,164],[52,157],[44,135],[38,122],[31,122],[23,117],[21,108],[12,109],[9,104],[14,100],[2,103],[6,96],[16,94],[22,91],[21,87],[14,80],[8,77],[16,73],[23,68],[25,57],[30,48],[24,38],[13,43],[16,52],[23,59],[27,50],[33,35],[36,36],[37,27]],
                // Japan
                [[31,131],[35,137],[40,141],[44,144],[42,140],[35,132]],
                // Indonesia / Borneo / New Guinea
                [[5,96],[-6,106],[-8,115],[-2,117],[4,118],[1,109]],
                [[-2,132],[-5,146],[-10,149],[-8,138]],
                // Australia
                [[-12,131],[-12,136],[-17,141],[-11,142],[-19,147],[-28,153],[-37,150],[-38,144],[-35,136],[-32,128],[-34,115],[-22,114],[-16,123]]
            ];

            function subdividePoly(poly, maxStepDeg = 6) {
                const dense = [];
                for (let i = 0; i < poly.length; i++) {
                    const [lat1, lon1] = poly[i];
                    const [lat2, lon2] = poly[(i + 1) % poly.length];
                    const dist = Math.hypot(lat2 - lat1, lon2 - lon1);
                    const steps = Math.max(1, Math.ceil(dist / maxStepDeg));
                    for (let s = 0; s < steps; s++) {
                        const t = s / steps;
                        const lat = ((lat1 + (lat2 - lat1) * t) * Math.PI) / 180;
                        const lon = ((lon1 + (lon2 - lon1) * t) * Math.PI) / 180;
                        dense.push({
                            x: Math.cos(lat) * Math.sin(lon),
                            y: -Math.sin(lat),
                            z: Math.cos(lat) * Math.cos(lon)
                        });
                    }
                }
                return dense;
            }

            const landPolys = rawContinents.map(p => subdividePoly(p, 6));

            // Tight Outer Geodesic Wireframe Cage Nodes
            const cageNodes = [];
            const numNodes = 96;
            const goldenAngle = Math.PI * (3 - Math.sqrt(5));
            for (let i = 0; i < numNodes; i++) {
                const y = 1 - (i / (numNodes - 1)) * 2;
                const r = Math.sqrt(1 - y * y);
                const theta = goldenAngle * i;
                cageNodes.push({
                    x: Math.cos(theta) * r,
                    y: y,
                    z: Math.sin(theta) * r
                });
            }

            let rotY = -0.32;
            let rotX = 0.24;
            let targetVelY = 0.0045;
            let targetVelX = 0;
            let isDragging = false;
            let lastX = 0;
            let lastY = 0;

            canvas.addEventListener('mousedown', (e) => {
                isDragging = true;
                lastX = e.clientX;
                lastY = e.clientY;
            });

            window.addEventListener('mouseup', () => {
                isDragging = false;
            });

            const showcaseRow = document.querySelector('.hero-showcase-row');
            showcaseRow.addEventListener('mousemove', (e) => {
                const rect = canvas.getBoundingClientRect();
                if (isDragging) {
                    rotY += (e.clientX - lastX) * 0.008;
                    rotX += (e.clientY - lastY) * 0.008;
                    rotX = Math.max(-0.85, Math.min(0.85, rotX));
                    lastX = e.clientX;
                    lastY = e.clientY;
                } else {
                    const normX = (e.clientX - (rect.left + rect.width / 2)) / 380;
                    const normY = (e.clientY - (rect.top + rect.height / 2)) / 260;
                    targetVelY = Math.max(-0.032, Math.min(0.032, normX * 0.026));
                    targetVelX = Math.max(-0.015, Math.min(0.015, normY * 0.012));
                }
            });

            showcaseRow.addEventListener('mouseleave', () => {
                targetVelY = 0.0045;
                targetVelX = 0;
            });

            function projectPoint(p, r) {
                let x1 = p.x * Math.cos(rotY) - p.z * Math.sin(rotY);
                let z1 = p.z * Math.cos(rotY) + p.x * Math.sin(rotY);
                let y2 = p.y * Math.cos(rotX) - z1 * Math.sin(rotX);
                let z2 = z1 * Math.cos(rotX) + p.y * Math.sin(rotX);
                return {
                    px: cx + x1 * r,
                    py: cy + y2 * r,
                    pz: z2
                };
            }

            function draw() {
                ctx.clearRect(0, 0, w, h);

                // Warm Terracotta Halo around the Earth Sphere
                const aura = ctx.createRadialGradient(cx, cy, earthR * 0.9, cx, cy, cageR + 24);
                aura.addColorStop(0, 'rgba(166, 102, 88, 0.34)');
                aura.addColorStop(0.65, 'rgba(166, 102, 88, 0.14)');
                aura.addColorStop(1, 'rgba(239, 225, 222, 0)');
                ctx.beginPath();
                ctx.arc(cx, cy, cageR + 24, 0, Math.PI * 2);
                ctx.fillStyle = aura;
                ctx.fill();

                // 1. Clipped Earth Sphere (Oceans + Continents)
                ctx.save();
                ctx.beginPath();
                ctx.arc(cx, cy, earthR, 0, Math.PI * 2);
                ctx.clip();

                // Steel-Blue Ocean Gradient
                const oceanGrad = ctx.createRadialGradient(cx - 44, cy - 44, earthR * 0.1, cx, cy, earthR * 1.15);
                oceanGrad.addColorStop(0, '#DCE6EE');
                oceanGrad.addColorStop(0.55, '#95ACBF');
                oceanGrad.addColorStop(1, '#586D80');
                ctx.fillStyle = oceanGrad;
                ctx.fillRect(cx - earthR, cy - earthR, earthR * 2, earthR * 2);

                // Latitude & Longitude Graticule Lines
                ctx.strokeStyle = 'rgba(255, 255, 255, 0.24)';
                ctx.lineWidth = 0.8;
                for (let latDeg = -60; latDeg <= 60; latDeg += 30) {
                    const lat = (latDeg * Math.PI) / 180;
                    ctx.beginPath();
                    let started = false;
                    for (let lonDeg = -180; lonDeg <= 180; lonDeg += 5) {
                        const lon = (lonDeg * Math.PI) / 180;
                        const pt = projectPoint({
                            x: Math.cos(lat) * Math.sin(lon),
                            y: -Math.sin(lat),
                            z: Math.cos(lat) * Math.cos(lon)
                        }, earthR);
                        if (pt.pz > 0) {
                            if (!started) { ctx.moveTo(pt.px, pt.py); started = true; }
                            else ctx.lineTo(pt.px, pt.py);
                        } else {
                            started = false;
                        }
                    }
                    ctx.stroke();
                }

                // Detailed Continents (Terracotta #A66658 to Burgundy #73332D)
                const landGrad = ctx.createLinearGradient(cx - earthR, cy - earthR, cx + earthR, cy + earthR);
                landGrad.addColorStop(0, '#B9786A');
                landGrad.addColorStop(0.52, '#9A5648');
                landGrad.addColorStop(1, '#6C2F29');

                landPolys.forEach(poly => {
                    const proj = poly.map(p => projectPoint(p, earthR));
                    const frontCount = proj.filter(pt => pt.pz > 0).length;
                    if (frontCount < 3) return;

                    ctx.beginPath();
                    proj.forEach((pt, idx) => {
                        let vx = pt.px;
                        let vy = pt.py;
                        if (pt.pz < 0) {
                            const angle = Math.atan2(vy - cy, vx - cx);
                            vx = cx + Math.cos(angle) * (earthR + 2);
                            vy = cy + Math.sin(angle) * (earthR + 2);
                        }
                        if (idx === 0) ctx.moveTo(vx, vy);
                        else ctx.lineTo(vx, vy);
                    });
                    ctx.closePath();
                    ctx.fillStyle = landGrad;
                    ctx.fill();
                    ctx.strokeStyle = 'rgba(115, 51, 45, 0.6)';
                    ctx.lineWidth = 0.95;
                    ctx.stroke();
                });

                // 3D Spherical Rim Shading
                const rimShadow = ctx.createRadialGradient(cx - 26, cy - 26, earthR * 0.66, cx, cy, earthR);
                rimShadow.addColorStop(0, 'rgba(21, 28, 38, 0)');
                rimShadow.addColorStop(1, 'rgba(21, 28, 38, 0.3)');
                ctx.fillStyle = rimShadow;
                ctx.fillRect(cx - earthR, cy - earthR, earthR * 2, earthR * 2);

                ctx.restore();

                // 2. Tight Outer Geodesic Wireframe Cage Hugging the Earth
                ctx.beginPath();
                ctx.arc(cx, cy, cageR, 0, Math.PI * 2);
                ctx.strokeStyle = 'rgba(166, 102, 88, 0.45)';
                ctx.lineWidth = 1.3;
                ctx.stroke();

                const projectedCage = cageNodes.map(p => projectPoint(p, cageR));

                // Mesh Connections
                for (let i = 0; i < projectedCage.length; i++) {
                    for (let j = i + 1; j < projectedCage.length; j++) {
                        const a = projectedCage[i];
                        const b = projectedCage[j];
                        if (a.pz < -0.15 && b.pz < -0.15) continue;
                        const dist = Math.hypot(a.px - b.px, a.py - b.py);
                        if (dist < 58) {
                            const alpha = (1 - dist / 58) * 0.38;
                            ctx.beginPath();
                            ctx.moveTo(a.px, a.py);
                            ctx.lineTo(b.px, b.py);
                            ctx.strokeStyle = `rgba(115, 51, 45, ${alpha})`;
                            ctx.lineWidth = 0.95;
                            ctx.stroke();
                        }
                    }
                }

                // Cage Vertices / Nodes
                for (let i = 0; i < projectedCage.length; i++) {
                    const p = projectedCage[i];
                    if (p.pz < -0.2) continue;
                    ctx.beginPath();
                    ctx.arc(p.px, p.py, p.pz > 0 ? 2.4 : 1.5, 0, Math.PI * 2);
                    ctx.fillStyle = i % 3 === 0 ? '#73332D' : '#151C26';
                    ctx.fill();
                }

                if (!isDragging) {
                    rotY += targetVelY;
                    rotX = Math.max(-0.6, Math.min(0.6, rotX + targetVelX));
                }
                requestAnimationFrame(draw);
            }
            draw();
        })();
    </script>

</body>
</html>