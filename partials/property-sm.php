<?php
$location = get_field('location');
?>

<div class="card">
  <?php
  if (isset($tour)) :
  ?>
    <a href="<?php echo esc_url( add_query_arg( 't', $tour, the_permalink() ) )?>">
  <?php
  else :
  ?>
    <a href="<?php the_permalink(); ?>">
  <?php
  endif;
  ?>

    <?php
    if (isset($featured)) {
      the_post_thumbnail('squarish');
    } else {
      the_post_thumbnail('grid-thumb');
    }
    ?>

    <div class="heading">
      <h3><?php the_title(); ?></h3>
      <?php
      if ( get_field('aka') ) { echo '<p class="aka">&#123; ' . get_field('aka') . ' &#125;</p>'; }
      ?>
    </div>

    <?php
    if ( isset($location['address']) ) {
      echo '<p>' . $location['address'] . '</p>';
    }

    if ( get_field('period') ) { echo '<p>' . get_field('period') . '</p>'; }

    if( has_term( '', 'designer' ) ) {
      $terms_as_text = get_the_term_list( $post->ID, 'designer', 'Designer: ', ', ' );
      echo '<p>', strip_tags($terms_as_text) ,'</p>';
    }
    ?>
  </a>
</div>
