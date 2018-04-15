<!--
ARCHIVE PAGE TEMPLATE
-->

<?php get_header(); ?>

<main>

  <div class="main">

    <header>

      <h1>
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
    if ( have_posts() ) { 
      while ( have_posts() ) { the_post();
        get_template_part('partials/property-sm');
      }
      get_template_part('partials/pagination');
    }
    ?>

  </div>

  <?php
  if ( is_post_type_archive('property') ) {
    get_template_part('partials/taxonomies-browse');
  }
  ?>

</main>

<?php get_footer(); ?>
