<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Command Injection - HackMeBank</title>
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
                You are exploring the Command Injection vulnerability. 
                Current Security Level: <span class="current-security-level badge bg-danger ms-2">Low</span>
            </div>
        </div>

        <!-- Vulnerability Header -->
        <div class="vulnerability-header">
            <div class="vulnerability-title">
                <div class="vulnerability-icon"><i class="bi bi-terminal"></i></div>
                Command Injection
            </div>
            <div class="vulnerability-controls">
                <a href="#explanation" class="btn btn-sm btn-outline-primary me-2">Explanation</a>
                <a href="#demonstration" class="btn btn-sm btn-outline-primary me-2">Demonstration</a>
                <a href="#mitigation" class="btn btn-sm btn-outline-primary">Mitigation</a>
            </div>
        </div>

        <!-- Vulnerability Explanation -->
        <section id="explanation" class="mb-5">
            <h3>What is Command Injection?</h3>
            <div class="vulnerability-description">
                <p>Command Injection is a web security vulnerability that allows an attacker to execute arbitrary system commands 
                on the server that is running an application. This vulnerability occurs when an application passes unsafe user-supplied 
                data to a system shell.</p>
                
                <p>In a banking application, command injection can have severe consequences:</p>
                <ul>
                    <li>Unauthorized access to sensitive customer data</li>
                    <li>Modification or deletion of critical system files</li>
                    <li>Installation of backdoors for persistent access</li>
                    <li>Execution of malicious scripts to compromise the entire system</li>
                    <li>Lateral movement within the internal network</li>
                    <li>Disruption of banking services (Denial of Service)</li>
                </ul>
            </div>
        </section>

        <!-- Vulnerability Demonstration -->
        <section id="demonstration" class="mb-5">
            <h3>Demonstration</h3>
            <p>This demonstration shows a vulnerable "Account Statement Generator" that uses system commands to check transaction data.</p>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Account Statement Generator</h5>
                </div>
                <div class="card-body">
                    <p>Enter your account number to check transaction availability for statement generation:</p>
                    
                    <form id="statementGenForm">
                        <div class="mb-3">
                            <label for="accountNumber" class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="accountNumber" placeholder="Enter your account number">
                            <div class="form-text">
                                Try these command injection payloads:
                                <ul>
                                    <li><code>1234</code> - Normal account number</li>
                                    <li><code>1234 && whoami</code> - Execute whoami command</li>
                                    <li><code>1234 || ls -la</code> - Execute ls command</li>
                                    <li><code>1234 | cat /etc/passwd</code> - View passwd file</li>
                                </ul>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Check Availability</button>
                    </form>

                    <!-- Command Display -->
                    <div class="card mt-4">
                        <div class="card-header bg-dark text-white">
                            <h5 class="mb-0">Command Being Executed</h5>
                        </div>
                        <div class="card-body">
                            <pre><code id="commandDisplay" class="language-bash">-- Command will appear here when you submit the form</code></pre>
                        </div>
                    </div>

                    <!-- Results Display -->
                    <div class="mt-4" id="commandResults">
                        <!-- Results will appear here -->
                    </div>
                </div>
            </div>

            <!-- Security Level Implementation -->
            <div class="security-level-section low">
                <h5 class="security-level-title low">
                    Low Security Implementation
                    <span class="security-level-badge badge bg-danger">Low</span>
                </h5>
                <p>In the low security implementation, user input is directly passed to a system command without any validation:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Vulnerable Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// LOW security - Vulnerable to Command Injection
