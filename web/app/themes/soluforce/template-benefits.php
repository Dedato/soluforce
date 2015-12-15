<?php
/**
 * Template Name: Benefits
 */

$data                 = Timber::get_context();
$data['post']         = new TimberPost();
$data['header_img']   = get_field('acf_header_image');
$data['benefits']     = Timber::get_posts(array(
  'post_type' => 'benefit',
  'orderby'   => 'menu_order',
  'order'     => 'ASC',
  'nopaging'  => true
));

Timber::render('tmpl-benefits.twig', $data);
