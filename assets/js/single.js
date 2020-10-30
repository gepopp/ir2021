const readingTime = require('reading-time');

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