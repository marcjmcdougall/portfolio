document.addEventListener('DOMContentLoaded', () => {
    const countUpElements = document.querySelectorAll('.count-up');

    const observerOptions = {
        root: null, // Relative to the viewport
        rootMargin: '0px',
        threshold: 0.1 // Trigger when 10% of the element is visible
    };

    const observerCallback = (entries, observer) => {
        entries.forEach(entry => {
            countUpElements.forEach(el => {
                if (entry.isIntersecting) {
                    const endValue = parseInt(el.getAttribute('data-count'), 10);
                    let startValue = 0;
                    const duration = 1500; // Duration in milliseconds
                    const increment = endValue / (duration / 16.67); // Approx. 60 frames per second

                    const updateCounter = () => {
                        startValue += increment;
                        if (startValue < endValue) {
                            el.innerText = Math.floor(startValue).toLocaleString();
                            requestAnimationFrame(updateCounter);
                        } else {
                            el.innerText = endValue.toLocaleString();
                        }
                    };

                    updateCounter();
                    observer.unobserve(el); // Stop observing after counting up
                }
            });
        });
    }

    const observer = new IntersectionObserver(observerCallback, observerOptions);

    countUpElements.forEach(el => {
        observer.observe(el);
    });
});