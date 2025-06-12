<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brute Force - HackMeBank</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700;900&family=Rajdhani:wght@300;400;500;600;700&family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <!-- Custom styles -->
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/cyberpunk-theme.css" rel="stylesheet">
    <link href="../css/security-display.css" rel="stylesheet">
    <!-- Highlight.js for code syntax highlighting -->
    <link href="../css/highlight.min.css" rel="stylesheet">
    <!-- Prism CSS for better code highlighting -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/themes/prism-tomorrow.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <style>
        /* Additional styles specific to the Brute Force vulnerability page */
        .brute-header {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.3) 0%, rgba(240, 0, 204, 0.3) 100%);
            border-radius: 5px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .brute-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../assets/images/code-pattern.png');
            background-size: cover;
            opacity: 0.1;
            z-index: -1;
        }

        .brute-header h1 {
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        }

        .brute-header p {
            font-size: 1.1rem;
            color: var(--cyber-text);
            max-width: 800px;
        }

        .security-badge {
            display: inline-block;
            padding: 0.25rem 1rem;
            border-radius: 3px;
            font-family: var(--cyber-font-mono);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 0.8rem;
            margin-right: 0.5rem;
        }

        .security-badge.low {
            background-color: rgba(255, 34, 102, 0.2);
            color: var(--cyber-danger);
            border: 1px solid var(--cyber-danger);
        }

        .security-badge.medium {
            background-color: rgba(255, 221, 0, 0.2);
            color: var(--cyber-warning);
            border: 1px solid var(--cyber-warning);
        }

        .security-badge.high {
            background-color: rgba(0, 255, 102, 0.2);
            color: var(--cyber-success);
            border: 1px solid var(--cyber-success);
        }

        .brute-type-section {
            margin-bottom: 2.5rem;
        }

        .brute-type-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .brute-type-title {
            display: flex;
            align-items: center;
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .brute-type-title i {
            margin-right: 0.75rem;
        }

        .code-block-header {
            background-color: var(--cyber-bg-darker);
            border: 1px solid var(--cyber-text-dim);
            border-bottom: none;
            border-radius: 5px 5px 0 0;
            padding: 0.5rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: var(--cyber-font-mono);
            font-size: 0.85rem;
            color: var(--cyber-primary);
        }

        .code-block {
            margin-bottom: 1.5rem;
            border-radius: 0 0 5px 5px;
            overflow: hidden;
        }

        pre[class*="language-"] {
            margin: 0;
            border-radius: 0 0 5px 5px;
        }

        .brute-demo-container {
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .brute-demo-title {
            font-family: var(--cyber-font-mono);
            font-size: 1.1rem;
            color: var(--cyber-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .brute-demo-title i {
            margin-right: 0.75rem;
        }

        .demo-result {
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1rem;
            min-height: 100px;
            margin-top: 1rem;
        }

        .security-level-container {
            margin-bottom: 2rem;
        }

        .security-level-tab {
            display: none;
        }

        .security-level-tab.active {
            display: block;
        }

        .nav-tabs {
            border-bottom: 1px solid var(--cyber-text-dim);
        }

        .nav-tabs .nav-link {
            border: none;
            background-color: transparent;
            color: var(--cyber-text-dim);
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 0.75rem 1.5rem;
            position: relative;
        }

        .nav-tabs .nav-link:hover {
            border: none;
            color: var(--cyber-primary);
        }

        .nav-tabs .nav-link.active {
            background-color: transparent;
            color: var(--cyber-primary);
            border: none;
        }

        .nav-tabs .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            width: 100%;
            background-color: var(--cyber-primary);
        }

        .tab-content {
            padding: 1.5rem 0;
        }

        .payload-list {
            margin-bottom: 1.5rem;
        }

        .payload-item {
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .payload-code {
            font-family: var(--cyber-font-mono);
            background-color: rgba(0, 0, 0, 0.3);
            padding: 0.5rem 0.75rem;
            border-radius: 3px;
            color: var(--cyber-primary);
            display: inline-block;
            margin: 0.5rem 0;
        }

        .payload-description {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .payload-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .security-badge-large {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-family: var(--cyber-font-mono);
            font-weight: bold;
            text-transform: uppercase;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .security-badge-large i {
            margin-right: 0.5rem;
            font-size: 1.25rem;
        }

        .security-badge-large.low {
            background-color: rgba(255, 34, 102, 0.2);
            color: var(--cyber-danger);
            border: 1px solid var(--cyber-danger);
        }

        .security-badge-large.medium {
            background-color: rgba(255, 221, 0, 0.2);
            color: var(--cyber-warning);
            border: 1px solid var(--cyber-warning);
        }

        .security-badge-large.high {
            background-color: rgba(0, 255, 102, 0.2);
            color: var(--cyber-success);
            border: 1px solid var(--cyber-success);
        }

        .side-nav {
            position: sticky;
            top: 2rem;
        }

        .side-nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .side-nav-item {
            margin-bottom: 0.5rem;
        }

        .side-nav-link {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--cyber-text);
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .side-nav-link:hover, .side-nav-link.active {
            background-color: rgba(0, 255, 255, 0.1);
            border-color: var(--cyber-primary);
            color: var(--cyber-primary);
        }

        .side-nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        /* Success message for Brute Force detection */
        .brute-detection {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: rgba(0, 255, 102, 0.2);
            border: 1px solid var(--cyber-success);
            color: var(--cyber-success);
            padding: 1rem;
            border-radius: 5px;
            font-family: var(--cyber-font-mono);
            z-index: 1050;
            animation: slideIn 0.5s forwards;
            max-width: 300px;
            display: none;
        }
        
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .attack-log {
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1rem;
            margin-top: 1rem;
            font-family: var(--cyber-font-mono);
            max-height: 200px;
            overflow-y: auto;
        }

        .attack-log-entry {
            color: var(--cyber-text);
            margin-bottom: 0.5rem;
        }

        .attack-log-entry.success {
            color: #33ff33;
        }

        .attack-log-entry.failed {
            color: #ff4444;
        }

        .attack-log-entry.blocked {
            color: var(--cyber-warning);
        }

        .attack-log-entry.rate-limited {
            color: var(--cyber-primary);
        }

        .progress-bar-container {
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            height: 20px;
            margin-top: 1rem;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: var(--cyber-primary);
            text-align: center;
            line-height: 20px;
            color: var(--cyber-bg-dark);
            font-family: var(--cyber-font-mono);
            font-size: 0.85rem;
            transition: width 0.5s ease-in-out;
        }

        .wordlist-container {
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1rem;
            margin-top: 1rem;
        }

        .wordlist-title {
            font-family: var(--cyber-font-mono);
            color: var(--cyber-primary);
            margin-bottom: 0.5rem;
        }

        .wordlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 0.5rem;
            font-family: var(--cyber-font-mono);
            color: var(--cyber-text);
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/images/logo.png" alt="HackMeBank Logo" height="40" class="d-inline-block align-top me-2">
                <span class="cyber-flicker">HackMeBank</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <i class="fas fa-bars text-cyber-primary"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="vulnerabilitiesDropdown" role="button" data-bs-toggle="dropdown">
                            Vulnerabilities
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="vulnerabilitiesDropdown">
                            <li><a class="dropdown-item" href="sql_injection.php">SQL Injection</a></li>
                            <li><a class="dropdown-item" href="xss.php">XSS</a></li>
                            <li><a class="dropdown-item" href="cmd_injection.php">Command Injection</a></li>
                            <li><a class="dropdown-item active" href="bruteforce.php">Brute Force</a></li>
                            <li><a class="dropdown-item" href="directory_traversal.php">Directory Traversal</a></li>
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

                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i>
                        <span class="username">John Doe</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="../dashboard.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="../settings.php">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Brute Force Detection Alert (hidden by default) -->
    <div class="brute-detection" id="bruteDetection">
        <i class="fas fa-check-circle me-2"></i> Brute Force Attack Detected!
        <div class="mt-2 small">The current security level allowed progression of your attack.</div>
    </div>

    <!-- Main content -->
    <main class="container mt-4 mb-5">
        <!-- Brute Force Header -->
        <div class="brute-header">
            <h1><i class="fas fa-hammer me-3"></i>Brute Force Attacks</h1>
            <p>Brute force attacks are among the most widespread security threats, attempting to gain unauthorized access by systematically trying multiple combinations of usernames, passwords, or other credentials. These attacks exploit weak authentication mechanisms and can lead to account compromise, data theft, and service disruption.</p>
            <div class="mt-4">
                <span class="security-badge low">Low</span>
                <span class="security-badge medium">Medium</span>
                <span class="security-badge high">High</span>
                <span class="ms-2">Security levels available for exploration</span>
            </div>
        </div>

        <div class="row">
            <!-- Left Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="side-nav">
                    <h4>Navigation</h4>
                    <ul class="side-nav-list">
                        <li class="side-nav-item">
                            <a href="#introduction" class="side-nav-link active">
                                <i class="fas fa-info-circle"></i> Introduction
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#brute-types" class="side-nav-link">
                                <i class="fas fa-layer-group"></i> Attack Types
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#credential-stuffing" class="side-nav-link">
                                <i class="fas fa-key"></i> Credential Stuffing
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#password-spraying" class="side-nav-link">
                                <i class="fas fa-spray-can"></i> Password Spraying
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#dictionary-attack" class="side-nav-link">
                                <i class="fas fa-book"></i> Dictionary Attack
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#techniques" class="side-nav-link">
                                <i class="fas fa-cogs"></i> Techniques
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#security-levels" class="side-nav-link">
                                <i class="fas fa-shield-alt"></i> Security Levels
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#mitigation" class="side-nav-link">
                                <i class="fas fa-lock"></i> Mitigation
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#references" class="side-nav-link">
                                <i class="fas fa-book"></i> References
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
            <!-- Main Content Area -->
            <div class="col-md-9">
                <!-- Introduction -->
                <section id="introduction" class="mb-5">
                    <h2>Introduction to Brute Force Attacks</h2>
                    <p>A brute force attack is a trial-and-error method used to obtain information such as a user password or personal identification number (PIN). Attackers use automated tools to generate a large number of consecutive guesses as to the value of the desired data.</p>
                    
                    <p>The effectiveness of brute force attacks is directly related to the strength of the authentication system and the complexity of the credentials being targeted. In the context of banking applications, brute force attacks pose serious risks to account security and financial data integrity.</p>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Key Impact in Banking Applications:</strong> Successful brute force attacks can lead to unauthorized account access, fraudulent transactions, identity theft, and regulatory compliance violations. They can also cause service disruptions through account lockouts and increased system load.
                    </div>
                </section>
                
                <!-- Brute Force Types -->
                <section id="brute-types" class="mb-5">
                    <h2>Types of Brute Force Attacks</h2>
                    <p>There are several variations of brute force attacks, each with specific approaches and target vulnerabilities:</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="brute-type-icon"><i class="fas fa-key"></i></div>
                                    <h3 class="card-title">Credential Stuffing</h3>
                                    <p class="card-text">Uses previously breached username/password pairs to attempt login on multiple services, exploiting password reuse across platforms.</p>
                                    <a href="#credential-stuffing" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="brute-type-icon"><i class="fas fa-spray-can"></i></div>
                                    <h3 class="card-title">Password Spraying</h3>
                                    <p class="card-text">Tries common passwords against multiple accounts, avoiding account lockouts by keeping attempts per account low.</p>
                                    <a href="#password-spraying" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="brute-type-icon"><i class="fas fa-book"></i></div>
                                    <h3 class="card-title">Dictionary Attack</h3>
                                    <p class="card-text">Uses a predefined list of common passwords and phrases to attempt authentication against targeted accounts.</p>
                                    <a href="#dictionary-attack" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Credential Stuffing -->
                <section id="credential-stuffing" class="brute-type-section">
                    <h2 class="brute-type-title"><i class="fas fa-key"></i> Credential Stuffing</h2>
                    
                    <p>Credential stuffing attacks use automated tools to attempt login using credentials (usernames/emails and passwords) obtained from data breaches. These attacks are successful because many users reuse passwords across multiple services.</p>
                    
                    <h4 class="mb-3">How Credential Stuffing Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>Attackers obtain large datasets of breached credentials</li>
                                <li>They use automated tools to test these credentials against banking sites</li>
                                <li>Successful logins provide access to sensitive financial information</li>
                                <li>Attackers can perform unauthorized transactions or sell account access</li>
                                <li>Often combined with proxy/VPN rotation to avoid IP blocking</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Common Characteristics</h5>
                                    <ul class="mb-0">
                                        <li>High volume of login attempts</li>
                                        <li>Use of known valid email addresses</li>
                                        <li>Pattern of password reuse across platforms</li>
                                        <li>Automated tools making hundreds of attempts per minute</li>
                                        <li>Distributed attack sources to avoid detection</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>login.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - no brute force protection
function authenticateUser($email, $password) {
    global $db;
    
    // Direct login attempt without rate limiting
    $query = "SELECT * FROM users WHERE email = ? AND password = MD5(?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        // Login successful
        return $result->fetch_assoc();
    }
    
    return false;
}

// Process login attempt
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $user = authenticateUser($email, $password);
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
    } else {
        $error = "Invalid credentials";
    }
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Credential Stuffing Demo -->
                    <div class="brute-demo-container">
                        <h4 class="brute-demo-title"><i class="fas fa-flask"></i> Credential Stuffing Demonstration</h4>
                        <p>This login system is vulnerable to credential stuffing attacks. Try different attack techniques based on the security level.</p>
                        
                        <form id="credentialStuffingForm" class="mb-3">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="text" class="form-control" id="email" name="email" value="john@hackmebank.com" placeholder="Enter email">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Login</button>
                        </form>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="wordlist-container">
                                    <h6 class="wordlist-title">Sample Password List</h6>
                                    <div class="wordlist-grid" id="passwordList">
                                        <!-- Will be populated by JavaScript -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Attack Progress</h6>
                                        <div class="progress-bar-container">
                                            <div class="progress-bar" id="attackProgress" style="width: 0%">0%</div>
                                        </div>
                                        <div class="mt-2">
                                            <button class="btn btn-danger btn-sm" id="startBruteForce">Start Attack</button>
                                            <button class="btn btn-secondary btn-sm" id="stopBruteForce" disabled>Stop Attack</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="attack-log" id="credentialStuffingLog">
                            <!-- Attack log entries will appear here -->
                        </div>
                    </div>
                </section>
                
                <!-- Password Spraying -->
                <section id="password-spraying" class="brute-type-section">
                    <h2 class="brute-type-title"><i class="fas fa-spray-can"></i> Password Spraying</h2>
                    
                    <p>Password spraying is a type of brute force attack where attackers use a small number of commonly used passwords against many usernames, rather than trying many passwords against a single account. This approach helps avoid account lockouts while targeting the most likely weak passwords.</p>
                    
                    <h4 class="mb-3">How Password Spraying Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>Attackers compile a list of common passwords (e.g., Password123!, Welcome1!)</li>
                                <li>They gather a list of valid usernames or email addresses</li>
                                <li>One password is tried against all accounts before moving to the next</li>
                                <li>This avoids triggering account lockout policies</li>
                                <li>Successful logins are exploited for financial gain</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Attack Strategy</h5>
                                    <ul class="mb-0">
                                        <li>Target common weak passwords across many accounts</li>
                                        <li>Stay below account lockout thresholds</li>
                                        <li>Exploit predictable password patterns</li>
                                        <li>Focus on high-value targets (banking, finance)</li>
                                        <li>Use timing to distribute attempts across days</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>mass_login.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - inadequate account lockout policy
function attemptLogin($email, $password) {
    global $db;
    
    // Check for failed login attempts (weak threshold)
    $query = "SELECT failed_attempts FROM users WHERE email = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Only lock after 10 attempts - too lenient
        if ($user['failed_attempts'] >= 10) {
            return ['status' => 'locked'];
        }
    }
    
    // Attempt authentication
    $authQuery = "SELECT * FROM users WHERE email = ? AND password = MD5(?)";
    $authStmt = $db->prepare($authQuery);
    $authStmt->bind_param("ss", $email, $password);
    $authStmt->execute();
    
    $authResult = $authStmt->get_result();
    if ($authResult->num_rows > 0) {
        // Reset failed attempts on success
        resetFailedAttempts($email);
        return ['status' => 'success', 'user' => $authResult->fetch_assoc()];
    } else {
        // Increment failed attempts
        incrementFailedAttempts($email);
        return ['status' => 'failed'];
    }
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Password Spraying Demo -->
                    <div class="brute-demo-container">
                        <h4 class="brute-demo-title"><i class="fas fa-flask"></i> Password Spraying Demonstration</h4>
                        <p>This demonstration shows how password spraying works across multiple accounts. The system checks common passwords against different email addresses.</p>
                        
                        <div class="mb-3">
                            <h6>Target Accounts</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="email" class="form-control mb-2" value="john@hackmebank.com" readonly>
                                    <input type="email" class="form-control mb-2" value="jane@hackmebank.com" readonly>
                                    <input type="email" class="form-control mb-2" value="admin@hackmebank.com" readonly>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" class="form-control mb-2" value="support@hackmebank.com" readonly>
                                    <input type="email" class="form-control mb-2" value="manager@hackmebank.com" readonly>
                                    <input type="email" class="form-control mb-2" value="teller@hackmebank.com" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <h6>Common Passwords to Test</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>Password123!</li>
                                        <li>Welcome1!</li>
                                        <li>Admin123</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>Summer2023!</li>
                                        <li>Company123</li>
                                        <li>Banking@123</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <button class="btn btn-danger" id="startPasswordSpray">Start Password Spraying</button>
                        <button class="btn btn-secondary" id="stopPasswordSpray" disabled>Stop Attack</button>
                        
                        <div class="attack-log" id="passwordSprayLog">
                            <!-- Attack log entries will appear here -->
                        </div>
                    </div>
                </section>
                
                <!-- Dictionary Attack -->
                <section id="dictionary-attack" class="brute-type-section">
                    <h2 class="brute-type-title"><i class="fas fa-book"></i> Dictionary Attack</h2>
                    
                    <p>Dictionary attacks use a predefined list of common passwords, phrases, and variations to attempt authentication. Unlike pure brute force attacks that try all possible combinations, dictionary attacks focus on passwords that humans are likely to choose.</p>
                    
                    <h4 class="mb-3">How Dictionary Attacks Work</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>Attackers create or obtain lists of common passwords and patterns</li>
                                <li>The dictionary includes variations like numbers, special characters, and leetspeak</li>
                                <li>Automated tools try each entry in the dictionary against targeted accounts</li>
                                <li>More efficient than random brute force due to human password patterns</li>
                                <li>Can be enhanced with user-specific information (birthday, name variations)</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Dictionary Sources</h5>
                                    <ul class="mb-0">
                                        <li>Previously breached password databases</li>
                                        <li>Common word lists and phrases</li>
                                        <li>Industry-specific terminology</li>
                                        <li>Date patterns and keyboard layouts</li>
                                        <li>Modified versions with numbers and symbols</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>weak_auth.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - weak password policies
class AuthSystem {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
    
    // Weak password validation
    public function validatePassword($password) {
        // Minimal password requirements - vulnerable to dictionary attacks
        if (strlen($password) < 6) {
            return false;
        }
        
        // No complexity requirements
        // No check against common passwords
        // No validation for special characters or patterns
        
        return true;
    }
    
    public function authenticateUser($username, $password) {
        // Using weak hashing (MD5)
        $hashedPassword = md5($password);
        
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $hashedPassword);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Dictionary Attack Demo -->
                    <div class="brute-demo-container">
                        <h4 class="brute-demo-title"><i class="fas fa-flask"></i> Dictionary Attack Demonstration</h4>
                        <p>This simulation shows how dictionary attacks work using common password lists. The attack focuses on a single account with multiple password attempts.</p>
                        
                        <form id="dictionaryAttackForm" class="mb-3">
                            <div class="mb-3">
                                <label for="targetUsername" class="form-label">Target Username</label>
                                <input type="text" class="form-control" id="targetUsername" value="admin" readonly>
                            </div>
                            <button type="button" class="btn btn-danger" id="startDictionaryAttack">Start Dictionary Attack</button>
                            <button type="button" class="btn btn-secondary" id="stopDictionaryAttack" disabled>Stop Attack</button>
                        </form>
                        
                        <div class="progress-bar-container">
                            <div class="progress-bar" id="dictionaryProgress" style="width: 0%">0%</div>
                        </div>
                        
                        <div class="attack-log" id="dictionaryAttackLog">
                            <!-- Attack log entries will appear here -->
                        </div>
                    </div>
                </section>
                
                <!-- Techniques -->
                <section id="techniques" class="mb-5">
                    <h2>Common Brute Force Techniques</h2>
                    <p>Attackers employ various techniques to enhance the effectiveness of brute force attacks:</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-network-wired me-2"></i>IP Rotation</h4>
                                    <ul class="mb-0">
                                        <li>Use of proxy networks and VPNs</li>
                                        <li>Botnets with distributed IP addresses</li>
                                        <li>Cloud-based attack infrastructure</li>
                                        <li>Avoiding IP-based blocking mechanisms</li>
                                        <li>Mimicking legitimate traffic patterns</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-clock me-2"></i>Timing Optimization</h4>
                                    <ul class="mb-0">
                                        <li>Spaced-out login attempts to avoid detection</li>
                                        <li>Following business hours patterns</li>
                                        <li>Avoiding rate limiting thresholds</li>
                                        <li>Coordinated multi-source attacks</li>
                                        <li>Adaptive throttling based on response</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-brain me-2"></i>Social Engineering</h4>
                                    <ul class="mb-0">
                                        <li>Customized password lists based on company data</li>
                                        <li>Exploiting password patterns and policies</li>
                                        <li>Using employee information in password variants</li>
                                        <li>Seasonal and event-based password guessing</li>
                                        <li>Targeting specific user groups or roles</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-user-secret me-2"></i>CAPTCHA Bypass</h4>
                                    <ul class="mb-0">
                                        <li>Automated CAPTCHA solving services</li>
                                        <li>Session manipulation to avoid challenges</li>
                                        <li>Using legitimate user sessions</li>
                                        <li>Targeting API endpoints without CAPTCHA</li>
                                        <li>Solving CAPTCHAs in bulk before attacks</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Detection Indicators</h5>
                        <ul class="mb-0">
                            <li>Unusual patterns of login failures</li>
                            <li>Multiple login attempts from different sources</li>
                            <li>Common password patterns in failed attempts</li>
                            <li>Sudden spikes in authentication traffic</li>
                            <li>Geographical anomalies in login patterns</li>
                        </ul>
                    </div>
                </section>
                
                <!-- Security Levels -->
                <section id="security-levels" class="mb-5">
                    <h2>Security Levels Implementation</h2>
                    <p>This section shows how different security levels protect against brute force attacks:</p>
                    
                    <!-- Security Levels Tab Navigation -->
                    <ul class="nav nav-tabs mb-3" id="securityLevelTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="sec-low-tab" data-bs-toggle="tab" data-bs-target="#sec-low" type="button" role="tab">Low Security</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sec-medium-tab" data-bs-toggle="tab" data-bs-target="#sec-medium" type="button" role="tab">Medium Security</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="sec-high-tab" data-bs-toggle="tab" data-bs-target="#sec-high" type="button" role="tab">High Security</button>
                        </li>
                    </ul>
                    
                    <!-- Security Levels Tab Content -->
                    <div class="tab-content" id="securityLevelTabsContent">
                        <!-- Low Security Implementation -->
                        <div class="tab-pane fade show active" id="sec-low" role="tabpanel">
                            <div class="mb-4">
                                <h4>Low Security Implementation</h4>
                                <p>At this level, there is minimal protection against brute force attacks, making systems highly vulnerable:</p>
                                
                                <div class="code-block-header">
                                    <span>Low Security Code</span>
                                    <span>BruteForce.php - Low</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// LOW security - No brute force protection
function authenticateUser($username, $password) {
    global $db;
    
    // Direct authentication attempt without any rate limiting
    $query = "SELECT * FROM users WHERE username = ? AND password = MD5(?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    
    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// No attempt tracking
// No IP blocking
// No CAPTCHA protection
// No password complexity requirements
// No session security measures</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-danger">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">No protection against automated attacks, allowing unlimited login attempts from any source. This setup is extremely vulnerable to credential stuffing, password spraying, and dictionary attacks.</p>
                            </div>
                        </div>
                        
                        <!-- Medium Security Implementation -->
                        <div class="tab-pane fade" id="sec-medium" role="tabpanel">
                            <div class="mb-4">
                                <h4>Medium Security Implementation</h4>
                                <p>At this level, basic protections are implemented but can be bypassed with sophisticated techniques:</p>
                                
                                <div class="code-block-header">
                                    <span>Medium Security Code</span>
                                    <span>BruteForce.php - Medium</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// MEDIUM security - Basic brute force protection
class AuthSystem {
    private $db;
    private $maxAttempts = 5;
    private $lockoutTime = 300; // 5 minutes
    
    public function authenticateUser($username, $password) {
        // Check if account is locked
        if ($this->isAccountLocked($username)) {
            return ['status' => 'locked', 'message' => 'Account temporarily locked'];
        }
        
        // Get failed attempts
        $attempts = $this->getFailedAttempts($username);
        
        if ($attempts >= $this->maxAttempts) {
            $this->lockAccount($username);
            return ['status' => 'locked', 'message' => 'Too many failed attempts'];
        }
        
        // Authenticate
        $query = "SELECT * FROM users WHERE username = ? AND password = MD5(?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $this->resetFailedAttempts($username);
            return ['status' => 'success'];
        } else {
            $this->incrementFailedAttempts($username);
            return ['status' => 'failed'];
        }
    }
    
    // Basic account locking (can be bypassed with IP rotation)
    private function lockAccount($username) {
        // Simple time-based lock
    }
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">While basic protections exist, they can be bypassed through IP rotation, distributed attacks, and by exploiting the relatively high threshold for lockouts. The system remains vulnerable to coordinated attacks.</p>
                            </div>
                        </div>
                        
                        <!-- High Security Implementation -->
                        <div class="tab-pane fade" id="sec-high" role="tabpanel">
                            <div class="mb-4">
                                <h4>High Security Implementation</h4>
                                <p>At this level, comprehensive protection mechanisms are implemented to prevent brute force attacks:</p>
                                
                                <div class="code-block-header">
                                    <span>High Security Code</span>
                                    <span>BruteForce.php - High</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// HIGH security - Comprehensive brute force protection
class SecureAuthSystem {
    private $db;
    private $redis; // For rate limiting and tracking
    
    public function authenticateUser($username, $password, $ip, $userAgent) {
        // Multi-factor rate limiting
        if ($this->isRateLimited($username, $ip)) {
            return ['status' => 'rate_limited', 'message' => 'Too many attempts'];
        }
        
        // Check for anomaly patterns
        if ($this->detectAnomalies($username, $ip, $userAgent)) {
            $this->logSuspiciousActivity($username, $ip);
            return ['status' => 'blocked', 'message' => 'Suspicious activity detected'];
        }
        
        // Require additional verification after failed attempts
        if ($this->requireCaptcha($username, $ip)) {
            return ['status' => 'captcha_required'];
        }
        
        // Strong password hashing with salt
        $passwordHash = password_hash($password, PASSWORD_ARGON2ID);
        
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password_hash'])) {
                // Successful authentication
                $this->clearRateLimits($username, $ip);
                $this->logSuccessfulLogin($username, $ip);
                
                // Check if password needs updating to stronger hash
                if (password_needs_rehash($user['password_hash'], PASSWORD_ARGON2ID)) {
                    $this->updatePasswordHash($username, $passwordHash);
                }
                
                return ['status' => 'success', 'requires_2fa' => $user['requires_2fa']];
            } else {
                // Failed authentication
                $this->incrementFailedAttempts($username, $ip);
                $this->checkForPatterns($username, $ip, $password);
                return ['status' => 'failed'];
            }
        }
        
        // Account not found - still prevent timing attacks
        usleep(rand(50000, 150000));
        return ['status' => 'failed'];
    }
    
    private function isRateLimited($username, $ip) {
        // Advanced rate limiting with different thresholds
        $userAttempts = $this->redis->get("login_attempts_user:$username");
        $ipAttempts = $this->redis->get("login_attempts_ip:$ip");
        $globalAttempts = $this->redis->get("login_attempts_global:$ip");
        
        if ($userAttempts > 3 || $ipAttempts > 10 || $globalAttempts > 50) {
            return true;
        }
        
        return false;
    }
    
    private function detectAnomalies($username, $ip, $userAgent) {
        // Machine learning-based anomaly detection
        // Checks for:
        // - Unusual login patterns
        // - Geographic anomalies
        // - Device fingerprint changes
        // - Known malicious IPs/networks
        
        return false; // Simplified for demonstration
    }
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-success">
                                <h5><i class="fas fa-shield-alt me-2"></i> Protection Measures</h5>
                                <ul class="mb-0">
                                    <li><strong>Multi-Layer Rate Limiting:</strong> Per-user, per-IP, and global rate limits with different thresholds</li>
                                    <li><strong>Strong Password Hashing:</strong> Argon2ID algorithm with salting to prevent rainbow table attacks</li>
                                    <li><strong>CAPTCHA Integration:</strong> Progressive challenges after failed attempts</li>
                                    <li><strong>Anomaly Detection:</strong> ML-based pattern recognition for suspicious behavior</li>
                                    <li><strong>Comprehensive Logging:</strong> Detailed audit trails for security analysis</li>
                                    <li><strong>Two-Factor Authentication:</strong> Additional layer of security for sensitive accounts</li>
                                    <li><strong>Timing Attack Prevention:</strong> Constant-time operations to prevent information leakage</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Mitigation -->
                <section id="mitigation" class="mb-5">
                    <h2>Brute Force Attack Mitigation Strategies</h2>
                    <p>To protect your banking application from brute force attacks, implement these comprehensive security measures:</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-shield-alt me-2"></i>Authentication Security</h4>
                                    <ul class="mb-0">
                                        <li>Implement strong password policies with complexity requirements</li>
                                        <li>Use secure password hashing (Argon2ID, bcrypt)</li>
                                        <li>Enforce account lockout after failed attempts</li>
                                        <li>Implement progressive delays for failed logins</li>
                                        <li>Require password changes after suspicious activity</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-tachometer-alt me-2"></i>Rate Limiting</h4>
                                    <ul class="mb-0">
                                        <li>Implement multi-level rate limiting (user, IP, global)</li>
                                        <li>Use distributed rate limiting for scalability</li>
                                        <li>Apply different thresholds based on risk assessment</li>
                                        <li>Monitor and adjust thresholds based on attack patterns</li>
                                        <li>Implement exponential backoff for repeated failures</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-puzzle-piece me-2"></i>Challenge-Response</h4>
                                    <ul class="mb-0">
                                        <li>Implement CAPTCHA after failed attempts</li>
                                        <li>Use risk-based authentication challenges</li>
                                        <li>Deploy invisible CAPTCHAs for better UX</li>
                                        <li>Integrate behavioral biometrics</li>
                                        <li>Require additional verification for high-risk actions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-user-lock me-2"></i>Multi-Factor Authentication</h4>
                                    <ul class="mb-0">
                                        <li>Implement 2FA for all user accounts</li>
                                        <li>Support multiple MFA methods (SMS, app, hardware keys)</li>
                                        <li>Require MFA for sensitive operations</li>
                                        <li>Implement risk-based MFA triggers</li>
                                        <li>Provide backup authentication methods</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Defense in Depth</h5>
                        <p class="mb-0">Implement multiple layers of protection to effectively mitigate brute force attacks. Combine technical controls with user education and continuous monitoring to maintain a robust security posture.</p>
                    </div>
                </section>
                
                <!-- References -->
                <section id="references">
                    <h2>References and Resources</h2>
                    <p>Learn more about brute force attacks and protection strategies from these authoritative sources:</p>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Official Resources</h5>
                            <ul class="mb-0">
                                <li><a href="https://owasp.org/www-community/attacks/Brute_force_attack" target="_blank">OWASP Brute Force Attack</a></li>
                                <li><a href="https://cheatsheetseries.owasp.org/cheatsheets/Password_Storage_Cheat_Sheet.html" target="_blank">OWASP Password Storage Cheat Sheet</a></li>
                                <li><a href="https://pages.nist.gov/800-63-3/sp800-63b.html" target="_blank">NIST Digital Identity Guidelines (Authentication)</a></li>
                                <li><a href="https://www.ncsc.gov.uk/collection/passwords" target="_blank">NCSC Password Guidance</a></li>
                                <li><a href="https://auth0.com/blog/dont-pass-on-the-new-nist-password-guidelines/" target="_blank">Auth0 NIST Password Guidelines</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Additional Resources</h5>
                            <ul class="mb-0">
                                <li><a href="https://haveibeenpwned.com/" target="_blank">Have I Been Pwned - Check for breached credentials</a></li>
                                <li><a href="https://github.com/danielmiessler/SecLists" target="_blank">SecLists - Password and username wordlists</a></li>
                                <li><a href="https://attack.mitre.org/techniques/T1110/" target="_blank">MITRE ATT&CK - Brute Force Technique</a></li>
                                <li><a href="https://www.sans.org/white-papers/brute-force-attacks/" target="_blank">SANS - Brute Force Attack Prevention</a></li>
                            </ul>
                        </div>
                    </div>
                </section>
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
    <script>
        // Handle script loading errors gracefully
        function handleScriptError(e) {
            console.log('Script loading error:', e);
            return true; // Prevents default error handling
        }
        
        window.onerror = handleScriptError;
        
        // Safe script loading
        function loadScript(src, callback) {
            const script = document.createElement('script');
            script.src = src;
            script.onerror = function(e) {
                console.log('Failed to load:', src);
                if (callback) callback(false);
            };
            script.onload = function() {
                if (callback) callback(true);
            };
            document.head.appendChild(script);
        }
        
        // Load required libraries with error handling
        document.addEventListener('DOMContentLoaded', function() {
            // Only load if not in a highly restrictive sandbox
            try {
                if (typeof $ === 'undefined') {
                    loadScript('https://code.jquery.com/jquery-3.6.0.min.js');
                }
                if (typeof bootstrap === 'undefined') {
                    loadScript('https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js');
                }
                if (typeof Prism === 'undefined') {
                    loadScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js', function() {
                        loadScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-php.min.js');
                        loadScript('https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-javascript.min.js');
                    });
                }
            } catch (e) {
                console.log('Running in restricted environment');
            }
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" onerror="handleScriptError(event)"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" onerror="handleScriptError(event)"></script>
    <!-- Only load if not in sandbox -->
    <script>
    try {
        // Check if we can load external scripts
        const testScript = document.createElement('script');
        testScript.src = '../js/main.js';
        testScript.onerror = () => console.log('Cannot load main.js');
        document.head.appendChild(testScript);
        
        const secScript = document.createElement('script');
        secScript.src = '../js/security-display.js';
        secScript.onerror = () => console.log('Cannot load security-display.js');
        document.head.appendChild(secScript);
    } catch (e) {
        console.log('External script loading restricted');
    }
    </script>
    <!-- Prism.js for code highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js" onerror="handleScriptError(event)"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-php.min.js" onerror="handleScriptError(event)"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-javascript.min.js" onerror="handleScriptError(event)"></script>
    
    <script>
        // Wrap everything in try-catch to prevent unhandled errors
        try {
            // Global variable to store the current security level
            let currentSecurityLevel = 'low';
            let attackInProgress = false;
            let attackInterval;
            let loginAttempts = 0; // In-memory storage for login attempts
            
            // Common password lists for demonstration
            const commonPasswords = [
            "password", "123456", "password123", "12345678", "qwerty", 
            "123456789", "12345", "1234", "111111", "1234567",
            "dragon", "123123", "baseball", "abc123", "football",
            "monkey", "letmein", "shadow", "master", "666666",
            "qwertyuiop", "123321", "mustang", "1234567890", "michael",
            "654321", "superman", "1qaz2wsx", "7777777", "121212",
            "000000", "qazwsx", "123qwe", "killer", "trustno1",
            "jordan", "jennifer", "zxcvbnm", "asdfgh", "hunter",
            "buster", "soccer", "harley", "batman", "andrew",
            "tigger", "sunshine", "iloveyou", "2000", "charlie",
            "robert", "thomas", "hockey", "ranger", "daniel",
            "starwars", "klaster", "112233", "george", "computer",
            "michelle", "jessica", "pepper", "1111", "zxcvbn",
            "555555", "11111111", "131313", "freedom", "777777",
            "pass", "maggie", "159753", "aaaaaa", "ginger",
            "princess", "joshua", "cheese", "amanda", "summer",
            "love", "ashley", "nicole", "chelsea", "biteme",
            "matthew", "access", "yankees", "987654321", "dallas",
            "austin", "thunder", "taylor", "matrix", "mobilemail",
            "mom", "monitor", "monitoring", "montana", "moon",
            "moscow", "google", "firefox", "yahoo", "linkedin"
        ];
        
        // Common email addresses for banking
        const commonEmails = [
            "john@hackmebank.com",
            "jane@hackmebank.com",
            "admin@hackmebank.com",
            "support@hackmebank.com",
            "manager@hackmebank.com",
            "teller@hackmebank.com",
            "customer@hackmebank.com",
            "service@hackmebank.com",
            "info@hackmebank.com",
            "contact@hackmebank.com"
        ];
        
        // Safe localStorage operations
        function getFromStorage(key, defaultValue) {
            try {
                return localStorage.getItem(key) || defaultValue;
            } catch (e) {
                console.log('localStorage not available, using default');
                return defaultValue;
            }
        }
        
        function setToStorage(key, value) {
            try {
                localStorage.setItem(key, value);
            } catch (e) {
                console.log('localStorage not available, using in-memory storage');
                // Could use a global object for storage as fallback
            }
        }
        
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Get the current security level from localStorage or default to 'low'
            currentSecurityLevel = getFromStorage('securityLevel', 'low');
            
            // Setup security level buttons
            const securityBtns = document.querySelectorAll('.security-btn');
            securityBtns.forEach(btn => {
                // Mark the current security level button as active
                if (btn.getAttribute('data-level') === currentSecurityLevel) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
                
                // Add click event to update security level
                btn.addEventListener('click', function() {
                    const level = this.getAttribute('data-level');
                    currentSecurityLevel = level;
                    setToStorage('securityLevel', level);
                    
                    // Update UI
                    securityBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Setup side navigation
            setupSideNav();
            
            // Setup demos
            setupCredentialStuffingDemo();
            setupPasswordSprayingDemo();
            setupDictionaryAttackDemo();
            
            // Initialize password list
            initializePasswordList();
        });
        
        // Handle side navigation
        function setupSideNav() {
            const sideNavLinks = document.querySelectorAll('.side-nav-link');
            
            sideNavLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Remove active class from all links
                    sideNavLinks.forEach(l => l.classList.remove('active'));
                    
                    // Add active class to clicked link
                    this.classList.add('active');
                    
                    // Scroll to the target section
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        }
        
        // Initialize password list display
        function initializePasswordList() {
            const passwordList = document.getElementById('passwordList');
            if (passwordList) {
                // Display some common passwords from the list
                const displayPasswords = commonPasswords.slice(0, 20);
                displayPasswords.forEach(password => {
                    const div = document.createElement('div');
                    div.textContent = password;
                    passwordList.appendChild(div);
                });
            }
        }
        
        // Setup credential stuffing demo
        function setupCredentialStuffingDemo() {
            const form = document.getElementById('credentialStuffingForm');
            const startButton = document.getElementById('startBruteForce');
            const stopButton = document.getElementById('stopBruteForce');
            const progressBar = document.getElementById('attackProgress');
            const logDiv = document.getElementById('credentialStuffingLog');
            
            // Handle single login attempt
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    
                    performLoginAttempt(email, password, logDiv);
                });
            }
            
            // Handle automated brute force attack
            if (startButton && stopButton) {
                startButton.addEventListener('click', function() {
                    startBruteForceAttack('credential', startButton, stopButton, progressBar, logDiv);
                });
                
                stopButton.addEventListener('click', function() {
                    stopBruteForceAttack('credential', startButton, stopButton);
                });
            }
        }
        
        // Setup password spraying demo
        function setupPasswordSprayingDemo() {
            const startButton = document.getElementById('startPasswordSpray');
            const stopButton = document.getElementById('stopPasswordSpray');
            const logDiv = document.getElementById('passwordSprayLog');
            
            if (startButton && stopButton) {
                startButton.addEventListener('click', function() {
                    startPasswordSprayAttack(startButton, stopButton, logDiv);
                });
                
                stopButton.addEventListener('click', function() {
                    stopBruteForceAttack('spray', startButton, stopButton);
                });
            }
        }
        
        // Setup dictionary attack demo
        function setupDictionaryAttackDemo() {
            const startButton = document.getElementById('startDictionaryAttack');
            const stopButton = document.getElementById('stopDictionaryAttack');
            const progressBar = document.getElementById('dictionaryProgress');
            const logDiv = document.getElementById('dictionaryAttackLog');
            
            if (startButton && stopButton) {
                startButton.addEventListener('click', function() {
                    startBruteForceAttack('dictionary', startButton, stopButton, progressBar, logDiv);
                });
                
                stopButton.addEventListener('click', function() {
                    stopBruteForceAttack('dictionary', startButton, stopButton);
                });
            }
        }
        
        // Perform single login attempt
        function performLoginAttempt(email, password, logDiv) {
            let result = '';
            let logClass = '';
            
            switch (currentSecurityLevel) {
                case 'low':
                    // No protection - accept any credentials
                    result = 'Login successful';
                    logClass = 'success';
                    if (password === "admin123") {
                        showBruteDetection();
                    }
                    break;
                    
                case 'medium':
                    // Basic rate limiting using in-memory storage as fallback
                    if (loginAttempts >= 5) {
                        result = 'Account temporarily locked. Try again later.';
                        logClass = 'rate-limited';
                    } else if (password === "admin123") {
                        result = 'Login successful';
                        logClass = 'success';
                        loginAttempts = 0;
                        showBruteDetection();
                    } else {
                        result = 'Invalid credentials';
                        logClass = 'failed';
                        loginAttempts++;
                    }
                    break;
                    
                case 'high':
                    // Strong protection with CAPTCHA
                    result = 'CAPTCHA verification required';
                    logClass = 'blocked';
                    
                    if (Math.random() < 0.1 && password === "admin123") {
                        result = 'Login successful (after verification)';
                        logClass = 'success';
                        showBruteDetection();
                    }
                    break;
            }
            
            addLogEntry(logDiv, email, password, result, logClass);
        }
        
        // Start brute force attack
        function startBruteForceAttack(type, startButton, stopButton, progressBar, logDiv) {
            if (attackInProgress) return;
            
            attackInProgress = true;
            startButton.disabled = true;
            stopButton.disabled = false;
            
            let currentIndex = 0;
            let totalAttempts = 0;
            let successCount = 0;
            
            // Different attack strategies based on type
            attackInterval = setInterval(function() {
                let email, password;
                
                switch (type) {
                    case 'credential':
                        email = commonEmails[currentIndex % commonEmails.length];
                        password = commonPasswords[currentIndex % commonPasswords.length];
                        break;
                        
                    case 'dictionary':
                        email = 'admin';
                        password = commonPasswords[currentIndex % commonPasswords.length];
                        break;
                }
                
                totalAttempts++;
                
                // Perform the attack
                let result = '';
                let logClass = '';
                
                switch (currentSecurityLevel) {
                    case 'low':
                        // No protection
                        if (password === "admin123" || (email === "admin@hackmebank.com" && password === "password")) {
                            result = 'Login successful!';
                            logClass = 'success';
                            successCount++;
                            showBruteDetection();
                        } else {
                            result = 'Invalid credentials';
                            logClass = 'failed';
                        }
                        break;
                        
                    case 'medium':
                        // Basic protection
                        if (totalAttempts > 10) {
                            result = 'Rate limited - please try again later';
                            logClass = 'rate-limited';
                        } else if (password === "admin123") {
                            result = 'Login successful!';
                            logClass = 'success';
                            successCount++;
                            showBruteDetection();
                        } else {
                            result = 'Invalid credentials';
                            logClass = 'failed';
                        }
                        break;
                        
                    case 'high':
                        // Strong protection
                        if (totalAttempts > 3) {
                            result = 'Blocked - suspicious activity detected';
                            logClass = 'blocked';
                            if (totalAttempts > 5) {
                                stopBruteForceAttack(type, startButton, stopButton);
                            }
                        } else {
                            result = 'CAPTCHA challenge required';
                            logClass = 'blocked';
                        }
                        break;
                }
                
                addLogEntry(logDiv, email, password, result, logClass);
                
                // Update progress
                currentIndex++;
                if (progressBar) {
                    const progress = (currentIndex / commonPasswords.length) * 100;
                    progressBar.style.width = progress + '%';
                    progressBar.textContent = Math.round(progress) + '%';
                }
                
                // Stop after all passwords for dictionary attack
                if (type === 'dictionary' && currentIndex >= commonPasswords.length) {
                    stopBruteForceAttack(type, startButton, stopButton);
                }
                
                // Stop after reasonable number of attempts for other types
                if (type !== 'dictionary' && totalAttempts >= 100) {
                    stopBruteForceAttack(type, startButton, stopButton);
                }
            }, 100); // 10 attempts per second
        }
        
        // Start password spraying attack
        function startPasswordSprayAttack(startButton, stopButton, logDiv) {
            if (attackInProgress) return;
            
            attackInProgress = true;
            startButton.disabled = true;
            stopButton.disabled = false;
            
            const sprayPasswords = ["Password123!", "Welcome1!", "Admin123", "Summer2023!", "Company123", "Banking@123"];
            let passwordIndex = 0;
            let emailIndex = 0;
            
            attackInterval = setInterval(function() {
                const email = commonEmails[emailIndex];
                const password = sprayPasswords[passwordIndex];
                
                let result = '';
                let logClass = '';
                
                switch (currentSecurityLevel) {
                    case 'low':
                        if (password === "Admin123" && email === "admin@hackmebank.com") {
                            result = 'Login successful!';
                            logClass = 'success';
                            showBruteDetection();
                        } else {
                            result = 'Invalid credentials';
                            logClass = 'failed';
                        }
                        break;
                        
                    case 'medium':
                        if (passwordIndex > 2) {
                            result = 'Password attempt limit reached for this account';
                            logClass = 'rate-limited';
                        } else if (password === "Admin123" && email === "admin@hackmebank.com") {
                            result = 'Login successful!';
                            logClass = 'success';
                            showBruteDetection();
                        } else {
                            result = 'Invalid credentials';
                            logClass = 'failed';
                        }
                        break;
                        
                    case 'high':
                        result = 'Detected and blocked password spraying attempt';
                        logClass = 'blocked';
                        if (passwordIndex > 1) {
                            stopBruteForceAttack('spray', startButton, stopButton);
                        }
                        break;
                }
                
                addLogEntry(logDiv, email, password, result, logClass);
                
                // Move to next email
                emailIndex++;
                if (emailIndex >= commonEmails.length) {
                    emailIndex = 0;
                    passwordIndex++;
                }
                
                // Stop after all combinations
                if (passwordIndex >= sprayPasswords.length) {
                    stopBruteForceAttack('spray', startButton, stopButton);
                }
            }, 500); // Slower pace for password spraying
        }
        
        // Stop brute force attack
        function stopBruteForceAttack(type, startButton, stopButton) {
            attackInProgress = false;
            clearInterval(attackInterval);
            startButton.disabled = false;
            stopButton.disabled = true;
        }
        
        // Add log entry
        function addLogEntry(logDiv, email, password, result, logClass) {
            const entry = document.createElement('div');
            entry.className = `attack-log-entry ${logClass}`;
            entry.textContent = `${new Date().toLocaleTimeString()} - Email: ${email}, Password: ${password.substr(0, 3)}*** - ${result}`;
            logDiv.insertBefore(entry, logDiv.firstChild);
            
            // Limit log entries
            if (logDiv.children.length > 10) {
                logDiv.removeChild(logDiv.lastChild);
            }
        }
        
        // Show brute force detection alert
        function showBruteDetection() {
            const bruteDetection = document.getElementById('bruteDetection');
            
            if (bruteDetection) {
                bruteDetection.style.display = 'block';
                
                // Hide after 5 seconds
                setTimeout(() => {
                    bruteDetection.style.display = 'none';
                }, 5000);
            }
        }
        } catch (error) {
            console.error('Script error caught:', error);
            // Fallback functionality - provide basic page functionality
            document.addEventListener('DOMContentLoaded', function() {
                document.body.innerHTML += '<div style="position: fixed; bottom: 20px; right: 20px; background: #ffcccc; padding: 10px; border-radius: 5px; border: 1px solid #ff0000;">⚠️ Running in restricted mode</div>';
            });
        }
    </script>
</body>
</html>