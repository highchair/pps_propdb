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
    ?>
      <div class="card">
        <a href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail('grid-thumb'); ?>
          <div class="heading">
            <h3>
              <?php the_title(); ?>
              <?php if ( get_field('aka') ) : ?>
                <em class="aka">&#123;&nbsp;<?php the_field('aka'); ?>&nbsp;&#125;</em>
              <?php endif; ?>
            </h3>
            <?php if ( is_plugin_active('relevanssi') ) : ?>
              <p><?php relevanssi_the_excerpt(); ?></p>
            <?php else : ?>
              <p><?php the_excerpt(); ?></p>
            <?php endif; ?>
          </div>
        </a>
      </div>
    <?php
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

