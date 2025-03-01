/**
 * Theme Initialization Script
 * --------------------------
 * This script runs immediately when included and sets the theme before page rendering starts.
 * It prevents the "flash of incorrect theme" (FOIT) by:
 * 
 * 1. Checking localStorage for a saved user theme preference
 * 2. Falling back to the system preference (dark/light) if no saved preference exists
 * 3. Setting the 'data-theme' attribute on the document element before any content renders
 * 
 * This file must be loaded in the <head> before stylesheets to ensure the correct theme
 * is applied instantly without any visible theme switching.
 * 
 * Related files:
 * - theme.js: Handles theme toggling functionality and system preference changes
 * - navigation.blade.php: Contains the theme toggle UI component
 */

(function() {
    var savedTheme = localStorage.getItem('theme');
    var systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    var initialTheme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
    document.documentElement.setAttribute('data-theme', initialTheme);
    // document.addEventListener('DOMContentLoaded', () => {
    //     document.documentElement.classList.remove('theme-loading');
    // });
  })();