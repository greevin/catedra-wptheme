<?php

function wp_projeto_custom_post_type (){
	
	$labels = array(
		'name' => __( 'Projetos', 'twentyfifteen-child'),
		'singular_name' => __('Projeto', 'twentyfifteen-child'),
		'add_new' => __( 'Adicionar Projeto', 'twentyfifteen-child'),
		'all_items' => __('Todos os Projetos', 'twentyfifteen-child'),
		'add_new_item' => __( 'Adicionar Projeto', 'twentyfifteen-child'),
		'edit_item' => __( 'Editar Projeto', 'twentyfifteen-child'),
		'new_item' => __( 'Novo Projeto', 'twentyfifteen-child'),
		'view_item' => __( 'Visualizar Projeto', 'twentyfifteen-child'),
		'search_item' => __( 'Pesquisar Projetos', 'twentyfifteen-child'),
		'not_found' => __( 'Nenhum item encontrado', 'twentyfifteen-child'),
		'not_found_in_trash' => __( 'Nenhum item encontrado no Lixo', 'twentyfifteen-child'),
		'parent_item_colon' => 'Parent Item'
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		// 'has_archive' => true,
		'publicly_queryable' => true,
        'menu_icon' => 'dashicons-book-alt',
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'excerpt',
			'editor',
			'thumbnail',
			'revisions',
			'comments'
		),
		'taxonomies' => array('category', 'post_tag'),
		'rewrite'     => ['slug' => 'projetos'],
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('wp_projeto',$args);
}
add_action('init','wp_projeto_custom_post_type');