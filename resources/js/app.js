import './bootstrap';

import Cropper from 'cropperjs';
import 'cropperjs/dist/cropper.css';
window.Cropper = Cropper;

import './auth-modal';
import './location-search';
import './property-search';
import './onboarding';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

function setScrollbarWidth() {
    const outer = document.createElement('div');
    outer.style.visibility = 'hidden';
    outer.style.overflow = 'scroll';
    outer.style.msOverflowStyle = 'scrollbar';
    document.body.appendChild(outer);
    const inner = document.createElement('div');
    outer.appendChild(inner);
    const scrollbarWidth = (outer.offsetWidth - inner.offsetWidth);
    outer.parentNode.removeChild(outer);
    document.documentElement.style.setProperty('--scrollbar-width', `${scrollbarWidth}px`);
}

window.addEventListener('load', setScrollbarWidth);
window.addEventListener('resize', setScrollbarWidth);

Alpine.start();
