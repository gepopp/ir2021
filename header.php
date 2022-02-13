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
<html <?php use irclasses\TailwindNavWalker;

language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <meta name="keywords" content="immobilienredaktion, immobilienmagazin, Immobilien Redaktion, Immobilien Magazin, Wien, Immobilien, Immoflash, ImmoWelt, International, Investment, Markt, Mieten, Wohnen, Österreich">
    <meta name="description" content="<?php echo get_the_excerpt() ?>">
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

    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?php the_title() ?>"/>
    <meta property="og:description" content="<?php echo get_the_excerpt(); ?>"/>
    <meta property="og:image" content="<?php the_post_thumbnail_url('article'); ?>"/>
    <meta property="fb:app_id" content="831950683917414">
    <meta property="og:image:width" content="600"/>
    <meta property="og:image:height" content="450"/>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137371315-1"></script>
    <script src="https://player.vimeo.com/api/player.js"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'UA-137371315-1');
    </script>
</head>

<?php
if (is_page_template('pagetemplate-live.php') || is_page_template('pagetemplate-sehen.php') || is_singular('immolive') || (is_single() && has_category('video'))) {
    $bg = 'bg-gray-900 min-h-screen';
} else {
    $bg = 'bg-primary-5';
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

<header class="header bg-primary-100 w-full h-10 relative md:px-5" x-data="{ showMobile : false }">
    <div class="container mx-auto flex justify-between ">
        <div class="pt-2 hidden lg:block relative" x-data="{ open: false }" x-cloak>

            <?php
            wp_nav_menu([
                'theme_location' => 'primary',
                'menu_class'     => 'flex space-x-2',
                'container'      => 'nav',
                'depth'          => 2,
                'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'walker'         => new TailwindNavWalker(),
            ]);
            ?>

        </div>

        <a href="<?php echo home_url() ?>" class="z-50">
            <img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/logo.svg" class="h-24 w-auto pt-0 mt-0">
        </a>
        <div class="pt-2 block lg:hidden">
            <ul class="flex">
                <li class="uppercase text-white mr-3">
                    <a href="#" class="underline" @click="showMobile = !showMobile"><?php _e('Menü', 'ir21') ?></a></li>
            </ul>
        </div>

        <div class="pt-2 hidden lg:block">
            <ul class="flex">
                <li>
                    <a href="https://immolive.immobilien-redaktion.com/people" class="uppercase animate-pulse text-white font-semibold">Menschen</a>
                </li>
               <li>
                   <a href="https://immolive.immobilien-redaktion.com" class="uppercase animate-pulse text-white font-semibold">IMMOLIVE</a>
               </li>
            </ul>
        </div>
    </div>


    <?php get_template_part('menu', 'mobile') ?>


</header>
<main class="<?php if (is_page_template('pagetemplate-passwort-vergessen.php')
    || is_page_template('pagetemplate-login-register.php')
    || is_page_template('pagetemplate-passwort-reset.php')
    || is_404()
): ?>
    h-full flex items-center justify-center
<?php endif; ?> md:px-5">
