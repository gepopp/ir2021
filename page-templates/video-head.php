<?php
$lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
$response = $lib->request('/videos/' . get_field('field_5fe2884da38a5'), [], 'GET');
$body = $response['body'];
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
        "uploadDate": "<?php the_time('c') ?>",
        "duration": "<?php echo get_field('field_5a3ce915590ae') ?>",
        "contentUrl": "<?php the_permalink(); ?>",
        "interactionStatistic": {
            "@type": "InteractionCounter",
            "interactionType": { "@type": "http://schema.org/WatchAction" },
            "userInteractionCount": <?php echo get_field('field_5f9ff32f68d04') ?>
        },
        "regionsAllowed": "DE"
    }
</script>



<?php get_template_part('banner-templates/banner', 'mega') ?>

<div class="container mx-auto mt-20 relative px-5 lg:px-0">

    <?php if (get_field('field_5f96fa1673bac')): ?>
        <div class="video-container" style="position: relative;width: 100%;padding-bottom: 56.25%;">
            <iframe src="https://www.youtube.com/embed/<?php echo get_field('field_5f96fa1673bac') ?>?autoplay=1&mute=1"
                    frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: 0;"></iframe>
        </div>

    <?php elseif (get_field('field_5fe2884da38a5')):
        $preroll = get_field('field_5fe62b82702a2', 'option') != '' ? get_field('field_5fe62b82702a2', 'option') : get_field('field_5fe62b98702a4', 'option');
        $preroll_link = get_field('field_5fe62ba8702a5', 'option') != '' ? get_field('field_5fe62ba8702a5', 'option') : get_field('field_5fe62ba8702a5', 'option');
        $skip = get_field('field_5fe62d517e847', 'option');
        ?>
        <div class="container mx-auto">
            <div x-data="prerolled('<?php echo get_field('field_5fe2884da38a5') ?>', '<?php echo $preroll ?>', '<?php echo $body['pictures']['sizes'][6]['link'] ?>', <?php echo $skip ?>)">
                <div x-show="!played" class="relative">
                    <img :src="image" @click="play()" class="cursor-pointer w-full h-auto">
                    <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center" @click="play()">
                        <div class="rounded-full bg-white w-32 h-32 m-5 flex items-center justify-center">
                            <div class="w-16 h-16 bg-white rounded-full" :class="{ 'animate-ping' : loading }">
                                <svg class="w-16 h-16 text-primary-100" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="preroll" class="w-full h-auto relative" x-show.transition.in.fade="prerolls">
                    <a href="<?php echo $preroll_link ?>" target="_blank" class="absolute w-full h-full" @click="playMain(false)"></a>
                    <div @click="playMain()" x-show="countdown <= 0" class="absolute bottom-0 right-0 px-3 py-2 mb-5 bg-gray-900 text-white cursor-pointer">Werbung überspringen</div>
                    <div x-show="countdown > 0" class="absolute bottom-0 right-0 px-3 py-2 mb-5 bg-gray-900 text-white">Werbung überspringen in
                        <span x-text="countdown"></span> Sekunden
                    </div>
                </div>
                <div id="clip" class="w-full h-auto relative" x-show.transition.in.fade="main"></div>
            </div>
        </div>
    <?php endif; ?>

</div>
