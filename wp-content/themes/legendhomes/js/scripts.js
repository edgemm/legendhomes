(function ($, root, undefined) {
	
$(function () {

/****************************
		NAVIGATION
****************************/

// toggle nav items with submenus
$( '.menu-item-has-children > .menu-link' ).click(function(e){

		e.preventDefault();
		
		var p = $( this ).parent();
	
		$( '.menu-item-has-children' ).not( p ).removeClass( 'start-open' ).addClass( 'hidden' );
		
		p.toggleClass( 'hidden' );

});


/****************************
		ANIMATIONS
****************************/

// set height for hidden/collapsed elements to open to
function getHeight( t, a ) {

	var h = 0,
		i;

	t.children().each( function() {

		i = $( this ).outerHeight( true );

		h = h + i;

	});

	t.attr( 'data-height', h );

}


/****************************
		FORMS
****************************/

// placeholder attribute support for <= IE9
// https://github.com/mathiasbynens/jquery-placeholder
$( 'input, textarea' ).placeholder();


/****************************
		CONTACT AGENT
****************************/

$( '.toggle-form' ).click(function(e) {

	e.preventDefault();

	var t = $( this ),
		i = t.attr( 'data-toggle-id' ),
		a = t.attr( 'data-agent' ),
		h = $( '#' + i );

	h.css( 'height', function(){
		return h.attr( 'data-height' ) + "px";
	});
	h.removeClass( 'hidden' );

});

/****************************
		SOCIAL MEDIA
****************************/

// sharing buttons
$( '.share-facebook, .share-twitter' ).click(function(e){

	e.preventDefault();
	
	window.open( $( this ).attr( 'href' ), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600' );

});

/****************************
		SHARE HOME
****************************/

// sharing buttons
$( '.js-share-home' ).click(function(e){

	e.preventDefault();

	var $home = $(this).parents( '.columns' );
	var $modal = $( '.form-share-home' ).parents( '.share-homes' ).find( '.modal' );

	$modal.find( '.modal-field-container' ).find( 'input, textarea' ).val( '' );

	var specs = [];

	specs['url'] = $home.find( '.home-url' ).attr( 'href' );
	specs['img'] = $home.find( '.home-url' ).find( 'img' ).attr( 'src' ).replace( '550x363', 'sharing' );
	specs['addr'] = $home.attr( 'data-addr' );
	specs['price'] = $home.find( '.related-home-price' ).text().trim();
	specs['beds'] = $home.attr( 'data-beds' );
	specs['baths'] = $home.attr( 'data-baths' );
	specs['sqft'] = $home.attr( 'data-sqft' ).toLocaleString();

	for ( var k in specs ) {

		$modal.find( 'input[name="share-home-' + k + '"]' ).val( specs[k] );

	}
	
	$modal.addClass( 'show' );

});

/****************************
		MODALS
****************************/

// sharing buttons
$( '.js-modal-close' ).click(function(e){

	e.preventDefault();

	$(this).parents( '.modal' ).removeClass( 'show' );

});


/****************************
		COLLAPSING
****************************/

var hash = window.location.hash.substring(1);

$( '.section-collapse' ).find( '.headline-anchor' ).each(function(){

	if( $( this ).attr( 'name' ) == hash ) {

		var p = $( this ).parents( '.section-collapse' );

		p.addClass( 'anchor-target' );
		
		setTimeout(function() {
			window.scrollTo( 0, p.offset().top );
		}, 1);

	}

});	

$( '.section-collapse' ).not( '.anchor-target' ).addClass( 'collapse' );

function collapseSetHeight( t ) {

	var p = t.parents( '.section-collapse' ),
		v = '';

	if ( p.attr( 'data-height' ) ) {

		v = p.attr( 'data-height' );;

	} else {

		var h = $( this ).outerHeight( true ),
			c = p.children( '.container' ).outerHeight( true );

		v = c + h;

	}

	p.css( 'height', v + 'px' );

}

$( '.headline-collapse' ).click(function(){

	collapseSetHeight( $( this ) );

	$( this ).parent().toggleClass( 'collapse' );

});


/****************************
		SIZING
****************************/

function screenChange() {

	// set height of submenus
	$( '.sub-menu' ).each(function(){
	
		var t = $( this );
	
		getHeight( t );
	
		t.css( 'height', function(){
			return t.attr( 'data-height' ) + 'px';
		});
	
	});

	// gallery
	$( '.gallery-spotlight' ).css( 'height', 'auto' );

	// collapsing sections
	$( '.section-collapse, .toggle-hidden' ).each(function(){
	
		getHeight( $( this ) );
	
	});
	
	$( '.headline-collapse' ).each(function(){

		collapseSetHeight( $( this ) );

	});

}

$( window ).load(function(){

	screenChange();

});
$( window ).resize(function(){ screenChange(); });
window.addEventListener( "orientationchange", function() {
	screenChange();
}, false);

});

})(jQuery, this);
