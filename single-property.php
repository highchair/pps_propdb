<!--
SINGLE PROPERTY PAGE
-->
<?php
  $location = get_field('location');
?>

<?php get_header(); ?>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header class="page-header">

      <nav class="tour-nav" role="navigation">
        <?php
        $query_var = get_query_var( 't' );
        if ( !empty($query_var) ) :
          $tour = get_post( $query_var );
        ?>
          <p>Part of <a href="<?php echo get_permalink($tour); ?>"><?php echo $tour->post_title; ?></a></p>
        <?php
        else:
        ?>
          <p>Not on a tour right now.</p>
        <?php
        endif;
        ?>
      </nav>

      <h1 class="page-title">
        <?php 
          the_title();
          if ( get_field('aka') ) {
            echo ' <em class="h2">&#123; ' . get_field('aka') . ' &#125;</em>';
          }
        ?>
      </h1>

      <?php
        if ( get_field('period') ) {
          echo '<p class="h4">' . get_field('period') . '</p>';
        }
      ?>

    </header>

    <article>

      <div class="main">

        <?php the_post_thumbnail(); ?>

        <?php if ( !empty( get_the_content() ) ) : ?>

          <h2><?php _e( 'About this Property', 'ppsdb' ); ?></h2>
    
          <?php the_content(); ?>

        <?php endif; ?>

      </div>

      <aside class="sidebar">

        <section>

          <div id="map" class="map"></div>

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

          <h3 class="h6"><?php _e( 'Location', 'ppsdb' ); ?></h3>
          
          <?php
          if ( isset($location['address']) ) {
            echo '<p><a href="https://www.google.com/maps/place/' . $location['address'] . '">' . $location['address'] . '</a></p>';
            echo '<p>lat/long: ' . $location['lat'] . ', ' . $location['lng'] . '</p>';
          } else {
            echo '<p>No address found.</p>';
          }
          ?>

          <p><?php echo get_the_term_list( $post->ID, 'neighborhood', 'Neighborhood: ', ', ' ); ?></p>

        </section>

        <?php
          if( 
            has_term( '', 'architectural_style' ) ||
            has_term( '', 'construction_type' ) ||
            has_term( '', 'designer' ) ||
            has_term( '', 'list' )
          ) :
        ?>

          <section>

            <h3 class="h6"><?php _e( 'Details', 'ppsb' ); ?></h3>

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

        <?php
          endif;
        ?>

        <?php if ( has_tag() ) : ?>
          <section>

            <h3 class="h6"><?php _e( 'Additional Tags', 'ppsdb' ); ?></h3>

            <p><?php the_tags(''); ?></p>

          </section>
        <?php endif; ?>

      </aside>

    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIqb19OYrLxZvikR_yVnPTDnhsCsP0vtA&callback=initMap"></script>

