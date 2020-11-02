const readingTime = require('reading-time');
const axios = require('axios');

window.readTime = function (text){
    return {
       text: text,

       get minutes(){
            var reading =  readingTime(this.text);

            var seconds =  reading.time / 1000;
            var minutes = parseInt(seconds / 60 );
            if(minutes > 1){
                return minutes + ' Minuten';
            }else{
                return '1 Minute';
            }
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