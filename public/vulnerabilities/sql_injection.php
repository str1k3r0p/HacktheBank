<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection - HackMeBank</title>
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
        /* Additional styles specific to the SQL Injection vulnerability page */
        .sql-header {
            background: linear-gradient(135deg, rgba(0, 204, 255, 0.3) 0%, rgba(153, 51, 255, 0.3) 100%);
            border-radius: 5px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .sql-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('../assets/images/database-pattern.png');
            background-size: cover;
            opacity: 0.1;
            z-index: -1;
        }

        .sql-header h1 {
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            text-shadow: 0 0 15px rgba(0, 204, 255, 0.7);
        }

        .sql-header p {
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

        .sql-type-section {
            margin-bottom: 2.5rem;
        }

        .sql-type-icon {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .sql-type-title {
            display: flex;
            align-items: center;
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            margin-bottom: 1rem;
            color: var(--cyber-primary);
        }

        .sql-type-title i {
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

        .sql-demo-container {
            background-color: rgba(19, 19, 56, 0.5);
            border: 1px solid var(--cyber-text-dim);
            border-radius: 5px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .sql-demo-title {
            font-family: var(--cyber-font-mono);
            font-size: 1.1rem;
            color: var(--cyber-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .sql-demo-title i {
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
            background-color: rgba(0, 204, 255, 0.1);
            border-color: var(--cyber-primary);
            color: var(--cyber-primary);
        }

        .side-nav-link i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
        }
        
        /* Success message for SQL Injection detection */
        .sql-detection {
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

        /* Database table styling */
        .db-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .db-table th {
            background-color: rgba(0, 204, 255, 0.1);
            color: var(--cyber-primary);
            font-family: var(--cyber-font-mono);
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid var(--cyber-text-dim);
        }

        .db-table td {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: var(--cyber-text);
        }

        .db-table tr:last-child td {
            border-bottom: none;
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
                            <li><a class="dropdown-item active" href="sql_injection.php">SQL Injection</a></li>
                            <li><a class="dropdown-item" href="xss.php">XSS</a></li>
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

    <!-- SQL Injection Detection Alert (hidden by default) -->
    <div class="sql-detection" id="sqlDetection">
        <i class="fas fa-check-circle me-2"></i> SQL Injection Detected!
        <div class="mt-2 small">The current security level allowed execution of your payload.</div>
    </div>

    <!-- Main content -->
    <main class="container mt-4 mb-5">
        <!-- SQL Injection Header -->
        <div class="sql-header">
            <h1><i class="fas fa-database me-3"></i>SQL Injection</h1>
            <p>SQL Injection is a code injection technique that exploits security vulnerabilities in an application's software by inserting malicious SQL statements into entry fields. This can lead to unauthorized data access, data manipulation, and in some cases, complete system compromise.</p>
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
                            <a href="#sql-types" class="side-nav-link">
                                <i class="fas fa-layer-group"></i> SQL Injection Types
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#union-based" class="side-nav-link">
                                <i class="fas fa-object-group"></i> Union-Based
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#error-based" class="side-nav-link">
                                <i class="fas fa-exclamation-triangle"></i> Error-Based
                            </a>
                        </li>
                        <li class="side-nav-item">
                            <a href="#blind-sql" class="side-nav-link">
                                <i class="fas fa-eye-slash"></i> Blind SQL Injection
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
                    <h2>Introduction to SQL Injection</h2>
                    <p>SQL Injection (SQLi) occurs when an attacker is able to insert or "inject" malicious SQL code into a query that an application sends to its database. This happens when user input is incorrectly filtered or sanitized before being used in SQL statements.</p>
                    
                    <p>When successful, SQL injection can allow attackers to:</p>
                    <ul>
                        <li>Access unauthorized data, including sensitive customer information, user lists, or private data</li>
                        <li>Modify database data (insert, update, delete)</li>
                        <li>Execute administration operations on the database (shutdown, load files, etc.)</li>
                        <li>Recover the content of a given file present on the database server</li>
                        <li>In some cases, issue commands to the operating system</li>
                    </ul>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Key Impact in Banking Applications:</strong> SQL injection in banking applications can lead to unauthorized access to customer accounts, financial records, transaction histories, and confidential information. Attackers may be able to transfer funds, change account details, or create fraudulent transactions.
                    </div>
                </section>
                
                <!-- SQL Injection Types -->
                <section id="sql-types" class="mb-5">
                    <h2>Types of SQL Injection Vulnerabilities</h2>
                    <p>There are several types of SQL injection attacks, each with different techniques and impacts:</p>
                    
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="sql-type-icon"><i class="fas fa-object-group"></i></div>
                                    <h3 class="card-title">Union-Based</h3>
                                    <p class="card-text">Uses the UNION SQL operator to combine results from multiple SELECT statements to return data from different database tables.</p>
                                    <a href="#union-based" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="sql-type-icon"><i class="fas fa-exclamation-triangle"></i></div>
                                    <h3 class="card-title">Error-Based</h3>
                                    <p class="card-text">Exploits error messages returned by the database to extract information about the database structure and data.</p>
                                    <a href="#error-based" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="sql-type-icon"><i class="fas fa-eye-slash"></i></div>
                                    <h3 class="card-title">Blind SQL Injection</h3>
                                    <p class="card-text">Used when the application doesn't display database error messages. Includes Boolean-based and Time-based techniques.</p>
                                    <a href="#blind-sql" class="btn btn-primary">Learn More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Union-Based SQL Injection -->
                <section id="union-based" class="sql-type-section">
                    <h2 class="sql-type-title"><i class="fas fa-object-group"></i> Union-Based SQL Injection</h2>
                    
                    <p>Union-based SQL injection is one of the most common and powerful techniques. It leverages the UNION SQL operator to combine the results of the original query with results from an injected query, allowing attackers to extract data from different database tables.</p>
                    
                    <h4 class="mb-3">How Union-Based SQL Injection Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>The attacker identifies a vulnerable parameter in a web application</li>
                                <li>The attacker determines the number of columns in the original query using ORDER BY or direct UNION attempts</li>
                                <li>The attacker crafts a UNION query to extract data from other tables</li>
                                <li>The application processes both queries and returns the combined results</li>
                                <li>The attacker can see data from different tables in the application's response</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Key Requirements</h5>
                                    <ul class="mb-0">
                                        <li>The injected UNION query must have the same number of columns as the original query</li>
                                        <li>The data types in each column of the injected query must be compatible with the original query</li>
                                        <li>The attacker must know or discover table and column names</li>
                                        <li>The application must display the results of the query to the user</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>account_details.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - direct user input in SQL query
$accountId = $_GET['id'];

// Connection to database
$connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');

// Vulnerable query - no sanitization of user input
$query = "SELECT account_number, account_type, balance FROM accounts 
          WHERE account_id = $accountId";
          
$result = mysqli_query($connection, $query);

// Display results
echo "&lt;h2>Account Details&lt;/h2>";
echo "&lt;table class='table'>";
echo "&lt;tr>&lt;th>Account Number&lt;/th>&lt;th>Type&lt;/th>&lt;th>Balance&lt;/th>&lt;/tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "&lt;tr>";
    echo "&lt;td>" . $row['account_number'] . "&lt;/td>";
    echo "&lt;td>" . $row['account_type'] . "&lt;/td>";
    echo "&lt;td>$" . $row['balance'] . "&lt;/td>";
    echo "&lt;/tr>";
}

echo "&lt;/table>";
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Union-Based SQL Injection Demo -->
                    <div class="sql-demo-container">
                        <h4 class="sql-demo-title"><i class="fas fa-flask"></i> Union-Based SQL Injection Demonstration</h4>
                        <p>This account lookup feature is vulnerable to union-based SQL injection. Try entering different payloads based on the security level.</p>
                        
                        <form id="unionSqlForm" class="mb-3">
                            <div class="mb-3">
                                <label for="accountId" class="form-label">Enter Account ID</label>
                                <input type="text" class="form-control" id="accountId" name="accountId" placeholder="Enter account ID or SQL injection payload...">
                            </div>
                            <button class="btn btn-primary" type="submit">Lookup Account</button>
                            <div class="form-text">
                                Try payloads like: <code>1 UNION SELECT username, password, user_id FROM users</code>
                            </div>
                        </form>
                        
                        <div class="demo-result" id="unionSqlResult">
                            <!-- Account lookup results will appear here -->
                            <div class="text-center text-muted">Enter an account ID above to see results</div>
                        </div>
                    </div>
                </section>
                
                <!-- Error-Based SQL Injection -->
                <section id="error-based" class="sql-type-section">
                    <h2 class="sql-type-title"><i class="fas fa-exclamation-triangle"></i> Error-Based SQL Injection</h2>
                    
                    <p>Error-based SQL injection is a technique that forces the database to generate an error that reveals information about the database structure or data. This technique is particularly useful when the error messages are displayed to the user.</p>
                    
                    <h4 class="mb-3">How Error-Based SQL Injection Works</h4>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <ol>
                                <li>The attacker identifies a vulnerable parameter in a web application</li>
                                <li>The attacker crafts input that will cause a database error</li>
                                <li>The error message contains information about the database structure, version, or data</li>
                                <li>The attacker uses this information to refine further attacks</li>
                                <li>Through carefully constructed queries, the attacker can extract substantial data through error messages</li>
                            </ol>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Common Error-Based Techniques</h5>
                                    <ul class="mb-0">
                                        <li>Using type conversion errors (e.g., CAST functions)</li>
                                        <li>Exploiting XML functions (extractvalue, updatexml)</li>
                                        <li>Causing arithmetic errors (division by zero)</li>
                                        <li>Leveraging string manipulation functions</li>
                                        <li>Using database-specific error functions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>search_transactions.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code - shows database errors to users
$transactionId = $_GET['id'];

// Connection to database
$connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');

// Vulnerable query
$query = "SELECT * FROM transactions WHERE transaction_id = $transactionId";

// Error display is turned on
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $result = mysqli_query($connection, $query);
    
    // Display results
    // ...
} catch (mysqli_sql_exception $e) {
    // Error message is displayed to the user - reveals database information
    echo "&lt;div class='alert alert-danger'>";
    echo "Error: " . $e->getMessage();
    echo "&lt;/div>";
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Error-Based SQL Injection Demo -->
                    <div class="sql-demo-container">
                        <h4 class="sql-demo-title"><i class="fas fa-flask"></i> Error-Based SQL Injection Demonstration</h4>
                        <p>This transaction lookup feature is vulnerable to error-based SQL injection. Try entering different payloads to cause informative errors.</p>
                        
                        <form id="errorSqlForm" class="mb-3">
                            <div class="mb-3">
                                <label for="transactionId" class="form-label">Enter Transaction ID</label>
                                <input type="text" class="form-control" id="transactionId" name="transactionId" placeholder="Enter transaction ID or SQL injection payload...">
                            </div>
                            <button class="btn btn-primary" type="submit">Lookup Transaction</button>
                            <div class="form-text">
                                Try payloads like: <code>1 AND EXTRACTVALUE(1, CONCAT(0x7e, (SELECT version()), 0x7e))</code>
                            </div>
                        </form>
                        
                        <div class="demo-result" id="errorSqlResult">
                            <!-- Transaction lookup results will appear here -->
                            <div class="text-center text-muted">Enter a transaction ID above to see results</div>
                        </div>
                    </div>
                </section>
                
                <!-- Blind SQL Injection -->
                <section id="blind-sql" class="sql-type-section">
                    <h2 class="sql-type-title"><i class="fas fa-eye-slash"></i> Blind SQL Injection</h2>
                    
                    <p>Blind SQL injection occurs when an application is vulnerable to SQL injection, but its error messages or responses don't reveal information about the database structure or query results directly. There are two main types: Boolean-based and Time-based.</p>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-toggle-on me-2"></i>Boolean-Based Blind</h4>
                                    <p>This technique relies on sending an SQL query that forces the application to return a different result depending on whether the query returns TRUE or FALSE. By asking a series of TRUE/FALSE questions, an attacker can extract data one character at a time.</p>
                                    <p class="mb-0"><strong>Example:</strong> <code>id=1 AND (SELECT SUBSTRING(username,1,1) FROM users WHERE id=1)='a'</code></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-clock me-2"></i>Time-Based Blind</h4>
                                    <p>This technique relies on sending an SQL query that causes the database to wait for a specified amount of time before responding. The attacker can infer TRUE or FALSE based on the response time.</p>
                                    <p class="mb-0"><strong>Example:</strong> <code>id=1 AND IF((SELECT SUBSTRING(username,1,1) FROM users WHERE id=1)='a', SLEEP(5), 0)</code></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h4 class="mb-3">Vulnerable Code Example</h4>
                    
                    <div class="mb-4">
                        <div class="code-block-header">
                            <span>Vulnerable PHP Code</span>
                            <span>check_account.php</span>
                        </div>
                        <div class="code-block">
                            <pre><code class="language-php">&lt;?php
// Vulnerable code for blind SQL injection
$accountNumber = $_POST['account'];

// Connection to database
$connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');

// Vulnerable query
$query = "SELECT * FROM accounts WHERE account_number = '$accountNumber'";
$result = mysqli_query($connection, $query);

// Response doesn't reveal data, just whether account exists
if (mysqli_num_rows($result) > 0) {
    echo "Account exists.";
} else {
    echo "Account not found.";
}
?&gt;</code></pre>
                        </div>
                    </div>
                    
                    <!-- Blind SQL Injection Demo -->
                    <div class="sql-demo-container">
                        <h4 class="sql-demo-title"><i class="fas fa-flask"></i> Blind SQL Injection Demonstration</h4>
                        <p>This account verification feature is vulnerable to blind SQL injection. Try Boolean-based or Time-based payloads.</p>
                        
                        <form id="blindSqlForm" class="mb-3">
                            <div class="mb-3">
                                <label for="accountNumber" class="form-label">Enter Account Number</label>
                                <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="Enter account number or SQL injection payload...">
                            </div>
                            <button class="btn btn-primary" type="submit">Verify Account</button>
                            <div class="form-text">
                                Try Boolean payloads like: <code>123456' AND (SELECT SUBSTRING(username,1,1) FROM users LIMIT 1)='a</code><br>
                                Or Time-based: <code>123456' AND (SELECT SLEEP(2))--</code>
                            </div>
                        </form>
                        
                        <div class="demo-result" id="blindSqlResult">
                            <!-- Account verification results will appear here -->
                            <div class="text-center text-muted">Enter an account number above to verify</div>
                        </div>
                    </div>
                </section>
                
                <!-- SQL Injection Payloads -->
                <section id="payloads" class="mb-5">
                    <h2>SQL Injection Payloads for Different Security Levels</h2>
                    <p>Different security levels require different payloads to bypass protections. Here are some examples for each level:</p>
                    
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
                            <p>At low security level, there is minimal or no input validation or sanitization, making basic SQL injection payloads effective:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Basic Authentication Bypass</h5>
                                    <div class="payload-code">admin' OR '1'='1</div>
                                    <p class="payload-description">Simple payload that makes the WHERE clause always evaluate to true, bypassing login authentication.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="union" data-payload="1' OR '1'='1">Try in Union Demo</button>
                                        <button class="btn btn-sm btn-primary try-payload" data-target="error" data-payload="1' OR '1'='1">Try in Error Demo</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Basic UNION Attack</h5>
                                    <div class="payload-code">1 UNION SELECT 1,2,3</div>
                                    <p class="payload-description">Tests if UNION attacks are possible by attempting to combine original query with a second one.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="union" data-payload="1 UNION SELECT 1,2,3">Try in Union Demo</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Basic Data Extraction</h5>
                                    <div class="payload-code">1 UNION SELECT username, password, user_id FROM users</div>
                                    <p class="payload-description">Extracts user credentials from the database using a UNION attack.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="union" data-payload="1 UNION SELECT username, password, user_id FROM users">Try in Union Demo</button>
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
                                    <h5>Comment Termination</h5>
                                    <div class="payload-code">1'; DROP TABLE users-- -</div>
                                    <p class="payload-description">Uses SQL comments to terminate the original query and execute a potentially destructive command.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="error" data-payload="1'; DROP TABLE users-- -">Try in Error Demo</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Case Manipulation</h5>
                                    <div class="payload-code">1 UnIoN SeLeCt username, password, user_id FrOm users</div>
                                    <p class="payload-description">Bypasses filters that only check for lowercase SQL keywords by using mixed case.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="union" data-payload="1 UnIoN SeLeCt username, password, user_id FrOm users">Try in Union Demo</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>String Concatenation</h5>
                                    <div class="payload-code">1 UNION SELECT CONCAT('a','b','c'), CONCAT('us','er'), CONCAT('pa','ss') FROM users</div>
                                    <p class="payload-description">Bypasses keyword filters by breaking up strings with concatenation functions.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="union" data-payload="1 UNION SELECT CONCAT('a','b','c'), CONCAT('us','er'), CONCAT('pa','ss') FROM users">Try in Union Demo</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- High Security Payloads -->
                        <div class="tab-pane fade" id="high" role="tabpanel">
                            <div class="security-badge-large high mb-3">
                                <i class="fas fa-shield-alt"></i> High Security Level
                            </div>
                            <p>High security implementations use prepared statements, input validation, and other protections. Bypassing requires advanced techniques:</p>
                            
                            <div class="payload-list">
                                <div class="payload-item">
                                    <h5>Hex Encoding</h5>
                                    <div class="payload-code">1 UNION SELECT 0x75736572, 0x70617373, 0x6964 FROM 0x7573657273</div>
                                    <p class="payload-description">Uses hexadecimal encoding to bypass string filters, representing "user", "pass", "id" and "users".</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="union" data-payload="1 UNION SELECT 0x75736572, 0x70617373, 0x6964 FROM 0x7573657273">Try in Union Demo</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Double Query</h5>
                                    <div class="payload-code">1 AND (SELECT 1 FROM (SELECT COUNT(*),CONCAT(VERSION(),FLOOR(RAND(0)*2))x FROM information_schema.tables GROUP BY x)a)</div>
                                    <p class="payload-description">Uses a subquery and GROUP BY clause to cause an error that reveals database version.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="error" data-payload="1 AND (SELECT 1 FROM (SELECT COUNT(*),CONCAT(VERSION(),FLOOR(RAND(0)*2))x FROM information_schema.tables GROUP BY x)a)">Try in Error Demo</button>
                                    </div>
                                </div>
                                
                                <div class="payload-item">
                                    <h5>Advanced Time-Based</h5>
                                    <div class="payload-code">1 AND IF(SUBSTR(@@version,1,1)='5',BENCHMARK(1000000,SHA1('true')),false)</div>
                                    <p class="payload-description">Uses CPU-intensive functions to create a time delay, allowing data extraction even with high security.</p>
                                    <div class="payload-buttons">
                                        <button class="btn btn-sm btn-primary try-payload" data-target="blind" data-payload="1 AND IF(SUBSTR(@@version,1,1)='5',BENCHMARK(1000000,SHA1('true')),false)">Try in Blind Demo</button>
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
                                <p>At this level, there is no input validation or sanitization. User input is directly included in the SQL query:</p>
                                
                                <div class="code-block-header">
                                    <span>Low Security Code</span>
                                    <span>SQLi.php - Low</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// LOW security - Vulnerable to SQL Injection
function getAccountDetails($accountId) {
    // Connection to database
    $connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');
    
    // Direct inclusion of user input in query - highly vulnerable
    $query = "SELECT account_number, account_type, balance FROM accounts 
              WHERE account_id = $accountId";
              
    $result = mysqli_query($connection, $query);
    
    // Return results
    return $result;
}

function authenticateUser($username, $password) {
    // Connection to database
    $connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');
    
    // Direct concatenation of user input - vulnerable to authentication bypass
    $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    
    $result = mysqli_query($connection, $query);
    
    return (mysqli_num_rows($result) > 0);
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-danger">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">User input is directly inserted into SQL queries without any sanitization or validation. This allows attackers to inject arbitrary SQL code that will be executed by the database.</p>
                            </div>
                        </div>
                        
                        <!-- Medium Security Implementation -->
                        <div class="tab-pane fade" id="sec-medium" role="tabpanel">
                            <div class="mb-4">
                                <h4>Medium Security Implementation</h4>
                                <p>At this level, basic input filtering is applied but can be bypassed with more sophisticated techniques:</p>
                                
                                <div class="code-block-header">
                                    <span>Medium Security Code</span>
                                    <span>SQLi.php - Medium</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// MEDIUM security - Basic filtering but still vulnerable
function getAccountDetails($accountId) {
    // Connection to database
    $connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');
    
    // Basic filtering - remove common SQL keywords
    $filtered = str_ireplace(
        array('union', 'select', 'from', 'where', '--', 'insert', 'delete', 'drop', 'update'), 
        '', 
        $accountId
    );
    
    // Still vulnerable due to incomplete filtering
    $query = "SELECT account_number, account_type, balance FROM accounts 
              WHERE account_id = $filtered";
              
    $result = mysqli_query($connection, $query);
    
    // Return results
    return $result;
}

function authenticateUser($username, $password) {
    // Connection to database
    $connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');
    
    // Basic escaping of input
    $escapedUsername = mysqli_real_escape_string($connection, $username);
    $escapedPassword = mysqli_real_escape_string($connection, $password);
    
    // Still built with string concatenation, but with escaped input
    $query = "SELECT * FROM users WHERE username = '$escapedUsername' AND password = '$escapedPassword'";
    
    $result = mysqli_query($connection, $query);
    
    return (mysqli_num_rows($result) > 0);
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-warning">
                                <h5><i class="fas fa-exclamation-triangle me-2"></i> Vulnerability</h5>
                                <p class="mb-0">The filtering only removes specific keywords and can be bypassed by using alternate syntax, case manipulation, or string concatenation. While mysqli_real_escape_string() prevents some attacks, the query is still built by string concatenation, which is not as secure as prepared statements.</p>
                            </div>
                        </div>
                        
                        <!-- High Security Implementation -->
                        <div class="tab-pane fade" id="sec-high" role="tabpanel">
                            <div class="mb-4">
                                <h4>High Security Implementation</h4>
                                <p>At this level, proper input validation, prepared statements, and parameterized queries are implemented:</p>
                                
                                <div class="code-block-header">
                                    <span>High Security Code</span>
                                    <span>SQLi.php - High</span>
                                </div>
                                <div class="code-block">
                                    <pre><code class="language-php">// HIGH security - Proper prepared statements and validation
function getAccountDetails($accountId) {
    // Connection to database
    $connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');
    
    // Input validation - ensure input is an integer
    if (!is_numeric($accountId)) {
        return false; // Invalid input
    }
    
    // Convert to integer to ensure safety
    $accountId = intval($accountId);
    
    // Prepared statement with parameterized query
    $stmt = $connection->prepare("SELECT account_number, account_type, balance FROM accounts 
                                WHERE account_id = ?");
    $stmt->bind_param("i", $accountId); // 'i' indicates integer type
    $stmt->execute();
    
    // Return results
    $result = $stmt->get_result();
    return $result;
}

function authenticateUser($username, $password) {
    // Connection to database
    $connection = mysqli_connect('localhost', 'dbuser', 'dbpass', 'bank_db');
    
    // Input validation
    if (empty($username) || empty($password) || strlen($username) > 50 || strlen($password) > 50) {
        return false; // Invalid input
    }
    
    // Prepared statement with parameterized query
    $stmt = $connection->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password); // 'ss' indicates string types
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    return (mysqli_num_rows($result) > 0);
}</code></pre>
                                </div>
                            </div>
                            
                            <div class="alert alert-success">
                                <h5><i class="fas fa-shield-alt me-2"></i> Protection Measures</h5>
                                <ul class="mb-0">
                                    <li><strong>Input Validation:</strong> Validates input type and imposes length restrictions</li>
                                    <li><strong>Prepared Statements:</strong> Uses parameterized queries that separate SQL code from data</li>
                                    <li><strong>Type Binding:</strong> Explicitly defines parameter types (integer, string, etc.)</li>
                                    <li><strong>Input Sanitization:</strong> Converts input to appropriate data types (e.g., intval() for integers)</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Mitigation -->
                <section id="mitigation" class="mb-5">
                    <h2>SQL Injection Mitigation Strategies</h2>
                    <p>To protect your applications from SQL injection vulnerabilities, implement these best practices:</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-code me-2"></i>Use Prepared Statements</h4>
                                    <p>Prepared statements with parameterized queries are the most effective way to prevent SQL injection.</p>
                                    <ul class="mb-0">
                                        <li>Separate SQL logic from data</li>
                                        <li>Prevent attackers from changing query structure</li>
                                        <li>Automatically escape special characters</li>
                                        <li>Available in all modern database APIs</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-filter me-2"></i>Input Validation</h4>
                                    <p>Always validate and sanitize user input before using it in database operations.</p>
                                    <ul class="mb-0">
                                        <li>Validate input against expected data types</li>
                                        <li>Use whitelisting instead of blacklisting</li>
                                        <li>Enforce strict type checking</li>
                                        <li>Implement input length restrictions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-user-shield me-2"></i>Principle of Least Privilege</h4>
                                    <p>Limit database permissions to minimize potential damage from successful attacks.</p>
                                    <ul class="mb-0">
                                        <li>Create separate database accounts for different application functions</li>
                                        <li>Use read-only access when only reading is required</li>
                                        <li>Restrict access to system tables and procedures</li>
                                        <li>Regularly audit database permissions</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h4 class="card-title"><i class="fas fa-database me-2"></i>Use ORM Frameworks</h4>
                                    <p>Object-Relational Mapping (ORM) frameworks can provide an additional layer of protection.</p>
                                    <ul class="mb-0">
                                        <li>Abstract database operations</li>
                                        <li>Handle parameterization automatically</li>
                                        <li>Provide type safety mechanisms</li>
                                        <li>Examples: Hibernate, Eloquent, Django ORM</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="alert alert-info">
                        <h5><i class="fas fa-info-circle me-2"></i>Defense in Depth</h5>
                        <p class="mb-0">Don't rely on a single defense mechanism. Implement multiple layers of protection to mitigate SQL injection vulnerabilities effectively. Regular security audits, code reviews, and penetration testing are also essential components of a comprehensive security strategy.</p>
                    </div>
                </section>
                
                <!-- References -->
                <section id="references">
                    <h2>References and Resources</h2>
                    <p>Learn more about SQL injection from these authoritative sources:</p>
                    
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title">Official Resources</h5>
                            <ul class="mb-0">
                                <li><a href="https://owasp.org/www-community/attacks/SQL_Injection" target="_blank">OWASP SQL Injection Prevention Cheat Sheet</a></li>
                                <li><a href="https://portswigger.net/web-security/sql-injection" target="_blank">PortSwigger Web Security Academy - SQL Injection</a></li>
                                <li><a href="https://www.w3schools.com/sql/sql_injection.asp" target="_blank">W3Schools - SQL Injection Tutorial</a></li>
                                <li><a href="https://cheatsheetseries.owasp.org/cheatsheets/SQL_Injection_Prevention_Cheat_Sheet.html" target="_blank">OWASP SQL Injection Prevention Cheat Sheet</a></li>
                                <li><a href="https://www.acunetix.com/websitesecurity/sql-injection/" target="_blank">Acunetix - SQL Injection: A Complete Guide</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Practice Platforms</h5>
                            <ul class="mb-0">
                                <li><a href="https://www.hacksplaining.com/exercises/sql-injection" target="_blank">Hacksplaining - SQL Injection Interactive Lessons</a></li>
                                <li><a href="https://github.com/OWASP/DVWA" target="_blank">DVWA - Damn Vulnerable Web Application</a></li>
                                <li><a href="https://portswigger.net/web-security/all-labs#sql-injection" target="_blank">PortSwigger Web Security Labs - SQL Injection</a></li>
                                <li><a href="https://github.com/sqlmapproject/sqlmap" target="_blank">SQLMap - Automatic SQL Injection Tool</a></li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.25.0/components/prism-sql.min.js"></script>
    
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
            
            // Setup SQL injection demos
            setupUnionSqlDemo();
            setupErrorSqlDemo();
            setupBlindSqlDemo();
            
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
        
        // Handle union-based SQL injection demo
        function setupUnionSqlDemo() {
            const form = document.getElementById('unionSqlForm');
            const resultDiv = document.getElementById('unionSqlResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const accountId = document.getElementById('accountId').value;
                    let sanitizedInput = '';
                    let sqlDetected = false;
                    
                    // Apply different sanitization based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // No sanitization at low level
                            sanitizedInput = accountId;
                            // Check if this might be an SQL injection attempt
                            sqlDetected = checkForSqlInjectionAttempt(accountId);
                            break;
                            
                        case 'medium':
                            // Basic sanitization at medium level - strip common SQL keywords
                            sanitizedInput = accountId.replace(/union|select|from|where|--/gi, "");
                            // Check if we blocked an SQL injection attempt
                            sqlDetected = accountId !== sanitizedInput ? false : checkForSqlInjectionAttempt(sanitizedInput);
                            break;
                            
                        case 'high':
                            // Strong sanitization at high level - only allow numbers
                            if (/^\d+$/.test(accountId)) {
                                sanitizedInput = accountId;
                            } else {
                                resultDiv.innerHTML = '<div class="alert alert-danger">Invalid input. Account ID must be a number.</div>';
                                return;
                            }
                            sqlDetected = false;
                            break;
                    }
                    
                    // Display the results
                    if (sanitizedInput.trim() !== '') {
                        // Simulate a database query result
                        if (sanitizedInput === '1' || sanitizedInput === 1) {
                            // Regular account data
                            resultDiv.innerHTML = `
                                <h5>Account Details</h5>
                                <table class="db-table">
                                    <thead>
                                        <tr>
                                            <th>Account Number</th>
                                            <th>Type</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1001234567</td>
                                            <td>Checking</td>
                                            <td>$12,345.67</td>
                                        </tr>
                                    </tbody>
                                </table>
                            `;
                        } else if (sqlDetected) {
                            // SQL injection simulation based on security level
                            if (sanitizedInput.toLowerCase().includes('union') && 
                                sanitizedInput.toLowerCase().includes('select') && 
                                currentSecurityLevel === 'low') {
                                // Simulate successful UNION-based injection at low security
                                resultDiv.innerHTML = `
                                    <h5>Account Details</h5>
                                    <div class="alert alert-danger mb-3">SQL Injection Detected: Data exposure vulnerability</div>
                                    <table class="db-table">
                                        <thead>
                                            <tr>
                                                <th>Account Number</th>
                                                <th>Type</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1001234567</td>
                                                <td>Checking</td>
                                                <td>$12,345.67</td>
                                            </tr>
                                            <tr>
                                                <td>admin</td>
                                                <td>5f4dcc3b5aa765d61d8327deb882cf99</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>johndoe</td>
                                                <td>e10adc3949ba59abbe56e057f20f883e</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>janedoe</td>
                                                <td>827ccb0eea8a706c4c34a16891f84e7b</td>
                                                <td>3</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                `;
                                
                                // Show SQL injection detection message
                                showSqlDetection();
                            } else {
                                // Account not found
                                resultDiv.innerHTML = '<div class="text-center">No account found with that ID.</div>';
                            }
                        } else {
                            // Account not found
                            resultDiv.innerHTML = '<div class="text-center">No account found with that ID.</div>';
                        }
                    } else {
                        resultDiv.innerHTML = '<div class="text-center text-muted">Please enter an account ID</div>';
                    }
                });
            }
        }
        
        // Handle error-based SQL injection demo
        function setupErrorSqlDemo() {
            const form = document.getElementById('errorSqlForm');
            const resultDiv = document.getElementById('errorSqlResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const transactionId = document.getElementById('transactionId').value;
                    let sqlDetected = false;
                    
                    // Check if this might be an SQL injection attempt
                    sqlDetected = checkForSqlInjectionAttempt(transactionId);
                    
                    // Apply different behavior based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // At low security, display detailed error messages
                            if (sqlDetected) {
                                // Simulate database error
                                resultDiv.innerHTML = `
                                    <div class="alert alert-danger">
                                        <strong>MySQL Error:</strong> You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '${escapeHtml(transactionId)}' at line 1
                                    </div>
                                `;
                                
                                // Show SQL injection detection message
                                showSqlDetection();
                            } else if (transactionId === '1') {
                                // Regular transaction data
                                resultDiv.innerHTML = `
                                    <h5>Transaction Details</h5>
                                    <table class="db-table">
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>2025-04-30</td>
                                                <td>Deposit</td>
                                                <td>$1,000.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                `;
                            } else {
                                // Transaction not found
                                resultDiv.innerHTML = '<div class="text-center">No transaction found with that ID.</div>';
                            }
                            break;
                            
                        case 'medium':
                            // At medium security, display generic error messages
                            if (sqlDetected) {
                                // Simulate generic database error
                                resultDiv.innerHTML = `
                                    <div class="alert alert-danger">
                                        <strong>Database Error:</strong> An error occurred while processing your request.
                                    </div>
                                `;
                                
                                // Show SQL injection detection message if using extractvalue or other advanced techniques
                                if (transactionId.toLowerCase().includes('extractvalue') || 
                                    transactionId.toLowerCase().includes('updatexml')) {
                                    showSqlDetection();
                                }
                            } else if (transactionId === '1') {
                                // Regular transaction data
                                resultDiv.innerHTML = `
                                    <h5>Transaction Details</h5>
                                    <table class="db-table">
                                        <thead>
                                            <tr>
                                                <th>Transaction ID</th>
                                                <th>Date</th>
                                                <th>Description</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>2025-04-30</td>
                                                <td>Deposit</td>
                                                <td>$1,000.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                `;
                            } else {
                                // Transaction not found
                                resultDiv.innerHTML = '<div class="text-center">No transaction found with that ID.</div>';
                            }
                            break;
                            
                        case 'high':
                            // At high security, validate input strictly
                            if (/^\d+$/.test(transactionId)) {
                                if (transactionId === '1') {
                                    // Regular transaction data
                                    resultDiv.innerHTML = `
                                        <h5>Transaction Details</h5>
                                        <table class="db-table">
                                            <thead>
                                                <tr>
                                                    <th>Transaction ID</th>
                                                    <th>Date</th>
                                                    <th>Description</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>2025-04-30</td>
                                                    <td>Deposit</td>
                                                    <td>$1,000.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    `;
                                } else {
                                    // Transaction not found
                                    resultDiv.innerHTML = '<div class="text-center">No transaction found with that ID.</div>';
                                }
                            } else {
                                // Invalid input
                                resultDiv.innerHTML = '<div class="alert alert-danger">Invalid input. Transaction ID must be a number.</div>';
                            }
                            break;
                    }
                });
            }
        }
        
        // Handle blind SQL injection demo
        function setupBlindSqlDemo() {
            const form = document.getElementById('blindSqlForm');
            const resultDiv = document.getElementById('blindSqlResult');
            
            if (form && resultDiv) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const accountNumber = document.getElementById('accountNumber').value;
                    let sqlDetected = false;
                    let timeBased = false;
                    
                    // Check if this might be an SQL injection attempt
                    sqlDetected = checkForSqlInjectionAttempt(accountNumber);
                    
                    // Check if it's a time-based attack
                    timeBased = accountNumber.toLowerCase().includes('sleep') || 
                               accountNumber.toLowerCase().includes('benchmark');
                    
                    // Apply different behavior based on security level
                    switch (currentSecurityLevel) {
                        case 'low':
                            // At low security, vulnerable to both boolean and time-based blind injection
                            if (sqlDetected) {
                                if (timeBased) {
                                    // Simulate time delay for time-based blind SQL injection
                                    resultDiv.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"></div><span class="ms-2">Processing...</span></div>';
                                    
                                    // Simulate processing delay
                                    setTimeout(() => {
                                        resultDiv.innerHTML = '<div class="alert alert-success">Account exists.</div>';
                                        showSqlDetection();
                                    }, 3000);
                                } else {
                                    // Boolean-based blind SQL injection
                                    // If injection likely returns true (contains " AND 1=1" or similar)
                                    if (accountNumber.includes("1=1") || 
                                        accountNumber.includes("'a'='a") || 
                                        !accountNumber.includes("1=2")) {
                                        resultDiv.innerHTML = '<div class="alert alert-success">Account exists.</div>';
                                    } else {
                                        resultDiv.innerHTML = '<div class="alert alert-warning">Account not found.</div>';
                                    }
                                    
                                    // Show SQL injection detection message
                                    showSqlDetection();
                                }
                            } else if (accountNumber === '123456') {
                                // Regular account verification
                                resultDiv.innerHTML = '<div class="alert alert-success">Account exists.</div>';
                            } else {
                                // Account not found
                                resultDiv.innerHTML = '<div class="alert alert-warning">Account not found.</div>';
                            }
                            break;
                            
                        case 'medium':
                            // At medium security, some protection against basic injections
                            // Basic keyword filtering
                            let sanitizedInput = accountNumber.replace(/sleep|benchmark|waitfor/gi, "");
                            
                            if (sanitizedInput !== accountNumber) {
                                // Detected and removed time-based functions
                                resultDiv.innerHTML = '<div class="alert alert-warning">Account not found.</div>';
                            } else if (sqlDetected) {
                                // Still vulnerable to boolean-based blind SQL injection
                                // If injection likely returns true
                                if (accountNumber.includes("1=1") || 
                                    accountNumber.includes("'a'='a") || 
                                    !accountNumber.includes("1=2")) {
                                    resultDiv.innerHTML = '<div class="alert alert-success">Account exists.</div>';
                                    showSqlDetection();
                                } else {
                                    resultDiv.innerHTML = '<div class="alert alert-warning">Account not found.</div>';
                                }
                            } else if (accountNumber === '123456') {
                                // Regular account verification
                                resultDiv.innerHTML = '<div class="alert alert-success">Account exists.</div>';
                            } else {
                                // Account not found
                                resultDiv.innerHTML = '<div class="alert alert-warning">Account not found.</div>';
                            }
                            break;
                            
                        case 'high':
                            // At high security, strict input validation
                            if (/^\d+$/.test(accountNumber)) {
                                if (accountNumber === '123456') {
                                    // Regular account verification
                                    resultDiv.innerHTML = '<div class="alert alert-success">Account exists.</div>';
                                } else {
                                    // Account not found
                                    resultDiv.innerHTML = '<div class="alert alert-warning">Account not found.</div>';
                                }
                            } else {
                                // Invalid input
                                resultDiv.innerHTML = '<div class="alert alert-danger">Invalid input. Account number must contain only digits.</div>';
                            }
                            break;
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
                    
                    if (target === 'union') {
                        document.getElementById('accountId').value = payload;
                        document.getElementById('unionSqlForm').dispatchEvent(new Event('submit'));
                    } else if (target === 'error') {
                        document.getElementById('transactionId').value = payload;
                        document.getElementById('errorSqlForm').dispatchEvent(new Event('submit'));
                    } else if (target === 'blind') {
                        document.getElementById('accountNumber').value = payload;
                        document.getElementById('blindSqlForm').dispatchEvent(new Event('submit'));
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
        
        // Helper function to check if the input might be an SQL injection attempt
        function checkForSqlInjectionAttempt(input) {
            // Simple check for common SQL injection patterns
            const sqlPatterns = [
                /'/i,
                /"/i,
                /;/i,
                /--/i,
                /#/i,
                /union/i,
                /select/i,
                /from/i,
                /where/i,
                /drop/i,
                /insert/i,
                /update/i,
                /delete/i,
                /exec/i,
                /or 1=/i,
                /or '1'='1/i,
                /and 1=/i,
                /sleep\(/i,
                /benchmark\(/i,
                /waitfor delay/i,
                /extractvalue/i,
                /updatexml/i
            ];
            
            return sqlPatterns.some(pattern => pattern.test(input));
        }
        
        // Show SQL injection detection alert
        function showSqlDetection() {
            const sqlDetection = document.getElementById('sqlDetection');
            
            if (sqlDetection) {
                sqlDetection.style.display = 'block';
                
                // Hide after 5 seconds
                setTimeout(() => {
                    sqlDetection.style.display = 'none';
                }, 5000);
            }
        }
    </script>
</body>
</html>