import './bootstrap';
import './lazyLoading';
import './countUp';
import './theme';
import './typewriter';
import './animations';
import './smoothScroll';

document.addEventListener('DOMContentLoaded', () => {
    const animations = document.querySelectorAll('.do-animation');
    animations.forEach(function(animation) {
        animation.classList.add('ready');
    });
});
