const axios = require('axios');

window.loadVimeoImage = function (){
    return {
        imgUrl: false,
        loadUrl(id){
            var params = new URLSearchParams();
            params.append('action', 'load_vimeo_thumbnail');
            params.append('id', id );
            axios.post(window.ajaxurl, params)
                .then((rsp)=>{
                    this.imgUrl = rsp.data;
                });
        }
    }
}