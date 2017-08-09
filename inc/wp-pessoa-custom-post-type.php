<?php

function pessoas_custom_post_type()
{
    $labels = array(
        'name' => __('Pessoas', 'twentyfifteen-child'),
        'singular_name' => __('Pessoa', 'twentyfifteen-child'),
        'add_new' => __('Adicionar Pessoa', 'twentyfifteen-child'),
        'all_items' => __('Todas as Pessoas', 'twentyfifteen-child'),
        'add_new_item' => __('Adicionar Pessoa', 'twentyfifteen-child'),
        'edit_item' => __('Editar Pessoa', 'twentyfifteen-child'),
        'new_item' => __('Adicionar Pessoa', 'twentyfifteen-child'),
        'view_item' => __('Visualizar Pessoa', 'twentyfifteen-child'),
        'search_item' => __('Pesquisar Pessoa', 'twentyfifteen-child'),
        'not_found' => __('Nenhum item encontrado', 'twentyfifteen-child'),
        'not_found_in_trash' => __('Nenhum item encontrado no Lixo', 'twentyfifteen-child'),
        'parent_item_colon' => 'Parent Item'
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'menu_icon' => 'dashicons-id-alt',
        'query_var' => true,
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
        'rewrite'     => ['slug' => 'pessoas'],
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    register_post_type('wp_pessoa', $args);
}
add_action('init', 'pessoas_custom_post_type');
