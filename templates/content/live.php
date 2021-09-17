<?php
$user = wp_get_current_user();
$post = get_the_ID();

$cat = get_the_category();
$cat = array_shift( $cat );
?>

<div class="px-5 lg:px-5"
     x-data="readingLog(<?php echo $user->ID ?? false ?>, <?php echo $post ?>)"
     x-init="getmeasurements();"
     @scroll.window.debounce.1s="amountscrolled()"
     @resize.window="getmeasurements()"
     ref="watched"
>
    <?php
    $termin = get_field('field_5ed527e9c2279');
    $carbon = new \Carbon\Carbon($termin);

    if(get_post_format() == 'video'){
	    get_template_part( 'video', 'head' );
    }else{
        get_template_part('article', 'liveheader');
    }
    ?>



    <div class="container mx-auto mt-10 text-white">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">
            <div class="content col-span-5 lg:col-span-3" id="article-content">
                <h1 class="text-2xl lg:text-5xl font-serif leading-none mb-5 text-white">
					<?php echo get_the_title() ?>
                </h1>
                <div class="hidden sm:block">
					<?php get_template_part( 'video', 'meta', [ 'mode' => 'dark' ] ) ?>
                </div>
                <div>
                    <div class="max-w-1/3 h-48 w-48 float-left mb-5 mr-5 flex items-end justify-end p-3 text-white font-serif text-xl" style="background-color: <?php the_field( 'field_5c63ff4b7a5fb', $cat ); ?>">
						<?php echo $cat->name ?? '' ?>
                    </div>
                    <?php the_excerpt(); ?>
					<?php the_content(); ?>
                </div>
            </div>
        </div>
    </div>
