/*
* Foundation by ZURB
*/

jQuery(document).ready( function($) {

  $(document).foundation();

} );

/*
* Google Maps on Single Tour page
* modified from: https://www.advancedcustomfields.com/resources/google-map/
*/

(function($) {

	var infoWindows = new Array(); //

	if ( $('body').hasClass('single-tour') ) {

		//  Render a map onto the selected element

		function new_map( $el ) {

			var $markers = $el.find('.marker');

			var args = {
				zoom: 16,
				center: new google.maps.LatLng(0, 0),
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				styles: [
					{
						featureType: 'landscape.man_made',
						elementType: 'geometry',
						stylers: [{color: '#f2f2f2'}]
					},
					{
						featureType: 'poi.park',
						elementType: 'geometry',
						stylers: [{color: '#b3e37e'}]
					},
					{
						featureType: 'road',
						elementType: 'geometry',
						stylers: [{color: '#d6d397'}]
					},
					{
						featureType: 'water',
						elementType: 'geometry',
						stylers: [{color: '#d1dcf2'}]
					},
					{
						featureType: 'water',
						elementType: 'labels.text.fill',
						stylers: [{color: '#666666'}]
					},
					{
						featureType: 'water',
						elementType: 'labels.text.stroke',
						stylers: [{color: '#ffffff'}]
					}
				]
			};

			var map = new google.maps.Map( $el[0], args);

			map.markers = [];

			$markers.each(function(){

				add_marker( $(this), map );

			});

			center_map( map );

			return map;
		  
		}

		// Add a marker to the selected map

		function add_marker( $marker, map ) {

			var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				icon: stylesheetDir + '/library/img/marker.png'
			});

			map.markers.push( marker );

			if( $marker.html() ) {

				// create infowindow
				var infowindow = new google.maps.InfoWindow({
					content: $marker.html()
				});

				infoWindows.push(infowindow);

				google.maps.event.addListener(marker, 'click', function() {

					// close all
					for (var i = 0; i < infoWindows.length; i++) {
						infoWindows[i].close();
					}

					infowindow.open( map, marker );

				});

				google.maps.event.addListener(map, 'click', function() {
					infowindow.close();
				});

			}

		}

		// Center the map, showing all markers attached to it

		function center_map( map ) {

			var bounds = new google.maps.LatLngBounds();

			$.each( map.markers, function( i, marker ){

				var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

				bounds.extend( latlng );

			});

			if( map.markers.length == 1 ) {
				map.setCenter( bounds.getCenter() );
				map.setZoom( 16 );
			} else {
				map.fitBounds( bounds );
			}

		}

		// Render each map when the page has loaded

		var map = null;

		$(document).ready(function(){

			$('.map').each(function(){

				map = new_map( $(this) );

			});

		});

	} // endif

})(jQuery);