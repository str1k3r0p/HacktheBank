<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HackMeBank - Secure Banking for Learning</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Rajdhani:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <!-- Swiper.js for sliders -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.css">
    <!-- AOS library for scroll animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <!-- Custom styles -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/cyberpunk-theme.css" rel="stylesheet">
    <!-- Security display CSS -->
    <link href="css/security-display.css" rel="stylesheet">
    <!-- Highlight.js for code display -->
    <link href="css/highlight.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <style>
        :root {
            --cyber-primary: #00eeff;
            --cyber-secondary: #ff00a0;
            --cyber-tertiary: #ffdd00;
            --cyber-quaternary: #7700ff;
            --cyber-bg-dark: #0a0e17;
            --cyber-bg-medium: #131a2a;
            --cyber-bg-light: #1c2538;
            --cyber-text-bright: #ffffff;
            --cyber-text-dim: #a2b0cc;
            --cyber-danger: #ff3e3e;
            --cyber-success: #00ff8c;
            --cyber-warning: #ffcc00;
        }
        
        body {
            background: linear-gradient(135deg, var(--cyber-bg-dark) 0%, var(--cyber-bg-medium) 100%);
            color: var(--cyber-text-bright);
            font-family: 'Rajdhani', sans-serif;
            position: relative;
            min-height: 100vh;
        }
        
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 238, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 238, 255, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
            z-index: -1;
            pointer-events: none;
        }
        
        .navbar {
            background: rgba(10, 14, 23, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 238, 255, 0.2);
            padding: 0.5rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            color: var(--cyber-primary);
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
        }
        
        .navbar-brand img {
            filter: drop-shadow(0 0 5px var(--cyber-primary));
        }
        
        .navbar-nav .nav-link {
            color: var(--cyber-text-dim);
            font-family: 'Share Tech Mono', monospace;
            padding: 0.5rem 1rem;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover, 
        .navbar-nav .nav-link.active {
            color: var(--cyber-primary);
        }
        
        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, var(--cyber-primary), transparent);
            transition: width 0.3s ease;
        }
        
        .navbar-nav .nav-link:hover::after, 
        .navbar-nav .nav-link.active::after {
            width: 100%;
        }
        
        .dropdown-menu {
            background: var(--cyber-bg-medium);
            border: 1px solid var(--cyber-primary);
            box-shadow: 0 5px 15px rgba(0, 238, 255, 0.2);
        }
        
        .dropdown-item {
            color: var(--cyber-text-dim);
            font-family: 'Share Tech Mono', monospace;
        }
        
        .dropdown-item:hover {
            background: rgba(0, 238, 255, 0.1);
            color: var(--cyber-primary);
        }
        
        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(0, 0, 20, 0.7) 0%, rgba(10, 14, 23, 0.7) 100%);
            padding: 6rem 0;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('assets/images/cyberpunk-grid.png');
            background-size: cover;
            background-position: center;
            opacity: 0.15;
            z-index: -1;
        }
        
        .hero-section::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 70% 30%, rgba(0, 255, 255, 0.1) 0%, transparent 60%),
                radial-gradient(circle at 30% 70%, rgba(255, 0, 160, 0.1) 0%, transparent 60%);
            z-index: -1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 4.5rem;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            background: linear-gradient(to right, var(--cyber-primary), var(--cyber-secondary), var(--cyber-tertiary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 20px rgba(0, 238, 255, 0.6);
        }
        
        .hero-subtitle {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: var(--cyber-text-dim);
            font-family: var(--cyber-font-mono);
        }
        
        .btn-primary {
            background: linear-gradient(45deg, var(--cyber-primary), var(--cyber-quaternary));
            border: none;
            position: relative;
            overflow: hidden;
            z-index: 1;
            font-family: 'Share Tech Mono', monospace;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(0, 238, 255, 0.3);
            transition: all 0.3s ease;
        }
        
        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s ease;
            z-index: -1;
        }
        
        .btn-primary:hover::before {
            left: 100%;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 238, 255, 0.5);
        }
        
        .btn-secondary {
            background: transparent;
            border: 2px solid var(--cyber-primary);
            color: var(--cyber-primary);
            position: relative;
            overflow: hidden;
            z-index: 1;
            font-family: 'Share Tech Mono', monospace;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        .btn-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, var(--cyber-primary), var(--cyber-quaternary));
            transition: all 0.6s ease;
            z-index: -1;
            opacity: 0;
        }
        
        .btn-secondary:hover {
            color: white;
            border-color: transparent;
        }
        
        .btn-secondary:hover::before {
            left: 0;
            opacity: 1;
        }
        
        /* Glitch Effect */
        .glitch-effect {
            position: relative;
        }
        
        .glitch-effect::before,
        .glitch-effect::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .glitch-effect::before {
            left: 2px;
            text-shadow: -2px 0 var(--cyber-secondary);
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-anim-1 5s infinite linear alternate-reverse;
        }
        
        .glitch-effect::after {
            left: -2px;
            text-shadow: -2px 0 var(--cyber-tertiary);
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-anim-2 5s infinite linear alternate-reverse;
        }
        
        @keyframes glitch-anim-1 {
            0% { clip: rect(20px, 9999px, 50px, 0); }
            5% { clip: rect(32px, 9999px, 94px, 0); }
            10% { clip: rect(73px, 9999px, 76px, 0); }
            15% { clip: rect(15px, 9999px, 13px, 0); }
            20% { clip: rect(65px, 9999px, 91px, 0); }
            25% { clip: rect(7px, 9999px, 89px, 0); }
            30% { clip: rect(9px, 9999px, 92px, 0); }
            35% { clip: rect(28px, 9999px, 40px, 0); }
            40% { clip: rect(92px, 9999px, 22px, 0); }
            45% { clip: rect(25px, 9999px, 7px, 0); }
            50% { clip: rect(28px, 9999px, 4px, 0); }
            55% { clip: rect(88px, 9999px, 21px, 0); }
            60% { clip: rect(32px, 9999px, 99px, 0); }
            65% { clip: rect(10px, 9999px, 90px, 0); }
            70% { clip: rect(23px, 9999px, 50px, 0); }
            75% { clip: rect(67px, 9999px, 19px, 0); }
            80% { clip: rect(33px, 9999px, 47px, 0); }
            85% { clip: rect(11px, 9999px, 85px, 0); }
            90% { clip: rect(52px, 9999px, 6px, 0); }
            95% { clip: rect(1px, 9999px, 53px, 0); }
            100% { clip: rect(43px, 9999px, 84px, 0); }
        }
        
        @keyframes glitch-anim-2 {
            0% { clip: rect(65px, 9999px, 100px, 0); }
            5% { clip: rect(52px, 9999px, 74px, 0); }
            10% { clip: rect(79px, 9999px, 85px, 0); }
            15% { clip: rect(75px, 9999px, 5px, 0); }
            20% { clip: rect(67px, 9999px, 61px, 0); }
            25% { clip: rect(14px, 9999px, 79px, 0); }
            30% { clip: rect(1px, 9999px, 66px, 0); }
            35% { clip: rect(86px, 9999px, 30px, 0); }
            40% { clip: rect(23px, 9999px, 98px, 0); }
            45% { clip: rect(85px, 9999px, 72px, 0); }
            50% { clip: rect(71px, 9999px, 75px, 0); }
            55% { clip: rect(2px, 9999px, 48px, 0); }
            60% { clip: rect(30px, 9999px, 16px, 0); }
            65% { clip: rect(59px, 9999px, 50px, 0); }
            70% { clip: rect(41px, 9999px, 62px, 0); }
            75% { clip: rect(2px, 9999px, 82px, 0); }
            80% { clip: rect(47px, 9999px, 73px, 0); }
            85% { clip: rect(3px, 9999px, 27px, 0); }
            90% { clip: rect(26px, 9999px, 55px, 0); }
            95% { clip: rect(42px, 9999px, 97px, 0); }
            100% { clip: rect(38px, 9999px, 49px, 0); }
        }
        
        /* Vulnerability Cards */
        .vulnerability-card {
            background: rgba(5, 5, 16, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 8px;
            padding: 2rem;
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .vulnerability-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 238, 255, 0.05) 0%, rgba(255, 0, 160, 0.05) 100%);
            z-index: -1;
        }
        
        .vulnerability-card:hover {
            transform: translateY(-15px) scale(1.03);
            border-color: var(--cyber-primary);
            box-shadow: 0 15px 30px rgba(0, 238, 255, 0.2);
        }
        
        .vulnerability-icon {
            font-size: 3rem;
            margin-bottom: 1.5rem;
            color: var(--cyber-primary);
            transition: all 0.3s ease;
            text-shadow: 0 0 10px var(--cyber-primary);
        }
        
        .vulnerability-card:hover .vulnerability-icon {
            color: var(--cyber-tertiary);
            transform: scale(1.2) rotate(5deg);
            text-shadow: 0 0 15px var(--cyber-tertiary);
        }
        
        .vulnerability-title {
            font-family: var(--cyber-font-mono);
            font-size: 1.5rem;
            text-transform: uppercase;
            margin-bottom: 1rem;
            background: linear-gradient(to right, var(--cyber-primary), var(--cyber-quaternary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: all 0.3s ease;
        }
        
        .vulnerability-card:hover .vulnerability-title {
            text-shadow: 0 0 10px var(--cyber-primary);
            letter-spacing: 1px;
        }
        
        /* Scanner effect on hover */
        .scanner-effect {
            position: relative;
            overflow: hidden;
        }
        
        .scanner-effect::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--cyber-primary), transparent);
            top: -100%;
            left: 0;
            opacity: 0;
            transition: opacity 0.2s;
        }
        
        .scanner-effect:hover::after {
            animation: scan 1.5s linear infinite;
            opacity: 1;
        }
        
        @keyframes scan {
            0% { top: 0%; }
            100% { top: 100%; }
        }
        
        /* Section styles */
        section {
            padding: 6rem 0;
            position: relative;
        }
        
        section::before {
            content: '';
            position: absolute;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--cyber-primary), transparent);
            opacity: 0.3;
        }
        
        section::after {
            content: '';
            position: absolute;
            right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(180deg, transparent, var(--cyber-quaternary), transparent);
            opacity: 0.3;
        }
        
        .section-title {
            font-size: 3rem;
            text-transform: uppercase;
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            display: inline-block;
        }
        
        .section-subtitle {
            color: var(--cyber-text-dim);
            font-size: 1.2rem;
            margin-bottom: 3rem;
            text-align: center;
        }
        
        .cyber-glow {
            color: var(--cyber-primary);
            text-shadow: 0 0 10px var(--cyber-primary);
            position: relative;
        }
        
        .cyber-glow::before, 
        .cyber-glow::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--cyber-primary), transparent);
        }
        
        .cyber-glow::before {
            left: -60px;
        }
        
        .cyber-glow::after {
            right: -60px;
            transform: rotate(180deg);
        }
        
        /* Card Styles */
        .card {
            background: rgba(19, 26, 42, 0.7);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 8px;
            transition: all 0.3s ease;
            overflow: hidden;
            position: relative;
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: linear-gradient(180deg, var(--cyber-primary), var(--cyber-quaternary));
            opacity: 0.7;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 238, 255, 0.1);
            border-color: var(--cyber-primary);
        }
        
        .card-title {
            color: var(--cyber-primary);
            font-family: 'Share Tech Mono', monospace;
            margin-bottom: 1rem;
        }
        
        .card-text {
            color: var(--cyber-text-dim);
        }
        
        /* Alert style */
        .alert-warning {
            background: rgba(255, 204, 0, 0.1);
            border: 1px solid var(--cyber-warning);
            border-radius: 8px;
            color: var(--cyber-text-bright);
        }
        
        /* Swiper slider */
        .swiper {
            width: 100%;
            height: 400px;
            margin-top: 2rem;
            margin-bottom: 4rem;
        }
        
        .swiper-slide {
            background: rgba(19, 26, 42, 0.7);
            border-radius: 8px;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            border: 1px solid var(--cyber-text-dim);
            transition: all 0.3s ease;
        }
        
        .swiper-slide:hover {
            transform: scale(1.03);
            border-color: var(--cyber-primary);
            box-shadow: 0 10px 30px rgba(0, 238, 255, 0.2);
        }
        
        .swiper-pagination-bullet {
            background: var(--cyber-primary);
            opacity: 0.5;
        }
        
        .swiper-pagination-bullet-active {
            background: var(--cyber-primary);
            opacity: 1;
        }
        
        .swiper-button-next,
        .swiper-button-prev {
            color: var(--cyber-primary);
        }
        
        /* Timeline section */
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background: linear-gradient(180deg, var(--cyber-primary), var(--cyber-quaternary));
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
            border-radius: 10px;
        }
        
        .timeline-item {
            padding: 10px 40px;
            position: relative;
            width: 50%;
            box-sizing: border-box;
        }
        
        .timeline-item:nth-child(odd) {
            left: 0;
        }
        
        .timeline-item:nth-child(even) {
            left: 50%;
        }
        
        .timeline-content {
            padding: 20px 30px;
            background: rgba(19, 26, 42, 0.7);
            position: relative;
            border-radius: 8px;
            border: 1px solid var(--cyber-text-dim);
            transition: all 0.3s ease;
        }
        
        .timeline-item:nth-child(odd) .timeline-content {
            border-left: 4px solid var(--cyber-primary);
        }
        
        .timeline-item:nth-child(even) .timeline-content {
            border-right: 4px solid var(--cyber-quaternary);
        }
        
        .timeline-content:hover {
            transform: scale(1.03);
            border-color: var(--cyber-tertiary);
            box-shadow: 0 10px 30px rgba(0, 238, 255, 0.2);
        }
        
        .timeline-item::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -12px;
            background: var(--cyber-bg-medium);
            border: 4px solid var(--cyber-primary);
            top: 20px;
            border-radius: 50%;
            z-index: 1;
            box-shadow: 0 0 10px var(--cyber-primary);
        }
        
        .timeline-item:nth-child(even)::after {
            left: -12px;
            border-color: var(--cyber-quaternary);
            box-shadow: 0 0 10px var(--cyber-quaternary);
        }
        
        .timeline-date {
            color: var(--cyber-tertiary);
            font-family: 'Share Tech Mono', monospace;
            margin-bottom: 10px;
        }
        
        @media (max-width: 767px) {
            .timeline::after {
                left: 31px;
            }
            
            .timeline-item {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-item:nth-child(even) {
                left: 0;
            }
            
            .timeline-item::after {
                left: 19px;
                right: auto;
            }
            
            .timeline-item:nth-child(even)::after {
                left: 19px;
            }
            
            .timeline-item:nth-child(odd) .timeline-content,
            .timeline-item:nth-child(even) .timeline-content {
                border-left: 4px solid var(--cyber-primary);
                border-right: none;
            }
        }
        
        /* Testimonials */
        .testimonial-card {
            background: rgba(19, 26, 42, 0.7);
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            border: 1px solid var(--cyber-text-dim);
            transition: all 0.3s ease;
        }
        
        .testimonial-card:hover {
            transform: translateY(-5px);
            border-color: var(--cyber-primary);
            box-shadow: 0 10px 30px rgba(0, 238, 255, 0.2);
        }
        
        .testimonial-content {
            position: relative;
            padding-left: 30px;
        }
        
        .testimonial-content::before {
            content: '"';
            position: absolute;
            top: -20px;
            left: 0;
            font-size: 4rem;
            color: var(--cyber-primary);
            font-family: Georgia, serif;
            opacity: 0.5;
        }
        
        .testimonial-author {
            display: flex;
            align-items: center;
            margin-top: 1.5rem;
        }
        
        .testimonial-author-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            border: 2px solid var(--cyber-primary);
        }
        
        .testimonial-author-name {
            color: var(--cyber-primary);
            font-weight: 700;
            margin-bottom: 0;
        }
        
        .testimonial-author-title {
            color: var(--cyber-text-dim);
            font-size: 0.9rem;
        }
        
        /* Stats Counter */
        .counter-box {
            text-align: center;
            padding: 2rem;
            border: 1px solid var(--cyber-text-dim);
            border-radius: 8px;
            margin-bottom: 1.5rem;
            background: rgba(19, 26, 42, 0.7);
            transition: all 0.3s ease;
        }
        
        .counter-box:hover {
            transform: translateY(-5px);
            border-color: var(--cyber-primary);
            box-shadow: 0 10px 30px rgba(0, 238, 255, 0.2);
        }
        
        .counter-icon {
            font-size: 2.5rem;
            color: var(--cyber-primary);
            margin-bottom: 1rem;
        }
        
        .counter-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--cyber-primary);
            font-family: 'Share Tech Mono', monospace;
            margin-bottom: 0.5rem;
        }
        
        .counter-text {
            color: var(--cyber-text-dim);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Footer */
        .footer {
            background: rgba(10, 14, 23, 0.9);
            position: relative;
            border-top: 1px solid rgba(0, 238, 255, 0.2);
        }
        
        .footer a {
            color: var(--cyber-text-dim);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: var(--cyber-primary);
            text-decoration: none;
        }
        
        /* Night city parallax effect */
        .night-city {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 100px;
            background: url('assets/images/night-city-skyline.png') repeat-x;
            background-size: contain;
            z-index: -1;
            animation: city-scroll 60s linear infinite;
        }
        
        @keyframes city-scroll {
            0% { background-position: 0px 0px; }
            100% { background-position: 1920px 0px; }
        }
        
        /* Animated circuit lines */
        .circuit-lines {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: -1;
        }
        
        .circuit-line {
            position: absolute;
            background: linear-gradient(90deg, transparent, var(--cyber-primary), transparent);
            height: 1px;
            width: 100%;
            opacity: 0.3;
            animation: circuit-animate 15s linear infinite;
        }
        
        .circuit-line:nth-child(1) {
            top: 15%;
            animation-delay: 0s;
        }
        
        .circuit-line:nth-child(2) {
            top: 35%;
            animation-delay: 4s;
        }
        
        .circuit-line:nth-child(3) {
            top: 65%;
            animation-delay: 8s;
        }
        
        .circuit-line:nth-child(4) {
            top: 85%;
            animation-delay: 12s;
        }
        
        .circuit-vertical {
            position: absolute;
            background: linear-gradient(180deg, transparent, var(--cyber-quaternary), transparent);
            width: 1px;
            height: 100%;
            opacity: 0.3;
            animation: circuit-animate-vertical 20s linear infinite;
        }
        
        .circuit-vertical:nth-child(5) {
            left: 20%;
            animation-delay: 2s;
        }
        
        .circuit-vertical:nth-child(6) {
            left: 50%;
            animation-delay: 6s;
        }
        
        .circuit-vertical:nth-child(7) {
            left: 80%;
            animation-delay: 10s;
        }
        
        @keyframes circuit-animate {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        @keyframes circuit-animate-vertical {
            0% { transform: translateY(-100%); }
            100% { transform: translateY(100%); }
        }
        
        /* Floating elements */
        .float-element {
            animation: float 5s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        /* Skill bars */
        .skill-bar-container {
            margin-bottom: 1.5rem;
        }
        
        .skill-bar-title {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            color: var(--cyber-text-bright);
        }
        
        .skill-bar {
            height: 10px;
            background: rgba(5, 5, 16, 0.5);
            border-radius: 5px;
            overflow: hidden;
            position: relative;
        }
        
        .skill-bar-fill {
            height: 100%;
            border-radius: 5px;
            position: relative;
            background: linear-gradient(45deg, var(--cyber-primary), var(--cyber-quaternary));
            animation: skill-fill 2s ease-out;
        }
        
        @keyframes skill-fill {
            0% { width: 0; }
        }
        
        /* Hover interaction for gallery */
        .gallery-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
            border-color: var(--cyber-primary);
            box-shadow: 0 10px 30px rgba(0, 238, 255, 0.2);
        }
        
        .gallery-item img {
            width: 100%;
            height: auto;
            transition: all 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(10, 14, 23, 0.8));
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-caption {
            color: var(--cyber-text-bright);
            text-align: center;
            padding: 1rem;
            transform: translateY(20px);
            transition: all 0.4s ease;
            opacity: 0;
        }
        
        .gallery-item:hover .gallery-caption {
            transform: translateY(0);
            opacity: 1;
        }
        
        /* Progress Circle Animation */
        .progress-circle {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 2rem;
        }
        
        .progress-circle svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }
        
        .progress-circle circle {
            fill: none;
            stroke-width: 8;
            stroke-linecap: round;
            stroke-dasharray: 283;
            stroke-dashoffset: 283;
            animation: progress-animate 2s ease-out forwards;
        }
        
        .progress-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
            font-weight: 700;
            color: var(--cyber-primary);
        }
        
        @keyframes progress-animate {
            to {
                stroke-dashoffset: calc(283 - (283 * var(--percentage)) / 100);
            }
        }
        
        /* New security level selector styling */
        .security-level-selector {
            background: rgba(5, 5, 16, 0.7);
            backdrop-filter: blur(5px);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 50px;
            padding: 0.5rem 1rem;
            display: flex;
            align-items: center;
        }
        
        .security-level-label {
            color: var(--cyber-text-dim);
            font-family: 'Share Tech Mono', monospace;
            margin-right: 0.5rem;
        }
        
        .security-btn {
            background: transparent;
            border: none;
            color: var(--cyber-text-dim);
            font-family: 'Share Tech Mono', monospace;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .security-btn:hover, .security-btn.active {
            background: linear-gradient(45deg, var(--cyber-primary), var(--cyber-quaternary));
            color: var(--cyber-text-bright);
            box-shadow: 0 0 10px rgba(0, 238, 255, 0.5);
        }
        
        /* FAQ Accordion */
        .faq-item {
            margin-bottom: 1rem;
            border: 1px solid var(--cyber-text-dim);
            border-radius: 8px;
            overflow: hidden;
            background: rgba(19, 26, 42, 0.7);
        }
        
        .faq-question {
            padding: 1.25rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--cyber-primary);
            font-family: 'Share Tech Mono', monospace;
            transition: all 0.3s ease;
        }
        
        .faq-question:hover {
            background: rgba(0, 238, 255, 0.1);
        }
        
        .faq-answer {
            padding: 0 1.25rem;
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            color: var(--cyber-text-dim);
        }
        
        .faq-item.active .faq-answer {
            padding: 1.25rem;
            max-height: 500px;
        }
        
        .faq-icon {
            transition: all 0.3s ease;
        }
        
        .faq-item.active .faq-icon {
            transform: rotate(180deg);
        }
        
        /* Contact Form Styling */
        .contact-form {
            background: rgba(19, 26, 42, 0.7);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 8px;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .contact-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--cyber-primary), var(--cyber-secondary), var(--cyber-tertiary), var(--cyber-quaternary));
        }
        
        .form-control {
            background: rgba(5, 5, 16, 0.7);
            border: 1px solid var(--cyber-text-dim);
            color: var(--cyber-text-bright);
            padding: 0.75rem 1rem;
            font-family: 'Rajdhani', sans-serif;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background: rgba(5, 5, 16, 0.9);
            border-color: var(--cyber-primary);
            box-shadow: 0 0 15px rgba(0, 238, 255, 0.2);
        }
        
        .form-label {
            color: var(--cyber-primary);
            font-family: 'Share Tech Mono', monospace;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/logo.png" alt="HackMeBank Logo" height="40" class="d-inline-block align-top me-2">
                <span class="cyber-flicker">HackMeBank</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="fas fa-bars text-cyber-primary"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="vulnerabilitiesDropdown" role="button" data-bs-toggle="dropdown">
                            Vulnerabilities
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="vulnerabilitiesDropdown">
                            <li><a class="dropdown-item" href="vulnerabilities/sql_injection.php">SQL Injection</a></li>
                            <li><a class="dropdown-item" href="vulnerabilities/xss.php">XSS</a></li>
                            <li><a class="dropdown-item" href="vulnerabilities/cmd_injection.php">Command Injection</a></li>
                            <li><a class="dropdown-item" href="vulnerabilities/bruteforce.php">Brute Force</a></li>
                            <li><a class="dropdown-item" href="vulnerabilities/directory_traversal.php">Directory Traversal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#project-info">Project Info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#our-journey">Our Journey</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                </ul>

                <!-- Security Level Selector -->
                <div class="security-level-selector me-3">
                    <span class="security-level-label">Security:</span>
                    <div class="btn-group" role="group">
                        <button type="button" class="security-btn active" data-level="low">Low</button>
                        <button type="button" class="security-btn" data-level="medium">Med</button>
                        <button type="button" class="security-btn" data-level="high">High</button>
                    </div>
                </div>

                <!-- Login/Register buttons or User info if logged in -->
                <div class="d-flex">
                    <a href="login.php" class="btn btn-primary me-2">Login</a>
                    <a href="register.php" class="btn btn-secondary">Register</a>
                    
                    <!-- This part would show when user is logged in (initially hidden via CSS) -->
                    <div class="user-info d-none">
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>
                                <span class="username">John Doe</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                                <li><a class="dropdown-item" href="accounts.php">My Accounts</a></li>
                                <li><a class="dropdown-item" href="transactions.php">Transactions</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Animated circuit lines background -->
    <div class="circuit-lines">
        <div class="circuit-line"></div>
        <div class="circuit-line"></div>
        <div class="circuit-line"></div>
        <div class="circuit-line"></div>
        <div class="circuit-vertical"></div>
        <div class="circuit-vertical"></div>
        <div class="circuit-vertical"></div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content" data-aos="fade-right" data-aos-duration="1000">
                    <h1 class="hero-title">
                        <span class="glitch-effect" data-text="HackMeBank">HackMeBank</span>
                    </h1>
                    <p class="hero-subtitle">A cybersecurity training platform with deliberate vulnerabilities</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="register.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i> Get Started
                        </a>
                        <a href="#vulnerabilities" class="btn btn-secondary btn-lg">
                            <i class="fas fa-shield-alt me-2"></i> Explore Vulnerabilities
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block" data-aos="fade-left" data-aos-duration="1000">
                    <img src="assets/images/cyber-bank.png" alt="Cybersecurity Banking" class="img-fluid float-element">
                </div>
            </div>
        </div>
        <div class="night-city"></div>
    </section>

    <!-- Main content area -->
    <main class="container mt-5 mb-5">
        <!-- Security Warning Card -->
        <div class="row mb-5">
            <div class="col-12" data-aos="fade-up" data-aos-duration="800">
                <div class="alert alert-warning">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-exclamation-triangle fa-3x"></i>
                        </div>
                        <div>
                            <h4 class="alert-heading">Security Warning</h4>
                            <p class="mb-0">This application contains <strong>DELIBERATE</strong> security vulnerabilities for educational purposes.</p>
                            <ul class="mb-0 mt-2">
                                <li>DO NOT deploy on public servers or production environments</li>
                                <li>DO NOT use real credentials or sensitive data</li>
                                <li>ONLY run in a controlled, isolated environment</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vulnerabilities Overview with Swiper Slider -->
        <section id="vulnerabilities" class="mb-5">
            <div class="row mb-4">
                <div class="col-12 text-center" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="cyber-glow">About The Project</h2>
                    <p class="text-cyber-text-dim section-subtitle">Understanding the purpose and vision behind HackMeBank</p>
                </div>
            </div>
            
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4" data-aos="fade-right" data-aos-duration="1000">
                    <h3 class="mb-4">Our Mission</h3>
                    <p>HackMeBank was developed to provide a safe, controlled environment for cybersecurity enthusiasts, students, and professionals to practice exploitation techniques and understand common web application vulnerabilities.</p>
                    <p>Unlike real banking applications that prioritize security, HackMeBank intentionally contains vulnerabilities that demonstrate real-world security risks in a safe, legal context.</p>
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            <i class="fas fa-graduation-cap fa-3x text-cyber-primary"></i>
                        </div>
                        <div>
                            <h4 class="mb-2">Educational Purpose</h4>
                            <p class="mb-0">We believe in learning by doing. Practical experience with security vulnerabilities builds stronger defenders.</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <i class="fas fa-shield-alt fa-3x text-cyber-quaternary"></i>
                        </div>
                        <div>
                            <h4 class="mb-2">Ethical Focus</h4>
                            <p class="mb-0">All vulnerabilities are presented with proper mitigation strategies to promote responsible security practices.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title text-center mb-4">Target Audience</h3>
                            <div class="skill-bar-container">
                                <div class="skill-bar-title">
                                    <span>Cybersecurity Students</span>
                                    <span>100%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width: 100%;"></div>
                                </div>
                            </div>
                            <div class="skill-bar-container">
                                <div class="skill-bar-title">
                                    <span>Penetration Testers</span>
                                    <span>90%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width: 90%;"></div>
                                </div>
                            </div>
                            <div class="skill-bar-container">
                                <div class="skill-bar-title">
                                    <span>Web Developers</span>
                                    <span>80%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width: 80%;"></div>
                                </div>
                            </div>
                            <div class="skill-bar-container">
                                <div class="skill-bar-title">
                                    <span>Security Researchers</span>
                                    <span>85%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width: 85%;"></div>
                                </div>
                            </div>
                            <div class="skill-bar-container">
                                <div class="skill-bar-title">
                                    <span>IT Managers</span>
                                    <span>60%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-bar-fill" style="width: 60%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Gallery Section -->
        <section class="mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="cyber-glow">Security Gallery</h2>
                    <p class="text-cyber-text-dim section-subtitle">Visual examples of security concepts and vulnerabilities</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="gallery-item">
                        <img src="assets/images/sql-injection-example.jpg" alt="SQL Injection Example">
                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <h4>SQL Injection</h4>
                                <p>Example of a SQL injection attack in action against a database</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="gallery-item">
                        <img src="assets/images/xss-example.jpg" alt="Cross-Site Scripting Example">
                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <h4>Cross-Site Scripting</h4>
                                <p>Visualization of how XSS attacks can steal session cookies</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="gallery-item">
                        <img src="assets/images/security-dashboard.jpg" alt="Security Dashboard">
                        <div class="gallery-overlay">
                            <div class="gallery-caption">
                                <h4>Security Dashboard</h4>
                                <p>The HackMeBank admin security monitoring interface</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Our Journey Section -->
        <section id="our-journey" class="mb-5">
            <div class="row mb-4">
                <div class="col-12 text-center" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="cyber-glow">Our Journey</h2>
                    <p class="text-cyber-text-dim section-subtitle">The evolution of HackMeBank from concept to reality</p>
                </div>
            </div>
            
            <div class="timeline" data-aos="fade-up" data-aos-duration="1000">
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">January 2023</div>
                        <h4>Project Inception</h4>
                        <p>HackMeBank was conceptualized as a response to the growing need for hands-on cybersecurity training platforms.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">March 2023</div>
                        <h4>Development Begins</h4>
                        <p>The core development team started building the banking application framework with intentional vulnerabilities.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">June 2023</div>
                        <h4>Beta Testing</h4>
                        <p>Early access was provided to a select group of cybersecurity students and professionals for feedback.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">September 2023</div>
                        <h4>Educational Content</h4>
                        <p>Comprehensive documentation and tutorials were added to enhance the learning experience.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">January 2024</div>
                        <h4>First Public Release</h4>
                        <p>HackMeBank v1.0 was released to the public, featuring five core vulnerabilities and three security levels.</p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-content">
                        <div class="timeline-date">March 2025</div>
                        <h4>Latest Update</h4>
                        <p>HackMeBank v2.0 includes expanded functionality, additional vulnerabilities, and improved user interfaces.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- FAQ Section -->
        <section class="mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="cyber-glow">Frequently Asked Questions</h2>
                    <p class="text-cyber-text-dim section-subtitle">Common questions about HackMeBank and its usage</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Is HackMeBank safe to use?</span>
                            <i class="fas fa-chevron-down faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, HackMeBank is safe to use in a controlled environment. However, it contains deliberate vulnerabilities and should never be deployed on public servers or used with real sensitive information.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Can I use HackMeBank for my cybersecurity class?</span>
                            <i class="fas fa-chevron-down faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Absolutely! HackMeBank is designed for educational purposes and is perfect for cybersecurity courses. We encourage instructors to use it as a hands-on learning tool for students.</p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>What's the difference between security levels?</span>
                            <i class="fas fa-chevron-down faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Each security level implements different protective measures:
                            <ul>
                                <li><strong>Low:</strong> Almost no security controls, making vulnerabilities easy to exploit</li>
                                <li><strong>Medium:</strong> Basic security controls that require more advanced techniques to bypass</li>
                                <li><strong>High:</strong> Strong security controls that represent real-world protection mechanisms</li>
                            </ul>
                            </p>
                        </div>
                    </div>
                    
                    <div class="faq-item">
                        <div class="faq-question">
                            <span>Is HackMeBank open source?</span>
                            <i class="fas fa-chevron-down faq-icon"></i>
                        </div>
                        <div class="faq-answer">
                            <p>Yes, HackMeBank is completely open source. You can find the source code on our GitHub repository, modify it for your needs, and contribute to its development.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Testimonials Section -->
        <section class="mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="cyber-glow">Testimonials</h2>
                    <p class="text-cyber-text-dim section-subtitle">What our users say about HackMeBank</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>HackMeBank has been an invaluable resource for my cybersecurity students. The realistic banking interface combined with deliberate vulnerabilities provides a perfect learning environment.</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="assets/images/testimonial-1.jpg" alt="Professor Jane Smith" class="testimonial-author-img">
                            <div>
                                <p class="testimonial-author-name">Professor Jane Smith</p>
                                <p class="testimonial-author-title">Cybersecurity Instructor</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="testimonial-card">
                        <div class="testimonial-content">
                            <p>As a penetration tester, I use HackMeBank to keep my skills sharp and experiment with new techniques. The varying security levels make it challenging and engaging for all skill levels.</p>
                        </div>
                        <div class="testimonial-author">
                            <img src="assets/images/testimonial-2.jpg" alt="Alex Rodriguez" class="testimonial-author-img">
                            <div>
                                <p class="testimonial-author-name">Alex Rodriguez</p>
                                <p class="testimonial-author-title">Senior Penetration Tester</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Contact Section -->
        <section id="contact" class="mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="cyber-glow">Get In Touch</h2>
                    <p class="text-cyber-text-dim section-subtitle">Have questions or feedback? We'd love to hear from you!</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6" data-aos="fade-right" data-aos-duration="1000">
                    <div class="contact-form">
                        <form id="contactForm">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" placeholder="Enter subject">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i> Send Message
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="card-title mb-4">Connect With Us</h3>
                            <div class="d-flex align-items-center mb-4">
                                <div class="me-3">
                                    <i class="fas fa-envelope fa-2x text-cyber-primary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Email</h5>
                                    <p class="mb-0">support@hackmebank.com</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="me-3">
                                    <i class="fas fa-map-marker-alt fa-2x text-cyber-secondary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Location</h5>
                                    <p class="mb-0">Cybersecurity Campus, Digital City, Techland</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-4">
                                <div class="me-3">
                                    <i class="fas fa-phone fa-2x text-cyber-tertiary"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Phone</h5>
                                    <p class="mb-0">+1 (555) HACK-SEC</p>
                                </div>
                            </div>
                            <div class="social-media mt-4">
                                <h5 class="mb-3">Follow Us</h5>
                                <div class="d-flex">
                                    <a href="#" class="btn btn-primary me-2"><i class="fab fa-github"></i></a>
                                    <a href="#" class="btn btn-primary me-2"><i class="fab fa-twitter"></i></a>
                                    <a href="#" class="btn btn-primary me-2"><i class="fab fa-linkedin"></i></a>
                                    <a href="#" class="btn btn-primary"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Call to Action -->
        <div class="row">
            <div class="col-12" data-aos="fade-up" data-aos-duration="800">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <h2 class="card-title mb-4">Ready to Start Your Security Journey?</h2>
                        <p class="card-text mb-4">Create an account and begin exploring cybersecurity vulnerabilities in a safe, controlled environment.</p>
                        <a href="register.php" class="btn btn-primary btn-lg me-3">Register Now</a>
                        <a href="login.php" class="btn btn-secondary btn-lg">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>HackMeBank</h5>
                    <p class="mb-0">A Vulnerable Web Application for Cybersecurity Training</p>
                    <p class="mb-0">&copy; 2025 HackMeBank</p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="vulnerabilities/index.php">Vulnerabilities</a></li>
                        <li><a href="register.php">Register</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Legal</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Disclaimer</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <!-- Custom Scripts -->
    <script src="js/main.js"></script>
    <script src="js/security-display.js"></script>
    <script src="js/highlight.min.js"></script>
    
    <script>
        // Initialize AOS animations
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-in-out'
        });
        
        // Initialize security level buttons
        document.addEventListener('DOMContentLoaded', function() {
            const securityBtns = document.querySelectorAll('.security-btn');
            securityBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    securityBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Store the selected security level
                    localStorage.setItem('securityLevel', this.getAttribute('data-level'));
                });
            });
            
            // Set the active button based on stored security level
            const storedLevel = localStorage.getItem('securityLevel') || 'low';
            const activeBtn = document.querySelector(`.security-btn[data-level="${storedLevel}"]`);
            if (activeBtn) {
                securityBtns.forEach(b => b.classList.remove('active'));
                activeBtn.classList.add('active');
            }
            
            // Initialize Swiper slider
            const vulnerabilitySwiper = new Swiper('.vulnerabilitySwiper', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    // when window width is >= 768px
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    }
                },
                autoplay: {
                    delay: 5000,
                },
            });
            
            // Initialize counting animation for counter
            const counterNumbers = document.querySelectorAll('.counter-number');
            
            const startCounterAnimation = () => {
                counterNumbers.forEach(counter => {
                    const target = parseInt(counter.getAttribute('data-count'));
                    const duration = 2000; // Animation duration in milliseconds
                    const step = target / (duration / 16); // 60fps = approx 16ms per frame
                    
                    let current = 0;
                    const counterInterval = setInterval(() => {
                        current += step;
                        if (current >= target) {
                            counter.textContent = target;
                            clearInterval(counterInterval);
                        } else {
                            counter.textContent = Math.floor(current);
                        }
                    }, 16);
                });
            };
            
            // Use Intersection Observer to trigger counter animation when in view
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        startCounterAnimation();
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            document.querySelectorAll('.counter-box').forEach(counter => {
                observer.observe(counter);
            });
            
            // FAQ toggle functionality
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', () => {
                    const faqItem = question.parentElement;
                    faqItem.classList.toggle('active');
                });
            });
            
            // Form validation and animation
            const contactForm = document.getElementById('contactForm');
            
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    // Here you would typically handle the form submission
                    // For now, we'll just show an animation
                    
                    const btn = this.querySelector('button[type="submit"]');
                    const originalText = btn.innerHTML;
                    
                    btn.innerHTML = '<i class="fas fa-circle-notch fa-spin me-2"></i> Sending...';
                    btn.disabled = true;
                    
                    setTimeout(() => {
                        btn.innerHTML = '<i class="fas fa-check me-2"></i> Message Sent!';
                        btn.classList.remove('btn-primary');
                        btn.classList.add('btn-success');
                        
                        // Reset form
                        setTimeout(() => {
                            this.reset();
                            btn.innerHTML = originalText;
                            btn.classList.remove('btn-success');
                            btn.classList.add('btn-primary');
                            btn.disabled = false;
                        }, 3000);
                    }, 2000);
                });
            }
        });
    </script>
