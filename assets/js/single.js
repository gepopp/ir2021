const readingTime = require('reading-time');
const axios = require('axios');

window.readTime = function (text){
    return {
       text: text,

       get minutes(){
            var reading =  readingTime(this.text);

            var seconds =  reading.time / 1000;
            return parseInt(seconds / 60 );
        }

    }
}

window.articleViews = function (id){
   return{

       views: false,

       viewsXHR(){

           let views = 0;

           var params = new URLSearchParams();
           params.append('action', 'get_page_views');
           params.append('id', id);

           axios.post(window.ajaxurl, params)
               .then((rsp)=>{
                   this.views = rsp.data;
               });

       }
   }


}