<?php
  
use Dedato\SoluForce\Setup;

/* ==========================================================================
   Timber Setup
   ========================================================================== */
  
if ( ! class_exists( 'Timber' ) ) {
	add_action( 'admin_notices', function() {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url( admin_url( 'plugins.php#timber' ) ) . '">' . esc_url( admin_url( 'plugins.php' ) ) . '</a></p></div>';
		} );
	return;
}
Timber::$dirname = array('views');


/* Add gloabl context to wordpress site */
class StarterSite extends TimberSite {
  
  function __construct() {
		add_filter( 'timber_context', array( $this, 'add_to_context' ) );
		parent::__construct();
	}
  
	function add_to_context( $context ) {
		$context['top_menu']        = new TimberMenu('top_navigation');
		$context['main_menu']       = new TimberMenu('primary_navigation');
		$context['footer_menu']     = new TimberMenu('footer_navigation');
		$context['site']            = $this;
		$context['display_sidebar'] = Setup\display_sidebar();
		$context['sidebar_primary'] = Timber::get_widgets('sidebar-primary');
		$context['options']         = get_fields('option');
		$context['split_content']   = TimberHelper::function_wrapper('Dedato\SoluForce\Extras\split_more_content');
		return $context;
	}
	
}
new StarterSite();


/* Get connected solutions in cases */ 
function get_case_solutions($ids) {
  $args = array(
    'post_type'       => 'solution',
    'post__in'		    => $ids,
    'posts_per_page'	=> -1
  );
  $query = Timber::get_posts($args);
  return $query;
}

/* Get connected solutions in products */ 
function get_product_solutions($id) {
	$args = array(
		'post_type'   => 'solution',
		'meta_query'  => array(
			array(
				'key'       => 'acf_solution_products',
				'value'     => '"' . $id . '"',
				'compare'   => 'LIKE'
			)
		)
	);
  $query = Timber::get_posts($args);
  return $query;
}