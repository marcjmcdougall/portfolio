/**
 * Creates a typewriter effect in the specified element
 * @param {HTMLElement} element - The element to type text into
 * @param {string} text - The text to type
 * @param {number} speed - Typing speed in milliseconds per character
 * @param {Function} onComplete - Callback function when typing is complete
 */
export function typewriter(element, text, speed = 50, onComplete = null) {
  // Clear existing text
  element.textContent = '';
  
  let i = 0;
  
  const timer = setInterval(() => {
    if (i < text.length) {
      // Add the next character
      element.textContent += text.charAt(i);
      i++;
    } else {
      clearInterval(timer);
      if (onComplete) onComplete();
    }
  }, speed);
}
