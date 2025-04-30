/**
 * HackMeBank - Main JavaScript
 * Contains core functionality for the banking application
 */

(function($) {
    'use strict';
    
    // Initialize tooltips and popovers
    const initializeTooltips = () => {
        $('[data-bs-toggle="tooltip"]').tooltip();
        $('[data-bs-toggle="popover"]').popover();
    };

    // Format currency amounts
    const formatCurrency = (amount, currency = 'USD') => {
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: currency
        }).format(amount);
    };

    // Format account numbers (hide middle digits)
    const formatAccountNumber = (accountNumber) => {
        if (!accountNumber) return '';
        const firstFour = accountNumber.substring(0, 4);
        const lastFour = accountNumber.substring(accountNumber.length - 4);
        return `${firstFour} **** **** ${lastFour}`;
    };

    // Format dates 
    const formatDate = (dateString) => {
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return new Date(dateString).toLocaleDateString('en-US', options);
    };

    // Toggle password visibility
    const setupPasswordToggle = () => {
        $('.password-toggle').on('click', function() {
            const passwordInput = $($(this).data('target'));
            const icon = $(this).find('i');
            
            if (passwordInput.attr('type') === 'password') {
                passwordInput.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                passwordInput.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    };

    // Handle transaction filtering
    const setupTransactionFilters = () => {
        $('.transaction-filter-btn').on('click', function() {
            const filterValue = $(this).data('filter');
            
            // Update active button state
            $('.transaction-filter-btn').removeClass('active');
            $(this).addClass('active');
            
            if (filterValue === 'all') {
                $('.transaction-item').show();
            } else {
                $('.transaction-item').hide();
                $(`.transaction-item[data-type="${filterValue}"]`).show();
            }
        });
    };

    // Initialize account balance chart (if chart element exists)
    const initializeBalanceChart = () => {
        const chartElement = document.getElementById('balanceChart');
        if (!chartElement) return;
        
        // Sample data - in a real app, this would come from the server
        const balanceData = {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Account Balance',
                data: [5000, 5800, 5400, 6200, 7100, 8500],
                backgroundColor: 'rgba(26, 59, 110, 0.1)',
                borderColor: '#1a3b6e',
                borderWidth: 2,
                pointBackgroundColor: '#1a3b6e',
                tension: 0.3
            }]
        };
        
        // Draw chart using sample data
        // Note: In a real implementation, you would use a charting library like Chart.js
        console.log('Balance chart would be initialized with:', balanceData);
    };

    // Setup transfer form validation
    const setupTransferForm = () => {
        const transferForm = document.getElementById('transferForm');
        if (!transferForm) return;
        
        transferForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            const formData = new FormData(this);
            const amount = formData.get('amount');
            const accountTo = formData.get('accountTo');
            
            // Perform client-side validation
            let isValid = true;
            let errorMessage = '';
            
            // Check amount
            if (!amount || isNaN(amount) || parseFloat(amount) <= 0) {
                isValid = false;
                errorMessage = 'Please enter a valid amount';
            }
            
            // Check recipient account
            if (!accountTo) {
                isValid = false;
                errorMessage = 'Please enter a recipient account number';
            }
            
            if (!isValid) {
                showAlert('transfer-error', errorMessage, 'danger');
                return;
            }
            
            // AJAX form submission would go here
            // For demo purposes, just simulate success
            console.log('Transfer form submitted:', Object.fromEntries(formData));
            showAlert('transfer-success', `Successfully transferred ${formatCurrency(amount)} to account ${accountTo}`, 'success');
            this.reset();
        });
    };

    // Display alert message
    const showAlert = (elementId, message, type = 'info') => {
        const alertElement = document.getElementById(elementId);
        if (!alertElement) return;
        
        alertElement.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            const alert = new bootstrap.Alert(alertElement.querySelector('.alert'));
            alert.close();
        }, 5000);
    };

    // Show notifications
    const setupNotifications = () => {
        $('.notification-toggle').on('click', function(e) {
            e.preventDefault();
            $('.notification-dropdown').toggleClass('show');
        });
        
        // Close notifications when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.notification-container').length) {
                $('.notification-dropdown').removeClass('show');
            }
        });
        
        // Mark notifications as read
        $('.mark-as-read').on('click', function(e) {
            e.preventDefault();
            $('.notification-item.unread').removeClass('unread');
            $('.notification-count').text('0').hide();
        });
    };

    // Initialize demo banking features
    const initializeBankingFeatures = () => {
        // This function contains additional banking functionality
        // It would be responsible for features like handling transfers, 
        // checking balances, updating transaction history, etc.
        
        console.log('Banking features initialized');
        
        // In a real app, you would set up AJAX calls to fetch account data
        // and set up event handlers for banking transactions
    };

    // Initialize application when document is ready
    $(document).ready(function() {
        console.log('HackMeBank application initialized');
        
        initializeTooltips();
        setupPasswordToggle();
        setupTransactionFilters();
        initializeBalanceChart();
        setupTransferForm();
        setupNotifications();
        initializeBankingFeatures();
        
        // Apply any stored theme preferences
        const currentSecurityLevel = localStorage.getItem('securityLevel') || 'low';
        $(`.security-btn[data-level="${currentSecurityLevel}"]`).addClass('active');
        $('.current-security-level').text(currentSecurityLevel.charAt(0).toUpperCase() + currentSecurityLevel.slice(1));
        
        // Make currency formatting available globally
        window.formatCurrency = formatCurrency;
        window.formatAccountNumber = formatAccountNumber;
        window.formatDate = formatDate;
    });
    
})(jQuery);