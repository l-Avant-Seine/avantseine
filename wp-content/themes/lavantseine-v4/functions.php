<?php
/**
 * l\'Avant-Seine v2.0 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package l\'Avant-Seine_v2.0
 */


define('FB_URL','https://www.facebook.com/lAvantSeine');
define('TWITTER_URL','https://x.com/AvantSeine');
define('INSTAGRAM_URL','http://instagram.com/avantseine');
define('TIKTOK_URL','https://www.tiktok.com/@avantseine?lang=fr');
define('LINKEDIN_URL','https://www.linkedin.com/company/l\'avant-seine-th%C3%A9%C3%A2tre-de-colombes/');
define('GOOGLEPLUS_URL','https://plus.google.com/u/0/b/100144920076066761502/100144920076066761502');
define('VIDEOCHANNEL_URL','https://www.youtube.com/channel/UCtUb1swrX34VbClR53YcagA');
define('RESERVATION_URL','https://lavant-seine.mapado.com/');



function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');


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
function lavantseine_v4_setup() {

	load_theme_textdomain( 'lavantseine-v4', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	//add_image_size( 'box-thumbnail', 168, 9999 );
	add_image_size( 'homeslide', 1800, 9999 );
	add_image_size( 'featured-post-thumbnail', 578, 9999 );
	add_image_size( 'top-thumbnail', 779, 9999 );
	add_image_size( '2col-thumbnail', 369, 9999 );
	add_image_size( 'box-plain', 176, 350, array( 'center', 'center' ) );
	add_image_size( 'logo', 200, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Menu principal', 'lavantseine-v4' ),
		'top' => __( 'Menu supérieur', 'lavantseine-v4' ),
		'all' => __( 'Menu hamburger', 'lavantseine-v4' ),
		'footer' => __( 'Footer', 'lavantseine-v4' ),
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
}
endif;
add_action( 'after_setup_theme', 'lavantseine_v4_setup' );




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
		'name'          => __( 'Emplacements Footer ', 'lavantseine-v4' ),
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
function lavantseine_v4_scripts() {

	wp_enqueue_style( 'lavantseine-v4-style', get_template_directory_uri() . '/assets/main.min.css' );
	wp_enqueue_script( 'lavantseine-v4-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array('swiper'), '', true );

	wp_register_style( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css' );
	wp_register_script( 'swiper', 'https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js' , '', '', false );

	wp_register_style( 'plyr', get_template_directory_uri() . '/assets/js/lib/plyr/plyr.css' );
	wp_register_script( 'plyr', get_template_directory_uri() . '/assets/js/lib/plyr/js/plyr.js'  , '', '', array('in_footer' => false) );

	// ENQUEUE PARTICULAR SCRIPTS
	wp_add_inline_script( 'lavantseine-v4-scripts', 'const ajax_datas = ' . json_encode( array(
        'ajaxUrl' 	=> admin_url( 'admin-ajax.php' ),
        'nonce' 	=> wp_create_nonce( 'handle_contents_loading' )
    ) ), 'before' );


	if (is_admin()) return
    wp_dequeue_script( 'jquery');
    wp_deregister_script( 'jquery');   

}
add_action( 'wp_enqueue_scripts', 'lavantseine_v4_scripts' );



	
/**
 * Get events filtered
 */
add_action( 'wp_ajax_get_events', 'get_events' );
add_action( 'wp_ajax_nopriv_get_events', 'get_events' );

function get_events() {

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = new DateTime("today");  
	$today->modify('midnight'); 
	$today_ts = strtotime($today->format('Y-m-d H:i:s'));
	$today_formated = date('Y-m-d', $today_ts);

	$fmt_dayletter = datefmt_create(
		'fr_FR',
		IntlDateFormatter::FULL,
		IntlDateFormatter::FULL,
		'Europe/Paris',
		IntlDateFormatter::GREGORIAN,
		'ccc'
	);
	$fmt_daynbr = datefmt_create(
		'fr_FR',
		IntlDateFormatter::FULL,
		IntlDateFormatter::FULL,
		'Europe/Paris',
		IntlDateFormatter::GREGORIAN,
		'dd'
	);
	$fmt_month = datefmt_create(
		'fr_FR',
		IntlDateFormatter::FULL,
		IntlDateFormatter::FULL,
		'Europe/Paris',
		IntlDateFormatter::GREGORIAN,
		'MM'
	);
	//https://unicode-org.github.io/icu/userguide/format_parse/datetime/#datetime-format-syntax 


	$queryargs = array(
		'post_type' 			=> 'event',
		'posts_per_page' 		=> -1,
		'post_status'			=> 'publish', 
		'meta_key' 				=> 'eventDetail_first_date',
		'orderby' 				=> 'meta_value_num',
		'order' 				=> 'ASC',
		'meta_query' => array(
		   	array(
		       'key' => 'eventDetail_last_date',
		       'value' => $today_ts,
		       'compare' => '>=',
		    ) 
		)
	);

	$posts = get_posts( $queryargs ); 
	$dates = []; // array of timestamps 
	ob_start(); 
	
	
	// FORMAT AND SORT DATES ARRAY
	foreach ( $posts as $post ) :

		$event_first_date = get_field( 'eventDetail_first_date', $post->ID );
		$event_last_date = get_field( 'eventDetail_last_date', $post->ID );
		$event_other_dates = get_field('eventDetail_otherdates', $post->ID);

		if($event_first_date) { 

			$d = new DateTime( date('m/d/Y', $event_first_date) );
			$d->modify('midnight'); 
			$d_ts = strtotime($d->format('Y-m-d H:i:s'));
			$dates[ $event_first_date ] = array( 'id' => $post->ID, 'day_ts' => strval($d_ts));
		}

		if( $event_other_dates ) {
			foreach( $event_other_dates as $o) {
				if( isset($o['date'])) {
					$d = new DateTime( date('m/d/Y', $o['date'] ) );
					$d->modify('midnight'); 
					$d_ts = strtotime($d->format('Y-m-d H:i:s'));
					$dates[ $o['date']  ] = array( 'id' => $post->ID, 'day_ts' => strval($d_ts) );
				}
			}
		}

		if( $event_last_date !== $event_first_date ) {
			if($event_last_date) {
				$d = new DateTime( date('m/d/Y', $event_last_date) );
				$d->modify('midnight'); 
				$d_ts = strtotime($d->format('Y-m-d H:i:s'));
				$dates[ $event_last_date ] = array( 'id' => $post->ID, 'day_ts' => strval($d_ts) );		
			}
		}

	endforeach; wp_reset_query(); ksort($dates); //var_dump($dates); ?>


	<!-- DISPLAY CALENDAR DAYS  --> 

		<div class="swiper-dates flex --jstf --hcentered --gap-s mb-large">

                <div class="dates-btn-prev">
                    <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
                </div>

                <div class="swiper-wrapper">

					<?php 
					$j = 0; 
					$last_date_in_array = end( $dates );
					$last_date_in_array = $last_date_in_array['day_ts'];

					for ( $i = 0 ; $i < 365 ; $i++ ) {

						$current_day_ts = strtotime(  $today_formated . ' +' . $i . ' day');
						$current_day_formated = date('Y-m-d', $current_day_ts);
						$current_day_letter = datefmt_format($fmt_dayletter, $current_day_ts);
						$current_day_nbr = datefmt_format($fmt_daynbr, $current_day_ts);
						$current_month = datefmt_format($fmt_month, $current_day_ts);
						$current_year = datefmt_format($fmt_dayletter, $current_day_ts); 

						$day_exist_in_array = false;
						$occurrence = 0;
						foreach( $dates as $key => $d) {

							$event_exact_ts = new DateTime( date('m/d/Y', $key) );
							$event_exact_ts->modify('midnight'); 
							$event_midnight_ts = strtotime($event_exact_ts->format('Y-m-d H:i:s'));

							if( $current_day_ts == $event_midnight_ts ) { 
								$occurrence++;
								$day_exist_in_array = true; 
							}
						} 
						?>
						
						<div data-index="<?php if( $day_exist_in_array ) { echo $j; } ?>" class="swiper-slide date <?php if( ! $day_exist_in_array ) echo 'inactive'; ?>"  data-date="<?php echo $current_day_formated; ?>">
							<div class="inner flex --col --centered ">
								<?php // echo $current_ts; ?>
								<span class="meta"><?php echo $current_day_letter; ?></span>
								<span class="h3"><?php echo $current_day_nbr; ?>.<?php echo $current_month; ?></span>
							</div>
						</div>

						
					<?php if( $current_day_ts == $last_date_in_array ) break; 
					$j = $j + $occurrence;

				} ?>
					
				</div>

				<div class="dates-btn-next">
                    <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                </div>

		</div>



	<!-- DISPLAY EVENTS  --> 

		<div class="mod_title">
            <h2 class="h2">Calendrier</h2>
        </div>

		<div class="swiper-calendar">

			<div class="cal-btn-prev">
                    <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
            </div>

            <div class="swiper-wrapper">

				<?php foreach ( $dates as $key => $d ) :  ?>

					<div class="swiper-slide" data-postdate="<?php echo $key; ?>" data-postid="<?php echo $d['id']; ?>">
						<?php get_template_part('Components/blocs/bloc', 'event', array('post' => $d['id'], 'date' => $key )); ?>
					</div>

				<?php endforeach; wp_reset_query();?>
				
			</div>

			<div class="cal-btn-next">
                <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
			</div>
        </div><!-- .swiper-container -->




	<?php 
	    $content = ob_get_clean();
    	wp_send_json_success( $content );
		die();
}





// CUSTOM EXCERPT LENGTH

function custom_excerpt_length( $length ) {
	return 60;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );






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

  $return_string = '<div class="entry-accordeon">'; 

   	$return_string .= '<div class="accordeon-title flex --gap-xs"><h3 class="h_3 btn-inline">'.$titre.'</h3><span><svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.0457 0.353516L7.19922 7.19995L0.352783 0.353516" stroke="#000"/></svg></span></div>';
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





// add_filter( 'wp_nav_menu_objects',      't5_add_has_children_to_nav_items' );
// add_filter( 'walker_nav_menu_start_el', 't5_unlink_parent_item', 10, 4 );

/**
 * Add aproperty 'has_children' to menu items
 *
 * @wp-hook wp_nav_menu_objects
 * @param   array $items
 * @return  array
 */
function t5_add_has_children_to_nav_items( $items )
{
    $parents = wp_list_pluck( $items, 'menu_item_parent' );
    $out     = array ();

    foreach ( $items as $item )
    {
        in_array( $item->ID, $parents ) && $item->has_children = TRUE;
        $out[] = $item;
    }
    return $items;
}
/**
 * Replace top parent element markup.
 *
 * @wp-hook walker_nav_menu_start_el
 * @param   string $item_output
 * @param   object $item
 * @param   int    $depth
 * @param   object $args
 * @return  string
 */
function t5_unlink_parent_item( $item_output, $item, $depth, $args )
{
    // not first level parent item
    if ( empty ( $item->has_children ) or 0 != $item->menu_item_parent )
        return $item_output;

    $title = apply_filters(
        'the_title',
        $item->title,
        $item->ID
    );
    $id = apply_filters(
        'nav_menu_item_id',
        'menu-item-'. $item->ID,
        $item, $args
    );
    $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = 'has-children';
    $class_names = join(
        ' ',
        apply_filters(
            'nav_menu_css_class',
            array_filter( $classes ),
            $item,
            $args
        )
    );
    $class_names = $class_names
        ? ' class="' . esc_attr( $class_names ) . '"'
        : '';

    return "<li$id>$args->before<a class='menu-item has-children'>$title</a>$args->after";
}


