/**
 * HackMeBank - Security Display JavaScript
 * Handles security level selection and display of vulnerability information
 */

(function($) {
    'use strict';
    
    // Security level constants
    const SECURITY_LEVELS = {
        LOW: 'low',
        MEDIUM: 'medium',
        HIGH: 'high'
    };
    
    // UI elements CSS classes
    const UI_CLASSES = {
        ACTIVE: 'active',
        SECURITY_BTN: 'security-btn',
        SECURITY_LEVEL_SECTION: 'security-level-section',
        CURRENT_SECURITY_LEVEL: 'current-security-level'
    };
    
    // Local storage key
    const STORAGE_KEY = 'securityLevel';
    
    // Get security level from local storage or default to low
    const getCurrentSecurityLevel = () => {
        return localStorage.getItem(STORAGE_KEY) || SECURITY_LEVELS.LOW;
    };
    
    // Save security level to local storage
    const saveSecurityLevel = (level) => {
        localStorage.setItem(STORAGE_KEY, level);
    };
    
    // Update UI to reflect current security level
    const updateSecurityLevelUI = (level) => {
        // Update button active state
        $(`.${UI_CLASSES.SECURITY_BTN}`).removeClass(UI_CLASSES.ACTIVE);
        $(`.${UI_CLASSES.SECURITY_BTN}[data-level="${level}"]`).addClass(UI_CLASSES.ACTIVE);
        
        // Update current security level text display
        const levelCapitalized = level.charAt(0).toUpperCase() + level.slice(1);
        $(`.${UI_CLASSES.CURRENT_SECURITY_LEVEL}`).text(levelCapitalized);
        
        // Update security level badge classes
        $(`.${UI_CLASSES.CURRENT_SECURITY_LEVEL}`).removeClass('bg-danger bg-warning bg-success');
        
        switch(level) {
            case SECURITY_LEVELS.LOW:
                $(`.${UI_CLASSES.CURRENT_SECURITY_LEVEL}`).addClass('bg-danger');
                break;
            case SECURITY_LEVELS.MEDIUM:
                $(`.${UI_CLASSES.CURRENT_SECURITY_LEVEL}`).addClass('bg-warning');
                break;
            case SECURITY_LEVELS.HIGH:
                $(`.${UI_CLASSES.CURRENT_SECURITY_LEVEL}`).addClass('bg-success');
                break;
        }
        
        // Show appropriate security level sections in the vulnerability pages
        $(`.${UI_CLASSES.SECURITY_LEVEL_SECTION}`).hide();
        $(`.${UI_CLASSES.SECURITY_LEVEL_SECTION}.${level}`).show();
    };
    
    // Handle security level button clicks
    const handleSecurityLevelSelection = () => {
        $(`.${UI_CLASSES.SECURITY_BTN}`).on('click', function() {
            const level = $(this).data('level');
            saveSecurityLevel(level);
            updateSecurityLevelUI(level);
            
            // Reload the vulnerability content if on a vulnerability page
            if ($('.vulnerability-content').length > 0) {
                reloadVulnerabilityContent(level);
            }
        });
    };
    
    // Reload vulnerability content based on security level
    // This would make an AJAX request to get the appropriate content in a real app
    const reloadVulnerabilityContent = (level) => {
        const vulnerabilityType = $('.vulnerability-content').data('vulnerability-type');
        
        // In a real implementation, this would be an AJAX call:
        // $.ajax({
        //     url: 'get_vulnerability_content.php',
        //     method: 'GET',
        //     data: { type: vulnerabilityType, level: level },
        //     success: function(response) {
        //         $('.vulnerability-content').html(response);
        //     }
        // });
        
        console.log(`Reloading ${vulnerabilityType} vulnerability content with ${level} security level`);
        
        // For demo purposes, just update a message
        $('.vulnerability-content-placeholder').html(`
            <div class="alert alert-info">
                Vulnerability content would be loaded for ${vulnerabilityType} at ${level} security level.
            </div>
        `);
    };
    
    // Toggle source code visibility
    const setupSourceCodeViewer = () => {
        $('.toggle-source-btn').on('click', function() {
            const target = $(this).data('target');
            $(target).slideToggle();
            
            // Toggle button text
            const showText = $(this).data('show-text');
            const hideText = $(this).data('hide-text');
            const buttonText = $(this).text().trim() === showText ? hideText : showText;
            $(this).text(buttonText);
        });
    };
    
    // Highlight security vulnerabilities in code
    const highlightVulnerabilities = () => {
        $('.highlight-vuln').each(function() {
            const code = $(this).html();
            
            // Highlight vulnerable code with different colors based on severity
            const severeVulnRegex = /\/\*\* SEVERE VULNERABILITY \*\*\/([\s\S]*?)\/\*\* END VULNERABILITY \*\*\//g;
            const mediumVulnRegex = /\/\*\* MEDIUM VULNERABILITY \*\*\/([\s\S]*?)\/\*\* END VULNERABILITY \*\*\//g;
            const mildVulnRegex = /\/\*\* MILD VULNERABILITY \*\*\/([\s\S]*?)\/\*\* END VULNERABILITY \*\*\//g;
            
            let highlightedCode = code
                .replace(severeVulnRegex, '<span class="severe-vulnerability">$1</span>')
                .replace(mediumVulnRegex, '<span class="medium-vulnerability">$1</span>')
                .replace(mildVulnRegex, '<span class="mild-vulnerability">$1</span>');
                
            $(this).html(highlightedCode);
        });
    };
    
    // Initialize security explanation tooltips
    const initializeSecurityTooltips = () => {
        $('.security-tooltip').each(function() {
            const tooltipContent = $(this).data('tooltip-content');
            $(this).tooltip({
                title: tooltipContent,
                html: true,
                placement: 'top'
            });
        });
    };
    
    // Display vulnerability attempt results
    window.showVulnerabilityResult = (success, message) => {
        const resultClass = success ? 'success' : 'failure';
        const resultTitle = success ? 'Success! Vulnerability Exploited' : 'Failed Attempt';
        
        // Create and show the result element
        $('.vulnerability-result').removeClass('success failure').addClass(resultClass).show();
        $('.vulnerability-result-title').text(resultTitle);
        $('.vulnerability-result-message').text(message);
        
        // Scroll to the result
        $('html, body').animate({
            scrollTop: $('.vulnerability-result').offset().top - 100
        }, 500);
    };
    
    // Initialize all security display features
    $(document).ready(function() {
        console.log('Security display features initialized');
        
        // Get current security level
        const currentLevel = getCurrentSecurityLevel();
        
        // Update UI based on current security level
        updateSecurityLevelUI(currentLevel);
        
        // Set up event handlers
        handleSecurityLevelSelection();
        setupSourceCodeViewer();
        
        // Initialize features for code display
        highlightVulnerabilities();
        initializeSecurityTooltips();
        
        // Initialize syntax highlighting if highlight.js is available
        if (typeof hljs !== 'undefined') {
            document.querySelectorAll('pre code').forEach((block) => {
                hljs.highlightBlock(block);
            });
        }
    });
    
})(jQuery);