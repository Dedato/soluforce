<header class="banner">
  <div class="container">
    <a class="brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
    <nav id="main-nav" class="collapse navbar-collapse">
      <?php if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_id' => 'main-menu', 'menu_class' => 'nav navbar-nav', 'depth' => 1]);
      endif; ?>
    </nav>
    <?php if (has_nav_menu('primary_navigation') && wp_nav_menu(['theme_location' => 'primary_navigation', 'sub_menu' => true, 'echo' => 0]) ) : ?>
		  <nav id="sub-nav" class="collapse navbar-collapse">
			  <?php wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_id' => 'sub-menu', 'menu_class' => 'nav navbar-nav sub-nav', 'sub_menu' => true]); ?>
		  </nav>
		<?php endif; ?>
  </div>
</header>