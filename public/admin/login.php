<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - HackMeBank</title>
    <!-- Bootstrap CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="../css/main.css" rel="stylesheet">
    <link href="../css/banking-theme.css" rel="stylesheet">
    <link href="../css/security-display.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <style>
        .admin-auth-wrapper {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('../assets/images/background.jpg') center/cover no-repeat fixed;
            position: relative;
        }

        .admin-auth-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1;
        }

        .admin-auth-card {
            width: 100%;
            max-width: 450px;
            z-index: 2;
            background-color: white;
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            border-top: 5px solid #dc3545;
        }
        
        .admin-auth-title {
            color: #dc3545;
        }
        
        .vulnerability-hint {
            font-size: 0.85rem;
            padding: 0.5rem;
            background-color: rgba(255, 193, 7, 0.1);
            border-left: 3px solid #ffc107;
            margin-top: 0.5rem;
        }
        
        .attempt-counter {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
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

    <!-- Admin Login Form -->
    <div class="admin-auth-wrapper">
        <div class="admin-auth-card">
            <div class="text-center mb-4">
                <i class="bi bi-shield-lock" style="font-size: 3rem; color: #dc3545;"></i>
                <h2 class="admin-auth-title mt-3">Admin Login</h2>
                <p class="text-muted">Secure access to HackMeBank administrative panel</p>
            </div>

            <!-- Security Notice -->
            <div class="alert alert-warning mb-4">
                <strong>Security Notice:</strong> This login form contains deliberate security vulnerabilities for educational purposes. Current security level: <span class="current-security-level badge bg-danger">Low</span>
            </div>

            <!-- Login Form with Brute Force Vulnerability -->
            <form id="adminLoginForm" method="post" action="dashboard.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-danger text-white"><i class="bi bi-person"></i></span>
                        <input type="text" class="form-control" id="username" name="username" 
                               placeholder="Admin username" value="admin" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-danger text-white"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" id="password" name="password" 
                               placeholder="Admin password" required>
                        <button class="btn btn-outline-secondary password-toggle" type="button" 
                                data-target="#password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <!-- Vulnerability hint for Brute Force -->
                    <div class="vulnerability-hint">
                        <strong>Vulnerability:</strong> This form is vulnerable to brute force attacks. Try common admin passwords or use automated tools.
                        <div class="mt-1">Password hint: The password is a common one from the top 10 passwords list with 'admin' at the end.</div>
                    </div>
                </div>
                
                <div id="captchaContainer" style="display: none;">
                    <div class="mb-3">
                        <label for="captcha" class="form-label">CAPTCHA Verification</label>
                        <div class="d-flex align-items-center mb-2">
                            <div class="captcha-image bg-light text-center py-2 px-3 me-2 flex-grow-1">
                                <span id="captchaText" style="font-family: monospace; font-size: 1.25rem; letter-spacing: 3px; font-weight: bold;">ABC123</span>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="refreshCaptcha">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control" id="captcha" name="captcha" 
                               placeholder="Enter the code shown above" required>
                    </div>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-danger">Login</button>
                </div>
                
                <!-- Login attempts counter (visible only at medium/high security) -->
                <div class="attempt-counter" id="attemptCounter" style="display: none;">
                    Failed login attempts: <span id="attemptCount">0</span>
                </div>
                
                <!-- Placeholder for login errors -->
                <div id="loginMessage" class="mt-3"></div>
            </form>
            
            <div class="mt-4 text-center">
                <a href="../login.php" class="text-muted"><i class="bi bi-arrow-left"></i> Return to Customer Login</a>
            </div>
            
            <div class="mt-3">
                <div class="accordion" id="loginHelp">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="vulnerabilityHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                                    data-bs-target="#vulnerabilityInfo">
                                Brute Force Vulnerability Information
                            </button>
                        </h2>
                        <div id="vulnerabilityInfo" class="accordion-collapse collapse" 
                             aria-labelledby="vulnerabilityHeading" data-bs-parent="#loginHelp">
                            <div class="accordion-body">
                                <p>This admin login form demonstrates the brute force vulnerability at different security levels:</p>
                                <ul>
                                    <li><strong>Low Security:</strong> No protection against brute force attempts. No account lockout, rate limiting, or CAPTCHA.</li>
                                    <li><strong>Medium Security:</strong> Basic protection with login attempt counting and eventual CAPTCHA requirement after 3 failed attempts.</li>
                                    <li><strong>High Security:</strong> Strong protection with account lockout, IP tracking, CAPTCHA, and longer password requirements.</li>
                                </ul>
                                <p>On a real banking site, admin credentials should be protected with multiple layers of security, including strong password policies, multi-factor authentication, IP restrictions, and rate limiting.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer py-3 bg-dark text-white">
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
    
    <!-- Brute Force Demo Script -->
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('.password-toggle').on('click', function() {
                const passwordInput = $($(this).data('target'));
                const icon = $(this).find('i');
                
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    icon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    icon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });
            
            // Initialize attempt counter from localStorage or set to 0
            let loginAttempts = parseInt(localStorage.getItem('adminLoginAttempts') || '0');
            
            // Update attempt counter display
            function updateAttemptCounter() {
                $('#attemptCount').text(loginAttempts);
            }
            
            // Show/hide CAPTCHA based on security level and attempts
            function updateCaptchaVisibility() {
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                // Show attempt counter for medium and high security
                if (securityLevel === 'medium' || securityLevel === 'high') {
                    $('#attemptCounter').show();
                    updateAttemptCounter();
                } else {
                    $('#attemptCounter').hide();
                }
                
                // Show CAPTCHA based on security level and number of attempts
                if ((securityLevel === 'medium' && loginAttempts >= 3) || 
                    (securityLevel === 'high' && loginAttempts >= 2)) {
                    $('#captchaContainer').show();
                    generateCaptcha();
                } else {
                    $('#captchaContainer').hide();
                }
            }
            
            // Generate a random CAPTCHA code
            function generateCaptcha() {
                const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789';
                let captcha = '';
                for (let i = 0; i < 6; i++) {
                    captcha += chars.charAt(Math.floor(Math.random() * chars.length));
                }
                $('#captchaText').text(captcha);
                return captcha;
            }
            
            // Handle CAPTCHA refresh
            $('#refreshCaptcha').on('click', function() {
                generateCaptcha();
            });
            
            // Initial setup
            updateCaptchaVisibility();
            
            // Handle login form submission with brute force vulnerability
            $('#adminLoginForm').on('submit', function(e) {
                e.preventDefault();
                
                const username = $('#username').val();
                const password = $('#password').val();
                const captchaInput = $('#captcha').val();
                const captchaText = $('#captchaText').text();
                
                // Get the current security level
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                // Check if account is locked (high security)
                if (securityLevel === 'high' && loginAttempts >= 5) {
                    $('#loginMessage').html(`
                        <div class="alert alert-danger">
                            <strong>Account Locked!</strong> Too many failed login attempts. 
                            Please contact the system administrator to unlock your account.
                        </div>
                    `);
                    return;
                }
                
                // Validate CAPTCHA if visible
                if ($('#captchaContainer').is(':visible')) {
                    if (captchaInput !== captchaText) {
                        $('#loginMessage').html(`
                            <div class="alert alert-danger">
                                <strong>CAPTCHA Failed!</strong> The verification code you entered is incorrect.
                            </div>
                        `);
                        generateCaptcha();
                        return;
                    }
                }
                
                // Check credentials (intentionally simple for brute force demo)
                let isValidLogin = false;
                
                // Define different password validation based on security level
                switch(securityLevel) {
                    case 'low':
                        // Low security - basic password
                        isValidLogin = (username === 'admin' && password === 'password123admin');
                        break;
                        
                    case 'medium':
                        // Medium security - slightly more complex validation
                        isValidLogin = (username === 'admin' && password === 'password123admin');
                        break;
                        
                    case 'high':
                        // High security - stronger password requirement
                        isValidLogin = (username === 'admin' && password === 'password123admin');
                        break;
                }
                
                // Process login result
                if (isValidLogin) {
                    // Successful login
                    $('#loginMessage').html(`
                        <div class="alert alert-success">
                            <strong>Login Successful!</strong> Redirecting to admin dashboard...
                        </div>
                    `);
                    
                    // Reset login attempts
                    loginAttempts = 0;
                    localStorage.setItem('adminLoginAttempts', loginAttempts);
                    
                    // Redirect to dashboard
                    setTimeout(function() {
                        window.location.href = 'dashboard.php';
                    }, 1500);
                } else {
                    // Failed login - increment attempt counter
                    loginAttempts++;
                    localStorage.setItem('adminLoginAttempts', loginAttempts);
                    updateAttemptCounter();
                    
                    // Update CAPTCHA visibility based on new attempt count
                    updateCaptchaVisibility();
                    
                    // Different error messages based on security level
                    let errorMessage = '';
                    
                    switch(securityLevel) {
                        case 'low':
                            errorMessage = `<strong>Login Failed!</strong> Invalid username or password.`;
                            break;
                            
                        case 'medium':
                            errorMessage = `<strong>Login Failed!</strong> Invalid username or password. (${loginAttempts} failed attempts)`;
                            if (loginAttempts >= 3) {
                                errorMessage += `<br>Please complete the CAPTCHA verification.`;
                            }
                            break;
                            
                        case 'high':
                            errorMessage = `<strong>Login Failed!</strong> Invalid username or password. (${loginAttempts} of 5 attempts before lockout)`;
                            if (loginAttempts >= 2) {
                                errorMessage += `<br>Please complete the CAPTCHA verification.`;
                            }
                            break;
                    }
                    
                    $('#loginMessage').html(`
                        <div class="alert alert-danger">
                            ${errorMessage}
                        </div>
                    `);
                }
            });
            
            // Update security features when security level changes
            $('.security-btn').on('click', function() {
                setTimeout(updateCaptchaVisibility, 200);
            });
        });
    </script>
</body>
</html>