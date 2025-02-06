<?php


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}


function rubismecenat_acf_load_json($paths){
    $paths = array(
        ODY_PATH . '/acf-json'
    );
    return $paths;
}

function rubismecenat_acf_save_json($paths) {
    $paths = ODY_PATH . '/acf-json';
    return $paths;
}


add_filter('acf/settings/save_json', 'rubismecenat_acf_save_json');
add_filter('acf/settings/load_json', 'rubismecenat_acf_load_json');

add_filter('acf/save_post', function ($post_id) {
    $format = function (&$date) {
        $tmp = sanitize_text_field($date);
        if (!empty($tmp)) {
            preg_match('~(\d{4})(\d{2})(\d{2})~', $tmp, $match);
            array_shift($match);
            $date = implode('-', $match);
        }
    };

}, 1, 1);



