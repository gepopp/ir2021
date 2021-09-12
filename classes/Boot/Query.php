<?php


namespace irclasses\Boot;


class Query {

	public function __construct() {
		add_action( 'pre_get_posts',  [$this, 'set_posts_per_page']);

	}


	public function set_posts_per_page( $query ) {

		global $wp_the_query;

		if ( $query->is_post_type_archive('zur_person') ) {
			$query->set( 'posts_per_page', 12 );
		}
		// Etc..

		return $query;
	}
}