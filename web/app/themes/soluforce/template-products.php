<?php
/**
 * Template Name: Products
 */

$data         = Timber::get_context();
$data['post'] = new TimberPost();
Timber::render('page.twig', $data);
