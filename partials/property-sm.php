<?php
$location = get_field('location');
?>

<div class="card">
  <a href="<?php the_permalink(); ?>">

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
    echo '<p>' . $location['address'] . '</p>';

    if ( get_field('period') ) { echo '<p>' . get_field('period') . '</p>'; }

    if( has_term( '', 'designer' ) ) {
      $terms_as_text = get_the_term_list( $post->ID, 'designer', 'Designer: ', ', ' );
      echo '<p>', strip_tags($terms_as_text) ,'</p>';
    }
    ?>
  </a>
</div>
