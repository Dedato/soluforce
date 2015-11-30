<?php
/**
 * Template Name: Homepage
 */

$data              = Timber::get_context();
$data['post']      = new TimberPost();
$data['carousel']  = get_field('acf_carousel_slides');
$data['sections']  = get_field('acf_content_blocks');
Timber::render('home.twig', $data);
