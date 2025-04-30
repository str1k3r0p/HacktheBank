<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HackMeBank</title>
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
                        <a class="nav-link" href="accounts.php">Accounts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transfer.php">Transfers</a>
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
                This banking application contains deliberate security vulnerabilities for educational purposes.
                Current Security Level: <span class="current-security-level badge bg-danger ms-2">Low</span>
            </div>
        </div>

        <!-- Dashboard Header -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="dashboard-summary">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <div class="summary-label">TOTAL BALANCE</div>
                                <div class="summary-amount">$24,500.00</div>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-light me-2">View Details</button>
                                <button class="btn btn-sm btn-outline-light">Export</button>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="summary-label">INCOME (MTD)</div>
                                    <div class="summary-amount">$3,250.00</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="summary-label">EXPENSES (MTD)</div>
                                    <div class="summary-amount">$1,150.75</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="summary-label">UPCOMING DUE</div>
                                    <div class="summary-amount">$425.00</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Action Buttons -->
        <div class="quick-actions mb-4">
            <button class="quick-action-btn" onclick="window.location.href='transfer.php'">
                <i class="bi bi-arrow-left-right quick-action-icon"></i>
                <span class="quick-action-label">Transfer</span>
            </button>
            <button class="quick-action-btn" onclick="window.location.href='pay-bills.php'">
                <i class="bi bi-receipt quick-action-icon"></i>
                <span class="quick-action-label">Pay Bills</span>
            </button>
            <button class="quick-action-btn" onclick="window.location.href='statements.php'">
                <i class="bi bi-file-text quick-action-icon"></i>
                <span class="quick-action-label">Statements</span>
            </button>
            <button class="quick-action-btn" onclick="window.location.href='cards.php'">
                <i class="bi bi-credit-card quick-action-icon"></i>
                <span class="quick-action-label">Cards</span>
            </button>
        </div>

        <!-- Main Content -->
        <div class="row">
            <!-- Left Column - Accounts -->
            <div class="col-md-8">
                <h2 class="mb-3">Your Accounts</h2>
                
                <!-- Account Cards -->
                <div class="account-container">
                    <!-- Checking Account -->
                    <div class="credit-card-box mb-4">
                        <div class="card-bank-name">HackMeBank</div>
                        <div class="card-chip"></div>
                        <div class="card-number">**** **** **** 1234</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card-holder-label">ACCOUNT HOLDER</div>
                                <div class="card-holder-name">JOHN DOE</div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="card-expiry-label">BALANCE</div>
                                <div class="card-expiry">$12,345.67</div>
                            </div>
                        </div>
                        <img src="assets/images/icons/visa.png" class="card-network-logo" alt="Visa">
                    </div>

                    <!-- Savings Account -->
                    <div class="credit-card-box" style="background: linear-gradient(135deg, #062d54 0%, #0a4d8c 100%);">
                        <div class="card-bank-name">HackMeBank Savings</div>
                        <div class="card-chip"></div>
                        <div class="card-number">**** **** **** 5678</div>
                        <div class="row">
                            <div class="col-6">
                                <div class="card-holder-label">ACCOUNT HOLDER</div>
                                <div class="card-holder-name">JOHN DOE</div>
                            </div>
                            <div class="col-6 text-end">
                                <div class="card-expiry-label">BALANCE</div>
                                <div class="card-expiry">$12,154.33</div>
                            </div>
                        </div>
                        <img src="assets/images/icons/mastercard.png" class="card-network-logo" alt="Mastercard">
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="transaction-section">
                    <div class="transaction-header">
                        <h3 class="mb-0">Recent Transactions</h3>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-sm btn-outline-primary transaction-filter-btn active" data-filter="all">All</button>
                            <button type="button" class="btn btn-sm btn-outline-primary transaction-filter-btn" data-filter="deposit">Deposits</button>
                            <button type="button" class="btn btn-sm btn-outline-primary transaction-filter-btn" data-filter="withdrawal">Withdrawals</button>
                            <button type="button" class="btn btn-sm btn-outline-primary transaction-filter-btn" data-filter="transfer">Transfers</button>
                        </div>
                    </div>
                    
                    <div class="transaction-list">
                        <!-- Deposit Transaction -->
                        <div class="transaction-item" data-type="deposit">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon deposit">
                                    <i class="bi bi-arrow-down"></i>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-title">Salary Deposit</div>
                                    <div class="transaction-meta">
                                        <span class="transaction-date">April 25, 2025</span>
                                        <span class="transaction-id">ID: TXN7839024</span>
                                    </div>
                                </div>
                            </div>
                            <div class="transaction-amount positive">+$3,250.00</div>
                        </div>
                        
                        <!-- Withdrawal Transaction -->
                        <div class="transaction-item" data-type="withdrawal">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon withdrawal">
                                    <i class="bi bi-arrow-up"></i>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-title">ATM Withdrawal</div>
                                    <div class="transaction-meta">
                                        <span class="transaction-date">April 22, 2025</span>
                                        <span class="transaction-id">ID: TXN7839023</span>
                                    </div>
                                </div>
                            </div>
                            <div class="transaction-amount negative">-$200.00</div>
                        </div>
                        
                        <!-- Transfer Transaction -->
                        <div class="transaction-item" data-type="transfer">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon transfer">
                                    <i class="bi bi-arrow-left-right"></i>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-title">Transfer to Sarah Johnson</div>
                                    <div class="transaction-meta">
                                        <span class="transaction-date">April 20, 2025</span>
                                        <span class="transaction-id">ID: TXN7839022</span>
                                    </div>
                                </div>
                            </div>
                            <div class="transaction-amount negative">-$75.50</div>
                        </div>
                        
                        <!-- Bill Payment -->
                        <div class="transaction-item" data-type="withdrawal">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon withdrawal">
                                    <i class="bi bi-receipt"></i>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-title">Electric Bill Payment</div>
                                    <div class="transaction-meta">
                                        <span class="transaction-date">April 18, 2025</span>
                                        <span class="transaction-id">ID: TXN7839021</span>
                                    </div>
                                </div>
                            </div>
                            <div class="transaction-amount negative">-$142.75</div>
                        </div>
                        
                        <!-- Transfer Transaction -->
                        <div class="transaction-item" data-type="transfer">
                            <div class="d-flex align-items-center">
                                <div class="transaction-icon transfer">
                                    <i class="bi bi-arrow-left-right"></i>
                                </div>
                                <div class="transaction-details">
                                    <div class="transaction-title">Transfer from Savings</div>
                                    <div class="transaction-meta">
                                        <span class="transaction-date">April 15, 2025</span>
                                        <span class="transaction-id">ID: TXN7839020</span>
                                    </div>
                                </div>
                            </div>
                            <div class="transaction-amount positive">+$500.00</div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-3">
                        <a href="transactions.php" class="btn btn-outline-primary">View All Transactions</a>
                    </div>
                </div>
            </div>
            
            <!-- Right Column - Sidebar -->
            <div class="col-md-4">
                <!-- Security Information Card -->
                <div class="card security-info-card mb-4">
                    <div class="card-header bg-warning">
                        <h5 class="card-title mb-0">Security Notice</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">This is a deliberately vulnerable application for cybersecurity education.</p>
                        <p><strong>DO NOT</strong> deploy this application on a public server or use real credentials/data.</p>
                        <p>Current Security Level: <span class="current-security-level badge bg-danger">Low</span></p>
                        <a href="vulnerabilities/index.php" class="btn btn-sm btn-outline-primary mt-2">Explore Vulnerabilities</a>
                    </div>
                </div>
                
                <!-- Upcoming Payments -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Upcoming Payments</h5>
                        <a href="payments.php" class="btn btn-sm btn-outline-primary">Manage</a>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Rent Payment</div>
                                    <small class="text-muted">Due: April 30, 2025</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$1,200.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Car Loan</div>
                                    <small class="text-muted">Due: May 5, 2025</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$425.00</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">Phone Bill</div>
                                    <small class="text-muted">Due: May 10, 2025</small>
                                </div>
                                <span class="badge bg-primary rounded-pill">$85.99</span>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Recent Statements -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Recent Statements</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">March 2025</div>
                                    <small class="text-muted">Checking Account</small>
                                </div>
                                <a href="statements/march2025.pdf" class="btn btn-sm btn-outline-primary">View</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">February 2025</div>
                                    <small class="text-muted">Checking Account</small>
                                </div>
                                <a href="statements/february2025.pdf" class="btn btn-sm btn-outline-primary">View</a>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold">January 2025</div>
                                    <small class="text-muted">Checking Account</small>
                                </div>
                                <a href="statements/january2025.pdf" class="btn btn-sm btn-outline-primary">View</a>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <!-- Exchange Rates (potentially exploitable with XSS) -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Currency Exchange Rates</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Latest rates as of <span id="exchangeDate">April 28, 2025</span></p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>USD to EUR</div>
                                <span>0.9145</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>USD to GBP</div>
                                <span>0.7845</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>USD to JPY</div>
                                <span>114.35</span>
                            </li>
                        </ul>
                        
                        <!-- Deliberately vulnerable search form (XSS) -->
                        <form class="mt-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search currency..." id="currencySearch">
                                <button class="btn btn-outline-primary" type="button" onclick="searchCurrency()">Search</button>
                            </div>
                            <small class="form-text text-muted">Try: <code>EUR</code> or <code>GBP</code></small>
                        </form>
                        
                        <div id="currencyResult" class="mt-2"></div>
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
    
    <!-- Deliberately vulnerable JavaScript (XSS) -->
    <script>
        function searchCurrency() {
            const securityLevel = localStorage.getItem('securityLevel') || 'low';
            const searchQuery = document.getElementById('currencySearch').value;
            let result = '';
            
            // Get fake exchange rate data
            const rates = {
                'EUR': 0.9145,
                'GBP': 0.7845,
                'JPY': 114.35,
                'CAD': 1.2575,
                'AUD': 1.3525,
                'CHF': 0.9325
            };
            
            // Simulate different levels of XSS protection
            switch(securityLevel) {
                case 'low':
                    // No sanitization - vulnerable to XSS
                    if (rates[searchQuery]) {
                        result = `<div class="alert alert-success">1 USD = ${rates[searchQuery]} ${searchQuery}</div>`;
                    } else {
                        // Directly inject the user input - XSS vulnerability
                        result = `<div class="alert alert-danger">Currency not found: ${searchQuery}</div>`;
                    }
                    break;
                    
                case 'medium':
                    // Basic sanitization but still vulnerable
                    let sanitized = searchQuery.replace(/<script>/gi, '');
                    if (rates[searchQuery]) {
                        result = `<div class="alert alert-success">1 USD = ${rates[searchQuery]} ${sanitized}</div>`;
                    } else {
                        result = `<div class="alert alert-danger">Currency not found: ${sanitized}</div>`;
                    }
                    break;
                    
                case 'high':
                    // Proper sanitization
                    // In a real implementation, this would use a proper sanitization library
                    const escapeHTML = str => str.replace(/[&<>"']/g, 
                        tag => ({
                            '&': '&amp;',
                            '<': '&lt;',
                            '>': '&gt;',
                            '"': '&quot;',
                            "'": '&#39;'
                        }[tag]));
                    
                    if (rates[searchQuery]) {
                        result = `<div class="alert alert-success">1 USD = ${rates[searchQuery]} ${escapeHTML(searchQuery)}</div>`;
                    } else {
                        result = `<div class="alert alert-danger">Currency not found: ${escapeHTML(searchQuery)}</div>`;
                    }
                    break;
            }
            
            // Display result (potentially vulnerable to XSS)
            document.getElementById('currencyResult').innerHTML = result;
        }
    </script>
</body>
</html>