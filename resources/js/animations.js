import { typewriter } from './typewriter';
import { AnimationSequencer } from './animationSequencer.js';

const COMMENT_DELAY_MS = 1000;

document.addEventListener('DOMContentLoaded', () => {

    // Teardown Visualizer
    if ( document.querySelector('.teardown-visualizer')) {
        const sequencer = new AnimationSequencer();

        const heroTitleElem = document.getElementById('tv__hero__title');
        const heroBodyElem = document.getElementById('tv__hero__body');

        const action1Elem = document.getElementById('tv__hero__action__1');

        // console.log( headerTextElem.dataset.text );
        
        // Create a complex animation sequence
        sequencer
            // Wait a moment
            .addDelay(2000)
            .startParallel()
                .addClassAnimation('#tv__loader', 'complete', 500, {
                    removeClass: false,
                })
                .addClassAnimation('#teardown-visualizer', 'active', 500, {
                    removeClass: false,
                })
            .end()
            .addDelay(500)
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
        // sequencer.play().then(() => {});

        sequencer.playWhenVisible('#teardown-visualizer', {
            threshold: 0.5,       // Trigger when 50% visible
            rootMargin: '0px',    // No margin
            once: true,           // Only trigger once
            onComplete: () => {
                // console.log('Teardown visualizer animation sequence complete!');
            }
        });
    }

     // Task Visualizer
     if ( document.querySelector('.task-visualizer')) {
        const sequencer = new AnimationSequencer();

        // const heroTitleElem = document.getElementById('tv__hero__title');
        
        // Create a complex animation sequence
        sequencer
            // Wait a moment
            .addDelay(300)
            .startParallel()
                .addClassAnimation('#tv__task-1', 'task-visualizer__list__item--complete', 500, {
                    removeClass: false,
                })
                .addClassAnimation('#tv__tracker__progress', 'task-visualizer__tracker__progress__current--10', 500, {
                    removeClass: false,
                })
                .addTypewriter('#tv__conversion__percent', "0.87", 30)
            .end()
            .addDelay(200)
            .startParallel()
                .addClassAnimation('#tv__task-2', 'task-visualizer__list__item--complete', 500, {
                    removeClass: false,
                })
                .addClassAnimation('#tv__tracker__progress', 'task-visualizer__tracker__progress__current--15', 500, {
                    removeClass: false,
                })
                .addTypewriter('#tv__conversion__percent', "2.36", 30)
            .end()
            .addDelay(200)
            .startParallel()
                .addClassAnimation('#tv__task-3', 'task-visualizer__list__item--complete', 500, {
                    removeClass: false,
                })
                .addClassAnimation('#tv__tracker__progress', 'task-visualizer__tracker__progress__current--20', 500, {
                    removeClass: false,
                })
                .addTypewriter('#tv__conversion__percent', "3.52", 30)
            .end();
        
        // Start the animation sequence
        // sequencer.play().then(() => {});
        sequencer.playWhenVisible('#task-visualizer', {
            threshold: 0.5,       // Trigger when 50% visible
            rootMargin: '0px',    // No margin
            once: true,           // Only trigger once
            onComplete: () => {
                console.log('Teardown visualizer animation sequence complete!');
            }
        });
    }
});