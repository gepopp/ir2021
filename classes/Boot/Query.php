<?php


namespace irclasses\Boot;


class Query {

	public function __construct() {
		add_action( 'pre_get_posts',  [$this, 'set_posts_per_page']);

	}


	public function set_posts_per_page( \WP_Query $query ) {

		global $wp_the_query;

		if ( is_post_type_archive('zur_person') ) {
			$query->set( 'posts_per_page', 11 );
			$query->set('meta_key', 'zur_person_name' );
			$query->set('orderby', 'meta_value');
			$query->set('order', 'ASC');
		}



		return $query;
	}
}