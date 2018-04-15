<!--
SINGLE TOUR PAGE
-->

<?php get_header(); ?>

<nav class="breadcrumb">
  <?php bcn_display(); ?>
</nav>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header>

      <h1><?php the_title(); ?></h1>

      <a href="<?php echo get_post_type_archive_link( 'tour' ); ?>">&larr; <?php _e( 'View All Tours', 'ppsdb' ); ?></a>

    </header>

    <article>

      <?php the_content(); ?>

    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDIqb19OYrLxZvikR_yVnPTDnhsCsP0vtA&callback=initMap"></script>

