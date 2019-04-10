<!--
GOOGLE MAP MARKER & INFOWINDOW
-->

<div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>">
	<a href="<?php echo esc_url( add_query_arg( 't', $tour, get_permalink() ) );?>">
		<?php
		echo '<h4>' . get_the_title($id) . '</h4>';
		if ( get_field('aka') ) {
			echo '<p class="aka">&#123; ' . get_field('aka') . ' &#125;</p>';
		}
		if ( isset($location['address']) ) {
			echo '<p class="address">' . $location['address'] . '</p>';
		}
		?>
	</a>
</div>