<?php

// walker class for cleaning up classes applied to WP menus
class Walker_Clean_Menu extends Walker_Nav_Menu {

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		$class_names = $value = '';
 
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		
		$class_indicators = array( 'current-menu-item', 'current-menu-parent', 'current_page_item', 'current_page_parent', 'menu-item-has-children' );

		$newClasses = array();
	 
		foreach( $classes as $el ) {

			//check if it's indicating the current page, otherwise we don't need the class
			if ( in_array( $el, $class_indicators ) ) {
							array_push( $newClasses, $el );
			}
		}
		
		// add "hidden" class to submenu parent element
		if ( in_array( 'menu-item-has-children', $newClasses ) ) array_push( $newClasses, 'hidden' );
		
		$i = 1; // adding classes to first item

		// add class to make submenu start open, allowed to close after first menu toggled
		if ( in_array( 'current-menu-item', $newClasses ) ||
				in_array( 'current-menu-parent', $newClasses ) ||
				is_front_page() && $item->url == get_site_url() . '/find-your-home/'  ) array_push( $newClasses, 'start-open' );
		
		$i++;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $newClasses ), $item ) );
		$class_names = ( $class_names != '' ) ? ' class="menu-item '. esc_attr( $class_names ) . '"' : ' class="menu-item"';

		$output .= $indent . '<li ' . $value . $class_names .'>';

		$attributes = ' class="menu-link"';
		$attributes .= ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		if( $depth != 0 ) {
			//children stuff, maybe you'd like to store the submenu's somewhere?
		}

		 $item_output = $args->before;
		 $item_output .= '<a'. $attributes .'>';
		 $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
		 $item_output .= '</a>';
		 $item_output .= $args->after;

		 $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	//$output .= sprintf( "\n<li class='menu-item'><a href='%s' class='menu-link'>%s</a>\n",
	//	$item->url,
	//	$item->title
	//);

}

?>