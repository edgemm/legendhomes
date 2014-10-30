<?php get_header() ?>

<?php //Determines the parrent page to pull in Heading/Sub Heading
		 if (get_community() == "edgewater") {$headID = 4375;}
else if (get_community() == "legend-at-villebois") {$headID = 4381;}
else if (get_community() == "village-at-orenco") {$headID = 4468;}
else if (get_community() == "walnut-creek") {$headID = 4502;}
else if (get_community() == "willamette-landing") {$headID = 4528;}
?>
<?php
$category = get_the_category(); 
?>
	<div class="headmeta">			
		<h2><span><?php echo $category[0]->cat_name; ?></span></h2>
		<div class="headtxtbar"></div>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><?php echo get_the_post_thumbnail($headID, 'full'); ?></div>
		<div id="content">							
			<?php the_post() ?>
			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title() ?></h2>
		<div class="entry-content">
<!--Sold Banner And Home Image smc-->
<?php $img = get_post_meta($post->ID,'home-image',true); if ($img !== '') { ?>
			<div class="home-sold" style="background-image:url(<?php echo $img; ?>)" >

<?php if( get_field('show_sold_banner') || stripos( get_field( 'homepage-price' ), "SOLD" ) === false ) { ?>
<img src="/wp-content/themes/legendhomes/images/LH-SoldBanner.png">
<?php } ?>
            </div>
<?php } ?>

<!--End Sold Banner And Home Image smc-->

<?php

$desc = get_post_meta($post->ID,'home-image-description',true);

if ($desc !== '') echo '<p class="wp-caption-text">'.$desc.'</p>';

// display contact button if home hasn't sold
if( !get_field('show_sold_banner') ) { ?>
		 <a href="/about-us/contact-us/" class="strx-zurb-css3-awesome orange large" style="margin: 10px 0 15px;" title="Contact Agent" onclick="_gaq.push(['_trackEvent', 'MIR contact-agent click']);">Contact an Agent About This Home</a>
<?php } ?>
		
<?php the_content() ?>


<?php   
$custom = get_post_custom($post->ID);
$et_address = isset($custom["google-map-address"][0]) ? $custom["google-map-address"][0] : '270 Park Ave. New York';
			?>
            
            <?php // Outputs a map if 'google-map' is set
					  $gmap = get_post_meta($post->ID,'google-map-address',true);
						if ($gmap != "") { ?>
                        
							
							
					
	        
                        
                        <div id="gmaps-border">
      <div id="gmaps-container"></div>
   </div> <!-- end #gmaps-border -->

<script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.1&sensor=true"></script>
   <script type="text/javascript">
      //<![CDATA[
      var map;
      var geocoder;

      initialize();

      function initialize() {
         geocoder = new google.maps.Geocoder();
         geocoder.geocode({
            'address': '<?php echo $et_address; ?>',
            'partialmatch': true}, geocodeResult);   
      }

      function geocodeResult(results, status) {
         
         if (status == 'OK' && results.length > 0) {         
            var latlng = new google.maps.LatLng(results[0].geometry.location.b,results[0].geometry.location.c);
			var myOptions = {
			   zoom: 12,
			   center: results[0].geometry.location, 
			   mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			
			map = new google.maps.Map(document.getElementById("gmaps-container"), myOptions);
			   var marker = new google.maps.Marker({
			   position: results[0].geometry.location,
			   map: map,
			   title:""
			});

            var contentString = '<div id="content">'+
            
            '<div id="bodyContent">'+
            '<p><a target="_blank" href="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q='+escape(results[0].formatted_address)+'&amp;ie=UTF8&amp;view=map">'+results[0].formatted_address+'</a>'+
            '</p>'+
            '</div>'+
            '</div>';
            //&amp;sll=29.67226,-94.873971

            var infowindow = new google.maps.InfoWindow({
               content: contentString,
               maxWidth: 250
	       });

            google.maps.event.addListener(marker, 'click', function() {
               infowindow.open(map,marker);
            });

            google.maps.event.trigger(marker, "click");

         } else {
            //alert("Geocode was not successful for the following reason: " + status);
         }
      }
      //]]>
   </script>
   
   <?php } ?>


<?php edit_post_link() ?>

<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'sandbox' ) . '&after=</div>') ?>
				</div>
				</div><!-- .post -->

		</div><!-- #content -->
	</div><!-- #container -->

	<div id="sidebar">	
	<?php  get_sidebar('find-your-home');  ?>
	</div>

<!-- Google Code for view a home Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1034400106;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "oA22CL7dlQIQ6uKe7QM";
var google_conversion_value = 0;
if (20) {
  google_conversion_value = 20;
}
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/1034400106/?value=20&amp;label=oA22CL7dlQIQ6uKe7QM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


<?php get_footer() ?>