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

/*
	==========================================
	 Custom Post Type
	==========================================
*/
function pessoas_custom_post_type (){
	
	$labels = array(
		'name' => 'Pessoas',
		'singular_name' => 'Pessoa',
		'add_new' => 'Adicionar Pessoa',
		'all_items' => 'Todas as Pessoas',
		'add_new_item' => 'Adicionar Pessoa',
		'edit_item' => 'Editar Pessoa',
		'new_item' => 'Adicionar Pessoa',
		'view_item' => 'Visualizar Pessoa',
		'search_item' => 'Pesquisar Pessoa',
		'not_found' => 'Nenhum item encontrado',
		'not_found_in_trash' => 'Nenhum item encontrado no Lixo',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
        'menu_icon' => 'dashicons-id-alt',
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'custom-fields',
			'comments' 
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('pessoa',$args);
}
add_action('init','pessoas_custom_post_type');

function set_pessoa_contact_columns( $columns ){
	$newColumns = array();
	$newColumns['title'] = 'Nome';
	$newColumns['resumo'] = 'Resumo';
	$newColumns['instituicao'] = 'Instituição';
	$newColumns['date'] = 'Criado em';
	return $newColumns;
}

add_filter( 'manage_edit-pessoa_columns', 'set_pessoa_contact_columns' );
add_action( 'manage_posts_custom_column', 'pessoa_custom_column', 10, 2);

function pessoa_custom_column( $column, $post_id ){
	switch( $column ){
			
		case 'resumo' :
			echo get_the_excerpt();
			break;

		case 'instituicao' :
			echo get_post_meta( $post_id, '_instituicao_input', true );
			break;	
	}
	
}

function projetos_custom_post_type (){
	
	$labels = array(
		'name' => 'Projetos',
		'singular_name' => 'Projeto',
		'add_new' => 'Adicionar Projeto',
		'all_items' => 'Todos os Projetos',
		'add_new_item' => 'Adicionar Projeto',
		'edit_item' => 'Editar Projeto',
		'new_item' => 'Novo Projeto',
		'view_item' => 'Visualizar Projeto',
		'search_item' => 'Pesquisar Projetos',
		'not_found' => 'Nenhum item encontrado',
		'not_found_in_trash' => 'Nenhum item encontrado no Lixo',
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
        'menu_icon' => 'dashicons-book-alt',
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('projetos',$args);
}
add_action('init','projetos_custom_post_type');

require get_stylesheet_directory() . '/inc/custom-fields-project.php';
require get_stylesheet_directory() . '/inc/custom-fields-people.php';

?>