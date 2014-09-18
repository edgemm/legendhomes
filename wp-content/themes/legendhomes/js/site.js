	// initialise plugins
	jQuery(function(){

		jQuery('ul.nav').supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    27,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();
      
        jQuery("#slider").easySlider({
//			auto: true,
			continuous: true 
		});        
//		jQuery("#mirslide").easySlider({
//			auto: true,
//			continuous: true 
//		});
		jQuery('#mirslider').jcarousel({
		wrap: 'circular',
		animation: 1400
	});
	
		jQuery(".cBox").colorbox({iframe:true, innerWidth:500, innerHeight:550});

		jQuery(".team-member-info").removeClass("active").css("opacity", "0");

		var makeActive; // for adding class after hover
		jQuery(".team-member-info").hover(
			function() {
				jQuery(this)
				    .animate({opacity:'0.8'}, 600, function() {
					jQuery(this).addClass("active");
				    });
			},
			function() {
				jQuery(this)
				    .animate({opacity:'0'}, 600, function() {
					jQuery(this).removeClass("active");
				    });
			}
		);
		
		jQuery(".team-member-info .team-member-url").click(
			function(e) {
				if (!$(this).parent().hasClass("active")) {
					e.preventDefault();
				}
			}
		);

	});
	

//now we are going to delete cookies so realtor login appears "legit"
	
function readCookies() {
   var allcookies = document.cookie;
   var cookiepairs = allcookies.split(';');

   // Now take key value pair out of this array

   var cookiearray = [];

   for(var i=0; i<cookiepairs.length; i++){
      name = cookiepairs[i].split('=')[0].replace(/(^ +| +$)/g,'');
      value = cookiepairs[i].split('=')[1];
      cookiearray[name] = value;
   }
   return cookiearray;
}

function Get_Cookie( name ) {

	var start = document.cookie.indexOf( name + "=" );
	var len = start + name.length + 1;
	if ( ( !start ) &&
	( name != document.cookie.substring( 0, name.length ) ) )
	{
		return null;
	}
	
	if ( start == -1 ) return null;
	var end = document.cookie.indexOf( ";", len );
	if ( end == -1 ) end = document.cookie.length;
		return unescape( document.cookie.substring( len, end ) );
	}

function Delete_Cookie( name, path, domain ) {
	if ( Get_Cookie( name ) ) document.cookie = name + "=" +
	( ( path ) ? ";path=" + path : "") +
	( ( domain ) ? ";domain=" + domain : "" ) +
	";expires=Thu, 01-Jan-1970 00:00:01 GMT";
}


function delRealtorCookie ( ) { 

	//console.log('clicked');

	var realcookie = readCookies();
	//console.log('realcookie',realcookie);
	for ( key in realcookie ) {
	//	console.log('try',key);
		if (key.match(/wp-postpass/)) {
	//	console.log('match',key);
		Delete_Cookie( key, '/' );
	//	console.log('delete',key);
	location.reload(true);
		}
	
	}

}

/*USAGE:  


var cookies = readCookies();

for ( key in cookies ) {

	if ( key.match(/^wp-schmooza/) ) {
		
		Delete_Cookie( key );
	}
}

*/