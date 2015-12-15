<?php
/**
 * Template Name: Products
 */

$data                       = Timber::get_context();
$data['post']               = new TimberPost();
$data['products']           = Timber::get_posts(array(
  'post_type'   => 'product',
  'orderby'     => 'menu_order',
  'order'       => 'ASC',
  'nopaging'    => true
));
$data['solutions_products'] = Timber::get_posts(array(
  'post_type'   => 'solution',
  'meta_query'	=> array(
		'relation'	  => 'AND',
		array(
			'key'	 	      => 'acf_solution_products',
		),
	),
  'orderby'     => 'menu_order',
  'order'       => 'ASC',
  'nopaging'    => true
));

Timber::render('tmpl-products.twig', $data);