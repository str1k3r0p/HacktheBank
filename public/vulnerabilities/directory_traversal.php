<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Traversal - HackMeBank</title>
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
        /* Additional styles specific to the Directory Traversal vulnerability page */
        .traversal-header {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.3) 0%, rgba(240, 0, 204, 0.3) 100%);
            border-radius: 5px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .traversal-header::before {
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

        .traversal-header h1 {
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        }

        .traversal-header p {
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

        .traversal-type-section {
            margin-bottom: 2.5rem;
        }

        .traversal-type-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .traversal-type-title {
            display: flex;
            align-items: center;
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .traversal-type-title i {
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

        .traversal-demo-container {
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .traversal-demo-title {
            font-family: var(--cyber-font-mono);
            font-size: 1.1rem;
            color: var(--cyber-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .traversal-demo-title i {
            margin-right: 0.75rem;
        }

        .demo-result {
            background-color: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1rem;
            min-height: 100px;
            margin-top: 1rem;
            font-family: var(--cyber-font-mono);
            color: var(--cyber-text);
            white-space: pre-wrap;
            overflow-wrap: break-word;
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
            word-break: break-all;
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
        
        /* Success message for Directory Traversal detection */
        .traversal-detection {
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

        .file-explorer {
            background-color: rgba(0, 0, 0, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1rem;
            margin-top: 1rem;
            max-height: 300px;
            overflow-y: auto;
            font-family: var(--cyber-font-mono);
        }

        .file-item {
            display: flex;
            align-items: center;
            padding: 0.25rem 0;
            color: var(--cyber-text);
        }

        .file-icon {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }

        .file-name {
            font-family: var(--cyber-font-mono);
        }

        .file-content {
            background-color: rgba(0, 0, 0, 0.8);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1rem;
            margin-top: 1rem;
            font-family: var(--cyber-font-mono);
            color: #00ff00;
            white-space: pre;
            overflow-x: auto;
            display: none;
        }

        .warning-badge {
            background-color: rgba(255, 221, 0, 0.2);
            color: var(--cyber-warning);
            border: 1px solid var(--cyber-warning);
            padding: 0.25rem 0.5rem;
            border-radius: 3px;
            font-size: 0.75rem;
            margin-left: auto;
        }

        .attack-vector-list {
            list-style: none;
            padding: 0;
        }

        .attack-vector-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            margin-bottom: 0.5rem;
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 3px;
        }

        .attack-vector-icon {
            margin-right: 0.5rem;
            color: var(--cyber-danger);
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
                            <li><a class="dropdown-item" href="bruteforce.php">Brute Force</a></li>
                            <li><a class="dropdown-item active" href="directory_traversal.php">Directory Traversal</a></li>
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

    <!-- Directory Traversal Detection Alert (hidden by default) -->
    <div class="traversal-detection" id="traversalDetection">
        <i class="fas fa-check-circle me-2"></i> Directory Traversal Attack Detected!
        <div class="mt-2 small">The current security level allowed access to restricted files.</div>
    </div>

    <!-- Main content -->
    <main class="container mt-4 mb-5">
        <!-- Directory Traversal Header -->
        <div class="traversal-header">
            <h1><i class="fas fa-folder-open me-3"></i>Directory Traversal</h1>
            <p>Directory Traversal (also known as path traversal) is a web security vulnerability that allows attackers to read arbitrary files on the server that is running an application. This might include application code and data, credentials for back-end systems, and sensitive operating system files. In more severe cases, an attacker might be able to write to arbitrary files on the server, allowing them to modify application data or behavior.</p>
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
                            <a href="#traversal-types" class="side-nav-link">
                                <i class="fas fa-layer-group"></i> Attack Types
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#basic-traversal" class="side-nav-link">
                                <i class="fas fa-route"></i> Basic Traversal
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#encoding-attacks" class="side-nav-link">
                                <i class="fas fa-code"></i> Encoding Bypass
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#absolute-path" class="side-nav-link">
                                <i class="fas fa-atlas"></i> Absolute Path
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#payloads" class="side-nav-link">
                                <i class="fas fa-bomb"></i> Payloads
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
                    <h2>Introduction to Directory Traversal</h2>
                    <p>Directory traversal is a web security vulnerability that allows an attacker to read arbitrary files on the server that is running an application. When an application includes user-supplied input within a file path, without proper validation, an attacker can use special character sequences to traverse the file system and access files outside the intended directory.</p>
                    
                    <p>The attack relies on using path traversal sequences such as "../" (dot dot slash) to move up directories in the file system. In the context of banking applications, this vulnerability can lead to exposure of sensitive financial data, credentials, and configuration files.</p>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Key Impact in Banking Applications:</strong> Directory traversal vulnerabilities can expose sensitive customer data, database credentials, source code, and private encryption keys. Attackers could also potentially modify critical configuration files, leading to service disruption or data corruption.
                    </div>
                    
                    <h4 class="mb-3 mt-4">How Directory Traversal Works</h4>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Attack Flow</h5>
                            <ol>
                                <li>Attacker identifies input that's used to construct file paths</li>
                                <li>Injects path traversal sequences (like ../../../etc/passwd)</li>
                                <li>The application constructs a path: /app/files/../../etc/passwd</li>
                                <li>The operating system resolves this to: /etc/passwd</li>
                                <li>Sensitive file contents are revealed to the attacker</li>
                            </ol>
                        </div>
                    </div>
                </section>
                
                <!-- Directory Traversal Types -->
                <section id="traversal-types" class="mb-5">
                    <h2>Types of Directory Traversal Attacks</h2>
                    <p>Directory traversal attacks can be categorized into several types based on the technique used to bypass security controls:</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="traversal-type-icon"><i class="fas fa-route"></i></div>
                                    <h3 class="card-title">Basic Traversal</h3>
                                    <p class="card-text">Uses simple "../" sequences to navigate up directories in the file system structure.</p>
                                    <a href="#basic-traversal" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="traversal-type-icon"><i class="fas fa-code"></i></div>
                                    <h3 class="card-title">Encoding Bypass</h3>
                                    <p class="card-text">Uses URL encoding, double encoding, or Unicode encoding to bypass simple filters.</p>
                                    <a href="#encoding-attacks" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="traversal-type-icon"><i class="fas fa-atlas"></i></div>
                                    <h3 class="card-title">Absolute Path</h3>
                                    <p class="card-text">Directly specifies the absolute path to the target file, bypassing path restrictions.</p>
                                    <a href="#absolute-path" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Basic Traversal -->
                <section id="basic-traversal" class="traversal-type-section">
                    <h2 class="traversal-type-title"><i class="fas fa-route"></i> Basic Directory Traversal</h2>
                    
                    <p>Basic directory traversal attacks use the "../" sequence to navigate up directories in the file system. Each ".." moves one directory higher, allowing attackers to escape the intended directory and access files elsewhere on the system.</p>
                    
                    <h4 class="mb-3">How Basic Traversal Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                                    <h5>Common Target Files</h5>
                                    <div class="nav nav-tabs mb-3" role="tablist">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#linux-targets" type="button">Linux</button>
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#windows-targets" type="button">Windows</button>
                                    </div>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="linux-targets">
                                            <ul class="attack-vector-list">
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-file attack-vector-icon"></i>
                                                    /etc/passwd - Linux user accounts
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-key attack-vector-icon"></i>
                                                    /etc/shadow - Encrypted passwords
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-folder attack-vector-icon"></i>
                                                    /etc/hosts - Network configuration
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-database attack-vector-icon"></i>
                                                    /var/log/apache2/access.log - Web logs
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-code attack-vector-icon"></i>
                                                    /var/www/html/.htaccess - Web config
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="windows-targets">
                                            <ul class="attack-vector-list">
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-file attack-vector-icon"></i>
                                                    C:\Windows\win.ini - Windows configuration
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-key attack-vector-icon"></i>
                                                    C:\Windows\system32\config\SAM - User passwords
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-folder attack-vector-icon"></i>
                                                    C:\Windows\system32\drivers\etc\hosts - Network config
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-database attack-vector-icon"></i>
                                                    C:\inetpub\logs\LogFiles - IIS logs
                                                </li>
                                                <li class="attack-vector-item">
                                                    <i class="fas fa-code attack-vector-icon"></i>
                                                    C:\inetpub\wwwroot\web.config - IIS config
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Path Resolution Example</h5>
                                    <pre class="mb-0">
Original Path: /app/files/
Attack Input:  ../../etc/passwd
Full Path:     /app/files/../../etc/passwd
Resolved Path: /etc/passwd

The OS resolves path traversal before checking path</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>file_viewer.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - user input directly used in file path
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    
    // Intended to only access files in 'documents' directory
    $filepath = "documents/" . $filename;
    
    // No path validation - vulnerable to directory traversal
    if (file_exists($filepath)) {
        echo "&lt;h3>File contents:&lt;/h3>";
        echo "&lt;pre>" . htmlspecialchars(file_get_contents($filepath)) . "&lt;/pre>";
    } else {
        echo "File not found.";
    }
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Basic Traversal Demo -->
                    <div class="traversal-demo-container">
                        <h4 class="traversal-demo-title"><i class="fas fa-flask"></i> Basic Directory Traversal Demonstration</h4>
                        <p>This file viewer is vulnerable to directory traversal. Try accessing files outside the intended directory.</p>
                        
                        <form id="basicTraversalForm" class="mb-3">
                            <div class="mb-3">
                                <label for="filename" class="form-label">File to view (relative to documents/ directory)</label>
                                <input type="text" class="form-control" id="filename" name="filename" value="report.pdf" placeholder="e.g., ../../../etc/passwd or ..\..\..\Windows\win.ini">
                            </div>
                            <button type="submit" class="btn btn-primary">View File</button>
                        </form>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Available Documents</h6>
                                <div class="file-explorer">
                                    <div class="file-item">
                                        <i class="fas fa-file-pdf file-icon"></i>
                                        <span class="file-name">report.pdf</span>
                                    </div>
                                    <div class="file-item">
                                        <i class="fas fa-file-word file-icon"></i>
                                        <span class="file-name">proposal.docx</span>
                                    </div>
                                    <div class="file-item">
                                        <i class="fas fa-file-excel file-icon"></i>
                                        <span class="file-name">spreadsheet.xlsx</span>
                                    </div>
                                    <div class="file-item">
                                        <i class="fas fa-file-image file-icon"></i>
                                        <span class="file-name">logo.png</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6>System Information</h6>
                                <div class="file-explorer">
                                    <h7 class="text-muted">Linux Targets</h7>
                                    <div class="file-item">
                                        <i class="fas fa-exclamation-triangle file-icon" style="color: var(--cyber-danger)"></i>
                                        <span class="file-name">../../etc/passwd</span>
                                        <span class="warning-badge">Restricted</span>
                                    </div>
                                    <div class="file-item">
                                        <i class="fas fa-lock file-icon" style="color: var(--cyber-danger)"></i>
                                        <span class="file-name">../../etc/shadow</span>
                                        <span class="warning-badge">Restricted</span>
                                    </div>
                                    <h7 class="text-muted">Windows Targets</h7>
                                    <div class="file-item">
                                        <i class="fas fa-windows file-icon" style="color: var(--cyber-danger)"></i>
                                        <span class="file-name">..\..\..\Windows\win.ini</span>
                                        <span class="warning-badge">Restricted</span>
                                    </div>
                                    <div class="file-item">
                                        <i class="fas fa-key file-icon" style="color: var(--cyber-danger)"></i>
                                        <span class="file-name">..\..\..\Windows\system32\config\SAM</span>
                                        <span class="warning-badge">Restricted</span>
                                    </div>
                                    <div class="file-item">
                                        <i class="fas fa-key file-icon" style="color: var(--cyber-warning)"></i>
                                        <span class="file-name">../config.php</span>
                                        <span class="warning-badge">Sensitive</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="demo-result" id="basicTraversalResult">
                            <!-- File contents will appear here -->
                            <div class="text-center text-muted">Enter a filename to view its contents</div>
                        </div>
                    </div>
                </section>
                
                <!-- Encoding Attacks -->
                <section id="encoding-attacks" class="traversal-type-section">
                    <h2 class="traversal-type-title"><i class="fas fa-code"></i> Encoding Bypass Techniques</h2>
                    
                    <p>When basic path traversal is blocked, attackers use various encoding techniques to bypass filters. This includes URL encoding, double encoding, Unicode encoding, and other obfuscation methods to hide traversal patterns from security controls.</p>
                    
                    <h4 class="mb-3">Common Encoding Techniques</h4>
                    
                    <div class="table-responsive mb-4">
                        <table class="table table-cyberpunk">
                                                            <thead>
                                <tr>
                                    <th>Encoding Type</th>
                                    <th>Linux</th>
                                    <th>Windows</th>
                                    <th>Encoded</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Standard</td>
                                    <td>../</td>
                                    <td>..\</td>
                                    <td>../, ..\ </td>
                                    <td>Normal path traversal</td>
                                </tr>
                                <tr>
                                    <td>URL Encoding</td>
                                    <td>../</td>
                                    <td>..\</td>
                                    <td>%2e%2e%2f, %2e%2e%5c</td>
                                    <td>Encode dots and slashes</td>
                                </tr>
                                <tr>
                                    <td>Double URL Encoding</td>
                                    <td>../</td>
                                    <td>..\</td>
                                    <td>%252e%252e%252f, %252e%252e%255c</td>
                                    <td>Encode then encode again</td>
                                </tr>
                                <tr>
                                    <td>16-bit Unicode</td>
                                    <td>../</td>
                                    <td>..\</td>
                                    <td>%u002e%u002e%u002f, %u002e%u002e%u005c</td>
                                    <td>Unicode representation</td>
                                </tr>
                                <tr>
                                    <td>Overlong Encoding</td>
                                    <td>../</td>
                                    <td>..\</td>
                                    <td>..%c0%af, ..%c0%5c</td>
                                    <td>UTF-8 overlong slash</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code with Basic Filter</span>
                            <span>file_download.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - basic filter that can be bypassed
if (isset($_GET['file'])) {
    $filename = $_GET['file'];
    
    // Basic attempt to prevent directory traversal
    if (strpos($filename, '..') !== false) {
        die("Access denied");
    }
    
    $filepath = "/var/www/downloads/" . $filename;
    
    if (file_exists($filepath)) {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        readfile($filepath);
    } else {
        echo "File not found.";
    }
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Encoding Bypass Demo -->
                    <div class="traversal-demo-container">
                        <h4 class="traversal-demo-title"><i class="fas fa-flask"></i> Encoding Bypass Demonstration</h4>
                        <p>This file download system blocks simple ".." sequences. Try using encoded paths to bypass the filter.</p>
                        
                        <form id="encodingBypassForm" class="mb-3">
                            <div class="mb-3">
                                <label for="encodedFilename" class="form-label">File to download (enter path or encoded path)</label>
                                <input type="text" class="form-control" id="encodedFilename" name="encodedFilename" value="document.pdf" placeholder="Try encoding ../../../etc/passwd">
                            </div>
                            <button type="submit" class="btn btn-primary">Download File</button>
                        </form>
                        
                        <div class="mb-3">
                            <h6>Bypass Techniques to Try:</h6>
                            <ul class="list-unstyled">
                                <li><strong>URL Encoded:</strong> %2e%2e%2f%2e%2e%2f%2e%2e%2fetc%2fpasswd</li>
                                <li><strong>Double Encoded:</strong> %252e%252e%252f%252e%252e%252f%252e%252e%252fetc%252fpasswd</li>
                                <li><strong>Null Byte (legacy):</strong> ../../etc/passwd%00</li>
                                <li><strong>Alternative Slash:</strong> ..%2f..%2f..%2fetc%2fpasswd</li>
                            </ul>
                        </div>
                        
                        <div class="demo-result" id="encodingBypassResult">
                            <!-- Results will appear here -->
                            <div class="text-center text-muted">Enter a filename to attempt download</div>
                        </div>
                    </div>
                </section>
                
                <!-- Absolute Path -->
                <section id="absolute-path" class="traversal-type-section">
                    <h2 class="traversal-type-title"><i class="fas fa-atlas"></i> Absolute Path Traversal</h2>
                    
                    <p>Absolute path traversal occurs when an application directly processes absolute file paths without proper validation. Instead of using relative paths with "../" sequences, attackers specify the complete path to the target file.</p>
                    
                    <h4 class="mb-3">How Absolute Path Attacks Work</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Typical Attack Patterns</h5>
                            <div class="nav nav-tabs mb-3" role="tablist">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#linux-paths" type="button">Linux</button>
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#windows-paths" type="button">Windows</button>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="linux-paths">
                                    <ul>
                                        <li>Direct path specification: /etc/passwd</li>
                                        <li>Root-based paths: /root/.bash_history</li>
                                        <li>Application paths: /var/www/html/.git/config</li>
                                        <li>Log paths: /var/log/apache2/access.log</li>
                                        <li>Config paths: /etc/mysql/debian.cnf</li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="windows-paths">
                                    <ul>
                                        <li>Windows paths: C:\Windows\system32\config\SAM</li>
                                        <li>Drive paths: D:\backups\database.sql</li>
                                        <li>Network paths: \\server\share\file</li>
                                        <li>User paths: C:\Users\Administrator\Desktop\sensitive.doc</li>
                                        <li>IIS paths: C:\inetpub\wwwroot\web.config</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Example Attack</h5>
                                    <pre>
Normal Request (Linux):
GET /download?file=report.pdf

Attack Request (Linux):
GET /download?file=/etc/passwd

Normal Request (Windows):
GET /download?file=report.pdf

Attack Request (Windows):
GET /download?file=C:\Windows\win.ini

Result: Full access to system files</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>absolute_path.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - accepts absolute paths
if (isset($_GET['filepath'])) {
    $filepath = $_GET['filepath'];
    
    // Vulnerable: Directly uses user input as file path
    if (file_exists($filepath)) {
        // Read and display file contents
        echo "&lt;pre>" . htmlspecialchars(file_get_contents($filepath)) . "&lt;/pre>";
    } else {
        echo "File not found: " . htmlspecialchars($filepath);
    }
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Absolute Path Demo -->
                    <div class="traversal-demo-container">
                        <h4 class="traversal-demo-title"><i class="fas fa-flask"></i> Absolute Path Traversal Demonstration</h4>
                        <p>This application accepts file paths directly. Try accessing system files using absolute paths.</p>
                        
                        <form id="absolutePathForm" class="mb-3">
                            <div class="mb-3">
                                <label for="filepath" class="form-label">File path to access</label>
                                <input type="text" class="form-control" id="filepath" name="filepath" value="/var/www/html/index.php" placeholder="Enter file path">
                            </div>
                            <button type="submit" class="btn btn-primary">Access File</button>
                        </form>
                        
                        <div class="mb-3">
                            <h6>Common Target Paths:</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>/etc/passwd</li>
                                        <li>/etc/shadow</li>
                                        <li>/etc/mysql/debian.cnf</li>
                                        <li>/root/.bash_history</li>
                                        <li>/home/user/.ssh/id_rsa</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled">
                                        <li>/var/www/html/.git/config</li>
                                        <li>/proc/self/environ</li>
                                        <li>/etc/apache2/apache2.conf</li>
                                        <li>/var/log/auth.log</li>
                                        <li>/etc/resolv.conf</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="demo-result" id="absolutePathResult">
                            <!-- Results will appear here -->
                            <div class="text-center text-muted">Enter a file path to access</div>
                        </div>
                    </div>
                </section>
                
                <!-- Payloads -->
                <section id="payloads" class="mb-5">
                    <h2>Directory Traversal Payloads for Different Security Levels</h2>
                    <p>Different security levels require different payloads to bypass protections. Here are some examples of payloads for each level:</p>
                    
                    <!-- Security Levels & Payloads Tabs -->
                    <ul class="nav nav-tabs" id="securityTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="low-tab" data-bs-toggle="tab" data-bs-target="#low" type="button" role="tab">Low Security</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="medium-tab" data-bs-toggle="tab" data-bs-target="#medium" type="button" role="tab">Medium Security</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="high-tab" data-bs-toggle="tab" data-bs-target="#high" type="button" role="tab">High Security</button>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="securityTabsContent">
                        <!-- Low Security Payloads -->
                        <div class="tab-pane fade show active" id="low" role="tabpanel">
                            <div class="security-badge-large low mb-3">
                                <i class="fas fa-shield-alt"></i> Low Security Level
                            </div>
                            <p>At low security level, there is minimal or no input validation, making basic directory traversal payloads effective:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Basic Path Traversal</h5>
                                    <div class="payload-code">../../etc/passwd</div>
                                    <p class="payload-description">The most basic directory traversal payload that moves up directories to access system files.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="basic" data-payload="../../etc/passwd">Try in Basic Demo</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="absolute" data-payload="/etc/passwd">Try Absolute Path</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Extra Path Segments</h5>
                                    <div class="payload-code">../../../../../../../../etc/passwd</div>
                                    <p class="payload-description">Uses excessive ".." to ensure reaching the root directory regardless of current location.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="basic" data-payload="../../../../../../../../etc/passwd">Try in Basic Demo</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Configuration Files</h5>
                                    <div class="payload-code">../../config.php</div>
                                    <p class="payload-description">Targets application configuration files that often contain database credentials.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="basic" data-payload="../../config.php">Try in Basic Demo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Medium Security Payloads -->
                        <div class="tab-pane fade" id="medium" role="tabpanel">
                            <div class="security-badge-large medium mb-3">
                                <i class="fas fa-shield-alt"></i> Medium Security Level
                            </div>
                            <p>Medium security typically includes basic filters that block simple payloads but can be bypassed with encoding techniques:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>URL Encoded Traversal</h5>
                                    <div class="payload-code">%2e%2e%2f%2e%2e%2f%2e%2e%2fetc%2fpasswd</div>
                                    <p class="payload-description">URL encodes dots and slashes to bypass filters that check for literal "../" sequences.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="encoding" data-payload="%2e%2e%2f%2e%2e%2f%2e%2e%2fetc%2fpasswd">Try Encoded</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Double Encoding</h5>
                                    <div class="payload-code">%252e%252e%252f%252e%252e%252f%252e%252e%252fetc%252fpasswd</div>
                                    <p class="payload-description">Double URL encoding can bypass filters that decode input only once.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="encoding" data-payload="%252e%252e%252f%252e%252e%252f%252e%252e%252fetc%252fpasswd">Try Double Encoded</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Nested Encoding</h5>
                                    <div class="payload-code">..%c0%af..%c0%af..%c0%afetc%c0%afpasswd</div>
                                    <p class="payload-description">Uses UTF-8 overlong encoding for the slash character to bypass string matching.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="encoding" data-payload="..%c0%af..%c0%af..%c0%afetc%c0%afpasswd">Try Nested Encoding</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- High Security Payloads -->
                        <div class="tab-pane fade" id="high" role="tabpanel">
                            <div class="security-badge-large high mb-3">
                                <i class="fas fa-shield-alt"></i> High Security Level
                            </div>
                            <p>High security implementations use robust filtering and path validation. Bypassing requires advanced techniques:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Null Byte Injection (Legacy)</h5>
                                    <div class="payload-code">../../../../etc/passwd%00.jpg</div>
                                    <p class="payload-description">Historically, null bytes terminated strings in some languages, bypassing extension checks.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="basic" data-payload="../../../../etc/passwd%00.jpg">Try Null Byte</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Unicode Bypass</h5>
                                    <div class="payload-code">..%u002e%u002e%u002f..%u002e%u002e%u002fetc%u002fpasswd</div>
                                    <p class="payload-description">Uses Unicode encoding (16-bit) to bypass filters that check for standard ASCII patterns.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="encoding" data-payload="..%u002e%u002e%u002f..%u002e%u002e%u002fetc%u002fpasswd">Try Unicode</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Complex Path Manipulation</h5>
                                    <div class="payload-code">files/../../../../../../etc/passwd</div>
                                    <p class="payload-description">Starts with an allowed path to bypass initial checks, then traverses to restricted areas.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="basic" data-payload="files/../../../../../../etc/passwd">Try Complex Path</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Security Levels -->
                <section id="security-levels" class="mb-5">
                    <h2>Security Levels Implementation</h2>
                    <p>This section shows how different security levels protect against directory traversal attacks:</p>
                    
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
                                <p>At this level, there is no protection against directory traversal, making systems highly vulnerable:</p>
                                
                                <div class="code-block-header">
                                    <span>Low Security Code</span>
                                    <span>DirectoryTraversal.php - Low</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// LOW security - No directory traversal protection
function readFile($filename) {
    // User input directly used in file path
    $filepath = "documents/" . $filename;
    
    // No validation or sanitization
    if (file_exists($filepath)) {
        return file_get_contents($filepath);
    }
    
    return "File not found";
}

// Download handler
function downloadFile($filename) {
    global $basePath;
    
    // Direct concatenation with user input
    $filepath = $basePath . $filename;
    
    // No path validation before accessing file
    if (file_exists($filepath)) {
        readfile($filepath);
    }
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-danger">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">Complete absence of input validation allows unrestricted access to any file on the system. Attackers can easily read sensitive files like /etc/passwd, application source code, and database credentials.</p>
                            </div>
                        </div>
                        
                        <!-- Medium Security Implementation -->
                        <div class="tab-pane fade" id="sec-medium" role="tabpanel">
                            <div class="mb-4">
                                <h4>Medium Security Implementation</h4>
                                <p>At this level, basic filtering is applied but can be bypassed with encoding techniques:</p>
                                
                                <div class="code-block-header">
                                    <span>Medium Security Code</span>
                                    <span>DirectoryTraversal.php - Medium</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// MEDIUM security - Basic directory traversal protection
function readFile($filename) {
    // Basic filter to remove obvious traversal patterns
    $safe_filename = str_replace("../", "", $filename);
    $safe_filename = str_replace("..\\", "", $safe_filename);
    
    $filepath = "documents/" . $safe_filename;
    
    if (file_exists($filepath)) {
        return file_get_contents($filepath);
    }
    
    return "File not found";
}

// Download handler with path checking
function downloadFile($filename) {
    global $basePath;
    
    // Remove obvious traversal patterns
    $safe_filename = preg_replace('/\.\.\//', '', $filename);
    
    $filepath = $basePath . $safe_filename;
    
    // Basic realpath check (can be bypassed)
    if (strpos($filepath, $basePath) === 0 && file_exists($filepath)) {
        readfile($filepath);
    } else {
        http_response_code(403);
        die("Access denied");
    }
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">Simple string replacement can be bypassed by encoding techniques, nested patterns (....//), and different encoding formats. The path checking logic is insufficient to prevent all traversal attacks.</p>
                            </div>
                        </div>
                        
                        <!-- High Security Implementation -->
                        <div class="tab-pane fade" id="sec-high" role="tabpanel">
                            <div class="mb-4">
                                <h4>High Security Implementation</h4>
                                <p>At this level, comprehensive protection mechanisms are implemented to prevent directory traversal:</p>
                                
                                <div class="code-block-header">
                                    <span>High Security Code</span>
                                    <span>DirectoryTraversal.php - High</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// HIGH security - Comprehensive directory traversal protection
class SecureFileSystem {
    private $baseDir;
    private $allowedExtensions = ['pdf', 'docx', 'xlsx', 'png', 'jpg'];
    
    public function __construct($baseDir) {
        // Ensure base directory is properly resolved
        $this->baseDir = realpath($baseDir);
        if (!$this->baseDir) {
            throw new Exception("Invalid base directory");
        }
    }
    
    public function readFile($filename) {
        // Multiple layers of validation
        if (!$this->isValidFilename($filename)) {
            return "Invalid filename";
        }
        
        // Construct full path
        $filepath = $this->baseDir . DIRECTORY_SEPARATOR . $filename;
        
        // Get real path to resolve all symbolic links and traversals
        $realPath = realpath($filepath);
        
        // Ensure the resolved path is within the base directory
        if (!$realPath || strpos($realPath, $this->baseDir) !== 0) {
            return "Access denied: Outside base directory";
        }
        
        // Verify file exists and is readable
        if (!file_exists($realPath) || !is_readable($realPath)) {
            return "File not found or not readable";
        }
        
        // Check file extension
        if (!$this->hasAllowedExtension($realPath)) {
            return "Invalid file type";
        }
        
        return file_get_contents($realPath);
    }
    
    private function isValidFilename($filename) {
        // Reject if contains null bytes
        if (strpos($filename, "\0") !== false) {
            return false;
        }
        
        // Check for path traversal patterns
        if (preg_match('/\.\.(\/|\\\\)/', $filename)) {
            return false;
        }
        
        // Check for absolute paths
        if (preg_match('/^([a-zA-Z]:)?\//', $filename)) {
            return false;
        }
        
        // Check for encoded sequences
        if (preg_match('/%2e|%2f|%5c/i', $filename)) {
            return false;
        }
        
        return true;
    }
    
    private function hasAllowedExtension($filepath) {
        $extension = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
        return in_array($extension, $this->allowedExtensions);
    }
    
    public function downloadFile($filename, $mimeType = null) {
        $content = $this->readFile($filename);
        
        if (is_string($content) && strpos($content, "Access denied") === false) {
            // Set secure headers
            header('Content-Type: ' . ($mimeType ?? 'application/octet-stream'));
            header('Content-Disposition: attachment; filename="'.basename($filename).'"');
            header('Content-Security-Policy: default-src \'none\';');
            header('X-Content-Type-Options: nosniff');
            
            echo $content;
        } else {
            http_response_code(403);
            die("Access denied");
        }
    }
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-success">
                                <h5><i class="fas fa-shield-alt me-2"></i> Protection Measures</h5>
                                <ul class="mb-0">
                                    <li><strong>Real Path Resolution:</strong> Uses realpath() to resolve all symbolic links and path traversals</li>
                                    <li><strong>Base Directory Enforcement:</strong> Ensures final path is within the allowed base directory</li>
                                    <li><strong>Null Byte Protection:</strong> Checks for null byte characters to prevent legacy exploits</li>
                                    <li><strong>Path Pattern Validation:</strong> Multiple regex checks for traversal patterns and encoded sequences</li>
                                    <li><strong>Extension Whitelisting:</strong> Only allows specific, safe file extensions</li>
                                    <li><strong>Secure Headers:</strong> Implements security headers to prevent content-based attacks</li>
                                    <li><strong>Input Sanitization:</strong> Multiple layers of input validation and sanitization</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Mitigation -->
                <section id="mitigation" class="mb-5">
                    <h2>Directory Traversal Mitigation Strategies</h2>
                    <p>To protect your applications from directory traversal vulnerabilities, implement these comprehensive security measures:</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-shield-alt me-2"></i>Input Validation</h4>
                                    <ul class="mb-0">
                                        <li>Validate all file paths against a strict whitelist</li>
                                        <li>Reject paths containing "../" or ".." patterns</li>
                                        <li>Check for null byte characters</li>
                                        <li>Validate file extensions against allowed types</li>
                                        <li>Decode and re-encode input to catch encoding attacks</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-folder-lock me-2"></i>Path Resolution</h4>
                                    <ul class="mb-0">
                                        <li>Use realpath() to resolve symbolic links and traversals</li>
                                        <li>Enforce base directory restrictions strictly</li>
                                        <li>Avoid concatenating user input directly with paths</li>
                                        <li>Use secure path joining functions</li>
                                        <li>Check resolved paths are within allowed directories</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-user-shield me-2"></i>Principle of Least Privilege</h4>
                                    <ul class="mb-0">
                                        <li>Run applications with minimal file system permissions</li>
                                        <li>Use chroot or containerization when possible</li>
                                        <li>Restrict read access to sensitive directories</li>
                                        <li>Implement file system access controls</li>
                                        <li>Use separate accounts for different operations</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-code me-2"></i>Secure Coding Practices</h4>
                                    <ul class="mb-0">
                                        <li>Use content delivery systems instead of direct file access</li>
                                        <li>Implement file upload with secure storage mechanisms</li>
                                        <li>Store files with randomized filenames</li>
                                        <li>Use database storage for sensitive files</li>
                                        <li>Implement secure download handlers with token authentication</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Defense in Depth</h5>
                        <p class="mb-0">Never rely on a single defense mechanism. Implement multiple layers of protection to effectively mitigate directory traversal vulnerabilities. Regular security audits and code reviews are essential to maintain protection against evolving attack techniques.</p>
                    </div>
                </section>
                
                <!-- References -->
                <section id="references">
                    <h2>References and Resources</h2>
                    <p>Learn more about directory traversal from these authoritative sources:</p>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Official Resources</h5>
                            <ul class="mb-0">
                                <li><a href="https://owasp.org/www-community/attacks/Path_Traversal" target="_blank">OWASP Path Traversal</a></li>
                                <li><a href="https://cwe.mitre.org/data/definitions/22.html" target="_blank">CWE-22: Path Traversal</a></li>
                                <li><a href="https://portswigger.net/web-security/file-path-traversal" target="_blank">PortSwigger Web Security Academy - Directory Traversal</a></li>
                                <li><a href="https://cheatsheetseries.owasp.org/cheatsheets/Input_Validation_Cheat_Sheet.html" target="_blank">OWASP Input Validation Cheat Sheet</a></li>
                                <li><a href="https://owasp.org/www-community/attacks/Relative_Path_Traversal" target="_blank">OWASP Relative Path Traversal</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Practice Platforms</h5>
                            <ul class="mb-0">
                                <li><a href="https://www.hacksplaining.com/exercises/directory-traversal" target="_blank">Hacksplaining - Directory Traversal Lessons</a></li>
                                <li><a href="https://github.com/OWASP/DVWA" target="_blank">DVWA - Damn Vulnerable Web Application</a></li>
                                <li><a href="https://portswigger.net/web-security/all-labs#directory-traversal" target="_blank">PortSwigger Web Security Labs - Directory Traversal</a></li>
                                <li><a href="https://owasp.org/www-project-juice-shop/" target="_blank">OWASP Juice Shop</a></li>
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
                
                // Setup Directory Traversal demos
                setupBasicTraversalDemo();
                setupEncodingBypassDemo();
                setupAbsolutePathDemo();
                
                // Setup payload buttons
                setupPayloadButtons();
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
            
            // Setup basic traversal demo
            function setupBasicTraversalDemo() {
                const form = document.getElementById('basicTraversalForm');
                const resultDiv = document.getElementById('basicTraversalResult');
                
                if (form && resultDiv) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const filename = document.getElementById('filename').value;
                        let response = '';
                        let traversalDetected = false;
                        
                        // Apply different security based on current level
                        switch (currentSecurityLevel) {
                            case 'low':
                                // No protection - allow all file access
                                response = simulateFileAccess(filename);
                                if (filename.includes('..') || filename.startsWith('/')) {
                                    traversalDetected = true;
                                }
                                break;
                                
                            case 'medium':
                                // Basic filtering - remove simple traversal
                                const basicFiltered = filename.replace(/\.\.\//g, '').replace(/\.\.\\/g, '');
                                if (filename !== basicFiltered) {
                                    response = `Filtered: "${basicFiltered}"\n\n` + simulateFileAccess(basicFiltered);
                                } else {
                                    response = simulateFileAccess(filename);
                                }
                                
                                // Check if bypass was successful
                                if (filename.includes('%2e') || filename.includes('%252e')) {
                                    traversalDetected = true;
                                }
                                break;
                                
                            case 'high':
                                // Strong protection - comprehensive validation
                                if (isValidPath(filename) && !containsTraversal(filename)) {
                                    response = simulateFileAccess(filename);
                                } else {
                                    response = `Error: Access denied. Invalid file path.`;
                                }
                                break;
                        }
                        
                        // Display the results
                        resultDiv.innerHTML = response;
                        
                        // Show detection alert if applicable
                        if (traversalDetected) {
                            showTraversalDetection();
                        }
                    });
                }
            }
            
            // Setup encoding bypass demo
            function setupEncodingBypassDemo() {
                const form = document.getElementById('encodingBypassForm');
                const resultDiv = document.getElementById('encodingBypassResult');
                
                if (form && resultDiv) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const filename = document.getElementById('encodedFilename').value;
                        let response = '';
                        let traversalDetected = false;
                        
                        // Apply different security based on current level
                        switch (currentSecurityLevel) {
                            case 'low':
                                // No protection - allow all downloads
                                response = `Downloading: ${filename}\n\n` + simulateFileAccess(filename);
                                if (filename.includes('..') || filename.includes('%2e')) {
                                    traversalDetected = true;
                                }
                                break;
                                
                            case 'medium':
                                // Basic check - block simple traversal
                                if (filename.includes('..')) {
                                    response = `Error: Directory traversal detected in "${filename}"`;
                                } else {
                                    response = `Downloading: ${filename}\n\n` + simulateFileAccess(filename);
                                    // Check if encoding was used to bypass
                                    if (filename.includes('%2e') || filename.includes('%252e')) {
                                        traversalDetected = true;
                                    }
                                }
                                break;
                                
                            case 'high':
                                // Strong protection - check for all encoding variations
                                if (containsAnyTraversal(filename)) {
                                    response = `Error: Access denied. Potential directory traversal detected.`;
                                } else {
                                    response = `Downloading: ${filename}\n\n` + simulateFileAccess(filename);
                                }
                                break;
                        }
                        
                        // Display the results
                        resultDiv.innerHTML = response;
                        
                        // Show detection alert if applicable
                        if (traversalDetected) {
                            showTraversalDetection();
                        }
                    });
                }
            }
            
            // Setup absolute path demo
            function setupAbsolutePathDemo() {
                const form = document.getElementById('absolutePathForm');
                const resultDiv = document.getElementById('absolutePathResult');
                
                if (form && resultDiv) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const filepath = document.getElementById('filepath').value;
                        let response = '';
                        let traversalDetected = false;
                        
                        // Apply different security based on current level
                        switch (currentSecurityLevel) {
                            case 'low':
                                // No protection - allow absolute path access
                                response = simulateFileAccess(filepath);
                                if (filepath.startsWith('/')) {
                                    traversalDetected = true;
                                }
                                break;
                                
                            case 'medium':
                                // Basic protection - block absolute paths
                                if (filepath.startsWith('/') || filepath.match(/^[a-zA-Z]:/)) {
                                    response = `Error: Absolute paths not allowed.`;
                                } else {
                                    response = simulateFileAccess(filepath);
                                }
                                break;
                                
                            case 'high':
                                // Strong protection - whitelist only specific files
                                const allowedFiles = [
                                    '/var/www/html/index.php',
                                    '/var/www/html/about.php',
                                    '/var/www/html/contact.php'
                                ];
                                
                                if (allowedFiles.includes(filepath)) {
                                    response = simulateFileAccess(filepath);
                                } else {
                                    response = `Error: Access denied. File not in whitelist.`;
                                }
                                break;
                        }
                        
                        // Display the results
                        resultDiv.innerHTML = response;
                        
                        // Show detection alert if applicable
                        if (traversalDetected) {
                            showTraversalDetection();
                        }
                    });
                }
            }
            
            // Setup payload buttons
            function setupPayloadButtons() {
                const payloadButtons = document.querySelectorAll('.try-payload');
                
                payloadButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const target = this.getAttribute('data-target');
                        const payload = this.getAttribute('data-payload');
                        
                        if (target === 'basic') {
                            document.getElementById('filename').value = payload;
                            document.getElementById('basicTraversalForm').dispatchEvent(new Event('submit'));
                        } else if (target === 'encoding') {
                            document.getElementById('encodedFilename').value = payload;
                            document.getElementById('encodingBypassForm').dispatchEvent(new Event('submit'));
                        } else if (target === 'absolute') {
                            document.getElementById('filepath').value = payload;
                            document.getElementById('absolutePathForm').dispatchEvent(new Event('submit'));
                        }
                    });
                });
            }
            
            // Simulate file access
            function simulateFileAccess(path) {
                // Normalize path to handle both forward and backward slashes
                const normalizedPath = path.replace(/[\\]/g, '/').toLowerCase();
                
                // Check for specific file content
                if (normalizedPath.includes('passwd')) {
                    return `Content of /etc/passwd:

root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
bin:x:2:2:bin:/bin:/usr/sbin/nologin
sys:x:3:3:sys:/dev:/usr/sbin/nologin
sync:x:4:65534:sync:/bin:/bin/sync
games:x:5:60:games:/usr/games:/usr/sbin/nologin
www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin`;
                } else if (normalizedPath.includes('win.ini')) {
                    return `Content of C:\\Windows\\win.ini:

; for 16-bit app support
[fonts]
[extensions]
[mci extensions]
[files]
[Mail]
MAPI=1
[MCI Extensions.BAK]
3g2=MPEGVideo
3gp=MPEGVideo
3gp2=MPEGVideo
3gpp=MPEGVideo`;
                } else if (normalizedPath.includes('sam')) {
                    return `Content of C:\\Windows\\system32\\config\\SAM:

[BINARY FILE]
Microsoft Windows NT SAM database
System credentials and encrypted password hashes
(Access restricted)`;
                } else if (normalizedPath.includes('hosts')) {
                    return `Content of hosts file:

# Copyright (c) 1993-2009 Microsoft Corp.
#
127.0.0.1       localhost
::1             localhost
192.168.1.100   db-server.local
192.168.1.101   backup-server.local
10.0.0.50       internal-api.hackmebank.local`;
                } else if (normalizedPath.includes('config.php')) {
                    return `Content of config.php:

<?php
// Database Configuration
$DB_HOST = 'localhost';
$DB_USER = 'hackmebank_user';
$DB_PASS = 'Sup3rS3cr3tP@ssw0rd!';
$DB_NAME = 'hackmebank';

// API Keys
$API_SECRET = 'sk_live_123456789abcdef';
$STRIPE_KEY = 'sk_test_987654321zyxwvut';

// Encryption Key
$ENCRYPTION_KEY = '4d51a7c8b2e3f9g6h1i0j8k7l9m2n5p0';

// Debug Mode (should be false in production)
define('DEBUG', true);
?>";
                } else if (normalizedPath.includes('web.config')) {
                    return `Content of web.config:

<?xml version="1.0" encoding="UTF-8"?>
<configuration>
    <appSettings>
        <add key="DBConnectionString" value="Server=sqlserver;Database=HackMeBank;User Id=sa;Password=P@ssw0rd123!;"/>
        <add key="APIKey" value="abc123xyz789"/>
        <add key="AdminPassword" value="Adm1n!234"/>
    </appSettings>
    <system.web>
        <compilation debug="true" targetFramework="4.8" />
    </system.web>
</configuration>`;
                } else if (normalizedPath.includes('shadow')) {
                    return `Content of /etc/shadow:

root:$6$UqMEjc/z$VTrKXwRWK22AzuZmwfN84CQJK8w0EoJQ6GTPp9GD1tEzVpNsC3XmQJWGqqXgjDGVwSH.PvYk2qUUYHqR5ZOmq/:18506:0:99999:7:::
daemon:*:18506:0:99999:7:::
bin:*:18506:0:99999:7:::
sys:*:18506:0:99999:7:::
mysql:!:18509:0:99999:7:::
www-data:!:18509:0:99999:7:::`;
                } else if (normalizedPath.includes('unattend.xml')) {
                    return `Content of unattend.xml:

<?xml version="1.0" encoding="utf-8"?>
<unattend xmlns="urn:schemas-microsoft-com:unattend">
    <settings pass="specialize">
        <component name="Microsoft-Windows-Shell-Setup">
            <ComputerName>HACKMEBANK-SRV</ComputerName>
            <ProductKey>XXXXX-XXXXX-XXXXX-XXXXX-XXXXX</ProductKey>
            <AdministratorPassword>
                <Value>QWRtaW5QYXNzd29yZDEyMyE=</Value>
                <PlainText>false</PlainText>
            </AdministratorPassword>
        </component>
    </settings>
</unattend>`;
                } else if (normalizedPath.includes('.php')) {
                    return `Content of PHP file:

<?php
// Sample PHP file
echo "HackMeBank - Secure Banking System";
?>`;
                } else if (normalizedPath.includes('.pdf')) {
                    return `Content of report.pdf:

Financial Report Q1 2025
=======================
Total Assets: $5,234,567
Total Liabilities: $3,456,789
Net Worth: $1,777,778

Confidential Information`;
                } else if (normalizedPath.includes('.docx')) {
                    return `Content of proposal.docx:

Business Proposal
================
Proposal for new online banking features...
Confidential - Internal Use Only`;
                } else if (normalizedPath.includes('.xlsx')) {
                    return `Content of spreadsheet.xlsx:

Customer Data Spreadsheet
=========================
ID | Name          | Balance    | Account Type
----------------------------------------
1  | John Doe      | $5,432.10  | Checking
2  | Jane Smith   | $12,345.67 | Savings
3  | Admin User    | $999,999.99| Admin`;
                } else if (normalizedPath.includes('.htaccess')) {
                    return `Content of .htaccess:

AuthType Basic
AuthName "Restricted Area"
AuthUserFile /etc/apache2/.htpasswd
Require valid-user

# Security Headers
Header set X-XSS-Protection "1; mode=block"
Header set X-Content-Type-Options "nosniff"
Header set X-Frame-Options "SAMEORIGIN"`;
                } else {
                    // Default response for unknown files
                    if (path.endsWith('.png') || path.endsWith('.jpg')) {
                        return 'Binary image data...';
                    } else {
                        return `Content of requested file: ${path}`;
                    }
                }
            }
            
            // Validation helpers
            function isValidPath(path) {
                // Basic validation for high security - check for both Windows and Linux paths
                return !path.startsWith('/') && !path.match(/^[a-zA-Z]:/) && !path.match(/^\\/);
            }
            
            function containsTraversal(path) {
                // Check for traversal patterns - both forward and backward slashes
                return path.includes('..') || path.includes('%2e') || path.includes('%252e') || 
                       path.includes('..\\') || path.includes('.../') || path.includes('..%5c');
            }
            
            function containsAnyTraversal(path) {
                // Comprehensive traversal detection for Windows and Linux
                const patterns = [
                    '..',
                    '%2e%2e',
                    '%252e%252e',
                    '%c0%ae',
                    '%e0%80%ae',
                    '..%c0%af',
                    '..%c1%9c',
                    '..%c1%1c',
                    '..%c1%1c',
                    '%5c', // backslash
                    '%255c', // double-encoded backslash
                    '..\\',
                    '..\\'
                ];
                
                return patterns.some(pattern => path.toLowerCase().includes(pattern));
            }
            
            // Show traversal detection alert
            function showTraversalDetection() {
                const traversalDetection = document.getElementById('traversalDetection');
                
                if (traversalDetection) {
                    traversalDetection.style.display = 'block';
                    
                    // Hide after 5 seconds
                    setTimeout(() => {
                        traversalDetection.style.display = 'none';
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