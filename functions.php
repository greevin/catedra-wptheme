<?php

function theme_enqueue_styles() {
    $parent_style = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/css/custom-bootstrap.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

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
			'custom-fields'
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('pessoa',$args);
}
add_action('init','pessoas_custom_post_type');

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
			'custom-fields'
		),
		'taxonomies' => array('category', 'post_tag'),
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('projetos',$args);
}
add_action('init','projetos_custom_post_type');

?>