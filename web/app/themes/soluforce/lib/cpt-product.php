<?php
  
namespace Dedato\SoluForce\PostTypes\Product;

/* ==========================================================================
   Custom Post Type Product
   ========================================================================== */

/* Post Type */     
function product_init() {
	register_post_type('product', array(
		'hierarchical'        => false,
		'public'              => true,
		'show_in_nav_menus'   => true,
		'show_ui'             => true,
		'menu_position'		    => 28,
		'supports'            => array('title', 'editor', 'excerpt', 'page-attributes'),
		'has_archive'         => false,
		'query_var'           => true,
		'rewrite'             => array('slug' => 'product'),
		'labels'              => array(
			'name'                => __( 'Products' ),
			'singular_name'       => __( 'Product' ),
			'add_new'             => __( 'New product' ),
			'all_items'           => __( 'All products' ),
			'add_new_item'        => __( 'New product' ),
			'edit_item'           => __( 'Edit product' ),
			'new_item'            => __( 'New product' ),
			'view_item'           => __( 'View product' ),
			'search_items'        => __( 'Search products' ),
			'not_found'           => __( 'No products found' ),
			'not_found_in_trash'  => __( 'No products found in trash' ),
			'parent_item_colon'   => __( 'Parent product' ),
			'menu_name'           => __( 'Products' ),
		),
	));
}

/* Messages */
function product_updated_messages( $messages ) {
  global $post;
	$permalink = get_permalink($post);
	$messages['product'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Product updated. <a target="_blank" href="%s">View product</a>', 'soluforce'), esc_url( $permalink ) ),
		2 => __('Custom field updated.', 'soluforce'),
		3 => __('Custom field deleted.', 'soluforce'),
		4 => __('Product updated.', 'soluforce'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Product restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Product published. <a href="%s">View product</a>', 'soluforce'), esc_url( $permalink ) ),
		7 => __('Product saved.', 'soluforce'),
		8 => sprintf( __('Product submitted. <a target="_blank" href="%s">Preview product</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		9 => sprintf( __('Product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>', 'soluforce'),
		// translators: Publish box date format, see http://php.net/date
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
    10 => sprintf( __('Product draft updated. <a target="_blank" href="%s">Preview product</a>', 'soluforce'), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);
	return $messages;
}

/* Taxonomies */
function product_type_taxonomy() {
  $labels = array(
    'name'              => __('Product types'),
    'singular_name'     => __('Product type'),
    'search_items'      => __('Search product types'),
    'all_items'         => __('All product types'),
    'parent_item'       => __('Parent product type'),
    'parent_item_colon' => __('Parent product type:'),
    'edit_item'         => __('Edit product type'),
    'update_item'       => __('Update product type'),
    'add_new_item'      => __('New product type'),
    'new_item_name'     => __('New product type'),
    'menu_name'         => __('Product types')
  );
  $args = array(
    'labels'       		   => $labels,
    'public'             => true,
    'show_ui'      		   => true,
    'show_in_nav_menus'	 => true,
    'show_admin_column'	 => true,
    'hierarchical' 		   => true,
    'query_var'    		   => true,
    'rewrite'      		   => array('slug' => 'product') // Should be same as post type slug
  );
  register_taxonomy('product-type', 'product', $args);
}

/* Posts per page */
function product_ppp_archive( $query ) {
	if( $query->is_main_query() && $query->is_post_type_archive('product') ) {
		$query->set( 'posts_per_page', 12 );
	}
}

add_action( 'init', __NAMESPACE__ . '\\product_init' );
add_filter( 'post_updated_messages', __NAMESPACE__ . '\\product_updated_messages' );
add_action( 'init', __NAMESPACE__ . '\\product_type_taxonomy' );
add_filter( 'pre_get_posts', __NAMESPACE__ . '\\product_ppp_archive' );