<?php get_header(); ?>	

<?php
$category = get_the_category(); 

?>	

<div class="post section post-5390 post-name-find-your-home-mobile post-author-16 not-single page no-thumbnail page-title-area rounded-corners-8px"><div class="mir-cat-title"><?php echo $category[0]->cat_name; ?></div></div>

	<?php include( 'blog-loop.php' ); ?>

<?php get_footer(); ?>