<!--
ARCHIVE PAGE TEMPLATE
-->

<?php get_header(); ?>

<main>

  <div class="main">

    <header class="page-header">
      <div>

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

      </div>

    </header>

    <?php get_template_part('partials/social'); ?>

    <?php
    if ( is_post_type_archive('property') || is_tax() || is_tag() ) {
      get_template_part('partials/taxonomies-browse');
    }
    ?>
    
    <div class="cards">
      <?php
      if ( have_posts() ) :
        while ( have_posts() ) { the_post();
          get_template_part('partials/property-sm');
        }
      ?>
    </div>

  </div>

    <?php
      get_template_part('partials/pagination');
    else :
      echo '<p class="no-results">' . esc_html__( 'We\'re sorry but no results were found.', 'ppsdb' ) . '</p>';
    endif;
    ?>

</main>

<?php get_footer(); ?>
