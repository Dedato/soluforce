<?php
$data                       = Timber::get_context();
$post                       = Timber::query_post();
$data['post']               = $post;

if (is_singular('solution') && get_field('acf_solution_products')) :
  // Get connected cases
	$case_args = array(
		'post_type'   => 'case',
		'meta_query'  => array(
			array(
				'key'       => 'acf_case_solutions',
				'value'     => '"' . $post->ID . '"',
				'compare'   => 'LIKE'
			)
		)
	);
	$data['solution_cases'] = Timber::get_posts($case_args);
  // Get connected products
  $product_ids  = get_field('acf_solution_products', false, false);
  $product_args = array(
    'post_type'       => 'product',
    'post__in'		    => $product_ids,
    'orderby'         => 'post__in',
    'posts_per_page'	=> -1
  );
  $data['solution_products'] = Timber::get_posts($product_args);
endif;

Timber::render(array( 'single-' . $post->post_type . '.twig', 'single.twig' ), $data);