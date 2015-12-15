<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context                = Timber::get_context();
$context['header_img']  = get_field('acf_error_header_image', 'options');
Timber::render( '404.twig', $context );