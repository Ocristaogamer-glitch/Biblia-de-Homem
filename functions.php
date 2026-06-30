<?php
/**
 * Bíblia de Homem theme bootstrap.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BDH_VERSION', '1.0.0' );
define( 'BDH_DIR', get_template_directory() );
define( 'BDH_URI', get_template_directory_uri() );

require BDH_DIR . '/inc/setup.php';
require BDH_DIR . '/inc/taxonomies.php';
require BDH_DIR . '/inc/meta.php';
require BDH_DIR . '/inc/helpers.php';
