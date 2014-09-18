<?php get_header() ?>

<?php //Determines the parrent page to pull in Heading/Sub Heading
if (in_array("press-releases", explode("/", $_SERVER["REQUEST_URI"]))) {$headID = 4716;}
else if (in_array("articles", explode("/", $_SERVER["REQUEST_URI"]))) {$headID = 4694;}
else if (in_array("events", explode("/", $_SERVER["REQUEST_URI"]))) {$headID = 4721;}
else if (in_array("promotions", explode("/", $_SERVER["REQUEST_URI"]))) {$headID = 4723;}

?>


	<div class="headmeta">			
		<h2><span><?php echo get_post_meta($headID,'Heading-Title',true); ?></span></h2>
		<div class="headtxtbar"><?php echo get_post_meta($headID,'Heading-SubTitle',true); ?></div>		
	</div>		
<?php //Replaces the heading image with the Post Thumbnail if it exists
if (get_the_post_thumbnail($post->ID) != "") {$headID = $post->ID;}
?>
	<div id="container">
		<div class="headimgfloat"><?php echo get_the_post_thumbnail($headID, 'full'); ?></div>
		<div id="content">							
			<?php the_post() ?>

			<div id="post-<?php the_ID() ?>" class="<?php sandbox_post_class() ?>">
				<h2 class="entry-title"><?php the_title() ?></h2>
				<div class="entry-content">
				<?php $img = get_post_meta($post->ID,'home-image',true);
						if ($img !== '') {
						echo '<img src="'.$img.'" />';
						} ?>
				<?php $desc = get_post_meta($post->ID,'home-image-description',true);
						if ($desc !== '') { echo '<p class="wp-caption-text">'.$desc.'</p>';}
						 ?>
<?php the_content() ?>

<?php edit_post_link() ?>

<?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'sandbox' ) . '&after=</div>') ?>
				</div>
				</div><!-- .post -->

		</div><!-- #content -->
	</div><!-- #container -->

	<div id="sidebar">
	<?php $category = ''; ?>
	<?php if (in_array("legend-villebois-releases-new-chateau-collection-homes", explode("/", $_SERVER["REQUEST_URI"]))) $category="villebois-contact"; ?>
	<?php  get_sidebar($category);  ?>
	</div>

<?php get_footer() ?>
