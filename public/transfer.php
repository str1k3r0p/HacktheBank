<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Transfer - HackMeBank</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/banking-theme.css" rel="stylesheet">
    <link href="css/security-display.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="assets/images/logo.png" alt="HackMeBank Logo" height="40" class="d-inline-block align-top me-2">
                HackMeBank
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="transfer.php">Transfers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="statements.php">Statements</a>
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
                        <button type="button" class="btn btn-sm btn-danger security-btn active" data-level="low">Low</button>
                        <button type="button" class="btn btn-sm btn-warning security-btn" data-level="medium">Medium</button>
                        <button type="button" class="btn btn-sm btn-success security-btn" data-level="high">High</button>
                    </div>
                </div>

                <!-- User Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown">
                        <img src="assets/images/icons/user.png" alt="User" class="user-icon me-1">
                        <span class="username">John Doe</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                        <li><a class="dropdown-item" href="settings.php">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
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
                This transfer page contains deliberate security vulnerabilities for educational purposes.
                Current Security Level: <span class="current-security-level badge bg-danger ms-2">Low</span>
            </div>
        </div>

        <div class="row">
            <!-- Transfer Form Column -->
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Money Transfer</h4>
                    </div>
                    <div class="card-body">
                        <!-- Alerts for transfer results -->
                        <div id="transfer-success" class="mb-3"></div>
                        <div id="transfer-error" class="mb-3"></div>
                        
                        <!-- Transfer Form with SQL Injection Vulnerability -->
                        <form id="transferForm" method="post">
                            <!-- From Account -->
                            <div class="mb-3">
                                <label for="accountFrom" class="form-label">From Account</label>
                                <select class="form-select" id="accountFrom" name="accountFrom" required>
                                    <option value="1">Checking Account (**** 1234) - $12,345.67</option>
                                    <option value="2">Savings Account (**** 5678) - $12,154.33</option>
                                </select>
                            </div>
                            
                            <!-- To Account (SQL Injection vulnerable input) -->
                            <div class="mb-3">
                                <label for="accountTo" class="form-label">To Account (Account Number or Name)</label>
                                <input type="text" class="form-control" id="accountTo" name="accountTo" 
                                       placeholder="Enter account number or recipient name" required>
                                <small class="text-muted vulnerability-hint">
                                    Try: <code>' OR 1=1 --</code> to see all accounts
                                </small>
                            </div>
                            
                            <!-- Amount -->
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <div class="amount-input-group">
                                    <input type="number" class="form-control" id="amount" name="amount" 
                                           min="0.01" step="0.01" placeholder="0.00" required>
                                </div>
                            </div>
                            
                            <!-- Purpose / Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description (Optional)</label>
                                <input type="text" class="form-control" id="description" name="description" 
                                       placeholder="What's this transfer for?">
                                <small class="text-muted vulnerability-hint">
                                    Try: <code><script>alert('XSS')</script></code> for XSS
                                </small>
                            </div>
                            
                            <!-- Transaction Date -->
                            <div class="mb-3">
                                <label for="transactionDate" class="form-label">Transfer Date</label>
                                <input type="date" class="form-control" id="transactionDate" name="transactionDate" 
                                       value="2025-04-28">
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">Transfer Money</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Recipient Search (vulnerable to SQL Injection) -->
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Search For Recipients</h5>
                    </div>
                    <div class="card-body">
                        <form id="searchForm">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search by name or account number" 
                                       id="searchQuery" name="searchQuery">
                                <button class="btn btn-outline-primary" type="button" id="searchButton">Search</button>
                            </div>
                            <small class="text-muted vulnerability-hint">
                                SQL Injection vulnerability exists in search function:<br>
                                Try: <code>' OR 1=1; --</code> to list all users in the database
                            </small>
                        </form>
                        
                        <div class="mt-3" id="searchResults">
                            <!-- Search results will be displayed here -->
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar Column -->
            <div class="col-md-4">
                <!-- Recent Recipients -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Recent Recipients</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Sarah Johnson</div>
                                    <small class="text-muted">Acc: **** 7890</small>
                                </div>
                                <button class="btn btn-sm btn-primary select-recipient" data-account="7890" data-name="Sarah Johnson">Select</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Michael Wong</div>
                                    <small class="text-muted">Acc: **** 4567</small>
                                </div>
                                <button class="btn btn-sm btn-primary select-recipient" data-account="4567" data-name="Michael Wong">Select</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Emily Davis</div>
                                    <small class="text-muted">Acc: **** 3456</small>
                                </div>
                                <button class="btn btn-sm btn-primary select-recipient" data-account="3456" data-name="Emily Davis">Select</button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Robert Chen</div>
                                    <small class="text-muted">Acc: **** 5432</small>
                                </div>
                                <button class="btn btn-sm btn-primary select-recipient" data-account="5432" data-name="Robert Chen">Select</button>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Transfer Limits -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Transfer Limits</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Per Transaction</div>
                                <span class="fw-bold">$10,000.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Daily Limit</div>
                                <span class="fw-bold">$25,000.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>Monthly Limit</div>
                                <span class="fw-bold">$100,000.00</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Security Information -->
                <div class="card security-info-card">
                    <div class="card-header bg-warning">
                        <h5 class="mb-0">Vulnerability Information</h5>
                    </div>
                    <div class="card-body">
                        <p>This transfer page demonstrates:</p>
                        <ul>
                            <li><strong>SQL Injection</strong> in recipient search and account fields</li>
                            <li><strong>XSS</strong> in description field</li>
                            <li><strong>CSRF</strong> protection missing at low security level</li>
                        </ul>
                        <p>Security levels implement different protections:</p>
                        <div class="security-level-section low">
                            <h6 class="security-level-title low">Low Security</h6>
                            <p>No input validation or sanitization</p>
                        </div>
                        <div class="security-level-section medium" style="display: none;">
                            <h6 class="security-level-title medium">Medium Security</h6>
                            <p>Basic input filtering but still vulnerable</p>
                        </div>
                        <div class="security-level-section high" style="display: none;">
                            <h6 class="security-level-title high">High Security</h6>
                            <p>Proper validation, prepared statements, CSRF tokens</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/security-display.js"></script>
    
    <!-- Transfer Form Handling with Vulnerabilities -->
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#transferForm').on('submit', function(e) {
                e.preventDefault();
                
                // Get the current security level
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                // Get form data
                const fromAccount = $('#accountFrom').val();
                const toAccount = $('#accountTo').val();
                const amount = $('#amount').val();
                const description = $('#description').val();
                const date = $('#transactionDate').val();
                
                // Simulate different security validations based on level
                let isValid = true;
                let errorMessage = '';
                
                switch(securityLevel) {
                    case 'low':
                        // Low security - minimal validation
                        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
                            isValid = false;
                            errorMessage = 'Please enter a valid amount';
                        }
                        break;
                        
                    case 'medium':
                        // Medium security - more validation
                        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
                            isValid = false;
                            errorMessage = 'Please enter a valid amount';
                        }
                        
                        // Basic account validation (still vulnerable but better)
                        if (toAccount.includes('--') || toAccount.includes('OR') || 
                            toAccount.includes('SELECT') || toAccount.includes(';')) {
                            isValid = false;
                            errorMessage = 'Invalid account format detected';
                        }
                        break;
                        
                    case 'high':
                        // High security - thorough validation
                        if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
                            isValid = false;
                            errorMessage = 'Please enter a valid amount';
                        }
                        
                        // Strict account validation (properly validated)
                        if (!/^[A-Za-z0-9\s]{5,20}$/.test(toAccount)) {
                            isValid = false;
                            errorMessage = 'Account must contain only letters, numbers, and spaces (5-20 characters)';
                        }
                        
                        // Check for CSRF token (simulated)
                        if (!document.querySelector('input[name="csrf_token"]')) {
                            isValid = false;
                            errorMessage = 'Security token missing. Please refresh the page.';
                        }
                        break;
                }
                
                if (!isValid) {
                    // Display error
                    $('#transfer-error').html(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ${errorMessage}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    
                    // SQL Injection simulation for learning
                    if (toAccount.includes("'") || toAccount.includes('"') || 
                        toAccount.includes('OR') || toAccount.includes('--')) {
                        
                        // Only show SQL injection demonstration in low security
                        if (securityLevel === 'low') {
                            // Simulated "all accounts" result due to SQL injection
                            $('#searchResults').html(`
                                <div class="alert alert-warning">
                                    <h5>SQL Injection Detected!</h5>
                                    <p>The following query would be executed:</p>
                                    <pre>SELECT * FROM accounts WHERE account_number = '${toAccount}'</pre>
                                    <p class="mt-2">Which could expose all accounts in the database:</p>
                                </div>
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Account Number</th>
                                            <th>Name</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>1234567890</td>
                                            <td>John Doe</td>
                                            <td>$12,345.67</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>0987654321</td>
                                            <td>Jane Smith</td>
                                            <td>$42,125.89</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>5432167890</td>
                                            <td>Robert Chen</td>
                                            <td>$9,452.12</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>6789054321</td>
                                            <td>Emily Davis</td>
                                            <td>$15,789.45</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>1357924680</td>
                                            <td>Michael Wong</td>
                                            <td>$78,321.67</td>
                                        </tr>
                                    </tbody>
                                </table>
                            `);
                        }
                    }
                    
                    return;
                }
                
                // XSS demonstration
                if (description.includes('<script>') && securityLevel === 'low') {
                    // Allow the XSS to execute for demonstration
                    eval(description.match(/<script>(.*?)<\/script>/i)[1]);
                }
                
                // Success - show confirmation
                $('#transfer-success').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading">Transfer Successful!</h5>
                        <p>Successfully transferred $${parseFloat(amount).toFixed(2)} to account ${toAccount}.</p>
                        <hr>
                        <p class="mb-0">Transaction ID: TXN${Math.floor(Math.random() * 10000000)}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                
                // Reset form
                this.reset();
                
                // Set default date to today
                $('#transactionDate').val('2025-04-28');
            });
            
            // Handle recipient selection
            $('.select-recipient').on('click', function() {
                const account = $(this).data('account');
                const name = $(this).data('name');
                $('#accountTo').val(account);
            });
            
            // Handle search functionality (with simulated SQL injection vulnerability)
            $('#searchButton').on('click', function() {
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                const searchQuery = $('#searchQuery').val();
                
                // Simulate SQL injection vulnerability at low security level
                if (securityLevel === 'low' && 
                    (searchQuery.includes("'") || searchQuery.includes('"') || 
                     searchQuery.includes('OR') || searchQuery.includes('--'))) {
                    
                    // Simulate SQL injection revealing all accounts
                    $('#searchResults').html(`
                        <div class="alert alert-warning">
                            <h5>SQL Injection Detected!</h5>
                            <p>The following query would be executed:</p>
                            <pre>SELECT * FROM users WHERE name LIKE '%${searchQuery}%' OR account_number LIKE '%${searchQuery}%'</pre>
                            <p class="mt-2">Which could expose all users in the database:</p>
                        </div>
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>admin</td>
                                    <td>admin@hackmebank.local</td>
                                    <td>System Admin</td>
                                    <td>Administrator</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>jdoe</td>
                                    <td>john.doe@example.com</td>
                                    <td>John Doe</td>
                                    <td>Customer</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>jsmith</td>
                                    <td>jane.smith@example.com</td>
                                    <td>Jane Smith</td>
                                    <td>Customer</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>bwilliams</td>
                                    <td>bob.williams@example.com</td>
                                    <td>Bob Williams</td>
                                    <td>Bank Manager</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>mwong</td>
                                    <td>michael.wong@example.com</td>
                                    <td>Michael Wong</td>
                                    <td>Customer</td>
                                </tr>
                            </tbody>
                        </table>
                    `);
                } else {
                    // Normal search functionality (simulated)
                    if (searchQuery.length > 0) {
                        $('#searchResults').html(`
                            <p>Search results for "${searchQuery}":</p>
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-bold">Sarah Johnson</div>
                                        <small class="text-muted">Acc: **** 7890</small>
                                    </div>
                                    <button class="btn btn-sm btn-primary select-search-result" 
                                            data-account="7890" data-name="Sarah Johnson">Select</button>
                                </li>
                            </ul>
                        `);
                    } else {
                        $('#searchResults').html('<p>Please enter a search term</p>');
                    }
                }
                
                // Handle selecting a search result
                $('.select-search-result').on('click', function() {
                    const account = $(this).data('account');
                    $('#accountTo').val(account);
                });
            });
            
            // If high security, add CSRF token (simulation)
            function updateSecurityFeatures() {
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                if (securityLevel === 'high') {
                    // Add CSRF token
                    if (!document.querySelector('input[name="csrf_token"]')) {
                        const csrfToken = Math.random().toString(36).substring(2);
                        $('#transferForm').append(`<input type="hidden" name="csrf_token" value="${csrfToken}">`);
                    }
                    
                    // Hide vulnerability hints
                    $('.vulnerability-hint').hide();
                } else {
                    // Remove CSRF token
                    $('input[name="csrf_token"]').remove();
                    
                    // Show vulnerability hints
                    $('.vulnerability-hint').show();
                }
            }
            
            // Update security features when security level changes
            $('.security-btn').on('click', function() {
                setTimeout(updateSecurityFeatures, 200);
            });
            
            // Initial setup
            updateSecurityFeatures();
        });
    </script>
</body>
</html>