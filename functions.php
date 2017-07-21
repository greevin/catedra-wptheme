<?php

function theme_enqueue_styles() {
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/css/custom-bootstrap.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700|Playfair+Display:700', false );

	// wp_enqueue_style( 'owl-carousel-css', get_stylesheet_directory_uri() . '/owlcarousel/assets/owl-carousel.css' );
	// wp_enqueue_style( 'owl-carousel-theme-css', get_template_directory_uri() . '/css/owl.theme.default.css' );

	wp_enqueue_script( 'jquery');
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), false, true);
	wp_enqueue_script( 'owl-carousel-js', get_stylesheet_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), false, true);
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_admin_scripts() {
	wp_enqueue_script( 'jquery');
  	wp_enqueue_script( 'jquery-ui-datepicker', array( 'jquery' ) );
	wp_enqueue_script( 'wp-jquery-date-picker', get_stylesheet_directory_uri() . '/js/admin.js' );

	wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');	

}
add_action('admin_enqueue_scripts', 'theme_admin_scripts');

/**
 * Filter the except length to 30 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

// Menu para o front-page
register_nav_menus( array(
		'primary_custom' => __( 'Menu Inicial', 'twentyfifteen' ),
	) );

function twentyfifteen_excerpt_more( $more ) {
	$link = sprintf( '<div class="more-link-container"><a href="%1$s">%2$s</a></div>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Leia Mais', 'twentyfifteen' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyfifteen_excerpt_more' );

function _get_excerpt($limit = 100) {
    return has_excerpt() ? get_the_excerpt() : wp_trim_words(strip_shortcodes(get_the_content()),$limit);
}

/* Custom Post Type */
require get_stylesheet_directory() . '/inc/wp-pessoa-custom-post-type.php';
require get_stylesheet_directory() . '/inc/wp-projeto-custom-post-type.php';

/* Custom Fields */
require get_stylesheet_directory() . '/inc/custom-fields-pessoa.php';
require get_stylesheet_directory() . '/inc/custom-fields-project.php';

?>