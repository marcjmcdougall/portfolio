import './bootstrap';
import './lazyLoading';
import './countUp';
import './theme';

document.addEventListener('DOMContentLoaded', () => {
    const animations = document.querySelectorAll('.do-animation');
    animations.forEach(function(animation) {
        animation.classList.add('ready');
    });
});
