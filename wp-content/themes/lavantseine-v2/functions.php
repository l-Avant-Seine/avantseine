<?php
/**
 * l\'Avant-Seine v2.0 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package l\'Avant-Seine_v2.0
 */


define('FB_URL','https://www.facebook.com/lAvantSeine');
define('TWITTER_URL','https://twitter.com/AvantSeine');
define('INSTAGRAM_URL','http://instagram.com/avantseine');
define('GOOGLEPLUS_URL','https://plus.google.com/u/0/b/100144920076066761502/100144920076066761502');
define('VIDEOCHANNEL_URL','https://www.youtube.com/channel/UCtUb1swrX34VbClR53YcagA');

setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
$today = time();
$previous_month = false;



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';



if ( ! function_exists( 'lavantseine_v2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lavantseine_v2_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on l\'Avant-Seine v2.0, use a find and replace
	 * to change 'lavantseine-v2' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lavantseine-v2', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	//add_image_size( 'box-thumbnail', 168, 9999 );
	add_image_size( 'featured-post-thumbnail', 578, 9999 );
	add_image_size( 'top-thumbnail', 779, 9999 );
	add_image_size( '2col-thumbnail', 369, 9999 );
  add_image_size( 'box-plain', 176, 350, array( 'center', 'center' ) );
  add_image_size( 'logo', 200, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Menu principal', 'lavantseine-v2' ),
		'top' => __( 'Menu supérieur', 'lavantseine-v2' ),
		'all' => __( 'Menu hamburger', 'lavantseine-v2' ),
		'footer' => __( 'Footer', 'lavantseine-v2' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lavantseine_v2_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'lavantseine_v2_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lavantseine_v2_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lavantseine_v2_content_width', 640 );
}
add_action( 'after_setup_theme', 'lavantseine_v2_content_width', 0 );



/**
 * Register widget area.
 */
function lavantseine_v2_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar principale', 'lavantseine' ),
		'id'            => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="box-sidebar widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Emplacements Footer ', 'lavantseine-v2' ),
		'id'            => 'footer-widgets',
		'before_widget' => '<aside id="%1$s" class="box-footer widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="box-footer-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'lavantseine_v2_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function lavantseine_v2_scripts() {
	wp_enqueue_style( 'lavantseine-v2-style', get_stylesheet_uri() );
	wp_enqueue_script( 'lavantseine-v2-scripts', get_template_directory_uri() . '/assets/js/all.min.js', array(), '', true );

	wp_register_script( 'salvatorre', get_template_directory_uri() .'/assets/js/salvatorre.js' , 'jquery', '', true );
	wp_register_script( 'bxslider', get_template_directory_uri() .'/assets/js/bxslider.js' , 'jquery', '', true );

	// pass Ajax Url to script.js
	wp_localize_script('lavantseine-v2-scripts', 'ajaxurl', admin_url( 'admin-ajax.php' ) );
}
add_action( 'wp_enqueue_scripts', 'lavantseine_v2_scripts' );




/**
 * Load more events
 */
add_action( 'wp_ajax_load_more', 'load_more' );
add_action( 'wp_ajax_nopriv_load_more', 'load_more' );

function load_more() {
	global $post; 

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();

	$offset = $_POST['offset'];
	$step = $_POST['step'];
	//$previous_month = $_POST['previous_month'];
	$pastEvents = $_POST['pastEvents'];

	$args = array(
	    'post_type' =>'event',
	    'offset' => $offset,
	    'posts_per_page' => $step,
			'post_status'			=> 'publish', 
			'meta_key' => 'eventDetail_first_date',
			'orderby' => 'meta_value_num',
	);

	if( $pastEvents === 'true' ) {
		$args['order'] = 'DESC';
		$args['meta_query'] = array(
			array(
	    	'key' => 'eventDetail_last_date',
			  'value' => $today,
		    'compare' => '<=',
	    )
		);
	}
	else {
		$args['meta_query'] = array(
			array(
	    	'key' => 'eventDetail_last_date',
			  'value' => $today,
		    'compare' => '>=',
	    )
		);
		$args['order'] = 'ASC';
	}

	$ajax_query = new WP_Query($args);

	
	if ( $ajax_query->have_posts() ) : while ( $ajax_query->have_posts() ) : $ajax_query->the_post();

		$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
		$month = date( 'Y/m', $event_first_date );

		if ( $previous_month != $month ): ?>

				<?php if($previous_month) : ?>
					</div>
				<?php endif; ?>

				<div class="h3 box-month clearfix m-first" month="<?php echo $month; ?>" data-date="<?php print strtotime($month.'/01') ?>">
					<?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
				</div>
				<div class="row_alt event-row">
			<?php
			$previous_month = $month;
		endif;
	?>

	<div class="m-2coll">
		<?php get_template_part( 'template-parts/blocs/bloc', 'event' ); ?>
	</div>

	<?php 
		endwhile; 
	endif;

	die();
}






/**
 * Load Search results
 */
add_action( 'wp_ajax_search', 'search' );
add_action( 'wp_ajax_nopriv_search', 'search' );

function search() {

	$keyword = $_POST['keyword'];

	$args = array(
		'post_type' => array('event', 'post', 'page'),
		's' => $keyword,
		'posts_per_page' 	=> '10',
	);

	$ajax_query = new WP_Query($args);


	if ( $ajax_query->have_posts() ) : ?>

		<h2 class="h2">Il y a <span><?php echo $ajax_query->found_posts; ?></span> résultat<?php if( $ajax_query->found_posts > 1 ) : echo 's'; endif; ?> pour la recherche <em><?php echo $keyword; ?></em></h2>

		<?php if( $ajax_query->found_posts > 10 ) : ?>
			<p>Voici les 10 premiers...</p>
		<?php endif; ?>
		
		<div id="webmag-innergrid" data-columns class="row">
		<?php while ( $ajax_query->have_posts() ) : $ajax_query->the_post();
			
			$post_type = get_post_type(); 

				switch ($post_type) {
					case 'event':
						get_template_part( 'template-parts/blocs/bloc', 'event' );
						break;

					case 'post':
						get_template_part( 'template-parts/blocs/bloc', 'article' );
						break;

					case 'page':
						get_template_part( 'template-parts/blocs/bloc', 'page' );
						break;

					default:
						get_template_part( 'template-parts/blocs/bloc', 'page' );
						break;
				}

		endwhile; ?>
		</div>
		
		<div class="row">
			<a href="/?s=<?php echo $keyword ?>" class="btn--big is-centered">Voir tous les résulats</a>
		</div>
	<?php endif;

	die();
}







/**
 * Get posts filtered by term
 */
add_action( 'wp_ajax_get_posts_from_term', 'get_posts_from_term' );
add_action( 'wp_ajax_nopriv_get_posts_from_term', 'get_posts_from_term' );

function get_posts_from_term() {

	$term = $_POST['term'];

	if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
	elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
	else { $paged = 1; }

	$args = array(
	    'post_type' 			=>'post',
	    'category_name' 	=> $term,
			'order'						=> 'DESC',
			'posts_per_page'	=> '12',
			'paged'						=> $paged		
	);

	$ajax_query = new WP_Query($args);

 	if ( $ajax_query->have_posts() ) : ?>
 		<div id="webmag-innergrid" data-columns class="row">
			<?php while ( $ajax_query->have_posts() ) : $ajax_query->the_post(); 
	 		get_template_part( 'template-parts/blocs/bloc', 'article' );
			endwhile; ?>
		</div>
		
	<?php else : 
		get_template_part( 'content', 'none' ); 

	endif; 

		lavantseine_paging_nav(); 

	die();
}




/**
 * Get events filtered
 */
add_action( 'wp_ajax_get_events_filtered', 'get_events_filtered' );
add_action( 'wp_ajax_nopriv_get_events_filtered', 'get_events_filtered' );

function get_events_filtered() {

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();
	$previous_month = false;

	$rdv_value = $_POST['rdv_value'];
	$discipline_value = $_POST['discipline_value'];
	$public_value = $_POST['public_value'];
	$tarif_value = $_POST['tarif_value'];
	$is_archives_value = $_POST['is_archives_value'];
	$saison_value = $_POST['saison_value'];

	$args = array(
	   	'post_type' 			=> 'event',
			'posts_per_page' 	=> '18',
			'post_status'			=> 'publish', 
	   	'meta_key' 				=> 'eventDetail_first_date',
	   	'orderby' 				=> 'meta_value_num',
	   	'order' 					=> 'ASC',
	   	'meta_query' 			=> array(
	       	array(
	           'key' => 'eventDetail_last_date',
	           'value' => $today,
	           'compare' => '>=',
	        )
	    )
	);

	if( $is_archives_value === NULL ) {
		$args['order'] = 'DESC';
		$args['meta_query'] = array(
	       	array(
	           'key' 			=> 'eventDetail_last_date',
	           'value' 		=> $today,
	           'compare' 	=> '<=',
	        )
	    );
	}

	if( $saison_value !== 0 ) {
		$args['saison'] = $saison_value;
	}

	if( $rdv_value !== 0 ) {
		$args['rdv'] = $rdv_value;
	}

	if( $discipline_value !== 0 ) {
		$args['discipline'] = $discipline_value;
	}

	if( $public_value !== 0 ) {
		$args['public'] = $public_value;
	}

	if( $tarif_value !== 0 ) {
		$args['tarif'] = $tarif_value;
	}

	$ajax_query = new WP_Query($args);
	$previous_month = false;

	set_query_var('query', $ajax_query);
	set_query_var('previous_month', $previous_month);
	get_template_part('template-parts/loops/loop', 'events');

	die();
}




// CUSTOM EXCERPT LENGTH

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );




// CUSTOM MENU WALKER

class Microdot_Walker_Nav_Menu extends Walker_Nav_Menu {
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '<ul>';
    }

    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= '</ul>';
    }

    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $classes = array();
        if( !empty( $item->classes ) ) {
            $classes = (array) $item->classes;
        }

        $active_class = '';
        if( in_array('current-menu-item', $classes) ) {
            $active_class = ' class="active menu-item"';
        } else if( in_array('current-menu-parent', $classes) ) {
            $active_class = ' class="active-parent menu-item"';
        } else if( in_array('current-menu-ancestor', $classes) ) {
            $active_class = ' class="active-ancestor menu-item"';
        } else {
        		$active_class = ' class="menu-item"';
        }

        $url = '';
        if( !empty( $item->url ) ) {
            $url = $item->url;
        }

        $output .= '<li'. $active_class . '><a href="' . $url . '">' . $item->title . '</a></li>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        $output .= '</li>';
    }
}




