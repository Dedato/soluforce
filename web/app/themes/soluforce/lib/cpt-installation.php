<?php
  
namespace Dedato\SoluForce\PostTypes\Installation;

/* ==========================================================================
   Custom Post Type Installation
   ========================================================================== */

/* Post Type */     
function installation_init() {
	register_post_type('installation', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'menu_position'		    => 27,
		'supports'            => array('title', 'editor', 'page-attributes'),
		'has_archive'         => false,
		'query_var'           => true,
		'rewrite'             => array('slug' => 'installation'),
		'labels'              => array(
			'name'                => __( 'Installations' ),
			'singular_name'       => __( 'Installation' ),
			'add_new'             => __( 'New installation' ),
			'all_items'           => __( 'All installations' ),
			'add_new_item'        => __( 'New installation' ),
			'edit_item'           => __( 'Edit installation' ),
			'new_item'            => __( 'New installation' ),
			'view_item'           => __( 'View installation' ),
			'search_items'        => __( 'Search installations' ),
			'not_found'           => __( 'No installations found' ),
			'not_found_in_trash'  => __( 'No installations found in trash' ),
			'parent_item_colon'   => __( 'Parent installation' ),
			'menu_name'           => __( 'Installation' ),
		),
	));
}

/* Messages */
function installation_updated_messages( $messages ) {
  global $post;
	$permalink = get_permalink($post);
	$messages['installation'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Installation updated. <a target="_blank" href="%s">View installation</a>', 'soluforce'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'soluforce'),
		3 => __('Custom field deleted.', 'soluforce'),
		4 => __('Installation updated.', 'soluforce'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Installation restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Installation published. <a href="%s">View installation</a>', 'soluforce'), esc_url( $permalink ) ),
		7 => __('Installation saved.', 'soluforce'),
		8 => sprintf( __('Installation submitted. <a target="_blank" href="%s">Preview installation</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Installation scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview installation</a>', 'soluforce'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
    10 => sprintf( __('Installation draft updated. <a target="_blank" href="%s">Preview installation</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);
	return $messages;
}

/* Posts per page */
function installation_ppp_archive( $query ) {
	if( $query->is_main_query() && $query->is_post_type_archive('installation') ) {
		$query->set( 'posts_per_page', 12 );
	}
}

add_action( 'init', __NAMESPACE__ . '\\installation_init' );
add_filter( 'post_updated_messages', __NAMESPACE__ . '\\installation_updated_messages' );
add_filter( 'pre_get_posts', __NAMESPACE__ . '\\installation_ppp_archive' );