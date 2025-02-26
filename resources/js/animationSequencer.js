/**
 * Animation Sequencer - Chain and coordinate complex animation sequences
 */
export class AnimationSequencer {
    constructor() {
      this.animations = [];
      this.isPlaying = false;
    }
  
    /**
     * Add a CSS class animation to the sequence
     * @param {HTMLElement|string} element - The element or selector to animate
     * @param {string} className - The class to add for animation
     * @param {number} duration - Animation duration in ms (used for timing)
     * @param {object} options - Additional options
     * @returns {AnimationSequencer} - Returns this for chaining
     */
    addClassAnimation(element, className, duration, options = {}) {
      this.animations.push({
        type: 'class',
        element: typeof element === 'string' ? document.querySelector(element) : element,
        className,
        duration,
        options
      });
      return this;
    }
  
    /**
     * Add a typewriter animation to the sequence
     * @param {HTMLElement|string} element - The element or selector to animate
     * @param {string} text - The text to type
     * @param {number} speed - Typing speed in ms
     * @param {object} options - Additional options
     * @returns {AnimationSequencer} - Returns this for chaining
     */
    addTypewriter(element, text, speed = 50, options = {}) {
      this.animations.push({
        type: 'typewriter',
        element: typeof element === 'string' ? document.querySelector(element) : element,
        text,
        speed,
        options
      });
      return this;
    }
  
    /**
     * Add a delay to the sequence
     * @param {number} duration - Delay duration in ms
     * @returns {AnimationSequencer} - Returns this for chaining
     */
    addDelay(duration) {
      this.animations.push({
        type: 'delay',
        duration
      });
      return this;
    }
  
    /**
     * Start parallel animations (multiple animations at once)
     * @returns {ParallelGroup} - A parallel group to add animations to
     */
    startParallel() {
      const group = new ParallelGroup(this);
      this.animations.push({
        type: 'parallel',
        group
      });
      return group;
    }
  
    /**
     * Add a conditional branch to the sequence
     * @param {Function} condition - Function that returns true/false
     * @param {Function} trueSequence - Function to call  condition is true
     * @param {Function} falseSequence - Function to call if condition is false
     * @returns {AnimationSequencer} - Returns this for chaining
     */
    addCondition(condition, trueSequence, falseSequence) {
      this.animations.push({
        type: 'condition',
        condition,
        trueSequence,
        falseSequence
      });
      return this;
    }
  
    /**
     * Add a custom animation function to the sequence
     * @param {Function} fn - Function that returns a Promise
     * @returns {AnimationSequencer} - Returns this for chaining
     */
    addCustom(fn) {
      this.animations.push({
        type: 'custom',
        fn
      });
      return this;
    }
  
    /**
     * Play the animation sequence
     * @returns {Promise} - Promise that resolves when all animations complete
     */
    play() {
      if (this.isPlaying) return Promise.reject('Animation already playing');
      
      this.isPlaying = true;
      let index = 0;
      
      const playNext = () => {
        if (index >= this.animations.length) {
          this.isPlaying = false;
          return Promise.resolve();
        }
        
        const animation = this.animations[index++];
        
        switch (animation.type) {
          case 'class':
            return this._playClassAnimation(animation).then(playNext);
          
          case 'typewriter':
            return this._playTypewriter(animation).then(playNext);
          
          case 'delay':
            return new Promise(resolve => setTimeout(resolve, animation.duration)).then(playNext);
          
          case 'parallel':
            return animation.group._playAll().then(playNext);
          
          case 'condition':
            if (animation.condition()) {
              const trueSequencer = new AnimationSequencer();
              animation.trueSequence(trueSequencer);
              return trueSequencer.play().then(playNext);
            } else if (animation.falseSequence) {
              const falseSequencer = new AnimationSequencer();
              animation.falseSequence(falseSequencer);
              return falseSequencer.play().then(playNext);
            }
            return playNext();
          
          case 'custom':
            return animation.fn().then(playNext);
          
          default:
            return playNext();
        }
      };
      
      return playNext();
    }

    /**
     * Run the animation sequence when an element scrolls into view
     * @param {HTMLElement|string} trigger - Element that triggers the animation when visible
     * @param {object} options - Observer options
     *        {number} options.threshold - Visibility threshold (0-1, default: 0.2)
     *        {string} options.rootMargin - Margin around root (default: "0px")
     *        {boolean} options.once - Only trigger once (default: true)
     * @returns {AnimationSequencer} - Returns this for chaining
     */
    playWhenVisible(trigger, options = {}) {
      const element = typeof trigger === 'string' ? 
        document.querySelector(trigger) : trigger;
      
      if (!element) {
        console.warn('Trigger element not found:', trigger);
        return this;
      }
      
      const observerOptions = {
        threshold: options.threshold || 0.2,
        rootMargin: options.rootMargin || "0px",
      };
      
      const runOnce = options.once !== false;
      let hasRun = false;
      
      const observer = new IntersectionObserver((entries) => {
        const entry = entries[0];
        
        if (entry.isIntersecting && (!hasRun || !runOnce)) {
          // Element is now visible, play the animation
          this.play().then(() => {
            if (options.onComplete) {
              options.onComplete();
            }
          });
          
          hasRun = true;
          
          // Disconnect observer if we only want to run once
          if (runOnce) {
            observer.disconnect();
          }
        } else if (!entry.isIntersecting && options.resetWhenHidden && hasRun && !runOnce) {
          // Reset animations when element leaves viewport (for repeat animations)
          this.reset();
        }
      }, observerOptions);
      
      // Start observing
      observer.observe(element);
      
      // Store the observer for potential cleanup
      this._observer = observer;
      
      return this;
    }

