<?php
/**
 * HackMeBank - Installation Script
 * 
 * This script guides users through the installation process of HackMeBank.
 * It checks system requirements, database connectivity, and sets up the initial configuration.
 * 
 * WARNING: This application contains deliberate vulnerabilities for educational purposes.
 * DO NOT use in a production environment.
 */

// Start session
session_start();

// Define installation steps
$steps = [
    1 => 'Welcome',
    2 => 'System Requirements',
    3 => 'Database Configuration',
    4 => 'Admin Account Setup',
    5 => 'Installation',
    6 => 'Completion'
];

// Get current step
$currentStep = isset($_GET['step']) ? (int)$_GET['step'] : 1;

// Validate step
if (!isset($steps[$currentStep])) {
    $currentStep = 1;
}

// Process form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch($currentStep) {
        case 3: // Database Configuration
            $_SESSION['db_host'] = $_POST['db_host'] ?? 'localhost';
            $_SESSION['db_name'] = $_POST['db_name'] ?? 'hackmebank';
            $_SESSION['db_user'] = $_POST['db_user'] ?? 'root';
            $_SESSION['db_pass'] = $_POST['db_pass'] ?? '';
            
            // Test database connection WITHOUT specifying database name first
            $conn = @mysqli_connect(
                $_SESSION['db_host'],
                $_SESSION['db_user'],
                $_SESSION['db_pass']
            );
            
            if (!$conn) {
                $error = "Database connection failed: " . mysqli_connect_error();
            } else {
                // Connection successful, try to create the database if it doesn't exist
                $dbName = $_SESSION['db_name'];
                $query = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
                
                if (!mysqli_query($conn, $query)) {
                    $error = "Failed to create database: " . mysqli_error($conn);
                } else {
                    // Now try to select and use the database
                    if (!mysqli_select_db($conn, $dbName)) {
                        $error = "Unable to select database: " . mysqli_error($conn);
                    } else {
                        // Database connection and selection successful
                        mysqli_close($conn);
                        header("Location: install.php?step=4");
                        exit;
                    }
                }
                mysqli_close($conn);
            }
            break;
            
        case 4: // Admin Account Setup
            $_SESSION['admin_username'] = $_POST['admin_username'] ?? 'admin';
            $_SESSION['admin_password'] = $_POST['admin_password'] ?? '';
            $_SESSION['admin_email'] = $_POST['admin_email'] ?? 'admin@hackmebank.local';
            
            // Simple validation
            if (empty($_SESSION['admin_password'])) {
                $error = "Administrator password cannot be empty";
            } else if ($_SESSION['admin_password'] !== $_POST['admin_password_confirm']) {
                $error = "Passwords do not match";
            } else {
                // Proceed to installation step
                header("Location: install.php?step=5");
                exit;
            }
            break;
            
        case 5: // Installation
            $installed = installDatabase();
            if ($installed === true) {
                $_SESSION['installed'] = true;
                header("Location: install.php?step=6");
                exit;
            } else {
                $error = $installed; // Error message
            }
            break;
    }
}

/**
 * Checks if PHP requirements are met
 */
function checkRequirements() {
    $requirements = [
        'php_version' => [
            'required' => '7.4.0',
            'current' => PHP_VERSION,
            'result' => version_compare(PHP_VERSION, '7.4.0', '>=')
        ],
        'mysqli' => [
            'required' => 'Enabled',
            'current' => extension_loaded('mysqli') ? 'Enabled' : 'Disabled',
            'result' => extension_loaded('mysqli')
        ],
        'pdo_mysql' => [
            'required' => 'Enabled',
            'current' => extension_loaded('pdo_mysql') ? 'Enabled' : 'Disabled',
            'result' => extension_loaded('pdo_mysql')
        ],
        'file_uploads' => [
            'required' => 'Enabled',
            'current' => ini_get('file_uploads') ? 'Enabled' : 'Disabled',
            'result' => ini_get('file_uploads')
        ],
        'allow_url_fopen' => [
            'required' => 'Enabled',
            'current' => ini_get('allow_url_fopen') ? 'Enabled' : 'Disabled',
            'result' => ini_get('allow_url_fopen')
        ]
    ];
    
    return $requirements;
}

/**
 * Executes a SQL statement with error handling
 */
function executeSqlStatement($conn, $sql) {
    if (empty(trim($sql))) return true;
    
    if (!mysqli_query($conn, $sql)) {
        return "SQL Error: " . mysqli_error($conn) . "\n\nQuery: " . substr($sql, 0, 200);
    }
    return true;
}

