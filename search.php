<!--
SEARCH RESULTS PAGE
-->

<?php get_header(); ?>

<main>

  <div class="main">
  
    <header>
      <p>
        <?php _e('Results for:', 'ppsri'); ?>
      </p>
      <h1>
        <?php echo esc_attr(get_search_query()); ?>
      </h1>
    </header>

    <?php
      if (have_posts()) : while (have_posts()) : the_post();
        if ( get_post_type() == 'property' ) :
          include 'partials/property-sm.php';
        else :
    ?>
      <div class="card">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail('grid-thumb'); ?>
          <div class="heading">
            <h3><?php the_title(); ?></h3>
            <p><?php the_excerpt(); ?></p>
          </div>
        </a>
      </div>
    <?php
        endif;
      endwhile;
        get_template_part('partials/pagination');
      else: ?>
      <h2><?php _e( 'No Results', 'ppsdb' ); ?></h2>
      <p><?php _e( 'We\'re sorry but no results were found.', 'ppsdb' ); ?></p>
    <?php
      endif;
    ?>

  </div>

</main>

<?php get_footer(); ?>

