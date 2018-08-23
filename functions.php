<?php

/*

PPS PROPERTY DATABASE Theme Functions
Author: Kay Belardinelli
URL: http://kangabell.co

*/

/*********************
ENQUEUEING
*********************/

function ppsdb_scripts_and_styles() {

    // Theme Styles
    wp_enqueue_style( 'ppsdb-stylesheet',
        get_stylesheet_directory_uri() . '/library/stylesheets/screen.css',
        array( 'ppsri-stylesheet' ),
        wp_get_theme()->get('Version')
    );

    // Theme Scripts
    wp_enqueue_script( 'ppsdb-js', get_stylesheet_directory_uri() . '/library/scripts/scripts.js', array( 'jquery' ), '', true );

    // Foundation scripts
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/node_modules/foundation-sites/js/foundation.core.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'foundation-keyboard-js', get_template_directory_uri() . '/node_modules/foundation-sites/js/foundation.util.keyboard.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'foundation-mediaquery-js', get_template_directory_uri() . '/node_modules/foundation-sites/js/foundation.util.mediaQuery.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'foundation-accordion-js', get_template_directory_uri() . '/node_modules/foundation-sites/js/foundation.accordion.js', array( 'jquery' ), '', true );

}

add_action('wp_enqueue_scripts', 'ppsdb_scripts_and_styles', 999);


// Remove Waypoints js
function ppsdb_remove_waypoints() {
  wp_dequeue_script( 'waypoints' );
  wp_deregister_script( 'waypoints' );

  wp_dequeue_script( 'ppsri-waypoints-js' );
  wp_deregister_script( 'ppsri-waypoints-js' );
}

add_action( 'wp_print_scripts', 'ppsdb_remove_waypoints' );


/*********************
FUNCTIONS
*********************/

function ppsdb_acf_google_map_api( $api ){

    $api['key'] = 'AIzaSyDIqb19OYrLxZvikR_yVnPTDnhsCsP0vtA';

    return $api;

}

add_filter('acf/fields/google_map/api', 'ppsdb_acf_google_map_api');



?>
