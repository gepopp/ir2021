<!DOCTYPE html>
<!--
	NOTES:
	1. All tokens are represented by '$' sign in the template.
	2. You can write your code only wherever mentioned.
	3. All occurrences of existing tokens will be replaced by their appropriate values.
	4. Blank lines will be removed automatically.
	5. Remove unnecessary comments before creating your template.
-->
<html>
<head>
<meta charset="UTF-8">
<meta name="authoring-tool" content="Adobe_Animate_CC">
<title>600x1200</title>
							  <script>
  var getUriParams = function(){
    var query_string = {}
    var query = window.location.search.substring(1);
    var parmsArray = query.split('&');
    if(parmsArray.length <= 0) return query_string;
    for(var i=0; i< parmsArray.length; i++){
      var pair = parmsArray[i].split('=');
      var val = decodeURIComponent(pair[1]);
      if (val != '' && pair[0] != '') query_string[pair[0]] = val;
    }
    return query_string;
  }();
  </script>
<!-- write your code here -->
<script src="https://code.createjs.com/1.0.0/createjs.min.js"></script>
<script>
    (function (cjs, an) {

        var p; // shortcut to reference prototypes
        var lib={};var ss={};var img={};
        lib.ssMetadata = [
            {name:"600x1200_atlas_1", frames: [[0,0,600,1200],[602,0,600,1200],[1204,0,600,1200]]},
            {name:"600x1200_atlas_2", frames: [[0,0,600,1200],[0,1202,600,295],[602,0,600,1200],[1204,0,600,1200]]}
        ];


        (lib.AnMovieClip = function(){
            this.actionFrames = [];
            this.ignorePause = false;
            this.gotoAndPlay = function(positionOrLabel){
                cjs.MovieClip.prototype.gotoAndPlay.call(this,positionOrLabel);
            }
            this.play = function(){
                cjs.MovieClip.prototype.play.call(this);
            }
            this.gotoAndStop = function(positionOrLabel){
                cjs.MovieClip.prototype.gotoAndStop.call(this,positionOrLabel);
            }
            this.stop = function(){
                cjs.MovieClip.prototype.stop.call(this);
            }
        }).prototype = p = new cjs.MovieClip();
// symbols:



        (lib.baumanagement_5 = function() {
            this.initialize(ss["600x1200_atlas_1"]);
            this.gotoAndStop(0);
        }).prototype = p = new cjs.Sprite();



        (lib.beratung_2 = function() {
            this.initialize(ss["600x1200_atlas_1"]);
            this.gotoAndStop(1);
        }).prototype = p = new cjs.Sprite();



        (lib.bewertung_3 = function() {
            this.initialize(ss["600x1200_atlas_1"]);
            this.gotoAndStop(2);
        }).prototype = p = new cjs.Sprite();



        (lib.hintergrund = function() {
            this.initialize(ss["600x1200_atlas_2"]);
            this.gotoAndStop(0);
        }).prototype = p = new cjs.Sprite();



        (lib.leben_immobilien_text = function() {
            this.initialize(ss["600x1200_atlas_2"]);
            this.gotoAndStop(1);
        }).prototype = p = new cjs.Sprite();



        (lib.vermittlung_1 = function() {
            this.initialize(ss["600x1200_atlas_2"]);
            this.gotoAndStop(2);
        }).prototype = p = new cjs.Sprite();



        (lib.verwaltung_4 = function() {
            this.initialize(ss["600x1200_atlas_2"]);
            this.gotoAndStop(3);
        }).prototype = p = new cjs.Sprite();



        (lib.Tween7 = function(mode,startPosition,loop,reversed) {
            if (loop == null) { loop = true; }
            if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);

            // Ebene_1
            this.instance = new lib.leben_immobilien_text();
            this.instance.setTransform(-300,-147.5);

            this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

            this._renderFirstFrame();

        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-300,-147.5,600,295);


        (lib.Tween6 = function(mode,startPosition,loop,reversed) {
            if (loop == null) { loop = true; }
            if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);

            // Ebene_1
            this.instance = new lib.baumanagement_5();
            this.instance.setTransform(-300,-600);

            this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

            this._renderFirstFrame();

        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-300,-600,600,1200);


        (lib.Tween5 = function(mode,startPosition,loop,reversed) {
            if (loop == null) { loop = true; }
            if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);

            // Ebene_1
            this.instance = new lib.verwaltung_4();
            this.instance.setTransform(-300,-600);

            this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

            this._renderFirstFrame();

        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-300,-600,600,1200);


        (lib.Tween4 = function(mode,startPosition,loop,reversed) {
            if (loop == null) { loop = true; }
            if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);

            // Ebene_1
            this.instance = new lib.bewertung_3();
            this.instance.setTransform(-300,-600);

            this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

            this._renderFirstFrame();

        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-300,-600,600,1200);


        (lib.Tween3 = function(mode,startPosition,loop,reversed) {
            if (loop == null) { loop = true; }
            if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);

            // Ebene_1
            this.instance = new lib.beratung_2();
            this.instance.setTransform(-300,-600);

            this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

            this._renderFirstFrame();

        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-300,-600,600,1200);


        (lib.Tween2 = function(mode,startPosition,loop,reversed) {
            if (loop == null) { loop = true; }
            if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);

            // Ebene_1
            this.instance = new lib.vermittlung_1();
            this.instance.setTransform(-300,-600);

            this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

            this._renderFirstFrame();

        }).prototype = p = new cjs.MovieClip();
        p.nominalBounds = new cjs.Rectangle(-300,-600,600,1200);


// stage content:
        (lib._600x1200 = function(mode,startPosition,loop,reversed) {
            if (loop == null) { loop = true; }
            if (reversed == null) { reversed = false; }
            var props = new Object();
            props.mode = mode;
            props.startPosition = startPosition;
            props.labels = {};
            props.loop = loop;
            props.reversed = reversed;
            cjs.MovieClip.apply(this,[props]);

            // baumanagement_5
            this.instance = new lib.Tween6("synched",0);
            this.instance.setTransform(300,600);
            this.instance.alpha = 0;
            this.instance._off = true;

            this.timeline.addTween(cjs.Tween.get(this.instance).wait(209).to({_off:false},0).to({alpha:1},30).to({startPosition:0},30).to({alpha:0},25).wait(1));

            // verwaltung_4
            this.instance_1 = new lib.Tween5("synched",0);
            this.instance_1.setTransform(300,600);
            this.instance_1.alpha = 0;
            this.instance_1._off = true;

            this.timeline.addTween(cjs.Tween.get(this.instance_1).wait(179).to({_off:false},0).to({alpha:1},30).to({startPosition:0},60).to({alpha:0},25).wait(1));

            // bewertung_3
            this.instance_2 = new lib.Tween4("synched",0);
            this.instance_2.setTransform(300,600);
            this.instance_2.alpha = 0;
            this.instance_2._off = true;

            this.timeline.addTween(cjs.Tween.get(this.instance_2).wait(149).to({_off:false},0).to({alpha:1},30).to({startPosition:0},90).to({alpha:0},25).wait(1));

            // beratung_2
            this.instance_3 = new lib.Tween3("synched",0);
            this.instance_3.setTransform(300,601);
            this.instance_3.alpha = 0;
            this.instance_3._off = true;

            this.timeline.addTween(cjs.Tween.get(this.instance_3).wait(119).to({_off:false},0).to({alpha:1},30).to({startPosition:0},120).to({alpha:0},25).wait(1));

            // vermittlung_1
            this.instance_4 = new lib.Tween2("synched",0);
            this.instance_4.setTransform(300,601);
            this.instance_4.alpha = 0;
            this.instance_4._off = true;

            this.timeline.addTween(cjs.Tween.get(this.instance_4).wait(89).to({_off:false},0).to({alpha:1},30).to({startPosition:0},150).to({alpha:0},25).wait(1));

            // leben_immobilien
            this.instance_5 = new lib.Tween7("synched",0);
            this.instance_5.setTransform(300,769.5);
            this.instance_5.alpha = 0;

            this.timeline.addTween(cjs.Tween.get(this.instance_5).to({alpha:1},29).to({startPosition:0},30).to({alpha:0},30).to({_off:true},1).wait(205));

            // hintergrund
            this.instance_6 = new lib.hintergrund();
            this.instance_6.setTransform(0,1);

            this.timeline.addTween(cjs.Tween.get(this.instance_6).wait(295));

            this._renderFirstFrame();

        }).prototype = p = new lib.AnMovieClip();
        p.nominalBounds = new cjs.Rectangle(300,600,300,601);
// library properties:
        lib.properties = {
            id: '375AD2ED8164904AA99BF2E3EAB9FC73',
            width: 600,
            height: 1200,
            fps: 24,
            color: "#FFFFFF",
            opacity: 1.00,
            manifest: [
                {src:"600x1200_atlas_1.png", id:"600x1200_atlas_1"},
                {src:"600x1200_atlas_2.png", id:"600x1200_atlas_2"}
            ],
            preloads: []
        };



// bootstrap callback support:

        (lib.Stage = function(canvas) {
            createjs.Stage.call(this, canvas);
        }).prototype = p = new createjs.Stage();

        p.setAutoPlay = function(autoPlay) {
            this.tickEnabled = autoPlay;
        }
        p.play = function() { this.tickEnabled = true; this.getChildAt(0).gotoAndPlay(this.getTimelinePosition()) }
        p.stop = function(ms) { if(ms) this.seek(ms); this.tickEnabled = false; }
        p.seek = function(ms) { this.tickEnabled = true; this.getChildAt(0).gotoAndStop(lib.properties.fps * ms / 1000); }
        p.getDuration = function() { return this.getChildAt(0).totalFrames / lib.properties.fps * 1000; }

        p.getTimelinePosition = function() { return this.getChildAt(0).currentFrame / lib.properties.fps * 1000; }

        an.bootcompsLoaded = an.bootcompsLoaded || [];
        if(!an.bootstrapListeners) {
            an.bootstrapListeners=[];
        }

        an.bootstrapCallback=function(fnCallback) {
            an.bootstrapListeners.push(fnCallback);
            if(an.bootcompsLoaded.length > 0) {
                for(var i=0; i<an.bootcompsLoaded.length; ++i) {
                    fnCallback(an.bootcompsLoaded[i]);
                }
            }
        };

        an.compositions = an.compositions || {};
        an.compositions['375AD2ED8164904AA99BF2E3EAB9FC73'] = {
            getStage: function() { return exportRoot.stage; },
            getLibrary: function() { return lib; },
            getSpriteSheet: function() { return ss; },
            getImages: function() { return img; }
        };

        an.compositionLoaded = function(id) {
            an.bootcompsLoaded.push(id);
            for(var j=0; j<an.bootstrapListeners.length; j++) {
                an.bootstrapListeners[j](id);
            }
        }

        an.getComposition = function(id) {
            return an.compositions[id];
        }


        an.makeResponsive = function(isResp, respDim, isScale, scaleType, domContainers) {
            var lastW, lastH, lastS=1;
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();
            function resizeCanvas() {
                var w = lib.properties.width, h = lib.properties.height;
                var iw = window.innerWidth, ih=window.innerHeight;
                var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;
                if(isResp) {
                    if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {
                        sRatio = lastS;
                    }
                    else if(!isScale) {
                        if(iw<w || ih<h)
                            sRatio = Math.min(xRatio, yRatio);
                    }
                    else if(scaleType==1) {
                        sRatio = Math.min(xRatio, yRatio);
                    }
                    else if(scaleType==2) {
                        sRatio = Math.max(xRatio, yRatio);
                    }
                }
                domContainers[0].width = w * pRatio * sRatio;
                domContainers[0].height = h * pRatio * sRatio;
                domContainers.forEach(function(container) {
                    container.style.width = w * sRatio + 'px';
                    container.style.height = h * sRatio + 'px';
                });
                stage.scaleX = pRatio*sRatio;
                stage.scaleY = pRatio*sRatio;
                lastW = iw; lastH = ih; lastS = sRatio;
                stage.tickOnUpdate = false;
                stage.update();
                stage.tickOnUpdate = true;
            }
        }
        an.handleSoundStreamOnTick = function(event) {
            if(!event.paused){
                var stageChild = stage.getChildAt(0);
                if(!stageChild.paused || stageChild.ignorePause){
                    stageChild.syncStreamSounds();
                }
            }
        }
        an.handleFilterCache = function(event) {
            if(!event.paused){
                var target = event.target;
                if(target){
                    if(target.filterCacheList){
                        for(var index = 0; index < target.filterCacheList.length ; index++){
                            var cacheInst = target.filterCacheList[index];
                            if((cacheInst.startFrame <= target.currentFrame) && (target.currentFrame <= cacheInst.endFrame)){
                                cacheInst.instance.cache(cacheInst.x, cacheInst.y, cacheInst.w, cacheInst.h);
                            }
                        }
                    }
                }
            }
        }


    })(createjs = createjs||{}, AdobeAn = AdobeAn||{});
    var createjs, AdobeAn;
