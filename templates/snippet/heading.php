<?php
if(empty($args['size'])){
    $font_size = 'text-xl lg:text-3xl';
}else{
    $font_size = '';
}
?>
<h1 class="absolute bottom-0 left-0 text-white font-serif p-5 <?php echo $font_size ?> leading-tight bg-gray-800 bg-opacity-50 w-full">
    <?php the_title() ?>
</h1>
