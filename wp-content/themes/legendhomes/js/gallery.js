(function ($, root, undefined) {
	
$(function () {

//var gallery = $( '.gallery-spotlight' ).hammer({});
//
//gallery.on( 'swipeleft swiperight', function( e ) {
//	console.log( "we just did a " + e.type );
//});

$( '.gallery-thmbs' )
	//.not( '#post-9 .gallery-spotlight' )
	.siblings( '.gallery-spotlight' )
	.owlCarousel({
		autoHeight		: true,
		lazyLoad			: true,
		pagination		: false,
		rewindSpeed		: 500,
		singleItem		: true
});

var gallery = $( '.gallery-spotlight' ).data( 'owlCarousel' );



// display clicked thumbnail as main gallery img
$( '.gallery-thmbs-img' ).click(function(){

	var i = $( this ).parent().index();

	gallery.goTo( i );

});

// add navigation buttons to main gallery
$( '.gallery-spotlight .owl-wrapper-outer' ).append(function(){

	var prev = '<button class="gallery-nav toggle-prev" type="button"><span class="triangle img-replace">Previous</span></button>',
		next = '<button class="gallery-nav toggle-next" type="button"><span class="triangle img-replace">Next</span></button>';

		return prev + next;

});

// navigation (mobile only)
$( '.gallery-nav' ).click(function(){

	if ( $( this ).is( '.toggle-prev' ) ) {

		gallery.prev();

	} else if ( $( this ).is( '.toggle-next' ) ) {

		gallery.next();

	}

});

// gallery navigation
$( '.gallery-thmbs-nav' ).click(function(){

	var list = $( this ).siblings( '.gallery-thmbs-container' ).children( '.gallery-thmbs-list' ),
		thmb, // "next" thumbnail
		left, // store left pos of "next" thumbnail
		current = 0, // current left position
		i = parseInt( list.attr( 'data-index' ) );
		
		list.children().each(function(){
				$( this ).attr( 'data-leftPos', $( this ).position().left );
		});
	
	if ( $( this ).is( '.toggle-prev' ) ) {
	
		if( i - 1 >= 0) i = i - 1;
		
		list.attr( 'data-index', i );
	
		thmb = list.children( '.gallery-thmbs-item' ).eq( i );
		
		left = thmb.position().left + parseInt( thmb.css( 'margin-left' ) );
	
	} else if ( $( this ).is( '.toggle-next' ) ) {
	
		if( i + 1 < list.children( '.gallery-thmbs-item' ).length ) i = i + 1;
	
		list.attr( 'data-index', i );
	
		thmb = list.children( '.gallery-thmbs-item' ).eq( i );
	
		left = thmb.position().left + parseInt( thmb.css( 'margin-left' ) );
		current = -parseInt( list.css( 'left' ) ); // make css value positive int for math
		
		var end = list.children( '.gallery-thmbs-item' ).last(),
			endWidth = end.outerWidth(),
			endLeft = end.position().left + parseInt( end.css( 'margin-left' ) ),
			listWidth = list.outerWidth();
	
		if ( left + listWidth > endWidth + endLeft ) {
	
			left = endLeft + endWidth - listWidth;
	
			list.attr( 'data-index', i - 1 ); // prevent from continuing to add after reached the end
	
		}
	
	}
	
	list.css( 'left', '-' + left + 'px' );

});

});

})(jQuery, this);
