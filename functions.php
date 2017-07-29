<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

function theme_enqueue_styles() {
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/css/custom-bootstrap.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Roboto+Slab:400,700|Muli:400,700,700i', false );
    
	wp_enqueue_style( 'dashicons' );

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
    return 35;
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

/* Add CPTs to author archives */
function custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('wp_projeto', 'wp_pessoa', 'post') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'custom_post_author_archive');

add_action('wp_footer', 'add_back_to_top');
    function add_back_to_top(){
        ?>
        <script type="text/javascript">
                    jQuery(document).ready(function() {
                        jQuery('body').append('<a href="#" class="go-top"><span class="dashicons dashicons-arrow-up-alt2"></span></a>')
                        // Show or hide the sticky footer button
                        jQuery(window).scroll(function() {
                            if (jQuery(this).scrollTop() > 400) {
                                jQuery('.go-top').fadeIn();
                            } else {
                                jQuery('.go-top').fadeOut();
                            }
                        });

                        // Animate the scroll to top
                        jQuery('.go-top').click(function(event) {
                            event.preventDefault();

                            jQuery('html, body').animate({scrollTop: 0}, 800);
                        })
                    });
        </script>
        <?php
    }

/**************************************
 * Registro de sidebar
 **************************************/
if ( function_exists('register_sidebar'))
    register_sidebar(array(
    'name' => 'Footer',
    'id' => 'sidebar-footer',
    'before_widget' => '<div class="col-md-12 col-lg-12 site-info">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
));

// Customizar tamanho da caixa de comentário
// https://wpsites.net/web-design/customize-comment-field-text-area-label/
function wpsites_modify_comment_form_text_area($arg) {
    $arg['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . 'Comentário' . '</label><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>';
    return $arg;
}

add_filter('comment_form_defaults', 'wpsites_modify_comment_form_text_area');

function alter_comment_form_fields($fields){
    $fields['url'] = '';  //removes website field
    return $fields;
}

add_filter('comment_form_default_fields','alter_comment_form_fields');
  
// Unset URL from comment form
function move_comment_form_below( $fields ) { 
    $comment_field = $fields['comment']; 
    unset( $fields['comment'] ); 
    $fields['comment'] = $comment_field; 
    return $fields; 
} 
add_filter( 'comment_form_fields', 'move_comment_form_below' ); 

?>
