jQuery(document).ready( function($) {

	/*** EQUALIZE ELEMENT HEIGHTS ***/

    $(window).resize(function(){

      if (Modernizr.mq('(min-width: 1024px)')) {

        // reset in case it's already been equalized
        unEqualize('.card');

        // equalize
        equalize('.card');

      } else {

        unEqualize('.card');
			
      }
    }).resize();   // Cause an initial widow.resize to occur

	function getMaxHeight(s) {

		var maxHeight = 0;

		// get biggest
		$(s).each(function(){
			if ( $(this).outerHeight() > maxHeight ) { maxHeight = $(this).outerHeight(); }
		});

		return maxHeight;
	}

	function equalize(s) {
		$(s).outerHeight( getMaxHeight(s) );
	}

	function unEqualize(s) {
		$(s).outerHeight( 'auto' );
	}

} );
