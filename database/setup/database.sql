-- HackMeBank Database Setup Script
-- WARNING: This application contains deliberate security vulnerabilities for educational purposes.
-- DO NOT use in a production environment.

-- Drop existing tables if they exist to start fresh
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS security_levels;
DROP TABLE IF EXISTS roles;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS accounts;
DROP TABLE IF EXISTS transactions;
DROP TABLE IF EXISTS statements;
DROP TABLE IF EXISTS user_security_settings;
DROP TABLE IF EXISTS audit_logs;
DROP TABLE IF EXISTS security_events;
DROP TABLE IF EXISTS feedback;

SET FOREIGN_KEY_CHECKS = 1;

-- Create Tables

-- Security Levels Table
CREATE TABLE security_levels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(20) NOT NULL,  -- Low, Medium, High
    description TEXT NOT NULL
);

-- User Roles Table
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,   -- Customer, Bank Manager, Admin
    permissions TEXT NOT NULL    -- JSON of permissions
);

-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- Store hashed passwords (deliberately weak for educational purposes)
    email VARCHAR(100) NOT NULL UNIQUE,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    role_id INT NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    date_of_birth DATE,
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Bank Accounts Table
CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_number VARCHAR(20) NOT NULL UNIQUE,
    user_id INT NOT NULL,
    account_type VARCHAR(50) NOT NULL,  -- Checking, Savings, etc.
    balance DECIMAL(15,2) NOT NULL DEFAULT 0.00,
    currency VARCHAR(3) NOT NULL DEFAULT 'USD',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Transactions Table
CREATE TABLE transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    transaction_id VARCHAR(36) NOT NULL UNIQUE,  -- UUID
    from_account_id INT,                         -- NULL for deposits
    to_account_id INT,                           -- NULL for withdrawals
    amount DECIMAL(15,2) NOT NULL,
    transaction_type VARCHAR(20) NOT NULL,       -- transfer, deposit, withdrawal
    description TEXT,
    status VARCHAR(20) NOT NULL DEFAULT 'completed',  -- pending, completed, failed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (from_account_id) REFERENCES accounts(id),
    FOREIGN KEY (to_account_id) REFERENCES accounts(id)
);

-- Account Statements Table
CREATE TABLE statements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    generated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    file_path VARCHAR(255),  -- Path to PDF or other statement file
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);

-- Security Settings Table (for each user)
CREATE TABLE user_security_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    security_level_id INT NOT NULL,  -- Which security level the user is currently using
    two_factor_auth BOOLEAN DEFAULT FALSE,
    last_password_change TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (security_level_id) REFERENCES security_levels(id)
);

-- Audit Logs Table
CREATE TABLE audit_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,  -- NULL for system actions
    action VARCHAR(255) NOT NULL,
    entity_type VARCHAR(50) NOT NULL,  -- users, accounts, transactions, etc.
    entity_id INT NOT NULL,
    old_values TEXT,  -- JSON of old values
    new_values TEXT,  -- JSON of new values
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Security Events Table (for tracking security-related events)
CREATE TABLE security_events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_type VARCHAR(50) NOT NULL,  -- login_attempt, brute_force, sql_injection, etc.
    user_id INT,  -- NULL if not authenticated
    ip_address VARCHAR(45) NOT NULL,
    user_agent VARCHAR(255),
    details TEXT,  -- JSON of event details
    severity VARCHAR(20) NOT NULL,  -- low, medium, high, critical
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Feedback Table (for stored XSS demo)
CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert Default Data

-- Insert Security Levels
INSERT INTO security_levels (name, description) VALUES
('Low', 'Minimal security measures. Vulnerable to common attacks.');

INSERT INTO security_levels (name, description) VALUES
('Medium', 'Basic security implementation. Some vulnerabilities remain.');

INSERT INTO security_levels (name, description) VALUES
('High', 'Strong security implementation following best practices.');

-- Insert Default Roles
INSERT INTO roles (name, permissions) VALUES
('Customer', '{"can_view_own_accounts":true,"can_transfer_money":true,"can_view_statements":true}');

INSERT INTO roles (name, permissions) VALUES
('Bank Manager', '{"can_view_all_accounts":true,"can_view_customer_details":true,"can_generate_reports":true,"can_approve_transactions":true}');

INSERT INTO roles (name, permissions) VALUES
('Admin', '{"can_manage_users":true,"can_manage_security":true,"can_view_all":true,"can_modify_all":true}');

-- Insert Sample Users (password is MD5 hashed for demonstration - deliberately insecure)
-- Admin: password123admin
INSERT INTO users (username, password, email, first_name, last_name, role_id, phone, address, date_of_birth) VALUES
('admin', 'f865b53623b121fd34ee5426c792e5c2', 'admin@hackmebank.local', 'System', 'Admin', 3, '555-123-4567', '123 Security St, Adminville', '1980-01-01');

