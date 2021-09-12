<?php


namespace irclasses\Boot;


class Posttypes {

	public function __construct() {

		add_action('init', [$this, 'register_post_types']);

	}


	function register_post_types() {

		$labels = [
			'name'                  => 'Werbebanner',
			'singular_name'         => 'Werbebanner',
			'menu_name'             => 'Werbebanner',
			'name_admin_bar'        => 'Werbanner',
			'archives'              => 'Banner Archiv',
			'attributes'            => 'Banner Attribute',
			'parent_item_colon'     => 'Parent Item:',
			'all_items'             => 'Alle Banner',
			'add_new_item'          => 'Neuer Banner',
			'add_new'               => 'Hinzufügen',
			'new_item'              => 'Neuer Banner',
			'edit_item'             => 'Banner bearbeiten',
			'update_item'           => 'speichern',
			'view_item'             => 'ansehen',
			'view_items'            => 'ansehen',
			'search_items'          => 'suchen',
			'not_found'             => 'nichts gefunden',
			'not_found_in_trash'    => 'nichts gefunden',
			'featured_image'        => 'Banner Bild',
			'set_featured_image'    => 'Bild setzen',
			'remove_featured_image' => 'Bild entfernen',
			'use_featured_image'    => 'Bild verwenden',
			'insert_into_item'      => 'einfügen',
			'uploaded_to_this_item' => 'Zu diesem Banner hochgeladen',
			'items_list'            => 'Liste',
			'items_list_navigation' => 'Navigation',
			'filter_items_list'     => 'filtern',
		];
		$args   = [
			'label'               => 'Werbebanner',
			'labels'              => $labels,
			'supports'            => [ 'title', 'thumbnail', 'page-attributes' ],
			'hierarchical'        => false,
			'taxonomies'          => [ 'category' ],
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 10,
			'menu_icon'           => 'dashicons-admin-page',
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => false,
			'can_export'          => false,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'capability_type'     => 'page',
		];
		register_post_type( 'ir_ad', $args );



		$labels = [
			'name'                       => 'Positionen',
			'singular_name'              => 'Position',
			'menu_name'                  => 'Postionen',
			'all_items'                  => 'Alle Positionen',
			'parent_item'                => 'Übergeordnet',
			'parent_item_colon'          => 'Übergeordnet',
			'new_item_name'              => 'Bezeichnung',
			'add_new_item'               => 'Neune Position',
			'edit_item'                  => 'bearbeiten',
			'update_item'                => 'speichern',
			'view_item'                  => 'ansehen',
			'separate_items_with_commas' => 'Separate items with commas',
			'add_or_remove_items'        => 'Add or remove items',
			'choose_from_most_used'      => 'Choose from the most used',
			'popular_items'              => 'Popular Items',
			'search_items'               => 'Search Items',
			'not_found'                  => 'Not Found',
			'no_terms'                   => 'No items',
			'items_list'                 => 'Items list',
			'items_list_navigation'      => 'Items list navigation',
		];
		$args   = [
			'labels'            => $labels,
			'hierarchical'      => true,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_tagcloud'     => true,
		];
		register_taxonomy( 'position', [ 'ir_ad' ], $args );


		$labels = [
			'name'                  => _x( 'ImmoLive', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'ImmoLive', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'ImmoLive', 'text_domain' ),
			'name_admin_bar'        => __( 'ImmoLive', 'text_domain' ),
			'archives'              => __( 'ImmoLive', 'text_domain' ),
			'attributes'            => __( 'ImmoLive Attributes', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Alle ImmoLive', 'text_domain' ),
			'add_new_item'          => __( 'Neuer ImmoLive', 'text_domain' ),
			'add_new'               => __( 'Hinzufügen', 'text_domain' ),
			'new_item'              => __( 'Neuer ImmoLive', 'text_domain' ),
			'edit_item'             => __( 'ImmoLive bearbeiten', 'text_domain' ),
			'update_item'           => __( 'ImmoLive speichern', 'text_domain' ),
			'view_item'             => __( 'ImmoLive ansehen', 'text_domain' ),
			'view_items'            => __( 'Alle ImmoLive', 'text_domain' ),
			'search_items'          => __( 'ImmoLive suchen', 'text_domain' ),
			'not_found'             => __( 'Nicht gefunden', 'text_domain' ),
			'not_found_in_trash'    => __( 'Nicht gefunden', 'text_domain' ),
			'featured_image'        => __( 'Beitragsbild', 'text_domain' ),
			'set_featured_image'    => __( 'Beitragsbild setzten', 'text_domain' ),
			'remove_featured_image' => __( 'Beitragsbild entfernen', 'text_domain' ),
			'use_featured_image'    => __( 'Als Beitragsbild verwenden', 'text_domain' ),
			'insert_into_item'      => __( 'Einfügen', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Zum ImmoLive hochgeladen', 'text_domain' ),
			'items_list'            => __( 'ImmoLive Liste', 'text_domain' ),
			'items_list_navigation' => __( 'ImmoLive Liste Navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filtern', 'text_domain' ),
		];
		$args   = [
			'label'               => __( 'ImmoLive', 'text_domain' ),
			'description'         => __( 'ImmoLive Beschreibung', 'text_domain' ),
			'labels'              => $labels,
			'supports'            => [
				'title',
				'editor',
				'thumbnail',
				'comments',
				'custom-fields',
				'page-attributes',
				'post-formats',
				'excerpt'
			],
			'taxonomies'          => [ 'category', 'post_tag' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'page',
			'show_in_rest'        => true,
		];
		register_post_type( 'ImmoLive', $args );


		$labels = [
			'name'                  => _x( 'Aktuelles', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Aktuelles', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Aktuelles', 'text_domain' ),
			'name_admin_bar'        => __( 'Aktuelles', 'text_domain' ),
			'archives'              => __( 'Aktuelles', 'text_domain' ),
			'attributes'            => __( 'Aktuelles Attribute', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Alle Aktuelles', 'text_domain' ),
			'add_new_item'          => __( 'Neuer Aktuelles', 'text_domain' ),
			'add_new'               => __( 'Hinzufügen', 'text_domain' ),
			'new_item'              => __( 'Neuer Aktuelles', 'text_domain' ),
			'edit_item'             => __( 'Aktuelles bearbeiten', 'text_domain' ),
			'update_item'           => __( 'Aktuelles speichern', 'text_domain' ),
			'view_item'             => __( 'Aktuelles ansehen', 'text_domain' ),
			'view_items'            => __( 'Alle Aktuelles', 'text_domain' ),
			'search_items'          => __( 'Aktuelles suchen', 'text_domain' ),
			'not_found'             => __( 'Nichts gefunden', 'text_domain' ),
			'not_found_in_trash'    => __( 'Nichts gefunden', 'text_domain' ),
			'featured_image'        => __( 'Beitragsbild', 'text_domain' ),
			'set_featured_image'    => __( 'Beitragsbild setzten', 'text_domain' ),
			'remove_featured_image' => __( 'Beitragsbild entfernen', 'text_domain' ),
			'use_featured_image'    => __( 'Als Beitragsbild verwenden', 'text_domain' ),
			'insert_into_item'      => __( 'Einfügen', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Zum Aktuelles hochgeladen', 'text_domain' ),
			'items_list'            => __( 'Aktuelles Liste', 'text_domain' ),
			'items_list_navigation' => __( 'Aktuelles Listen Navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filtern', 'text_domain' ),
		];
		$args   = [
			'label'               => __( 'Aktuelles', 'text_domain' ),
			'description'         => __( 'Aktuelles', 'irtheme' ),
			'labels'              => $labels,
			'supports'            => [ 'title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'excerpt' ],
			'taxonomies'          => [ 'category', 'post_tag' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 4,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-admin-post',
		];
		register_post_type( 'aktuelle_presse', $args );



		$labels = [
			'name'                  => _x( 'Immobilien Projekt', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Immobilien Projekt', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Immobilien Projekt', 'text_domain' ),
			'name_admin_bar'        => __( 'Immobilien Projekt', 'text_domain' ),
			'archives'              => __( 'Immobilien Projekt', 'text_domain' ),
			'attributes'            => __( 'Immobilien Projekt Attribute', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Alle Immobilien Projekt', 'text_domain' ),
			'add_new_item'          => __( 'Neuer Immobilien Projekt', 'text_domain' ),
			'add_new'               => __( 'Hinzufügen', 'text_domain' ),
			'new_item'              => __( 'Neuer Immobilien Projekt', 'text_domain' ),
			'edit_item'             => __( 'Immobilien Projekt bearbeiten', 'text_domain' ),
			'update_item'           => __( 'Immobilien Projekt speichern', 'text_domain' ),
			'view_item'             => __( 'Immobilien Projekt ansehen', 'text_domain' ),
			'view_items'            => __( 'Alle Immobilien Projekt', 'text_domain' ),
			'not_found'             => __( 'Nichts gefunden', 'text_domain' ),
			'not_found_in_trash'    => __( 'Nichts gefunden', 'text_domain' ),
			'featured_image'        => __( 'Beitragsbild', 'text_domain' ),
			'set_featured_image'    => __( 'Beitragsbild setzten', 'text_domain' ),
			'remove_featured_image' => __( 'Beitragsbild entfernen', 'text_domain' ),
			'use_featured_image'    => __( 'Als Beitragsbild verwenden', 'text_domain' ),
			'insert_into_item'      => __( 'Einfügen', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Zum Immobilien Projekt hochgeladen', 'text_domain' ),
			'items_list'            => __( 'Immobilien Projekt Liste', 'text_domain' ),
			'items_list_navigation' => __( 'Immobilien Projekt Listen Navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filtern', 'text_domain' ),
		];
		$args   = [
			'label'               => __( 'Immobilien Projekt', 'text_domain' ),
			'description'         => __( 'Immobilien Projekt', 'irtheme' ),
			'labels'              => $labels,
			'supports'            => [ 'title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'excerpt' ],
			'taxonomies'          => [ 'category', 'post_tag' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 4,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-admin-post',
		];
		register_post_type( 'immobilien_projekt', $args );



		$labels = [
			'name'                  => _x( 'Zur Person', 'Post Type General Name', 'text_domain' ),
			'singular_name'         => _x( 'Zur Person', 'Post Type Singular Name', 'text_domain' ),
			'menu_name'             => __( 'Zur Person', 'text_domain' ),
			'name_admin_bar'        => __( 'Zur Person', 'text_domain' ),
			'archives'              => __( 'Zur Person', 'text_domain' ),
			'attributes'            => __( 'Zur Person Attribute', 'text_domain' ),
			'parent_item_colon'     => __( 'Parent Item:', 'text_domain' ),
			'all_items'             => __( 'Alle Zur Person', 'text_domain' ),
			'add_new_item'          => __( 'Neuer Zur Person', 'text_domain' ),
			'add_new'               => __( 'Hinzufügen', 'text_domain' ),
			'new_item'              => __( 'Neuer Zur Person', 'text_domain' ),
			'edit_item'             => __( 'Zur Person', 'text_domain' ),
			'update_item'           => __( 'Zur Person', 'text_domain' ),
			'view_item'             => __( 'Zur Person', 'text_domain' ),
			'view_items'            => __( 'Alle Zur Person', 'text_domain' ),
			'not_found'             => __( 'Nichts gefunden', 'text_domain' ),
			'not_found_in_trash'    => __( 'Nichts gefunden', 'text_domain' ),
			'featured_image'        => __( 'Beitragsbild', 'text_domain' ),
			'set_featured_image'    => __( 'Beitragsbild setzten', 'text_domain' ),
			'remove_featured_image' => __( 'Beitragsbild entfernen', 'text_domain' ),
			'use_featured_image'    => __( 'Als Beitragsbild verwenden', 'text_domain' ),
			'insert_into_item'      => __( 'Einfügen', 'text_domain' ),
			'uploaded_to_this_item' => __( 'Zum Zur Person hochgeladen', 'text_domain' ),
			'items_list'            => __( 'Zur Person Liste', 'text_domain' ),
			'items_list_navigation' => __( 'Zur Person Listen Navigation', 'text_domain' ),
			'filter_items_list'     => __( 'Filtern', 'text_domain' ),
		];
		$args   = [
			'label'               => __( 'Zur Person', 'text_domain' ),
			'description'         => __( 'Zur Person', 'irtheme' ),
			'labels'              => $labels,
			'supports'            => [ 'title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'excerpt' ],
			'taxonomies'          => [ 'category', 'post_tag' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 4,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
			'menu_icon'           => 'dashicons-admin-post',
		];
		register_post_type( 'zur_person', $args );
	}


}