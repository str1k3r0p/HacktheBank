<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command Injection - HackMeBank</title>
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
        /* Additional styles specific to the Command Injection vulnerability page */
        .cmd-header {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.3) 0%, rgba(240, 0, 204, 0.3) 100%);
            border-radius: 5px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .cmd-header::before {
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

        .cmd-header h1 {
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        }

        .cmd-header p {
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

        .cmd-type-section {
            margin-bottom: 2.5rem;
        }

        .cmd-type-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .cmd-type-title {
            display: flex;
            align-items: center;
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .cmd-type-title i {
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

        .cmd-demo-container {
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .cmd-demo-title {
            font-family: var(--cyber-font-mono);
            font-size: 1.1rem;
            color: var(--cyber-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .cmd-demo-title i {
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
            overflow-x: auto;
        }

        .demo-result pre {
            color: var(--cyber-text);
            margin: 0;
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
        
        /* Success message for Command Injection detection */
        .cmd-detection {
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

        .terminal-header {
            background-color: var(--cyber-bg-darker);
            border-radius: 5px 5px 0 0;
            padding: 0.5rem 1rem;
            font-family: var(--cyber-font-mono);
            font-size: 0.85rem;
            color: var(--cyber-text);
            display: flex;
            align-items: center;
        }

        .terminal-header i {
            margin-right: 0.5rem;
        }

        .terminal-window {
            background-color: rgba(0, 0, 0, 0.8);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 0 0 5px 5px;
            padding: 1rem;
            font-family: var(--cyber-font-mono);
            font-size: 0.9rem;
            color: #33ff33;
            margin-bottom: 1.5rem;
        }

        .terminal-prompt {
            color: #33ff33;
        }

        .terminal-command {
            color: #ffffff;
        }

        .terminal-output {
            color: #cccccc;
            margin-left: 1rem;
        }

        .os-icon-container {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .os-icon {
            font-size: 2rem;
            color: var(--cyber-text);
        }

        .os-icon.active {
            color: var(--cyber-primary);
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
                            <li><a class="dropdown-item active" href="cmd_injection.php">Command Injection</a></li>
                            <li><a class="dropdown-item" href="bruteforce.php">Brute Force</a></li>
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

    <!-- Command Injection Detection Alert (hidden by default) -->
    <div class="cmd-detection" id="cmdDetection">
        <i class="fas fa-check-circle me-2"></i> Command Injection Attack Detected!
        <div class="mt-2 small">The current security level allowed execution of your payload.</div>
    </div>

    <!-- Main content -->
    <main class="container mt-4 mb-5">
        <!-- Command Injection Header -->
        <div class="cmd-header">
            <h1><i class="fas fa-terminal me-3"></i>Command Injection</h1>
            <p>Command Injection is a critical web application vulnerability that allows attackers to execute arbitrary system commands on the host operating system. This occurs when an application passes unsafe user-supplied data to a system shell. A successful command injection attack can lead to complete system compromise, data theft, and unauthorized access.</p>
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
                            <a href="#cmd-types" class="side-nav-link">
                                <i class="fas fa-layer-group"></i> Command Injection Types
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#direct-injection" class="side-nav-link">
                                <i class="fas fa-terminal"></i> Direct Command Injection
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#chain-operators" class="side-nav-link">
                                <i class="fas fa-link"></i> Chain Operators
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#blind-injection" class="side-nav-link">
                                <i class="fas fa-eye-slash"></i> Blind Command Injection
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
                    <h2>Introduction to Command Injection</h2>
                    <p>Command Injection occurs when an application passes unsafe user-supplied data to a system shell. Unlike other injection attacks that target specific platforms (like SQL injection for databases), command injection targets the underlying operating system through shell commands.</p>
                    
                    <p>Applications that use system functions to execute commands based on user input without proper validation are vulnerable. This commonly occurs in features like ping tools, DNS lookups, file operations, or any functionality that interacts with the operating system.</p>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Key Impact in Banking Applications:</strong> Command injection vulnerabilities in banking applications can lead to server compromise, lateral movement through internal networks, data theft, and potentially complete control over banking infrastructure.
                    </div>

                    <div class="os-icon-container mt-4">
                        <div class="text-center">
                            <i class="fab fa-linux os-icon"></i>
                            <div>Linux</div>
                        </div>
                        <div class="text-center">
                            <i class="fab fa-windows os-icon"></i>
                            <div>Windows</div>
                        </div>
                        <div class="text-center">
                            <i class="fab fa-apple os-icon"></i>
                            <div>macOS</div>
                        </div>
                    </div>
                    <p class="text-muted">Command injection can affect all major operating systems, though syntax may vary.</p>
                </section>
                
                <!-- Command Injection Types -->
                <section id="cmd-types" class="mb-5">
                    <h2>Types of Command Injection Vulnerabilities</h2>
                    <p>Command injection can be exploited through various techniques, depending on the application's implementation and security measures:</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="cmd-type-icon"><i class="fas fa-terminal"></i></div>
                                    <h3 class="card-title">Direct Command Injection</h3>
                                    <p class="card-text">Occurs when attackers can directly append or insert system commands that are executed by the application without sanitization.</p>
                                    <a href="#direct-injection" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="cmd-type-icon"><i class="fas fa-link"></i></div>
                                    <h3 class="card-title">Chain Operators</h3>
                                    <p class="card-text">Uses special characters like semicolons, pipes, or logical operators to chain multiple commands together for sequential execution.</p>
                                    <a href="#chain-operators" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="cmd-type-icon"><i class="fas fa-eye-slash"></i></div>
                                    <h3 class="card-title">Blind Command Injection</h3>
                                    <p class="card-text">Occurs when command execution happens but the output is not directly visible to the attacker, requiring alternative techniques to confirm execution.</p>
                                    <a href="#blind-injection" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Direct Command Injection -->
                <section id="direct-injection" class="cmd-type-section">
                    <h2 class="cmd-type-title"><i class="fas fa-terminal"></i> Direct Command Injection</h2>
                    
                    <p>Direct Command Injection is the most straightforward type of command injection vulnerability. It occurs when an application directly incorporates user input into a system command without proper validation or sanitization, allowing attackers to execute arbitrary commands.</p>
                    
                    <h4 class="mb-3">How Direct Command Injection Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>User provides input that will be used in a system command</li>
                                <li>Application incorporates the input directly into a command string</li>
                                <li>The command is executed with the permissions of the web application</li>
                                <li>The attacker can inject additional commands using special characters</li>
                                <li>The injected commands execute on the server's operating system</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Common Attack Vectors</h5>
                                    <ul class="mb-0">
                                        <li>Network diagnostic tools (ping, traceroute)</li>
                                        <li>File operations and manipulations</li>
                                        <li>Custom administrative functions</li>
                                        <li>External data processors or utilities</li>
                                        <li>Features that interact with system resources</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>ping_tool.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - user input directly used in system command
if (isset($_GET['host'])) {
    $host = $_GET['host'];
    
    // Vulnerable command execution without sanitization
    $command = "ping -c 4 " . $host;
    $output = shell_exec($command);
    
    echo "&lt;pre>" . $output . "&lt;/pre>";
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Direct Command Injection Demo -->
                    <div class="cmd-demo-container">
                        <h4 class="cmd-demo-title"><i class="fas fa-flask"></i> Direct Command Injection Demonstration</h4>
                        <p>This network diagnostic tool is vulnerable to command injection. Try entering different payloads based on the security level.</p>
                        
                        <form id="directInjectionForm" class="mb-3">
                            <div class="mb-3">
                                <label for="host" class="form-label">Host to ping:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="hostInput" name="host" placeholder="Enter hostname/IP or command injection payload...">
                                    <button class="btn btn-primary" type="submit">Ping Host</button>
                                </div>
                                <div class="form-text">
                                    Try a valid hostname like "google.com" or an injection like "google.com; ls"
                                </div>
                            </div>
                        </form>
                        
                        <div class="terminal-header">
                            <i class="fas fa-terminal"></i> Command Output
                        </div>
                        <div class="demo-result" id="directInjectionResult">
                            <!-- Results will appear here -->
                            <div class="text-center text-muted">Enter a hostname above to ping</div>
                        </div>
                    </div>
                </section>
                
                <!-- Chain Operators -->
                <section id="chain-operators" class="cmd-type-section">
                    <h2 class="cmd-type-title"><i class="fas fa-link"></i> Chain Operators</h2>
                    
                    <p>Chain operators are special characters or sequences that allow multiple commands to be executed in sequence. These operators are commonly used in command-line interfaces for legitimate purposes, but when injected into vulnerable applications, they can be used to execute arbitrary commands.</p>
                    
                    <h4 class="mb-3">Common Chain Operators</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">Unix/Linux Operators</div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Operator</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>;</code></td>
                                                <td>Command separator (run commands sequentially)</td>
                                            </tr>
                                            <tr>
                                                <td><code>&&</code></td>
                                                <td>AND operator (run second command if first succeeds)</td>
                                            </tr>
                                            <tr>
                                                <td><code>||</code></td>
                                                <td>OR operator (run second command if first fails)</td>
                                            </tr>
                                            <tr>
                                                <td><code>|</code></td>
                                                <td>Pipe (use output of first command as input to second)</td>
                                            </tr>
                                            <tr>
                                                <td><code>`command`</code></td>
                                                <td>Command substitution (inline execution)</td>
                                            </tr>
                                            <tr>
                                                <td><code>$(command)</code></td>
                                                <td>Command substitution (inline execution)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header">Windows Operators</div>
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Operator</th>
                                                <th>Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><code>&</code></td>
                                                <td>Command separator (run commands sequentially)</td>
                                            </tr>
                                            <tr>
                                                <td><code>&&</code></td>
                                                <td>AND operator (run second command if first succeeds)</td>
                                            </tr>
                                            <tr>
                                                <td><code>||</code></td>
                                                <td>OR operator (run second command if first fails)</td>
                                            </tr>
                                            <tr>
                                                <td><code>|</code></td>
                                                <td>Pipe (use output of first command as input to second)</td>
                                            </tr>
                                            <tr>
                                                <td><code>%VARIABLE%</code></td>
                                                <td>Environment variable expansion</td>
                                            </tr>
                                            <tr>
                                                <td><code>^</code></td>
                                                <td>Escape character (used to escape special characters)</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>dns_lookup.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - user input directly used in system command
if (isset($_POST['domain'])) {
    $domain = $_POST['domain'];
    
    // Vulnerable command execution susceptible to chain operators
    $command = "nslookup " . $domain;
    $output = shell_exec($command);
    
    echo "&lt;pre>" . $output . "&lt;/pre>";
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Chain Operators Demo -->
                    <div class="cmd-demo-container">
                        <h4 class="cmd-demo-title"><i class="fas fa-flask"></i> Chain Operators Demonstration</h4>
                        <p>This DNS lookup tool is vulnerable to command injection using chain operators. Try entering different payloads based on the security level.</p>
                        
                        <form id="chainOperatorsForm" class="mb-3">
                            <div class="mb-3">
                                <label for="domain" class="form-label">Domain to lookup:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="domainInput" name="domain" placeholder="Enter domain or command injection payload...">
                                    <button class="btn btn-primary" type="submit">Lookup</button>
                                </div>
                                <div class="form-text">
                                    Try a valid domain like "google.com" or an injection like "google.com && whoami"
                                </div>
                            </div>
                        </form>
                        
                        <div class="terminal-header">
                            <i class="fas fa-terminal"></i> Command Output
                        </div>
                        <div class="demo-result" id="chainOperatorsResult">
                            <!-- Results will appear here -->
                            <div class="text-center text-muted">Enter a domain above to perform a DNS lookup</div>
                        </div>
                    </div>
                </section>
                
                <!-- Blind Command Injection -->
                <section id="blind-injection" class="cmd-type-section">
                    <h2 class="cmd-type-title"><i class="fas fa-eye-slash"></i> Blind Command Injection</h2>
                    
                    <p>Blind Command Injection occurs when the output of the injected command is not directly visible to the attacker. This makes exploitation more challenging but still possible through various techniques to confirm command execution and extract data.</p>
                    
                    <h4 class="mb-3">Techniques for Blind Command Injection</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Time-Based Techniques</h5>
                                    <ul>
                                        <li>Using <code>sleep</code> or <code>ping</code> commands to create a time delay</li>
                                        <li>If the response is delayed by the specified time, the command was executed</li>
                                        <li>Example: <code>ping -c 10 127.0.0.1</code> (delays response by ~10 seconds)</li>
                                        <li>Useful for confirming vulnerability without visible output</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">Out-of-Band Techniques</h5>
                                    <ul>
                                        <li>Redirecting command output to external systems</li>
                                        <li>Using network commands to send data to attacker-controlled servers</li>
                                        <li>Examples: <code>curl</code>, <code>wget</code>, <code>nslookup</code>, <code>ping</code></li>
                                        <li>DNS or HTTP requests with embedded command output</li>
                                        <li>File creation or modification as execution indicators</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>update_log.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - blind command injection in logging function
function writeToLog($message) {
    // Vulnerable command execution - output not displayed to user
    $command = "echo " . $message . " >> /var/log/app.log";
    exec($command);
    return true;
}

// API endpoint
if (isset($_POST['message'])) {
    $message = $_POST['message'];
    
    if (writeToLog($message)) {
        echo json_encode(["status" => "success", "message" => "Log updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to update log"]);
    }
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Blind Command Injection Demo -->
                    <div class="cmd-demo-container">
                        <h4 class="cmd-demo-title"><i class="fas fa-flask"></i> Blind Command Injection Demonstration</h4>
                        <p>This logging system is vulnerable to blind command injection. Try different techniques to confirm command execution.</p>
                        
                        <form id="blindInjectionForm" class="mb-3">
                            <div class="mb-3">
                                <label for="message" class="form-label">Log message:</label>
                                <textarea class="form-control" id="messageInput" name="message" rows="3" placeholder="Enter message or command injection payload..."></textarea>
                                <div class="form-text">
                                    Try time-based payloads like "; sleep 5" to confirm execution via response delay
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Log Entry</button>
                        </form>
                        
                        <div class="terminal-header">
                            <i class="fas fa-terminal"></i> Response
                        </div>
                        <div class="demo-result" id="blindInjectionResult">
                            <!-- Results will appear here -->
                            <div class="text-center text-muted">Submit a log message to see the response</div>
                        </div>
                    </div>
                </section>
                
                <!-- Command Injection Payloads -->
                <section id="payloads" class="mb-5">
                    <h2>Command Injection Payloads for Different Security Levels</h2>
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
                            <p>At low security level, there is minimal or no input validation or sanitization, making basic command injection payloads effective:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Basic Command Separator</h5>
                                    <div class="payload-code">google.com; ls -la</div>
                                    <p class="payload-description">Uses semicolon to separate commands. The first command is executed normally, then the injected command runs.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="direct" data-payload="google.com; ls -la">Try in Direct Injection</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="chain" data-payload="google.com; ls -la">Try in Chain Operators</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>AND Operator</h5>
                                    <div class="payload-code">google.com && whoami</div>
                                    <p class="payload-description">Uses AND operator to execute the second command if the first one succeeds.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="direct" data-payload="google.com && whoami">Try in Direct Injection</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="chain" data-payload="google.com && whoami">Try in Chain Operators</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Command Substitution</h5>
                                    <div class="payload-code">google.com `id`</div>
                                    <p class="payload-description">Uses backticks for command substitution. The output of the command inside backticks is included in the original command.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="direct" data-payload="google.com `id`">Try in Direct Injection</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="chain" data-payload="google.com `id`">Try in Chain Operators</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Medium Security Payloads -->
                        <div class="tab-pane fade" id="medium" role="tabpanel">
                            <div class="security-badge-large medium mb-3">
                                <i class="fas fa-shield-alt"></i> Medium Security Level
                            </div>
                            <p>Medium security typically includes basic filters that block simple payloads but can be bypassed with more sophisticated techniques:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Alternative Separator</h5>
                                    <div class="payload-code">google.com%0Als</div>
                                    <p class="payload-description">Uses URL-encoded newline character (%0A) to inject a new command. This bypasses filters that only check for semicolons or other common separators.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="direct" data-payload="google.com%0Als">Try in Direct Injection</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="chain" data-payload="google.com%0Als">Try in Chain Operators</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Modern Command Substitution</h5>
                                    <div class="payload-code">google.com$(cat /etc/passwd)</div>
                                    <p class="payload-description">Uses the $() syntax for command substitution, which may bypass filters that only check for backticks.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="direct" data-payload="google.com$(cat /etc/passwd)">Try in Direct Injection</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="chain" data-payload="google.com$(cat /etc/passwd)">Try in Chain Operators</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Blind Time-Based Injection</h5>
                                    <div class="payload-code">google.com || sleep 5</div>
                                    <p class="payload-description">Uses logical OR operator with sleep command. If the first command fails, the sleep will execute, causing a 5-second delay in the response.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="blind" data-payload="Test message || sleep 5">Try in Blind Injection</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- High Security Payloads -->
                        <div class="tab-pane fade" id="high" role="tabpanel">
                            <div class="security-badge-large high mb-3">
                                <i class="fas fa-shield-alt"></i> High Security Level
                            </div>
                            <p>High security implementations use robust filtering, input validation, and sandboxing. Bypassing requires advanced techniques:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Encoded Payload</h5>
                                    <div class="payload-code">google.com|echo${IFS}$(base64${IFS}-d${IFS}<<<ZWNobyAiUHduZWQiCg==)</div>
                                    <p class="payload-description">Uses internal field separator (IFS) variable to avoid spaces and base64 encoding to hide the actual payload. The encoded payload is "echo 'Pwned'".</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="direct" data-payload="google.com|echo${IFS}$(base64${IFS}-d${IFS}<<<ZWNobyAiUHduZWQiCg==)">Try in Direct Injection</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Character Insertion Bypass</h5>
                                    <div class="payload-code">google.com|c'a't /etc/passwd</div>
                                    <p class="payload-description">Inserts single quotes within command names to bypass blacklists that check for specific commands but still results in valid syntax.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="chain" data-payload="google.com|c'a't /etc/passwd">Try in Chain Operators</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Advanced Blind Injection</h5>
                                    <div class="payload-code">google.com;if [ $(whoami) = "www-data" ]; then sleep 5; fi</div>
                                    <p class="payload-description">A conditional time-delay that only triggers if a specific condition is met, allowing for data extraction bit by bit through timing analysis.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="blind" data-payload="Test message;if [ $(whoami) = 'www-data' ]; then sleep 5; fi">Try in Blind Injection</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Security Levels -->
                <section id="security-levels" class="mb-5">
                    <h2>Security Levels Implementation</h2>
                    <p>This section shows how different security levels are implemented and how they can be bypassed:</p>
                    
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
                                <p>At this level, there is no input validation or sanitization. User input is directly included in system commands:</p>
                                
                                <div class="code-block-header">
                                    <span>Low Security Code</span>
                                    <span>CommandInjection.php - Low</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// LOW security - Vulnerable to Command Injection
function pingHost($host) {
    // User input directly inserted into command without sanitization
    $command = "ping -c 4 " . $host;
    return shell_exec($command);
}

function performDnsLookup($domain) {
    // Direct command execution without sanitization
    $command = "nslookup " . $domain;
    return shell_exec($command);
}

function writeToLog($message) {
    // No validation before using in command
    $command = "echo " . $message . " >> /var/log/app.log";
    exec($command);
    return true;
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-danger">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">No input validation or sanitization is performed, allowing direct injection of system commands. This is extremely dangerous in production environments and can lead to complete server compromise.</p>
                            </div>
                        </div>
                        
                        <!-- Medium Security Implementation -->
                        <div class="tab-pane fade" id="sec-medium" role="tabpanel">
                            <div class="mb-4">
                                <h4>Medium Security Implementation</h4>
                                <p>At this level, basic filtering is applied but can be bypassed with more sophisticated techniques:</p>
                                
                                <div class="code-block-header">
                                    <span>Medium Security Code</span>
                                    <span>CommandInjection.php - Medium</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// MEDIUM security - Basic filtering but still vulnerable
function pingHost($host) {
    // Basic filtering: Remove common injection characters
    $host = str_replace(array(";", "&", "|", "`"), "", $host);
    
    // Still vulnerable to other injection methods
    $command = "ping -c 4 " . $host;
    return shell_exec($command);
}

function performDnsLookup($domain) {
    // Basic validation to ensure it looks like a domain
    if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/', $domain)) {
        return "Invalid domain format";
    }
    
    // Still vulnerable to certain injection patterns
    $command = "nslookup " . $domain;
    return shell_exec($command);
}

function writeToLog($message) {
    // Attempt to remove dangerous characters
    $message = str_replace(array(";", "&", "|", "`", "$"), "", $message);
    
    // Still vulnerable due to incomplete filtering
    $command = "echo " . $message . " >> /var/log/app.log";
    exec($command);
    return true;
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">The filtering only blocks certain characters and can be bypassed using URL encoding, alternative syntax, or other special characters. The domain validation regex is also incomplete and can be circumvented.</p>
                            </div>
                        </div>
                        
                        <!-- High Security Implementation -->
                        <div class="tab-pane fade" id="sec-high" role="tabpanel">
                            <div class="mb-4">
                                <h4>High Security Implementation</h4>
                                <p>At this level, proper input validation, allowlists, and safer alternatives to shell commands are used:</p>
                                
                                <div class="code-block-header">
                                    <span>High Security Code</span>
                                    <span>CommandInjection.php - High</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// HIGH security - Proper validation and safer alternatives
function pingHost($host) {
    // Strict validation with allowlist approach
    if (!filter_var($host, FILTER_VALIDATE_IP) && 
        !preg_match('/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/', $host)) {
        return "Invalid host format";
    }
    
    // Use escapeshellarg to properly escape arguments
    $command = "ping -c 4 " . escapeshellarg($host);
    return shell_exec($command);
}

function performDnsLookup($domain) {
    // Strict domain validation
    if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/', $domain)) {
        return "Invalid domain format";
    }
    
    // Use PHP's built-in DNS functions instead of shell commands
    $records = dns_get_record(escapeshellarg($domain), DNS_A + DNS_AAAA);
    $result = "DNS Lookup Results for $domain:\n\n";
    
    foreach ($records as $record) {
        $result .= "Type: " . $record['type'] . "\n";
        $result .= "IP: " . ($record['type'] == 'A' ? $record['ip'] : $record['ipv6']) . "\n\n";
    }
    
    return $result;
}

function writeToLog($message) {
    // Sanitize and limit message length
    $message = filter_var($message, FILTER_SANITIZE_STRING);
    $message = substr($message, 0, 255);
    
    // Use file operations instead of shell commands
    $logFile = "/var/log/app.log";
    file_put_contents($logFile, $message . "\n", FILE_APPEND);
    return true;
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-success">
                                <h5><i class="fas fa-shield-alt me-2"></i> Protection Measures</h5>
                                <ul class="mb-0">
                                    <li><strong>Input Validation:</strong> Strict validation using allowlists and pattern matching</li>
                                    <li><strong>Proper Escaping:</strong> Using escapeshellarg() to safely escape command arguments</li>
                                    <li><strong>Safer Alternatives:</strong> Using built-in PHP functions instead of shell commands where possible</li>
                                    <li><strong>Limited Input:</strong> Restricting the length and content of user input</li>
                                    <li><strong>Least Privilege:</strong> Running commands with minimum required permissions</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Mitigation -->
                <section id="mitigation" class="mb-5">
                    <h2>Command Injection Mitigation Strategies</h2>
                    <p>To protect your applications from command injection vulnerabilities, implement these best practices:</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-shield-alt me-2"></i>Avoid Shell Commands</h4>
                                    <ul class="mb-0">
                                        <li>Use language-specific functions instead of external commands</li>
                                        <li>Replace shell commands with built-in library functions</li>
                                        <li>If shell commands must be used, use safe APIs (e.g., execve instead of system)</li>
                                        <li>Consider creating APIs or microservices for necessary system operations</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-filter me-2"></i>Input Validation</h4>
                                    <ul class="mb-0">
                                        <li>Implement strict input validation using allowlists</li>
                                        <li>Validate input format, length, content, and range</li>
                                        <li>Reject any input that doesn't conform to expected patterns</li>
                                        <li>Use regular expressions to validate complex inputs</li>
                                        <li>Apply type checking to ensure input data types match expectations</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-code me-2"></i>Proper Argument Handling</h4>
                                    <ul class="mb-0">
                                        <li>Use parameterized command execution functions</li>
                                        <li>Apply escapeshellarg() or equivalent to all command arguments</li>
                                        <li>Separate command from arguments (don't build commands by string concatenation)</li>
                                        <li>Use command arrays instead of strings where possible</li>
                                        <li>Apply context-specific escaping based on the command interpreter</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-user-shield me-2"></i>Runtime Protection</h4>
                                    <ul class="mb-0">
                                        <li>Apply the principle of least privilege for command execution</li>
                                        <li>Use restricted execution environments or sandboxes</li>
                                        <li>Implement system call filtering (e.g., seccomp-bpf on Linux)</li>
                                        <li>Set up file system access restrictions for the application</li>
                                        <li>Use container technologies to isolate application components</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Defense in Depth</h5>
                        <p class="mb-0">Never rely on a single defense mechanism. Implement multiple layers of protection to mitigate command injection vulnerabilities effectively. Regularly test your applications with both automated scanners and manual penetration testing. Remember that the most effective protection is to avoid using shell commands altogether whenever possible.</p>
                    </div>
                </section>
                
                <!-- References -->
                <section id="references">
                    <h2>References and Resources</h2>
                    <p>Learn more about Command Injection from these authoritative sources:</p>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Official Resources</h5>
                            <ul class="mb-0">
                                <li><a href="https://owasp.org/www-community/attacks/Command_Injection" target="_blank">OWASP Command Injection</a></li>
                                <li><a href="https://portswigger.net/web-security/os-command-injection" target="_blank">PortSwigger Web Security Academy - OS Command Injection</a></li>
                                <li><a href="https://cheatsheetseries.owasp.org/cheatsheets/OS_Command_Injection_Defense_Cheat_Sheet.html" target="_blank">OWASP Command Injection Defense Cheat Sheet</a></li>
                                <li><a href="https://cwe.mitre.org/data/definitions/78.html" target="_blank">CWE-78: Improper Neutralization of Special Elements used in an OS Command</a></li>
                                <li><a href="https://www.nist.gov/publications/software-vulnerability-mitigation-os-command-injection" target="_blank">NIST - Software Vulnerability Mitigation: OS Command Injection</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Practice Platforms</h5>
                            <ul class="mb-0">
                                <li><a href="https://www.hacksplaining.com/exercises/command-execution" target="_blank">Hacksplaining - Command Execution Interactive Lessons</a></li>
                                <li><a href="https://github.com/OWASP/DVWA" target="_blank">DVWA - Damn Vulnerable Web Application</a></li>
                                <li><a href="https://portswigger.net/web-security/all-labs#os-command-injection" target="_blank">PortSwigger Web Security Labs - OS Command Injection</a></li>
                                <li><a href="https://www.vulnhub.com/" target="_blank">VulnHub - Vulnerable Virtual Machines</a></li>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/security-display.js"></script>
    <!-- Prism.js for code highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-php.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-javascript.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-bash.min.js"></script>
    
    <script>
        // Global variable to store the current security level
        let currentSecurityLevel = 'low';
        
        // Initialize page
        document.addEventListener('DOMContentLoaded', function() {
            // Get the current security level from localStorage or default to 'low'
            currentSecurityLevel = localStorage.getItem('securityLevel') || 'low';
            
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
                    localStorage.setItem('securityLevel', level);
                    
                    // Update UI
                    securityBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                });
            });
            
            // Setup side navigation
            setupSideNav();
            
            // Setup Command Injection demos
            setupDirectInjectionDemo();
            setupChainOperatorsDemo();
            setupBlindInjectionDemo();
            
            // Setup payload buttons
            setupPayloadButtons();
            
            // Setup OS icons
            setupOsIcons();
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
        
        // Setup OS icons
        function setupOsIcons() {
            const osIcons = document.querySelectorAll('.os-icon');
            
            osIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    // Toggle active class
                    this.classList.toggle('active');
                });
            });
        }
        
        // Handle direct command injection demo
        function setupDirectInjectionDemo() {
            const form = document.getElementById('directInjectionForm');
            const resultDiv = document.getElementById('directInjectionResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const host = document.getElementById('hostInput').value;
                    let response = '';
                    let cmdDetected = false;
                    
                    // Apply different sanitization based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // No sanitization at low level - simulate command injection success
                            if (host.includes(';') || host.includes('&&') || host.includes('||') || 
                                host.includes('|') || host.includes('`') || host.includes('$(')) {
                                // Command injection detected
                                response = simulateCommandExecution(host);
                                cmdDetected = true;
                            } else if (isValidHostname(host)) {
                                // Valid hostname - simulate ping
                                response = simulatePing(host);
                            } else {
                                // Invalid hostname
                                response = `ping: unknown host ${host}`;
                            }
                            break;
                            
                        case 'medium':
                            // Basic sanitization at medium level
                            const filteredHost = host.replace(/;|&|\||\`/g, '');
                            
                            if (host !== filteredHost) {
                                // Basic command injection filtering
                                response = `Filtered input: "${filteredHost}"\n\n` + simulatePing(filteredHost);
                            } else if (host.includes('%0A') || host.includes('$(')) {
                                // Command injection bypass detected
                                response = simulateCommandExecution(host);
                                cmdDetected = true;
                            } else if (isValidHostname(host)) {
                                // Valid hostname - simulate ping
                                response = simulatePing(host);
                            } else {
                                // Invalid hostname
                                response = `ping: unknown host ${host}`;
                            }
                            break;
                            
                        case 'high':
                            // Strong sanitization at high level
                            if (!isValidHostname(host) && !isValidIpAddress(host)) {
                                // Invalid hostname or IP
                                response = "Error: Invalid input format. Please enter a valid hostname or IP address.";
                            } else if (host.includes(';') || host.includes('&') || host.includes('|') || 
                                      host.includes('`') || host.includes('$')) {
                                // Command injection attempt blocked
                                response = "Error: Invalid input. Potential command injection detected.";
                            } else {
                                // Valid hostname - simulate ping
                                response = simulatePing(host);
                            }
                            break;
                    }
                    
                    // Display the results
                    resultDiv.innerHTML = `<pre>${response}</pre>`;
                    
                    // Show command injection detection message if applicable
                    if (cmdDetected) {
                        showCmdDetection();
                    }
                });
            }
        }
        
        // Handle chain operators demo
        function setupChainOperatorsDemo() {
            const form = document.getElementById('chainOperatorsForm');
            const resultDiv = document.getElementById('chainOperatorsResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const domain = document.getElementById('domainInput').value;
                    let response = '';
                    let cmdDetected = false;
                    
                    // Apply different sanitization based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // No sanitization at low level - simulate command injection success
                            if (domain.includes(';') || domain.includes('&&') || domain.includes('||') || 
                                domain.includes('|') || domain.includes('`') || domain.includes('$(')) {
                                // Command injection detected
                                response = simulateDnsLookup(domain.split(/[;&|`]/)[0]) + "\n\n" + 
                                           simulateCommandExecution(domain);
                                cmdDetected = true;
                            } else if (isValidHostname(domain)) {
                                // Valid domain - simulate DNS lookup
                                response = simulateDnsLookup(domain);
                            } else {
                                // Invalid domain
                                response = `nslookup: server can't find ${domain}: NXDOMAIN`;
                            }
                            break;
                            
                        case 'medium':
                            // Basic sanitization at medium level
                            if (domain.match(/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/)) {
                                // Valid domain format
                                response = simulateDnsLookup(domain);
                            } else if (domain.includes('#') || domain.includes('%0A') || 
                                      (domain.includes(' ') && (domain.includes("ping") || domain.includes("cat") || domain.includes("ls")))) {
                                // Command injection bypass detected
                                const baseDomain = domain.split(/[ #]/)[0];
                                response = simulateDnsLookup(baseDomain) + "\n\n" + 
                                           simulateCommandExecution(domain);
                                cmdDetected = true;
                            } else {
                                // Invalid domain or blocked injection
                                response = "Error: Invalid domain format.";
                            }
                            break;
                            
                        case 'high':
                            // Strong sanitization at high level
                            if (domain.match(/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/)) {
                                // Valid domain format - simulate DNS lookup with PHP's built-in functions
                                response = simulateDnsLookupSafe(domain);
                            } else {
                                // Invalid domain or injection attempt
                                response = "Error: Invalid domain format. Please enter a valid domain name.";
                            }
                            break;
                    }
                    
                    // Display the results
                    resultDiv.innerHTML = `<pre>${response}</pre>`;
                    
                    // Show command injection detection message if applicable
                    if (cmdDetected) {
                        showCmdDetection();
                    }
                });
            }
        }
        
        // Handle blind command injection demo
        function setupBlindInjectionDemo() {
            const form = document.getElementById('blindInjectionForm');
            const resultDiv = document.getElementById('blindInjectionResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const message = document.getElementById('messageInput').value;
                    let response = '';
                    let cmdDetected = false;
                    
                    // Apply different sanitization based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // No sanitization at low level
                            if (message.includes('sleep')) {
                                // Time-based injection detected - simulate delay
                                resultDiv.innerHTML = `<div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                      </div>
                                                      <p class="mt-2">Processing request...</p>`;
                                
                                setTimeout(() => {
                                    resultDiv.innerHTML = `<pre>{"status": "success", "message": "Log updated successfully"}</pre>`;
                                    showCmdDetection();
                                }, 3000);
                                
                                return;
                            } else if (message.includes(';') || message.includes('&&') || message.includes('||') || 
                                     message.includes('|') || message.includes('`') || message.includes('$(')) {
                                // Command injection detected
                                response = `{"status": "success", "message": "Log updated successfully"}`;
                                cmdDetected = true;
                            } else {
                                // Normal message
                                response = `{"status": "success", "message": "Log updated successfully"}`;
                            }
                            break;
                            
                        case 'medium':
                            // Basic sanitization at medium level
                            const filteredMessage = message.replace(/;|&|\||\`|\$/g, '');
                            
                            if (message !== filteredMessage) {
                                // Basic command injection filtering
                                response = `{"status": "success", "message": "Log updated successfully (filtered input)"}`;
                            } else if (message.includes('sleep') || message.includes('%0A')) {
                                // Time-based injection or newline bypass detected
                                resultDiv.innerHTML = `<div class="spinner-border text-primary" role="status">
                                                        <span class="visually-hidden">Loading...</span>
                                                      </div>
                                                      <p class="mt-2">Processing request...</p>`;
                                
                                setTimeout(() => {
                                    resultDiv.innerHTML = `<pre>{"status": "success", "message": "Log updated successfully"}</pre>`;
                                    showCmdDetection();
                                }, 3000);
                                
                                return;
                            } else {
                                // Normal message
                                response = `{"status": "success", "message": "Log updated successfully"}`;
                            }
                            break;
                            
                        case 'high':
                            // Strong sanitization at high level
                            if (message.includes(';') || message.includes('&') || message.includes('|') || 
                                message.includes('`') || message.includes('$') || message.includes('sleep')) {
                                // Command injection attempt blocked
                                response = `{"status": "error", "message": "Invalid input. Potential command injection detected."}`;
                            } else {
                                // Normal message - using file operations instead of shell commands
                                response = `{"status": "success", "message": "Log updated successfully"}`;
                            }
                            break;
                    }
                    
                    // Display the results
                    resultDiv.innerHTML = `<pre>${response}</pre>`;
                    
                    // Show command injection detection message if applicable
                    if (cmdDetected) {
                        showCmdDetection();
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
                    
                    if (target === 'direct') {
                        document.getElementById('hostInput').value = payload;
                        document.getElementById('directInjectionForm').dispatchEvent(new Event('submit'));
                    } else if (target === 'chain') {
                        document.getElementById('domainInput').value = payload;
                        document.getElementById('chainOperatorsForm').dispatchEvent(new Event('submit'));
                    } else if (target === 'blind') {
                        document.getElementById('messageInput').value = payload;
                        document.getElementById('blindInjectionForm').dispatchEvent(new Event('submit'));
                    }
                });
            });
        }
        
        // Helper function to simulate ping command output
        function simulatePing(host) {
            return `PING ${host} (${generateRandomIp()}) 56(84) bytes of data.
64 bytes from ${host} (${generateRandomIp()}): icmp_seq=1 ttl=53 time=24.5 ms
64 bytes from ${host} (${generateRandomIp()}): icmp_seq=2 ttl=53 time=24.8 ms
64 bytes from ${host} (${generateRandomIp()}): icmp_seq=3 ttl=53 time=24.2 ms
64 bytes from ${host} (${generateRandomIp()}): icmp_seq=4 ttl=53 time=24.6 ms

--- ${host} ping statistics ---
4 packets transmitted, 4 received, 0% packet loss, time 3004ms
rtt min/avg/max/mdev = 24.193/24.559/24.830/0.267 ms`;
        }
        
        // Helper function to simulate DNS lookup output
        function simulateDnsLookup(domain) {
            return `Server:		${generateRandomIp()}
Address:	${generateRandomIp()}#53

Non-authoritative answer:
Name:	${domain}
Address: ${generateRandomIp()}`;
        }
        
        // Helper function to simulate DNS lookup output with built-in functions
        function simulateDnsLookupSafe(domain) {
            return `DNS Lookup Results for ${domain}:

Type: A
IP: ${generateRandomIp()}

Type: AAAA
IP: ${generateRandomIpv6()}`;
        }
        
        // Helper function to simulate command execution
        function simulateCommandExecution(command) {
            // Extract the injected command portion
            let injectedCommand = '';
            
            if (command.includes(';')) {
                injectedCommand = command.split(';')[1].trim();
            } else if (command.includes('&&')) {
                injectedCommand = command.split('&&')[1].trim();
            } else if (command.includes('||')) {
                injectedCommand = command.split('||')[1].trim();
            } else if (command.includes('|')) {
                injectedCommand = command.split('|')[1].trim();
            } else if (command.includes('`')) {
                injectedCommand = command.split('`')[1].split('`')[0].trim();
            } else if (command.includes('$(')) {
                injectedCommand = command.split('$(')[1].split(')')[0].trim();
            } else {
                injectedCommand = command;
            }
            
            // Generate appropriate output based on the command
            if (injectedCommand.includes('ls')) {
                return `total 48
drwxr-xr-x  2 www-data www-data 4096 May  2 10:22 .
drwxr-xr-x 12 www-data www-data 4096 May  2 08:45 ..
-rw-r--r--  1 www-data www-data  425 May  2 09:15 config.php
-rw-r--r--  1 www-data www-data 2584 May  2 09:48 functions.php
-rw-r--r--  1 www-data www-data 3856 May  2 10:05 index.php
-rw-r--r--  1 www-data www-data 1254 May  2 09:30 database.php
-rw-r--r--  1 www-data www-data 8874 May  2 10:12 vulnerabilities.php
-rw-------  1 www-data www-data  156 May  2 08:55 .htaccess
drwxr-xr-x  4 www-data www-data 4096 May  2 09:10 assets
drwxr-xr-x  3 www-data www-data 4096 May  2 09:22 includes
drwxr-xr-x  2 www-data www-data 4096 May  2 09:35 uploads`;
            } else if (injectedCommand.includes('whoami')) {
                return `www-data`;
            } else if (injectedCommand.includes('id')) {
                return `uid=33(www-data) gid=33(www-data) groups=33(www-data)`;
            } else if (injectedCommand.includes('cat')) {
                if (injectedCommand.includes('passwd')) {
                    return `root:x:0:0:root:/root:/bin/bash
daemon:x:1:1:daemon:/usr/sbin:/usr/sbin/nologin
bin:x:2:2:bin:/bin:/usr/sbin/nologin
sys:x:3:3:sys:/dev:/usr/sbin/nologin
sync:x:4:65534:sync:/bin:/bin/sync
games:x:5:60:games:/usr/games:/usr/sbin/nologin
man:x:6:12:man:/var/cache/man:/usr/sbin/nologin
lp:x:7:7:lp:/var/spool/lpd:/usr/sbin/nologin
mail:x:8:8:mail:/var/mail:/usr/sbin/nologin
news:x:9:9:news:/var/spool/news:/usr/sbin/nologin
uucp:x:10:10:uucp:/var/spool/uucp:/usr/sbin/nologin
proxy:x:13:13:proxy:/bin:/usr/sbin/nologin
www-data:x:33:33:www-data:/var/www:/usr/sbin/nologin
backup:x:34:34:backup:/var/backups:/usr/sbin/nologin
list:x:38:38:Mailing List Manager:/var/list:/usr/sbin/nologin
irc:x:39:39:ircd:/var/run/ircd:/usr/sbin/nologin
gnats:x:41:41:Gnats Bug-Reporting System:/var/lib/gnats:/usr/sbin/nologin
nobody:x:65534:65534:nobody:/nonexistent:/usr/sbin/nologin
systemd-network:x:100:102:systemd Network Management,,,:/run/systemd:/usr/sbin/nologin
systemd-resolve:x:101:103:systemd Resolver,,,:/run/systemd:/usr/sbin/nologin
systemd-timesync:x:102:104:systemd Time Synchronization,,,:/run/systemd:/usr/sbin/nologin
messagebus:x:103:106::/nonexistent:/usr/sbin/nologin
sshd:x:104:65534::/run/sshd:/usr/sbin/nologin
mysql:x:106:113:MySQL Server,,,:/var/lib/mysql:/bin/false
postfix:x:107:115::/var/spool/postfix:/usr/sbin/nologin
ftp:x:108:116:ftp daemon,,,:/srv/ftp:/usr/sbin/nologin`;
                } else if (injectedCommand.includes('config')) {
                    return `<?php
// Database Configuration
$dbHost = 'localhost';
$dbUser = 'hackmebank_user';
$dbPass = 'Sup3rS3cr3tP@ssw0rd!';
$dbName = 'hackmebank';

// Connect to database
$db = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Application Settings
$appName = 'HackMeBank';
$appVersion = '1.0.0';
$debugMode = false;
?>`;
                } else {
                    return `cat: ${injectedCommand.split('cat ')[1]}: No such file or directory`;
                }
            } else if (injectedCommand.includes('pwd')) {
                return `/var/www/html/hackmebank`;
            } else if (injectedCommand.includes('uname')) {
                return `Linux hackmebank 5.15.0-60-generic #66-Ubuntu SMP Fri Jan 20 14:29:49 UTC 2023 x86_64 x86_64 x86_64 GNU/Linux`;
            } else if (injectedCommand.includes('echo')) {
                // Extract the content after 'echo'
                const echoParts = injectedCommand.split('echo ');
                if (echoParts.length > 1) {
                    return echoParts[1].replace(/"/g, '').replace(/'/g, '');
                } else {
                    return '';
                }
            } else {
                return `Command executed: ${injectedCommand}`;
            }
        }
        
        // Helper function to validate hostname/domain
        function isValidHostname(hostname) {
            // Simple hostname validation regex
            return /^[a-zA-Z0-9][a-zA-Z0-9-]{0,61}[a-zA-Z0-9](?:\.[a-zA-Z]{2,})+$/.test(hostname);
        }
        
        // Helper function to validate IP address
        function isValidIpAddress(ip) {
            // Simple IPv4 validation regex
            return /^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/.test(ip);
        }
        
        // Helper function to generate random IPv4 address
        function generateRandomIp() {
            const octet = () => Math.floor(Math.random() * 256);
            return `${octet()}.${octet()}.${octet()}.${octet()}`;
        }
        
        // Helper function to generate random IPv6 address
        function generateRandomIpv6() {
            const hextet = () => Math.floor(Math.random() * 65536).toString(16).padStart(4, '0');
            return `${hextet()}:${hextet()}:${hextet()}:${hextet()}:${hextet()}:${hextet()}:${hextet()}:${hextet()}`;
        }
        
        // Show command injection detection alert
        function showCmdDetection() {
            const cmdDetection = document.getElementById('cmdDetection');
            
            if (cmdDetection) {
                cmdDetection.style.display = 'block';
                
                // Hide after 5 seconds
                setTimeout(() => {
                    cmdDetection.style.display = 'none';
                }, 5000);
            }
        }
    </script>
</body>
</html>