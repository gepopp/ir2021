<?php

namespace immobilien_redaktion_2020;

use Carbon\Carbon;

if(str_contains(home_url(), 'test')){
	add_action( 'admin_menu', function () {
		add_menu_page( 'zoom api test', 'zoom api test', 'manage_options', 'zoomtest', function () {

			?>
			<div class="wrap">
				<?php get_zoom_webinars(); ?>
			</div>

			<?php

		} );
	} );
}



function svd_deactivate() {
	wp_clear_scheduled_hook( 'zoom_webinar_cron' );
}

add_action( 'init', function () {
	add_action( 'zoom_webinar_cron', 'immobilien_redaktion_2020\get_zoom_webinars' );
	register_deactivation_hook( __FILE__, 'immobilien_redaktion_2020\svd_deactivate' );

	if ( ! wp_next_scheduled( 'zoom_webinar_cron' ) ) {
		wp_schedule_event( time(), 'twicedaily', 'zoom_webinar_cron' );
	}
} );

function get_zoom_webinars() {

	$wrapper = new \ZoomAPIWrapper( get_field( 'field_60126f14b73d4', 'option' ), get_field( 'field_60126f20b73d5', 'option' ) );
	$result  = $wrapper->doRequest( 'GET', '/users/' . get_field( 'field_6012782af436e', 'option' ) );
	
	if ( $result ) {
		$zoom_user_id = $result['id'];
	}
	$webinars = $wrapper->doRequest( 'GET', '/users/' . $zoom_user_id . '/webinars', ['page_size' => 100] );


	if ( $webinars ) {
		foreach ( $webinars['webinars'] as $webinar ) {

			if ( stripos( $webinar['topic'], 'immolive' ) === false ) {
				continue;
			}

			$post = get_posts( [ 'post_type'   => 'ImmoLive',
			                     'meta_name'   => 'zoom_webinar_id',
			                     'meta_value'  => $webinar['id'],
			                     'post_status' => 'any',
			] );
			if ( ! count( $post ) ) {

				$immolive = wp_insert_post( [
					'post_type'    => 'ImmoLive',
					'post_status'  => 'publish',
					'post_title'   => $webinar['topic'],
					'post_content' => $webinar['agenda'] ?? '',
				] );

			} else {

				$post     = array_shift( $post );
				$immolive = $post->ID;
				wp_update_post( [
					'ID'           => $immolive,
					'post_title'   => $webinar['topic'],
					'post_content' => $webinar['agenda'] ?? '',
				] );
			}

			$webinar_start = Carbon::parse( $webinar['start_time'], 'Europe/London' );
			$webinar_start->setTimezone( 'Europe/Vienna' );

			//datum
			update_field( 'field_601048b4330d8', $webinar_start->format( 'Ymd' ), $immolive );
			update_field( 'field_5ed527e9c2279', $webinar_start->format( 'd.m.Y H:i:s' ), $immolive );
			update_field( 'field_60127a6c90f6b', $webinar['id'], $immolive );
			update_field( 'field_6012878b61fb0', $webinar['join_url'], $immolive );

			$tracking_links = $wrapper->doRequest( 'GET', '/webinars/' . $webinar['id'] . '/tracking_sources' );

			foreach ( $tracking_links['tracking_sources'] as $tracking_source ) {
				if ( $tracking_source['source_name'] == 'IR' || $tracking_source['source_name'] == 'UIR' ) {
					update_field( 'field_5ed52801c227a', $tracking_source['tracking_url'], $immolive );
				}
			}

			$existing_registrants = get_field( 'field_601451bb66bc3', $immolive );
			$registrants          = $wrapper->doRequest( 'GET', '/webinars/' . $webinar['id'] . '/registrants', [ 'page_size' => 300 ] );


			foreach ( $registrants['registrants'] as $registrant ) {

				$exists = false;

				foreach ( $existing_registrants as $existing_registrant ) {
					if ( $existing_registrant['user_email'] == $registrant['email'] ) {
						$exists = true;
					}
				}

				if ( ! $exists ) {
					add_row( 'field_601451bb66bc3', [
						'user_name'            => $registrant['first_name'] . ' ' . $registrant['last_name'],
						'user_email'           => $registrant['email'],
						'hat_dsg_bestatigt'    => 0,
						'frage_ans_podium'     => $registrant['comment'],
						'zoom_registrant_id'   => $registrant['id'],
						'zoom_teilnehmer_link' => $registrant['join_url'],
					], $immolive );
				}
			}

			if ( ! has_post_thumbnail( $immolive ) ) {
				$thumb = get_field( 'field_60127cd33b046', 'option' );
				set_post_thumbnail( $immolive, $thumb['ID'] );
			}
		}
	}
}