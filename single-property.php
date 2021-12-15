<!--
SINGLE PROPERTY PAGE
-->
<?php
  $query_var = get_query_var( 't' );
  $location = get_field('location');
?>

<?php get_header(); ?>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <?php
    if ( !empty($query_var) ) :
      $tour = get_post( $query_var );

      $properties = get_field( 'properties', $tour->ID );
      $property_ids = array();

      foreach( $properties as $property ) :
        $property_ids[] = $property->ID;
      endforeach;

      $current_index = array_search( $post->ID, $property_ids );

      $prev_property = $current_index - 1;
      $next_property = $current_index + 1;

    ?>

      <nav class="tour-nav" role="navigation">

        <div class="prev-next prev-prop">
          <?php
          if ( isset($property_ids[$prev_property]) ) :
            $url_prev = get_permalink( $property_ids[$prev_property] );
            $url_prev_query = esc_url( add_query_arg( 't', $tour->ID, $url_prev ) );
            $title_prev = get_the_title( $property_ids[$prev_property] );
          ?>
            <a href="<?php echo $url_prev_query; ?>" title="<?php echo $title_prev; ?>">
              <span class="button icon-chevron-left"></span>
              <span class="text"><?php _e( 'Previous Property', 'ppsdb' ); ?></span>
            </a>
          <?php
          endif;
          ?>
        </div>

        <p class="tour-current">
          <span class="label-alt"><?php _e( 'Part of', 'ppsdb' ); ?></span>
          <a href="<?php echo get_permalink($tour); ?>"><?php echo $tour->post_title; ?></a>
        </p>

        <div class="prev-next next-prop">
          <?php
          if ( isset($property_ids[$next_property]) ) :
            $url_next = get_permalink( $property_ids[$next_property] );
            $url_next_query = esc_url( add_query_arg( 't', $tour->ID, $url_next ) );
            $title_next = get_the_title( $property_ids[$next_property] );
          ?>
            <a href="<?php echo $url_next_query; ?>" title="<?php echo $title_next; ?>">
              <span class="text"><?php _e( 'Next Property', 'ppsdb' ); ?></span>
              <span class="button icon-chevron-right"></span>
            </a>
          <?php
          endif;
          ?>
        </div>

      </nav>

    <?php
    endif;
    ?>

    <header class="page-header">

      <h1 class="page-title">
        <?php 
          the_title();
          if ( get_field('aka') ) {
            echo ' <em class="h2 aka">&#123;&nbsp;' . get_field('aka') . '&nbsp;&#125;</em>';
          }
        ?>
      </h1>

    </header>

    <?php get_template_part('partials/social'); ?>

    <article>

      <div class="main">

        <div class="featured-img">
          <?php the_post_thumbnail(); ?>
        </div>

        <?php
        $the_content = get_the_content();
        if ( !empty( $the_content ) ) :
        ?>
    
          <?php the_content(); ?>

        <?php
        endif;
        ?>
        
        <div class="share-story">
          <h2 class="h3"><?php _e( 'Share your Story', 'ppsdb' ); ?></h2>
          <p class="label-alt"><?php _e( 'We welcome community input about the history of these important places. Have something to add? Have an edit or correction to suggest? Have more information about this property?', 'ppsdb' ); ?> 
            <a href="mailto:info@ppsri.org?subject=A Story regarding <?php the_title_attribute(); ?>"><?php _e( 'Send us an email and start a conversation: info@ppsri.org', 'ppsdb' ); ?></a></p>
          </p>
        </div>

      </div>

      <aside class="sidebar">

        <section>
          
          <?php
          if ( isset($location['address']) ) {
            echo '<p>Address: <a href="https://www.google.com/maps/place/' . $location['address'] . '">' . $location['address'] . '</a></p>';
          } else {
            echo '<p>No address found.</p>';
          }
          if ( get_field('period') ) {
            echo '<p>Date(s): ' . get_field('period') . '</p>';
          }
          if( has_term( '', 'neighborhood' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'neighborhood', 'Neighborhood: ', ', ' ) . '</p>';
          }
          if( has_term( '', 'architectural_style' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'architectural_style', 'Architectural Style: ', ', ' ) . '</p>';
          }
          if( has_term( '', 'designer' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'designer', 'Designer(s): ', ', ' ) . '</p>';
          }
          if( has_term( '', 'list' ) ) {
            echo '<p>' . get_the_term_list( $post->ID, 'list', 'List/District: ', ', ' ) . '</p>';
          }
          if ( has_tag() ) {
            the_tags('<p>Additional Tags: ', ', ', '</p>');
          }
          ?>

        </section>

        <section>

          <div id="map" class="map"></div>

          <script>

            var lat = <?php echo $location['lat']; ?>;
            var lng = <?php echo $location['lng']; ?>;

            function initMap() {
              var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 16,
                center: {lat: lat, lng: lng},
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                styles: [
                  {
                    featureType: 'landscape.man_made',
                    elementType: 'geometry',
                    stylers: [{color: '#f2f2f2'}]
                  },
                  {
                    featureType: 'poi.park',
                    elementType: 'geometry',
                    stylers: [{color: '#b3e37e'}]
                  },
                  {
                    featureType: 'road',
                    elementType: 'geometry',
                    stylers: [{color: '#d6d397'}]
                  },
                  {
                    featureType: 'water',
                    elementType: 'geometry',
                    stylers: [{color: '#d1dcf2'}]
                  },
                  {
                    featureType: 'water',
                    elementType: 'labels.text.fill',
                    stylers: [{color: '#666666'}]
                  },
                  {
                    featureType: 'water',
                    elementType: 'labels.text.stroke',
                    stylers: [{color: '#ffffff'}]
                  }
                ]
              });

              var marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: map,
                icon: stylesheetDir + '/library/img/marker.png'
              });

            }

          </script>

        </section>

      </aside>

    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

