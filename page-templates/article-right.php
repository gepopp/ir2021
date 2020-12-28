<?php
$cat = wp_get_post_categories(get_the_ID());
$cat = array_shift($cat);
$cat = get_category($cat);

if($cat):
?>
<div class="hidden lg:block">
    <script>
        function data() {
            return {
                scrolled: 0,
            }
        }
    </script>
    <div class="relative h-64 hidden lg:block" id="powered"
         x-data="data()"
         @scroll.window="scrolled = document.getElementById('powered').offsetTop - window.pageYOffset"
    >
        <div class="absolute w-full h-full" :style="`top: ${ scrolled < 0 ? (scrolled * -1) + 100 : 0 }px;`">
            <div class="h-full" style="background-color: <?php the_field('field_5c63ff4b7a5fb', $cat); ?>">
                <div id="scrollspy" class="flex flex-col justify-between h-full">
                    <p class="p-5 font-serif text-2xl text-white"><?php echo $cat->name ?></p>
                    <p class="p-5 text-white">
                        <a href="<?php echo get_category_link($cat) ?>">
                            <span class="text-white underline"><?php echo $cat->count ?> Artikel</span>
                        </a>
                    </p>
                </div>
                <?php if (get_field('field_5f9aeff4efa16', $cat)): ?>
                    <div class="absolute bottom-0 right-0 -ml-5 -mr-5 bg-white rounded-full w-24 h-24 flex flex-col items-center justify-center shadow-lg">
                        <a href="<?php echo get_field('field_5f9aeff4efa16', $cat) ?>" class="text-center">
                            <p class="text-xs text-gray-900">powered by</p>
                            <img src="<?php echo get_field('field_5f9aefd116e2e', $cat) ?>" class="w-24 h-auto px-5">
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <?php get_template_part('page-templates/article', 'iconbar') ?>
        </div>
    </div>
</div>
<?php endif;