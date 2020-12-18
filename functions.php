<?php
/**
 * Kickoff theme setup and build
 */



namespace immobilien_redaktion_2020;

use Predis\Client;

if (session_status() != PHP_SESSION_ACTIVE) session_start();

define( 'immobilien_redaktion_2020_VERSION', wp_get_theme()->version );
define( 'immobilien_redaktion_2020_DIR', __DIR__ );
define( 'immobilien_redaktion_2020_URL', get_template_directory_uri() );

require_once( immobilien_redaktion_2020_DIR . '/vendor/autoload.php' );

\A7\autoload( __DIR__ . '/src' );


