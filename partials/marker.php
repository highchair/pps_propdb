<!--
GOOGLE MAP MARKER & INFOWINDOW
-->

<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
	<a href="<?php echo esc_url( add_query_arg( 't', $tour, get_permalink() ) );?>">
		<?php echo get_the_title($id); ?>
	</a>
</div>