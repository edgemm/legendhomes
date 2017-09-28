<?php

require_once( locate_template( "inc/mobile_detect.php" ) );
$detect = new Mobile_Detect;

$mobile_class = ( $detect->isMobile() ) ? "isMobile" : "notMobile";

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
		<link href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" rel="shortcut icon">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<?php wp_head(); ?>
		
		<?php // add in schema
		
		if( is_archive() ) :
			$url = $_SERVER[ 'REQUEST_URI' ];
	
			// grab values if unique archive pages, otherwise set generic field value
			switch ( $url ) {
		
				case '/new-homes/':
					$schema = get_field( 'archive_schema_homes', 'options' );
					break;
				case '/home-plans/':
					$schema = get_field( 'archive_schema_plans', 'options' );
					break;
				case '/communities/':
					$schema = get_field( 'archive_schema_communities', 'options' );
					break;
				case '/new-homes/?community=legend-at-villebois':
					$schema = get_field( 'community_seo_schema_homes', 7 );
					break;
				case '/home-plans/?community=legend-at-villebois':
					$schema = get_field( 'community_seo_schema_plans', 7 );
					break;
				case '/new-homes/?community=willamette-landing':
					$schema = get_field( 'community_seo_schema_homes', 8 );
					break;
				case '/home-plans/?community=willamette-landing':
					$schema = get_field( 'community_seo_schema_plans', 8 );
					break;
				case '/new-homes/?community=sylvia':
					$schema = get_field( 'community_seo_schema_homes', 9 );
					break;
				case '/home-plans/?community=sylvia':
					$schema = get_field( 'community_seo_schema_plans', 9 );
					break;
				default:
					$schema = get_field( "schema", get_the_ID() );
		
			}
			
		else:
		
			$schema = get_field( "schema", get_the_ID() );
		
		endif;
		
		if( !empty( $schema ) ) echo $schema;
		
		?>

	</head>
	<body <?php body_class( $mobile_class ); ?>>

		<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-5MGDDS"
		height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
		<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
		new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer','GTM-5MGDDS');</script>

		<header class="header" role="banner">

			<div class="logo">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" class="logo-img" alt="">
				</a>
			</div>
			<!-- /.logo -->

			<input type="radio" name="nav" id="nav-expand" class="nav-toggle" />
			<label for="nav-expand" class="nav-trigger img-replace">
				<span class="nav-trigger-bar"></span>
				<span class="nav-trigger-bar"></span>
				<span class="nav-trigger-bar"></span>
				<span class="nav-trigger-bar"></span>
			</label>
			<input type="radio" name="nav" id="nav-collapse" class="nav-toggle" />
			<label for="nav-collapse" class="nav-collapse nav-toggle img-replace"></label>

			<nav id="nav" class="nav" role="navigation">
				<?php edgemm_main_nav(); ?>
			</nav>
			<!-- /#nav -->

		</header>
		<!-- /.header -->
