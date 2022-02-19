<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "NewsArticle",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo get_the_permalink() ?>"
  },
  "headline": "<?php echo get_the_title() ?>",
  "image": [
<?php
    $id = get_post_thumbnail_id();
    $sizes = get_intermediate_image_sizes();
    foreach ($sizes as $index => $size){
        echo '"' . wp_get_attachment_image_url($id, $size) . '"';
        if($index < (count($sizes)-1)){
            echo ',';
        }
    }
?>
   ],
  "datePublished": "<?php \Carbon\Carbon::parse(get_the_time('Y-m-d H:i:s'))->format(DateTime::ISO8601) ?>",
  "dateModified": "<?php \Carbon\Carbon::parse(get_the_time('Y-m-d H:i:s'))->format(DateTime::ISO8601) ?>",
  "author": {
    "@type": "Person",
    "name": "<?php echo get_the_author_meta('display_name' ) ?>",
    "url":"<?php  echo get_author_posts_url( get_the_author_meta('ID') )  ?>"
  },
   "publisher": {
    "@type": "Organization",
    "name": "Die unabhängige Immobilien Redaktion",
    "logo": {
      "@type": "ImageObject",
      "url": "https://immobilien-redaktion.com/wp-content/themes/ir/assets/images/logo.svg"
    }
  },
  "description": "<?php echo get_the_excerpt() ?>"
}
</script>
