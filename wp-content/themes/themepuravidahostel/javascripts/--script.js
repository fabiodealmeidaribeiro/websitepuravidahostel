import {
    orange_add_element_styles,
    orange_add_remove_classes,
    orange_create_attribute,
    orange_create_element,
    orange_create_text,
    orange_get_class,
    orange_get_first_uppercase,
    orange_get_ID,
    orange_get_name,
    orange_get_selector,
    orange_get_selectors,
    orange_get_tag,
    orange_get_validation,
    orange_is_this,
    orange_lightbox_carousel,
    orange_lightbox_thumbnail,
    orange_remove_attribute,
    orange_set_attribute,
    orange_set_scroll,
} from './--master.js';
document.addEventListener("DOMContentLoaded", () => {
    orange_add_remove_classes({ classes: ['align-items-stretch', 'd-flex', 'g-0', 'row',], elements: ['#footer-row',], method: 'add', });
    orange_add_remove_classes({ classes: ['col-lg'], elements: ['article', '.post-highlight', '.post-postcustom', '.widget-container',], method: 'add', });
    orange_add_remove_classes({ classes: ['nav-link',], elements: ['.nav-item>a',], method: 'add', });
    orange_add_remove_classes({ classes: ['active',], elements: ['.current-cat>a', '.current_page_item>a'], method: 'add', });
    orange_lightbox_carousel();
    // orange_lightbox_thumbnail();
    window.topPosition = 0;
    topPosition += window.document.querySelector('nav').getBoundingClientRect()['top'];
    topPosition += window.document.querySelector('nav').getBoundingClientRect()['height'];
    window.bottomPosition = 0;
    bottomPosition += window.document.querySelector('#container').getBoundingClientRect()['height'];
    bottomPosition -= window['innerHeight'];
    window.document.querySelector('#container')['style']['backgroundColor'] = getComputedStyle(window.document.documentElement).getPropertyValue('--container-background');
    window.document.querySelector('#container')['style']['position'] = 'absolute';
    window.document.querySelector('#container')['style']['top'] = topPosition + 'px';
    window.addEventListener('scroll', (element) => {
        topPosition <= window['pageYOffset']
            ? orange_add_remove_classes({ classes: ['transparent',], elements: ['nav',], method: 'add', })
            : orange_add_remove_classes({ classes: ['transparent',], elements: ['nav',], method: 'remove', });
    });
    window.document.querySelector('nav').querySelector('div').querySelector('button').addEventListener('click', (element) => {
        console.log(window.document.querySelector('nav').getBoundingClientRect()['height']);
    });
    window.document.querySelector('#side-button-up').addEventListener('click', (element) => {
        window.scrollTo({
            top: topPosition + 'px',
            behavior: 'smooth',
        });
    });
    window.document.querySelector('#side-button-down').addEventListener('click', (element) => {
        window.scrollTo({
            top: bottomPosition,
            behavior: 'smooth',
        });
    });
    window.document.querySelectorAll('[data-animation=\'side-button\']').forEach((elements) => {
        elements.addEventListener('click', (element) => {
        });
        elements.addEventListener('mouseover', (element) => {
            elements.classList.add('animation');
        });
        elements.addEventListener('mouseout', (element) => {
            elements.classList.remove('animation');
        });
    });
});