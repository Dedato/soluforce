<?php
$data                 = Timber::get_context();
$data['post']         = new TimberPost();
$data['header_img']   = get_field('acf_header_image');
$data['sidebar_img']  = get_field('acf_sidebar_image');
Timber::render('page.twig', $data);