</body>
</html>
                    <h2 class="cyber-glow">Featured Vulnerabilities</h2>
                    <p class="text-cyber-text-dim section-subtitle">Learn and practice with real-world security vulnerabilities in a banking context</p>
                </div>
            </div>
            
            <!-- Swiper Slider for Vulnerabilities -->
            <div class="swiper vulnerabilitySwiper" data-aos="fade-up" data-aos-duration="1000">
                <div class="swiper-wrapper">
                    <!-- SQL Injection -->
                    <div class="swiper-slide vulnerability-card scanner-effect">
                        <div class="vulnerability-icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <h3 class="vulnerability-title">SQL Injection</h3>
                        <p>Explore how attackers can manipulate database queries to bypass authentication, extract sensitive data, and perform unauthorized operations.</p>
                        <div class="skill-bar-container">
                            <div class="skill-bar-title">
                                <span>Impact</span>
                                <span>High</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-bar-fill" style="width: 95%;"></div>
                            </div>
                        </div>
                        <a href="vulnerabilities/sql_injection.php" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Learn More
                        </a>
                    </div>
                    
                    <!-- XSS -->
                    <div class="swiper-slide vulnerability-card scanner-effect">
                        <div class="vulnerability-icon">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="vulnerability-title">Cross-Site Scripting</h3>
                        <p>Discover how malicious scripts can be injected into web pages to steal session cookies, hijack accounts, and deface websites.</p>
                        <div class="skill-bar-container">
                            <div class="skill-bar-title">
                                <span>Impact</span>
                                <span>Medium</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-bar-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                        <a href="vulnerabilities/xss.php" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Learn More
                        </a>
                    </div>
                    
                    <!-- Command Injection -->
                    <div class="swiper-slide vulnerability-card scanner-effect">
                        <div class="vulnerability-icon">
                            <i class="fas fa-terminal"></i>
                        </div>
                        <h3 class="vulnerability-title">Command Injection</h3>
                        <p>Learn how attackers can execute system commands through vulnerable web applications to gain unauthorized access.</p>
                        <div class="skill-bar-container">
                            <div class="skill-bar-title">
                                <span>Impact</span>
                                <span>Critical</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-bar-fill" style="width: 90%;"></div>
                            </div>
                        </div>
                        <a href="vulnerabilities/cmd_injection.php" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Learn More
                        </a>
                    </div>
                    
                    <!-- Brute Force -->
                    <div class="swiper-slide vulnerability-card scanner-effect">
                        <div class="vulnerability-icon">
                            <i class="fas fa-hammer"></i>
                        </div>
                        <h3 class="vulnerability-title">Brute Force</h3>
                        <p>Explore automated attacks that attempt to guess passwords and bypass authentication mechanisms through repetitive attempts.</p>
                        <div class="skill-bar-container">
                            <div class="skill-bar-title">
                                <span>Impact</span>
                                <span>Medium</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-bar-fill" style="width: 65%;"></div>
                            </div>
                        </div>
                        <a href="vulnerabilities/bruteforce.php" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Learn More
                        </a>
                    </div>
                    
                    <!-- Directory Traversal -->
                    <div class="swiper-slide vulnerability-card scanner-effect">
                        <div class="vulnerability-icon">
                            <i class="fas fa-folder-open"></i>
                        </div>
                        <h3 class="vulnerability-title">Directory Traversal</h3>
                        <p>Understand how attackers can access files and directories outside the web root folder by manipulating paths and filenames.</p>
                        <div class="skill-bar-container">
                            <div class="skill-bar-title">
                                <span>Impact</span>
                                <span>High</span>
                            </div>
                            <div class="skill-bar">
                                <div class="skill-bar-fill" style="width: 80%;"></div>
                            </div>
                        </div>
                        <a href="vulnerabilities/directory_traversal.php" class="btn btn-primary mt-3">
                            <i class="fas fa-arrow-right me-2"></i> Learn More
                        </a>
                    </div>
                </div>
                
                <!-- Add pagination and navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </section>

        <!-- Interactive Stats Counter Section -->
        <section class="mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="cyber-glow">HackMeBank by Numbers</h2>
                    <p class="text-cyber-text-dim section-subtitle">Our platform provides a comprehensive cybersecurity learning experience</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fas fa-bug"></i>
                        </div>
                        <div class="counter-number" data-count="15">0</div>
                        <div class="counter-text">Vulnerabilities</div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="counter-number" data-count="3">0</div>
                        <div class="counter-text">Security Levels</div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="counter-number" data-count="5000">0</div>
                        <div class="counter-text">Learners</div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6">
                    <div class="counter-box">
                        <div class="counter-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="counter-number" data-count="25">0</div>
                        <div class="counter-text">Tutorials</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Section with progress circles -->
        <section class="mb-5">
            <div class="row mb-4">
                <div class="col-12 text-center" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="cyber-glow">Key Features</h2>
                    <p class="text-cyber-text-dim section-subtitle">A comprehensive platform for cybersecurity training</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="progress-circle">
                                <svg>
                                    <circle cx="70" cy="70" r="45" style="--percentage: 90; stroke: var(--cyber-primary)"></circle>
                                </svg>
                                <div class="progress-text">90%</div>
                            </div>
                            <h3 class="card-title"><i class="fas fa-layer-group me-2"></i> Security Levels</h3>
                            <p class="card-text">Each vulnerability can be explored at different security levels: Low, Medium, and High. This lets you understand how different protection mechanisms work.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="progress-circle">
                                <svg>
                                    <circle cx="70" cy="70" r="45" style="--percentage: 85; stroke: var(--cyber-quaternary)"></circle>
                                </svg>
                                <div class="progress-text">85%</div>
                            </div>
                            <h3 class="card-title"><i class="fas fa-users-cog me-2"></i> User Roles</h3>
                            <p class="card-text">Experience different perspectives with multiple user roles: Customer, Bank Manager, and Admin, each with different access levels and capabilities.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="progress-circle">
                                <svg>
                                    <circle cx="70" cy="70" r="45" style="--percentage: 95; stroke: var(--cyber-tertiary)"></circle>
                                </svg>
                                <div class="progress-text">95%</div>
                            </div>
                            <h3 class="card-title"><i class="fas fa-book-open me-2"></i> Learning</h3>
                            <p class="card-text">Each vulnerability includes detailed explanations, exploitation techniques, and mitigation strategies to enhance your learning experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Project Info Section -->
        <section id="project-info" class="mb-5">
            <div class="row mb-4">
                <div class="col-12 text-center" data-aos="fade-up" data-aos-duration="800">