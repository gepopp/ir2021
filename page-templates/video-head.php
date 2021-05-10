<?php
$lib      = new \Vimeo\Vimeo( 'f1663d720a1da170d55271713cc579a3e15d5d2f',
	'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9' );
$response = $lib->request( '/videos/' . get_field( 'field_5fe2884da38a5' ), [], 'GET' );
$body     = $response['body'];

$time     = explode( ':', get_field( 'field_5a3ce915590ae' ) );
$duration = 'PT';
if ( count( $time ) == 3 ) {
	$duration .= array_shift( $time );
	$duration .= 'H';

}
$duration .= array_shift( $time );
$duration .= 'M';
$duration .= array_shift( $time );
$duration .= 'S';
?>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "VideoObject",
        "name": "<?php the_title() ?>",
        "description": "<?php echo get_the_excerpt() ?>",
        "thumbnailUrl": [
            "<?php echo $body['pictures']['sizes'][2]['link'] ?>",
            "<?php echo $body['pictures']['sizes'][0]['link'] ?>",
            "<?php echo $body['pictures']['sizes'][1]['link'] ?>"
        ],
        "uploadDate": "<?php the_time( 'c' ) ?>",
        "duration": "<?php echo $duration ?>",
        "contentUrl": "<?php the_permalink(); ?>",
        "interactionStatistic": {
            "@type": "InteractionCounter",
            "interactionType": { "@type": "http://schema.org/WatchAction" },
            "userInteractionCount": <?php echo get_field( 'field_5f9ff32f68d04' ) ?>
        },
        "regionsAllowed": "DE"
    }



</script>


<?php get_template_part( 'banner-templates/banner', 'mega' ) ?>

<div class="container mx-auto mt-20 relative px-5 lg:px-0">
    <div class="grid grid-cols-4 gap-5" x-data="{ maxHeight: '' }" x-init="
             maxHeight = document.getElementById('videoContainer').offsetHeight + 'px';
             new ResizeObserver(() => {
                maxHeight = document.getElementById('videoContainer').offsetHeight + 'px';
             }).observe(document.getElementById('videoContainer'));">
        <div class="relative col-span-4 lg:col-span-3" x-ref="videoContainer">
			<?php if ( get_field( 'field_5f96fa1673bac' ) ): ?>
                <div class="video-container" style="position: relative;width: 100%;padding-bottom: 56.25%;">
                    <iframe src="https://www.youtube.com/embed/<?php echo get_field( 'field_5f96fa1673bac' ) ?>?autoplay=1&mute=1"
                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"></iframe>
                </div>
			<?php elseif ( get_field( 'field_5fe2884da38a5' ) ): ?>
                <div id="videoContainer">
					<?php get_template_part( 'page-templates/vimeo', 'player' ); ?>
                </div>
			<?php endif; ?>
        </div>
        <div class="col-span-4 lg:col-span-1 overflow-scroll scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100"
             :style="`max-height: ${maxHeight};`">
			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			?>
        </div>
    </div>
</div>
