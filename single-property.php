<!--
SINGLE PROPERTY PAGE
-->
<?php
  $location = get_field('location');
?>

<?php get_header(); ?>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header>

      <h1>
        <?php 
          the_title();
          if ( get_field('aka') ) {
            echo ' <em>&#123; ' . get_field('aka') . ' &#125;</em>';
          }
        ?>
      </h1>

      <?php
        if ( get_field('period') ) {
          echo '<p>' . get_field('period') . '</p>';
        }
      ?>

      <?php the_post_thumbnail(); ?>

    </header>

    <article>
    
      <?php the_content(); ?>

      <section>

        <div id="map" style="width: 360px; height: 260px"></div>

        <script>

          var lat = <?php echo $location['lat']; ?>;
          var lng = <?php echo $location['lng']; ?>;

          function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
              zoom: 16,
              center: {lat: lat, lng: lng}
            });
          }

        </script>

        <h3>Location</h3>

        <p><a href="https://www.google.com/maps/place/<?php echo $location['address'];?>"><?php echo $location['address'];?></a></p>

        <p>lat/long: <?php echo $location['lat'] . ', ' . $location['lng'] ;?></p>

        <p><?php echo get_the_term_list( $post->ID, 'neighborhood', 'Neighborhood: ', ', ' ); ?></p>

      </section>

      <section>

        <h3>Details</h3>

        <?php
          if( has_term( '', 'architectural_style' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'architectural_style', 'Architectural Style: ', ', ' ) . '</p>';
          }
          if( has_term( '', 'construction_type' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'construction_type', 'Construction Type: ', ', ' ) . '</p>';
          }
          if( has_term( '', 'designer' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'designer', 'Designer: ', ', ' ) . '</p>';
          }
          if( has_term( '', 'list' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'list', 'List/District: ', ', ' ) . '</p>';
          }
        ?>

      </section>

      <?php if ( has_tag() ) : ?>
        <section>

          <h3>Additional Tags</h3>

          <p><?php the_tags(''); ?></p>

        </section>
      <?php endif; ?>

    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIqb19OYrLxZvikR_yVnPTDnhsCsP0vtA&callback=initMap"></script>

