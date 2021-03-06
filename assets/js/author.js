const axios = require('axios');

window.loadMore = function (author){
    return{

        offset: 10,
        loaded: [],
        id: author,
        load(id){

            let views = 0;

            var params = new URLSearchParams();
            params.append('action', 'load_more_author');
            params.append('id', id );
            params.append('offset', this.offset);

            axios.post(window.ajaxurl, params)
                .then((rsp)=>{

                    rsp.data.map((post) => {
                        this.loaded.push(post);
                    })

                    this.offset += 10;
                });

        }
    }
}