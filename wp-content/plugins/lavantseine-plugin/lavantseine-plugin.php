<?php

/**
 *
 * Plugin Name: Plugin pour le site de l'Avant-Seine
 * Plugin URI: 
 * Description: Post types, metas, etc.
 * Version: 1.0.0
 * Author: Thomas Florentin
 * Author URI: http://thomasflorentin.net
 * Text Domain: lavantseine-plugin
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;


/**
 * DEFINE PATHS
 */
define('ODY_PATH', plugin_dir_path(__FILE__));
define('ODY_PT_PATH', ODY_PATH . 'post_types/');
define('ODY_UTILS_PATH', ODY_PATH . 'utils/');
define('ODY_METAS_PATH', ODY_PATH . 'metas/');


/**
 * DEFINE SOCIAL ACCOMPTS
 */
define('FACEBOOK', '');
define('TWITTER', '');


/**
 * Post Types & Taxonomies & metas
 */
require_once(ODY_PT_PATH . 'events-post-type.php');
require_once(ODY_PT_PATH . 'custom-taxonomies.php');
require_once(ODY_METAS_PATH . 'attachment-metas.php');
require_once(ODY_METAS_PATH . 'event-metas.php');
require_once(ODY_METAS_PATH . 'page-metas.php');
require_once(ODY_METAS_PATH . 'post-metas.php');

//require_once(ODY_UTILS_PATH . 'custom-widgets.php');
require_once(ODY_UTILS_PATH . 'options-panel.php');
require_once(ODY_UTILS_PATH . 'template-tags.php');
require_once(ODY_UTILS_PATH . 'queries-filters.php');

/**
 * Post Types & Taxonomies & metas
 */
//require_once(ODY_UTILS_PATH . 'acf.php');






