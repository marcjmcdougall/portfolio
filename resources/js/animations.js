import { typewriter } from './typewriter';
import { AnimationSequencer } from './animationSequencer.js';

const COMMENT_DELAY_MS = 1000;

document.addEventListener('DOMContentLoaded', () => {
    if ( document.querySelector('.teardown-visualizer')) {
        const sequencer = new AnimationSequencer();

        const heroTitleElem = document.getElementById('tv__hero__title');
        const heroBodyElem = document.getElementById('tv__hero__body');

        const action1Elem = document.getElementById('tv__hero__action__1');

        // console.log( headerTextElem.dataset.text );
        
        // Create a complex animation sequence
        sequencer
            // Wait a moment
            .addDelay(1000)
            // First, fade in the header
            .addClassAnimation('#tv__comment-1', 'active', 500, {
                removeClass: true,
                removeDelay: COMMENT_DELAY_MS,
            })
            .addClassAnimation('#tv__header', 'fixed', 500, {
                removeClass: false,
            })
            .addClassAnimation('#tv__comment-2', 'active', 500, {
                removeClass: true,
                removeDelay: COMMENT_DELAY_MS,
            })
            .addTypewriter('#tv__hero__title', heroTitleElem.dataset.text, 30)
            .addDelay(300)
            .addTypewriter('#tv__hero__body', heroBodyElem.dataset.text, 30)
            .addClassAnimation('#tv__comment-3', 'active', 500, {
                removeClass: true,
                removeDelay: COMMENT_DELAY_MS,
            })
            .addTypewriter('#tv__hero__action__1', action1Elem.dataset.text, 30)
            .addDelay(300)
            .addClassAnimation('#tv__hero__action__2', 'active', 500, {
                removeClass: false,
            })
            .addClassAnimation('#tv__comment-4', 'active', 500, {
                removeClass: true,
                removeDelay: COMMENT_DELAY_MS,
            })
            .addClassAnimation('#tv__brands', 'active', 500, {
                removeClass: false,
            })
            .addClassAnimation('#tv__comment-5', 'active', 500, {
                removeClass: true,
                removeDelay: COMMENT_DELAY_MS,
            })
            .addClassAnimation('#tv__images', 'active', 500, {
                removeClass: false,
            })
            // Wait a moment
            .addDelay(500);
        
        // Start the animation sequence
        sequencer.play().then(() => {});
    }
});