export let orange_get_class = (element) => { return window.document.getElementsByClassName(element); };

export let orange_get_ID = (element) => { return window.document.getElementById(element); };

export let orange_get_name = (element) => { return window.document.getElementsByName(element); };

export let orange_get_selector = (element) => { return window.document.querySelector(element); };

export let orange_get_selectors = (element) => { return window.document.querySelectorAll(element); };

export let orange_get_tag = (element) => { return window.document.getElementsByTagName(element); };

export let orange_create_attribute = (element) => { return window.document.createAttribute(element); };

export let orange_remove_attribute = (element) => { return window.document.removeAttribute(element); };

export let orange_create_element = (element) => { return window.document.createElement(element); };

export let orange_create_text = (element) => { return window.document.createTextNode(element); };

export let orange_is_this = (string, type) => { return typeof string === type; };

export let orange_add_remove_classes = (object) => {
    for (let x = 0; x < object['elements']['length']; x++)
        for (let y = 0; y < orange_get_selectors(object['elements'][x])['length']; y++)
            for (let z = 0; z < object['classes']['length']; z++)
                orange_get_selectors(object['elements'][x])[y]['classList'][object['method']](object['classes'][z]);
};

export let orange_get_first_uppercase = (content) => {
    let result = '';
    result += (content).charAt(0).toUpperCase();
    result += (content).slice(1);
    return result;
};

export let orange_get_validation = (content) => {
    if (!content) return false;
    else if (orange_is_this(content, 'undefined')) return false;
    else return true;
};

export let orange_set_attribute = (object) => {
    let attribute = createAttribute(object['attribute']);
    if (orange_is_this(object['value'], 'string')) {
        attribute['value'] = object['value'];
    } else if (orange_is_this(object['value'], 'object')) {
        for (let i = 0; i < object['value']['length']; i++) {
            attribute['value'] += !i ? '' : ' ';
            attribute['value'] += object['value'][i];
        }
    }
    object['element'].setAttributeNode(attribute);
};

export let orange_add_element_styles = (object) => {
    let index = Object.getOwnPropertyNames(object['style']);
    for (let x = 0; x < object['element']['length']; x++) {
        for (let y = 0; y < index['length']; y++) {
            object['element'][x]['style'][index[y]] = Object.getOwnPropertyDescriptors(object['style'])[index[y]]['value'];
        };
    };
};

export let orange_set_scroll = (string = 'yes') => {
    document.documentElement.style.overflow = string === 'yes' ? 'auto' : 'hidden';
    document.body.scroll = string === 'yes' ? 'yes' : 'no';
};

export let orange_lightbox_carousel = () => {
    const lightbox = document.getElementById('light-box');
    const wrapper = document.getElementById('light-box-wrapper');
    document.querySelectorAll('.carousel').forEach((carousel) => {
        carousel.querySelectorAll('.carousel-inner').forEach((carousel_inner) => {
            carousel_inner.querySelectorAll('.carousel-item').forEach((carousel_item) => {
                carousel_item.addEventListener('click', function (event) {
                    const ID = 'carousel-virtual';
                    wrapper.innerHTML = carousel.outerHTML;
                    wrapper.querySelector('.carousel').setAttribute('id', ID);
                    wrapper.querySelector('.carousel').setAttribute('data-bs-ride', ID);
                    wrapper.querySelectorAll('button').forEach((button) => {
                        button.setAttribute('data-bs-target', '#' + ID);
                    });
                    wrapper.querySelectorAll('.carousel-item').forEach((carousel_item) => {
                        carousel_item.addEventListener('click', function (event) {
                            lightbox.classList.remove('light-box-show');
                            orange_set_scroll();
                        });
                    });
                    lightbox.classList.add('light-box-show');
                    orange_set_scroll('no');
                });
            });
        });
    });
};

export let orange_lightbox_thumbnail = () => {
    const lightbox = document.getElementById('light-box');
    const wrapper = document.getElementById('light-box-wrapper');
    document.querySelectorAll('.thumbnail-wrapper').forEach((thumbnail_wrapper) => {
        const thumbnail_title = thumbnail_wrapper.querySelector('.thumbnail-title');
        thumbnail_wrapper.addEventListener('mouseover', function (event) {
            thumbnail_title.classList.add('thumbnail-title-show');
        });
        thumbnail_wrapper.addEventListener('mouseout', function (event) {
            thumbnail_title.classList.remove('thumbnail-title-show');
        });
        thumbnail_wrapper.addEventListener('click', function (event) {
            wrapper.style.backgroundAttachment = 'scroll';
            wrapper.style.backgroundImage = thumbnail_wrapper.querySelector('.thumbnail-content')['style']['backgroundImage'];
            wrapper.style.backgroundPosition = 'center';
            wrapper.style.backgroundRepeat = 'no-repeat';
            wrapper.style.backgroundSize = 'cover';
            lightbox.classList.add('light-box-show');
            orange_set_scroll('no');
        });
    });
    lightbox.addEventListener('click', (event) => {
        lightbox.classList.remove('light-box-show');
        orange_set_scroll();
    });
};