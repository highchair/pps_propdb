<!--
SINGLE TOUR PAGE
-->

<?php
  $properties = get_field('properties');
  $query_var = get_query_var( 't' );
  $tour = get_queried_object_id();
?>

<?php get_header(); ?>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header class="page-header">

      <h1 class="page-title"><?php the_title(); ?></h1>

      <a href="<?php echo get_post_type_archive_link( 'tour' ); ?>">&larr; <?php _e( 'View All Tours', 'ppsdb' ); ?></a>

    </header>

    <?php get_template_part('partials/social'); ?>

    <article>

      <div id="map" class="map">
        <?php

          if( $properties ) {

            foreach( $properties as $post ) {
              setup_postdata($post);
              $id = $post->ID;
              $location = get_field('location', $id);

              if ( (isset($location['address'])) && (get_post_status() == 'publish') ) {

                echo '<div class="marker" data-lat="' . $location['lat'] . '" data-lng="' . $location['lng'] . '"><a href="' . esc_url( add_query_arg( 't', $tour, get_permalink() ) ) . '">' . get_the_title($id) . '</a></div>';

              }
            }
            wp_reset_postdata();

          }

        ?>
      </div>


      <?php the_content(); ?>

      <section class="related-properties">

        <h2><?php _e( 'Properties on this Tour', 'ppsdb' ); ?></h2>

        <?php

        if( $properties ) {
          foreach( $properties as $post) {
            setup_postdata($post);
            if ( get_post_status() == 'publish' ) {
              include(locate_template('partials/property-sm.php'));
            }
          }
          wp_reset_postdata();
        }
        ?>

      </section>

    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

