<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Freeshifter
 */

namespace immobilien_redaktion_2020;
global $FormSession;

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="icon" type="image/png" href="<?= get_stylesheet_directory_uri() . '/assets/images/favicon.png'; ?>">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php wp_head(); ?>
    <script>
        window.ajaxurl = '<?php echo admin_url('admin-ajax.php') ?>';
    </script>


    <?php if (is_single()): ?>
        <?php if (get_post_format() == 'video'): ?>
            <script src="https://player.vimeo.com/api/player.js"></script>
        <?php endif; ?>
    <?php endif; ?>


    <?php if (is_singular()): ?>
        <meta property="og:url" content="<?php the_permalink(); ?>"/>
        <meta property="og:type" content="article"/>
        <meta property="og:title" content="<?php the_title() ?>"/>
        <meta property="og:description" content="<?php echo get_the_excerpt(); ?>"/>
        <?php if (get_post_format() == 'video'): ?>
            <?php if (get_field('field_5f96fa1673bac')): ?>
                <meta property="og:image" content="<?php echo 'https://img.youtube.com/vi/' . get_field('field_5f96fa1673bac') . '/hqdefault.jpg' ?>"/>
            <?php endif; ?>
        <?php else: ?>
            <meta property="og:image" content="<?php the_post_thumbnail_url('article'); ?>"/>
        <?php endif; ?>
        <meta property="fb:app_id" content="831950683917414">
        <meta property="og:image:width" content="600"/>
        <meta property="og:image:height" content="450"/>
    <?php endif; ?>
</head>

<?php
if (is_page_template('pagetemplate-sehen.php') || (is_single() && has_category('video'))) {
    $bg = 'bg-gray-900 min-h-screen';
} else {
    $bg = 'bg-primary-100 bg-opacity-5';
}
if (is_page_template('pagetemplate-passwort-vergessen.php')
    || is_page_template('pagetemplate-login-register.php')
    || is_page_template('pagetemplate-passwort-reset.php')
    || is_404()
) {
    $bg .= ' min-h-screen flex flex-col justify-between';
}
/**/

?>

<body <?php body_class($bg); ?> itemscope itemtype="https://schema.org/WebPage">

