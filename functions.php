<?php

/*

PPS PROPERTY DATABASE Theme Functions
Author: Kay Belardinelli
URL: https://kangabell.co

Standalone theme (2026). Functions formerly inherited from the
PPS 2017 parent theme (pps-2017) are merged in below.

*/

/*
  Google API key instructions:
    Go to: console.cloud.google.com
    Log in with the jhogue@ppsri.org account
    In the top navigation, open the project selector — if multiple projects exist, check each one
    Go to APIs & Services → Credentials
    Look for an API key that matches PPSDB_GOOGLE_MAPS_API_KEY — the last few characters will be visible for comparison
*/

function ppsdb_google_maps_key() {
  return defined( 'PPSDB_GOOGLE_MAPS_API_KEY' ) ? PPSDB_GOOGLE_MAPS_API_KEY : '';
}

/*********************
BASICS & CLEANUP
(formerly in the pps-2017 parent theme)
*********************/

// set maximum allowed width for content
if ( ! isset( $content_width ) ) {
  $content_width = 1400;
}

// remove WP version from RSS
function ppsdb_rss_version() { return ''; }
add_filter( 'the_generator', 'ppsdb_rss_version' );

// remove injected CSS from gallery
function ppsdb_gallery_style( $css ) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}
add_filter( 'gallery_style', 'ppsdb_gallery_style' );

// remove p tags from category description
remove_filter( 'term_description', 'wpautop' );

// remove the p from around imgs & blockquotes (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function ppsdb_filter_ptags_on_images( $content ) {
  return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}
add_filter( 'the_content', 'ppsdb_filter_ptags_on_images' );

function ppsdb_filter_ptags_on_blockquotes( $content ) {
  return preg_replace( '|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $content );
}
add_filter( 'the_content', 'ppsdb_filter_ptags_on_blockquotes' );

// Change "[...]more>>" to "..."
function ppsdb_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'ppsdb_excerpt_more' );


/*********************
ENQUEUEING
*********************/

function ppsdb_scripts_and_styles() {

    if ( is_admin() ) {
      return;
    }

    $theme_dir = get_stylesheet_directory();
    $theme_uri = get_stylesheet_directory_uri();

    // Theme Styles (single compiled stylesheet; no parent dependency)
    wp_enqueue_style(
      'ppsdb-stylesheet',
      $theme_uri . '/library/stylesheets/screen.css',
      array(),
      filemtime( $theme_dir . '/library/stylesheets/screen.css' )
    );

    // Theme Scripts (nav, searchbar and equalize were in the parent theme)
    wp_enqueue_script( 'modernizr-mq', $theme_uri . '/library/scripts/vendor/modernizr-mq.min.js', array( 'jquery' ), '', false );
    wp_enqueue_script( 'ppsdb-nav-js', $theme_uri . '/library/scripts/nav.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'ppsdb-searchbar-js', $theme_uri . '/library/scripts/searchbar.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'ppsdb-equalize-and-expand-js', $theme_uri . '/library/scripts/equalize-and-expand.js', array( 'jquery' ), '', true );
    wp_enqueue_script( 'ppsdb-js', $theme_uri . '/library/scripts/scripts.js', array( 'jquery' ), '', true );

    // Google Maps scripts
    // conditional here because Property needs `callback=initMap` and Tour doesn't
    if ( is_singular('property') ) {
      wp_enqueue_script('googlemaps-js', 'https://maps.googleapis.com/maps/api/js?key=' . ppsdb_google_maps_key() . '&callback=initMap', array(), '', true);
    } elseif ( is_singular('tour') ) {
      wp_enqueue_script('googlemaps-js', 'https://maps.googleapis.com/maps/api/js?key=' . ppsdb_google_maps_key(), array(), '', true);
    }

    // Foundation scripts (vendored from foundation-sites 6.3.0; previously loaded from the parent theme's node_modules)
    $foundation = $theme_uri . '/library/scripts/vendor/foundation/';
    wp_enqueue_script( 'foundation-js', $foundation . 'foundation.core.js', array( 'jquery' ), '6.3.0', true );
    wp_enqueue_script( 'foundation-keyboard-js', $foundation . 'foundation.util.keyboard.js', array( 'foundation-js' ), '6.3.0', true );
    wp_enqueue_script( 'foundation-box-js', $foundation . 'foundation.util.box.js', array( 'foundation-js' ), '6.3.0', true );
    wp_enqueue_script( 'foundation-nest-js', $foundation . 'foundation.util.nest.js', array( 'foundation-js' ), '6.3.0', true );
    wp_enqueue_script( 'foundation-mediaquery-js', $foundation . 'foundation.util.mediaQuery.js', array( 'foundation-js' ), '6.3.0', true );
    wp_enqueue_script( 'foundation-dropdownmenu-js', $foundation . 'foundation.dropdownMenu.js', array( 'foundation-js' ), '6.3.0', true );

    // AddThis share widget
    // NOTE: AddThis was discontinued in 2023; this script no longer loads. Replace or remove.
    wp_enqueue_script( 'addthis-js', '//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5b97face49653134' );

}

