<?php
$prerolls = get_field( 'field_6097ef63e4e76', 'option' );
if ( $prerolls ) {
	shuffle( $prerolls );
	$preroll = array_shift( $prerolls );
} else {
	$preroll = [
		'preroll_id' => false,
	];
}
?>
<div class="container mx-auto mt-48">
    <div class="hidden lg:block"></div>

	<?php if ( get_the_ID() != 40811 ): ?>
        <div class="col-span-5 lg:col-span-3 -mx-5">
			<?php get_template_part( 'banner', 'mega' ) ?>
        </div>
	<?php endif; ?>

</div>
<script>

    var preroll = <?php echo json_encode( $preroll ) ?>;

    function isInViewport(el) {
        const rect = el.getBoundingClientRect();
        return (
            rect.top >= 0 && rect.left >= 0
        );
    }
</script>
<div class="container mx-auto">
    <div class="hidden lg:block"></div>
    <div class="col-span-5 lg:col-span-3  py-5">
        <div class="grid grid-cols-4 gap-5" x-data="liveplayer(preroll, <?php echo get_field( 'field_5fe2884da38a5' ) ?>)" x-init="init()">
            <div class="relative col-span-4 lg:col-span-3" id="videoContainer">
                <div style="padding:56.25% 0 0 0;position:relative;">
                    <div id="outer"></div>
                    <div :class="out == true ? 'fixed bottom-0 right-0 w-96 h-60 z-50 shadow-2xl m-10' : ''">
                        <iframe :src="src"
                                frameborder="0"
                                allow="autoplay; fullscreen; picture-in-picture"
                                allowfullscreen
                                style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                id="player"
                                @load="setupPlayer()"
                        ></iframe>

                        <div class="absolute top-0 left-0 mt-10 bg-gray-800 text-white p-5 cursor-pointer flex space-x-5" @click="window.open( preroll.link, '_blank' )" x-show="is_preroll">
                            <span>Zum Werbetreibenden</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                        </div>
                        <div class="absolute bottom-0 right-0 p-3 m-5 bg-gray-900 text-white cursor-pointer"
                             x-show="timer == 0 && is_preroll"
                             @click="loadSrc(true)"
                        >
                            Werbung überspringen
                        </div>
                    </div>
					<?php

					$lock = true;

					$termin = new \Carbon\Carbon( get_field( 'field_5ed527e9c2279' ) );

					if ( $termin->addHour()->isPast() ) {
						$lock = false;
					} else {
						if ( is_user_logged_in() ) {
							$subscriber = get_field( 'field_601451bb66bc3' );
							$user       = wp_get_current_user();
							foreach ( $subscriber as $sub ) {
								if ( $sub['user_email'] == $user->user_email ) {
									$lock = false;
								}
							}
						}
					}
					?>

					<?php if ( $lock ): ?>
                        <div class="absolute top-0 left-0 w-full min-h-full h-auto bg-white bg-opacity-90 flex justify-center items-center px-5 lg:px-5 z-50">
                            <div class="max-w-2xl">
								<?php get_template_part( 'immolive', 'subscribeform', [ 'id' => get_the_ID() ] ) ?>
                            </div>
                        </div>
					<?php endif; ?>

                </div>
            </div>
            <div class="col-span-4 lg:col-span-1 overflow-scroll scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100 text-white"
                 :style="`max-height: ${maxHeight};`">

                <div x-show.transition="chapters.length > 0">
                    <div class="flex pb-3 mb-3 border-b border-primary-100">
                        <div class="border border-primary-100 flex-1 text-center  cursor-pointer py-3"
                             :class="tab == 'chapters' ? 'bg-primary-100 text-white' : 'text-primary-100'"
                             @click="tab = 'chapters'">Kapitel
                        </div>
                        <div class="border border-primary-100 flex-1 text-center cursor-pointer py-3"
                             :class="tab == 'comments' ? 'bg-primary-100 text-white' : 'text-primary-100'"
                             @click="tab = 'comments'">Kommentare
                        </div>
                    </div>
                </div>
                <div x-show.transition="chapters.length == 0 || tab == 'comments'">
					<?php
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>
                </div>
                <div x-show="chapters.length > 0 && tab == 'chapters'" x-key="chapter.index">
                    <ol class="ml-2">
                        <template x-for="chapter in chapters">
                            <li class="cursor-pointer mb-2" @click="jump(chapter.startTime - 1)">
                                <span x-text="chapter.title" :class="chapter.index == current_chapter ? 'font-semibold underline' :''" class="line-clamp-1"></span>
                            </li>
                        </template>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="hidden lg:block"></div>
</div>