    /**
     * Stop and clean up all animations
     */
    destroy() {
      if (this._observer) {
        this._observer.disconnect();
      }
      
      // Reset any animations
      this.reset();
      
      return this;
    }
  
    
/**
 * Play a class-based animation
 * @private
 */
_playClassAnimation(animation) {
    return new Promise(resolve => {
      const element = animation.element;
      const removeDelay = animation.options.removeDelay || 0;
      let transitionEndHandler;
      
      // Function to handle removing the class with delay
      const removeClassWithDelay = () => {
        if (animation.options.removeClass) {
          if (removeDelay > 0) {
            setTimeout(() => {
              element.classList.remove(animation.className);
            }, removeDelay);
          } else {
            element.classList.remove(animation.className);
          }
        }
      };
      
      // Listen for transition end if this is a CSS transition
      if (animation.options.waitForTransition !== false) {
        transitionEndHandler = () => {
          element.removeEventListener('transitionend', transitionEndHandler);
          
          // Remove the class after delay
          removeClassWithDelay();
          
          // Resolve after the class removal (including delay)
          setTimeout(resolve, removeDelay + 50);
        };
        element.addEventListener('transitionend', transitionEndHandler);
      }
      
      // Add the class to trigger animation
      element.classList.add(animation.className);
      
      // If not waiting for transition or no transition, use duration
      if (animation.options.waitForTransition === false) {
        setTimeout(() => {
          removeClassWithDelay();
          // Resolve after the class removal (including delay)
          setTimeout(resolve, removeDelay + 50);
        }, animation.duration);
      }
      
      // Fallback in case transitionend doesn't fire
      const fallback = setTimeout(() => {
        if (transitionEndHandler) {
          element.removeEventListener('transitionend', transitionEndHandler);
        }
        removeClassWithDelay();
        // Resolve after the class removal (including delay)
        setTimeout(resolve, removeDelay + 50);
      }, animation.duration + 150);
    });
  }
  
    /**
     * Play a typewriter animation
     * @private
     */
    _playTypewriter(animation) {
      return new Promise(resolve => {
        const element = animation.element;
        const text = animation.text;
        const speed = animation.speed;
        
        // Clear existing text
        element.textContent = '';
        
        let i = 0;
        const totalDuration = text.length * speed;
        
        const timer = setInterval(() => {
          if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
          } else {
            clearInterval(timer);
            resolve();
          }
        }, speed);
        
        // Fallback
        setTimeout(() => {
          clearInterval(timer);
          element.textContent = text;
          resolve();
        }, totalDuration + 100);
      });
    }
  }
  
  /**
   * Helper class for parallel animation groups
   */
  class ParallelGroup {
    constructor(parent) {
      this.parent = parent;
      this.animations = [];
    }
  
    /**
     * Add a CSS class animation to the parallel group
     */
    addClassAnimation(element, className, duration, options = {}) {
      this.animations.push({
        type: 'class',
        element: typeof element === 'string' ? document.querySelector(element) : element,
        className,
        duration,
        options: {
            ...options,
            removeClass: options.removeClass !== undefined ? options.removeClass : true, // Default to true
            removeDelay: options.removeDelay || 0,
            waitForTransition: options.waitForTransition !== false,
          }
      });
      return this;
    }
  
    /**
     * Add a typewriter animation to the parallel group
     */
    addTypewriter(element, text, speed = 50, options = {}) {
      this.animations.push({
        type: 'typewriter',
        element: typeof element === 'string' ? document.querySelector(element) : element,
        text,
        speed,
        options
      });
      return this;
    }
  
    /**
     * Add a custom animation to the parallel group
     */
    addCustom(fn) {
      this.animations.push({
        type: 'custom',
        fn
      });
      return this;
    }
  
    /**
     * End the parallel group and return to sequential animations
     */
    end() {
      return this.parent;
    }
  
    /**
     * Play all animations in the parallel group
     * @private
     */
    _playAll() {
      const promises = this.animations.map(animation => {
        switch (animation.type) {
          case 'class':
            return this.parent._playClassAnimation(animation);
          
          case 'typewriter':
            return this.parent._playTypewriter(animation);
          
          case 'custom':
            return animation.fn();
          
          default:
            return Promise.resolve();
        }
      });
      
      return Promise.all(promises);
    }
  }