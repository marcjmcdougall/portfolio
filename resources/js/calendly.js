// Load the Calendly script & styles
document.addEventListener('DOMContentLoaded', function() {
    const script = document.createElement('script');
    script.src = 'https://assets.calendly.com/assets/external/widget.js';

    const style = document.createElement('link');
    style.rel = 'stylesheet';
    style.href = 'https://assets.calendly.com/assets/external/widget.css';

    document.head.appendChild(style);
    document.body.appendChild(script);
});

document.addEventListener('keydown', function(event) {
    // Check for CMD+K (Mac) or CTRL+K (Windows)
    if ((event.metaKey || event.ctrlKey) && event.key === 'k') {
        // Prevent default behavior (like focusing address bar in some browsers)
        event.preventDefault();
        
        // Open Calendly popup
        Calendly.initPopupWidget({
            url: 'https://calendly.com/kbs-marc/hello?text_color=353535&primary_color=3a84f3'
        });
        
        return false;
    }
});