function checkTransactionData($accountNumber) {
    // Directly using input in a system command
    $command = "grep " . $accountNumber . " /var/data/transactions.log";
    
    // Execute the command and return output
    return shell_exec($command);
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="security-level-section medium" style="display: none;">
                <h5 class="security-level-title medium">
                    Medium Security Implementation
                    <span class="security-level-badge badge bg-warning">Medium</span>
                </h5>
                <p>The medium security implementation attempts basic filtering but can still be bypassed:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Partially Secure Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// MEDIUM security - Basic filtering but can be bypassed
function checkTransactionData($accountNumber) {
    // Attempt to filter common command injection characters
    $filtered = str_replace(['&', '|', ';', '`', '$', '(', ')', '<', '>'], '', $accountNumber);
    
    // Still vulnerable to other techniques or encoded characters
    $command = "grep " . $filtered . " /var/data/transactions.log";
    
    // Execute the command and return output
    return shell_exec($command);
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="security-level-section high" style="display: none;">
                <h5 class="security-level-title high">
                    High Security Implementation
                    <span class="security-level-badge badge bg-success">High</span>
                </h5>
                <p>The high security implementation uses strict validation and prepared commands:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Secure Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// HIGH security - Using strict validation and safe execution
function checkTransactionData($accountNumber) {
    // Validate input is only numbers
    if (!preg_match('/^[0-9]+$/', $accountNumber)) {
        return "Invalid account number format.";
    }
    
    // Use escapeshellarg to properly escape the argument
    $safeAccountNumber = escapeshellarg($accountNumber);
    
    // Use a predefined command with proper argument separation
    $command = "grep " . $safeAccountNumber . " /var/data/transactions.log";
    
    // Alternative: Don't use shell commands at all
    // Instead, use file handling functions to read and process the file
    
    // Execute the command and return output
    return shell_exec($command);
}</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vulnerability Result (hidden initially) -->
        <div class="vulnerability-result success" style="display: none;">
            <h5 class="vulnerability-result-title">Command Injection Successful!</h5>
            <div class="vulnerability-result-message"></div>
        </div>
        
        <!-- Mitigation Strategies -->
        <section id="mitigation" class="mb-5">
            <h3>Mitigation Strategies</h3>
            <div class="vulnerability-description">
                <p>To protect against command injection attacks, implement these security measures:</p>
                <ol>
                    <li>
                        <strong>Avoid System Commands</strong>
                        <p>Whenever possible, use built-in language functions instead of executing system commands.</p>
                    </li>
                    <li>
                        <strong>Use Parameterized Commands</strong>
                        <p>If system commands must be used, properly escape arguments with functions like <code>escapeshellarg()</code> and <code>escapeshellcmd()</code>.</p>
                    </li>
                    <li>
                        <strong>Input Validation</strong>
                        <p>Implement strict whitelist validation for acceptable inputs before processing.</p>
                    </li>
                    <li>
                        <strong>Run with Least Privileges</strong>
                        <p>Ensure the application runs with minimal necessary system permissions.</p>
                    </li>
                    <li>
                        <strong>Use Security Frameworks</strong>
                        <p>Many frameworks provide safer alternatives to direct system command execution.</p>
                    </li>
                    <li>
                        <strong>Implement Command Whitelisting</strong>
                        <p>Only allow a predefined set of commands to be executed.</p>
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
    
    <!-- Command Injection Demo Script -->
    <script>
        $(document).ready(function() {
            // Initialize syntax highlighting
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
            
            // Handle form submission
            $('#statementGenForm').on('submit', function(e) {
                e.preventDefault();
                
                // Get the security level and account number
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                const accountNumber = $('#accountNumber').val();
                
                // Display the command based on security level
                let command = '';
                let isInjection = false;
                let vulnerabilityExploited = false;
                
                // Check for command injection attempts
                const injectionChars = ['&', '|', ';', '`', '$', '(', ')', '<', '>', '\\'];
                isInjection = injectionChars.some(char => accountNumber.includes(char));
                
                switch(securityLevel) {
                    case 'low':
                        // Low security - direct command execution
                        command = `grep ${accountNumber} /var/data/transactions.log`;
                        vulnerabilityExploited = isInjection;
                        break;
                        
                    case 'medium':
                        // Medium security - basic filtering
                        const filteredAccount = accountNumber.replace(/[&|;`$()<>]/g, '');
                        command = `grep ${filteredAccount} /var/data/transactions.log`;
                        
                        // Check if filtering was bypassed
                        vulnerabilityExploited = filteredAccount !== accountNumber && isInjection;
                        break;
                        
                    case 'high':
                        // High security - strict validation and safe execution
                        if (/^[0-9]+$/.test(accountNumber)) {
                            command = `grep '${accountNumber}' /var/data/transactions.log`;
                            vulnerabilityExploited = false;
                        } else {
                            command = "Invalid input detected. Command execution prevented.";
                            vulnerabilityExploited = false;
                        }
                        break;
                }
                
                // Display the command
                $('#commandDisplay').text(command);
                hljs.highlightBlock(document.getElementById('commandDisplay'));
                
                // Generate and display results
                let results = '';
                
                // Normal account check (no injection)
                if (!isInjection) {
                    if (accountNumber === '1234') {
                        results = `
                            <div class="alert alert-success">
                                <h5>Transaction Data Found</h5>
                                <p>Records for account number 1234 are available for statement generation.</p>
                                <p>Last transaction: <strong>April 28, 2025</strong> - Amount: <strong>$345.67</strong></p>
                                <a href="#" class="btn btn-sm btn-primary mt-2">Generate Statement</a>
                            </div>
                        `;
                    } else {
                        results = `
                            <div class="alert alert-warning">
                                <h5>No Transaction Data Found</h5>
                                <p>No records found for account number ${accountNumber}.</p>
                            </div>
                        `;
                    }
                }
                // Command injection simulation
                else if (vulnerabilityExploited && securityLevel === 'low') {
                    // Simulate different command injection results
                    if (accountNumber.includes('whoami')) {
                        results = `
                            <div class="alert alert-danger">
                                <h5>Command Injection Detected</h5>
                                <p>The system executed the injected 'whoami' command:</p>
                                <pre class="bg-dark text-light p-2 mt-2">www-data</pre>
                            </div>
                        `;
                    }
                    else if (accountNumber.includes('ls')) {
                        results = `
                            <div class="alert alert-danger">
                                <h5>Command Injection Detected</h5>
                                <p>The system executed the injected 'ls' command:</p>
                                <pre class="bg-dark text-light p-2 mt-2">app
config
database
includes
index.php
logs
public
README.md
setup.php
vulnerabilities</pre>
                            </div>
                        `;
                    }
                    else if (accountNumber.includes('cat /etc/passwd')) {
                        results = `
                            <div class="alert alert-danger">
                                <h5>Command Injection Detected</h5>
                                <p>The system executed the injected 'cat /etc/passwd' command:</p>
                                <pre class="bg-dark text-light p-2 mt-2">root:x:0:0:root:/root:/bin/bash
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
irc:x:39:39:ircd:/run/ircd:/usr/sbin/nologin
_apt:x:42:65534::/nonexistent:/usr/sbin/nologin
nobody:x:65534:65534:nobody:/nonexistent:/usr/sbin/nologin
mysql:x:999:999:MySQL Server,,,:/var/lib/mysql:/bin/false</pre>
                            </div>
                        `;
                    }
                    else {
                        results = `
                            <div class="alert alert-danger">
                                <h5>Command Injection Detected</h5>
                                <p>The system executed an injected command. Output not shown for security reasons.</p>
                            </div>
                        `;
                    }
                    
                    // Show vulnerability exploited message
                    $('.vulnerability-result').addClass('success').removeClass('failure');
                    $('.vulnerability-result-title').text('Command Injection Successful!');
                    $('.vulnerability-result-message').text('You have successfully exploited the command injection vulnerability to execute system commands.');
                    $('.vulnerability-result').show();
                }
                else if (isInjection && securityLevel === 'medium') {
                    // Medium security might still be vulnerable
                    if (accountNumber.includes('\\') || accountNumber.toLowerCase().includes('bash')) {
                        results = `
                            <div class="alert alert-danger">
                                <h5>Command Injection Detected (Bypass)</h5>
                                <p>The filtering was bypassed with special characters:</p>
                                <pre class="bg-dark text-light p-2 mt-2">Basic filtering bypassed. System command executed.</pre>
                            </div>
                        `;
                        
                        // Show vulnerability exploited message
                        $('.vulnerability-result').addClass('success').removeClass('failure');
                        $('.vulnerability-result-title').text('Command Injection Successful!');
                        $('.vulnerability-result-message').text('You bypassed the medium security filtering to execute system commands.');
                        $('.vulnerability-result').show();
                    } else {
                        results = `
                            <div class="alert alert-info">
                                <h5>Potentially Malicious Input Detected</h5>
                                <p>The system filtered out potentially dangerous characters from your input.</p>
                            </div>
                        `;
                    }
                }
                else if (isInjection && securityLevel === 'high') {
                    results = `
                        <div class="alert alert-success">
                            <h5>Command Injection Prevented</h5>
                            <p>The high security implementation successfully blocked the command injection attempt.</p>
                            <p>Input validation ensured only valid account numbers are processed.</p>
                        </div>
                    `;
                    
                    // Show vulnerability blocked message
                    $('.vulnerability-result').addClass('failure').removeClass('success');
                    $('.vulnerability-result-title').text('Command Injection Prevented!');
                    $('.vulnerability-result-message').text('The high security level successfully prevented the command injection attack.');
                    $('.vulnerability-result').show();
                }
                
                // Display the results
                $('#commandResults').html(results);
            });
        });
    </script>
</body>
</html>