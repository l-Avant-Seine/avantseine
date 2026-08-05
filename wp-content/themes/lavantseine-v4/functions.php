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
	wp_register_script( 'plyr',  'https://cdn.plyr.io/3.8.4/plyr.polyfilled.js'  , '', '', array('in_footer' => false) );

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

    $title = $_REQUEST["title"];

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
	$fmt_month_full = datefmt_create(
		'fr_FR',
		IntlDateFormatter::FULL,
		IntlDateFormatter::FULL,
		'Europe/Paris',
		IntlDateFormatter::GREGORIAN,
		'LLLL'
	);
	$fmt_year = datefmt_create(
		'fr_FR',
		IntlDateFormatter::FULL,
		IntlDateFormatter::FULL,
		'Europe/Paris',
		IntlDateFormatter::GREGORIAN,
		'YYYY'
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

		if( $event_first_date ) { 
			$d = new DateTime( date('m/d/Y', $event_first_date) );
			$d->modify('midnight'); 
			$d_ts = strtotime($d->format('Y-m-d H:i:s'));
			$dates[ $event_first_date ] = array( 'id' => $post->ID, 'day_ts' => strval($d_ts));
		}

		if( is_array( $event_other_dates ) ) {
			foreach( $event_other_dates as $o) {
				if( isset($o['date']) && $o['date'] !== '' ) {
					$unixtimestamp = strtotime($o['date']);
					$d = new DateTime( date('m/d/Y',  $unixtimestamp) );
					$d->modify('midnight'); 
					$d_ts = strtotime($d->format('Y-m-d H:i:s'));
					$dates[ $unixtimestamp  ] = array( 'id' => $post->ID, 'day_ts' => strval($d_ts) );
				}
			}
		}

		if( $event_last_date && $event_last_date !== $event_first_date ) {
			$d = new DateTime( date('m/d/Y', $event_last_date) );
			$d->modify('midnight'); 
			$d_ts = strtotime($d->format('Y-m-d H:i:s'));
			$dates[ $event_last_date ] = array( 'id' => $post->ID, 'day_ts' => strval($d_ts) );		
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
					$previous_month = 0; 
					$last_date_in_array = end( $dates );
					if( $last_date_in_array ) {
						$last_date_in_array = $last_date_in_array['day_ts'];
					}
					else {
						$last_date_in_array = '';
					}

					for ( $i = 0 ; $i < 365 ; $i++ ) {

						$current_day_ts = strtotime(  $today_formated . ' +' . $i . ' day');
						$current_day_formated = date('Y-m-d', $current_day_ts);
						$current_day_letter = datefmt_format($fmt_dayletter, $current_day_ts);
						$current_day_nbr = datefmt_format($fmt_daynbr, $current_day_ts);
						$current_month_full = datefmt_format($fmt_month_full, $current_day_ts);
						$current_month = datefmt_format($fmt_month, $current_day_ts);
						$current_year = datefmt_format($fmt_year, $current_day_ts);

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
						
						<?php if( $previous_month  !== $current_month_full ) { ?>
							<div class="swiper-slide month">
								<div class="inner flex --col --vcentered">
									<span class="h3"><?php echo $current_month_full; ?></span><br>
									<span class="h3"><?php echo $current_year; ?></span>
								</div>
							</div>
						<?php } ?>
						
						<div data-index="<?php if( $day_exist_in_array ) { echo $j; } ?>" class="swiper-slide date <?php if( ! $day_exist_in_array ) echo 'inactive'; ?>"  data-date="<?php echo $current_day_formated; ?>">
							<div class="inner flex --col --centered ">
								<?php // echo $current_ts; ?>
								<span class="meta"><?php echo $current_day_letter; ?></span>
								<span class="h3"><?php echo $current_day_nbr; ?></span>
							</div>
						</div>

						
					<?php if( $current_day_ts == $last_date_in_array ) break; 
					$j = $j + $occurrence;
					$previous_month = $current_month_full;
				} ?>
					
				</div>

				<div class="dates-btn-next">
                    <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                </div>

		</div>



	<!-- DISPLAY EVENTS  --> 

		<div class="swiper-calendar">

			<div class="flex --gap-m mb-medium">
				<div class="mod_title">
					<h2 class="h2"><?php echo  $title; ?></h2>
				</div>

				<div class="cal-nav flex --gap-xs">
					<div class="cal-btn-prev">
						<?php get_template_part('Components/svgs/svg', 'arrow-left-short'); ?>
					</div>
					<div class="cal-btn-next">
						<?php get_template_part('Components/svgs/svg', 'arrow-short'); ?> 
					</div>
				</div>

			</div>

            <div class="swiper-wrapper">

				<?php foreach ( $dates as $key => $d ) : if( is_array( $d ) ) :  ?>

					<div class="swiper-slide" data-postdate="<?php echo $key; ?>" data-postid="<?php echo $d['id']; ?>">
						<?php get_template_part('Components/blocs/bloc', 'event', array('post' => $d['id'], 'date' => $key )); ?>
					</div>

				<?php endif; endforeach; wp_reset_query();?>
				
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

   	$return_string .= '<div class="accordeon-title flex --gap-xs"><h3 class="h_3 title">'.$titre.'</h3><span><svg width="15" height="8" viewBox="0 0 15 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.0457 0.353516L7.19922 7.19995L0.352783 0.353516" stroke="#000"/></svg></span></div>';
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





add_action('admin_init', function () {
    // Redirect any user trying to access comments page
    global $pagenow;
     
    if ($pagenow === 'edit-comments.php') {
        wp_safe_redirect(admin_url());
        exit;
    }
 
    // Remove comments metabox from dashboard
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
 
    // Disable support for comments and trackbacks in post types
    foreach (get_post_types() as $post_type) {
        if (post_type_supports($post_type, 'comments')) {
            remove_post_type_support($post_type, 'comments');
            remove_post_type_support($post_type, 'trackbacks');
        }
    }
});
 
// Close comments on the front-end
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);
 
// Hide existing comments
add_filter('comments_array', '__return_empty_array', 10, 2);
 
// Remove comments page in menu
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
});
 
// Remove comments links from admin bar
add_action('init', function () {
    if (is_admin_bar_showing()) {
        remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
    }
});


	function search_filter($query) {
		if ( !is_admin() && $query->is_main_query() ) {
			if ($query->is_search) {
			$query->set('post_type', array( 'post', 'event', 'page' ) );
			$query->set('post_status', 'publish' );
			$query->set('orderby', 'date' );
			$query->set('order', 'DESC' );
			}
		}
	}
add_action('pre_get_posts','search_filter');



add_filter( 'rest_enabled', '__return_false' );
add_filter( 'rest_jsonp_enabled', '__return_false' );