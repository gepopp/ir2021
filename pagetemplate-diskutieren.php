<?php
/**
 * Template Name: Diskutieren
 */
get_header();
the_post();
?>


<div class="container mx-auto pt-20 relative">
<div class="grid grid-cols-5 gap-4">
    <div class="col-span-4">
        <?php get_template_part('page-templates/diskutieren', 'calendar') ?>
    </div>
</div>


</div>


    <div class="container mx-auto" style="margin-top: 500px;">
</div>



<?php
get_footer();






