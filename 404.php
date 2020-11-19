<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Freeshifter
 */

get_header(); ?>

	<section class="container mx-auto relative z-10 my-64">
		<h1 class="text-2xl font-serif">Hoppla, diesen Inhalt konnten wir nicht finden...</h1>
		<p>Hie kommen Sie zurück zur <a href="<?php echo home_url() ?>" class="underline">Startseite</a>.</p>
	</section>

<?php
get_footer();