-- Bank Manager: manager123
INSERT INTO users (username, password, email, first_name, last_name, role_id, phone, address, date_of_birth) VALUES
('manager', '1d0258c2440a8d19e716292b231e3190', 'manager@hackmebank.local', 'Bank', 'Manager', 2, '555-234-5678', '456 Banking Ave, Managertown', '1985-05-15');

-- Regular customers with 'password123' password
INSERT INTO users (username, password, email, first_name, last_name, role_id, phone, address, date_of_birth) VALUES
('johndoe', '482c811da5d5b4bc6d497ffa98491e38', 'john.doe@example.com', 'John', 'Doe', 1, '555-555-1234', '789 Customer Lane, Userburg', '1990-03-20');

INSERT INTO users (username, password, email, first_name, last_name, role_id, phone, address, date_of_birth) VALUES
('janesmith', '482c811da5d5b4bc6d497ffa98491e38', 'jane.smith@example.com', 'Jane', 'Smith', 1, '555-555-5678', '101 Client Road, Customertown', '1992-07-12');

-- Create accounts for users
INSERT INTO accounts (account_number, user_id, account_type, balance, currency) VALUES
('1000123456', 3, 'Checking', 12345.67, 'USD');

INSERT INTO accounts (account_number, user_id, account_type, balance, currency) VALUES
('1000123457', 3, 'Savings', 54321.89, 'USD');

INSERT INTO accounts (account_number, user_id, account_type, balance, currency) VALUES
('1000234567', 4, 'Checking', 7890.12, 'USD');

INSERT INTO accounts (account_number, user_id, account_type, balance, currency) VALUES
('1000234568', 4, 'Savings', 45678.90, 'USD');

-- Sample Transactions
INSERT INTO transactions (transaction_id, from_account_id, to_account_id, amount, transaction_type, description, status) VALUES
('tx-001', 1, NULL, 500.00, 'withdrawal', 'ATM Withdrawal', 'completed');

INSERT INTO transactions (transaction_id, from_account_id, to_account_id, amount, transaction_type, description, status) VALUES
('tx-002', NULL, 1, 3250.00, 'deposit', 'Salary Deposit', 'completed');

INSERT INTO transactions (transaction_id, from_account_id, to_account_id, amount, transaction_type, description, status) VALUES
('tx-003', 1, 2, 1000.00, 'transfer', 'Transfer to Savings', 'completed');

INSERT INTO transactions (transaction_id, from_account_id, to_account_id, amount, transaction_type, description, status) VALUES
('tx-004', NULL, 3, 2500.00, 'deposit', 'Salary Deposit', 'completed');

INSERT INTO transactions (transaction_id, from_account_id, to_account_id, amount, transaction_type, description, status) VALUES
('tx-005', 3, 4, 750.00, 'transfer', 'Monthly Savings', 'completed');

INSERT INTO transactions (transaction_id, from_account_id, to_account_id, amount, transaction_type, description, status) VALUES
('tx-006', 3, 1, 250.00, 'transfer', 'Payment to John', 'completed');

-- Set up Security Settings for Users
INSERT INTO user_security_settings (user_id, security_level_id) VALUES
(1, 3);

INSERT INTO user_security_settings (user_id, security_level_id) VALUES
(2, 2);

INSERT INTO user_security_settings (user_id, security_level_id) VALUES
(3, 1);

INSERT INTO user_security_settings (user_id, security_level_id) VALUES
(4, 1);

-- Sample Feedback (for stored XSS demo)
INSERT INTO feedback (name, message) VALUES
('Michael Smith', 'Great banking services! The online interface is very user-friendly.');

INSERT INTO feedback (name, message) VALUES
('Linda Johnson', 'I love the quick transfer feature. Makes paying bills so much easier!');

INSERT INTO feedback (name, message) VALUES
('Robert Brown', 'The customer service has been excellent so far. Very responsive team.');

-- Sample Security Events (for security logging demo)
INSERT INTO security_events (event_type, user_id, ip_address, user_agent, details, severity) VALUES
('failed_login', NULL, '192.168.1.100', 'Mozilla/5.0', '{"username":"admin","attempt_count":3}', 'medium');

INSERT INTO security_events (event_type, user_id, ip_address, user_agent, details, severity) VALUES
('sql_injection_attempt', NULL, '192.168.1.101', 'Mozilla/5.0', '{"input":"admin\' OR 1=1 --","page":"login.php"}', 'high');

INSERT INTO security_events (event_type, user_id, ip_address, user_agent, details, severity) VALUES
('xss_attempt', 3, '192.168.1.102', 'Mozilla/5.0', '{"input":"<script>alert(\'XSS\')</script>","page":"profile.php"}', 'medium');