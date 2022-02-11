<?php
/**
 * Kickoff theme setup and build
 */

namespace immobilien_redaktion_2020;

use irclasses\Boot;



define( 'immobilien_redaktion_2020_VERSION', wp_get_theme()->version );
define( 'immobilien_redaktion_2020_DIR', __DIR__ );
define( 'immobilien_redaktion_2020_URL', get_template_directory_uri() );


$loader = require_once( immobilien_redaktion_2020_DIR . '/vendor/autoload.php' );
$loader->addPsr4( 'irclasses\\', __DIR__ . '/classes' );

\A7\autoload( __DIR__ . '/src' );

new Boot();


add_filter( 'rest_zur_person_collection_params', function ( $query_params ) {

	$query_params['per_page']["maximum"] = 1000;

	return $query_params;
} );

add_filter( 'rest_immolive_collection_params', function ( $query_params ) {

	$query_params['per_page']["maximum"] = 1000;

	return $query_params;
} );


add_filter( 'rest_user_collection_params', function ( $query_params ) {

	$query_params['per_page']["maximum"] = 1000;

	return $query_params;
} );


add_action( 'rest_api_init', function () {

	register_rest_field( 'zur_person', 'my_meta', [
		'get_callback' => function ( $post ) {

			// get_post_meta( post_id, meta_key[optional], single[optional] )
			$post_meta = get_post_meta( $post['id'] );
			$meta      = [];
			foreach ( $post_meta as $meta_key => $meta_value ) {
				$meta[ $meta_key ] = $meta_value[0];
			}

			return $meta;
		},
		// 'update_callback'=> null,
		// 'schema'         => null
	] );
} );


add_action( 'rest_api_init', function () {

	register_rest_field( 'comment', 'authorEmail', [
			'get_callback' => function ( $comment ) {
				return get_comment_author_email( $comment['id'] );
			},
		]
	);


	register_rest_field( 'user', 'user_email',
		array(
			'get_callback'    => function ( $user ) {
				return get_userdata($user['id'])->user_email;
			},
			'update_callback' => null,
			'schema'          => null,
		)
	);

	register_rest_field( 'immolive', 'my_meta', [
		'get_callback' => function ( $post ) {

			// get_post_meta( post_id, meta_key[optional], single[optional] )
			$post_meta = get_post_meta( $post['id'] );
			$meta      = [];
			foreach ( $post_meta as $meta_key => $meta_value ) {
				$meta[ $meta_key ] = $meta_value[0];
			}

			return $meta;
		},
		// 'update_callback'=> null,
		// 'schema'         => null
	] );

} );


add_action( 'rest_api_init', function () {
	register_rest_route( 'immolive/v2', '/users/', array(
		'methods' => 'GET',
		'callback' => function(){
			$with_meta = [];
			$users = get_users();

			wp_die(var_dump($users[0]));

//			foreach ($users as $user){
//				$with_meta[] = [
//					'name' =>
//				];
//			}


			return $users;
		},
	) );
} );