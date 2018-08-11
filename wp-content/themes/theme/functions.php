<?php
/**
 * Theme constants definition and functions.
 *
 * @since   1.0.0
 * @package Claue
 */

// Constants definition
define('GM_THEME_URL', get_template_directory());
define('GM_THEME_URI', get_template_directory_uri());
define('ASSETS', GM_THEME_URI.'/assets/node_modules');

// required file init on folder core
require GM_THEME_URL.'/core/init.php';



