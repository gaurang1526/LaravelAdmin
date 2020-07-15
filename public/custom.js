$.getScript('dist/js/cookie/jquery.cookie.js', function()
{
	if (typeof $.cookie('primary_color') === 'undefined'){
	 	//$( ".btn-primary" ).css( "background-color", "blue" );
	} else {
		var primary_color = $.cookie("primary_color");
		$( ".btn-primary" ).css( "background-color", primary_color );
		$( ".card-primary .card-header" ).css( "background-color", primary_color );
		//$( "a" ).css( "color", primary_color );

		var secondary_color = $.cookie("secondary_color");
		$( ".btn-secondary" ).css( "background-color", secondary_color );
		$( ".card-secondary .card-header" ).css( "background-color", secondary_color );
	}
});
