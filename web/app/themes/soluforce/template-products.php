<?php
/**
 * Template Name: Products
 */

$data              = Timber::get_context();
$data['post']      = new TimberPost();
$data['products']  = Timber::get_posts(array(
  'post_type' => 'product',
  'orderby'   => 'menu_order',
  'order'     => 'ASC',
  'nopaging'  => true
));
Timber::render('tmpl-products.twig', $data);