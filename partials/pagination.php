<!--
PAGE NAVIGATION
-->

<?php
    the_posts_pagination( array(
    	'mid_size'  => 2,
    	'prev_text' => __( '&laquo;', 'ppsdb' ),
    	'next_text' => __( '&raquo;', 'ppsdb' ),
    ) );
?>