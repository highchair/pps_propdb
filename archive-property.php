<!--
PROPERTIES ARCHIVE PAGE TEMPLATE
-->

<?php get_header(); ?>

<main>

  <div class="main">

    <header>

      <h1>
        <?php _e('All Properties', 'ppsdb'); ?>
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

  <div>

    <h2>
      <?php _e('Browse by Category', 'ppsdb'); ?>
    </h2>

    <div>
      <h3><?php _e('Architectural Styles', 'ppsdb'); ?></h3>
      <?php
      $styles = get_terms('architectural_style');
      foreach ($styles as $style):
      ?>
        <li><a href="<?php echo get_term_link($style); ?>"><?php echo $style->name; ?></a></li>
      <?php
      endforeach;
      ?>
    </div>

    <div>
      <h3><?php _e('Construction Type', 'ppsdb'); ?></h3>
      <?php
      $types = get_terms('construction_type');
      foreach ($types as $type):
      ?>
        <li><a href="<?php echo get_term_link($type); ?>"><?php echo $type->name; ?></a></li>
      <?php
      endforeach;
      ?>
    </div>

    <div>
      <h3><?php _e('Designers', 'ppsdb'); ?></h3>
      <?php
      $designers = get_terms('designer');
      foreach ($designers as $designer):
      ?>
        <li><a href="<?php echo get_term_link($designer); ?>"><?php echo $designer->name; ?></a></li>
      <?php
      endforeach;
      ?>
    </div>

    <div>
      <h3><?php _e('Neighborhoods', 'ppsdb'); ?></h3>
      <?php
      $neighborhoods = get_terms('neighborhood');
      foreach ($neighborhoods as $neighborhood):
      ?>
        <li><a href="<?php echo get_term_link($neighborhood); ?>"><?php echo $neighborhood->name; ?></a></li>
      <?php
      endforeach;
      ?>
    </div>

  </div>

</main>

<?php get_footer(); ?>
