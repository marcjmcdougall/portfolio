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