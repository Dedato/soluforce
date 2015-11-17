<?php
  
namespace Dedato\SoluForce\PostTypes\Cases;

/* ==========================================================================
   Custom Post Type Case
   ========================================================================== */

/* Post Type */     
function case_init() {
	register_post_type('case', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'menu_position'		    => 26,
		'supports'            => array('title', 'editor'),
		'has_archive'         => 'cases',
		'query_var'           => true,
		'rewrite'             => array('slug' => 'case'),
		'labels'              => array(
			'name'                => __( 'Cases' ),
			'singular_name'       => __( 'Case' ),
			'add_new'             => __( 'New case' ),
			'all_items'           => __( 'All cases' ),
			'add_new_item'        => __( 'New case' ),
			'edit_item'           => __( 'Edit case' ),
			'new_item'            => __( 'New case' ),
			'view_item'           => __( 'View case' ),
			'search_items'        => __( 'Search cases' ),
			'not_found'           => __( 'No cases found' ),
			'not_found_in_trash'  => __( 'No cases found in trash' ),
			'parent_item_colon'   => __( 'Parent case' ),
			'menu_name'           => __( 'Cases' ),
		),
	));
}

/* Messages */
function case_updated_messages( $messages ) {
  global $post;
	$permalink = get_permalink($post);
	$messages['case'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Case updated. <a target="_blank" href="%s">View case</a>', 'soluforce'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'soluforce'),
		3 => __('Custom field deleted.', 'soluforce'),
		4 => __('Case updated.', 'soluforce'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Case restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Case published. <a href="%s">View case</a>', 'soluforce'), esc_url( $permalink ) ),
		7 => __('Case saved.', 'soluforce'),
		8 => sprintf( __('Case submitted. <a target="_blank" href="%s">Preview case</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Case scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview case</a>', 'soluforce'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
    10 => sprintf( __('Case draft updated. <a target="_blank" href="%s">Preview case</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);
	return $messages;
}

/* Posts per page */
function case_ppp_archive( $query ) {
	if( $query->is_main_query() && $query->is_post_type_archive('case') ) {
		$query->set( 'posts_per_page', 12 );
	}
}

add_action( 'init', __NAMESPACE__ . '\\case_init' );
add_filter( 'post_updated_messages', __NAMESPACE__ . '\\case_updated_messages' );
add_filter( 'pre_get_posts', __NAMESPACE__ . '\\case_ppp_archive' );