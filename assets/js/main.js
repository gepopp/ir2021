// Build CSS
import '../css/app.scss'

// Import JS Modules
import menu_init from './modules/menu'

// Load Menu Script
document.addEventListener('DOMContentLoaded', menu_init);

const axios = require('axios');

document.addEventListener("DOMContentLoaded", function(event) {
    document.querySelectorAll('img').forEach(function(img){
        img.onerror = function(){this.style.display='none';};
    })
});