<header class="header bg-primary-100 w-full h-10">
    <div class="container mx-auto flex justify-between ">
        <div class="pt-2 hidden lg:block relative" x-data="{ lesen: false }">
            <ul class="flex">
                <li class="uppercase text-white mr-3">
                    <a href="/lesen" class="cursor-pointer" @mouseenter="lesen = !lesen">LESEN</a></li>
                <li class="uppercase text-white mr-3"><a href="/sehen">SEHEN</a></li>

                <?php
                $date = date('Y-m-d H:i:s');
                $query = new \WP_Query([
                    'post_type'      => 'immolive',
                    'post_status'    => 'publish',
                    'posts_per_page' => 3,
                    'meta_query'     => [
                        'relation' => 'AND',
                        [
                            'key'     => 'termin',
                            'value'   => $date,
                            'compare' => '>=',
                            'type'    => 'DATETIME',
                        ],
                    ],
                    'order'          => 'DESC',
                    'meta_key'       => 'termin',
                    'meta_type'      => 'DATETIME',
                    'orderby'        => 'meta_value_date',
                ]);

                if ($query->post_count >= 1):
                    ?>
                    <li class="uppercase text-white mr-3"><a href="/diskutieren">LIVE</a></li>
                <?php endif; ?>
            </ul>
            <div class="absolute mt-2 p-5 z-50 shadow-lg bg-white" x-show="lesen" @mouseleave="lesen = false">
                <?php $cats = get_categories(['exclude' => [1, 17], 'parent' => 0]) ?>
                <ul>
                    <?php foreach ($cats as $cat): ?>
                        <li class="flex justify-between">
                            <?php $color = get_field('field_5c63ff4b7a5fb', $cat) ?>
                            <a href="<?php echo get_category_link($cat) ?>" class="text-lg font-bold flex items-center space-x-3 hover:underline"
                               style="background: linear-gradient(0deg, <?php echo $color ?> 0%, <?php echo $color ?> 50%, transparent 50%, transparent 100%);">
                                <!--                                <div class="w-4 h-4 rounded-full mr-2" style="background: --><?php //echo $color ?><!--"></div>-->
                                <?php echo $cat->name ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <a href="<?php echo home_url() ?>" class="z-50">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo.svg" class="h-24 w-auto pt-0 mt-0">
        </a>
        <div class="pt-2 block lg:hidden">
            <ul class="flex">
                <li class="uppercase text-white mr-3"><a href="#" class="underline">Menü</a></li>
            </ul>
        </div>

        <div class="pt-2 hidden lg:block">
            <ul class="flex">
                <li class="uppercase text-white mr-3">
                    <a href="https://www.facebook.com/ImmoRedaktion">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 100 100" fill="currentColor" class="text-white h-6 w-6">
                            <path d="M54.86,34.37c0.05,0.8,0.9,1.09,1.48,0.85c2.21,0.65,4.73,0.73,7.03,0.7c1.65,0,3.47-0.05,5.14-0.24
			c-0.58,1.48-0.58,3.15-0.73,4.73c-0.17,2.23-0.17,4.44-0.07,6.66c-0.05,0-0.07,0-0.12,0c-4.05,1.26-8.14-0.34-12.21,0.24
			c-0.51,0.1-0.63,0.68-0.41,1.07c-2.74,5.33-1.48,13.94-1.31,19.53c0.22,7.97,0.82,16.67,0.1,24.6c-2.52-0.29-5.14,0.12-7.66-0.1
			c-2.21-0.17-4.22-0.32-6.28,0.41c-0.12-7.71,0.07-15.46,0.27-23.19c0.17-7.22,1.07-14.78-0.1-21.93
			c-0.07-0.44-0.68-0.53-1.02-0.32c-0.15-0.24-0.39-0.41-0.8-0.44c-1.62-0.05-3.25,0.12-4.87,0.17c-0.8,0.05-1.82-0.17-2.69-0.07
			c-0.36-1.58,0.05-3.39,0.12-4.99c0.07-1.79,0.17-3.85-0.07-5.72c1.5,0.27,3.03,0.29,4.56,0.17c1.19-0.1,2.54-0.15,3.71-0.61
			c0.34-0.02,0.65-0.17,0.85-0.44c0.02-0.02,0.05-0.02,0.07-0.05c0.39-0.29,0.32-0.68,0.07-0.97c-0.56-7.32-0.29-18.2,5.57-22.98
			c6.01-4.92,16.96-3.51,24.4-2.59c-1.79,3.01-1.24,7.03-2.06,10.32c-3.47-1.55-8.97-1.02-11.37,1.55
			C53.09,24.31,54.64,30.08,54.86,34.37z"/>
                            <path d="M64.07,34.1c1.79-0.1,4.05-0.58,5.5,0.68c0.12,0.12,0.15,0.27,0.12,0.44c1.65,3.42,0.05,8.77-0.22,12.34
			c-0.02,0.46-0.36,0.73-0.73,0.78c-0.1,0.27-0.29,0.51-0.63,0.61c-3.8,1.19-8.29,0.58-12.21-0.15c0.53,7.32-0.36,15.05-0.27,22.39
			c0.07,7.1,1.16,14.88-0.07,21.91c-0.02,0.19-0.15,0.32-0.27,0.41c-0.07,0.22-0.19,0.39-0.44,0.46c-2.74,0.65-5.99,0.63-8.77,0.34
			c-2.11-0.22-4.75,0.17-6.71-0.68c-0.44,0.15-1.04-0.05-1.04-0.63c-0.24-7.83-0.63-15.51-0.44-23.36
			c0.15-6.91-0.29-14.13,0.73-21.01c-0.12,0.07-0.27,0.15-0.46,0.15c-1.87,0.19-3.76,0.36-5.65,0.19c-0.78-0.07-1.89-0.15-2.52-0.7
			c-0.41,0.15-0.9,0.05-1.16-0.39c-0.92-1.5-0.36-3.73-0.29-5.4c0.12-2.16-0.36-4.9,0.7-6.88c-0.1-0.51,0.19-1.11,0.85-1.04
			c1.5,0.15,3.03,0.15,4.53,0.05c0.9-0.07,1.84-0.32,2.76-0.46c-0.78-3.78,0.22-8.75,0.7-12.38c0.63-4.6,2.01-9.04,5.74-12.04
			c3.39-2.74,7.61-3.78,11.88-3.9c4.85-0.12,10.88-1.11,15.2,1.43c0.12,0.07,0.22,0.19,0.29,0.29c0.29,0.05,0.56,0.32,0.48,0.63
			c-0.39,2.28-0.82,4.56-0.99,6.86c-0.12,1.65-0.05,3.39-0.65,4.97c-0.12,0.34-0.36,0.56-0.63,0.65c-0.07,0.15-0.19,0.27-0.36,0.32
			c-3.78,1.02-8.94-2.3-11.56,2.21c-1.89,3.22-0.68,7.73-0.58,11.2C59.25,33.83,61.65,34.2,64.07,34.1z M67.83,19.19
			c0.82-3.3,0.27-7.32,2.06-10.32c-7.44-0.92-18.39-2.33-24.4,2.59c-5.86,4.77-6.13,15.66-5.57,22.98c0.24,0.29,0.32,0.68-0.07,0.97
			c-0.02,0.02-0.05,0.02-0.07,0.05c-0.19,0.27-0.51,0.41-0.85,0.44c-1.16,0.46-2.52,0.51-3.71,0.61c-1.53,0.12-3.05,0.1-4.56-0.17
			c0.24,1.87,0.15,3.93,0.07,5.72c-0.07,1.6-0.48,3.42-0.12,4.99c0.87-0.1,1.89,0.12,2.69,0.07c1.62-0.05,3.25-0.22,4.87-0.17
			c0.41,0.02,0.65,0.19,0.8,0.44c0.34-0.22,0.95-0.12,1.02,0.32c1.16,7.15,0.27,14.71,0.1,21.93c-0.19,7.73-0.39,15.49-0.27,23.19
			c2.06-0.73,4.07-0.58,6.28-0.41c2.52,0.22,5.14-0.19,7.66,0.1c0.73-7.92,0.12-16.63-0.1-24.6c-0.17-5.6-1.43-14.2,1.31-19.53
			c-0.22-0.39-0.1-0.97,0.41-1.07c4.07-0.58,8.17,1.02,12.21-0.24c0.05,0,0.07,0,0.12,0c-0.1-2.23-0.1-4.44,0.07-6.66
			c0.15-1.58,0.15-3.25,0.73-4.73c-1.67,0.19-3.49,0.24-5.14,0.24c-2.3,0.02-4.82-0.05-7.03-0.7c-0.58,0.24-1.43-0.05-1.48-0.85
			c-0.22-4.29-1.77-10.06,1.6-13.62C58.86,18.18,64.36,17.64,67.83,19.19z"/>
                        </svg>
                    </a>
                </li>
                <li class="uppercase text-white mr-3">
                    <a href="https://twitter.com/ImmoRedaktion">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve" fill="currentColor" class="text-white w-6 h-6">
            <path d="M74.43,20.67c-0.24,1.44-2.06,2.24-3.31,2.06c-1.15-0.16-2.19-0.91-2.51-2.06c-0.37-1.26,0.24-2.62,1.36-3.23
				c1.26-0.69,2.62-0.37,3.66,0.43c0.86,0.67,1.04,1.84,0.72,2.81c0.05-0.03,0.05-0.05,0.08-0.08
				C74.43,20.62,74.43,20.64,74.43,20.67z"/>
                            <path d="M73.63,17.86c-1.04-0.8-2.41-1.12-3.66-0.43c-1.12,0.61-1.74,1.98-1.36,3.23c0.32,1.15,1.36,1.9,2.51,2.06
				c1.26,0.19,3.07-0.61,3.31-2.06c0-0.03,0-0.05,0-0.08c-0.03,0.03-0.03,0.05-0.08,0.08C74.67,19.71,74.48,18.53,73.63,17.86z
				 M12.16,13.16c3.58,6.44,8.98,11.06,15.34,14.7c6.25,3.55,13.28,8.18,20.69,8.66c0.72,0.56,1.98,0.21,1.87-0.72
				c0.03-0.13,0-0.27-0.08-0.37c-2.73-7.46,2.65-16.68,8.82-20.31c5.08-2.99,10.85-3.53,16.2-0.94c2.54,1.23,4.25,3.47,6.98,4.01
				c0.03,0,0.03-0.03,0.03-0.03c1.1,0.29,2.41-0.19,3.45-0.51c2.59-0.83,5.13-1.84,7.43-3.26c0.11-0.08,0.24-0.16,0.37-0.21
				c-0.45,0.64-0.83,1.36-1.2,1.92c-1.71,2.67-3.34,4.73-5.77,6.79c-0.72,0.61,0.11,1.36,0.8,1.26c1.36,0.78,3.18,0.4,4.68,0.19
				c1.34-0.19,2.59-0.61,3.77-1.18c-1.26,1.04-2.38,2.19-3.53,3.42c-0.96,1.02-1.9,2.08-2.97,2.97c-0.35,0.29-0.72,0.56-1.1,0.8
				c-0.53-0.13-1.18,0.05-1.26,0.67c-0.03,0.16-0.05,0.32-0.08,0.45c-0.11,0.13-0.21,0.21-0.29,0.35c-0.19,0.27-0.08,0.53,0.11,0.69
				c-2.46,15.07-6.57,30.89-18.89,41c-6.63,5.43-13.63,8.9-21.83,11.36c-2,0.59-4.2,1.2-6.49,1.74c-1.18,0-2.41,0.27-3.5,0.45
				c-1.04,0.16-2.08,0.27-3.1,0.32c-3.53-0.67-7.22-1.02-10.85-1.12v-0.03c-0.72-0.08-1.42-0.16-2.11-0.27
				c-5.24-0.83-9.51-2.03-14.11-3.93c3.74,0.51,8.26-0.61,11.33-1.55c3.1-0.94,6.09-2.41,9.03-3.71c1.58-0.69,2.49-1.02,3.26-2.33
				c0.61,0.11,1.26,0.08,2-0.24c0.53-0.21,0.51-1.07,0-1.34c-3.39-1.63-6.87-3.31-10.02-5.37c-2.97-1.95-4.78-4.44-6.73-7.14
				c0.75,0.16,1.52,0.19,2.11,0.19c1.07-0.03,4.81-0.13,5.08-1.47c0.03-0.08,0-0.16-0.05-0.21h-0.03c0.27-0.32,0.16-0.94-0.21-1.18
				c-3.47-2.19-7-4.46-9.92-7.4c-1.9-1.95-3.1-3.82-4.01-6.39c-0.29-0.83-0.53-1.63-0.8-2.41c0.56,0.35,1.15,0.61,1.58,0.8
				c1.63,0.72,4.3,1.66,6.04,0.88c0.32-0.13,0.4-0.59,0.21-0.88c0.45-0.32,0.67-1.02,0.19-1.5c-2.59-2.73-4.57-3.63-6.07-7.64
				c-1.15-3.05-1.28-6.52-0.96-9.73c0.4-3.9,1.76-5.85,3.77-9.06C11.89,13.43,12.03,13.72,12.16,13.16z"/>
                            <path d="M27.5,27.86c-6.36-3.63-11.76-8.26-15.34-14.7c-0.13,0.56-0.27,0.27-0.86,1.2c-2,3.21-3.37,5.16-3.77,9.06
				c-0.32,3.21-0.19,6.68,0.96,9.73c1.5,4.01,3.47,4.92,6.07,7.64c0.48,0.48,0.27,1.18-0.19,1.5c0.19,0.29,0.11,0.75-0.21,0.88
				c-1.74,0.78-4.41-0.16-6.04-0.88c-0.43-0.19-1.02-0.45-1.58-0.8c0.27,0.78,0.51,1.58,0.8,2.41c0.91,2.57,2.11,4.44,4.01,6.39
				c2.91,2.94,6.44,5.21,9.92,7.4c0.37,0.24,0.48,0.86,0.21,1.18h0.03c0.05,0.05,0.08,0.13,0.05,0.21
				c-0.27,1.34-4.01,1.44-5.08,1.47c-0.59,0-1.36-0.03-2.11-0.19c1.95,2.7,3.77,5.18,6.73,7.14c3.15,2.06,6.63,3.74,10.02,5.37
				c0.51,0.27,0.53,1.12,0,1.34c-0.75,0.32-1.39,0.35-2,0.24c-0.78,1.31-1.68,1.63-3.26,2.33c-2.94,1.31-5.93,2.78-9.03,3.71
				c-3.07,0.94-7.59,2.06-11.33,1.55c4.6,1.9,8.87,3.1,14.11,3.93c0.69,0.11,1.39,0.19,2.11,0.27v0.03
				c3.63,0.11,7.32,0.45,10.85,1.12c1.02-0.05,2.06-0.16,3.1-0.32c1.1-0.19,2.33-0.45,3.5-0.45c2.3-0.53,4.49-1.15,6.49-1.74
				c8.2-2.46,15.21-5.93,21.83-11.36c12.32-10.1,16.44-25.92,18.89-41c-0.19-0.16-0.29-0.43-0.11-0.69
				c0.08-0.13,0.19-0.21,0.29-0.35c0.03-0.13,0.05-0.29,0.08-0.45c0.08-0.61,0.72-0.8,1.26-0.67c0.37-0.24,0.75-0.51,1.1-0.8
				c1.07-0.88,2-1.95,2.97-2.97c1.15-1.23,2.27-2.38,3.53-3.42c-1.18,0.56-2.43,0.99-3.77,1.18c-1.5,0.21-3.31,0.59-4.68-0.19
				c-0.69,0.11-1.52-0.64-0.8-1.26c2.43-2.06,4.06-4.12,5.77-6.79c0.37-0.56,0.75-1.28,1.2-1.92c-0.13,0.05-0.27,0.13-0.37,0.21
				c-2.3,1.42-4.84,2.43-7.43,3.26c-1.04,0.32-2.35,0.8-3.45,0.51c0,0,0,0.03-0.03,0.03c-2.73-0.53-4.44-2.78-6.98-4.01
				c-5.35-2.59-11.12-2.06-16.2,0.94c-6.17,3.63-11.55,12.85-8.82,20.31c0.08,0.11,0.11,0.24,0.08,0.37
				c0.11,0.94-1.15,1.28-1.87,0.72C40.78,36.04,33.75,31.41,27.5,27.86z M97.33,22.06c-1.79,2.11-3.13,4.62-4.84,6.76
				c-0.88,1.1-2.3,2.75-3.82,3.5c-0.75,17.96-8.37,35.33-23.09,46.07c-7.86,5.72-16.89,8.93-26.38,10.82
				c-0.21,0.05-0.45,0.11-0.69,0.13c-0.21,0-0.43,0.03-0.64,0.03c-1.18,0.19-2.51,0.08-3.47,0.21c-0.78,0.13-1.71,0.27-2.51,0.08
				c-0.27,0.05-0.56,0.08-0.83,0.11c-0.03,0-0.05,0-0.08-0.03c-1.66,0-3.39-0.27-4.76-0.37c-2.46-0.19-5.45,0-7.75-1.12
				C12.43,87.08,6.71,85,2.35,81.02c0,0,0,0,0-0.03c-0.19-0.11-0.4-0.19-0.59-0.32c-0.11-0.08-0.08-0.21,0.05-0.21
				c4.92-0.35,9.73-0.21,14.54-1.68c3.85-1.18,7.7-2.97,11.3-4.84c-0.35-0.16-0.69-0.37-1.07-0.59c-2.3-1.34-4.65-2.67-6.79-4.25
				c-2.62-1.95-7.03-5.77-7.24-9.49c-0.4-0.29-0.72-0.67-0.8-1.2c-0.05-0.24,0.19-0.37,0.37-0.29c1.92,0.83,3.39,1.2,5.51,1.04
				c0.35-0.05,0.91-0.19,1.5-0.32c-0.83-0.29-1.58-0.83-2.43-1.5c-2.16-1.63-4.36-3.31-6.31-5.24c-3.13-3.07-6.07-7.83-5.72-12.43
				c-0.13-0.35-0.21-0.72-0.13-1.12c0.03-0.13,0.21-0.24,0.35-0.19c0.61,0.21,0.96,0.67,1.47,1.07c0.83,0.67,1.84,1.18,2.86,1.55
				c1.04,0.4,2.19,0.51,3.29,0.69C3.82,34.89,1.58,18.8,11.62,12.23c0.29-0.19,0.61,0.08,0.61,0.37c0.16-0.13,0.4-0.16,0.59,0.03
				c2.33,2.22,3.96,5,6.41,7.14c3.13,2.7,6.65,5,10.34,6.84c3.93,1.98,8.07,4.52,12.21,5.96c1.79,0.64,3.61,1.04,5.37,1.58
				c-1.98-7.91,4.06-17.24,10.4-21.01c4.49-2.65,9.78-3.74,14.86-2.27c3.18,0.91,7.91,2.97,9.33,6.25c1.82-0.53,3.63-0.96,5.48-1.63
				c2.67-0.96,5.16-2.33,7.83-3.29c0.21-0.08,0.37,0.19,0.29,0.35c-1.6,3.13-3.31,7.99-6.33,10.45c1.07-0.16,2.14-0.35,3.21-0.61
				c1.95-0.48,3.77-1.36,5.8-1.36c0.21,0,0.37,0.27,0.19,0.43C97.95,21.69,97.63,21.87,97.33,22.06z"/>
