<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

include( 'inc/wp_walker_clean.php' ); // wp menu walker

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (function_exists( 'add_theme_support' ) ) {
    // Add Menu Support
    add_theme_support( 'menus' );

    // Add Thumbnail Theme Support
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'large', 1100, 9999 ); // full width of container area
    add_image_size( 'medium', 550, 9999 ); // half width of container area
    add_image_size( 'small', 9999, 74); // gallery thumbnails

    // Localisation Support
    load_theme_textdomain( 'html5blank', get_template_directory() . '/languages' );
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// Main Navigation
function edgemm_main_nav() {
	wp_nav_menu(
		array(
			'theme_location'  => 'header-menu',
			'menu'            => '',
			'container_id'    => '',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul class="menu">%3$s</ul>',
			'depth'           => 0,
			'walker'          => new Walker_Clean_Menu()
		)
	);
}

// Load site scripts (header)
function edgemm_scripts() {

	if ( $GLOBALS['pagenow'] != 'wp-login.php' && !is_admin() ) :

		wp_register_script( 'edgemm-scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), '1.0.0' );
		wp_enqueue_script( 'edgemm-scripts' );

		wp_register_script( 'jquery-cookie', get_template_directory_uri() . '/js/jquery.cookie.js', array( 'jquery' ), '1.4.1' );
		wp_enqueue_script( 'jquery-cookie' );

		wp_register_script( 'jquery-placeholder', get_template_directory_uri() . '/js/jquery.placeholder.min.js', array( 'jquery' ), '2.3.1' );
		wp_enqueue_script( 'jquery-placeholder' );

		//wp_register_script( 'twitter-share', get_template_directory_uri() . '/js/twitter.share.js', array(), '1.0', true );
		//wp_enqueue_script( 'twitter-share' );
		wp_register_script( 'pinterest-pin', '//assets.pinterest.com/js/pinit.js', array(), '1.0', true );
		wp_enqueue_script( 'pinterest-pin' );

		// gallery scripts
		wp_register_script( 'jquery-owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '1.3.2', true  );
		wp_register_script( 'jquery-gallery', get_template_directory_uri() . '/js/gallery.js', array( 'jquery' ), '1.0.0', true  );
		
		// HTML5 shim for IE8 and lower
		wp_register_script( 'html5-shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js', array(), '3.7.0' );
		wp_script_add_data( 'html5-shim', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'html5-shim' );

	endif;

}

// enqueue css/js for gallery functionality
function gallery_files() {

	wp_enqueue_style( 'owl-carousel' );
	wp_enqueue_style( 'owl-carousel-transitions' );
	wp_enqueue_script( 'jquery-owl-carousel' );
	wp_enqueue_script( 'jquery-gallery' );

}

// Load site styles
function edgemm_styles() {

	global $wp_styles;

	//remove included Google font Open Sans, add new with custom options
	wp_deregister_style( 'open-sans' );
	wp_register_style( 'open-sans', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,800,800italic,700italic,700,600italic,600' );

	// wp_register_style( 'edgemm-styles', get_template_directory_uri() . '/style.css', array(), '1.0.1', 'all' );
	// wp_enqueue_style( 'edgemm-styles' );

	$style_path = get_stylesheet_directory() . '/style.css';
	wp_enqueue_style( 'edgemm-style', get_stylesheet_uri(), '', filemtime( $style_path ) );

	// gallery scripts
	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.3', 'all' );
	wp_register_style( 'owl-carousel-transitions', get_template_directory_uri() . '/css/owl.transitions.css', array(), '1.3.2', 'all' );

}

// Load site admin styles
function edgemm_admin_styles() {

    wp_register_style( 'edgemm-admin-styles', get_template_directory_uri() . '/css/admin/admin-styles.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'edgemm-admin-styles' );

}

// load scripts for home listings admin pages
function edgemm_scripts_homes() {

	global $post_type;

	if ( $_GET[ 'post_type' ] == 'homes' || $post_type == 'homes' ) :

		wp_register_script( 'admin-homes', get_template_directory_uri() . '/js/admin/admin-homes.js', array( 'jquery' ), '1.0', true );
        wp_enqueue_script( 'admin-homes' ); // Enqueue it!

	endif;

}

// Register HTML5 Blank Navigation
function edgemm_register_menu() {
    register_nav_menus( array( // Using array to specify more menus if needed
        'header-menu' => __( 'Header Menu', 'html5blank' ), // Main Navigation
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args( $args = '' ) {
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter( $var ) {
    return is_array( $var ) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list( $thelist ) {
    return str_replace( 'rel="category tag"', 'rel="tag"', $thelist );
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class( $classes ) {
    global $post;
    if (is_home() ) {
        $key = array_search( 'blog', $classes );
        if ( $key > -1) {
            unset( $classes[$key] );
        }
    } elseif (is_page() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    } elseif (is_singular() ) {
        $classes[] = sanitize_html_class( $post->post_name );
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if ( function_exists( 'register_sidebar' ) )
{
    // Define Main Sidebar Widget Area
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'html5blank' ),
        'description' => __( '', 'html5blank' ),
        'id' => 'widget-main-sidebar',
        'before_widget' => '<div id="%1$s" class="%2$s text-center">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="sidebar-widgit-header">',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style() {
    global $wp_widget_factory;
    remove_action( 'wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function edgemm_pagination() {
    global $wp_query;
    $big = 20;
    echo paginate_links(array(
        'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var( 'paged' ) ),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function edgemm_index( $length ) { // Create 20 Word Callback for Index page Excerpts, call using edgemm_excerpt( 'edgemm_index' );
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using edgemm_excerpt( 'edgemm_custom_post' );
function edgemm_custom_post( $length ) {
    return 40;
}

// Create the Custom Excerpts callback
function edgemm_excerpt( $length_callback = '', $more_callback = '' ) {
    global $post;
    if ( function_exists( $length_callback ) ) {
        add_filter( 'excerpt_length', $length_callback );
    }
    if (function_exists( $more_callback ) ) {
        add_filter( 'excerpt_more', $more_callback );
    }
    $output = get_the_excerpt();
    $output = apply_filters( 'wptexturize', $output );
    $output = apply_filters( 'convert_chars', $output );
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function edgemm_view_article( $more ) {
    //global $post;
    //return '... <p><a class="highlight" href="' . get_permalink( $post->ID) . '">' . __( 'View Post', 'html5blank' ) . '</a></p>';
		return '...';
}

// Remove Admin bar
function remove_admin_bar() {
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function edgemm_style_remove( $tag ) {
    return preg_replace( '~\s+type=["\'][^"\']++["\']~', '', $tag );
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

// Custom Gravatar in Settings > Discussion
function blankgravatar ( $avatar_defaults ) {
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

/*------------------------------------*\
	Actions + Filters
\*------------------------------------*/

// Add Actions
add_action( 'wp_enqueue_scripts', 'edgemm_scripts' ); // Add Custom Scripts to wp_head
add_action( 'wp_enqueue_scripts', 'edgemm_styles' ); // Add Theme Stylesheet
add_action( 'admin_enqueue_scripts', 'edgemm_admin_styles' ); // Add admin stylesheet
add_action( 'admin_enqueue_scripts', 'edgemm_scripts_homes' ); // Add scripts for admin view of custom post type 'homes'
add_action( 'init', 'edgemm_register_menu' ); // Add Main
add_action( 'init', 'create_post_types' ); // Add Custom Post Types
add_action( 'add_meta_boxes_homes', 'add_new_homes_metaboxes' ); // add meta boxes for custom post type 'homes'
add_action( 'neighborhood_add_form_fields', 'add_neighborhood_meta' ); // add meta boxes for neighborhood taxonomy
add_action( 'created_neighborhood', 'save_neighborhood_meta' ); // save term meta for neighborhood taxonomy
add_action( 'neighborhood_edit_form_fields', 'edit_neighborhood_meta' ); // edit term meta for neighborhood taxonomy
add_action( 'edited_neighborhood', 'update_neighborhood_meta' ); // update term meta for neighborhood taxonomy
add_action( 'wp_ajax_pull_plan_data', 'pull_plan_data' ); // pull plan data for home listings
add_action( 'wp_ajax_nopriv_pull_plan_data', 'pull_plan_data' ); // pull plan data for home listings
add_action( 'widgets_init', 'my_remove_recent_comments_style' ); // Remove inline Recent Comment Styles from wp_head()
add_action( 'init', 'edgemm_pagination' ); // Add our HTML5 Pagination

// Remove Actions
remove_action( 'wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // Index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter( 'avatar_defaults', 'html5blankgravatar' ); // Custom Gravatar in Settings > Discussion
add_filter( 'body_class', 'add_slug_to_body_class' ); // Add slug to body class (Starkers build)
add_filter( 'widget_text', 'do_shortcode' ); // Allow shortcodes in Dynamic Sidebar
add_filter( 'widget_text', 'shortcode_unautop' ); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' ); // Remove surrounding <div> from WP Navigation
//add_filter( 'nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
//add_filter( 'nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
//add_filter( 'page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter( 'pre_get_posts', 'archive_community_sort' ); // sorting of homes/plans by community
add_filter( 'pre_get_posts', 'archive_plans_archived' ); // removing archived home plans
add_filter( 'pre_get_posts', 'homes_status_sort' ); // sort new homes archive by home status
add_filter( 'wpseo_title', 'yoast_modify_titles', 100 ); // modify <title> created by Yoast for certain pages
add_filter( 'wpseo_metadesc', 'yoast_modify_description', 100, 1 ); // modify <meta name="description"> created by Yoast for certain pages
add_filter( 'wpseo_canonical', 'yoast_modify_canonical', 100, 1 ); // modify <title> created by Yoast for certain pages
add_filter( 'the_category', 'remove_category_rel_from_category_list' ); // Remove invalid rel attribute
add_filter( 'the_excerpt', 'shortcode_unautop' ); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter( 'the_excerpt', 'do_shortcode' ); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter( 'excerpt_more', 'edgemm_view_article' ); // Add 'View Article' button instead of [...] for Excerpts
//add_filter( 'show_admin_bar', 'remove_admin_bar' ); // Remove Admin bar
add_filter( 'style_loader_tag', 'edgemm_style_remove' ); // Remove 'text/css' from enqueued stylesheet
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter( 'the_excerpt', 'wpautop' ); // Remove <p> tags from Excerpt altogether
remove_filter( 'term_description', 'wpautop' ); // Remove <p> tags from term descriptions


/*------------------------------------*\
	Shortcodes
\*------------------------------------*/

function embed_video( $atts ) {

	extract( shortcode_atts(
		array(
			'url' => '',
			'ratio' => '',
		), $atts )
	);
	
	if ( $ratio ) :

		$res = explode( "|", $ratio );

		$res = intdiv( intval( $res[0] ), intval( $res[1] ) );

	endif;

	// http://stackoverflow.com/questions/3136425/get-the-get-variables-from-a-url-string
	parse_str( parse_url( $url, PHP_URL_QUERY ), $u );

	$html = '<div class="video-container"';
	$html .= ( $res ) ? ' style="padding-bottom: ' . $res . '%;">' : '>';
	$html .= '<iframe src="https://www.youtube.com/embed/' . $u[ 'v' ] . '?';
	if( $u[ 'list' ] ) $html .= 'list=' . $u[ 'list' ] . '&';
	$html .= 'enablejsapi=1&rel=0&controls=1&showinfo=0autoplay=0origin=http://legendhomes.com" data-test="test" frameborder="0" allowfullscreen=""></iframe>';
	$html .= '</div>';

	return $html;	

}
remove_shortcode( 'video' );
add_shortcode( 'video', 'embed_video' );

function add_gallery( $atts ) {

	global $post;

	extract( shortcode_atts(
		array(
			'id' => $post->ID,
			'meta' => 'post_photo_gallery'
		), $atts )
	);

	$html = "";

	$images = get_field( $meta, $id );

	if( $images ) :

		$html .= '<div class="gallery-spotlight">';

		foreach( $images as $i ) :

				$html .= '<img class="gallery-spotlight-img lazyOwl"  data-src="' . $i[ 'url' ] . '" srcset="' . $i[ 'sizes' ][ 'medium' ] . ' 550w, ' . $i[ 'sizes' ][ 'large' ] . ' 1100w">';

		endforeach;

		// navigation buttons
		//$html .= '<button class="gallery-nav toggle-prev" type="button">
		//					<span class="triangle img-replace">Previous</span>
		//				</button>';
		//$html .= '<button class="gallery-nav toggle-next" type="button">
		//					<span class="triangle img-replace">Next</span>
		//				</button>';

		$html .= '</div>

		<div class="gallery-thmbs">

		<div class="gallery-thmbs-container">

			<ul class="gallery-thmbs-list" data-index="0">';

			foreach( $images as $i ) :

			$html .= '<li class="gallery-thmbs-item">
					<img class="gallery-thmbs-img" src="' . $i[ 'sizes' ][ 'small' ] . '">
				</li>';

			endforeach;

			$html .= '</ul>
	
						</div>

						<button class="gallery-thmbs-nav toggle-prev" type="button">
							<span class="triangle img-replace">Previous</span>
						</button>
						<button class="gallery-thmbs-nav toggle-next" type="button">
							<span class="triangle img-replace">Next</span>
						</button>

					</div>';

		gallery_files(); // enqueue css/js for gallery
	
	endif;

	return $html;	

}
remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'add_gallery' );


/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/

function create_post_types() {

	// home listings
	$labels_homes = array(
		'name'                  => 'Home Listings',
		'singular_name'         => 'Home Listing',
		'menu_name'             => 'Home Listings',
		'name_admin_bar'        => 'Home Listing',
		'archives'              => 'Home Listing Archives',
		'all_items'             => 'All Home Listings',
		'add_new_item'          => 'Add New Home Listing',
		'add_new'               => 'Add New Home Listing',
		'new_item'              => 'New Home Listing',
		'edit_item'             => 'Edit Home Listing',
		'update_item'           => 'Update Home Listing',
		'view_item'             => 'View Home Listing',
		'search_items'          => 'Search Home Listings',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'featured_image'        => 'Listing Image',
		'set_featured_image'    => 'Set listing image',
		'remove_featured_image' => 'Remove listing image',
		'use_featured_image'    => 'Use as listing image',
		'insert_into_item'      => 'Insert into listing',
		'uploaded_to_this_item' => 'Uploaded to this listing',
		'items_list'            => 'Home Listings list',
		'items_list_navigation' => 'Home Listings list navigation',
		'filter_items_list'     => 'Filter Home Listings list',
	);
	$args_homes = array(
		'label'                 => 'Home Listings',
		'description'           => 'Home Listings',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'public'								=> true,
		'rewrite'								=> array( 'slug' => 'new-homes', 'with_front' => false ),
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-hammer',
		'capability_type'       => 'post',
		'has_archive'						=> true
	);	
	register_post_type( 'homes', $args_homes );

	// home listings
	$labels_plans = array(
		'name'                  => 'Home Plans',
		'singular_name'         => 'Home Plan',
		'menu_name'             => 'Home Plans',
		'name_admin_bar'        => 'Home Plan',
		'archives'              => 'Home Plan Archives',
		'all_items'             => 'All Home Plans',
		'add_new_item'          => 'Add New Home Plan',
		'add_new'               => 'Add New Home Plan',
		'new_item'              => 'New Home Plan',
		'edit_item'             => 'Edit Home Plan',
		'update_item'           => 'Update Home Plan',
		'view_item'             => 'View Home Plan',
		'search_items'          => 'Search Home Plans',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'items_list'            => 'Home Plans list',
		'items_list_navigation' => 'Home Plans list navigation',
		'filter_items_list'     => 'Filter Home Plans list',
	);
	$args_plans = array(
		'label'                 => 'Home Plans',
		'description'           => 'Home Plans',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'public'								=> true,
		'rewrite'								=> array( 'slug' => 'home-plans', 'with_front' => false ),
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-home',
		'capability_type'       => 'post',
		'has_archive'						=> true
	);	
	register_post_type( 'plans', $args_plans );

	// communities
	$labels_plans = array(
		'name'                  => 'Communities',
		'singular_name'         => 'Community',
		'menu_name'             => 'Communities',
		'name_admin_bar'        => 'Community',
		'archives'              => 'Community Archives',
		'all_items'             => 'All Communities',
		'add_new_item'          => 'Add New Community',
		'add_new'               => 'Add New Community',
		'new_item'              => 'New Community',
		'edit_item'             => 'Edit Community',
		'update_item'           => 'Update Community',
		'view_item'             => 'View Community',
		'search_items'          => 'Search Communities',
		'not_found'             => 'Not found',
		'not_found_in_trash'    => 'Not found in Trash',
		'items_list'            => 'Communities list',
		'items_list_navigation' => 'Communities list navigation',
		'filter_items_list'     => 'Filter Communities list',
	);
	$args_plans = array(
		'label'                 => 'Communities',
		'description'           => 'Communities',
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
		'public'								=> true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-admin-multisite',
		'capability_type'       => 'post',
		'has_archive'						=> true
	);	
	register_post_type( 'communities', $args_plans );

}

// add option pages for homes & plans
if ( function_exists( 'acf_add_options_sub_page' ) ){
	// new homes options
	acf_add_options_sub_page(array(
		'title'      => 'Homes Settings',
		'parent'     => 'edit.php?post_type=homes',
		'capability' => 'manage_options'
	));
	// home plans options
	acf_add_options_sub_page(array(
		'title'      => 'Plans Settings',
		'parent'     => 'edit.php?post_type=plans',
		'capability' => 'manage_options'
	));
	// communities options
	acf_add_options_sub_page(array(
		'title'      => 'Communities Settings',
		'parent'     => 'edit.php?post_type=communities',
		'capability' => 'manage_options'
	));
}

// Post Category term meta customizations

function add_post_cat_meta( $taxonomy ) {	
	?>
	<div class="form-field term-display-title">
		<label for="display-title">Display Title</label>
		<input class="postform" id="display-title" type="text" name="cat_display_title">
	</div>
	<div class="form-field term-seo-title">
		<label for="seo-title">SEO Title</label>
		<input class="postform" id="seo-title" type="text" name="cat_seo_title">
	</div>
	<div class="form-field term-seo-meta-desc">
		<label for="seo-meta-desc">SEO Meta Description</label>
		<input class="postform" id="seo-meta-desc" type="text" name="cat_seo_meta_desc">
	</div>
	<?php
}
add_action( 'category_add_form_fields', 'add_post_cat_meta', 10, 2 );


function save_category_meta( $term_id, $tt_id ){

	// display title
	if( isset( $_POST[ 'cat_display_title' ] ) && '' !== $_POST[ 'cat_display_title' ] ){
		$value = $_POST[ 'cat_display_title' ];
		add_term_meta( $term_id, 'cat_display_title', $value, true );
	}
	// seo title
	if( isset( $_POST[ 'cat_seo_title' ] ) && '' !== $_POST[ 'cat_seo_title' ] ){
		$value = $_POST[ 'cat_seo_title' ];
		add_term_meta( $term_id, 'cat_seo_title', $value, true );
	}
	// seo meta description
	if( isset( $_POST[ 'cat_seo_meta_desc' ] ) && '' !== $_POST[ 'cat_seo_meta_desc' ] ){
		$value = $_POST[ 'cat_seo_meta_desc' ];
		add_term_meta( $term_id, 'cat_seo_meta_desc', $value, true );
	}

}
add_action( 'created_category', 'save_category_meta', 10, 2 );

function edit_category_field( $term, $taxonomy ){

	// get current group
	$meta_display_title = get_term_meta( $term->term_id, 'cat_display_title', true );
	$meta_seo_title = get_term_meta( $term->term_id, 'cat_seo_title', true );
	$meta_seo_meta_desc = get_term_meta( $term->term_id, 'cat_seo_meta_desc', true );

	?>
	<tr class="form-field term-menu-sort-order">
		<th scope="row"><label for="menu-sort-order">Display Title</label></th>
		<td><input class="postform" id="menu-sort-order" type="text" name="cat_display_title" value="<?php echo $meta_display_title; ?>"></td>
	</tr>
	<tr class="form-field term-menu-sort-order">
		<th scope="row"><label for="menu-sort-order">SEO Title</label></th>
		<td><input class="postform" id="menu-sort-order" type="text" name="cat_seo_title" value="<?php echo $meta_seo_title; ?>"></td>
	</tr>
	<tr class="form-field term-menu-sort-order">
		<th scope="row"><label for="menu-sort-order">SEO Meta Description</label></th>
		<td><input class="postform" id="menu-sort-order" type="text" name="cat_seo_meta_desc" value="<?php echo $meta_seo_meta_desc; ?>"></td>
	</tr>
	<?php
}
add_action( 'category_edit_form_fields', 'edit_category_field', 10, 2 );

function update_category_meta( $term_id, $tt_id ){

	// display title
	//if( isset( $_POST[ 'cat_display_title' ] ) && '' !== $_POST[ 'cat_display_title' ] ){
	if( isset( $_POST[ 'cat_display_title' ] ) && '' !== get_term_meta( $term_id, 'cat_display_title' ) ){
		$value = $_POST[ 'cat_display_title' ];
		update_term_meta( $term_id, 'cat_display_title', $value );
	}
	// seo title
	//if( isset( $_POST[ 'cat_seo_title' ] ) && '' !== $_POST[ 'cat_seo_title' ] ){
	if( isset( $_POST[ 'cat_seo_title' ] ) && '' !== get_term_meta( $term_id, 'cat_seo_title' ) ){
		$value = $_POST[ 'cat_seo_title' ];
		update_term_meta( $term_id, 'cat_seo_title', $value );
	}
	// seo meta description
	//if( isset( $_POST[ 'cat_seo_meta_desc' ] ) && '' !== $_POST[ 'cat_seo_meta_desc' ] ){
	if( isset( $_POST[ 'cat_seo_meta_desc' ] ) && '' !== get_term_meta( $term_id, 'cat_seo_meta_desc' ) ){
		$value = $_POST[ 'cat_seo_meta_desc' ];
		update_term_meta( $term_id, 'cat_seo_meta_desc', $value );
	}

}
add_action( 'edited_category', 'update_category_meta', 10, 2 );


/*------------------------------------*\
	Custom Post Meta Boxes
\*------------------------------------*/

// add homes meta boxes
function add_new_homes_metaboxes() {

	add_meta_box(
		'meta_pull_plan_data',
		'Pull Home Plan Data',
		'add_meta_homes_pull_plan_data',
		'homes',
		'side',
		'low'
	);

}

// button to update home meta with plan data
function add_meta_homes_pull_plan_data(){

	echo '<p>Update the details of this listing based on the floorplan selected on the left. Will overwrite current values.</p>';
	echo '<button id="edgemm_pull_plan_data" class="btn-edgemm" type="button">Pull Plan Data</button>';

}


/*------------------------------------*\
	AJAX
\*------------------------------------*/

// update home listing details with selected floorplan data
function pull_plan_data() {

	$id = $_POST[ 'plan_id' ];

	$custom_fields = get_post_custom( $id );
	$custom_fields[ 'plan_content' ] = apply_filters( 'the_content', get_post_field( 'post_content', $id ) );

	if ( $custom_fields[ 'plans_additional_elevation' ] ) :

		$custom_fields[ 'plans_additional_elevation' ][ 'url' ] = wp_get_attachment_image_src( $custom_fields[ 'plans_additional_elevation' ][0], 'thumbnail' );
		$custom_fields[ 'plans_additional_elevation' ][ 'alt' ] = get_post_meta( $custom_fields[ 'plans_additional_elevation' ][0], '_wp_attachment_image_alt', true);
	

	endif;
	
	echo json_encode( $custom_fields );
	
	exit;

}

// get image url & height for gallery
add_action('wp_ajax_get_gallery_img', 'get_gallery_img');
add_action('wp_ajax_nopriv_get_gallery_img', 'get_gallery_img');

function get_gallery_img() {

	$id = $_POST[ 'img_id' ];
	$w = intval( $_POST[ 'spot_width' ] );

	$size = ( $w > 550 ) ? 'large' : 'medium';

	$url = wp_get_attachment_image_src( $id, $size )[0];

	preg_match( '/^.*-\d{1,4}x(\d{1,4})\.(?:jpg|png|gif|jpeg)$/', $url, $height );

	$img = array(
		'url' => $url,
		'height' => $height[1]
	);
	
	echo json_encode( $img );

	exit;

}


/*------------------------------------*\
	THEME CONTENT FUNCTIONS
\*------------------------------------*/

// adds currency symbols
function prettyPrice( $p ) {

	if( is_numeric( $p ) ) :
	
		return "$" . number_format( $p );
	
	endif;

}

// extracts video shortcode
function get_video_shortcode() {

	global $post;

	if( $post ) :
		
		$pattern = get_shortcode_regex();
		preg_match('/'.$pattern.'/s', $post->post_content, $matches);
		
		if( $matches ) :

			if ( is_array( $matches ) && $matches[2] == 'video' ) :

			   $shortcode = $matches[0];
			   return do_shortcode( $shortcode );

			endif;

		endif;

	endif;

}


// removes ints used for indexing on new homes - OLD
/*function get_home_status_old( $s = 'coming-soon', $i = NULL, $c = NULL ) {

	$pattern = '/^\d+\-/';

	if ( $s != 'sold' ) :

		if( strpos( $s, 'move-in-ready' ) ) :

			return 'move-in-ready';
		
		elseif( strpos( $s, '-coming-soon' ) ) :

			$available = get_field( 'homes_availability', $i );
			
			if( $available ) :
			
				$date = DateTime::createFromFormat( 'F Y', $available );

				return 'Complete in ' . $date->format( 'F' );

			else:

				return 'coming-soon';

			endif;

		else :

			return preg_replace( $pattern, '', $s );

		endif;

	else:

		return 'sold'

	endif;

}*/

// removes ints used for indexing on new homes
function get_home_status( $s = 'coming-soon', $i = NULL, $c = NULL ) {

	$pattern = '/^\d+\-/';
	$status = array();

	if ( ( $c->communities_special && $c->communities_special_sales ) && !strpos( $s, 'sold' ) ) :

		$status[ 'banner' ] = $c->special_home_banner;
		$status[ 'class' ] = "special";

	elseif( strpos( $s, 'move-in-ready' ) ) :

		$status[ 'banner' ] = 'Move-In Ready';
		$status[ 'class' ] = 'move-in-ready';
	
	elseif( strpos( $s, '-coming-soon' ) ) :
		
		$availability = get_field( 'homes_availability', $i );
		
		$status[ 'banner' ] = ( $availability !== '' ) ? 'Complete ' . $availability : 'Coming soon';
		$status[ 'class' ] = 'coming-soon';

	elseif( strpos( $s, 'pending' ) ) :

		$status[ 'banner' ] = 'Pending';
		$status[ 'class' ] = 'pending';

	elseif( strpos( $s, 'sold' ) ) :

		$status[ 'banner' ] = 'Sold';
		$status[ 'class' ] = 'sold';

	endif;

	return $status;

}

// sort homes/plans by community on archive pages
function archive_community_sort( $q ) {

	if ( is_post_type_archive() && !is_admin() && $q->is_main_query() && !empty( $_GET[ 'community' ] ) ) :

		$meta_query = $q->get( 'meta_query' );
		
		$type = $q->query[ 'post_type' ];
		$community = get_page_by_path( $_GET[ 'community' ], OBJECT, 'communities' );

		$meta_query[] = array(
			'key'		=> $type . '_community',
			'value'		=> $community->ID,
			'compare'	=> 'IN'
		);

		$q->set( 'meta_query', $meta_query );

	endif;

}

function archive_plans_archived( $q ) {

	if ( is_post_type_archive( 'plans' ) && !is_admin() && $q->is_main_query() ) :

		$meta_query = $q->get( 'meta_query' );

		$meta_query[ 'archive_clause' ] = array(
			'key' => 'plans_archive',
			'value'	=> '1',
			'compare'	=> '!='
		);

		$q->set( 'meta_query', $meta_query );

	endif;

}

// order new homes by status
function homes_status_sort( $q ) {

	if ( is_post_type_archive( 'homes' ) && !is_admin() && $q->is_main_query() ) :

		$meta_query = $q->get( 'meta_query' );

		$meta_query[ 'status_clause' ] = array(
			'key' => 'homes_status',
			'value'	=> 'sold',
			'compare'	=> 'NOT LIKE'
		);
		$meta_query[ 'availability_clause' ] = array(
			'key' => 'homes_availability'
		);

		$q->set( 'meta_query', $meta_query );			
		$q->set( 'meta_key', 'homes_status' );
		$q->set( 'orderby', array(
			'status_clause' => 'ASC',
			'availability_clause' => 'ASC',
			'rand'	=> 'ASC'
		));

	endif;

}


/*------------------------------------*\
	YOAST Overrides
\*------------------------------------*/

function yoast_modify_titles( $title ) {

		$url = $_SERVER[ 'REQUEST_URI' ];
		
		switch ( $url ) {

			case '/new-homes/?community=legend-at-villebois':
				$title = get_field( 'community_seo_title_homes', 7 );
				break;
			case '/home-plans/?community=legend-at-villebois':
				$title = get_field( 'community_seo_title_plans', 7 );
				break;
			case '/new-homes/?community=willamette-landing':
				$title = get_field( 'community_seo_title_homes', 8 );
				break;
			case '/home-plans/?community=willamette-landing':
				$title = get_field( 'community_seo_title_plans', 8 );
				break;
			case '/new-homes/?community=legend-at-sylvia':
				$title = get_field( 'community_seo_title_homes', 9 );
				break;
			case '/home-plans/?community=legend-at-sylvia':
				$title = get_field( 'community_seo_title_plans', 9 );
				break;
			case '/sylvia-news/':
				$title = ( get_term_meta( 68, 'cat_seo_title', true ) ) ? get_term_meta( 68, 'cat_seo_title', true ) : $title;
				break;
			default:
				$title = $title;
	
		}
	
	return $title;

}
function yoast_modify_description( $description ) {

	$url = $_SERVER[ 'REQUEST_URI' ];
	
	switch ( $url ) {

		case '/new-homes/?community=legend-at-villebois':
			$description = get_field( 'community_seo_desc_homes', 7 );
			break;
		case '/home-plans/?community=legend-at-villebois':
			$description = get_field( 'community_seo_desc_plans', 7 );
			break;
		case '/new-homes/?community=willamette-landing':
			$description = get_field( 'community_seo_desc_homes', 8 );
			break;
		case '/home-plans/?community=willamette-landing':
			$description = get_field( 'community_seo_desc_plans', 8 );
			break;
		case '/new-homes/?community=legend-at-sylvia':
			$description = get_field( 'community_seo_desc_homes', 9 );
			break;
		case '/home-plans/?community=legend-at-sylvia':
			$description = get_field( 'community_seo_desc_plans', 9 );
			break;
		case '/sylvia-news/':
			$description = ( get_term_meta( 68, 'cat_seo_meta_desc', true ) ) ? get_term_meta( 68, 'cat_seo_meta_desc', true ) : $description;
			break;
		default:
			$description = $description;

	}
		
	return $description;

}
function yoast_modify_canonical( $url ) {

	if ( is_tax( 'community' ) ) :

		$url = 'http' . ( isset( $_SERVER['HTTPS'] ) ? 's' : '' ) . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

	endif;
	
	return $url;

}

?>
