<?php
get_header();
the_post();

?>

<a href="#comments">kommentieren</a>


<?php

if (!get_post_format()) {
    get_template_part('page-templates/content', 'article');
} elseif (get_post_format() == 'video') {
    get_template_part('page-templates/content', 'video');
}

get_footer();
