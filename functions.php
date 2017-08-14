<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

load_theme_textdomain('twentyfifteen-child', get_stylesheet_directory() . '/languages');

function theme_enqueue_styles()
{
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css');
    wp_enqueue_style('child-style',
        get_stylesheet_directory_uri() . '/css/custom-bootstrap.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
    wp_enqueue_style('twentyfifteen-child-fonts', twentyfifteen_child_fonts_url());

    wp_enqueue_style('dashicons');
    wp_add_inline_style($parent_style, twentyfifteen_child_customizer_css());

    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-script', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), false, true);
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function theme_admin_scripts()
{
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-datepicker', array( 'jquery' ));
    wp_enqueue_script('wp-jquery-date-picker', get_stylesheet_directory_uri() . '/js/admin.js');

    wp_enqueue_style('jquery-ui-css', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
}
add_action('admin_enqueue_scripts', 'theme_admin_scripts');

/**
 * Filter the except length to 30 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length($length)
{
    return 35;
}
add_filter('excerpt_length', 'wpdocs_custom_excerpt_length', 999);

// Menu para o front-page
register_nav_menus(array(
        'primary_custom' => __('Páginas internas', 'twentyfifteen-child'),
    ));

function twentyfifteen_excerpt_more($more)
{
    $link = sprintf('<div class="more-link-container"><a href="%1$s">%2$s</a></div>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Name of current post */
        sprintf(__('Leia Mais', 'twentyfifteen-child'), '<span class="screen-reader-text">' . get_the_title(get_the_ID()) . '</span>')
        );
    return ' &hellip; ' . $link;
}
add_filter('excerpt_more', 'twentyfifteen_excerpt_more');

function _get_excerpt($limit = 100)
{
    return has_excerpt() ? get_the_excerpt() : wp_trim_words(strip_shortcodes(get_the_content()), $limit);
}

/* Custom Post Type */
require get_stylesheet_directory() . '/inc/wp-pessoa-custom-post-type.php';
require get_stylesheet_directory() . '/inc/wp-projeto-custom-post-type.php';

/* Custom Fields */
require get_stylesheet_directory() . '/inc/custom-fields-pessoa.php';
require get_stylesheet_directory() . '/inc/custom-fields-project.php';

/* Add CPTs to author archives */
function custom_post_author_archive($query)
{
    if ($query->is_author) {
        $query->set('post_type', array('wp_projeto', 'wp_pessoa', 'post'));
    }
    remove_action('pre_get_posts', 'custom_post_author_archive');
}
add_action('pre_get_posts', 'custom_post_author_archive');

add_action('wp_footer', 'add_back_to_top');
    function add_back_to_top()
    {
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
if (function_exists('register_sidebar')) {
    register_sidebar(array(
    'name' => 'Footer',
    'id' => 'sidebar-footer',
    'before_widget' => '<div class="col-md-12 col-lg-12 site-info">',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
));
}

// Customizar tamanho da caixa de comentário
// https://wpsites.net/web-design/customize-comment-field-text-area-label/
function wpsites_modify_comment_form_text_area($arg)
{
    $arg['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . __('Comentário', 'twentyfifteen-child') . '</label><textarea id="comment" name="comment" cols="45" rows="5" aria-required="true"></textarea></p>';
    return $arg;
}

add_filter('comment_form_defaults', 'wpsites_modify_comment_form_text_area');

function alter_comment_form_fields($fields)
{
    $fields['url'] = '';  //removes website field
    return $fields;
}

add_filter('comment_form_default_fields', 'alter_comment_form_fields');

// Unset URL from comment form
function move_comment_form_below($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}
add_filter('comment_form_fields', 'move_comment_form_below');

/**
 * Include our Customizer settings.
 */
require get_stylesheet_directory() . '/inc/twentyfifteen-child-customizer.php';
new Twenty_Fifteen_Child_Customizer();

function twentyfifteen_child_customizer_css()
{
    $css = '';

    $footer_background = get_theme_mod('footer-background', '#123652');
    $css .= '.site-footer { background-color: ' . $footer_background . '; }';

    $footer_text_color = get_theme_mod('footer-text-color', '#d8d8d8');
    $css .= '.site-info p { color: ' . $footer_text_color . '; }';

    $post_background_color = get_theme_mod('post-background-color', '#ffffff');
    $css .= '.page-background { background-color: ' . $post_background_color . ' !important; }';

    $post_text_color = get_theme_mod('post-text-color', '#ffffff');
    $css .= '.sideText p, ol, ul { color: ' . $post_text_color . '; }';

    $more_info_background_color = get_theme_mod('more-info-background-color', '#123652');
    $css .= '.entry-section { background-color: ' . $more_info_background_color . '; }';

    $more_info_text_color = get_theme_mod('more-info-text-color', '#ffffff');
    $css .= '.entry-section { color: ' . $more_info_text_color . '; }';

    $inside_page_color = get_theme_mod('inside-page-color', '#123652');
    $css .= '.panel-title-container { background-color: ' . $inside_page_color . ' !important; }';

    $inside_page_text_color = get_theme_mod('inside-page-text-color', '#ffffff');
    $css .= '.panel-title-container, .entry-projects-content p, .people-content p { color: ' . $inside_page_text_color . '; }';

    return $css;
}

function twentyfifteen_child_fonts_url()
{
    $fonts_url = '';
    $fonts     = array();
    $subsets   = 'latin,latin-ext';

    return get_stylesheet_directory_uri() . '/fonts/stylesheet.css';
}

?>