</script>
<script>
var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
function init() {
	canvas = document.getElementById("canvas");
	anim_container = document.getElementById("animation_container");
	dom_overlay_container = document.getElementById("dom_overlay_container");
	var comp=AdobeAn.getComposition("375AD2ED8164904AA99BF2E3EAB9FC73");
	var lib=comp.getLibrary();
	var loader = new createjs.LoadQueue(false);
	loader.addEventListener("fileload", function(evt){handleFileLoad(evt,comp)});
	loader.addEventListener("complete", function(evt){handleComplete(evt,comp)});
	var lib=comp.getLibrary();
	loader.loadManifest(lib.properties.manifest);
}
function handleFileLoad(evt, comp) {
	var images=comp.getImages();	
	if (evt && (evt.item.type == "image")) { images[evt.item.id] = evt.result; }	
}
function handleComplete(evt,comp) {
	//This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
	var lib=comp.getLibrary();
	var ss=comp.getSpriteSheet();
	var queue = evt.target;
	var ssMetadata = lib.ssMetadata;
	for(i=0; i<ssMetadata.length; i++) {
		ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
	}
	exportRoot = new lib._600x1200();
	stage = new lib.Stage(canvas);	
	//Registers the "tick" event listener.
	fnStartAnimation = function() {
		stage.addChild(exportRoot);
		createjs.Ticker.framerate = lib.properties.fps;
		createjs.Ticker.addEventListener("tick", stage);
	}	    
	//Code to support hidpi screens and responsive scaling.
	AdobeAn.makeResponsive(true,'both',false,1,[canvas,anim_container,dom_overlay_container]);	
	AdobeAn.compositionLoaded(lib.properties.id);
	fnStartAnimation();
}
</script>
<!-- write your code here -->
</head>
<body onload="init();" style="margin:0px;">
		<a href="#clicktag" id="IAB_clicktag" target="_blank">
	<div id="animation_container" style="background-color:rgba(255, 255, 255, 1.00); width:600px; height:1200px">
		<canvas id="canvas" width="600" height="1200" style="position: absolute; display: block; background-color:rgba(255, 255, 255, 1.00);"></canvas>
		<div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:600px; height:1200px; position: absolute; left: 0px; top: 0px; display: block;">
		</div>
	</div>
																					      </a>
        
        <script>
          document.getElementById('IAB_clicktag').setAttribute('href', getUriParams.clicktag);
        </script>
</body>
</html>