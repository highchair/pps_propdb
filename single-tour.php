<!--
SINGLE TOUR PAGE
-->

<?php get_header(); ?>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header class="page-header">

      <h1 class="page-title"><?php the_title(); ?></h1>

      <a href="<?php echo get_post_type_archive_link( 'tour' ); ?>">&larr; <?php _e( 'View All Tours', 'ppsdb' ); ?></a>

    </header>

    <article>

      <img class="map" src="https://placehold.it/800x430" alt="map placeholder" />

      <?php the_content(); ?>

      <section class="related-properties">

        <h2><?php _e( 'Properties on this Tour', 'ppsdb' ); ?></h2>

        <?php

        $properties = get_field('properties');

        if( $properties ) {
          foreach( $properties as $post) {
            setup_postdata($post);
            $page_id     = get_queried_object_id();
            $tour = $page_id;
            include(locate_template('partials/property-sm.php'));
          }
          wp_reset_postdata();
        }
        ?>

      </section>

    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIqb19OYrLxZvikR_yVnPTDnhsCsP0vtA&callback=initMap"></script>

