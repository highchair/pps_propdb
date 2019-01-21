<header id="header">
	<a href="<?php echo get_home_url(); ?>">
		<h1>
      <span class="logo-text">Providence Preservation Society</span>
      <span class="site-text h3"><?php bloginfo(); ?></span>
    </h1>
	</a>
	<nav role="navigation">

		<div class="secondary-nav">
			<a class="toggle-nav" href="javascript:void(0)"><span class="icon-bars"></span> Menu</a> 
			<div class="desktop-search">
        <a href="javascript:void(0)">Search</a>
      </div>
		</div>

		<div class="primary-nav">
			<a class="toggle-nav" href="javascript:void(0)"><span class="icon-close"></span> Exit</a>
      <?php ppsri_primary_nav(); ?>
			<?php echo get_search_form(); ?>
      <a class="parent-site-link" href="<?php echo network_home_url(); ?>">
        <?php _e( 'PPSri.org', 'ppsdb' ); ?> <span class="icon-arrow-right"></span>
      </a>
		</div>

	</nav>

</header>