/**
 * Installs the database schema and creates admin account
 */
function installDatabase() {
    // Connect to database
    $conn = @mysqli_connect(
        $_SESSION['db_host'],
        $_SESSION['db_user'],
        $_SESSION['db_pass']
    );
    
    if (!$conn) {
        return "Database connection failed: " . mysqli_connect_error();
    }
    
    // Create database if not exists
    $dbName = $_SESSION['db_name'];
    $query = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
    if (!mysqli_query($conn, $query)) {
        return "Failed to create database: " . mysqli_error($conn);
    }
    
    // Select the database
    mysqli_select_db($conn, $dbName);
    
    // Import schema from SQL file
    $sqlFile = '../database/setup/database.sql';
    
    if (!file_exists($sqlFile)) {
        return "SQL file not found: $sqlFile";
    }
    
    // Execute SQL statements manually one by one
    $sql = file_get_contents($sqlFile);
    $statements = explode(';', $sql);
    
    foreach ($statements as $statement) {
        $statement = trim($statement);
        if (empty($statement)) continue;
        
        $result = executeSqlStatement($conn, $statement);
        if ($result !== true) {
            return $result; // Return error message
        }
    }
    
    // Create admin account
    $username = $_SESSION['admin_username'];
    $email = $_SESSION['admin_email'];
    
    // Hash the password for storage (in a real app, you'd use password_hash, but this is deliberately weak for demo purposes)
    $password = md5($_SESSION['admin_password']); // Deliberately weak hashing for demonstration purposes
    
    // Check if admin already exists
    $query = "SELECT id FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        // Update existing admin
        $query = "UPDATE users SET password = '$password', email = '$email' WHERE username = '$username'";
    } else {
        // Create new admin
        $query = "INSERT INTO users (username, password, email, first_name, last_name, role_id) 
                 VALUES ('$username', '$password', '$email', 'System', 'Admin', 3)";
    }
    
    if (!mysqli_query($conn, $query)) {
        return "Failed to create admin account: " . mysqli_error($conn);
    }
    
    // Set up security settings for admin
    $query = "SELECT id FROM user_security_settings WHERE user_id = 1";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) == 0) {
        // Add security setting for admin (uses the highest security level by default)
        $query = "INSERT INTO user_security_settings (user_id, security_level_id) VALUES (1, 3)";
        if (!mysqli_query($conn, $query)) {
            return "Failed to set up admin security settings: " . mysqli_error($conn);
        }
    }
    
    // Write database configuration
    $configFile = '../config/database.php';
    
    // Create config directory if it doesn't exist
    if (!is_dir('../config')) {
        mkdir('../config', 0755, true);
    }
    
    $config = "<?php
/**
 * HackMeBank Database Configuration
 * Generated by installation script on " . date('Y-m-d H:i:s') . "
 */

