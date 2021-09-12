import '../css/app.scss';


// Import JS Modules
import menu_init from './modules/menu'

window.readingTime = require('reading-time');
window.cookie = require('js-cookie');
window.axios = require('axios');
window.moment = require("moment");
window.duration = require("moment-duration-format");


require('./diskutieren');
require('./live_events');
require('./login');
require('./profile');
require('./sehen');
require('./single');
require('./single-video');


// Load Menu Script
document.addEventListener('DOMContentLoaded', menu_init);


document.addEventListener("DOMContentLoaded", function (event) {
    document.querySelectorAll('img').forEach(function (img) {
        img.onerror = function () {
            this.style.display = 'none';
        };
    })
});

