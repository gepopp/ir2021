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

$datetime = date( "Y-m-d H:i:s" );
$time     = strtotime( $datetime ) - 60 * 60;
$date     = date( 'Y-m-d H:i:s', $time );

$time = strtotime( $datetime ) + 60 * 60 * 2;
$end  = date( 'Y-m-d H:i:s', $time );


$query = new WP_Query( [
	'post_type'      => 'immolive',
	'posts_per_page' => 1,
	'meta_query'     => [
		'relation' => 'AND',
		[
			'key'     => 'termin',
			'compare' => '>=',
			'value'   => $date,
			'type'    => 'DATETIME',
		],
		[
			'key'     => 'termin',
			'compare' => '<=',
			'value'   => $end,
			'type'    => 'DATETIME',
		],
	],
] );

if ( $query->have_posts() ):
	while ( $query->have_posts() ):
		$query->the_post();
		?>
        <script>
            var preroll = <?php echo json_encode( $preroll ) ?>;

            function isInViewport(el) {
                const rect = el.getBoundingClientRect();
                return (
                    rect.top >= 0 && rect.left >= 0
                );
            }
        </script>
        <div id="outer" class="bg-white">
            <div>
                <div class="fixed bottom-0 right-0 w-96 h-60 z-50 shadow-2xl m-10">
                    <div class="flex flex-col h-full w-full bg-white">
                        <div class="relative w-full h-full">
                            <iframe src="https://vimeo.com/event/<?php the_field( 'field_616166cc0f4ff' ); ?>/embed"
                                    frameborder="0"
                                    allow="autoplay; fullscreen; picture-in-picture"
                                    allowfullscreen
                                    style="position:absolute;top:0;left:0;width:100%;height:100%;"
                                    id="player"
                                    @load="setupPlayer()"
                            ></iframe>
                            <div class="absolute top-0 right-0 -mt-3 flex">
                                <span class="flex h-6 w-6">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary-100 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-6 w-6 bg-primary-100"></span>
                                </span>
                            </div>
                        </div>
                        <div class="p-3">
                            <h1 class="text-primary-100">
                                <a href="<?php the_permalink(); ?>" class="flex items-center space-x-3 underline">
									<?php the_title() ?>
                                    <svg class="w-4 h-4 text-primary-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                </a>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>

        </div>
	<?php
	endwhile;
endif;
