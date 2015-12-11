<?php

namespace Dedato\SoluForce\Extras;

use Dedato\SoluForce\Setup;

/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }

  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');


/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');


/**
 *  WPML cleanup
 */
define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
define('ICL_DONT_LOAD_LANGUAGES_JS', true);


/**
 *  ACF Options Page
 */
if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page(array(
		'page_title' 	=> 'SoluForce Options',
		'menu_title'	=> 'Options',
		'menu_slug' 	=> 'soluforce-options',
		'capability'	=> 'edit_posts',
		'redirect'		=> 'admin.php?page=acf-options-social-media'
	));
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Social Media Settings',
		'menu_title'	=> 'Social Media',
		'parent_slug'	=> 'soluforce-options',
	));
}


/**
 * Add extra filetypes to be allowed for upload
 */
 
add_filter('upload_mimes', __NAMESPACE__ . '\\custom_upload_mimes'); 
function custom_upload_mimes($existing_mimes = array()) {
	// add the file extension to the array
	$existing_mimes['svg'] = 'image/svg+xml';
	$existing_mimes['svgz'] = 'image/svg+xml';
	return $existing_mimes;
}


/* 
 * Split content at the more tag and return an array
 */
function split_more_content() {
  global $post;
  if( strpos( $post->post_content, '<!--more-->' ) ) {
    $content = preg_split('/<span id="more-\d+"><\/span>/i', get_the_content('more'));
    $ret     = '<div class="content_excerpt"><p>'. array_shift($content). '</p></div>';
    if (!empty($content)) $ret .= '<div class="content_more"><p>'. implode($content). '</p></div>';
    $ret .= '<div class="split_more_link"><a class="read-more" title="'. __('Read more', 'soluforce') .'" data-text-less="'. __('Read less', 'soluforce') .'">'. __('Read more', 'soluforce') .'</a></div>';
    return apply_filters('the_content', $ret);
  } else {
    return the_content();
  }  
}


/*
 * WP Login & Admin styling
 */
add_action('login_head', __NAMESPACE__ . '\\wp_custom_login'); 
function wp_custom_login() {
  echo '<link rel="stylesheet" type="text/css" href="' . \Dedato\SoluForce\Assets\asset_path('styles/wp.css') .'"/>';
}

// Change url logo Wordpress login page
add_filter('login_headerurl', __NAMESPACE__ . '\\wp_custom_login_url');
function wp_custom_login_url(){
	return (get_home_url());
}

// Custom style Wordpress dashboard
add_action('admin_head', __NAMESPACE__ . '\\wp_custom_admin');
function wp_custom_admin() { 
	echo '<link rel="stylesheet" type="text/css" href="'. \Dedato\SoluForce\Assets\asset_path('styles/wp.css') .'" />'; 
}


/*
 * This allows us to automatically empty the cache during deployments
 */
 
$ftppass = file_get_contents( get_template_directory() . '/.ftppass.json' );
$data    = json_decode($ftppass);
$secret  = $data->secretkey;

if (!empty($_GET['w3tcEmptyCache']) && $_GET['w3tcEmptyCache'] == $secret) {
  if (function_exists('w3tc_pgcache_flush')) {
    w3tc_pgcache_flush();
  }
  die('W3 Total Cache Cleared');
}