<?php
function register_post_types()
{

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
    $args = [
        'label'               => 'Werbebanner',
        'labels'              => $labels,
        'supports'            => ['title', 'thumbnail', 'page-attributes'],
        'hierarchical'        => false,
        'taxonomies'          => ['category'],
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-admin-page',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => false,
        'can_export'          => false,
        'has_archive'         => false,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'capability_type'     => 'page',
    ];
    register_post_type('ir_ad', $args);

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
    $args = [
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
    ];
    register_taxonomy('position', ['ir_ad'], $args);

    $labels = [
        'name'                  => _x('Talks', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Talk', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Talks', 'text_domain'),
        'name_admin_bar'        => __('Talks', 'text_domain'),
        'archives'              => __('Talk Archiv', 'text_domain'),
        'attributes'            => __('Talk Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('Alle Talks', 'text_domain'),
        'add_new_item'          => __('Neuer Talk', 'text_domain'),
        'add_new'               => __('Hinzufügen', 'text_domain'),
        'new_item'              => __('Neuer Talk', 'text_domain'),
        'edit_item'             => __('Talk bearbeiten', 'text_domain'),
        'update_item'           => __('Talk speichern', 'text_domain'),
        'view_item'             => __('Talk ansehen', 'text_domain'),
        'view_items'            => __('Alle Talks', 'text_domain'),
        'search_items'          => __('Talk suchen', 'text_domain'),
        'not_found'             => __('Nicht gefunden', 'text_domain'),
        'not_found_in_trash'    => __('Nicht gefunden', 'text_domain'),
        'featured_image'        => __('Beitragsbild', 'text_domain'),
        'set_featured_image'    => __('Beitragsbild setzten', 'text_domain'),
        'remove_featured_image' => __('Beitragsbild entfernen', 'text_domain'),
        'use_featured_image'    => __('Als Beitragsbild verwenden', 'text_domain'),
        'insert_into_item'      => __('Einfügen', 'text_domain'),
        'uploaded_to_this_item' => __('Zum Talk hochgeladen', 'text_domain'),
        'items_list'            => __('Talk Liste', 'text_domain'),
        'items_list_navigation' => __('Talk Liste Navigation', 'text_domain'),
        'filter_items_list'     => __('Filtern', 'text_domain'),
    ];
    $args = [
        'label'               => __('Talk', 'text_domain'),
        'description'         => __('Talk Beschreibung', 'text_domain'),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'page-attributes'],
        'taxonomies'          => ['category', 'post_tag'],
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
    register_post_type('talk', $args);

    $labels = [
        'name'                  => _x('ImmoLive', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('ImmoLive', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('ImmoLive', 'text_domain'),
        'name_admin_bar'        => __('ImmoLive', 'text_domain'),
        'archives'              => __('ImmoLive', 'text_domain'),
        'attributes'            => __('ImmoLive Attributes', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('Alle ImmoLive', 'text_domain'),
        'add_new_item'          => __('Neuer ImmoLive', 'text_domain'),
        'add_new'               => __('Hinzufügen', 'text_domain'),
        'new_item'              => __('Neuer ImmoLive', 'text_domain'),
        'edit_item'             => __('ImmoLive bearbeiten', 'text_domain'),
        'update_item'           => __('ImmoLive speichern', 'text_domain'),
        'view_item'             => __('ImmoLive ansehen', 'text_domain'),
        'view_items'            => __('Alle ImmoLive', 'text_domain'),
        'search_items'          => __('ImmoLive suchen', 'text_domain'),
        'not_found'             => __('Nicht gefunden', 'text_domain'),
        'not_found_in_trash'    => __('Nicht gefunden', 'text_domain'),
        'featured_image'        => __('Beitragsbild', 'text_domain'),
        'set_featured_image'    => __('Beitragsbild setzten', 'text_domain'),
        'remove_featured_image' => __('Beitragsbild entfernen', 'text_domain'),
        'use_featured_image'    => __('Als Beitragsbild verwenden', 'text_domain'),
        'insert_into_item'      => __('Einfügen', 'text_domain'),
        'uploaded_to_this_item' => __('Zum ImmoLive hochgeladen', 'text_domain'),
        'items_list'            => __('ImmoLive Liste', 'text_domain'),
        'items_list_navigation' => __('ImmoLive Liste Navigation', 'text_domain'),
        'filter_items_list'     => __('Filtern', 'text_domain'),
    ];
    $args = [
        'label'               => __('ImmoLive', 'text_domain'),
        'description'         => __('ImmoLive Beschreibung', 'text_domain'),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'page-attributes', 'post-formats', 'excerpt'],
        'taxonomies'          => ['category', 'post_tag'],
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
    register_post_type('ImmoLive', $args);


    $labels = [
        'name'                  => _x('Live Events', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Live Event', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Live Events', 'text_domain'),
        'name_admin_bar'        => __('Live Events', 'text_domain'),
        'archives'              => __('Live Events', 'text_domain'),
        'attributes'            => __('Live Event Attribute', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('Alle Live Events', 'text_domain'),
        'add_new_item'          => __('Neuer Live Event', 'text_domain'),
        'add_new'               => __('Hinzufügen', 'text_domain'),
        'new_item'              => __('Neuer Live Event', 'text_domain'),
        'edit_item'             => __('Live Event bearbeiten', 'text_domain'),
        'update_item'           => __('Live Event speichern', 'text_domain'),
        'view_item'             => __('Live Event ansehen', 'text_domain'),
        'view_items'            => __('Alle Live Events', 'text_domain'),
        'search_items'          => __('Live Event suchen', 'text_domain'),
        'not_found'             => __('Nichts gefunden', 'text_domain'),
        'not_found_in_trash'    => __('Nichts gefunden', 'text_domain'),
        'featured_image'        => __('Beitragsbild', 'text_domain'),
        'set_featured_image'    => __('Beitragsbild setzten', 'text_domain'),
        'remove_featured_image' => __('Beitragsbild entfernen', 'text_domain'),
        'use_featured_image'    => __('Als Beitragsbild verwenden', 'text_domain'),
        'insert_into_item'      => __('Einfügen', 'text_domain'),
        'uploaded_to_this_item' => __('Zum Live Event hochgeladen', 'text_domain'),
        'items_list'            => __('Live Events Liste', 'text_domain'),
        'items_list_navigation' => __('Live Events Listen Navigation', 'text_domain'),
        'filter_items_list'     => __('Filtern', 'text_domain'),
    ];
    $args = [
        'label'               => __('Live Event', 'text_domain'),
        'description'         => __('Live Events der Immobilien Redaktion', 'text_domain'),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'excerpt'],
        'taxonomies'          => ['category', 'post_tag'],
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
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'menu_icon'            => 'dashicons-video-alt3',
    ];
    register_post_type('live_event', $args);
    add_post_type_support('live_event', 'comments');

    $labels = [
        'name'                  => _x('Live Event Sprecher', 'Post Type General Name', 'text_domain'),
        'singular_name'         => _x('Live Event Sprecher', 'Post Type Singular Name', 'text_domain'),
        'menu_name'             => __('Live Event Sprecher', 'text_domain'),
        'name_admin_bar'        => __('Live Event Sprecher', 'text_domain'),
        'archives'              => __('Live Event Sprecher', 'text_domain'),
        'attributes'            => __('Sprecher Attribute', 'text_domain'),
        'parent_item_colon'     => __('Parent Item:', 'text_domain'),
        'all_items'             => __('Alle Sprecher', 'text_domain'),
        'add_new_item'          => __('Neuer Sprecher', 'text_domain'),
        'add_new'               => __('Hinzufügen', 'text_domain'),
        'new_item'              => __('Neuer Sprecher', 'text_domain'),
        'edit_item'             => __('Sprecher bearbeiten', 'text_domain'),
        'update_item'           => __('Sprecher speichern', 'text_domain'),
        'view_item'             => __('Sprecher ansehen', 'text_domain'),
        'view_items'            => __('Alle Sprecher', 'text_domain'),
        'search_items'          => __('Sprecher suchen', 'text_domain'),
        'not_found'             => __('Nichts gefunden', 'text_domain'),
        'not_found_in_trash'    => __('Nichts gefunden', 'text_domain'),
        'featured_image'        => __('Beitragsbild', 'text_domain'),
        'set_featured_image'    => __('Beitragsbild setzten', 'text_domain'),
        'remove_featured_image' => __('Beitragsbild entfernen', 'text_domain'),
        'use_featured_image'    => __('Als Beitragsbild verwenden', 'text_domain'),
        'insert_into_item'      => __('Einfügen', 'text_domain'),
        'uploaded_to_this_item' => __('Zum Sprecher hochgeladen', 'text_domain'),
        'items_list'            => __('Sprecher Liste', 'text_domain'),
        'items_list_navigation' => __('Sprecher Listen Navigation', 'text_domain'),
        'filter_items_list'     => __('Filtern', 'text_domain'),
    ];
    $args = [
        'label'               => __('Live Event Sprecher', 'text_domain'),
        'description'         => __('Gäste der Live Events', 'text_domain'),
        'labels'              => $labels,
        'supports'            => ['title', 'editor', 'thumbnail', 'comments', 'custom-fields', 'excerpt'],
        'taxonomies'          => ['category', 'post_tag'],
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 6,
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true,
        'menu_icon'            => 'dashicons-format-status',
    ];
    register_post_type('live_event_speaker', $args);

}

add_action('init', 'register_post_types');
