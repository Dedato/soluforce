<?php
/**
 * Template Name: Solutions
 */

$data                 = Timber::get_context();
$data['post']         = new TimberPost();
$data['header_img']   = get_field('acf_header_image');
$data['solutions']    = Timber::get_posts(array(
  'post_type' => 'solution',
  'orderby'   => 'menu_order',
  'order'     => 'ASC',
  'nopaging'  => true
));

Timber::render('tmpl-solutions.twig', $data);
