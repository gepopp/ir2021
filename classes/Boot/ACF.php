<?php


namespace irclasses\Boot;


use Carbon\CarbonInterval;

class ACF {

	public function __construct() {

		add_action('acf/init', [$this, 'ir_add_options_pages']);
		add_filter('acf/update_value/key=field_5a3ce915590ae', [$this, 'update_duration'], 10, 4);


	}


	public function ir_add_options_pages(){
		// Check function exists.
		if( !function_exists('acf_add_options_page') ) return;

			// Register options page.
			acf_add_options_page(array(
				'page_title'    => __('Preroll Einstellungen'),
				'menu_title'    => __('Preroll Video Einstellungen'),
				'menu_slug'     => 'preroll-settings',
				'capability'    => 'edit_posts',
				'redirect'      => false
			));

			acf_add_options_sub_page(array(
				'page_title'  => __('Zoom Einstellungen'),
				'menu_title'  => __('Zoom'),
				'parent_slug' => 'edit.php?post_type=immolive',
			));

			acf_add_options_page(array(
				'page_title' 	=> 'Theme General Einstellungen',
				'menu_title'	=> 'Theme Einstellungen',
				'menu_slug' 	=> 'theme-general-settings',
				'capability'	=> 'edit_posts',
				'redirect'		=> false
			));

			acf_add_options_sub_page(array(
				'page_title' 	=> 'Login und Registrierung',
				'menu_title'	=> 'Login/Registrierung',
				'parent_slug'	=> 'theme-general-settings',
			));

	}

	public function update_duration($value, $post_id, $field, $original){

		$data = (new Vimeo())->get_video_data($post_id);
		return CarbonInterval::seconds($data['duration'])->cascade()->format('%H:%I:%S');

	}



}