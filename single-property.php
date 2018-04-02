<!--
SINGLE POST / ARTICLE PAGE
-->

<?php get_header(); ?>

<nav class="breadcrumb">
  <?php bcn_display(); ?>
</nav>

<main>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header>

      <h1><?php the_title(); ?></h1>

      <?php the_post_thumbnail(); ?>

    </header>

    <article>
    
      <?php the_content(); ?>

      <section>

        <h3>Location</h3>

        <?php $location = get_field('location'); ?>

        <p><a href="https://www.google.com/maps/place/<?php echo $location['address'];?>"><?php echo $location['address'];?></a></p>

        <p>lat/long: <?php echo $location['lat'] . ', ' . $location['lng'] ;?></p>

        <p><?php echo get_the_term_list( $post->ID, 'neighborhood', 'Neighborhood: ', ', ' ); ?></p>

      </section>

      <section>

        <h3>Details</h3>

        <p><?php echo get_the_term_list( $post->ID, 'architectural_style', 'Architectural Style: ', ', ' ); ?>

        <p><?php echo get_the_term_list( $post->ID, 'construction_type', 'Construction Type: ', ', ' ); ?>

        <p><?php echo get_the_term_list( $post->ID, 'designer', 'Original Designer: ', ', ' ); ?>

        <p><?php echo get_the_term_list( $post->ID, 'modifier', 'Modifications by: ', ', ' ); ?>

        <p><?php echo get_the_term_list( $post->ID, 'list', 'Lists/Districts: ', ', ' ); ?>

      </section>

    </article>

  <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>

