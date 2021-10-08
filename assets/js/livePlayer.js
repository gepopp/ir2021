window.liveplayer = (preroll, stream) => {
    return {
        out: false,
        preroll: preroll,
        is_preroll: false,
        stream: stream,
        src: false,
        timer: 5,
        loaded: false,
        player: false,
        maxHeight: '',
        chapters:[],
        current_chapter: 0,
        tab: 'chapters',
        init(){
            maxHeight = document.getElementById('videoContainer').offsetHeight + 'px';
            new ResizeObserver(() => {
                maxHeight = document.getElementById('videoContainer').offsetHeight + 'px';
            }).observe(document.getElementById('videoContainer'));


            this.loadSrc();

            document.addEventListener('scroll', function () {
                out = !isInViewport(document.querySelector('#outer'));
            }, {
                passive: true
            });
        },
        loadSrc(gotoClip = false) {

            if (!gotoClip && preroll.preroll_id) {
                this.loadPreroll();
            } else {
                this.loadClip();
            }

        },
        loadPreroll() {
            this.is_preroll = true;
            this.src = 'https://player.vimeo.com/video/' + preroll.preroll_id;
        },
        loadClip() {
            this.is_preroll = false;
            this.loaded = false;

            this.player.unload().then(()=> {
                this.player.loadVideo(this.stream).then(() => {
                    this.player.getChapters()
                        .then((c) => {
                            this.chapters = c;
                            this.player.on('chapterchange', (c)=>{
                               this.current_chapter = c.index;
                            });
                        }).catch((e) => console.log('error'));
                }).catch(() => {
                     this.src = 'https://vimeo.com/event/' + this.stream + '/embed';
                });
            });


        },
        setupPlayer() {

            var iframe = document.querySelector('iframe');
            this.player = new Vimeo.Player(iframe);

            this.player.on('timeupdate', (e) => {
                this.timer = Math.max(0, (1 - e.seconds));
            });

            this.player.on('ended', (e) => {
                if (this.is_preroll) {
                    this.loadClip();
                }
            });
        },
        formatStart(second){
            return new Date(second * 1000).toISOString().substr(14, 5);
        },
        jump(index){
            this.player.setCurrentTime(index);
            this.player.play();
        }
    }
}