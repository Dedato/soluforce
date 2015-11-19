<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',           // Scripts and stylesheets
  'lib/extras.php',           // Custom functions
  'lib/setup.php',            // Theme setup
  //'lib/wrapper.php',          // Theme wrapper class
  'lib/timber.php',           // Timber Setup
  'lib/sub-nav.php',          // Sub Navigation
  'lib/cpt-solution.php',     // Custom Post Type Solution
  'lib/cpt-case.php',         // Custom Post Type Case
  'lib/cpt-installation.php', // Custom Post Type Installation
  'lib/cpt-product.php',      // Custom Post Type Product
  'lib/cpt-benefit.php',      // Custom Post Type Benefit
  'lib/resp-picture.php',     // Responsive picture
  'lib/titles.php',           // Page titles
  'lib/customizer.php'        // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
