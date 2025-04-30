<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - HackMeBank</title>
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

    <!-- Registration Form -->
    <div class="auth-wrapper">
        <div class="auth-card">
            <div class="auth-logo">
                <img src="assets/images/logo.png" alt="HackMeBank Logo">
            </div>
            <h2 class="auth-title">Create Your Account</h2>

            <!-- Security Notice -->
            <div class="alert alert-warning mb-4">
                <strong>Security Notice:</strong> This registration form contains deliberate security vulnerabilities for educational purposes. Current security level: <span class="current-security-level badge bg-danger">Low</span>
            </div>

            <!-- Registration Form with Vulnerabilities -->
            <form id="registrationForm" method="post" action="registration_success.php">
                <!-- Personal Information -->
                <h5 class="mb-3">Personal Information</h5>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="firstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" required>
                    </div>
                    <div class="col-md-6">
                        <label for="lastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastName" name="lastName" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <div class="form-text text-muted">
                        This will be used as your login username.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                    <!-- Vulnerability hint for age verification -->
                    <div class="form-text vulnerability-hint">
                        <strong>Vulnerability:</strong> Client-side age verification can be bypassed.
                    </div>
                </div>
                
                <!-- Address Information -->
                <h5 class="mb-3 mt-4">Address Information</h5>
                
                <div class="mb-3">
                    <label for="address" class="form-label">Street Address</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="col-md-6">
                        <label for="zipCode" class="form-label">ZIP Code</label>
                        <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <select class="form-select" id="country" name="country" required>
                        <option value="">Select a country</option>
                        <option value="US">United States</option>
                        <option value="CA">Canada</option>
                        <option value="UK">United Kingdom</option>
                        <option value="AU">Australia</option>
                        <option value="FR">France</option>
                        <option value="DE">Germany</option>
                    </select>
                </div>
                
                <!-- Account Information -->
                <h5 class="mb-3 mt-4">Account Setup</h5>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" id="password" name="password" required>
                        <button class="btn btn-outline-secondary password-toggle" type="button" data-target="#password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    <div id="passwordStrength" class="form-text mt-2">
                        Password must be at least 8 characters long.
                    </div>
                    <!-- Vulnerability hint for weak password policy -->
                    <div class="form-text vulnerability-hint">
                        <strong>Vulnerability:</strong> Weak password policy with only client-side validation.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                </div>
                
                <div class="mb-3">
                    <label for="securityQuestion" class="form-label">Security Question</label>
                    <select class="form-select" id="securityQuestion" name="securityQuestion" required>
                        <option value="">Select a security question</option>
                        <option value="petName">What was your first pet's name?</option>
                        <option value="mothersMaiden">What is your mother's maiden name?</option>
                        <option value="elementary">What elementary school did you attend?</option>
                        <option value="birthCity">In what city were you born?</option>
                        <option value="firstCar">What was your first car?</option>
                    </select>
                    <!-- Vulnerability hint for security questions -->
                    <div class="form-text vulnerability-hint">
                        <strong>Vulnerability:</strong> Weak security questions that can be easily researched.
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="securityAnswer" class="form-label">Security Answer</label>
                    <input type="text" class="form-control" id="securityAnswer" name="securityAnswer" required>
                </div>
                
                <!-- Initial Deposit Section -->
                <h5 class="mb-3 mt-4">Initial Deposit</h5>
                
                <div class="mb-3">
                    <label for="accountType" class="form-label">Account Type</label>
                    <select class="form-select" id="accountType" name="accountType" required>
                        <option value="checking">Checking Account</option>
                        <option value="savings">Savings Account</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="initialDeposit" class="form-label">Initial Deposit Amount</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="initialDeposit" name="initialDeposit" min="100" step="0.01" value="100" required>
                    </div>
                    <div class="form-text text-muted">Minimum initial deposit: $100.00</div>
                    <!-- Vulnerability hint for deposit amount validation -->
                    <div class="form-text vulnerability-hint">
                        <strong>Vulnerability:</strong> Client-side minimum deposit validation can be bypassed.
                    </div>
                </div>
                
                <!-- Terms and Conditions -->
                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="termsConditions" name="termsConditions" required>
                        <label class="form-check-label" for="termsConditions">
                            I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#termsModal">Terms and Conditions</a>
                        </label>
                    </div>
                </div>
                
                <!-- Hidden fields (prone to tampering) -->
                <input type="hidden" id="referralCode" name="referralCode" value="STANDARD">
                <input type="hidden" id="accountTier" name="accountTier" value="basic">
                
                <!-- Vulnerability hint for hidden form fields -->
                <div class="alert alert-danger vulnerability-hint mb-4">
                    <strong>Vulnerability:</strong> Hidden form fields can be manipulated to gain premium account access.<br>
                    Try changing "accountTier" to "premium" to bypass account upgrade fees.
                </div>
                
                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Create Account</button>
                </div>
                
                <!-- Registration Error/Success Message -->
                <div id="registrationMessage" class="mt-3"></div>
            </form>
            
            <div class="mt-4 text-center">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </div>
    </div>

    <!-- Terms and Conditions Modal -->
    <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsModalLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>HackMeBank Account Terms</h6>
                    <p>This is a deliberately vulnerable banking application for educational purposes. By creating an account, you acknowledge the following:</p>
                    <ol>
                        <li>This is NOT a real banking application. Do not use real personal information.</li>
                        <li>This application contains intentional security vulnerabilities for cybersecurity education and training.</li>
                        <li>The application should only be used in a secure, controlled environment.</li>
                        <li>Any data entered is not secured and should be considered public.</li>
                        <li>The application may be unstable or behave unpredictably due to its educational nature.</li>
                    </ol>
                    <p>This application is meant to demonstrate common web vulnerabilities and should never be deployed in a production environment.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">I Understand</button>
                </div>
            </div>
        </div>
    </div>

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
    
    <!-- Registration Form Handling with Vulnerabilities -->
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
            
            // Password strength indicator
            $('#password').on('input', function() {
                const password = $(this).val();
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                let strengthMessage = '';
                let strengthClass = '';
                
                if (securityLevel === 'low') {
                    // Low security - basic length check
                    if (password.length < 8) {
                        strengthMessage = 'Password must be at least 8 characters long.';
                        strengthClass = 'text-danger';
                    } else {
                        strengthMessage = 'Password meets minimum requirements.';
                        strengthClass = 'text-success';
                    }
                } else if (securityLevel === 'medium') {
                    // Medium security - check for complexity
                    const hasUppercase = /[A-Z]/.test(password);
                    const hasLowercase = /[a-z]/.test(password);
                    const hasNumber = /\d/.test(password);
                    
                    if (password.length < 8) {
                        strengthMessage = 'Password must be at least 8 characters long.';
                        strengthClass = 'text-danger';
                    } else if (!hasUppercase || !hasLowercase || !hasNumber) {
                        strengthMessage = 'Password should contain uppercase, lowercase letters, and numbers.';
                        strengthClass = 'text-warning';
                    } else {
                        strengthMessage = 'Password meets medium security requirements.';
                        strengthClass = 'text-success';
                    }
                } else if (securityLevel === 'high') {
                    // High security - strong password requirements
                    const hasUppercase = /[A-Z]/.test(password);
                    const hasLowercase = /[a-z]/.test(password);
                    const hasNumber = /\d/.test(password);
                    const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                    
                    if (password.length < 12) {
                        strengthMessage = 'Password must be at least 12 characters long.';
                        strengthClass = 'text-danger';
                    } else if (!hasUppercase || !hasLowercase || !hasNumber || !hasSpecial) {
                        strengthMessage = 'Password must contain uppercase, lowercase, numbers, and special characters.';
                        strengthClass = 'text-warning';
                    } else {
                        strengthMessage = 'Password meets high security requirements.';
                        strengthClass = 'text-success';
                    }
                }
                
                $('#passwordStrength').html(strengthMessage).removeClass('text-danger text-warning text-success').addClass(strengthClass);
            });
            
            // Age verification
            $('#birthdate').on('change', function() {
                const birthdate = new Date($(this).val());
                const today = new Date();
                const age = today.getFullYear() - birthdate.getFullYear();
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                // Adjust age if birthday hasn't occurred yet this year
                const monthDiff = today.getMonth() - birthdate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                    age--;
                }
                
                // Check age based on security level
                if (securityLevel === 'low' || securityLevel === 'medium') {
                    // Only show warning, but don't prevent form submission
                    if (age < 18) {
                        $(this).addClass('is-invalid');
                        $(this).after('<div class="invalid-feedback">You must be at least 18 years old to register.</div>');
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                    }
                } else if (securityLevel === 'high') {
                    // Strict validation (still client-side but more restrictive)
                    if (age < 18) {
                        $(this).addClass('is-invalid');
                        $(this).after('<div class="invalid-feedback">You must be at least 18 years old to register.</div>');
                        $('#registrationMessage').html('<div class="alert alert-danger">You must be at least 18 years old to register for a bank account.</div>');
                    } else {
                        $(this).removeClass('is-invalid');
                        $(this).next('.invalid-feedback').remove();
                        $('#registrationMessage').empty();
                    }
                }
            });
            
            // Form submission with security level-based validation
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                
                // Get security level
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                let isValid = true;
                let errorMessage = '';
                
                // Get form values
                const firstName = $('#firstName').val();
                const lastName = $('#lastName').val();
                const email = $('#email').val();
                const password = $('#password').val();
                const confirmPassword = $('#confirmPassword').val();
                const birthdate = new Date($('#birthdate').val());
                const initialDeposit = parseFloat($('#initialDeposit').val());
                const accountTier = $('#accountTier').val();
                
                // Calculate age
                const today = new Date();
                let age = today.getFullYear() - birthdate.getFullYear();
                const monthDiff = today.getMonth() - birthdate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthdate.getDate())) {
                    age--;
                }
                
                // Different validation based on security level
                switch(securityLevel) {
                    case 'low':
                        // Low security - minimal validation
                        if (password !== confirmPassword) {
                            isValid = false;
                            errorMessage = 'Passwords do not match.';
                        }
                        break;
                        
                    case 'medium':
                        // Medium security - more validation
                        if (password !== confirmPassword) {
                            isValid = false;
                            errorMessage = 'Passwords do not match.';
                        }
                        
                        if (password.length < 8) {
                            isValid = false;
                            errorMessage = 'Password must be at least 8 characters long.';
                        }
                        
                        if (age < 18) {
                            isValid = false;
                            errorMessage = 'You must be at least 18 years old to register.';
                        }
                        
                        if (initialDeposit < 100) {
                            isValid = false;
                            errorMessage = 'Initial deposit must be at least $100.00.';
                        }
                        break;
                        
                    case 'high':
                        // High security - comprehensive validation
                        if (password !== confirmPassword) {
                            isValid = false;
                            errorMessage = 'Passwords do not match.';
                        }
                        
                        const hasUppercase = /[A-Z]/.test(password);
                        const hasLowercase = /[a-z]/.test(password);
                        const hasNumber = /\d/.test(password);
                        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);
                        
                        if (password.length < 12 || !hasUppercase || !hasLowercase || !hasNumber || !hasSpecial) {
                            isValid = false;
                            errorMessage = 'Password must be at least 12 characters and include uppercase, lowercase, numbers, and special characters.';
                        }
                        
                        if (age < 18) {
                            isValid = false;
                            errorMessage = 'You must be at least 18 years old to register.';
                        }
                        
                        if (initialDeposit < 100) {
                            isValid = false;
                            errorMessage = 'Initial deposit must be at least $100.00.';
                        }
                        
                        // Enforce proper account tier regardless of hidden field (check for tampering)
                        if (accountTier !== 'basic' && accountTier !== 'premium') {
                            isValid = false;
                            errorMessage = 'Invalid account tier selected.';
                        }
                        break;
                }
                
                // Display validation results
                if (!isValid) {
                    $('#registrationMessage').html(`
                        <div class="alert alert-danger">
                            <strong>Registration Failed:</strong> ${errorMessage}
                        </div>
                    `);
                    return;
                }
                
                // Check for hidden field tampering (for demo purposes)
                if (accountTier === 'premium') {
                    // Show message revealing the successful exploitation
                    $('#registrationMessage').html(`
                        <div class="alert alert-warning">
                            <strong>Hidden Field Manipulation Detected!</strong>
                            <p>You have changed the account tier to "premium" bypassing the normal upgrade process.</p>
                            <p>At security level: ${securityLevel}</p>
                            ${securityLevel === 'high' ? '<p>This attempt has been blocked and logged.</p>' : '<p>The manipulation was successful!</p>'}
                        </div>
                    `);
                    
                    // Don't continue with registration if high security
                    if (securityLevel === 'high') {
                        return;
                    }
                }
                
                // Simulate successful registration
                $('#registrationMessage').html(`
                    <div class="alert alert-success">
                        <h5>Registration Successful!</h5>
                        <p>Welcome to HackMeBank, ${firstName} ${lastName}!</p>
                        <p>Your account has been created with an initial deposit of $${initialDeposit.toFixed(2)}.</p>
                        <p>Account Tier: ${accountTier === 'premium' ? 'Premium (Successfully exploited!)' : 'Basic'}</p>
                        <hr>
                        <p>You will receive a confirmation email at ${email}. Please follow the instructions to complete your registration.</p>
                    </div>
                `);
                
                // Reset form
                this.reset();
                
                // Scroll to success message
                $('html, body').animate({
                    scrollTop: $('#registrationMessage').offset().top - 100
                }, 500);
            });
            
            // Update vulnerability hints based on security level
            function updateVulnerabilityHints() {
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                if (securityLevel === 'low') {
                    $('.vulnerability-hint').show();
                } else if (securityLevel === 'medium') {
                    $('.vulnerability-hint').show();
                } else if (securityLevel === 'high') {
                    $('.vulnerability-hint').hide();
                }
            }
            
            // Update hints when security level changes
            $('.security-btn').on('click', function() {
                setTimeout(updateVulnerabilityHints, 200);
            });
            
            // Initial setup
            updateVulnerabilityHints();
        });
    </script>
</body>
</html>