</svg>
                    </a>
                </li>
                <li class="uppercase text-white mr-3">
                    <a href="https://www.linkedin.com/company/die-unabhaengige-immobilien-redaktion/">
                        <svg version="1.1" id="Ebene_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             viewBox="0 0 100 100" style="enable-background:new 0 0 100 100;" xml:space="preserve" fill="currentColor" class="text-white h-6 w-6">
            <path d="M96.08,94.23C96.03,94.15,96,94.07,96,93.97c-0.05-0.4-0.13-0.8-0.19-1.22c-2.66-0.19-5.45-0.05-8-0.11
				c-3.22-0.03-6.57,0.27-9.76,0.93c0-0.08,0.03-0.13,0-0.19c-1.68-8.24,5.32-44.65-12.9-41.88c-16.81,2.58-8.03,30.85-10.21,41.8
				c-6.41-0.27-12.42-0.96-18.8-0.27c0.61-2.98,0.43-6.41,0.43-9.39c0.03-6.09,0.27-12.15,0.51-18.24
				c0.37-9.92,0.64-20.58-0.61-30.5c2.9,0.61,6.09,0.32,8.96,0.24c2.9-0.08,6.14,0.16,9.09-0.32c-0.03,1.44,0.08,2.85,0.21,4.28
				c0.13,1.33,0,2.71,0.61,3.94c0.16,0.29,0.72,0.32,0.88,0c0.13-0.32,0.21-0.61,0.27-0.9c12.92-11.01,34.46-10.08,38.69,9.33
				c0.93,4.31,1.09,9.01,1.12,13.69c-0.9,2.21-0.51,5.82-0.45,7.53c0.16,7.1,0.29,14.17,0.21,21.27c0,0.11,0.03,0.19,0.05,0.27
				H96.08z"/>
                            <path d="M54.95,93.3c2.18-10.96-6.59-39.22,10.21-41.8c18.21-2.77,11.22,33.64,12.9,41.88c0.03,0.05,0,0.11,0,0.19
				c3.19-0.66,6.54-0.96,9.76-0.93c2.55,0.05,5.34-0.08,8,0.11c0.05,0.43,0.13,0.82,0.19,1.22c0,0.11,0.03,0.19,0.08,0.27
				c0.03,0.19,0.11,0.35,0.16,0.51c-2.5,0.35-5.13,0-7.66-0.11c-3.96-0.16-8.06,0.82-11.99,0.11c-0.24-0.03-0.35-0.21-0.35-0.43
				c-0.08-0.11-0.16-0.24-0.21-0.4c-1.52-6.46,0.08-14.17-0.21-20.85c-0.11-2.71-0.16-5.45-0.43-8.14
				c-0.69-6.91-4.55-14.17-12.9-11.06c-8.27,3.06-6.06,17.76-6.04,24.41c0,2.55,0.16,5.16,0.11,7.74c0.11,0.03,0.19,0.08,0.21,0.24
				c0.48,2.87-0.24,6.06-0.56,8.96c-0.03,0.16-0.32,0.24-0.35,0.03c-0.05-0.24-0.08-0.51-0.11-0.74c-0.05,0.03-0.08,0.08-0.13,0.11
				c-2.93,0.88-5.98-0.21-8.93-0.43c-3.8-0.27-7.61,0.37-11.41-0.03c-0.43,0.08-0.88-0.05-1.01-0.59
				c-0.96-3.62,0.19-8.32,0.16-12.02c-0.03-6.62,0.4-13.24,0.56-19.84c0.13-6.22-0.03-12.44-0.35-18.64
				c-0.16-2.82-0.72-5.96,0.69-8.4c-0.11-0.03-0.21-0.05-0.32-0.08c-0.4-0.13-0.48-0.8,0-0.88c3.35-0.69,6.99-0.21,10.4-0.21
				c3.46-0.03,7.45-0.66,10.77,0.32c0.35,0.11,0.35,0.56,0,0.66c-0.13,0.03-0.27,0.05-0.43,0.08c0.16,1.52,0.35,3.03,0.56,4.55
				c0.08,0.77,0.21,1.52,0.21,2.26c9.87-9.84,25.55-11.33,35.02-0.24c5.32,6.25,5.85,12.6,6.17,20.48c0.08,1.97,0.19,3.94,0.27,5.9
				c-0.16,0.03-0.32,0.11-0.48,0.16c-0.64,8.7-0.35,17.52-0.24,26.3c0,0.66-0.93,0.74-1.17,0.27c-0.03-0.08-0.05-0.16-0.05-0.27
				c0.08-7.1-0.05-14.17-0.21-21.27c-0.05-1.7-0.45-5.32,0.45-7.53c-0.03-4.68-0.19-9.39-1.12-13.69
				c-4.23-19.41-25.77-20.34-38.69-9.33c-0.05,0.29-0.13,0.59-0.27,0.9c-0.16,0.32-0.72,0.29-0.88,0c-0.61-1.22-0.48-2.61-0.61-3.94
				c-0.13-1.44-0.24-2.85-0.21-4.28c-2.95,0.48-6.2,0.24-9.09,0.32c-2.87,0.08-6.06,0.37-8.96-0.24c1.25,9.92,0.98,20.58,0.61,30.5
				c-0.24,6.09-0.48,12.15-0.51,18.24c0,2.98,0.19,6.41-0.43,9.39C42.53,92.35,48.54,93.04,54.95,93.3z"/>
                            <path d="M8.36,8.4c3.67-1.52,7.47-2.74,11.35-0.9c5.24,2.5,6.17,10.8,2.71,15.13c-3.59,4.47-10.45,4.07-14.76,0.9
				C2.46,19.7,2.83,11.72,8.36,8.4z"/>
                            <path d="M12.51,34.96c3.72,0,7.55,0.66,11.14-0.64c-0.51,3.48-0.48,7.02-0.56,10.53c-0.05,3.14-0.27,6.36,0.11,9.49
				c-0.64,5.5-0.74,11.12-1.06,16.62c-0.4,7.5-1.09,15.13-0.66,22.66c-3.67,0-7.23-0.16-10.96-0.53c-1.36-0.13-3.86-0.59-5.27,0.21
				c-0.08-2.55,0.08-5.19-0.21-7.74c0.03-0.03,0.08-0.05,0.13-0.08c0.08-2.13,0.32-4.25,0.48-6.46c0.43-5.4,0.16-10.8,0.4-16.19
				c0.37-9.28,1.01-18.43-0.24-27.68C7.85,35.63,10.62,34.96,12.51,34.96z"/>
                            <path d="M3.68,94.21c-0.21-2.69-0.27-5.45,0.11-8.14c-0.11,0.05-0.24,0.11-0.35,0.16c-0.27-6.54,0.64-13.38,0.64-19.65
				c0-5.27,0.53-10.48,0.53-15.74C4.64,45.52,3.97,40.12,4.5,34.8c0.03-0.11,0.08-0.19,0.16-0.27c-0.03-0.05-0.08-0.05-0.08-0.11
				c0-0.03,0-0.05,0-0.05c0-0.13,0.08-0.21,0.19-0.29c1.57-0.93,4.97-0.45,6.75-0.53c4.12-0.13,8.08,0.05,12.23-0.4
				c0.32-0.05,0.53,0.24,0.56,0.53c0.03,0,0.03,0.03,0.05,0.05c0.56,3.67,0.37,7.39,0.27,11.12c-0.05,2.79,0.03,5.69-0.24,8.48
				c0.53,5.82,0,11.83-0.32,17.63c-0.43,7.55-0.56,15.13-1.12,22.68c0.27,0,0.51,0.03,0.74,0c0.88,0,0.88,1.33,0,1.3
				c-0.48,0-0.98,0-1.46,0c-0.03,0-0.05,0-0.05,0c-3.38,0.03-6.73,0.13-10.1-0.05c-1.94-0.11-5.08,0.56-7.02-0.16
				C4.64,95.11,3.73,94.93,3.68,94.21z M21.47,93.62c-0.43-7.53,0.27-15.16,0.66-22.66c0.32-5.5,0.43-11.12,1.06-16.62
				c-0.37-3.14-0.16-6.36-0.11-9.49c0.08-3.51,0.05-7.05,0.56-10.53c-3.59,1.3-7.42,0.64-11.14,0.64c-1.89,0-4.65,0.66-6.7,0.19
				c1.25,9.25,0.61,18.4,0.24,27.68c-0.24,5.4,0.03,10.8-0.4,16.19c-0.16,2.21-0.4,4.33-0.48,6.46c-0.05,0.03-0.11,0.05-0.13,0.08
				c0.29,2.55,0.13,5.19,0.21,7.74c1.41-0.8,3.91-0.35,5.27-0.21C14.24,93.46,17.8,93.62,21.47,93.62z"/>
                            <path d="M3.79,9.51c5.03-4.97,14.78-7.39,19.89-1.14c3.7,4.52,2.71,12.9-2.07,16.3C16.5,28.34,7.88,27.76,3.97,22.6
				c-2.85-3.75-2.45-8.91,0.16-12.47C3.79,10.23,3.52,9.78,3.79,9.51z M8.36,8.4c-5.53,3.32-5.9,11.3-0.69,15.13
				c4.31,3.16,11.17,3.56,14.76-0.9c3.46-4.33,2.53-12.63-2.71-15.13C15.83,5.66,12.03,6.88,8.36,8.4z"/>