add_action('wp_enqueue_scripts', 'ppsdb_scripts_and_styles', 999);


/*********************
THEME SUPPORT
*********************/

function ppsdb_theme_support() {

  // rss
  add_theme_support( 'automatic-feed-links' );

  // wp menus
  add_theme_support( 'menus' );

  // Menu locations keep the parent theme's slugs so existing assignments carry over
  register_nav_menus(
    array(
      'primary-nav'   => __( 'Primary Navigation', 'ppsdb' ),
      'secondary-nav' => __( 'Secondary Navigation', 'ppsdb' )
    )
  );

  // featured images
  add_theme_support( 'post-thumbnails' );

  // image sizes (grid-thumb was 680x295 in the parent, overridden to 680x340 here)
  add_image_size( 'grid-thumb', 680, 340, array( 'center', 'center' ) );
  add_image_size( 'squarish', 680, 500, array( 'center', 'center' ) );

}
add_action( 'after_setup_theme', 'ppsdb_theme_support' );


/*********************
MENUS & NAVIGATION
*********************/

// main nav: primary
function ppsdb_primary_nav() {
  wp_nav_menu( array(
    'menu'           => __( 'Primary Navigation', 'ppsdb' ),
    'container'      => false,
    'theme_location' => 'primary-nav',
    'depth'          => 1,
  ) );
}

// main nav: secondary
function ppsdb_secondary_nav() {
  wp_nav_menu( array(
    'menu'           => __( 'Secondary Navigation', 'ppsdb' ),
    'container'      => false,
    'theme_location' => 'secondary-nav',
    'depth'          => 1,
  ) );
}


/************* MODIFIED TITLE ********************/
// makes a nicely formatted title to go in the head of the document

function ppsdb_wp_title( $title, $sep ) {
  if ( is_feed() ) {
    return $title;
  }

  // Add the site name.
  $title .= get_bloginfo( 'name' );

  // Add the site description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }

  return $title;
}
add_filter( 'wp_title', 'ppsdb_wp_title', 10, 2 );


/************* SIDEBARS / WIDGET AREAS ********************/
// IDs match the parent theme so existing widget assignments carry over

