
/**
 * @param {string} selector 
 * @param {HTMLElement} parent 
 * @returns {HTMLElement | null}
 */
export const find = (selector, parent) => (parent || document).querySelector(selector);

/**
* @param {string} selector 
* @param {HTMLElement} parent 
* @returns {HTMLElement[]}
*/
export const findAll = (selector, parent) => (parent || document).querySelectorAll(selector);

