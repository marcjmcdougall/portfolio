// Add preload class initially
document.documentElement.classList.add('preload');

document.addEventListener('DOMContentLoaded', () => {
    // Remove the preload class
    setTimeout(() => document.documentElement.classList.remove('preload'), 300);

    // Check system preference
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const savedTheme = localStorage.getItem('theme');
    
    // Set initial theme
    const initialTheme = savedTheme || (systemPrefersDark ? 'dark' : 'light');
    document.documentElement.setAttribute('data-theme', initialTheme);

    // console.log('theme: ', initialTheme);
    // console.log('system prefers dark: ', systemPrefersDark);

    // Notify Alpine components about the theme change
    window.dispatchEvent(new CustomEvent('themeChange', {
        detail: { theme: initialTheme }
    }));
    
    // Listen for system preference changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', e => {
        if (!localStorage.getItem('theme')) {
            const newTheme = e.matches ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', newTheme);

            // console.log('theme: ', newTheme);
            
            // Notify Alpine components about the theme change
            window.dispatchEvent(new CustomEvent('themeChange', { 
                detail: { theme: newTheme } 
            }));
        }
    });
});