<?php
/**
 * var $args
 */
$post_type = 'all';
extract( $args );

?>
<h3 class="text-xl lg:text-2xl text-primary-100 font-serif">Suchen:</h3>
<form method="get" action="<?php echo home_url() ?>" id="searchform">
    <div class="relative">
        <input type="search" name="s" class="w-full text-lg p-3 border border-primary-100 text-primary-100">
        <div class="absolute top-0 right-0 p-3" onclick="document.getElementById('searchform').submit()">
            <svg class="w-8 h-8 text-primary-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
        </div>
    </div>
    <input type="hidden" name="post_type" value="<?php echo $post_type ?>">
</form>