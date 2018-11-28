<aside class="taxonomies-browse">

  <h2>
    <?php _e('Browse by Category', 'ppsdb'); ?>
  </h2>

  <div class="accordion" data-accordion data-multi-expand="true" data-allow-all-closed="true">

    <div class="accordion-item" data-accordion-item>
      <a class="accordion-title" href="#"><h3><?php _e('Architectural Styles', 'ppsdb'); ?></h3></a>
      <div class="accordion-content" data-tab-content>
        <ul>
          <?php
          $styles = get_terms('architectural_style');
          foreach ($styles as $style):
          ?>
            <li><a href="<?php echo get_term_link($style); ?>"><?php echo $style->name; ?></a></li>
          <?php
          endforeach;
          ?>
        </ul>
      </div>
    </div>

    <div class="accordion-item" data-accordion-item>
      <a class="accordion-title" href="#"><h3><?php _e('Designers', 'ppsdb'); ?></h3></a>
      <div class="accordion-content" data-tab-content>
        <ul>
          <?php
          $designers = get_terms('designer');
          foreach ($designers as $designer):
          ?>
            <li><a href="<?php echo get_term_link($designer); ?>"><?php echo $designer->name; ?></a></li>
          <?php
          endforeach;
          ?>
        </ul>
      </div>
    </div>

    <div class="accordion-item" data-accordion-item>
      <a class="accordion-title" href="#"><h3><?php _e('Neighborhoods', 'ppsdb'); ?></h3></a>
      <div class="accordion-content" data-tab-content>
        <ul>
          <?php
          $neighborhoods = get_terms('neighborhood');
          foreach ($neighborhoods as $neighborhood):
          ?>
            <li><a href="<?php echo get_term_link($neighborhood); ?>"><?php echo $neighborhood->name; ?></a></li>
          <?php
          endforeach;
          ?>
        </ul>
      </div>
    </div>

  </div> <!-- .accordion -->

</aside>
