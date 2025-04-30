<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Directory Traversal - HackMeBank</title>
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
                You are exploring the Directory Traversal vulnerability. 
                Current Security Level: <span class="current-security-level badge bg-danger ms-2">Low</span>
            </div>
        </div>

        <!-- Vulnerability Header -->
        <div class="vulnerability-header">
            <div class="vulnerability-title">
                <div class="vulnerability-icon"><i class="bi bi-folder"></i></div>
                Directory Traversal
            </div>
            <div class="vulnerability-controls">
                <a href="#explanation" class="btn btn-sm btn-outline-primary me-2">Explanation</a>
                <a href="#demonstration" class="btn btn-sm btn-outline-primary me-2">Demonstration</a>
                <a href="#mitigation" class="btn btn-sm btn-outline-primary">Mitigation</a>
            </div>
        </div>

        <!-- Vulnerability Explanation -->
        <section id="explanation" class="mb-5">
            <h3>What is Directory Traversal?</h3>
            <div class="vulnerability-description">
                <p>Directory Traversal (also known as Path Traversal) is a web security vulnerability that allows attackers 
                to access files and directories stored outside the web root folder. By manipulating variables that reference 
                files with "../" sequences and its variations, it becomes possible to access arbitrary files and directories 
                on the server.</p>
                
                <p>In a banking context, directory traversal can lead to serious security breaches:</p>
                <ul>
                    <li>Access to sensitive configuration files containing database credentials</li>
                    <li>Exposure of customer financial records and statements</li>
                    <li>Access to system files that reveal system architecture and security measures</li>
                    <li>Leakage of internal bank documents and protocols</li>
                    <li>Compromise of server-side code containing security implementations</li>
                </ul>
            </div>
        </section>

        <!-- Vulnerability Demonstration -->
        <section id="demonstration" class="mb-5">
            <h3>Demonstration</h3>
            <p>This demonstration shows a vulnerable bank statement viewer function that is susceptible to directory traversal attacks.</p>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Bank Statement Viewer</h5>
                </div>
                <div class="card-body">
                    <p>Select a statement to view or download:</p>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="list-group">
                                <a href="#" class="list-group-item list-group-item-action statement-link" data-file="statement_march2025.txt">
                                    March 2025 Statement
                                </a>
                                <a href="#" class="list-group-item list-group-item-action statement-link" data-file="statement_february2025.txt">
                                    February 2025 Statement
                                </a>
                                <a href="#" class="list-group-item list-group-item-action statement-link" data-file="statement_january2025.txt">
                                    January 2025 Statement
                                </a>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">Try Directory Traversal</h6>
                                </div>
                                <div class="card-body">
                                    <form id="directViewForm">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="customFile" placeholder="Enter filename">
                                            <button class="btn btn-outline-primary" type="submit">View</button>
                                        </div>
                                        <div class="form-text">
                                            Try these directory traversal payloads:
                                            <ul>
                                                <li><code>statement_march2025.txt</code> - Normal statement</li>
                                                <li><code>../../../config/database.php</code> - Database configuration</li>
                                                <li><code>../../../logs/access.log</code> - Server logs</li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>File Content: <span id="currentFile">No file selected</span></span>
                            <button class="btn btn-sm btn-outline-primary" id="downloadBtn" disabled>Download</button>
                        </div>
                        <div class="card-body">
                            <pre id="fileContent" class="bg-light p-3" style="max-height: 300px; overflow-y: auto;">
Select a file to view its contents...
</pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security Level Implementation -->
            <div class="security-level-section low">
                <h5 class="security-level-title low">
                    Low Security Implementation
                    <span class="security-level-badge badge bg-danger">Low</span>
                </h5>
                <p>In the low security implementation, the file path is directly used without any validation:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Vulnerable Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// LOW security - Vulnerable to Directory Traversal
