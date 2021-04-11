<?php
get_header();
the_post();

$cats = wp_get_post_categories(get_the_ID());

if(!empty(array_filter($cats, function ($cat){
    if(in_array($cat, get_field('field_60733fe611fac', 'option'))){
        return $cat;
    }
}))){
    get_template_part('page-templates/content', 'live');
}elseif (!get_post_format()) {
    get_template_part('page-templates/content', 'article');
} elseif (get_post_format() == 'video') {
    get_template_part('page-templates/content', 'video');
}

get_footer();
