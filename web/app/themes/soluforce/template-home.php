<?php
/**
 * Template Name: Homepage
 */

$data              = Timber::get_context();
$data['post']      = new TimberPost();
$data['carousel']  = get_field('acf_carousel_slides');
$data['sections']  = get_field('acf_content_blocks');

if( have_rows('acf_content_blocks') ):
  while ( have_rows('acf_content_blocks') ) : the_row();
    if( get_row_layout() == 'benefits_block' ):
      // Get connected benefits
      $ids  = get_sub_field('acf_block_benefits', false, false);
      $args = array(
        'post_type'       => 'benefit',
        'post__in'		    => $ids,
        'posts_per_page'	=> -1
      );
      $data['benefits'] = Timber::get_posts($args);
    elseif( get_row_layout() == 'cases_block' ):
      // Get connected cases
      $ids  = get_sub_field('acf_block_cases', false, false);
      $args = array(
        'post_type'       => 'case',
        'post__in'		    => $ids,
        'posts_per_page'	=> -1
      );
    	$data['cases'] = Timber::get_posts($args);
    endif;
  endwhile;
endif;

Timber::render('home.twig', $data);
