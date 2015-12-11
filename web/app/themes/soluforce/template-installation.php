<?php
/**
 * Template Name: Installation
 */

$data                   = Timber::get_context();
$data['post']           = new TimberPost();
$data['header_img']     = get_field('acf_header_image');
$data['installations']  = Timber::get_posts(array(
  'post_type' => 'installation',
  'orderby'   => 'menu_order',
  'order'     => 'ASC',
  'nopaging'  => true
));

Timber::render('tmpl-installation.twig', $data);
