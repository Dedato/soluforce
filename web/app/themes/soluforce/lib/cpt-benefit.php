<?php
  
namespace Dedato\SoluForce\PostTypes\Benefit;

/* ==========================================================================
   Custom Post Type Benefit
   ========================================================================== */

/* Post Type */     
function benefit_init() {
	register_post_type('benefit', array(
		'hierarchical'        => false,
		'public'              => true,
    'exclude_from_search' => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'menu_position'		    => 29,
		'supports'            => array('title', 'editor', 'excerpt'),
		'has_archive'         => 'benefits',
		'query_var'           => true,
		'rewrite'             => array('slug' => 'benefit'),
		'labels'              => array(
			'name'                => __( 'Benefits' ),
			'singular_name'       => __( 'Benefit' ),
			'add_new'             => __( 'New benefit' ),
			'all_items'           => __( 'All benefits' ),
			'add_new_item'        => __( 'New benefit' ),
			'edit_item'           => __( 'Edit benefit' ),
			'new_item'            => __( 'New benefit' ),
			'view_item'           => __( 'View benefit' ),
			'search_items'        => __( 'Search benefits' ),
			'not_found'           => __( 'No benefits found' ),
			'not_found_in_trash'  => __( 'No benefits found in trash' ),
			'parent_item_colon'   => __( 'Parent benefit' ),
			'menu_name'           => __( 'Benefits' ),
		),
	));
}

/* Messages */
function benefit_updated_messages( $messages ) {
  global $post;
	$permalink = get_permalink($post);
	$messages['benefit'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Benefit updated. <a target="_blank" href="%s">View benefit</a>', 'soluforce'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'soluforce'),
		3 => __('Custom field deleted.', 'soluforce'),
		4 => __('Benefit updated.', 'soluforce'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Benefit restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Benefit published. <a href="%s">View benefit</a>', 'soluforce'), esc_url( $permalink ) ),
		7 => __('Benefit saved.', 'soluforce'),
		8 => sprintf( __('Benefit submitted. <a target="_blank" href="%s">Preview benefit</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Benefit scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview benefit</a>', 'soluforce'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
    10 => sprintf( __('Benefit draft updated. <a target="_blank" href="%s">Preview benefit</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);
	return $messages;
}

/* Posts per page */
function benefit_ppp_archive( $query ) {
	if( $query->is_main_query() && $query->is_post_type_archive('benefit') ) {
		$query->set( 'posts_per_page', 12 );
	}
}

add_action( 'init', __NAMESPACE__ . '\\benefit_init' );
add_filter( 'post_updated_messages', __NAMESPACE__ . '\\benefit_updated_messages' );
add_filter( 'pre_get_posts', __NAMESPACE__ . '\\benefit_ppp_archive' );