</svg>
                    </a>
                </li>
                <li class="relative inline-flex rounded-md shadow-sm">

                    <?php
                    global $wp;
                    if (!is_user_logged_in()):
                        ?>
                        <a href="<?php echo add_query_arg(['redirect' => $wp->request], home_url('/login')); ?>">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>

                            <span class="flex absolute h-2 w-2 top-0 right-0 -mt-1 -mr-1">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-warning  opacity-50"></span>
                    </span>
                        </a>
                    <?php else: ?>
                        <div class="relative" x-data="{show: false}"
                             @mouseover="show = true"
                        >
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>

                            <span class="flex absolute h-2 w-2 top-0 right-0 -mt-1 -mr-1">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-success  opacity-50"></span>
                    </span>
                            <div class="absolute top-0 left-0 bg-white mt-8 -ml-20 p-5 z-50" x-show="show" @mouseleave="show = false">
                                <ul>
                                    <li class="text-lg font-semibold">
                                        <a href="<?php echo home_url('profil') ?>">Profil</a>
                                    </li>
                                    <li class="text-lg font-semibold">
                                        <a href="<?php echo wp_logout_url(home_url()) ?>">Logout</a>
                                    </li>
                                    <?php if (current_user_can('edit_posts')): ?>
                                        <li class="text-lg font-semibold">
                                            <a href="<?php echo admin_url() ?>">backend</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</header>
<main class="<?php if (is_page_template('pagetemplate-passwort-vergessen.php')
    || is_page_template('pagetemplate-login-register.php')
    || is_page_template('pagetemplate-passwort-reset.php')
    || is_404()
): ?>
    h-full flex items-center justify-center
<?php endif; ?>">
