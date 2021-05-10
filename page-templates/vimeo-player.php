<?php
$prerolls = get_field( 'field_6097ef63e4e76', 'option' );
if ( count( $prerolls ) ) {
	shuffle( $prerolls );
	$preroll = array_shift( $prerolls );
} else {
	$preroll = [
		'preroll_id' => false,
	];
}
?>
<script>
    var preroll = <?php echo json_encode( $preroll ); ?>;
</script>
<div class="container mx-auto">
    <div x-data="prerolled('<?php echo get_field( 'field_5fe2884da38a5' ) ?>', preroll, 5)" x-init="init()" class="relative">

        <img src="<?php the_post_thumbnail_url('featured'); ?>" x-show="!isLoaded" class="w-full h-auto">

        <a :href="preroll.link" target="_blank" class="absolute w-full h-full" @click="playMain(false)"></a>
        <div id="prerollplayer" class="w-full h-auto" x-show="isPreroll"></div>
        <div id="mainplayer" class="w-full h-auto" x-show="!isPreroll"></div>
        <div @click="playMain()" x-show="countdown <= 0 && isPreroll" class="absolute bottom-0 right-0 px-3 py-2 mb-5 bg-gray-900 text-white cursor-pointer z-50">
			<?php _e( 'Werbung überspringen', 'ir21' ) ?>
        </div>
        <div x-show="countdown > 0  && isPreroll" class="absolute bottom-0 right-0 px-3 py-2 mb-5 bg-gray-900 text-white z-50 cursor-pointer"><?php _e( 'Werbung überspringen in', 'ir21' ) ?>
            <span x-text="countdown"></span> <?php _e( 'Sekunden', 'ir21' ) ?>
        </div>

        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center" x-show="!isPlaying">
            <div @click="play()">
                <div class="w-12 h-12 animate-ping bg-white rounded-full">
                    <svg class="w-12 h-12 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

    </div>
</div>