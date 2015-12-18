<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

global $wp_query;
$context                = Timber::get_context();
$context['total']       = array(
  'query' => get_search_query(),
  'count' => $wp_query->found_posts
);
$context['ppp']         = get_option('posts_per_page');
$context['title']       = '<span class="search_total">' . $context['total']['count'] . '</span> ' . __('search results for:', 'soluforce') . ' <span class="search_query">'. get_search_query() . '</span>';
$context['posts']       = Timber::get_posts();
$context['pagination']  = Timber::get_pagination();
Timber::render('search.twig', $context);
