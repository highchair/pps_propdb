<header id="header">
	<a href="<?php echo get_home_url(); ?>">
		<h1 class="logo-text">
      Providence Preservation Society<br />
      Providence Property Database
    </h1>
	</a>
	<nav role="navigation">

		<div class="secondary-nav">
			<a class="toggle-nav" href="javascript:void(0)"><span class="icon-bars"></span> Menu</a> 
			<div class="desktop-search">
        <a href="javascript:void(0)">Search</a>
        <a href="<?php echo network_home_url(); ?>"><?php _e( 'PPSri.org', 'ppsdb' ); ?> &rarr;</a>
      </div>
		</div>

		<div class="primary-nav">
			<a class="toggle-nav" href="javascript:void(0)"><span class="icon-close"></span> Exit</a>
      <?php ppsri_primary_nav(); ?>
			<?php echo get_search_form(); ?>
		</div>

	</nav>

</header>
