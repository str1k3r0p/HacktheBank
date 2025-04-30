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
        /* Some additional styles for the home page */
        .hero-section {
            min-height: 70vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
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
            background: radial-gradient(circle at 70% 50%, rgba(0, 255, 255, 0.1) 0%, transparent 60%);
            z-index: -1;
        }
        
        .hero-content {
            position: relative;
            z-index: 1;
        }
        
        .hero-title {
            font-size: 3.5rem;
            text-transform: uppercase;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.6);
        }
        
        .hero-subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: var(--cyber-text-dim);
            font-family: var(--cyber-font-mono);
        }
        
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
        
        .vulnerability-card {
            background: rgba(5, 5, 16, 0.7);
            backdrop-filter: blur(5px);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .vulnerability-card:hover {
            transform: translateY(-10px);
            border-color: var(--cyber-primary);
            box-shadow: 0 10px 20px rgba(0, 255, 255, 0.2);
        }
        
        .vulnerability-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
            transition: all 0.3s ease;
        }
        
        .vulnerability-card:hover .vulnerability-icon {
            color: var(--cyber-tertiary);
            transform: scale(1.1);
        }
        
        .vulnerability-title {
            font-family: var(--cyber-font-mono);
            font-size: 1.25rem;
            text-transform: uppercase;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }
        
        .vulnerability-card:hover .vulnerability-title {
            text-shadow: 0 0 10px var(--cyber-primary);
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
            animation: scan 1.5s linear;
            opacity: 1;
        }
        
        @keyframes scan {
            0% { top: 0%; }
            100% { top: 100%; }
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
                </ul>

                <!-- Security Level Selector -->
                <div class="security-level-selector me-3">
                    <span class="security-level-label">Security Level:</span>
                    <div class="btn-group" role="group">
                        <button type="button" class="security-btn active" data-level="low">Low</button>
                        <button type="button" class="security-btn" data-level="medium">Medium</button>
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

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 hero-content">
                    <h1 class="hero-title">
                        <span class="glitch-effect" data-text="HackMeBank">HackMeBank</span>
                    </h1>
                    <p class="hero-subtitle">A cybersecurity training platform with deliberate vulnerabilities</p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="register.php" class="btn btn-primary btn-lg">
                            <i class="fas fa-user-plus me-2"></i> Get Started
                        </a>
                        <a href="vulnerabilities/index.php" class="btn btn-secondary btn-lg">
                            <i class="fas fa-shield-alt me-2"></i> Explore Vulnerabilities
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 d-none d-lg-block">
                    <img src="assets/images/cyber-bank.png" alt="Cybersecurity Banking" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Main content area -->
    <main class="container mt-5 mb-5">
        <!-- Security Warning Card -->
        <div class="row mb-5">
            <div class="col-12">
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

        <!-- Vulnerabilities Overview -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="cyber-glow">Featured Vulnerabilities</h2>
                <p class="text-cyber-text-dim">Learn and practice with real-world security vulnerabilities in a banking context</p>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="vulnerability-card scanner-effect">
                    <div class="vulnerability-icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <h3 class="vulnerability-title">SQL Injection</h3>
                    <p>Explore how attackers can manipulate database queries to bypass authentication, extract sensitive data, and more.</p>
                    <a href="vulnerabilities/sql_injection.php" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-right me-2"></i> Learn More
                    </a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="vulnerability-card scanner-effect">
                    <div class="vulnerability-icon">
                        <i class="fas fa-code"></i>
                    </div>
                    <h3 class="vulnerability-title">Cross-Site Scripting</h3>
                    <p>Discover how malicious scripts can be injected into web pages to steal session cookies, hijack accounts, and deface websites.</p>
                    <a href="vulnerabilities/xss.php" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-right me-2"></i> Learn More
                    </a>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="vulnerability-card scanner-effect">
                    <div class="vulnerability-icon">
                        <i class="fas fa-terminal"></i>
                    </div>
                    <h3 class="vulnerability-title">Command Injection</h3>
                    <p>Learn how attackers can execute system commands through vulnerable web applications to gain unauthorized access.</p>
                    <a href="vulnerabilities/cmd_injection.php" class="btn btn-primary mt-3">
                        <i class="fas fa-arrow-right me-2"></i> Learn More
                    </a>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="row mb-5">
            <div class="col-12 text-center mb-4">
                <h2 class="cyber-glow">Key Features</h2>
                <p class="text-cyber-text-dim">A comprehensive platform for cybersecurity training</p>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-layer-group me-2"></i> Multiple Security Levels</h3>
                        <p class="card-text">Each vulnerability can be explored at different security levels: Low, Medium, and High. This lets you understand how different protection mechanisms work.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-users-cog me-2"></i> User Role Simulation</h3>
                        <p class="card-text">Experience different perspectives with multiple user roles: Customer, Bank Manager, and Admin, each with different access levels and capabilities.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-book-open me-2"></i> Educational Content</h3>
                        <p class="card-text">Each vulnerability includes detailed explanations, exploitation techniques, and mitigation strategies to enhance your learning experience.</p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-university me-2"></i> Realistic Banking Interface</h3>
                        <p class="card-text">Practice in a realistic banking application with accounts, transfers, transactions, and more to simulate real-world scenarios.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Call to Action -->
        <div class="row">
            <div class="col-12">
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
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 HackMeBank - A Vulnerable Web Application for Cybersecurity Training</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="me-3">Terms</a>
                    <a href="#" class="me-3">Privacy</a>
                    <a href="#" class="me-3">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/security-display.js"></script>
    <script src="js/highlight.min.js"></script>
    
    <script>
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
        });
    </script>
</body>
</html>