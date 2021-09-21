<?php


namespace irclasses\Boot;


use Carbon\Carbon;
use Carbon\CarbonInterval;

class ACF {

	public function __construct() {

		add_action( 'acf/init', [ $this, 'ir_add_options_pages' ] );
		add_filter( 'acf/update_value/key=field_5a3ce915590ae', [ $this, 'update_duration' ], 10, 4 );
		add_filter( 'acf/update_value/key=field_5ed527e9c2279', [ $this, 'save_immolive_termin' ], 10, 4 );
		add_filter( 'acf/update_value/key=field_6143982f5f5f2', [ $this, 'create_ics_datei' ], 10, 4 );
		add_filter( 'acf/load_value/key=field_5ed527e9c2279', [ $this, 'load_immolive_termin' ], 10, 4 );


	}

	public function create_ics_datei( $value, $post_id, $field, $original ) {

		if ( ! empty( $value ) ) {
			return $value;
		}

		$starts = new \Carbon\Carbon( get_field( 'field_5ed527e9c2279', $post_id, false ), 'Europe/Vienna' );
		$starts->setTimezone( 'UTC' );

		$start = $starts->format('Ymd\THis\Z');
		$end = $starts->addHour()->format('Ymd\THis');


		$ics = new \irclasses\ICS( [
			'location'    => 'online',
			'description' => get_the_excerpt( $post_id ),
			'dtstart'     => $start,
			'dtend'       => $end,
			'summary'     => get_the_title( $post_id ),
			'url'         => get_the_permalink( $post_id ),
			'vtimezone'   => 'Europe/Vienna'
		] );

		$template_dir = immobilien_redaktion_2020_DIR . '/tmp/';
		$filename     = $template_dir . $post_id . '.ics';

		$file = fopen( $filename, 'w' );
		fwrite( $file, $ics->to_string() );
		fclose( $file );

		require( ABSPATH . 'wp-load.php' );
		$wordpress_upload_dir = wp_upload_dir();
		$new_file_path        = $wordpress_upload_dir['path'] . '/' . $post_id . '.ics';

		rename($filename, $new_file_path);

		$upload_id = wp_insert_attachment( [
			'guid'           => $new_file_path,
			'post_mime_type' => 'text/calendar',
			'post_title'     => preg_replace( '/\.[^.]+$/', '', $post_id . '.ics' ),
			'post_content'   => '',
			'post_status'    => 'inherit',
		], $new_file_path );

		require_once( ABSPATH . 'wp-admin/includes/image.php' );
		wp_update_attachment_metadata( $upload_id, wp_generate_attachment_metadata( $upload_id, $new_file_path ) );

		return $upload_id;

	}

	public function load_immolive_termin( $value, $post_id, $field ) {

		if ( ! is_admin() ) {
			return $value;
		}

		$datetime = Carbon::createFromFormat( 'Y-m-d H:i:s', $value, 'UTC' );

		$datetime->setTimezone( 'Europe/Vienna' );

		return $datetime->format( 'Y-m-d H:i:s' );
	}


	public function save_immolive_termin( $value, $post_id, $field, $original ) {

		$datetime = Carbon::createFromFormat( 'Y-m-d H:i:s', $value, 'Europe/Vienna' );

		$datetime->setTimezone( 'UTC' );

		return $datetime->format( 'Y-m-d H:i:s' );
	}


	public function ir_add_options_pages() {
		// Check function exists.
		if ( ! function_exists( 'acf_add_options_page' ) ) {
			return;
		}

		// Register options page.
		acf_add_options_page( [
			'page_title' => __( 'Preroll Einstellungen' ),
			'menu_title' => __( 'Preroll Video Einstellungen' ),
			'menu_slug'  => 'preroll-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		] );

		acf_add_options_sub_page( [
			'page_title'  => __( 'Zoom Einstellungen' ),
			'menu_title'  => __( 'Zoom' ),
			'parent_slug' => 'edit.php?post_type=immolive',
		] );

		acf_add_options_page( [
			'page_title' => 'Theme General Einstellungen',
			'menu_title' => 'Theme Einstellungen',
			'menu_slug'  => 'theme-general-settings',
			'capability' => 'edit_posts',
			'redirect'   => false,
		] );

		acf_add_options_sub_page( [
			'page_title'  => 'Login und Registrierung',
			'menu_title'  => 'Login/Registrierung',
			'parent_slug' => 'theme-general-settings',
		] );

	}

	public function update_duration( $value, $post_id, $field, $original ) {

		$data = ( new Vimeo() )->get_video_data( $post_id );

		return CarbonInterval::seconds( $data['duration'] )->cascade()->format( '%H:%I:%S' );

	}


}