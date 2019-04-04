<aside class="taxonomies-browse">

  <h2>
    <?php _e('Browse by Category', 'ppsdb'); ?>
  </h2>

  <ul class="dropdown menu" data-dropdown-menu>

    <li>
      <a href="#"><?php _e('Architectural Styles', 'ppsdb'); ?></a>
      <ul class="menu">
        <?php
        $styles = get_terms('architectural_style');
        foreach ($styles as $style):
        ?>
          <li><a href="<?php echo get_term_link($style); ?>"><?php echo $style->name; ?></a></li>
        <?php
        endforeach;
        ?>
      </ul>
    </li>

    <li>
      <a href="#"><?php _e('Designers', 'ppsdb'); ?></a>
      <ul class="menu">
        <?php
        $designers = get_terms('designer');
        foreach ($designers as $designer):
        ?>
          <li><a href="<?php echo get_term_link($designer); ?>"><?php echo $designer->name; ?></a></li>
        <?php
        endforeach;
        ?>
      </ul>
    </li>

    <li>
      <a href="#"><?php _e('Neighborhoods', 'ppsdb'); ?></a>
      <ul class="menu">
        <?php
        $neighborhoods = get_terms('neighborhood');
        foreach ($neighborhoods as $neighborhood):
        ?>
          <li><a href="<?php echo get_term_link($neighborhood); ?>"><?php echo $neighborhood->name; ?></a></li>
        <?php
        endforeach;
        ?>
      </ul>
    </li>

  </ul>

</aside>
