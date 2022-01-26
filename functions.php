<?php
/**
 * Kickoff theme setup and build
 */

namespace immobilien_redaktion_2020;

use irclasses\Boot;

define('immobilien_redaktion_2020_VERSION', wp_get_theme()->version);
define('immobilien_redaktion_2020_DIR', __DIR__);
define('immobilien_redaktion_2020_URL', get_template_directory_uri());


$loader = require_once( immobilien_redaktion_2020_DIR . '/vendor/autoload.php' );
$loader->addPsr4('irclasses\\', __DIR__ . '/classes');

\A7\autoload(__DIR__ . '/src');

new Boot();


add_filter('rest_page_collection_params', function ($query_params){
	$query_params['per_page']["maximum"]=1000;
	return $query_params;
});