<?php
/*
 * Template Name: Livestream
 */


get_header();
the_post();


?>

    <div class="container mx-auto">
        <div style="padding:56.25% 0 0 0;position:relative;">
            <iframe src="https://vimeo.com/event/855901/embed" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe>
        </div>
    </div>
    <div class="container mx-auto mt-20 h-64">
        <iframe src="https://vimeo.com/event/855901/chat/" width="100%" height="100%" frameborder="0"></iframe>
    </div>

    <div class="container mx-auto">
        <?php

        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

        ?>
    </div>

<?php
get_footer();


