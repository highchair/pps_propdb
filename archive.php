<!--
ARCHIVE PAGE TEMPLATE
-->

<?php get_header(); ?>

<main>

  <div class="main">

    <header class="page-header">

      <?php
      if ( is_tax() || is_tag() ) {
        echo '<h2 class="subheading">Properties</h2>';
      }
      ?>

      <h1 class="page-title">
        <?php
        if ( is_post_type_archive() ) {
          post_type_archive_title('All ');
        } elseif ( is_tax() ) {
          single_term_title();
        } elseif ( is_category() ) { 
          single_cat_title();
        } elseif ( is_tag() ) {
          single_tag_title();
        } else {
          _e('Archives', 'ppsdb');
        }
        ?>
      </h1>

    </header>
    
    <?php
    if ( have_posts() ) :
      while ( have_posts() ) { the_post();
        get_template_part('partials/property-sm');
      }
    ?>

  </div>

    <?php
      get_template_part('partials/pagination');
    endif;
    ?>

  <?php
  if ( is_post_type_archive('property') || is_tax() || is_tag() ) {
    get_template_part('partials/taxonomies-browse');
  }
  ?>

</main>

<?php get_footer(); ?>
