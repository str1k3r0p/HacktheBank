<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cross-Site Scripting (XSS) - HackMeBank</title>
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
        /* Additional styles specific to the XSS vulnerability page */
        .xss-header {
            background: linear-gradient(135deg, rgba(0, 255, 255, 0.3) 0%, rgba(240, 0, 204, 0.3) 100%);
            border-radius: 5px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .xss-header::before {
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

        .xss-header h1 {
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 15px rgba(0, 255, 255, 0.7);
        }

        .xss-header p {
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

        .xss-type-section {
            margin-bottom: 2.5rem;
        }

        .xss-type-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .xss-type-title {
            display: flex;
            align-items: center;
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .xss-type-title i {
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

        .xss-demo-container {
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .xss-demo-title {
            font-family: var(--cyber-font-mono);
            font-size: 1.1rem;
            color: var(--cyber-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .xss-demo-title i {
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
        
        /* Success message for XSS detection */
        .xss-detection {
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
                            <li><a class="dropdown-item active" href="xss.php">XSS</a></li>
                            <li><a class="dropdown-item" href="cmd_injection.php">Command Injection</a></li>
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

    <!-- XSS Detection Alert (hidden by default) -->
    <div class="xss-detection" id="xssDetection">
        <i class="fas fa-check-circle me-2"></i> XSS Attack Detected!
        <div class="mt-2 small">The current security level allowed execution of your payload.</div>
    </div>

    <!-- Main content -->
    <main class="container mt-4 mb-5">
        <!-- XSS Header -->
        <div class="xss-header">
            <h1><i class="fas fa-code me-3"></i>Cross-Site Scripting (XSS)</h1>
            <p>Cross-Site Scripting (XSS) is one of the most common web application vulnerabilities. It allows attackers to inject malicious scripts into content that will be later viewed by other users. This can lead to session hijacking, credential theft, malicious redirects, and web page defacement.</p>
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
                            <a href="#xss-types" class="side-nav-link">
                                <i class="fas fa-layer-group"></i> XSS Types
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#reflected-xss" class="side-nav-link">
                                <i class="fas fa-reply"></i> Reflected XSS
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#stored-xss" class="side-nav-link">
                                <i class="fas fa-database"></i> Stored XSS
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#dom-xss" class="side-nav-link">
                                <i class="fas fa-code"></i> DOM-based XSS
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
                    <h2>Introduction to XSS</h2>
                    <p>Cross-Site Scripting (XSS) attacks are a type of injection where malicious scripts are injected into trusted websites. An attacker can use XSS to send a malicious script to an unsuspecting user. The end user's browser has no way to know that the script should not be trusted, and will execute the script because it appears to come from a trusted source.</p>
                    
                    <p>The malicious script can access any cookies, session tokens, or other sensitive information retained by the browser and used with that site. These scripts can even rewrite the content of the HTML page.</p>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Key Impact in Banking Applications:</strong> XSS vulnerabilities in banking applications can lead to account takeover, fraudulent transactions, credential theft, and compromise of sensitive financial information.
                    </div>
                </section>
                
                <!-- XSS Types -->
                <section id="xss-types" class="mb-5">
                    <h2>Types of XSS Vulnerabilities</h2>
                    <p>There are three main types of XSS vulnerabilities, each with different characteristics and attack vectors:</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="xss-type-icon"><i class="fas fa-reply"></i></div>
                                    <h3 class="card-title">Reflected XSS</h3>
                                    <p class="card-text">Non-persistent attack where malicious script is reflected off a web server, such as in search results or error messages.</p>
                                    <a href="#reflected-xss" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="xss-type-icon"><i class="fas fa-database"></i></div>
                                    <h3 class="card-title">Stored XSS</h3>
                                    <p class="card-text">Persistent attack where malicious script is stored on the target server, like in databases, comments, or user profiles.</p>
                                    <a href="#stored-xss" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="xss-type-icon"><i class="fas fa-code"></i></div>
                                    <h3 class="card-title">DOM-based XSS</h3>
                                    <p class="card-text">Attack where vulnerability exists in client-side code rather than server-side code, modifying the DOM environment.</p>
                                    <a href="#dom-xss" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Reflected XSS -->
                <section id="reflected-xss" class="xss-type-section">
                    <h2 class="xss-type-title"><i class="fas fa-reply"></i> Reflected XSS</h2>
                    
                    <p>Reflected XSS attacks occur when malicious input is immediately returned and displayed to the user without proper sanitization. This is the most common form of XSS and typically requires the victim to click on a specially crafted link containing the malicious script.</p>
                    
                    <h4 class="mb-3">How Reflected XSS Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>Attacker creates a malicious URL with embedded JavaScript</li>
                                <li>The victim is tricked into clicking the malicious URL</li>
                                <li>The server includes the malicious script in its response</li>
                                <li>The victim's browser executes the script</li>
                                <li>The script runs with the permissions of the website</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Common Attack Vectors</h5>
                                    <ul class="mb-0">
                                        <li>Search results pages</li>
                                        <li>Error messages that include user input</li>
                                        <li>Form submissions with immediate feedback</li>
                                        <li>URL parameters that are reflected in the page</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>search.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - user input is reflected without sanitization
if (isset($_GET['query'])) {
    $query = $_GET['query'];
    echo "&lt;h2>Search Results for: " . $query . "&lt;/h2>";
    // ... rest of the search code
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Reflected XSS Demo -->
                    <div class="xss-demo-container">
                        <h4 class="xss-demo-title"><i class="fas fa-flask"></i> Reflected XSS Demonstration</h4>
                        <p>This search feature is vulnerable to reflected XSS. Try entering different payloads based on the security level.</p>
                        
                        <form id="reflectedXssForm" class="mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchQuery" name="searchQuery" placeholder="Enter search term or XSS payload...">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                            <div class="form-text">
                                Try different payloads based on the current security level.
                            </div>
                        </form>
                        
                        <div class="demo-result" id="reflectedXssResult">
                            <!-- Search results will appear here -->
                            <div class="text-center text-muted">Enter a search term above to see results</div>
                        </div>
                    </div>
                </section>
                
                <!-- Stored XSS -->
                <section id="stored-xss" class="xss-type-section">
                    <h2 class="xss-type-title"><i class="fas fa-database"></i> Stored XSS</h2>
                    
                    <p>Stored XSS (also known as Persistent XSS) occurs when malicious input is saved in a database, message forum, comment field, visitor log, or other storage mechanism. The attack payload is then executed when users view the affected page or content.</p>
                    
                    <h4 class="mb-3">How Stored XSS Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>Attacker submits malicious script to a website that stores user input</li>
                                <li>The malicious script is stored in the database</li>
                                <li>When other users visit the affected page, the script is served as part of the content</li>
                                <li>Victims' browsers execute the script</li>
                                <li>The attack impacts all visitors to the affected page</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Common Attack Vectors</h5>
                                    <ul class="mb-0">
                                        <li>User comments/reviews</li>
                                        <li>User profiles and bios</li>
                                        <li>Forum/message board posts</li>
                                        <li>Product listings in e-commerce sites</li>
                                        <li>Support tickets or feedback forms</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>comments.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - user input is stored without sanitization
if (isset($_POST['comment'])) {
    $username = $_POST['username'];
    $comment = $_POST['comment'];
    
    // Insert into database without sanitization
    $query = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
    $db->query($query);
}

// Display comments
$result = $db->query("SELECT * FROM comments ORDER BY created_at DESC");
while ($row = $result->fetch_assoc()) {
    echo "&lt;div class='comment'>";
    echo "&lt;h4>" . $row['username'] . "&lt;/h4>";
    echo "&lt;p>" . $row['comment'] . "&lt;/p>"; // Vulnerable: Outputs raw stored data
    echo "&lt;/div>";
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Stored XSS Demo -->
                    <div class="xss-demo-container">
                        <h4 class="xss-demo-title"><i class="fas fa-flask"></i> Stored XSS Demonstration</h4>
                        <p>This feedback system simulates a stored XSS vulnerability. Comments with malicious scripts will be stored and displayed to all visitors.</p>
                        
                        <form id="storedXssForm" class="mb-4">
                            <div class="mb-3">
                                <label for="username" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Feedback Message</label>
                                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Enter your feedback or XSS payload..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Feedback</button>
                        </form>
                        
                        <h5>Previous Feedback</h5>
                        <div class="demo-result" id="storedXssResult">
                            <!-- Existing comments will appear here -->
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h5 class="card-title">John Doe</h5>
                                    <p class="card-text">Great banking services! The interface is very user-friendly.</p>
                                    <small class="text-muted">Posted today</small>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-body">
                                    <h5 class="card-title">Jane Smith</h5>
                                    <p class="card-text">I love the quick transfer feature. Makes paying bills so much easier!</p>
                                    <small class="text-muted">Posted yesterday</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- DOM-based XSS -->
                <section id="dom-xss" class="xss-type-section">
                    <h2 class="xss-type-title"><i class="fas fa-code"></i> DOM-based XSS</h2>
                    
                    <p>DOM-based XSS occurs when the vulnerability exists in client-side JavaScript code rather than server-side code. The attack payload is executed as a result of modifying the DOM environment in the victim's browser.</p>
                    
                    <h4 class="mb-3">How DOM-based XSS Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>Client-side JavaScript code processes data from an untrusted source (often URL parameters)</li>
                                <li>The code modifies the DOM using the untrusted data without proper validation</li>
                                <li>The browser executes the injected script in the context of the current page</li>
                                <li>The attack happens entirely on the client-side without server involvement</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Common Attack Vectors</h5>
                                    <ul class="mb-0">
                                        <li>URL fragments (#) and parameters</li>
                                        <li>Client-side routing in SPAs</li>
                                        <li>Data from localStorage/sessionStorage</li>
                                        <li>Client-side templating</li>
                                        <li>Unsafe DOM methods (innerHTML, document.write)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable JavaScript Code</span>
                            <span>app.js</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-javascript">// Vulnerable code - Directly using location.hash to modify DOM
document.addEventListener('DOMContentLoaded', function() {
    // Extract the theme parameter from the URL hash
    const hash = window.location.hash.substring(1);
    const params = new URLSearchParams(hash);
    const theme = params.get('theme');
    
    if (theme) {
        // Vulnerable: Using innerHTML with user-controlled data
        document.getElementById('themeDisplay').innerHTML = 
            'Current theme: ' + theme;
    }
});</code></pre>
                        </div>
                    </div>
                    
                    <!-- DOM-based XSS Demo -->
                    <div class="xss-demo-container">
                        <h4 class="xss-demo-title"><i class="fas fa-flask"></i> DOM-based XSS Demonstration</h4>
                        <p>This theme selector demonstrates DOM-based XSS. The vulnerability is in the JavaScript that processes the URL hash parameter.</p>
                        
                        <div class="mb-3">
                            <label class="form-label">Select a theme or enter a custom value:</label>
                            <select class="form-select mb-2" id="themeSelector">
                                <option value="">-- Select a theme --</option>
                                <option value="light">Light Theme</option>
                                <option value="dark">Dark Theme</option>
                                <option value="cyber">Cyber Theme</option>
                                <option value="custom">Custom...</option>
                            </select>
                            <div id="customThemeContainer" style="display: none;">
                                <input type="text" class="form-control mb-2" id="customTheme" placeholder="Enter custom theme name or XSS payload...">
                            </div>
                            <button class="btn btn-primary" id="applyThemeBtn">Apply Theme</button>
                        </div>
                        
                        <p class="form-text">
                            Try adding a hash to the URL manually: <code>#theme=<script>alert('XSS')</script></code>
                        </p>
                        
                        <div class="demo-result">
                            <div id="themeDisplay">Current theme: None selected</div>
                        </div>
                    </div>
                </section>
                
                <!-- XSS Payloads -->
                <section id="payloads" class="mb-5">
                    <h2>XSS Payloads for Different Security Levels</h2>
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
                            <p>At low security level, there is minimal or no input validation or sanitization, making basic XSS payloads effective:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Basic Alert</h5>
                                    <div class="payload-code">&lt;script&gt;alert('XSS')&lt;/script&gt;</div>
                                    <p class="payload-description">The most basic XSS payload that triggers an alert dialog. Works in low security environments with no filtering.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<script>alert('XSS')</script>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<script>alert('XSS')</script>">Try in Stored</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Image Tag with Event Handler</h5>
                                    <div class="payload-code">&lt;img src="x" onerror="alert('XSS')"&gt;</div>
                                    <p class="payload-description">This payload uses an image with an invalid source, triggering the onerror event to execute JavaScript.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<img src='x' onerror=&quot;alert('XSS')&quot;>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<img src='x' onerror=&quot;alert('XSS')&quot;>">Try in Stored</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>JavaScript Protocol in Link</h5>
                                    <div class="payload-code">&lt;a href="javascript:alert('XSS')"&gt;Click me&lt;/a&gt;</div>
                                    <p class="payload-description">Uses the JavaScript protocol in a link to execute code when clicked.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<a href=&quot;javascript:alert('XSS')&quot;>Click me</a>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<a href=&quot;javascript:alert('XSS')&quot;>Click me</a>">Try in Stored</button>
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
                                    <h5>Case Manipulation</h5>
                                    <div class="payload-code">&lt;ScRiPt&gt;alert('XSS')&lt;/ScRiPt&gt;</div>
                                    <p class="payload-description">Bypasses filters that only check for lowercase tags using mixed case to evade detection.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<ScRiPt>alert('XSS')</ScRiPt>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<ScRiPt>alert('XSS')</ScRiPt>">Try in Stored</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Alternative Event Handlers</h5>
                                    <div class="payload-code">&lt;div onmouseover="alert('XSS')"&gt;Hover over me&lt;/div&gt;</div>
                                    <p class="payload-description">Uses less common event handlers to bypass filters that only block common ones like onclick or onerror.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<div onmouseover=&quot;alert('XSS')&quot;>Hover over me</div>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<div onmouseover=&quot;alert('XSS')&quot;>Hover over me</div>">Try in Stored</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Unusual Tags with Events</h5>
                                    <div class="payload-code">&lt;svg onload="alert('XSS')"&gt;</div>
                                    <p class="payload-description">Uses less commonly filtered tags like SVG with event handlers to execute JavaScript.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<svg onload=&quot;alert('XSS')&quot;>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<svg onload=&quot;alert('XSS')&quot;>">Try in Stored</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- High Security Payloads -->
                        <div class="tab-pane fade" id="high" role="tabpanel">
                            <div class="security-badge-large high mb-3">
                                <i class="fas fa-shield-alt"></i> High Security Level
                            </div>
                            <p>High security implementations use robust filtering, encoding, and CSP. Bypassing requires advanced techniques:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>HTML Entity Encoding</h5>
                                    <div class="payload-code">&lt;img src="x" onerror="&#97;&#108;&#101;&#114;&#116;&#40;&#39;&#88;&#83;&#83;&#39;&#41;"&gt;</div>
                                    <p class="payload-description">Uses HTML entity encoding to bypass filters that check for specific strings like "alert".</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<img src=&quot;x&quot; onerror=&quot;&#97;&#108;&#101;&#114;&#116;&#40;&#39;&#88;&#83;&#83;&#39;&#41;&quot;>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<img src=&quot;x&quot; onerror=&quot;&#97;&#108;&#101;&#114;&#116;&#40;&#39;&#88;&#83;&#83;&#39;&#41;&quot;>">Try in Stored</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>JavaScript Template Exploit</h5>
                                    <div class="payload-code">&lt;script&gt;${alert`XSS`}&lt;/script&gt;</div>
                                    <p class="payload-description">Uses JavaScript template literals to execute code in environments with strict filtering.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<script>${alert`XSS`}</script>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<script>${alert`XSS`}</script>">Try in Stored</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>CSS Injection with Expression</h5>
                                    <div class="payload-code">&lt;style&gt;@keyframes x{}&lt;/style&gt;&lt;div style="animation-name:x" onanimationstart="alert('XSS')"&gt;</div>
                                    <p class="payload-description">Uses CSS animations to trigger JavaScript execution, bypassing filters that focus on common vectors.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="reflected" data-payload="<style>@keyframes x{}</style><div style=&quot;animation-name:x&quot; onanimationstart=&quot;alert('XSS')&quot;></div>">Try in Reflected</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="stored" data-payload="<style>@keyframes x{}</style><div style=&quot;animation-name:x&quot; onanimationstart=&quot;alert('XSS')&quot;></div>">Try in Stored</button>
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
                                <p>At this level, there is no input validation or sanitization. User input is directly included in the output:</p>
                                
                                <div class="code-block-header">
                                    <span>Low Security Code</span>
                                    <span>XSS.php - Low</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// LOW security - Vulnerable to XSS
function displayUserInput($input) {
    // User input directly inserted into HTML without sanitization
    echo "&lt;div class='user-input'>" . $input . "&lt;/div>";
}

// For stored XSS
function saveUserInput($username, $comment) {
    // Store to database without sanitization
    $query = "INSERT INTO comments (username, comment) VALUES ('$username', '$comment')";
    // Execute query
}

// For DOM-based XSS
function outputJavaScript() {
    echo "&lt;script>
        let theme = location.hash.substr(1);
        document.getElementById('theme-container').innerHTML = 'Theme: ' + theme;
    &lt;/script>";
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-danger">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">No input validation or sanitization is performed, allowing virtually any XSS payload to be executed. This is extremely dangerous in production environments.</p>
                            </div>
                        </div>
                        
                        <!-- Medium Security Implementation -->
                        <div class="tab-pane fade" id="sec-medium" role="tabpanel">
                            <div class="mb-4">
                                <h4>Medium Security Implementation</h4>
                                <p>At this level, basic filtering is applied but can be bypassed with more sophisticated techniques:</p>
                                
                                <div class="code-block-header">
                                    <span>Medium Security Code</span>
                                    <span>XSS.php - Medium</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// MEDIUM security - Basic filtering but still vulnerable
function displayUserInput($input) {
    // Basic filtering: Strip &lt;script> tags
    $filtered = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $input);
    
    // Output with basic filtering
    echo "&lt;div class='user-input'>" . $filtered . "&lt;/div>";
}

// For stored XSS
function saveUserInput($username, $comment) {
    // Basic filtering before storing
    $safeUsername = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $username);
    $safeComment = preg_replace('/<script\b[^>]*>(.*?)<\/script>/i', "", $comment);
    
    // Store to database with basic filtering
    $query = "INSERT INTO comments (username, comment) VALUES ('$safeUsername', '$safeComment')";
    // Execute query
}

// For DOM-based XSS
function outputJavaScript() {
    echo "&lt;script>
        let theme = location.hash.substr(1);
        // Basic attempt to prevent XSS
        theme = theme.replace(/</g, '&lt;').replace(/>/g, '&gt;');
        document.getElementById('theme-container').innerHTML = 'Theme: ' + theme;
    &lt;/script>";
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">The filtering only blocks &lt;script&gt; tags but can be bypassed using alternative vectors like event handlers (onerror, onload), or other ways to execute JavaScript. The regex-based approach is insufficient.</p>
                            </div>
                        </div>
                        
                        <!-- High Security Implementation -->
                        <div class="tab-pane fade" id="sec-high" role="tabpanel">
                            <div class="mb-4">
                                <h4>High Security Implementation</h4>
                                <p>At this level, proper input validation, sanitization, and output encoding are implemented:</p>
                                
                                <div class="code-block-header">
                                    <span>High Security Code</span>
                                    <span>XSS.php - High</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// HIGH security - Proper sanitization and encoding
function displayUserInput($input) {
    // Convert special characters to HTML entities
    $safe = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    
    // Output with proper encoding
    echo "&lt;div class='user-input'>" . $safe . "&lt;/div>";
}

// For stored XSS
function saveUserInput($username, $comment) {
    // Proper sanitization before storing
    $safeUsername = htmlspecialchars($username, ENT_QUOTES, 'UTF-8');
    $safeComment = htmlspecialchars($comment, ENT_QUOTES, 'UTF-8');
    
    // Use prepared statements to prevent SQL injection
    $stmt = $db->prepare("INSERT INTO comments (username, comment) VALUES (?, ?)");
    $stmt->bind_param("ss", $safeUsername, $safeComment);
    $stmt->execute();
}

// For DOM-based XSS
function outputJavaScript() {
    echo "&lt;script>
        let theme = location.hash.substr(1);
        // Proper DOM manipulation to prevent XSS
        const element = document.getElementById('theme-container');
        // Create a text node instead of using innerHTML
        const textNode = document.createTextNode('Theme: ' + theme);
        // Clear previous content
        element.innerHTML = '';
        // Append the text node
        element.appendChild(textNode);
    &lt;/script>";
    
    // Additionally, implement Content Security Policy
    header("Content-Security-Policy: default-src 'self'; script-src 'self'");
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-success">
                                <h5><i class="fas fa-shield-alt me-2"></i> Protection Measures</h5>
                                <ul class="mb-0">
                                    <li><strong>Output Encoding:</strong> Uses htmlspecialchars() with ENT_QUOTES to encode all special characters</li>
                                    <li><strong>Safe DOM Manipulation:</strong> Uses createTextNode() instead of innerHTML to prevent script execution</li>
                                    <li><strong>Content Security Policy:</strong> Restricts which scripts can run to mitigate XSS</li>
                                    <li><strong>Prepared Statements:</strong> Uses parameterized queries for database operations</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Mitigation -->
                <section id="mitigation" class="mb-5">
                    <h2>XSS Mitigation Strategies</h2>
                    <p>To protect your applications from XSS vulnerabilities, implement these best practices:</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-shield-alt me-2"></i>Input Validation</h4>
                                    <ul class="mb-0">
                                        <li>Validate input against whitelists of allowed values/patterns</li>
                                        <li>Reject invalid input rather than attempting to clean it</li>
                                        <li>Validate on both client and server sides</li>
                                        <li>Use type checking and length restrictions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-code me-2"></i>Output Encoding</h4>
                                    <ul class="mb-0">
                                        <li>Use context-appropriate encoding (HTML, JavaScript, CSS, URL)</li>
                                        <li>In PHP, use htmlspecialchars() with ENT_QUOTES flag</li>
                                        <li>In JavaScript, use textContent instead of innerHTML</li>
                                        <li>Encode data before inserting into HTML attributes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-lock me-2"></i>Content Security Policy (CSP)</h4>
                                    <ul class="mb-0">
                                        <li>Implement CSP headers to restrict script sources</li>
                                        <li>Use nonce-based or hash-based CSP for inline scripts</li>
                                        <li>Disable unsafe-inline and unsafe-eval</li>
                                        <li>Set report-uri to monitor CSP violations</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-cookie me-2"></i>Cookie Protection</h4>
                                    <ul class="mb-0">
                                        <li>Set the HttpOnly flag to prevent JavaScript access</li>
                                        <li>Use the Secure flag to ensure cookies are sent only over HTTPS</li>
                                        <li>Set SameSite attribute to Strict or Lax</li>
                                        <li>Use short expiration times for session cookies</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Defense in Depth</h5>
                        <p class="mb-0">Never rely on a single defense mechanism. Implement multiple layers of protection to mitigate XSS vulnerabilities effectively. Regularly test your applications with both automated scanners and manual penetration testing.</p>
                    </div>
                </section>
                
                <!-- References -->
                <section id="references">
                    <h2>References and Resources</h2>
                    <p>Learn more about XSS from these authoritative sources:</p>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Official Resources</h5>
                            <ul class="mb-0">
                                <li><a href="https://owasp.org/www-community/attacks/xss/" target="_blank">OWASP XSS Prevention Cheat Sheet</a></li>
                                <li><a href="https://portswigger.net/web-security/cross-site-scripting" target="_blank">PortSwigger Web Security Academy - XSS</a></li>
                                <li><a href="https://developer.mozilla.org/en-US/docs/Web/Security/Types_of_attacks#Cross-site_scripting_XSS" target="_blank">MDN Web Docs - Cross-site scripting</a></li>
                                <li><a href="https://cheatsheetseries.owasp.org/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html" target="_blank">OWASP XSS Prevention Cheat Sheet</a></li>
                                <li><a href="https://content-security-policy.com/" target="_blank">Content Security Policy Reference</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Practice Platforms</h5>
                            <ul class="mb-0">
                                <li><a href="https://www.hacksplaining.com/exercises/xss-stored" target="_blank">Hacksplaining - XSS Interactive Lessons</a></li>
                                <li><a href="https://xss-game.appspot.com/" target="_blank">Google XSS Game</a></li>
                                <li><a href="https://github.com/OWASP/DVWA" target="_blank">DVWA - Damn Vulnerable Web Application</a></li>
                                <li><a href="https://portswigger.net/web-security/all-labs#cross-site-scripting" target="_blank">PortSwigger Web Security Labs - XSS</a></li>
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
            
            // Setup XSS demos
            setupReflectedXssDemo();
            setupStoredXssDemo();
            setupDomXssDemo();
            
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
        
        // Handle reflected XSS demo
        function setupReflectedXssDemo() {
            const form = document.getElementById('reflectedXssForm');
            const resultDiv = document.getElementById('reflectedXssResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const searchQuery = document.getElementById('searchQuery').value;
                    let sanitizedQuery = '';
                    let xssDetected = false;
                    
                    // Apply different sanitization based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // No sanitization at low level
                            sanitizedQuery = searchQuery;
                            // Check if this might be an XSS attempt
                            xssDetected = checkForXssAttempt(searchQuery);
                            break;
                            
                        case 'medium':
                            // Basic sanitization at medium level - strip <script> tags
                            sanitizedQuery = searchQuery.replace(/<script\b[^>]*>(.*?)<\/script>/gi, "");
                            // Check if we blocked an XSS attempt but if other vectors still work
                            xssDetected = searchQuery !== sanitizedQuery ? false : checkForXssAttempt(sanitizedQuery);
                            break;
                            
                        case 'high':
                            // Strong sanitization at high level
                            sanitizedQuery = escapeHtml(searchQuery);
                            // No XSS should work at high level except for very sophisticated attacks
                            xssDetected = false;
                            break;
                    }
                    
                    // Display the results
                    if (searchQuery.trim() !== '') {
                        resultDiv.innerHTML = `
                            <div class="mb-3">
                                <h5>Search Results for: ${sanitizedQuery}</h5>
                                <p>No matching transactions found.</p>
                            </div>
                        `;
                    } else {
                        resultDiv.innerHTML = '<div class="text-center text-muted">Please enter a search term</div>';
                    }
                    
                    // Show XSS detection message if applicable
                    if (xssDetected) {
                        showXssDetection();
                    }
                });
            }
        }
        
        // Handle stored XSS demo
        function setupStoredXssDemo() {
            const form = document.getElementById('storedXssForm');
            const resultDiv = document.getElementById('storedXssResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const username = document.getElementById('username').value || 'Anonymous';
                    const comment = document.getElementById('comment').value;
                    
                    if (!comment.trim()) {
                        alert('Please enter a comment');
                        return;
                    }
                    
                    let sanitizedUsername = '';
                    let sanitizedComment = '';
                    let xssDetected = false;
                    
                    // Apply different sanitization based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // No sanitization at low level
                            sanitizedUsername = username;
                            sanitizedComment = comment;
                            // Check if this might be an XSS attempt
                            xssDetected = checkForXssAttempt(comment);
                            break;
                            
                        case 'medium':
                            // Basic sanitization at medium level - strip <script> tags
                            sanitizedUsername = username.replace(/<script\b[^>]*>(.*?)<\/script>/gi, "");
                            sanitizedComment = comment.replace(/<script\b[^>]*>(.*?)<\/script>/gi, "");
                            // Check if we blocked an XSS attempt but if other vectors still work
                            xssDetected = comment !== sanitizedComment ? false : checkForXssAttempt(sanitizedComment);
                            break;
                            
                        case 'high':
                            // Strong sanitization at high level
                            sanitizedUsername = escapeHtml(username);
                            sanitizedComment = escapeHtml(comment);
                            // No XSS should work at high level except for very sophisticated attacks
                            xssDetected = false;
                            break;
                    }
                    
                    // Add the new comment to the list
                    const newComment = document.createElement('div');
                    newComment.className = 'card mb-2';
                    newComment.innerHTML = `
                        <div class="card-body">
                            <h5 class="card-title">${sanitizedUsername}</h5>
                            <p class="card-text">${sanitizedComment}</p>
                            <small class="text-muted">Posted just now</small>
                        </div>
                    `;
                    
                    // Add the new comment at the top
                    resultDiv.insertBefore(newComment, resultDiv.firstChild);
                    
                    // Reset the form
                    form.reset();
                    
                    // Show XSS detection message if applicable
                    if (xssDetected) {
                        showXssDetection();
                    }
                });
            }
        }
        
        // Handle DOM-based XSS demo
        function setupDomXssDemo() {
            const themeSelector = document.getElementById('themeSelector');
            const customThemeContainer = document.getElementById('customThemeContainer');
            const customTheme = document.getElementById('customTheme');
            const applyThemeBtn = document.getElementById('applyThemeBtn');
            const themeDisplay = document.getElementById('themeDisplay');
            
            if (themeSelector && customThemeContainer && customTheme && applyThemeBtn && themeDisplay) {
                // Show/hide custom theme input based on selection
                themeSelector.addEventListener('change', function() {
                    if (this.value === 'custom') {
                        customThemeContainer.style.display = 'block';
                    } else {
                        customThemeContainer.style.display = 'none';
                    }
                });
                
                // Apply theme button click handler
                applyThemeBtn.addEventListener('click', function() {
                    let theme = '';
                    
                    if (themeSelector.value === 'custom') {
                        theme = customTheme.value;
                    } else if (themeSelector.value) {
                        theme = themeSelector.value;
                    } else {
                        theme = 'None selected';
                    }
                    
                    // Apply different sanitization based on security level
                    let xssDetected = false;
                    
                    switch (currentSecurityLevel) {
                        case 'low':
                            // Vulnerable: directly setting innerHTML with user input
                            themeDisplay.innerHTML = 'Current theme: ' + theme;
                            xssDetected = checkForXssAttempt(theme);
                            break;
                            
                        case 'medium':
                            // Basic sanitization: replace < and > with entities
                            const mediumSanitized = theme.replace(/</g, '&lt;').replace(/>/g, '&gt;');
                            themeDisplay.innerHTML = 'Current theme: ' + mediumSanitized;
                            // Some XSS can still work with certain bypasses
                            xssDetected = false;
                            break;
                            
                        case 'high':
                            // Secure: using textContent instead of innerHTML
                            themeDisplay.textContent = 'Current theme: ' + theme;
                            xssDetected = false;
                            break;
                    }
                    
                    // Show XSS detection message if applicable
                    if (xssDetected) {
                        showXssDetection();
                    }
                });
                
                // Check if there's a theme parameter in the URL hash
                const checkUrlHash = function() {
                    if (window.location.hash) {
                        const hash = window.location.hash.substring(1);
                        const params = new URLSearchParams(hash);
                        const theme = params.get('theme');
                        
                        if (theme) {
                            let xssDetected = false;
                            
                            // Apply different sanitization based on security level
                            switch (currentSecurityLevel) {
                                case 'low':
                                    // Vulnerable: directly setting innerHTML with user input
                                    themeDisplay.innerHTML = 'Current theme: ' + theme;
                                    xssDetected = checkForXssAttempt(theme);
                                    break;
                                    
                                case 'medium':
                                    // Basic sanitization: replace < and > with entities
                                    const mediumSanitized = theme.replace(/</g, '&lt;').replace(/>/g, '&gt;');
                                    themeDisplay.innerHTML = 'Current theme: ' + mediumSanitized;
                                    xssDetected = false;
                                    break;
                                    
                                case 'high':
                                    // Secure: using textContent instead of innerHTML
                                    themeDisplay.textContent = 'Current theme: ' + theme;
                                    xssDetected = false;
                                    break;
                            }
                            
                            // Show XSS detection message if applicable
                            if (xssDetected) {
                                showXssDetection();
                            }
                        }
                    }
                };
                
                // Check hash on page load
                checkUrlHash();
                
                // Check hash on hash change
                window.addEventListener('hashchange', checkUrlHash);
            }
        }
        
        // Setup payload buttons
        function setupPayloadButtons() {
            const payloadButtons = document.querySelectorAll('.try-payload');
            
            payloadButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const target = this.getAttribute('data-target');
                    const payload = this.getAttribute('data-payload');
                    
                    if (target === 'reflected') {
                        document.getElementById('searchQuery').value = payload;
                        document.getElementById('reflectedXssForm').dispatchEvent(new Event('submit'));
                    } else if (target === 'stored') {
                        document.getElementById('username').value = 'Test User';
                        document.getElementById('comment').value = payload;
                        document.getElementById('storedXssForm').dispatchEvent(new Event('submit'));
                    }
                });
            });
        }
        
        // Helper function to escape HTML special characters
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }
        
        // Helper function to check if the input might be an XSS attempt
        function checkForXssAttempt(input) {
            // Simple check for common XSS patterns
            const xssPatterns = [
                /<script/i,
                /javascript:/i,
                /onerror/i,
                /onload/i,
                /onclick/i,
                /onmouseover/i,
                /<img/i,
                /<svg/i,
                /<iframe/i,
                /alert\(/i,
                /eval\(/i,
                /document\.cookie/i
            ];
            
            return xssPatterns.some(pattern => pattern.test(input));
        }
        
        // Show XSS detection alert
        function showXssDetection() {
            const xssDetection = document.getElementById('xssDetection');
            
            if (xssDetection) {
                xssDetection.style.display = 'block';
                
                // Hide after 5 seconds
                setTimeout(() => {
                    xssDetection.style.display = 'none';
                }, 5000);
            }
        }
    </script>
</body>
</html>