// Add ACCORDEON Shortcode

function accordeon_shortcode( $atts , $content = null ) {

	// Attributes
	$atts = shortcode_atts(
		array(
			'titre' => 'Le titre de l\'accordéon ici',
		),
		$atts
	);
	$titre = $atts['titre'];

  $return_string = '<div class="entry-accordeon close">'; 

   	$return_string .= '<div class="accordeon-title"><h3 class="h3">'.$titre.'</h3><span class="icon-fleche_accordeon"></span></div>';
   	$return_string .= '<div class="accordeon-content">'; 

   	$return_string .= $content; 
   	$return_string .= '</div>'; 
  
   $return_string .= '</div>'; 

   return $return_string;


}
add_shortcode( 'accordeon', 'accordeon_shortcode' );


 // init process for registering our button
 add_action('init', 'wpse72394_shortcode_button_init');
 function wpse72394_shortcode_button_init() {

      //Abort early if the user will never see TinyMCE
      if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') && get_user_option('rich_editing') == 'true')
           return;

      //Add a callback to regiser our tinymce plugin   
      add_filter("mce_external_plugins", "wpse72394_register_tinymce_plugin"); 

      // Add a callback to add our button to the TinyMCE toolbar
      add_filter('mce_buttons', 'wpse72394_add_tinymce_button');
}


//This callback registers our plug-in
function wpse72394_register_tinymce_plugin($plugin_array) {
    $plugin_array['accordeon'] = get_template_directory_uri() . '/assets/js/accordeon.js';
    return $plugin_array;
}

//This callback adds our button to the toolbar
function wpse72394_add_tinymce_button($buttons) {
            //Add the button ID to the $button array
    $buttons[] = "accordeon";
    return $buttons;
}
