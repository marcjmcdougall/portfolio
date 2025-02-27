/**
 * SmoothScroll.js
 * A script to handle smooth scrolling to container elements with customizable padding.
 */

document.addEventListener('DOMContentLoaded', () => {
    // Configuration
    const defaultOptions = {
      padding: 50, // Default top padding in pixels
      duration: 800, // Animation duration in milliseconds
      easing: 'easeInOutQuad', // Easing function
    };
  
    // All links that have hash references (e.g., #section-id)
    const scrollLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
  
    // Easing functions
    const easings = {
      linear: t => t,
      easeInOutQuad: t => t < 0.5 ? 2 * t * t : 1 - Math.pow(-2 * t + 2, 2) / 2,
      easeInOutCubic: t => t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2,
    };
  
    /**
     * Smooth scroll function
     * @param {Element} targetElement - Element to scroll to
     * @param {Object} options - Scroll options
     */
    function smoothScroll(targetElement, options) {
      const settings = { ...defaultOptions, ...options };
      
      const startPosition = window.pageYOffset;
      const targetPosition = targetElement.getBoundingClientRect().top + 
                             window.pageYOffset - 
                             settings.padding;
      
      const distance = targetPosition - startPosition;
      let startTime = null;
  
      function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const progress = Math.min(timeElapsed / settings.duration, 1);
        const ease = easings[settings.easing](progress);
        
        window.scrollTo(0, startPosition + distance * ease);
        
        if (timeElapsed < settings.duration) {
          requestAnimationFrame(animation);
        }
      }
  
      requestAnimationFrame(animation);
    }
  
    // Add click event listeners to all scroll links
    scrollLinks.forEach(link => {
      link.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Get the target element
        const targetId = this.getAttribute('href');
        const targetElement = document.querySelector(targetId);
        
        if (!targetElement) return;
        
        // Get custom padding from data attribute if available
        const customPadding = this.dataset.scrollPadding !== undefined ? 
                              parseInt(this.dataset.scrollPadding, 10) : 
                              defaultOptions.padding;
        
        // Get custom duration from data attribute if available
        const customDuration = this.dataset.scrollDuration !== undefined ? 
                               parseInt(this.dataset.scrollDuration, 10) : 
                               defaultOptions.duration;
        
        // Get custom easing from data attribute if available
        const customEasing = this.dataset.scrollEasing || defaultOptions.easing;
        
        // Scroll to the target with custom options
        smoothScroll(targetElement, {
          padding: customPadding,
          duration: customDuration,
          easing: customEasing
        });
      });
    });
  
    // Expose the API globally if needed
    window.smoothScroll = smoothScroll;
  });