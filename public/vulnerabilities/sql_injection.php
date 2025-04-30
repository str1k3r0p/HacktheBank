<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Injection - HackMeBank</title>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/banking-theme.css" rel="stylesheet">
    <link href="../css/security-display.css" rel="stylesheet">
    <!-- Highlight.js for code syntax highlighting -->
    <link href="../css/highlight.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="../index.php">
                <img src="../assets/images/logo.png" alt="HackMeBank Logo" height="40" class="d-inline-block align-top me-2">
                HackMeBank
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
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
                        <button type="button" class="btn btn-sm btn-danger security-btn active" data-level="low">Low</button>
                        <button type="button" class="btn btn-sm btn-warning security-btn" data-level="medium">Medium</button>
                        <button type="button" class="btn btn-sm btn-success security-btn" data-level="high">High</button>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <img src="../assets/images/icons/user.png" alt="User" class="user-icon me-1">
                        <span class="username">John Doe</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="../profile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="../settings.php">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main content -->
    <main class="container mt-4">
        <!-- Security Level Banner -->
        <div class="alert alert-warning d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <div>
                You are exploring the SQL Injection vulnerability. 
                Current Security Level: <span class="current-security-level badge bg-danger ms-2">Low</span>
            </div>
        </div>

        <!-- Vulnerability Header -->
        <div class="vulnerability-header">
            <div class="vulnerability-title">
                <div class="vulnerability-icon"><i class="bi bi-database"></i></div>
                SQL Injection
            </div>
            <div class="vulnerability-controls">
                <a href="#explanation" class="btn btn-sm btn-outline-primary me-2">Explanation</a>
                <a href="#demonstration" class="btn btn-sm btn-outline-primary me-2">Demonstration</a>
                <a href="#mitigation" class="btn btn-sm btn-outline-primary">Mitigation</a>
            </div>
        </div>

        <!-- Vulnerability Explanation -->
        <section id="explanation" class="mb-5">
            <h3>What is SQL Injection?</h3>
            <div class="vulnerability-description">
                <p>SQL Injection is a code injection technique that exploits security vulnerabilities in an application's 
                database layer. It occurs when user input is incorrectly filtered and directly included in SQL queries.</p>
                
                <p>In a banking application, SQL injection can be especially dangerous as it may allow attackers to:</p>
                <ul>
                    <li>Access sensitive customer information (account details, personal information)</li>
                    <li>Manipulate transaction records</li>
                    <li>Bypass authentication</li>
                    <li>Execute unauthorized transactions</li>
                    <li>Modify or delete database contents</li>
                </ul>
            </div>
        </section>

        <!-- Vulnerability Demonstration -->
        <section id="demonstration" class="mb-5">
            <h3>Demonstration</h3>
            <p>This demonstration shows how a vulnerable account search function can be exploited through SQL injection. 
            Try searching for accounts using the techniques below:</p>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Account Lookup</h5>
                </div>
                <div class="card-body">
                    <form id="accountLookupForm">
                        <div class="mb-3">
                            <label for="accountNumber" class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" placeholder="Enter account number">
                            <div class="form-text">
                                Try these SQL injection payloads:
                                <ul>
                                    <li><code>1234</code> - Normal search</li>
                                    <li><code>' OR '1'='1</code> - Return all accounts</li>
                                    <li><code>' UNION SELECT username, password, email, created_at FROM users WHERE '1'='1</code> - Extract user data</li>
                                </ul>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>

                    <div class="mt-4" id="lookupResults">
                        <!-- Results will appear here -->
                    </div>
                </div>
            </div>

            <!-- SQL Query Display -->
            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">SQL Query Being Executed</h5>
                </div>
                <div class="card-body">
                    <pre><code id="sqlQuery" class="language-sql">-- Query will appear here when you submit the form</code></pre>
                </div>
            </div>

            <!-- Security Level Implementation -->
            <div class="security-level-section low">
                <h5 class="security-level-title low">
                    Low Security Implementation
                    <span class="security-level-badge badge bg-danger">Low</span>
                </h5>
                <p>In the low security implementation, user input is directly concatenated into the SQL query without any validation or sanitization:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Vulnerable Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// LOW security - Vulnerable to SQL Injection
