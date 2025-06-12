<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - HackMeBank Development Team</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Rajdhani:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <!-- AOS library for scroll animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <!-- Custom styles -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/cyberpunk-theme.css" rel="stylesheet">
    <!-- Security display CSS -->
    <link href="css/security-display.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
    <style>
        :root {
            --cyber-primary: #00eeff;
            --cyber-secondary: #ff00a0;
            --cyber-tertiary: #ffdd00;
            --cyber-quaternary: #7700ff;
            --cyber-success: #00ff8c;
            --cyber-bg-dark: #0a0e17;
            --cyber-bg-medium: #131a2a;
            --cyber-bg-light: #1c2538;
            --cyber-text-bright: #ffffff;
            --cyber-text-dim: #a2b0cc;
            --cyber-danger: #ff3e3e;
            --cyber-warning: #ffcc00;
            --cyber-matrix-green: #00ff41;
        }
        
        body {
            background: linear-gradient(135deg, var(--cyber-bg-dark) 0%, var(--cyber-bg-medium) 100%);
            color: var(--cyber-text-bright);
            font-family: 'Rajdhani', sans-serif;
            position: relative;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Matrix rain effect */
        .matrix-rain {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -2;
            opacity: 0.1;
        }
        
        .matrix-column {
            position: absolute;
            color: var(--cyber-matrix-green);
            font-family: 'Share Tech Mono', monospace;
            font-size: 12px;
            line-height: 1.2;
            white-space: nowrap;
            animation: matrix-fall linear infinite;
        }
        
        @keyframes matrix-fall {
            0% { transform: translateY(-100vh); }
            100% { transform: translateY(100vh); }
        }
        
        /* Grid background */
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
        
        /* Navigation */
        .navbar {
            background: rgba(10, 14, 23, 0.95);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(0, 238, 255, 0.2);
            padding: 0.5rem 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0, 238, 255, 0.1);
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            color: var(--cyber-primary);
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            text-decoration: none;
        }
        
        .navbar-brand:hover {
            color: var(--cyber-primary);
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
            text-decoration: none;
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
        
        /* Hero Section */
        .hero-section {
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, rgba(0, 0, 20, 0.8) 0%, rgba(10, 14, 23, 0.8) 100%);
            padding: 6rem 0;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 30% 40%, rgba(0, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(255, 0, 160, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 50% 80%, rgba(119, 0, 255, 0.1) 0%, transparent 50%);
            z-index: -1;
        }
        
        .hero-title {
            font-size: 4rem;
            text-transform: uppercase;
            font-weight: 900;
            margin-bottom: 1.5rem;
            line-height: 1.1;
            background: linear-gradient(45deg, var(--cyber-primary), var(--cyber-secondary), var(--cyber-tertiary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 0 30px rgba(0, 238, 255, 0.5);
            font-family: 'Orbitron', sans-serif;
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: var(--cyber-text-dim);
            font-family: 'Share Tech Mono', monospace;
            letter-spacing: 2px;
        }
        
        /* Glitch effect for title */
        .glitch-text {
            position: relative;
            animation: glitch-main 3s infinite linear alternate-reverse;
        }
        
        .glitch-text::before,
        .glitch-text::after {
            content: attr(data-text);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .glitch-text::before {
            left: 2px;
            text-shadow: -2px 0 var(--cyber-secondary);
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-1 5s infinite linear alternate-reverse;
        }
        
        .glitch-text::after {
            left: -2px;
            text-shadow: -2px 0 var(--cyber-tertiary);
            clip: rect(44px, 450px, 56px, 0);
            animation: glitch-2 5s infinite linear alternate-reverse;
        }
        
        @keyframes glitch-main {
            0%, 92%, 100% { transform: translate(0); }
            94% { transform: translate(-2px, 0); }
            96% { transform: translate(2px, 0); }
        }
        
        @keyframes glitch-1 {
            0% { clip: rect(42px, 9999px, 44px, 0); }
            5% { clip: rect(12px, 9999px, 59px, 0); }
            10% { clip: rect(48px, 9999px, 29px, 0); }
            15% { clip: rect(42px, 9999px, 73px, 0); }
            20% { clip: rect(63px, 9999px, 27px, 0); }
            25% { clip: rect(34px, 9999px, 55px, 0); }
            30% { clip: rect(86px, 9999px, 73px, 0); }
            35% { clip: rect(20px, 9999px, 20px, 0); }
            40% { clip: rect(26px, 9999px, 60px, 0); }
            45% { clip: rect(25px, 9999px, 66px, 0); }
            50% { clip: rect(57px, 9999px, 98px, 0); }
            55% { clip: rect(5px, 9999px, 46px, 0); }
            60% { clip: rect(82px, 9999px, 31px, 0); }
            65% { clip: rect(54px, 9999px, 27px, 0); }
            70% { clip: rect(28px, 9999px, 99px, 0); }
            75% { clip: rect(45px, 9999px, 69px, 0); }
            80% { clip: rect(23px, 9999px, 85px, 0); }
            85% { clip: rect(54px, 9999px, 84px, 0); }
            90% { clip: rect(45px, 9999px, 47px, 0); }
            95% { clip: rect(37px, 9999px, 20px, 0); }
            100% { clip: rect(4px, 9999px, 91px, 0); }
        }
        
        @keyframes glitch-2 {
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
        
        /* Developer cards */
        .developer-card {
            background: rgba(19, 26, 42, 0.7);
            backdrop-filter: blur(15px);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            height: 100%;
        }
        
        .developer-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--cyber-primary), var(--cyber-secondary), var(--cyber-tertiary), var(--cyber-quaternary));
            opacity: 0.7;
        }
        
        .developer-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(0, 238, 255, 0.05) 0%, rgba(255, 0, 160, 0.05) 100%);
            z-index: -1;
            transition: all 0.3s ease;
        }
        
        .developer-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: var(--cyber-primary);
            box-shadow: 
                0 20px 40px rgba(0, 238, 255, 0.2),
                inset 0 0 20px rgba(0, 238, 255, 0.1);
        }
        
        .developer-card:hover::after {
            background: linear-gradient(135deg, rgba(0, 238, 255, 0.1) 0%, rgba(255, 0, 160, 0.1) 100%);
        }
        
        .developer-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            position: relative;
            overflow: hidden;
            border: 3px solid var(--cyber-primary);
            box-shadow: 0 0 20px rgba(0, 238, 255, 0.5);
            transition: all 0.3s ease;
        }
        
        .developer-card:hover .developer-avatar {
            border-color: var(--cyber-tertiary);
            box-shadow: 0 0 30px rgba(255, 221, 0, 0.7);
            transform: scale(1.05);
        }
        
        .developer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: sepia(0.3) hue-rotate(180deg) brightness(1.1);
            transition: all 0.3s ease;
        }
        
        .developer-card:hover .developer-avatar img {
            filter: sepia(0.1) hue-rotate(200deg) brightness(1.2);
            transform: scale(1.1);
        }
        
        .developer-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-align: center;
            background: linear-gradient(45deg, var(--cyber-primary), var(--cyber-quaternary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Orbitron', sans-serif;
        }
        
        .developer-role {
            font-size: 1.1rem;
            color: var(--cyber-tertiary);
            text-align: center;
            margin-bottom: 1rem;
            font-family: 'Share Tech Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .developer-bio {
            color: var(--cyber-text-dim);
            text-align: center;
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .developer-skills {
            margin-bottom: 1.5rem;
        }
        
        .skill-tag {
            display: inline-block;
            background: rgba(0, 238, 255, 0.2);
            color: var(--cyber-primary);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            margin: 0.2rem;
            font-size: 0.85rem;
            border: 1px solid rgba(0, 238, 255, 0.3);
            transition: all 0.3s ease;
            font-family: 'Share Tech Mono', monospace;
        }
        
        .skill-tag:hover {
            background: rgba(0, 238, 255, 0.3);
            transform: scale(1.05);
            box-shadow: 0 0 10px rgba(0, 238, 255, 0.5);
        }
        
        .developer-social {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(0, 238, 255, 0.1);
            color: var(--cyber-primary);
            transition: all 0.3s ease;
            text-decoration: none;
            border: 1px solid rgba(0, 238, 255, 0.3);
        }
        
        .social-link:hover {
            background: var(--cyber-primary);
            color: var(--cyber-bg-dark);
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 238, 255, 0.4);
        }
        
        /* Team stats section */
        .team-stats {
            background: rgba(19, 26, 42, 0.5);
            backdrop-filter: blur(10px);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 15px;
            padding: 3rem 2rem;
            margin: 3rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .team-stats::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 238, 255, 0.05), rgba(255, 0, 160, 0.05));
            z-index: -1;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 900;
            color: var(--cyber-primary);
            font-family: 'Orbitron', sans-serif;
            margin-bottom: 0.5rem;
            text-shadow: 0 0 15px rgba(0, 238, 255, 0.5);
        }
        
        .stat-label {
            color: var(--cyber-text-dim);
            font-size: 1.1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-family: 'Share Tech Mono', monospace;
        }
        
        /* Mission section */
        .mission-section {
            background: rgba(19, 26, 42, 0.6);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(0, 238, 255, 0.2);
            border-radius: 20px;
            padding: 4rem 3rem;
            margin: 4rem 0;
            position: relative;
            overflow: hidden;
        }
        
        .mission-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: 
                radial-gradient(circle, rgba(0, 238, 255, 0.1) 0%, transparent 70%),
                radial-gradient(circle, rgba(255, 0, 160, 0.1) 0%, transparent 70%);
            animation: mission-pulse 8s ease-in-out infinite;
            z-index: -1;
        }
        
        @keyframes mission-pulse {
            0%, 100% { transform: scale(1) rotate(0deg); }
            50% { transform: scale(1.1) rotate(180deg); }
        }
        
        .section-title {
            font-size: 2.5rem;
            text-transform: uppercase;
            margin-bottom: 2rem;
            text-align: center;
            background: linear-gradient(45deg, var(--cyber-primary), var(--cyber-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
        }
        
        .section-subtitle {
            color: var(--cyber-text-dim);
            text-align: center;
            margin-bottom: 3rem;
            font-size: 1.2rem;
            font-family: 'Share Tech Mono', monospace;
        }
        
        /* Floating animation */
        .float-animation {
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        /* Terminal window styling */
        .terminal-window {
            background: var(--cyber-bg-dark);
            border: 1px solid var(--cyber-primary);
            border-radius: 8px;
            overflow: hidden;
            margin: 2rem 0;
            box-shadow: 0 0 20px rgba(0, 238, 255, 0.3);
        }
        
        .terminal-header {
            background: rgba(0, 238, 255, 0.1);
            padding: 0.5rem 1rem;
            border-bottom: 1px solid var(--cyber-primary);
            display: flex;
            align-items: center;
        }
        
        .terminal-controls {
            display: flex;
            gap: 0.5rem;
        }
        
        .terminal-control {
            width: 12px;
            height: 12px;
            border-radius: 50%;
        }
        
        .terminal-control.close { background: #ff5f57; }
        .terminal-control.minimize { background: #ffbd2e; }
        .terminal-control.maximize { background: #28ca42; }
        
        .terminal-title {
            margin-left: 1rem;
            color: var(--cyber-primary);
            font-family: 'Share Tech Mono', monospace;
            font-size: 0.9rem;
        }
        
        .terminal-content {
            padding: 1rem;
            font-family: 'Share Tech Mono', monospace;
            color: var(--cyber-matrix-green);
            font-size: 0.9rem;
            line-height: 1.4;
        }
        
        .terminal-prompt {
            color: var(--cyber-primary);
        }
        
        /* Footer */
        .footer {
            background: rgba(10, 14, 23, 0.95);
            border-top: 1px solid rgba(0, 238, 255, 0.2);
            padding: 3rem 0 2rem;
            margin-top: 4rem;
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
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.2rem;
            }
            
            .developer-avatar {
                width: 120px;
                height: 120px;
            }
            
            .stat-number {
                font-size: 2rem;
            }
        }
        
        /* Scroll animations */
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }
        
        .fade-in-up.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Loading animation for avatars */
        .developer-avatar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent, rgba(0, 238, 255, 0.3), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
        }
        
        .developer-card:hover .developer-avatar::before {
            transform: translateX(100%);
        }
    </style>
</head>
<body>
    <!-- Matrix rain effect -->
    <div class="matrix-rain" id="matrixRain"></div>

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
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">About</a>
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
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <a href="login.php" class="btn btn-primary me-2">Login</a>
                    <a href="register.php" class="btn btn-secondary">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="hero-title">
                        <span class="glitch-text" data-text="Meet The Team">Meet The Team</span>
                    </h1>
                    <p class="hero-subtitle">// The brilliant minds behind HackMeBank</p>
                    <div class="terminal-window" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="300">
                        <div class="terminal-header">
                            <div class="terminal-controls">
                                <div class="terminal-control close"></div>
                                <div class="terminal-control minimize"></div>
                                <div class="terminal-control maximize"></div>
                            </div>
                            <div class="terminal-title">~/hackmebank/team_info.sh</div>
                        </div>
                        <div class="terminal-content">
                            <div><span class="terminal-prompt">user@hackmebank:~$</span> ./team_info.sh</div>
                            <div>Initializing team data...</div>
                            <div>Loading developer profiles...</div>
                            <div>Status: <span style="color: var(--cyber-success);">ACTIVE</span></div>
                            <div>Team size: <span style="color: var(--cyber-tertiary);">5</span> Computer Science Students</div>
                            <div>Mission: <span style="color: var(--cyber-primary);">Building secure tomorrow, one vulnerability at a time</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="container py-5">
        <!-- Team Stats -->
        <section class="team-stats" data-aos="fade-up" data-aos-duration="800">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="5">0</div>
                        <div class="stat-label">Developers</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="15000">0</div>
                        <div class="stat-label">Lines of Code</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="24">0</div>
                        <div class="stat-label">Months Development</div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="stat-item">
                        <div class="stat-number" data-count="100">0</div>
                        <div class="stat-label">Coffee Cups</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Developer Profiles -->
        <section class="mb-5">
            <div class="row mb-5">
                <div class="col-12 text-center" data-aos="fade-up" data-aos-duration="800">
                    <h2 class="section-title">Our Development Team</h2>
                    <p class="section-subtitle">Meet the computer science students who made HackMeBank possible</p>
                </div>
            </div>

            <div class="row">
                <!-- Developer 1 -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="100">
                    <div class="developer-card float-animation">
                        <div class="developer-avatar">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop&crop=face" alt="Alex Chen">
                        </div>
                        <h3 class="developer-name">Alex Chen</h3>
                        <p class="developer-role">Lead Developer & Security Architect</p>
                        <p class="developer-bio">
                            4th year Computer Science student specializing in cybersecurity. Alex leads the backend development and security implementation, ensuring each vulnerability is realistic yet educational.
                        </p>
                        <div class="developer-skills">
                            <span class="skill-tag">PHP</span>
                            <span class="skill-tag">MySQL</span>
                            <span class="skill-tag">Security Testing</span>
                            <span class="skill-tag">Linux</span>
                            <span class="skill-tag">Docker</span>
                        </div>
                        <div class="developer-social">
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Developer 2 -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="200">
                    <div class="developer-card float-animation">
                        <div class="developer-avatar">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=300&h=300&fit=crop&crop=face" alt="Sarah Martinez">
                        </div>
                        <h3 class="developer-name">Sarah Martinez</h3>
                        <p class="developer-role">Frontend Developer & UI/UX Designer</p>
                        <p class="developer-bio">
                            3rd year CS student with a passion for creating intuitive interfaces. Sarah designed the cyberpunk-themed UI and ensures the platform is both visually appealing and user-friendly.
                        </p>
                        <div class="developer-skills">
                            <span class="skill-tag">JavaScript</span>
                            <span class="skill-tag">React</span>
                            <span class="skill-tag">CSS3</span>
                            <span class="skill-tag">Bootstrap</span>
                            <span class="skill-tag">Figma</span>
                        </div>
                        <div class="developer-social">
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-dribbble"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Developer 3 -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="300">
                    <div class="developer-card float-animation">
                        <div class="developer-avatar">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=300&h=300&fit=crop&crop=face" alt="Marcus Johnson">
                        </div>
                        <h3 class="developer-name">Marcus Johnson</h3>
                        <p class="developer-role">Database Administrator & Backend Developer</p>
                        <p class="developer-bio">
                            4th year student focusing on database systems and server architecture. Marcus designed the vulnerable database structures and banking transaction systems that make HackMeBank realistic.
                        </p>
                        <div class="developer-skills">
                            <span class="skill-tag">MySQL</span>
                            <span class="skill-tag">PostgreSQL</span>
                            <span class="skill-tag">Node.js</span>
                            <span class="skill-tag">API Development</span>
                            <span class="skill-tag">AWS</span>
                        </div>
                        <div class="developer-social">
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-globe"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Developer 4 -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="400">
                    <div class="developer-card float-animation">
                        <div class="developer-avatar">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=300&h=300&fit=crop&crop=face" alt="Emily Zhang">
                        </div>
                        <h3 class="developer-name">Emily Zhang</h3>
                        <p class="developer-role">Security Researcher & Content Creator</p>
                        <p class="developer-bio">
                            3rd year CS student with expertise in penetration testing. Emily researches real-world vulnerabilities, creates educational content, and ensures all exploits are properly documented.
                        </p>
                        <div class="developer-skills">
                            <span class="skill-tag">Penetration Testing</span>
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">Burp Suite</span>
                            <span class="skill-tag">OWASP</span>
                            <span class="skill-tag">Technical Writing</span>
                        </div>
                        <div class="developer-social">
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-link"><i class="fas fa-blog"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Developer 5 -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="500">
                    <div class="developer-card float-animation">
                        <div class="developer-avatar">
                            <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=300&h=300&fit=crop&crop=face" alt="David Kim">
                        </div>
                        <h3 class="developer-name">David Kim</h3>
                        <p class="developer-role">DevOps Engineer & System Administrator</p>
                        <p class="developer-bio">
                            4th year student specializing in system administration and DevOps practices. David handles deployment, containerization, and ensures the platform runs smoothly across different environments.
                        </p>
                        <div class="developer-skills">
                            <span class="skill-tag">Docker</span>
                            <span class="skill-tag">Kubernetes</span>
                            <span class="skill-tag">CI/CD</span>
                            <span class="skill-tag">Linux Administration</span>
                            <span class="skill-tag">Monitoring</span>
                        </div>
                        <div class="developer-social">
                            <a href="#" class="social-link"><i class="fab fa-github"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="social-link"><i class="fab fa-docker"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Team Photo Placeholder -->
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="600">
                    <div class="developer-card" style="background: linear-gradient(135deg, rgba(0, 238, 255, 0.1), rgba(255, 0, 160, 0.1)); display: flex; align-items: center; justify-content: center; text-align: center;">
                        <div>
                            <i class="fas fa-users fa-4x mb-3" style="color: var(--cyber-primary);"></i>
                            <h3 class="developer-name">Together We Code</h3>
                            <p class="developer-role">United by Curiosity</p>
                            <p class="developer-bio">
                                Five students, countless late-night coding sessions, and one shared vision: making cybersecurity education accessible to everyone through hands-on learning.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission Section -->
        <section class="mission-section" data-aos="fade-up" data-aos-duration="1000">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Our Mission</h2>
                    <p class="section-subtitle">Empowering the next generation of cybersecurity professionals</p>
                    <div class="row mt-4">
                        <div class="col-md-4 mb-4">
                            <div class="text-center">
                                <i class="fas fa-graduation-cap fa-3x mb-3" style="color: var(--cyber-primary);"></i>
                                <h4 style="color: var(--cyber-primary);">Education First</h4>
                                <p>We believe practical experience is the best teacher. HackMeBank provides a safe environment to learn from mistakes.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="text-center">
                                <i class="fas fa-shield-alt fa-3x mb-3" style="color: var(--cyber-secondary);"></i>
                                <h4 style="color: var(--cyber-secondary);">Ethical Security</h4>
                                <p>Every vulnerability comes with proper mitigation strategies, promoting responsible security practices.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="text-center">
                                <i class="fas fa-users fa-3x mb-3" style="color: var(--cyber-tertiary);"></i>
                                <h4 style="color: var(--cyber-tertiary);">Community Driven</h4>
                                <p>Built by students, for students. We understand the challenges of learning cybersecurity concepts.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Development Journey Timeline -->
        <section class="mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Development Journey</h2>
                    <p class="section-subtitle">From concept to reality - our learning experience</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="terminal-window">
                        <div class="terminal-header">
                            <div class="terminal-controls">
                                <div class="terminal-control close"></div>
                                <div class="terminal-control minimize"></div>
                                <div class="terminal-control maximize"></div>
                            </div>
                            <div class="terminal-title">~/hackmebank/journey.log</div>
                        </div>
                        <div class="terminal-content">
                            <div><span class="terminal-prompt">[2023-01-15]</span> Project inception during Cybersecurity course</div>
                            <div><span class="terminal-prompt">[2023-02-01]</span> Team formation - 5 CS students united by curiosity</div>
                            <div><span class="terminal-prompt">[2023-03-10]</span> First prototype with basic SQL injection</div>
                            <div><span class="terminal-prompt">[2023-05-20]</span> Added XSS and command injection vulnerabilities</div>
                            <div><span class="terminal-prompt">[2023-08-15]</span> UI/UX overhaul with cyberpunk theme</div>
                            <div><span class="terminal-prompt">[2023-11-30]</span> Beta testing with fellow students</div>
                            <div><span class="terminal-prompt">[2024-01-15]</span> Public release v1.0</div>
                            <div><span class="terminal-prompt">[2024-06-10]</span> Added educational content and tutorials</div>
                            <div><span class="terminal-prompt">[2024-12-01]</span> Major update v2.0 with expanded features</div>
                            <div><span class="terminal-prompt">[2025-03-25]</span> <span style="color: var(--cyber-success);">CURRENT</span> - Continuous improvement and community feedback</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Technologies Used -->
        <section class="mb-5" data-aos="fade-up" data-aos-duration="800">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <h2 class="section-title">Technologies We Love</h2>
                    <p class="section-subtitle">The tools and technologies that power HackMeBank</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="row text-center">
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fab fa-php fa-3x mb-2" style="color: var(--cyber-primary);"></i>
                                <h5>PHP</h5>
                                <p class="small text-muted">Backend Logic</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fas fa-database fa-3x mb-2" style="color: var(--cyber-secondary);"></i>
                                <h5>MySQL</h5>
                                <p class="small text-muted">Database</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fab fa-js-square fa-3x mb-2" style="color: var(--cyber-tertiary);"></i>
                                <h5>JavaScript</h5>
                                <p class="small text-muted">Frontend Interaction</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fab fa-bootstrap fa-3x mb-2" style="color: var(--cyber-quaternary);"></i>
                                <h5>Bootstrap</h5>
                                <p class="small text-muted">UI Framework</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fab fa-docker fa-3x mb-2" style="color: var(--cyber-primary);"></i>
                                <h5>Docker</h5>
                                <p class="small text-muted">Containerization</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fab fa-github fa-3x mb-2" style="color: var(--cyber-secondary);"></i>
                                <h5>Git</h5>
                                <p class="small text-muted">Version Control</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fab fa-linux fa-3x mb-2" style="color: var(--cyber-tertiary);"></i>
                                <h5>Linux</h5>
                                <p class="small text-muted">Server Environment</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="p-3">
                                <i class="fas fa-shield-alt fa-3x mb-2" style="color: var(--cyber-quaternary);"></i>
                                <h5>Security Tools</h5>
                                <p class="small text-muted">Burp Suite, OWASP ZAP</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact CTA -->
        <section class="text-center" data-aos="fade-up" data-aos-duration="800">
            <div class="team-stats">
                <h2 class="section-title mb-4">Want to Connect?</h2>
                <p class="section-subtitle mb-4">We're always excited to connect with fellow cybersecurity enthusiasts, students, and educators.</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="mailto:team@hackmebank.com" class="btn btn-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i> Email Us
                    </a>
                    <a href="https://github.com/hackmebank" class="btn btn-secondary btn-lg">
                        <i class="fab fa-github me-2"></i> View Source
                    </a>
                    <a href="#" class="btn btn-primary btn-lg">
                        <i class="fas fa-comments me-2"></i> Join Discussion
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Enhanced Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5 style="color: var(--cyber-primary);">HackMeBank</h5>
                    <p class="mb-2">A Vulnerable Web Application for Cybersecurity Training</p>
                    <p class="mb-0">&copy; 2025 HackMeBank Development Team</p>
                    <p class="mb-0 small">Built with ❤️ by Computer Science Students</p>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="color: var(--cyber-secondary);">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Team</a></li>
                        <li><a href="vulnerabilities/index.php">Vulnerabilities</a></li>
                        <li><a href="register.php">Get Started</a></li>
                        <li><a href="documentation.php">Documentation</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-4">
                    <h5 style="color: var(--cyber-tertiary);">Connect</h5>
                    <ul class="list-unstyled">
                        <li><a href="https://github.com/hackmebank">GitHub Repository</a></li>
                        <li><a href="mailto:team@hackmebank.com">Contact Team</a></li>
                        <li><a href="#">Report Issues</a></li>
                        <li><a href="#">Contribute</a></li>
                    </ul>
                    <div class="mt-3">
                        <a href="#" class="social-link me-2"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-link me-2"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link me-2"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-link"><i class="fas fa-envelope"></i></a>
                    </div>
                </div>
            </div>
            <hr style="border-color: rgba(0, 238, 255, 0.2);">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0 small">
                        Made for educational purposes only. Please use responsibly in controlled environments.
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    
    <script>
        // Initialize AOS animations
        AOS.init({
            once: true,
            duration: 800,
            easing: 'ease-in-out'
        });

        // Matrix rain effect
        function createMatrixRain() {
            const matrixContainer = document.getElementById('matrixRain');
            const characters = '01アイウエオカキクケコサシスセソタチツテトナニヌネノハヒフヘホマミムメモヤユヨラリルレロワヲン';
            
            // Clear existing columns
            matrixContainer.innerHTML = '';
            
            const columns = Math.floor(window.innerWidth / 20);
            
            for (let i = 0; i < columns; i++) {
                const column = document.createElement('div');
                column.className = 'matrix-column';
                column.style.left = i * 20 + 'px';
                column.style.animationDuration = (Math.random() * 3 + 2) + 's';
                column.style.animationDelay = Math.random() * 2 + 's';
                
                let columnText = '';
                const columnHeight = Math.floor(Math.random() * 20) + 10;
                
                for (let j = 0; j < columnHeight; j++) {
                    columnText += characters.charAt(Math.floor(Math.random() * characters.length)) + '<br>';
                }
                
                column.innerHTML = columnText;
                matrixContainer.appendChild(column);
            }
        }

        // Initialize matrix rain
        createMatrixRain();

        // Recreate matrix rain on window resize
        window.addEventListener('resize', createMatrixRain);

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target;
                        const target = parseInt(counter.getAttribute('data-count'));
                        const duration = 2000;
                        const step = target / (duration / 16);
                        
                        let current = 0;
                        const timer = setInterval(() => {
                            current += step;
                            if (current >= target) {
                                counter.textContent = target.toLocaleString();
                                clearInterval(timer);
                            } else {
                                counter.textContent = Math.floor(current).toLocaleString();
                            }
                        }, 16);
                        
                        observer.unobserve(counter);
                    }
                });
            }, { threshold: 0.5 });
            
            counters.forEach(counter => observer.observe(counter));
        }

        // Initialize counter animation
        animateCounters();

        // Parallax effect for floating elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelectorAll('.float-animation');
            
            parallax.forEach(element => {
                const speed = 0.5;
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
        });

        // Add typing effect to terminal
        function typeWriter(element, text, speed = 50) {
            let i = 0;
            element.innerHTML = '';
            
            function type() {
                if (i < text.length) {
                    element.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            type();
        }

        // Enhanced hover effects for developer cards
        document.querySelectorAll('.developer-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.02) rotateY(5deg)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1) rotateY(0deg)';
            });
        });

        // Add glitch effect to skill tags on hover
        document.querySelectorAll('.skill-tag').forEach(tag => {
            tag.addEventListener('mouseenter', function() {
                this.style.animation = 'glitch-main 0.3s linear';
            });
            
            tag.addEventListener('mouseleave', function() {
                this.style.animation = 'none';
            });
        });

        // Interactive terminal cursor
        setInterval(() => {
            const cursors = document.querySelectorAll('.terminal-content');
            cursors.forEach(terminal => {
                if (Math.random() > 0.7) {
                    terminal.style.borderRight = terminal.style.borderRight === '2px solid var(--cyber-primary)' ? 'none' : '2px solid var(--cyber-primary)';
                }
            });
        }, 500);
    </script>
</body>
</html>