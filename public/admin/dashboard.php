<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - HackMeBank</title>
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
        .admin-header {
            background: linear-gradient(135deg, #1a3b6e 0%, #dc3545 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            border-radius: 0.5rem;
        }
        
        .admin-card {
            border-top: 3px solid #dc3545;
            transition: all 0.3s;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .admin-icon {
            font-size: 2.5rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }
        
        .stats-card {
            border-left: 4px solid #1a3b6e;
            transition: all 0.3s;
        }
        
        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            color: #1a3b6e;
        }
        
        .admin-sidebar {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1.5rem;
        }
        
        .admin-sidebar-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            border-radius: 0.25rem;
            color: #212529;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .admin-sidebar-link:hover, .admin-sidebar-link.active {
            background-color: #e9ecef;
            color: #dc3545;
        }
        
        .admin-sidebar-link i {
            margin-right: 0.75rem;
        }
        
        .action-required {
            position: relative;
        }
        
        .action-required::after {
            content: '';
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: #dc3545;
        }
        
        .user-actions .btn {
            padding: 0.25rem 0.5rem;
            font-size: 0.8rem;
        }
        
        .admin-search-box {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .admin-search-box input {
            padding-left: 2.5rem;
        }
        
        .admin-search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        
        .security-alert {
            border-left: 4px solid #dc3545;
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
                        <a class="nav-link active" href="dashboard.php">Admin Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="transactions.php">Transactions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="security.php">Security</a>
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

                <!-- Admin Dropdown -->
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown">
                        <i class="bi bi-shield-lock-fill me-1"></i>
                        <span class="username">Admin</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                        <li><a class="dropdown-item" href="profile.php">Admin Profile</a></li>
                        <li><a class="dropdown-item" href="settings.php">Admin Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="login.php">Logout</a></li>
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
                This admin dashboard contains deliberate security vulnerabilities for educational purposes.
                Current Security Level: <span class="current-security-level badge bg-danger ms-2">Low</span>
            </div>
        </div>

        <!-- Admin Header -->
        <div class="admin-header mb-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1><i class="bi bi-shield-lock"></i> Admin Dashboard</h1>
                        <p class="mb-0">Welcome to the HackMeBank administration panel. Manage users, view transactions, and monitor system security.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <button class="btn btn-light me-2"><i class="bi bi-gear"></i> Settings</button>
                        <button class="btn btn-light"><i class="bi bi-question-circle"></i> Help</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 mb-4">
                <div class="admin-sidebar">
                    <div class="admin-search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" class="form-control" placeholder="Search..." id="adminSearch">
                    </div>
                    
                    <div class="mb-4">
                        <h6 class="text-uppercase text-muted mb-3">Main Navigation</h6>
                        <div class="list-group">
                            <a href="dashboard.php" class="admin-sidebar-link active">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                            <a href="users.php" class="admin-sidebar-link">
                                <i class="bi bi-people"></i> User Management
                            </a>
                            <a href="accounts.php" class="admin-sidebar-link">
                                <i class="bi bi-credit-card"></i> Account Management
                            </a>
                            <a href="transactions.php" class="admin-sidebar-link">
                                <i class="bi bi-arrow-left-right"></i> Transactions
                            </a>
                            <a href="security.php" class="admin-sidebar-link action-required">
                                <i class="bi bi-shield-exclamation"></i> Security Center
                            </a>
                        </div>
                    </div>
                    
                    <div>
                        <h6 class="text-uppercase text-muted mb-3">System</h6>
                        <div class="list-group">
                            <a href="settings.php" class="admin-sidebar-link">
                                <i class="bi bi-gear"></i> System Settings
                            </a>
                            <a href="logs.php" class="admin-sidebar-link">
                                <i class="bi bi-journal-text"></i> System Logs
                            </a>
                            <a href="backup.php" class="admin-sidebar-link">
                                <i class="bi bi-cloud-arrow-up"></i> Backup & Restore
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-md-9">
                <!-- Stats Summary -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="text-uppercase text-muted small">Total Users</div>
                                <div class="stats-number">253</div>
                                <div class="text-success small"><i class="bi bi-arrow-up"></i> 12% this month</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="text-uppercase text-muted small">Active Accounts</div>
                                <div class="stats-number">415</div>
                                <div class="text-success small"><i class="bi bi-arrow-up"></i> 8% this month</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="text-uppercase text-muted small">Daily Transactions</div>
                                <div class="stats-number">89</div>
                                <div class="text-success small"><i class="bi bi-arrow-up"></i> 5% this week</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card stats-card">
                            <div class="card-body">
                                <div class="text-uppercase text-muted small">Security Alerts</div>
                                <div class="stats-number text-danger">7</div>
                                <div class="text-danger small"><i class="bi bi-arrow-up"></i> 3 new today</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Security Alert Section -->
                <div class="card security-alert mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center bg-danger text-white">
                        <h5 class="mb-0"><i class="bi bi-shield-exclamation"></i> Security Alerts</h5>
                        <button class="btn btn-sm btn-outline-light">View All Alerts</button>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-danger mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-exclamation-triangle-fill" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Multiple Failed Login Attempts</h5>
                                    <p>7 failed login attempts detected for admin account from IP: 192.168.1.105</p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Today, 10:45 AM</span>
                                        <div>
                                            <button class="btn btn-sm btn-outline-danger me-2">Block IP</button>
                                            <button class="btn btn-sm btn-outline-dark">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-warning mb-3">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-exclamation-circle-fill" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">SQL Injection Attempt Detected</h5>
                                    <p>Suspicious input containing SQL keywords detected in user search function.</p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Today, 09:32 AM</span>
                                        <div>
                                            <button class="btn btn-sm btn-outline-warning me-2">Investigate</button>
                                            <button class="btn btn-sm btn-outline-dark">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="alert alert-warning mb-0">
                            <div class="d-flex">
                                <div class="me-3">
                                    <i class="bi bi-exclamation-circle-fill" style="font-size: 2rem;"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading">Unusual Transaction Pattern</h5>
                                    <p>Multiple small transfers detected from account #7823915 to various external accounts.</p>
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Yesterday, 15:17 PM</span>
                                        <div>
                                            <button class="btn btn-sm btn-outline-warning me-2">Freeze Account</button>
                                            <button class="btn btn-sm btn-outline-dark">Dismiss</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Admin Action Cards -->
                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body text-center">
                                <div class="admin-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5 class="card-title">User Management</h5>
                                <p class="card-text">Manage user accounts, permissions, and credentials.</p>
                                <a href="users.php" class="btn btn-outline-primary">Manage Users</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body text-center">
                                <div class="admin-icon">
                                    <i class="bi bi-arrow-left-right"></i>
                                </div>
                                <h5 class="card-title">Transaction Monitor</h5>
                                <p class="card-text">View, approve, and investigate customer transactions.</p>
                                <a href="transactions.php" class="btn btn-outline-primary">Monitor Transactions</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card admin-card h-100">
                            <div class="card-body text-center">
                                <div class="admin-icon">
                                    <i class="bi bi-shield"></i>
                                </div>
                                <h5 class="card-title">Security Center</h5>
                                <p class="card-text">Access logs, review alerts, and manage security policies.</p>
                                <a href="security.php" class="btn btn-outline-danger">Security Center</a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Users Table -->
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Recent User Registrations</h5>
                        <button class="btn btn-sm btn-outline-primary">View All Users</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Registration Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1032</td>
                                        <td>John Smith</td>
                                        <td>john.smith@example.com</td>
                                        <td>April 28, 2025</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td class="user-actions">
                                            <button class="btn btn-outline-primary btn-sm">View</button>
                                            <button class="btn btn-outline-warning btn-sm">Edit</button>
                                            <button class="btn btn-outline-danger btn-sm">Disable</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1031</td>
                                        <td>Sarah Johnson</td>
                                        <td>sarah.j@example.com</td>
                                        <td>April 27, 2025</td>
                                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                                        <td class="user-actions">
                                            <button class="btn btn-outline-primary btn-sm">View</button>
                                            <button class="btn btn-outline-success btn-sm">Approve</button>
                                            <button class="btn btn-outline-danger btn-sm">Reject</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1030</td>
                                        <td>Michael Brown</td>
                                        <td>michael.b@example.com</td>
                                        <td>April 26, 2025</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td class="user-actions">
                                            <button class="btn btn-outline-primary btn-sm">View</button>
                                            <button class="btn btn-outline-warning btn-sm">Edit</button>
                                            <button class="btn btn-outline-danger btn-sm">Disable</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1029</td>
                                        <td>Emily Davis</td>
                                        <td>emily.d@example.com</td>
                                        <td>April 25, 2025</td>
                                        <td><span class="badge bg-danger">Rejected</span></td>
                                        <td class="user-actions">
                                            <button class="btn btn-outline-primary btn-sm">View</button>
                                            <button class="btn btn-outline-success btn-sm">Reconsider</button>
                                            <button class="btn btn-outline-dark btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>1028</td>
                                        <td>Robert Wilson</td>
                                        <td>robert.w@example.com</td>
                                        <td>April 25, 2025</td>
                                        <td><span class="badge bg-success">Active</span></td>
                                        <td class="user-actions">
                                            <button class="btn btn-outline-primary btn-sm">View</button>
                                            <button class="btn btn-outline-warning btn-sm">Edit</button>
                                            <button class="btn btn-outline-danger btn-sm">Disable</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- Command Execution Vulnerability (for educational purposes) -->
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0"><i class="bi bi-terminal"></i> System Diagnostics Tool</h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle-fill me-2"></i>
                            This diagnostic tool allows administrators to check system status. 
                        </div>
                        
                        <form id="diagnosticForm" class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Command:</span>
                                <select class="form-select" id="commandType">
                                    <option value="ping">Ping Server</option>
                                    <option value="disk">Disk Space</option>
                                    <option value="memory">Memory Usage</option>
                                    <option value="custom">Custom Command</option>
                                </select>
                                <input type="text" class="form-control" id="commandParam" placeholder="Enter IP address or hostname" value="localhost">
                                <button class="btn btn-primary" type="submit">Execute</button>
                            </div>
                            <div class="form-text vulnerability-hint text-danger">
                                <strong>Vulnerability:</strong> This tool includes a command injection vulnerability when set to "custom" mode.
                                <br>Try: <code>localhost & whoami</code> or <code>localhost && ls -la</code>
                            </div>
                        </form>
                        
                        <div class="card bg-dark text-light">
                            <div class="card-header d-flex justify-content-between">
                                <span>Command Output:</span>
                                <span id="commandStatus" class="badge bg-success">Ready</span>
                            </div>
                            <div class="card-body">
                                <pre id="commandOutput" class="mb-0" style="max-height: 200px; overflow-y: auto;">
System diagnostic tool ready. Select a command to execute.
                                </pre>
                            </div>
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
                    <span class="me-3">Admin Portal v2.5.1</span>
                    <a href="#" class="text-white">Documentation</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/security-display.js"></script>
    
    <!-- Admin Dashboard Script -->
    <script>
        $(document).ready(function() {
            // Handle command execution (simulated)
            $('#diagnosticForm').on('submit', function(e) {
                e.preventDefault();
                
                const commandType = $('#commandType').val();
                const commandParam = $('#commandParam').val();
                const securityLevel = localStorage.getItem('securityLevel') || 'low';
                
                // Update status
                $('#commandStatus').removeClass('bg-success bg-danger bg-warning').addClass('bg-warning').text('Executing...');
                
                // Simulate command injection vulnerability
                let isInjection = false;
                let output = '';
                
                // Check for command injection attempts
                if (commandParam.includes('&') || 
                    commandParam.includes('|') || 
                    commandParam.includes(';') || 
                    commandParam.includes('`')) {
                    isInjection = true;
                }
                
                setTimeout(function() {
                    if (commandType === 'ping') {
                        if (securityLevel === 'low' && isInjection) {
                            // Simulate successful command injection at low security
                            if (commandParam.includes('whoami')) {
                                output = `PING localhost (127.0.0.1): 56 data bytes
64 bytes from 127.0.0.1: icmp_seq=0 ttl=64 time=0.037 ms
64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.030 ms
--- localhost ping statistics ---
2 packets transmitted, 2 packets received, 0.0% packet loss
round-trip min/avg/max/stddev = 0.030/0.034/0.037/0.003 ms

www-data`;
                            } else if (commandParam.includes('ls')) {
                                output = `PING localhost (127.0.0.1): 56 data bytes
64 bytes from 127.0.0.1: icmp_seq=0 ttl=64 time=0.037 ms
64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.030 ms
--- localhost ping statistics ---
2 packets transmitted, 2 packets received, 0.0% packet loss
round-trip min/avg/max/stddev = 0.030/0.034/0.037/0.003 ms

app
config
database
includes
index.php
logs
public
README.md
setup.php
vulnerabilities`;
                            } else {
                                output = `PING localhost (127.0.0.1): 56 data bytes
64 bytes from 127.0.0.1: icmp_seq=0 ttl=64 time=0.037 ms
64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.030 ms
--- localhost ping statistics ---
2 packets transmitted, 2 packets received, 0.0% packet loss
round-trip min/avg/max/stddev = 0.030/0.034/0.037/0.003 ms

[Command output redacted for security reasons]`;
                            }
                            
                            $('#commandStatus').removeClass('bg-warning').addClass('bg-danger').text('Command Injection Detected!');
                        } else if (securityLevel === 'medium' && isInjection) {
                            // Attempt to filter but still vulnerable to some injections
                            output = `Error: Invalid characters detected in input.
Security warning: Potential command injection attempt logged.`;
                            $('#commandStatus').removeClass('bg-warning').addClass('bg-danger').text('Blocked');
                        } else if (securityLevel === 'high' && isInjection) {
                            // High security blocks all injection attempts
                            output = `Error: Command rejected for security reasons.
This incident has been logged and reported to system administrators.`;
                            $('#commandStatus').removeClass('bg-warning').addClass('bg-danger').text('Blocked');
                        } else {
                            // Normal ping output
                            output = `PING ${commandParam} (127.0.0.1): 56 data bytes
64 bytes from 127.0.0.1: icmp_seq=0 ttl=64 time=0.037 ms
64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.030 ms
64 bytes from 127.0.0.1: icmp_seq=2 ttl=64 time=0.032 ms
64 bytes from 127.0.0.1: icmp_seq=3 ttl=64 time=0.029 ms
--- ${commandParam} ping statistics ---
4 packets transmitted, 4 packets received, 0.0% packet loss
round-trip min/avg/max/stddev = 0.029/0.032/0.037/0.003 ms`;
                            $('#commandStatus').removeClass('bg-warning').addClass('bg-success').text('Completed');
                        }
                    } else if (commandType === 'disk') {
                        // Simulate disk space command
                        output = `Filesystem     Size    Used   Avail Capacity  Mounted on
/dev/disk1s1  466Gi  210Gi  242Gi    47%    /
devfs         336Ki  336Ki    0Bi   100%    /dev
/dev/disk1s4  466Gi   20Gi  242Gi     8%    /private/var/vm
map auto_home   0Bi    0Bi    0Bi   100%    /System/Volumes/Data/home`;
                        $('#commandStatus').removeClass('bg-warning').addClass('bg-success').text('Completed');
                    } else if (commandType === 'memory') {
                        // Simulate memory usage command
                        output = `              total        used        free      shared  buff/cache   available
Mem:        16384Mi     6789Mi     3243Mi      354Mi     6352Mi     8947Mi
Swap:        4096Mi      124Mi     3972Mi`;
                        $('#commandStatus').removeClass('bg-warning').addClass('bg-success').text('Completed');
                    } else if (commandType === 'custom') {
                        // Custom command - most vulnerable
                        if (securityLevel === 'low') {
                            // At low security, allow any command
                            if (commandParam.includes('whoami')) {
                                output = `www-data`;
                            } else if (commandParam.includes('ls')) {
                                output = `app
config
database
includes
index.php
logs
public
README.md
setup.php
vulnerabilities`;
                            } else {
                                output = `[Custom command executed]
Output may be redacted for security purposes.`;
                            }
                            $('#commandStatus').removeClass('bg-warning').addClass('bg-danger').text('Executed (Unsafe)');
                        } else if (securityLevel === 'medium') {
                            // Medium security allows some commands but blocks obvious dangerous ones
                            if (commandParam.includes('rm') || 
                                commandParam.includes('mv') || 
                                commandParam.includes('/etc/') || 
                                commandParam.includes('passwd')) {
                                output = `Error: Potentially dangerous command blocked.`;
                                $('#commandStatus').removeClass('bg-warning').addClass('bg-danger').text('Blocked');
                            } else {
                                output = `[Custom command executed with limited permissions]
Output may be redacted for security purposes.`;
                                $('#commandStatus').removeClass('bg-warning').addClass('bg-warning').text('Limited Execution');
                            }
                        } else if (securityLevel === 'high') {
                            // High security blocks all custom commands
                            output = `Error: Custom commands are disabled in high security mode.
Please use pre-defined diagnostic tools or contact system administrator.`;
                            $('#commandStatus').removeClass('bg-warning').addClass('bg-danger').text('Disabled');
                        }
                    }
                    
                    // Update the output
                    $('#commandOutput').text(output);
                }, 1000);
            });
            
            // Handle command type change
            $('#commandType').on('change', function() {
                const commandType = $(this).val();
                
                // Update placeholder based on command type
                if (commandType === 'ping') {
                    $('#commandParam').attr('placeholder', 'Enter IP address or hostname').val('localhost');
                } else if (commandType === 'disk') {
                    $('#commandParam').attr('placeholder', 'Optional path').val('/');
                } else if (commandType === 'memory') {
                    $('#commandParam').attr('placeholder', 'No parameters needed').val('');
                } else if (commandType === 'custom') {
                    $('#commandParam').attr('placeholder', 'Enter custom command').val('');
                }
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