function getAccountDetails($accountNumber) {
    // User input directly inserted into the query
    $query = "SELECT * FROM accounts WHERE account_number = '" . $accountNumber . "'";
    
    // Execute query and return results
    return $db->query($query);
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="security-level-section medium" style="display: none;">
                <h5 class="security-level-title medium">
                    Medium Security Implementation
                    <span class="security-level-badge badge bg-warning">Medium</span>
                </h5>
                <p>The medium security implementation attempts some basic filtering but is still vulnerable to more sophisticated attacks:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Partially Secure Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// MEDIUM security - Basic filtering but still vulnerable
function getAccountDetails($accountNumber) {
    // Basic filter: Remove common SQL injection strings
    $filtered = str_replace(["'", "--", ";", "/*", "*/", "UNION"], "", $accountNumber);
    
    // Still vulnerable to more advanced techniques
    $query = "SELECT * FROM accounts WHERE account_number = '" . $filtered . "'";
    
    // Execute query and return results
    return $db->query($query);
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="security-level-section high" style="display: none;">
                <h5 class="security-level-title high">
                    High Security Implementation
                    <span class="security-level-badge badge bg-success">High</span>
                </h5>
                <p>The high security implementation uses prepared statements to properly separate code from data:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Secure Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// HIGH security - Using prepared statements
function getAccountDetails($accountNumber) {
    // Prepare the statement with placeholders
    $stmt = $db->prepare("SELECT * FROM accounts WHERE account_number = ?");
    
    // Bind the parameters (automatically escaped)
    $stmt->bind_param("s", $accountNumber);
    
    // Execute and return results
    $stmt->execute();
    return $stmt->get_result();
}</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vulnerability Result (hidden initially) -->
        <div class="vulnerability-result success" style="display: none;">
            <h5 class="vulnerability-result-title">SQL Injection Successful!</h5>
            <div class="vulnerability-result-message"></div>
        </div>
        
        <!-- Mitigation Strategies -->
        <section id="mitigation" class="mb-5">
            <h3>Mitigation Strategies</h3>
            <div class="vulnerability-description">
                <p>To protect against SQL injection attacks, implement these security measures:</p>
                <ol>
                    <li>
                        <strong>Use Prepared Statements/Parameterized Queries</strong>
                        <p>This is the most effective defense. Prepared statements ensure data is treated as values, not executable code.</p>
                    </li>
                    <li>
                        <strong>Input Validation</strong>
                        <p>Validate all user inputs using whitelisting (accepting only known good input) rather than blacklisting.</p>
                    </li>
                    <li>
                        <strong>Escape User Inputs</strong>
                        <p>Use database-specific escaping functions like <code>mysqli_real_escape_string()</code> in PHP.</p>
                    </li>
                    <li>
                        <strong>Principle of Least Privilege</strong>
                        <p>Use database accounts with minimal permissions needed for the application.</p>
                    </li>
                    <li>
                        <strong>Use ORM Frameworks</strong>
                        <p>Object-Relational Mapping (ORM) frameworks often include protection against SQL injection.</p>
                    </li>
                    <li>
                        <strong>Error Handling</strong>
                        <p>Do not expose detailed error messages to users that might reveal database structure.</p>
                    </li>
                </ol>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer mt-5 py-3 bg-dark text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 HackMeBank - A Vulnerable Web Application for Cybersecurity Training</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-3">Terms</a>
                    <a href="#" class="text-white me-3">Privacy</a>
                    <a href="#" class="text-white">Contact</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/security-display.js"></script>
    <script src="../js/highlight.min.js"></script>
    
    <!-- SQL Injection Demo Script -->
    <script>
        $(document).ready(function() {
            // Initialize syntax highlighting
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
            
            // Handle form submission
            $('#accountLookupForm').on('submit', function(e) {
                e.preventDefault();
                
                // Get the security level and account number
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                const accountNumber = $('#accountNumber').val();
                
                // Display the SQL query based on security level
                let sqlQuery = '';
                let vulnerable = false;
                
                switch(securityLevel) {
                    case 'low':
                        sqlQuery = `SELECT * FROM accounts WHERE account_number = '${accountNumber}'`;
                        vulnerable = true;
                        break;
                    case 'medium':
                        // Basic filtering simulation
                        const filtered = accountNumber.replace(/[';\-\/*]/g, '');
                        sqlQuery = `SELECT * FROM accounts WHERE account_number = '${filtered}'`;
                        
                        // Check if filtering was bypassed
                        vulnerable = filtered !== accountNumber.replace(/UNION/gi, '');
                        break;
                    case 'high':
                        sqlQuery = `-- Using prepared statement:
$stmt = $db->prepare("SELECT * FROM accounts WHERE account_number = ?");
$stmt->bind_param("s", "${accountNumber}");
$stmt->execute();`;
                        vulnerable = false;
                        break;
                }
                
                // Display the SQL query
                $('#sqlQuery').text(sqlQuery);
                hljs.highlightBlock(document.getElementById('sqlQuery'));
                
                // Check for SQL injection attempts
                const isSqlInjection = accountNumber.includes("'") || 
                                       accountNumber.includes('"') || 
                                       accountNumber.toLowerCase().includes('union') ||
                                       accountNumber.toLowerCase().includes('select') ||
                                       accountNumber.includes('--') ||
                                       accountNumber.includes(';');
                
                // Display results based on input and security level
                let results = '';
                
                // Normal account search (no injection)
                if (!isSqlInjection) {
                    if (accountNumber === '1234') {
                        results = `
                            <div class="alert alert-success">
                                <h5>Account Found:</h5>
                                <table class="table table-bordered table-sm mt-2 mb-0">
                                    <tr>
                                        <th>Account Number:</th>
                                        <td>1234567890</td>
                                    </tr>
                                    <tr>
                                        <th>Account Type:</th>
                                        <td>Checking</td>
                                    </tr>
                                    <tr>
                                        <th>Balance:</th>
                                        <td>$12,345.67</td>
                                    </tr>
                                    <tr>
                                        <th>Owner:</th>
                                        <td>John Doe</td>
                                    </tr>
                                </table>
                            </div>
                        `;
                    } else {
                        results = `<div class="alert alert-warning">No account found with number: ${accountNumber}</div>`;
                    }
                }
                // SQL injection attempts
                else if (vulnerable && securityLevel === 'low') {
                    // Simulate successful SQL injection
                    if (accountNumber.includes("' OR '1'='1")) {
                        results = `
                            <div class="alert alert-danger">
                                <h5>SQL Injection Successful - All Accounts Exposed!</h5>
                                <p class="mb-2">The injection allowed access to all accounts in the database:</p>
                                <table class="table table-striped table-sm mt-2 mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Account Number</th>
                                            <th>Type</th>
                                            <th>Owner</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1234567890</td>
                                            <td>Checking</td>
                                            <td>John Doe</td>
                                            <td>$12,345.67</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>0987654321</td>
                                            <td>Savings</td>
                                            <td>Jane Smith</td>
                                            <td>$42,125.89</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>5432167890</td>
                                            <td>Checking</td>
                                            <td>Robert Chen</td>
                                            <td>$9,452.12</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>6789054321</td>
                                            <td>Investment</td>
                                            <td>Emily Davis</td>
                                            <td>$15,789.45</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>1357924680</td>
                                            <td>Checking</td>
                                            <td>Michael Wong</td>
                                            <td>$78,321.67</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        `;
                        
                        // Show vulnerability exploited message
                        $('.vulnerability-result').addClass('success').removeClass('failure');
                        $('.vulnerability-result-title').text('SQL Injection Successful!');
                        $('.vulnerability-result-message').text('You have successfully exploited the SQL injection vulnerability to view all accounts in the database.');
                        $('.vulnerability-result').show();
                    }
                    else if (accountNumber.toLowerCase().includes('union select')) {
                        results = `
                            <div class="alert alert-danger">
                                <h5>SQL Injection Successful - User Data Exposed!</h5>
                                <p class="mb-2">The UNION injection exposed sensitive user authentication data:</p>
                                <table class="table table-striped table-sm mt-2 mb-0">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Password Hash</th>
                                            <th>Email</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>admin</td>
                                            <td>$2y$10$w7ERT5YV5Cbz9UCDpI6g9u8ELl7jMdvs4RRJnk5TGPN9qLG4RMnTu</td>
                                            <td>admin@hackmebank.local</td>
                                            <td>2024-01-01 00:00:00</td>
                                        </tr>
                                        <tr>
                                            <td>jdoe</td>
                                            <td>$2y$10$aBCdEfGhIjKlMnOpQrStUvWxYz1A2B3c4D5e6F7g8H9i0J1k2L3m4</td>
                                            <td>john.doe@example.com</td>
                                            <td>2024-01-15 09:30:00</td>
                                        </tr>
                                        <tr>
                                            <td>jsmith</td>
                                            <td>$2y$10$nOpQrStUvWxYz1A2B3c4D5e6F7g8H9i0J1k2L3m4N5o6P7q8R9s0T</td>
                                            <td>jane.smith@example.com</td>
                                            <td>2024-01-16 14:20:00</td>
                                        </tr>
                                        <tr>
                                            <td>bwilliams</td>
                                            <td>$2y$10$A2B3c4D5e6F7g8H9i0J1k2L3m4N5o6P7q8R9s0TuVwXyZ1a2B3c4D5</td>
                                            <td>bob.williams@example.com</td>
                                            <td>2024-02-05 11:15:00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        `;
                        
                        // Show vulnerability exploited message
                        $('.vulnerability-result').addClass('success').removeClass('failure');
                        $('.vulnerability-result-title').text('SQL Injection Successful!');
                        $('.vulnerability-result-message').text('You have successfully exploited the SQL injection vulnerability to extract user credentials from the database.');
                        $('.vulnerability-result').show();
                    }
                    else {
                        results = `
                            <div class="alert alert-warning">
                                <h5>SQL Injection Attempt Detected</h5>
                                <p>Your input appears to contain SQL injection attempts. Try the suggested examples for successful exploitation.</p>
                            </div>
                        `;
                    }
                }
                else if (isSqlInjection && (securityLevel === 'medium' || securityLevel === 'high')) {
                    results = `
                        <div class="alert alert-info">
                            <h5>SQL Injection Attempt Blocked</h5>
                            <p>At ${securityLevel} security level, this SQL injection attempt has been blocked by security measures.</p>
                        </div>
                    `;
                    
                    // Show vulnerability blocked message
                    $('.vulnerability-result').addClass('failure').removeClass('success');
                    $('.vulnerability-result-title').text('SQL Injection Prevented!');
                    $('.vulnerability-result-message').text(`The ${securityLevel} security level successfully prevented the SQL injection attack.`);
                    $('.vulnerability-result').show();
                }
                
                // Display the results
                $('#lookupResults').html(results);
            });
        });
    </script>
</body>
</html>