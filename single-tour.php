<!--
SINGLE TOUR PAGE
-->

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDA4aghw-j9Z_ooVKc1vtE-cRjnjWHJDYo"></script>

<?php
  $properties = get_field('properties');
  $query_var = get_query_var( 't' );
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

            foreach( $properties as $property ) :

              $location = get_field('location', $property->ID);

              echo '<div class="marker" data-lat="' . $location['lat'] . '" data-lng="' . $location['lng'] . '"></div>';

            endforeach;

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

