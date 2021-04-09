<?php
/**
 * Kickoff theme setup and build
 */

namespace immobilien_redaktion_2020;

define('immobilien_redaktion_2020_VERSION', wp_get_theme()->version);
define('immobilien_redaktion_2020_DIR', __DIR__);
define('immobilien_redaktion_2020_URL', get_template_directory_uri());


$loader = require_once( immobilien_redaktion_2020_DIR . '/vendor/autoload.php' );
$loader->addPsr4('Overtrue\\', __DIR__ . '/Overtrue');

\A7\autoload(__DIR__ . '/src');

