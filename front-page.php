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

        <a class="image" href="<?php the_permalink(); ?>">
          <?php the_post_thumbnail('large'); ?>
          <span class="button"><?php _e("Start this Tour", 'ppsdb'); ?></span>
        </a>

        <div class="text">

          <p class="subtitle h5"><?php _e("Take a Tour of Providence's Historic Architecture", 'ppsdb'); ?></p>
          <a href="<?php the_permalink(); ?>"><h3 class="title h2"><?php the_title(); ?></h3></a>
          <p>
          <?php 
            echo count(get_field('properties'));
            _e(' properties', 'ppsdb');
          ?>
          </p>

          <?php the_excerpt(); ?>

          <a class="more-link" href="<?php the_permalink(); ?>"><?php _e('See all Properties on this Tour', 'ppsdb'); ?></a>

        </div> <!-- .text -->

      <?php
      endwhile; wp_reset_postdata();
      ?>

    </section>

    <section class="info">

      <div class="the-content">
        <?php the_content(); ?>
      </div>

      <div class="cta" style="background-image: url('<?php the_field('cta_bg_img'); ?>')">
        <h3 class="title h2"><?php the_field('cta_heading'); ?></h3>
        <a class="button" href="<?php the_field('cta_link'); ?>"><?php the_field('cta_link_text'); ?></a>
      </div>

    </section>

  </div> <!-- .main -->

  <section class="recently-updated">

    <header>

      <h2><?php _e('Most Recently Updated Properties', 'ppsdb'); ?></h2>

      <a class="button" href="<?php echo get_post_type_archive_link( 'property' ); ?>">
        <?php _e('All Properties', 'ppsdb'); ?>
      </a>

    </header>

    <div class="featured-card">
      <?php
      $loop = new WP_Query( array( 'posts_per_page' => 1, 'post_type' => 'property', 'orderby'=>'modified' ) );
      while ($loop->have_posts()) :
        $loop->the_post();
        $featured = true;
        include(locate_template('partials/property-sm.php'));
      endwhile; wp_reset_postdata();
      ?>
    </div>

    <div class="cards">
      <?php
      $loop = new WP_Query( array( 'posts_per_page' => 4, 'post_type' => 'property', 'offset' => 1, 'orderby'=>'modified' ) );
      while ($loop->have_posts()) :
        $loop->the_post();
        get_template_part('partials/property-sm');
      endwhile; wp_reset_postdata();
      ?>
    </div>

  </section>

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
