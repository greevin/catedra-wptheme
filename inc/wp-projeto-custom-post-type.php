<?php

function wp_projeto_custom_post_type (){
	
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
		// 'has_archive' => true,
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
		'rewrite'     => ['slug' => 'projetos'],
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('wp_projeto',$args);
}
add_action('init','wp_projeto_custom_post_type');