<?php 
defined( 'ABSPATH' ) || exit;
define( 'SC_ADVANCED_CACHE', true );
if ( is_admin() ) { return; }
include_once( WP_CONTENT_DIR . '/plugins/simple-cache/inc/pre-wp-functions.php' );
$GLOBALS['sc_config'] = sc_load_config();
if ( empty( $GLOBALS['sc_config'] ) || empty( $GLOBALS['sc_config']['enable_page_caching'] ) ) { return; }
if ( @file_exists( WP_CONTENT_DIR . '/plugins/simple-cache/inc/dropins/file-based-page-cache.php' ) ) { include_once( WP_CONTENT_DIR . '/plugins/simple-cache/inc/dropins/file-based-page-cache.php' ); }
