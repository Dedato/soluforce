<?php
/**
 * Template Name: Installation
 */

$data         = Timber::get_context();
$data['post'] = new TimberPost();
Timber::render('page.twig', $data);
