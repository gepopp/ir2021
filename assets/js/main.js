// Build CSS
import '../css/app.css'

// Import JS Modules
import menu_init from './modules/menu'

// Load Menu Script
document.addEventListener('DOMContentLoaded', menu_init);

const axios = require('axios');
window.slider = function ( start, cat, pages) {
    return {
        rows: [start],
        cat: cat,
        active: 0,
        pages: pages,
        next($refs) {

                $refs.slider.scrollLeft = $refs.slider.scrollLeft + ($refs.slider.scrollWidth / this.rows.length);

                this.load();

        },
        prev($refs){
            $refs.slider.scrollLeft = $refs.slider.scrollLeft - ($refs.slider.scrollWidth / this.rows.length)
        },
        load(){

            if(this.rows.length <= pages){

                var params = new URLSearchParams();
                params.append('action', 'load_videos');
                params.append('cat', this.cat );
                params.append('page', this.active + 1);

                axios.post(window.ajaxurl, params)
                    .then((rsp)=>{
                        this.rows.push(rsp.data);

                    });

            }
        }
    }
}