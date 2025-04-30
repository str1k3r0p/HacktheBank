<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HackMeBank</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="css/main.css" rel="stylesheet">
    <link href="css/banking-theme.css" rel="stylesheet">
    <!-- Security display CSS -->
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
                        <a class="nav-link" href="about.php">About</a>
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
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-logo">
                <img src="assets/images/logo.png" alt="HackMeBank Logo">
            </div>
            <h2 class="auth-title">Login to Your Account</h2>

            <!-- Warning about intentional vulnerabilities -->
            <div class="alert alert-warning mb-4">
                <strong>Security Notice:</strong> This login form contains deliberate security vulnerabilities for educational purposes. Current security level: <span class="current-security-level badge bg-danger">Low</span>
            </div>

            <!-- Login Form with Vulnerabilities -->
            <form id="loginForm" method="post" action="dashboard.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Enter your username" required>
                    </div>
                    <!-- Vulnerability hint for SQL Injection -->
                    <small class="text-muted vulnerability-hint">Try: <code>admin' --</code></small>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Enter your password" required>
                        <button class="btn btn-outline-secondary password-toggle" type="button" 
                                data-target="#password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <!-- Vulnerability hint for Brute Force -->
                    <small class="text-muted vulnerability-hint">Weak password protection. Try brute forcing.</small>
                </div>
                
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
                
                <!-- Placeholder for login errors -->
                <div id="loginMessage" class="mt-3"></div>
            </form>
            
            <div class="mt-4 text-center">
                <p>Don't have an account? <a href="register.php">Register</a></p>
                <p><a href="forgot-password.php">Forgot Password?</a></p>
            </div>
            
            <div class="mt-3">
                <div class="accordion" id="loginHelp">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="vulnerabilityHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#vulnerabilityInfo">
                                Vulnerability Information
                            </button>
                        </h2>
                        <div id="vulnerabilityInfo" class="accordion-collapse collapse" 
                             aria-labelledby="vulnerabilityHeading" data-bs-parent="#loginHelp">
                            <div class="accordion-body">
                                <p>This login form demonstrates these vulnerabilities:</p>
                                <ul>
                                    <li><strong>SQL Injection</strong> - At low security level, input is not sanitized.</li>
                                    <li><strong>Brute Force</strong> - No protection against multiple login attempts.</li>
                                    <li><strong>XSS</strong> - Username and error messages are not properly escaped.</li>
                                </ul>
                                <p>Change the security level to see different protection implementations.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-dark text-white">
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
    
    <!-- Login Form Handling with Vulnerabilities -->
    <script>
        $(document).ready(function() {
            // Login form submission
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                
                // Get the current security level
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                // Get form data
                const username = $('#username').val();
                const password = $('#password').val();
                
                // This simulates different server-side validation based on security level
                let isValidLogin = false;
                let errorMessage = '';
                
                switch(securityLevel) {
                    case 'low':
                        // Low security - vulnerable to SQL injection and no brute force protection
                        // In a real app, this would make a direct request to the server
                        
                        // Simulate SQL injection vulnerability
                        if (username === "admin' --" || 
                            username === 'admin" --' || 
                            username === "admin') OR 1=1 --" ||
                            (username === 'admin' && password === 'admin123')) {
                            isValidLogin = true;
                        } else {
                            errorMessage = 'Invalid username or password';
                        }
                        break;
                        
                    case 'medium':
                        // Medium security - some input sanitization but still vulnerable
                        if (username === 'admin' && password === 'admin123') {
                            isValidLogin = true;
                        } else {
                            errorMessage = 'Invalid username or password. Failed attempts are being logged.';
                        }
                        break;
                        
                    case 'high':
                        // High security - proper validation and brute force protection
                        if (username === 'admin' && password === 'admin123') {
                            isValidLogin = true;
                        } else {
                            // Simulate CAPTCHA after failed attempts
                            errorMessage = 'Invalid username or password. After 3 failed attempts, CAPTCHA will be required.';
                        }
                        break;
                }
                
                // Process login result
                if (isValidLogin) {
                    // Successful login
                    $('#loginMessage').html('<div class="alert alert-success">Login successful! Redirecting...</div>');
                    
                    // Redirect to dashboard
                    setTimeout(function() {
                        window.location.href = 'dashboard.php';
                    }, 1500);
                } else {
                    // Failed login
                    const errorHTML = `<div class="alert alert-danger">${errorMessage}</div>`;
                    $('#loginMessage').html(errorHTML);
                }
            });
        });
    </script>
</body>
</html>