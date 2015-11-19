<?php
$data         = Timber::get_context();
$data['post'] = new TimberPost();
Timber::render('single.twig', $data);