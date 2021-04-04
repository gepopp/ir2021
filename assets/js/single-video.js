window.prerolled = function (main_id, preroll_id, image, skip){
    return {
        mainId: main_id,
        prerollId: preroll_id,
        image: image,
        played:false,
        prerolls: false,
        main: false,
        countdown: skip,
        loading:false,
        video01Player: false,
        play(){

            this.loading = true;

            var preroll = {
                id: this.prerollId,
                width: "1280",
                responsive: true,
                controls: false,
                quality: "1080p"
            };


            this.video01Player = new Vimeo.Player('preroll', preroll);
            this.video01Player.play().then(() =>  {
                this.loading = false;
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
            this.video01Player.on('ended', ()=>{
                this.playMain();
            });

        },
        playMain(autoplay = true){

            this.video01Player.pause();

            var main = {
                id: this.mainId,
                width: "1280",
                responsive: true,
                controls: true
            };
            var video01Player = new Vimeo.Player('clip', main);
            this.played = true;
            this.prerolls = false;
            this.main = true;

            if(autoplay){
                video01Player.play().then(() =>  {
                });
            }



        }

    }
}