return [
    'host'      => '{$_SESSION['db_host']}',
    'database'  => '{$_SESSION['db_name']}',
    'username'  => '{$_SESSION['db_user']}',
    'password'  => '{$_SESSION['db_pass']}',
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
];
";
    
    if (!file_put_contents($configFile, $config)) {
        return "Failed to write database configuration file";
    }
    
    // Create installation lock file
    file_put_contents('../.installed', date('Y-m-d H:i:s'));
    
    mysqli_close($conn);
    return true;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Install HackMeBank</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .install-container {
            max-width: 700px;
            padding: 15px;
            margin: 0 auto;
        }
        .install-header {
            background: linear-gradient(135deg, #1a3b6e 0%, #0d8a6f 100%);
            color: white;
            padding: 20px;
            border-radius: 5px 5px 0 0;
            margin-bottom: 0;
        }
        .install-body {
            background-color: white;
            border-radius: 0 0 5px 5px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        .install-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .step {
            text-align: center;
            position: relative;
            flex: 1;
        }
        .step::after {
            content: '';
            position: absolute;
            top: 15px;
            right: -50%;
            width: 100%;
            height: 2px;
            background-color: #dee2e6;
            z-index: 1;
        }
        .step:last-child::after {
            display: none;
        }
        .step-number {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 50%;
            background-color: #dee2e6;
            color: #6c757d;
            font-weight: bold;
            margin-bottom: 10px;
            position: relative;
            z-index: 2;
        }
        .step.active .step-number {
            background-color: #1a3b6e;
            color: white;
        }
        .step.completed .step-number {
            background-color: #28a745;
            color: white;
        }
        .warning-box {
            background-color: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin-bottom: 20px;
        }
        .requirement-item {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .requirement-item:last-child {
            border-bottom: none;
        }
        .success-icon {
            color: #28a745;
        }
        .error-icon {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container install-container">
        <div class="install-header">
            <h2><i class="bi bi-bank"></i> HackMeBank Installation</h2>
            <p class="mb-0">A deliberately vulnerable banking application for cybersecurity training</p>
        </div>
        
        <div class="install-body">
            <!-- Installation Steps -->
            <div class="install-steps">
                <?php foreach ($steps as $stepNum => $stepName) : ?>
                    <div class="step <?php echo $currentStep == $stepNum ? 'active' : ($currentStep > $stepNum ? 'completed' : ''); ?>">
                        <div class="step-number"><?php echo $stepNum; ?></div>
                        <div class="step-name"><?php echo $stepName; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <!-- Step Content -->
            <?php switch($currentStep) : 
                case 1: // Welcome ?>
                    <h3>Welcome to HackMeBank</h3>
                    
                    <div class="warning-box my-4">
                        <h5 class="text-warning"><i class="bi bi-exclamation-triangle-fill"></i> WARNING</h5>
                        <p>This application contains <strong>DELIBERATE</strong> security vulnerabilities for educational purposes.</p>
                        <ul>
                            <li>DO NOT deploy on public servers or production environments</li>
                            <li>DO NOT use real credentials or sensitive data</li>
                            <li>ONLY run in a controlled, isolated environment</li>
                            <li>USE AT YOUR OWN RISK</li>
                        </ul>
                    </div>
                    
                    <p>HackMeBank is an educational platform designed to demonstrate common web application security vulnerabilities in a banking context. It allows cybersecurity students and professionals to practice identifying, exploiting, and mitigating web security issues in a safe, controlled environment.</p>
                    
                    <p>This installation wizard will guide you through the setup process.</p>
                    
                    <div class="mt-4 text-end">
                        <a href="?step=2" class="btn btn-primary">Continue <i class="bi bi-arrow-right"></i></a>
                    </div>
                <?php break; 
                
                case 2: // System Requirements 
                    $requirements = checkRequirements();
                    $allRequirementsMet = true;
                    
                    foreach ($requirements as $requirement) {
                        if (!$requirement['result']) {
                            $allRequirementsMet = false;
                            break;
                        }
                    }
                ?>
                    <h3>System Requirements</h3>
                    
                    <p class="my-3">The following requirements must be met to install HackMeBank:</p>
                    
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <div class="requirement-item d-flex justify-content-between align-items-center">
                                <div><strong>Requirement</strong></div>
                                <div class="d-flex">
                                    <div class="me-4 text-center" style="width: 100px;"><strong>Required</strong></div>
                                    <div class="me-4 text-center" style="width: 100px;"><strong>Current</strong></div>
                                    <div class="text-center" style="width: 50px;"><strong>Status</strong></div>
                                </div>
                            </div>
                            
                            <?php foreach ($requirements as $key => $requirement) : ?>
                                <div class="requirement-item d-flex justify-content-between align-items-center">
                                    <div><?php echo ucfirst(str_replace('_', ' ', $key)); ?></div>
                                    <div class="d-flex">
                                        <div class="me-4 text-center" style="width: 100px;"><?php echo $requirement['required']; ?></div>
                                        <div class="me-4 text-center" style="width: 100px;"><?php echo $requirement['current']; ?></div>
                                        <div class="text-center" style="width: 50px;">
                                            <?php if ($requirement['result']) : ?>
                                                <span class="success-icon">✓</span>
                                            <?php else : ?>
                                                <span class="error-icon">✗</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="?step=1" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                        <?php if ($allRequirementsMet) : ?>
                            <a href="?step=3" class="btn btn-primary">Continue <i class="bi bi-arrow-right"></i></a>
                        <?php else : ?>
                            <button class="btn btn-secondary" disabled>Continue <i class="bi bi-arrow-right"></i></button>
                            <p class="text-danger">Please fix the requirements issues before continuing.</p>
                        <?php endif; ?>
                    </div>
                <?php break; 
                
                case 3: // Database Configuration ?>
                    <h3>Database Configuration</h3>
                    
                    <p class="my-3">Please provide your database connection details:</p>
                    
                    <form method="post">
                        <div class="mb-3">
                            <label for="db_host" class="form-label">Database Host</label>
                            <input type="text" class="form-control" id="db_host" name="db_host" value="<?php echo $_SESSION['db_host'] ?? 'localhost'; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="db_name" class="form-label">Database Name</label>
                            <input type="text" class="form-control" id="db_name" name="db_name" value="<?php echo $_SESSION['db_name'] ?? 'hackmebank'; ?>" required>
                            <div class="form-text">If the database doesn't exist, we'll try to create it for you.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="db_user" class="form-label">Database Username</label>
                            <input type="text" class="form-control" id="db_user" name="db_user" value="<?php echo $_SESSION['db_user'] ?? 'root'; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="db_pass" class="form-label">Database Password</label>
                            <input type="password" class="form-control" id="db_pass" name="db_pass" value="<?php echo $_SESSION['db_pass'] ?? ''; ?>">
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="?step=2" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary">Continue <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </form>
                <?php break; 
                
                case 4: // Admin Account Setup ?>
                    <h3>Admin Account Setup</h3>
                    
                    <p class="my-3">Create an administrator account for HackMeBank:</p>
                    
                    <form method="post">
                        <div class="mb-3">
                            <label for="admin_username" class="form-label">Admin Username</label>
                            <input type="text" class="form-control" id="admin_username" name="admin_username" value="<?php echo $_SESSION['admin_username'] ?? 'admin'; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_email" class="form-label">Admin Email</label>
                            <input type="email" class="form-control" id="admin_email" name="admin_email" value="<?php echo $_SESSION['admin_email'] ?? 'admin@hackmebank.local'; ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_password" class="form-label">Admin Password</label>
                            <input type="password" class="form-control" id="admin_password" name="admin_password" required>
                            <div class="form-text text-warning">Note: This application uses deliberately weak password hashing for educational purposes.</div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_password_confirm" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="admin_password_confirm" name="admin_password_confirm" required>
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="?step=3" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary">Continue <i class="bi bi-arrow-right"></i></button>
                        </div>
                    </form>
                <?php break; 
                
                case 5: // Installation ?>
                    <h3>Installing HackMeBank</h3>
                    
                    <div class="progress my-4">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 100%"></div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <h5>Installation Process</h5>
                            <ul class="list-group list-group-flush" id="installationLog">
                                <li class="list-group-item">Connecting to database...</li>
                                <li class="list-group-item">Creating database tables...</li>
                                <li class="list-group-item">Setting up initial data...</li>
                                <li class="list-group-item">Creating administrator account...</li>
                                <li class="list-group-item">Generating configuration files...</li>
                            </ul>
                        </div>
                    </div>
                    
                    <form method="post" class="mt-4 text-center">
                        <button type="submit" class="btn btn-primary btn-lg">Start Installation</button>
                    </form>
                <?php break; 
                
                case 6: // Completion 
                    // Check if installation completed
                    if (!isset($_SESSION['installed']) || $_SESSION['installed'] !== true) {
                        header("Location: install.php?step=1");
                        exit;
                    }
                ?>
                    <h3>Installation Complete!</h3>
                    
                    <div class="alert alert-success my-4">
                        <h5><i class="bi bi-check-circle-fill"></i> HackMeBank has been successfully installed!</h5>
                        <p class="mb-0">You can now access the application and start exploring the security vulnerabilities.</p>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Admin Account Details</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 fw-bold">Username:</div>
                                <div class="col-md-9"><?php echo $_SESSION['admin_username']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 fw-bold">Email:</div>
                                <div class="col-md-9"><?php echo $_SESSION['admin_email']; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 fw-bold">Password:</div>
                                <div class="col-md-9"><em>As set during installation</em></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="warning-box my-4">
                        <h5 class="text-warning"><i class="bi bi-exclamation-triangle-fill"></i> Security Reminder</h5>
                        <p>Remember that HackMeBank contains <strong>deliberate security vulnerabilities</strong> for educational purposes. Do not use it with real data or on public servers.</p>
                    </div>
                    
                    <div class="mt-4 text-center">
                        <a href="../index.php" class="btn btn-success btn-lg">Go to HackMeBank</a>
                    </div>
                    
                    <?php 
                    // Clear installation session data
                    $_SESSION = array();
                    session_destroy();
                    ?>
                <?php break; 
            endswitch; ?>
        </div>
    </div>
    
    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</body>
</html>