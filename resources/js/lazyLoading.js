document.addEventListener("DOMContentLoaded", function() {
    const lazyImages = document.querySelectorAll('.lazy');
    const lazyBackgrounds = document.querySelectorAll('.lazy-bg');
    const lazyVideos = document.querySelectorAll('.lazy-video');
    const animatedElements = document.querySelectorAll('.has-animation');

    const lazyConfig = {
        rootMargin: '200px 0px',
        threshold: 0.01
    };

    const animationConfig = {
        rootMargin: '0px 0px',
        threshold: 0.25
    };

    let lazyLoad = (target) => {
        const io = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    const src = img.getAttribute('data-src');

                    if (src) {
                        img.src = src;
                        img.classList.add('lazy--loaded');
                        console.log('Loading ' + src + ' now');
                        observer.disconnect();
                    }
                }
            });
        }, lazyConfig);

        io.observe(target);
    };

    let lazyLoadBackground = (target) => {
        const io = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bg = entry.target;
                    const src = bg.getAttribute('data-bg');
                    if (src) {
                        bg.style.backgroundImage = `url(${src})`;
                        bg.classList.add('lazy--loaded');
                        observer.disconnect();
                    }
                }
            });
        }, lazyConfig);

        io.observe(target);
    };

    let lazyLoadVideo = (target) => {
        const io = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const video = entry.target;
                    const src = video.getAttribute('data-src');
                    if (src) {
                        video.src = src;
                        video.onloadstart = () => {
                            // Delay showing the video by 1 second
                            setTimeout(() => {
                                video.classList.add('lazy--loaded');
                            }, 2000);
                        };
                        observer.disconnect();
                    }
                }
            });
        }, lazyConfig);

        io.observe(target);
    };

    let animateElements = (target) => {
        const io = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-viewport');
                    observer.disconnect();
                }
            });
        }, animationConfig);

        io.observe(target);
    };

    lazyImages.forEach(lazyLoad);
    lazyBackgrounds.forEach(lazyLoadBackground);
    lazyVideos.forEach(lazyLoadVideo);
    animatedElements.forEach(animateElements);
});
