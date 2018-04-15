<!--
PROPERTIES ARCHIVE PAGE TEMPLATE
-->

<?php get_header(); ?>

<main>

  <div class="main">

    <header>

      <h1>
        <?php
          _e('All Properties', 'ppsdb');
        ?>
      </h1>

    </header>
    
    <?php
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post();
        get_template_part('partials/property-sm');
      }
      get_template_part('partials/pagination');
    }
    ?>

  </div>

</main>

<?php get_footer(); ?>
