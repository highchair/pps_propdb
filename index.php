

<?php get_header(); ?>

<main>
  
  <nav class="breadcrumb">
    <?php if ( function_exists( 'bcn_display' ) ) { bcn_display(); } ?>
  </nav>

  <div class="main">

    <header>

      <h1 class="page-title">News</h1>

    </header>
    
    <?php
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post();
        get_template_part('partials/article');
      }
      get_template_part('partials/pagination');
    }
    ?>

  </div> <!-- end .main -->

  <?php get_sidebar(); ?>

</main>

<?php get_footer(); ?>