function ppsdb_register_sidebars() {
  register_sidebar( array(
    'id'            => 'sidebar',
    'name'          => __( 'Sidebar', 'ppsdb' ),
    'description'   => __( 'The sidebar for the blog and archive pages.', 'ppsdb' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ) );
  register_sidebar( array(
    'id'            => 'address',
    'name'          => __( 'Address', 'ppsdb' ),
    'description'   => __( 'The address in the footer', 'ppsdb' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
  register_sidebar( array(
    'id'            => 'contact-info',
    'name'          => __( 'Contact Info', 'ppsdb' ),
    'description'   => __( 'The contact info in the footer', 'ppsdb' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
  register_sidebar( array(
    'id'            => 'social',
    'name'          => __( 'Social Links', 'ppsdb' ),
    'description'   => __( 'The social media links in the footer', 'ppsdb' ),
    'before_widget' => '',
    'after_widget'  => '',
  ) );
}
add_action( 'widgets_init', 'ppsdb_register_sidebars' );


/*********************
FUNCTIONS
*********************/

/************* GOOGLE MAPS API *****************/

function ppsdb_acf_google_map_api( $api ) {

  $api['key'] = ppsdb_google_maps_key();

  return $api;

}

add_filter('acf/fields/google_map/api', 'ppsdb_acf_google_map_api');


/************* CUSTOM TOUR QUERY VAR *****************/

function ppsdb_add_query_vars_filter( $vars ) {
  $vars[] = 't';
  return $vars;
}
add_filter( 'query_vars', 'ppsdb_add_query_vars_filter' );


/************* ADD CUSTOM POST TYPES TO TAGS ARCHIVE *****************/
/** src: https://docs.pluginize.com/article/17-post-types-in-category-tag-archives **/

function ppsdb_cpt_tags_archive( $query ) {

  if ( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  // requires the Custom Post Type UI plugin
  if ( ! function_exists( 'cptui_get_post_type_slugs' ) ) {
    return;
  }

  if ( is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $cptui_post_types = cptui_get_post_type_slugs();

    $query->set(
      'post_type',
      array_merge(
        array( 'post' ),
        $cptui_post_types
      )
    );
  }
}
add_filter( 'pre_get_posts', 'ppsdb_cpt_tags_archive' );


/************* CUSTOM SEARCH FORM *****************/

function ppsdb_wpsearch( $form ) {
  $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
  <input type="search" value="' . get_search_query() . '" name="s" id="s" placeholder="Search for properties and tours" />
  <button type="submit" class="primary">Search</button>
  </form>';
  return $form;
}

add_filter( 'get_search_form', 'ppsdb_wpsearch' );


/************* COMMENTS FORM *****************/
function ppsdb_comments_remove_fields( $fields ) {
  unset( $fields['url'] );
  unset( $fields['cookies'] );
  return $fields;
}

add_filter( 'comment_form_default_fields', 'ppsdb_comments_remove_fields' );


/************* SHORT VERSION OF EXCERPT *****************/
// used in partials/article-sm.php

function short_excerpt( $new_length = 20, $new_more = '...' ) {
  add_filter( 'excerpt_length', function () use ( $new_length ) {
    return $new_length;
  }, 999 );
  add_filter( 'excerpt_more', function () use ( $new_more ) {
    return $new_more;
  } );
  $output = get_the_excerpt();
  $output = apply_filters( 'wptexturize', $output );
  $output = apply_filters( 'convert_chars', $output );
  $output = '<p>' . $output . '</p>';
  echo $output;
}


/************* MODIFY CATEGORIES WIDGET OUTPUT *****************/

function ppsdb_cat_count( $links ) {

  // wrap the anchor with a span, remove the parentheses, and wrap the count with a span
  $links = str_replace( '<a', '<span class="name"><a', $links );
  $links = str_replace( '</a> (', '</a></span> <span class="count">', $links );
  $links = str_replace( ')', '</span>', $links );

  return $links;
}
add_filter( 'wp_list_categories', 'ppsdb_cat_count' );


/************* LIST CHILD PAGES *****************/
// used in sidebar-page.php

function ppsdb_list_child_pages() {

  global $post;

  $string = '';

  if ( is_page() && $post->post_parent ) {
    $childpages = wp_list_pages( 'sort_column=menu_order&depth=3&title_li=&child_of=' . $post->post_parent . '&echo=0' );
  } else {
    $childpages = wp_list_pages( 'sort_column=menu_order&depth=3&title_li=&child_of=' . $post->ID . '&echo=0' );
  }

  if ( $childpages ) {
    $string = '<ul class="pages-menu">' . $childpages . '</ul>';
  }

  return $string;
}
