<?php
  
namespace Dedato\SoluForce\PostTypes\Solution;

/* ==========================================================================
   Custom Post Type Solution
   ========================================================================== */

/* Post Type */     
function solution_init() {
	register_post_type('solution', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'menu_position'		    => 25,
		'supports'            => array('title', 'editor', 'excerpt', 'page-attributes'),
		'has_archive'         => false,
		'query_var'           => true,
		'rewrite'             => array('slug' => 'solution'),
		'labels'              => array(
			'name'                => __( 'Solutions' ),
			'singular_name'       => __( 'Solution' ),
			'add_new'             => __( 'New solution' ),
			'all_items'           => __( 'All solutions' ),
			'add_new_item'        => __( 'New solution' ),
			'edit_item'           => __( 'Edit solution' ),
			'new_item'            => __( 'New solution' ),
			'view_item'           => __( 'View solution' ),
			'search_items'        => __( 'Search solutions' ),
			'not_found'           => __( 'No solutions found' ),
			'not_found_in_trash'  => __( 'No solutions found in trash' ),
			'parent_item_colon'   => __( 'Parent solution' ),
			'menu_name'           => __( 'Solutions' ),
		),
	));
}

/* Messages */
function solution_updated_messages( $messages ) {
  global $post;
	$permalink = get_permalink($post);
	$messages['solution'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Solution updated. <a target="_blank" href="%s">View solution</a>', 'soluforce'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'soluforce'),
		3 => __('Custom field deleted.', 'soluforce'),
		4 => __('Solution updated.', 'soluforce'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Solution restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Solution published. <a href="%s">View solution</a>', 'soluforce'), esc_url( $permalink ) ),
		7 => __('Solution saved.', 'soluforce'),
		8 => sprintf( __('Solution submitted. <a target="_blank" href="%s">Preview solution</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Solution scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview solution</a>', 'soluforce'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
    10 => sprintf( __('Solution draft updated. <a target="_blank" href="%s">Preview solution</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);
	return $messages;
}

/* Posts per page */
function solution_ppp_archive( $query ) {
	if( $query->is_main_query() && $query->is_post_type_archive('solution') ) {
		$query->set( 'posts_per_page', 12 );
	}
}

add_action( 'init', __NAMESPACE__ . '\\solution_init' );
add_filter( 'post_updated_messages', __NAMESPACE__ . '\\solution_updated_messages' );
add_filter( 'pre_get_posts', __NAMESPACE__ . '\\solution_ppp_archive' );