window.prerolled = function (main_id, preroll_id, image, skip){
    return {
        mainId: main_id,
        prerollId: preroll_id,
        image: image,
        played:false,
        prerolls: false,
        main: false,
        countdown: skip,
        play(){
            var preroll = {
                id: this.prerollId,
                width: "1280",
                controls: false
            };
            var video01Player = new Vimeo.Player('preroll', preroll);
            video01Player.play().then(() =>  {
                this.played = true;
                this.prerolls = true;

                var timer = window.setInterval(()=>{
                    if(this.countdown > 0){
                        this.countdown--;
                    }else{
                        clearInterval(timer);
                    }
                }, 1000)

            });
            video01Player.on('ended', ()=>{
                this.playMain();
            });

            video01Player.on('play', function() {
                console.log('Played the first video');
            });

        },
        playMain(){
            var main = {
                id: this.mainId,
                width: "1280",
                controls: true
            };
            var video01Player = new Vimeo.Player('clip', main);
            video01Player.play().then(() =>  {
                this.played = true;
                this.prerolls = false;
                this.main = true;

            });


        }

    }
}