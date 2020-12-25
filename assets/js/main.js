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
        loading: false,
        next($refs) {

            if(!this.loading)
                $refs.slider.scrollLeft = $refs.slider.scrollLeft + ($refs.slider.scrollWidth / this.rows.length);

        },
        prev($refs){
            if(!this.loading)
                $refs.slider.scrollLeft = $refs.slider.scrollLeft - ($refs.slider.scrollWidth / this.rows.length)
        },
        load(){

            if(this.rows.length <= pages){

                this.loading = true;

                var params = new URLSearchParams();
                params.append('action', 'load_videos');
                params.append('cat', this.cat );
                params.append('page', this.active + 1);

                axios.post(window.ajaxurl, params)
                    .then((rsp)=>{
                        this.rows.push(rsp.data);

                        setTimeout(() => this.loading = false, 1500 );
                    });

            }
        },
        setBg(post, $refs ){

            var id = 'img' + post.id;
            setTimeout(() => this.$el.querySelector('#img-' + post.ID).style.backgroundImage = "url('" + post.img + "')", 15 );

        },
        $watch(){
            active: (value) => {
                console.log(value);
            }
        }

    }
}