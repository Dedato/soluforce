<?php
$data                       = Timber::get_context();
$post                       = Timber::query_post();
$data['post']               = $post;

// Solution
if (is_singular('solution')) :
  // Get header image
  $data['header_img']   = get_field('acf_solution_image');
  // Get connected cases
  if (get_field('acf_solution_products')):
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
  endif;
  $data['data_sheet']   = get_field('acf_solution_data_sheet');
  // Get connected products
  $product_ids  = get_field('acf_solution_products', false, false);
  if ($product_ids) :
    $product_args = array(
      'post_type'       => 'product',
      'post__in'		    => $product_ids,
      'orderby'         => 'post__in',
      'posts_per_page'	=> -1
    );
    $data['products'] = Timber::get_posts($product_args);
  endif;
// Case  
elseif (is_singular('case')):
  // Get header image
  $data['header_img']   = get_field('acf_case_image');
  $data['header_title'] = true;
  // Get connected solutions
  $solutions_ids  = get_field('acf_case_solutions', false, false);
  if ($solutions_ids) :
    $solutions_args = array(
      'post_type'       => 'solution',
      'post__in'		    => $solutions_ids,
      'orderby'         => 'post__in',
      'posts_per_page'	=> -1
    );
    $data['solutions'] = Timber::get_posts($solutions_args);
  endif;
endif;

Timber::render(array( 'single-' . $post->post_type . '.twig', 'page.twig' ), $data);