<?php
add_action('post_updated', function ($post_id, $post_after, $post_before){

	$post_id = $post_after->ID;
	$vimeo_id = get_field('field_5fe2884da38a5', $post_id);

	if(get_post_format($post_id) !== 'video' || has_post_thumbnail($post_id) || empty($vimeo_id)) return;

	$lib = new \Vimeo\Vimeo('f1663d720a1da170d55271713cc579a3e15d5d2f', 'd30MDbbXFXRhZK2xlnyx5VMk602G7J8Z0VHFP8MvNnDDuAVfcgPj2t5zwE5jpbyXweFrQKa9Ey02edIx/E3lJNVqsFxx+9PRShAkUA+pwyCeoh9rMoVT2dWv2X7WurgV', 'b57bb7953cc356e8e1c3ec8d4e17d2e9');
	$response = $lib->request('/videos/' . get_field('field_5fe2884da38a5', $post_id), [], 'GET');
	$body = $response['body'];
	$file = $body['pictures']['sizes'][5]['link'];

	$file_array = array();
	$file_array['name'] = $vimeo_id . '_' . $post_id . '.jpg';

	if(!function_exists('download_url')){
		require_once 'wp-admin/includes/file.php';
	}
	// Download file to temp location.
	$file_array['tmp_name'] = download_url( $file );

	// If error storing temporarily, return the error.
	if ( is_wp_error( $file_array['tmp_name'] ) ) {
		return $file_array['tmp_name'];
	}

	if(!function_exists('media_handle_sideload')){
		require_once 'wp-admin/includes/media.php';
		require_once 'wp-admin/includes/image.php';
	}
	// Do the validation and storage stuff.
	$id = media_handle_sideload( $file_array, $post_id );

	// If error storing permanently, unlink.
	if ( is_wp_error( $id ) ) {
		@unlink( $file_array['tmp_name'] );
		return $id;
	}
	set_post_thumbnail( $post_id, $id );

}, 10, 3);