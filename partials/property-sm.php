<?php
$location = get_field('location');
?>

<div class="property">
  <a href="<?php the_permalink(); ?>">

    <?php the_post_thumbnail('grid-thumb'); ?>

    <h3><?php the_title(); ?></h3>

    <?php
    if ( get_field('aka') ) { echo '<p>&#123; ' . get_field('aka') . ' &#125;</p>'; }

    echo '<p>' . $location['address'] . '</p>';

    if ( get_field('period') ) { echo '<p>' . get_field('period') . '</p>'; }

    if( has_term( '', 'designer' ) ) {
      $terms_as_text = get_the_term_list( $post->ID, 'designer', 'Designer: ', ', ' );
      echo '<p>', strip_tags($terms_as_text) ,'</p>';
    }
    ?>
  </a>
</div>
