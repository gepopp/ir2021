<?php


namespace irclasses\Boot;


class User {


	public function __construct() {

		add_role( 'registered', 'Registriert', [] );
		add_action( 'admin_init', [$this, 'alter_capabilities']);
		add_filter( 'show_admin_bar', [$this, 'hide_admin_bar']);


	}

	public function alter_capabilities() {

		global $wp_roles; // global class wp-includes/capabilities.php
		$wp_roles->remove_cap( 'subscriber', 'read' );
		$wp_roles->remove_cap( 'registered', 'read' );
		$wp_roles->remove_cap( 'subscriber', 'edit_dashboard' );
		$wp_roles->remove_cap( 'registered', 'edit_dashboard' );

	}

	public function hide_admin_bar(){
		if ( ! current_user_can( 'administrator' ) ) {
			return false;
		}
		return true;
	}


}