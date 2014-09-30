<?php get_header(); ?>	

	<?php if ( wptouch_have_posts() ) { ?>
	
		<?php wptouch_the_post(); ?>

		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

			<?php if ( classic_use_thumbnail_icons() && classic_thumbs_on_single() ) { ?>
				<?php include('thumbnails.php'); ?>
			<?php } ?>
            
            
            

            	

			<h2><?php wptouch_the_title(); ?></h2>

			<div class="date-author-wrap">
				<?php if ( classic_show_date_single() ) { ?>
					<div class="<?php wptouch_date_classes(); ?>">
						<?php _e( "Published on", "wptouch-pro" ); ?> <?php wptouch_the_time( 'F jS, Y' ); ?>
					</div>			
				<?php } ?>	
				<?php if ( classic_show_author_single() ) { ?>
					<div class="post-author">
						<?php _e( "Written by", "wptouch-pro" ); ?>: <?php the_author(); ?> 
					</div>
				<?php } ?>	
			</div>
		</div>	
		
		<div class="<?php wptouch_post_classes(); ?> rounded-corners-8px">

		<!-- text for 'back and 'next' is hidden via CSS, and replaced with arrow images -->
			

			
			<div id="smc-fix-shadow" class="<?php wptouch_content_classes(); ?>">
            
            
           

	<div class="headmeta">			

		<h2><span></span></h2>

		<div class="headtxtbar"></div>		

	</div>		

            
            
            <!-- start smc home image for single post listing -->
             <!--Sold Banner And Home Image smc-->

<?php $img = get_post_meta($post->ID,'home-image',true); if ($img !== '') { ?>
    
			<div class="home-sold" style="background-image:url(<?php echo $img; ?>); background-size:100% auto; max-height:458px; max-width:550px; margin-bottom:8px" >
            
<?php if(get_field('show_sold_banner')) { ?>

<img src="/wp-content/themes/legendhomes/images/LH-SoldBanner.png">

<?php } else { ?>

<img width="100%" height="auto" src="/wp-content/themes/legendhomes/images/smc-image-spacer.gif">

<?php } ?>
            
            </div>
				
<?php } ?>	

<!--End Sold Banner And Home Image smc-->
				<?php $desc = get_post_meta($post->ID,'home-image-description',true);
						if ($desc !== '') { echo '<p class="wp-caption-text">'.$desc.'</p>';}
						 ?>
            <!-- end smc home image for single post listing -->
            <br>
            
				<?php wptouch_the_content(); ?>
                
                </div>
                
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

            var contentString = '<div id="content2">'+
            
            '<div id="bodyContent">'+
            '<p><a target="_blank" href="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q='+escape(results[0].formatted_address)+'&amp;ie=UTF8&amp;view=map">'+results[0].formatted_address+'</a>'+
            '</p>'+
            '</div>'+
            '</div>';
            //&amp;sll=29.67226,-94.873971

            var infowindow = new google.maps.InfoWindow({
               content: contentString,
               maxWidth: 300
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
                        
                        
                        

				<?php if ( classic_show_cats_single() || classic_show_tags_single() || wp_link_pages( 'echo=0' ) ) { ?>
					<div class="single-post-meta-bottom">
						<?php wp_link_pages( 'before=<div class="post-page-nav">' . __( "Article Pages", "wptouch-pro" ) . ':&after=</div>&next_or_number=number&pagelink=page %&previouspagelink=&raquo;&nextpagelink=&laquo;' ); ?>          
	
						<?php if ( classic_show_cats_single() ) { ?>
							<div class="post-page-cats"><?php _e( "Categories", "wptouch-pro" ); ?>: <?php if ( the_category( ', ' ) ) the_category(); ?></div>
						<?php } ?>
	
						<?php if ( classic_show_tags_single() ) { ?>					
							<?php if ( function_exists( 'get_the_tags' ) ) the_tags( '<div class="post-page-tags">' . __( 'Tags', 'wptouch-pro' ) . ': ', ', ', '</div>' ); ?>  
						<?php } ?>
						
						<?php if ( classic_show_share_single() ) { ?>		
							<div id="action-buttons">			
								<a href="javascript:void(0);" id="share-toggle" class="grey-button no-ajax"><?php _e( "Share Article", "wptouch-pro" ); ?></a>
								&nbsp; &nbsp;
								<a href="javascript:void(0);" id="instapaper-toggle" class="grey-button no-ajax"><?php _e( "Save to Instapaper", "wptouch-pro" ); ?></a>
							</div>
							<ul id="share-links" class="post rounded-corners-8px">
								<li id="twitter">
									<a class="no-ajax" target="_blank" href="http://m.twitter.com/home/?status=<?php echo urlencode( html_entity_decode( wptouch_get_title() . ' -> ' . get_permalink() ) ); ?>"><?php _e( "Share on Twitter", "wptouch-pro" ); ?></a>
								</li>
								<li id="facebook">
									<a class="no-ajax" target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>&t=<?php the_title();?>"><?php _e( "Share on Facebook", "wptouch-pro" ); ?></a>
								</li>
								<li id="email">
									<a class="no-ajax" href="mailto:?subject=<?php
								wptouch_get_bloginfo('site_title'); ?>%20-%20<?php the_title_attribute();?>&body=<?php _e( "Check out this article:", "wptouch" ); ?>%20<?php the_permalink(); ?>"><?php _e( "Share via E-Mail", "wptouch-pro" ); ?></a>
								</li>
								<li id="delicious">
									<a class="no-ajax" target="_blank" href="http://del.icio.us/post?url=<?php the_permalink(); ?>&title=<?php the_title();?>"><?php _e( "Save to Del.icio.us", "wptouch-pro" ); ?></a>
								</li>
							</ul>
						<?php } ?>

					</div>   
				<?php } ?>

			

			
		</div><!-- wptouch_posts_classes() -->

		<?php } ?>

		

<?php get_footer(); ?>