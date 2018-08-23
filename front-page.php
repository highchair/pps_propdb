<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>

<main>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="main">

    <section class="featured-tour">

      <?php
      $loop = new WP_Query( array( 'posts_per_page' => 1, 'post_type' => 'tour' ) );
      while ($loop->have_posts()) :
        $loop->the_post();
      ?>

        <?php the_post_thumbnail('grid-thumb'); ?>

        <p><?php _e("Take a Tour of Providence's Historic Architecture", 'ppsdb'); ?></p>
        <h3><?php the_title(); ?></h3>
        <p>
        <?php 
          echo count(get_field('properties'));
          _e(' properties', 'ppsdb');
        ?>
        </p>

        <?php the_excerpt(); ?>

        <a href="<?php the_permalink(); ?>"><?php _e('See all Properties on this Tour', 'ppsdb'); ?></a>

      <?php
      endwhile; wp_reset_postdata();
      ?>

    </section>

    <section class="info">

      <div class="the-content">
        <?php the_content(); ?>
      </div>

      <div class="cta">
        <h3><?php the_field('cta_heading'); ?></h3>
        <a class="button" href="<?php the_field('cta_link'); ?>"><?php the_field('cta_link_text'); ?></a>
      </div>

    </section>

  </div> <!-- .main -->

  <section>

    <h2><?php _e('Most Recently Updated Properties', 'ppsdb'); ?></h2>

    <?php
    $loop = new WP_Query( array( 'posts_per_page' => 5, 'post_type' => 'property' ) );
    while ($loop->have_posts()) :
      $loop->the_post();
      get_template_part('partials/property-sm');
    endwhile; wp_reset_postdata();
    ?>

  </section>

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
