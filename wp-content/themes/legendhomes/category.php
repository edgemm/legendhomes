<?php get_header() ?>
<?php
/*
$this_cat = get_category($cat);
$this_cat_id = $this_cat->cat_ID;
$category = get_the_category();
$parent = get_category($category[0]->category_parent);
$categorytitle = $parent->name;
$categorydesc = $parent->description;
if (!empty($categorydesc)) {$cat_des = explode("\r", $categorydesc);} 
*/


$this_cat = get_category($cat);
$this_cat_id = $this_cat->cat_ID;
$category = get_the_category();
$parent = get_category($category[0]->category_parent);

$categorytitle = $parent->name;
$categorydesc = $this_cat->description;	
if ($this_cat_id == 3){ // Checks for the top-level category
$categorytitle = $this_cat->name;
}
if (!empty($categorydesc)) {$cat_des = explode("\r", $categorydesc);} 

?>

	<div class="headmeta">			
		<h2><span><?=$categorytitle?></span></h2>
		<div class="headtxtbar"><?php echo $cat_des[0]; ?></div>		
	</div>		

	<div id="container">
		<div class="headimgfloat"><img src="http://legendhomes.com/uploads/<?php echo $cat_des[1]; ?>" /></div>
		<div id="content">


<?php 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args=array(
	'category__in' => array($this_cat_id),
	'paged' => $paged
);
query_posts($args);
	while ( have_posts() ) : the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<!--<h3 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php printf( __( 'Permalink to %s', 'sandbox' ), the_title_attribute('echo=0') ) ?>" rel="bookmark"><?php the_title() ?></a></h3>-->
				<h3 class="entry-title"><?php the_title() ?></h3>
				<div class="entry-content">
					<?php the_content() ?>
					<?php $gmap = get_post_meta($post->ID,'google-map',true);
						if ($gmap !== '') {echo '<p>'.$gmap.'</p>';} 
						
						// Gallery Display on the Design Center home Page
						if ($this_cat_id == 5) {
							  $images = getGall("design_center/");
						?>
						<div id="gallery">
						<?php foreach ($images as $key => $value): ?>						
							<img src="/uploads/<?= $value['file'] ?>" alt="Gallery Image" />
						<?php endforeach ?>
						</div><!-- gallery -->
						<script>
							jQuery('#gallery').galleria();
						</script>	
						<?php }  ?>
						
						<?php if (get_the_ID() == 3456){ /* Displays Slideshow on Behind Our Walls sectoin */ ?>

						<div id="homeslideshow">
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive01.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive02.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive03.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive04.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive05.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive06.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive07.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive08.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive09.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive10.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive11.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive12.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive13.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive14.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive15.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive16.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive17.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive18.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive19.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive20.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive21.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive22.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive23.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive24.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive25.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive26.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive27.jpg" />
							<img src="<?php bloginfo('template_directory') ?>/images/thumbdrive/thumbDrive28.jpg" />
							
						</div>	
					<?php  }  ?>

					<?php edit_post_link() ?>

				</div>

			</div><!-- .post -->

<?php endwhile; 
set_query_var("cat",$this_cat_id);
?>
<!--
			<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', 'sandbox' ) ) ?></div>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'sandbox' ) ) ?></div>
			</div>
-->

		</div><!-- #content -->
	</div><!-- #container -->

<div id="sidebar">
<?php
// first, we figure out what category we are in. 
// next, we assign the proper sidebar using the the_sidebar(NAME) wp functionality

function cattoside($name = '') {
		$name = strtolower($name);
		##strip leading and trailing whitespace
		$name = preg_replace('/(^\s+|\s+$)/','', $name);
		##replace runs of 1 or more space with a single dash
		$name = preg_replace('/\s+/','-', $name);
		
		return $name;
}

//if single, find the post id, then we can find the category
if (is_category()) {
	if (get_depth() == 0 ) {
		$category = get_the_category();
		$name = $category[0]->name;
		$side = cattoside($name);
		set_query_var("cat",$this_cat_id);

		get_sidebar($side);	

	} else if (get_depth() == 1 ) {
		$category = get_the_category();
		$parent = get_category($category[0]->category_parent);
		$name = $parent->name;
		$side = cattoside($name);
		set_query_var("cat",$this_cat_id);

		get_sidebar($side);	


	} else {

		$leaf_category = get_the_category();
		$category = $leaf_category;
		$parent_id = $category[0]->category_parent;

		$id_chain = array();
		while ( $parent_id ) {
			array_unshift($id_chain, $parent_id);
			$category = get_category($parent_id);
			$parent_id = $category->category_parent;
		}
		//so now we got an array containing the lineage where the root node is 0.
		//notice we skip the category id of the leaf.. we don't care

		$sidebar_target_category  = $id_chain[0];//for this level always get the root
		
		$pcat = get_category($sidebar_target_category);
		$name = $pcat->name;
		$side = cattoside($name);

		set_query_var("cat",$this_cat_id);
		get_sidebar($side);	


	}

	//echo 'DVR: '.get_depth()." - ".$side;	
//what else could it be besides single or category??? 
} else {
 echo 'wtf at the bottom of category.php, alert your friendly katie';
}

?>
</div>	

<?php get_footer() ?>
