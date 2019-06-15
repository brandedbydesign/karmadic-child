<?php
// Queue parent style followed by child/customized style
add_action( 'wp_enqueue_scripts', 'karmadic_enqueue_styles', PHP_INT_MAX);

function karmadic_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
}


/**
 * Register widget areas.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function karmadic_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'karmadic' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'karmadic' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header Contact', 'karmadic' ),
		'id'            => 'header-contact',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Social', 'karmadic' ),
		'id'            => 'footer-social',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'karmadic_widgets_init' );


/**
 * removes <p> tags from Advanced Custom fields 
 * Remove WPAUTOP from ACF TinyMCE Editor
 */
function acf_wysiwyg_remove_wpautop() {
    remove_filter('acf_the_content', 'wpautop' );
}
add_action('acf/init', 'acf_wysiwyg_remove_wpautop');


/**
 * Remove hentry on anything other than single Post - prevents structured data errors in Google 
 */
function remove_hentry( $classes ) {
	if( !is_single() ) {
		$classes = array_diff($classes, array('hentry'));
		return $classes;
	} else {
		return $classes;
	}
}
add_filter( 'post_class', 'remove_hentry' );


/**
 * Adds Back To Top Button on mobile
 */
function my_scripts_method() {
	wp_enqueue_script(
		'custom-script',
		get_stylesheet_directory_uri() . '/js/topbutton.js',
		array( 'jquery' )
	);
}

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );

/* 
 * Enqueue Google fonts 
 * Replace fonts link as needed for different fonts.
 * Get the fonts link from Google after adding font family (or families)
 * and selecting the font weights and styles.
*/
add_action( 'wp_enqueue_scripts', 'prefix_scripts_styles' );

function prefix_scripts_styles() {
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i,900,900i&display=swap', array(), '1.3.1' );
}
