<div class="taxonomies-browse">

  <ul class="dropdown menu" data-dropdown-menu>

    <li class="filter">
      <a href="#"><?php _e('Styles', 'ppsdb'); ?></a>
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

    <li class="filter">
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

    <li class="filter">
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

    <li class="filter">
      <a href="#"><?php _e('Lists', 'ppsdb'); ?></a>
      <ul class="menu">
        <?php
        $lists = get_terms('list');
        foreach ($lists as $list):
        ?>
          <li><a href="<?php echo get_term_link($list); ?>"><?php echo $list->name; ?></a></li>
        <?php
        endforeach;
        ?>
      </ul>
    </li>

  </ul>

</div>
