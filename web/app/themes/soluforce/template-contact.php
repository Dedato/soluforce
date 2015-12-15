<?php
/**
 * Template Name: Contact
 */
 
$data                     = Timber::get_context();
$data['post']             = new TimberPost();
$data['header_img']       = get_field('acf_header_image');
$data['sidebar_img']      = get_field('acf_sidebar_image');
$data['sidebar_content']  = get_field('acf_sidebar_content');
Timber::render('page.twig', $data);