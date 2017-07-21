<?php

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
		// 'has_archive' => true,
		'publicly_queryable' => true,
        'menu_icon' => 'dashicons-id-alt',
		'query_var' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array(
			'title',
			'editor',
			'thumbnail',
			'revisions',
			'comments' 
		),
		'taxonomies' => array('category', 'post_tag'),
        'rewrite'     => ['slug' => 'pessoas'],
		'menu_position' => 5,
		'exclude_from_search' => false
	);
	register_post_type('wp_pessoa',$args);
}
add_action('init','pessoas_custom_post_type');