function getFileContent($filename) {
    // Base path to statement files
    $basePath = 'assets/demo/sample_statements/';
    
    // Directly concatenate the filename without validation
    $filePath = $basePath . $filename;
    
    // Return file content if exists
    if (file_exists($filePath)) {
        return file_get_contents($filePath);
    } else {
        return "File not found.";
    }
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
function getFileContent($filename) {
    // Base path to statement files
    $basePath = 'assets/demo/sample_statements/';
    
    // Basic attempt to block directory traversal
    $filename = str_replace('../', '', $filename);
    
    // Still vulnerable to encoded traversal: %2e%2e%2f or ..././
    $filePath = $basePath . $filename;
    
    // Return file content if exists
    if (file_exists($filePath)) {
        return file_get_contents($filePath);
    } else {
        return "File not found.";
    }
}</code></pre>
                    </div>
                </div>
            </div>

            <div class="security-level-section high" style="display: none;">
                <h5 class="security-level-title high">
                    High Security Implementation
                    <span class="security-level-badge badge bg-success">High</span>
                </h5>
                <p>The high security implementation uses whitelisting and proper path resolution:</p>
                <div class="code-section">
                    <div class="code-block">
                        <div class="code-header">
                            <span>Secure Code</span>
                            <span class="code-language">PHP</span>
                        </div>
                        <pre class="code-content"><code class="language-php">// HIGH security - Using whitelisting and path validation
function getFileContent($filename) {
    // Base path to statement files
    $basePath = realpath('assets/demo/sample_statements/');
    
    // Whitelist of allowed files
    $allowedFiles = [
        'statement_january2025.txt',
        'statement_february2025.txt',
        'statement_march2025.txt'
    ];
    
    // Check if the requested file is in the whitelist
    if (!in_array($filename, $allowedFiles)) {
        return "Access denied: File not in allowed list.";
    }
    
    // Use realpath to resolve the actual file path
    $filePath = realpath($basePath . '/' . $filename);
    
    // Verify the resolved path starts with the base path
    if ($filePath === false || strpos($filePath, $basePath) !== 0) {
        return "Access denied: Invalid file path.";
    }
    
    // Return file content if exists
    if (file_exists($filePath)) {
        return file_get_contents($filePath);
    } else {
        return "File not found.";
    }
}</code></pre>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vulnerability Result (hidden initially) -->
        <div class="vulnerability-result success" style="display: none;">
            <h5 class="vulnerability-result-title">Directory Traversal Successful!</h5>
            <div class="vulnerability-result-message"></div>
        </div>
        
        <!-- Mitigation Strategies -->
        <section id="mitigation" class="mb-5">
            <h3>Mitigation Strategies</h3>
            <div class="vulnerability-description">
                <p>To protect against directory traversal attacks, implement these security measures:</p>
                <ol>
                    <li>
                        <strong>Input Validation and Sanitization</strong>
                        <p>Validate user input by implementing proper whitelisting of allowed file names or patterns.</p>
                    </li>
                    <li>
                        <strong>Use Canonicalization</strong>
                        <p>Convert file paths to their canonical form before validation using functions like <code>realpath()</code>.</p>
                    </li>
                    <li>
                        <strong>Path Traversal Checks</strong>
                        <p>Verify that the final path still begins with the expected base directory.</p>
                    </li>
                    <li>
                        <strong>Run with Least Privileges</strong>
                        <p>Ensure your web application runs with minimal necessary permissions.</p>
                    </li>
                    <li>
                        <strong>Implement Access Controls</strong>
                        <p>Use proper authentication and authorization to restrict file access.</p>
                    </li>
                    <li>
                        <strong>Consider Using a File Repository Pattern</strong>
                        <p>Store allowed files in a database and reference them by ID rather than path.</p>
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
    
    <!-- Directory Traversal Demo Script -->
    <script>
        $(document).ready(function() {
            // Initialize syntax highlighting
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
            
            // Sample file contents (simulated)
            const sampleFiles = {
                'statement_january2025.txt': 
`HackMeBank Statement - January 2025
Account: **** **** **** 1234
Customer: John Doe

Opening Balance: $10,521.45
Closing Balance: $12,345.67

TRANSACTIONS:
01/05/2025 - DEPOSIT - Payroll - $3,250.00
01/10/2025 - PAYMENT - Rent - $1,200.00
01/15/2025 - TRANSFER TO - Savings - $500.00
01/22/2025 - WITHDRAWAL - ATM - $200.00
01/25/2025 - PAYMENT - Electric Bill - $75.78`,

                'statement_february2025.txt': 
`HackMeBank Statement - February 2025
Account: **** **** **** 1234
Customer: John Doe

Opening Balance: $12,345.67
Closing Balance: $14,231.22

TRANSACTIONS:
02/05/2025 - DEPOSIT - Payroll - $3,250.00
02/10/2025 - PAYMENT - Rent - $1,200.00
02/14/2025 - PAYMENT - Car Insurance - $145.50
02/18/2025 - TRANSFER TO - Savings - $250.00
02/25/2025 - PAYMENT - Internet - $89.95`,

                'statement_march2025.txt': 
`HackMeBank Statement - March 2025
Account: **** **** **** 1234
Customer: John Doe

Opening Balance: $14,231.22
Closing Balance: $15,712.45

TRANSACTIONS:
03/05/2025 - DEPOSIT - Payroll - $3,250.00
03/08/2025 - TRANSFER FROM - Savings - $500.00
03/10/2025 - PAYMENT - Rent - $1,200.00
03/15/2025 - PAYMENT - Phone Bill - $95.99
03/21/2025 - WITHDRAWAL - ATM - $300.00
03/25/2025 - PAYMENT - Utilities - $172.78`,

                // Sensitive files that could be accessed via directory traversal
                '../../../config/database.php': 
`<?php
// Database Configuration for HackMeBank
// WARNING: KEEP THIS FILE SECURE

return [
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'hackmebank',
    'username'  => 'hackmebank_user',
    'password'  => 'HM_S3cur3P@ssw0rd!',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
    'strict'    => true,
    'engine'    => null,
];
`,

                '../../../logs/access.log': 
`192.168.1.105 - - [28/Apr/2025:09:42:15 +0000] "GET /login.php HTTP/1.1" 200 2571
192.168.1.105 - - [28/Apr/2025:09:42:18 +0000] "POST /login.php HTTP/1.1" 302 -
192.168.1.105 - - [28/Apr/2025:09:42:18 +0000] "GET /dashboard.php HTTP/1.1" 200 8762
192.168.1.247 - - [28/Apr/2025:09:43:05 +0000] "GET /login.php HTTP/1.1" 200 2571
192.168.1.247 - - [28/Apr/2025:09:43:15 +0000] "POST /login.php HTTP/1.1" 401 1522
192.168.1.247 - - [28/Apr/2025:09:43:22 +0000] "POST /login.php HTTP/1.1" 401 1522
192.168.1.247 - - [28/Apr/2025:09:43:30 +0000] "POST /login.php HTTP/1.1" 401 1522
10.45.23.12 - - [28/Apr/2025:09:45:11 +0000] "GET /login.php HTTP/1.1" 200 2571
10.45.23.12 - - [28/Apr/2025:09:45:20 +0000] "POST /login.php HTTP/1.1" 302 -
10.45.23.12 - - [28/Apr/2025:09:45:20 +0000] "GET /admin/dashboard.php HTTP/1.1" 200 9871
10.45.23.12 - - [28/Apr/2025:09:46:05 +0000] "GET /admin/users.php HTTP/1.1" 200 12453
10.45.23.12 - - [28/Apr/2025:09:46:35 +0000] "GET /admin/settings.php HTTP/1.1" 200 7522
192.168.1.105 - - [28/Apr/2025:09:50:22 +0000] "GET /transfer.php HTTP/1.1" 200 5432
192.168.1.105 - - [28/Apr/2025:09:51:15 +0000] "POST /transfer.php HTTP/1.1" 302 -
192.168.1.105 - - [28/Apr/2025:09:51:15 +0000] "GET /transfer-confirmation.php HTTP/1.1" 200 4321`
            };
            
            // Handle statement link clicks
            $('.statement-link').on('click', function(e) {
                e.preventDefault();
                
                const filename = $(this).data('file');
                displayFile(filename);
            });
            
            // Handle custom file form submission
            $('#directViewForm').on('submit', function(e) {
                e.preventDefault();
                
                const filename = $('#customFile').val();
                displayFile(filename);
            });
            
            // Function to display file content based on security level
            function displayFile(filename) {
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                // Update the current file display
                $('#currentFile').text(filename);
                
                // Enable the download button
                $('#downloadBtn').prop('disabled', false);
                
                let fileContent = "File not found or access denied.";
                let vulnerabilityExploited = false;
                
                switch(securityLevel) {
                    case 'low':
                        // Low security - directly access any file
                        if (sampleFiles[filename]) {
                            fileContent = sampleFiles[filename];
                            
                            // Check if a sensitive file was accessed
                            if (filename.includes('../') || filename.includes('config') || filename.includes('log')) {
                                vulnerabilityExploited = true;
                            }
                        }
                        break;
                        
                    case 'medium':
                        // Medium security - basic filtering
                        // Replace ../ but still vulnerable to other techniques
                        const filteredFilename = filename.replace(/\.\.\//g, '');
                        
                        // Check if the filename was actually filtered
                        if (filteredFilename !== filename) {
                            fileContent = "Attempted path traversal detected and blocked.";
                        } 
                        // Allow encoding bypass simulation
                        else if (filename.includes('%2e') || filename.includes('....//')) {
                            // Simulating a successful bypass
                            const targetFile = filename
                                .replace(/%2e/g, '.')
                                .replace(/\.\.\.\.\/\//g, '../');
                                
                            if (sampleFiles[targetFile]) {
                                fileContent = sampleFiles[targetFile];
                                vulnerabilityExploited = true;
                            }
                        }
                        else if (sampleFiles[filename]) {
                            fileContent = sampleFiles[filename];
                        }
                        break;
                        
                    case 'high':
                        // High security - only allow whitelisted files
                        const allowedFiles = [
                            'statement_january2025.txt',
                            'statement_february2025.txt',
                            'statement_march2025.txt'
                        ];
                        
                        if (allowedFiles.includes(filename) && sampleFiles[filename]) {
                            fileContent = sampleFiles[filename];
                        } else {
                            fileContent = "Access denied: File not in allowed list or invalid path.";
                        }
                        break;
                }
                
                // Display the file content
                $('#fileContent').text(fileContent);
                
                // Show vulnerability notification if exploited
                if (vulnerabilityExploited) {
                    $('.vulnerability-result').addClass('success').removeClass('failure');
                    $('.vulnerability-result-title').text('Directory Traversal Successful!');
                    $('.vulnerability-result-message').text('You have successfully exploited the directory traversal vulnerability to access sensitive files outside the intended directory.');
                    $('.vulnerability-result').show();
                } else {
                    $('.vulnerability-result').hide();
                }
            }
            
            // Handle download button
            $('#downloadBtn').on('click', function() {
                const filename = $('#currentFile').text();
                const content = $('#fileContent').text();
                
                // Create a download link
                const element = document.createElement('a');
                element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));
                element.setAttribute('download', filename.split('/').pop());
                
                element.style.display = 'none';
                document.body.appendChild(element);
                
                element.click();
                
                document.body.removeChild(element);
            });
        });
    </script>
</body>
</html>