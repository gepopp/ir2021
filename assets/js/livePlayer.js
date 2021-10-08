window.liveplayer = (preroll, stream) => {
    return {
        out : false,
        preroll : preroll,
        is_preroll: false,
        stream : stream,
        src : false,
        timer: 5,
        player : false,
        loadSrc(gotoClip = false){

            if(!gotoClip && preroll.preroll_id){
                this.loadPreroll();

            }else{
                this.loadClip();
            }

        },
        loadPreroll(){
            this.is_preroll = true;
            this.src = 'https://player.vimeo.com/video/' + preroll.preroll_id;
        },
        loadClip(){
            this.is_preroll = false;
            this.src = 'https://vimeo.com/event/' + this.stream + '/embed';
        },
        startTimer(){
            var timer = window.setInterval(() => {
                if (this.timer > 0) {
                    this.timer--;
                } else {
                    clearInterval(timer);
                }
            }, 1000);
        },
        setupPlayer(){
            var iframe = document.querySelector('iframe');
            var player = new Vimeo.Player(iframe);

            player.on('timeupdate', (e) => {
                console.log(e);
                this.timer = Math.max(0, (5 - e.seconds));
            });

            player.on('ended', (e) => {
               if(this.is_preroll){
                   this.loadClip();
               }
            });

        },
    }
}