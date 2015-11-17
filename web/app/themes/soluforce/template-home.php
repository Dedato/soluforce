<?php
/**
 * Template Name: Homepage
 */

$data             = Timber::get_context();
$data['post']     = new TimberPost();
Timber::render('home.twig', $data);
