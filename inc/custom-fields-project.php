<?php

use Carbon\Carbon;

// Criando um meta box do projeto
function add_projects_info_meta_box()
{
    add_meta_box(
        'project-info',
        __('Informações do Projeto', 'twentyfifteen-child'),
        'add_projects_info_meta_box_callback',
        'wp_projeto',
        'normal',
        'high'
    );
}

add_action('add_meta_boxes', 'add_projects_info_meta_box');

function add_projects_info_meta_box_callback($post)
{
    // Add a nonce field so we can check for it later.
    wp_nonce_field('project_info_nonce', 'project_info_meta_box_nonce');

    $value = get_post_meta($post->ID);

    $args_pessoas = array(
        'numberposts' => -1,
        'post_type'   => 'wp_pessoa',
    );

    $people = get_posts($args_pessoas);

    $args_equipes = array(
        'numberposts' => -1,
        'post_type'   => 'wp_pessoa',
    );
    $equipes = get_posts($args_equipes);

    $args_posts = array(
        'numberposts' => -1,
        'post_type'   => 'post',
    );

    $posts = get_posts($args_posts);

    $tags = wp_get_post_tags($post->ID);


    $agencia_financiadora = isset($value['_agencia_financiadora_input']) ? esc_attr($value['_agencia_financiadora_input'][0]) : '';
    $parceiros = isset($value['_parceiros_input']) ? esc_attr($value['_parceiros_input'][0]) : '';
    $projetos = isset($value['_people']) ? get_post_meta($post->ID, '_people', true) : array();
    $equipe_array = isset($value['_equipes']) ? get_post_meta($post->ID, '_equipes', true) : array();
    $periodo_inicio_projeto = isset($value['_periodo_inicio_projeto_input']) ? esc_attr($value['_periodo_inicio_projeto_input'][0]) : '';
    $periodo_fim_projeto = isset($value['_periodo_fim_projeto_input']) ? esc_attr($value['_periodo_fim_projeto_input'][0]) : '';
    $situacao = isset($value['_situacao_input']) ? esc_attr($value['_situacao_input'][0]) : '';
    $noticias = isset($value['_checked_posts']) ? get_post_meta($post->ID, '_checked_posts', true) : array();

    $periodo_inicio_projeto = $periodo_inicio_projeto ? Carbon::createFromTimeStamp($periodo_inicio_projeto)->format(get_option('date_format')) : '';
    $periodo_fim_projeto = $periodo_fim_projeto ? Carbon::createFromTimeStamp($periodo_fim_projeto)->format(get_option('date_format')) : ''; ?>
	 <table class="form-table">
    
    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="agencia_financiadora_input"><b><?php _e('Agência(s) financiadora(s)', 'twentyfifteen-child')?></b></label>
        </td>
        <td colspan="4">
            <input type="text" name="agencia_financiadora_input" class="regular-text" value="<?php echo $agencia_financiadora; ?>">
        </td>
    </tr>
    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="parceiros_input"><b><?php _e('Parceiros', 'twentyfifteen-child')?></b></label>
        </td>
        <td colspan="4">
            <input type="text" name="parceiros_input" class="regular-text" value="<?php echo $parceiros; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="periodo_checkbox"><b><?php _e('Período', 'twentyfifteen-child')?></b></label>
        </td>
       <td colspan="4">
            <span> <?php _e('de', 'twentyfifteen-child')?> </span>
            <input type="text" class="datepicker" name="periodo_inicio_input" value="<?php echo $periodo_inicio_projeto; ?>" placeholder="<?php _e('Data de Início', 'twentyfifteen-child')?>"/>
            <span> <?php _e('até', 'twentyfifteen-child')?> </span>
            <input type="text" class="datepicker" name="periodo_fim_input" value="<?php echo $periodo_fim_projeto; ?>" placeholder="<?php _e('Data de Término', 'twentyfifteen-child')?>"/>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="situacao_input"><b><?php _e('Situação', 'twentyfifteen-child')?></b></label>
        </td>
        <td colspan="4">
            <label for="ativo">
                <input type="radio" name="situacao_input" id="ativo" value="1" <?php checked($situacao, 1); ?>>
                <?php _e('Ativo', 'twentyfifteen-child')?>
            </label>
            <label for="inativo">
                <input type="radio" name="situacao_input" id="inativo" value="0" <?php checked($situacao, 0); ?>>
                <?php _e('Inativo', 'twentyfifteen-child')?>
            </label>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2" style="vertical-align: top;">
            <label for="people[]"><b><?php _e('Coodernador(es)', 'twentyfifteen-child')?></b></label>
        </td>
        <td colspan="4">
            <?php
                if (! empty($people)) :
                foreach ($people as $person) {
                    $person = get_the_title($person->ID); ?>
            <label>
                <input type="checkbox" name="people[]" value="<?php echo $person; ?>" <?php checked((in_array($person, $projetos)) ? $person : '', $person); ?> /><?php echo $person; ?> <br />
            </label>
            <?php
                } else :
            ?>
            <span><?php _e('Nenhuma pessoa criada no menu "Pessoas"', 'twentyfifteen-child')?></span>
            <?php
                endif; ?>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2" style="vertical-align: top;">
            <label for="equipe[]"><b><?php _e('Equipe', 'twentyfifteen-child')?></b></label>
        </td>
        <td colspan="4">
            <?php
                if (! empty($equipes)) :
                foreach ($equipes as $equipe) {
                    $equipe = get_the_title($equipe->ID); ?>
            <label>
                <input type="checkbox" name="equipe[]" value="<?php echo $equipe; ?>" <?php checked((in_array($equipe, $equipe_array)) ? $equipe : '', $equipe); ?> /><?php echo $equipe; ?> <br />
            </label>
            <?php
                } else :
            ?>
            <span><?php _e('Nenhuma pessoa criada no menu "Pessoas"', 'twentyfifteen-child')?></span>
            <?php
                endif; ?>
        </td>
    </tr>

    <!-- <tr>
        <td class="person_meta_box_td" colspan="2" style="vertical-align: top;">
            <label for="tags_news[]"><b><?php _e('Tags', 'twentyfifteen-child')?></b></label>
        </td>
        <td colspan="4">
            <?php
                foreach ( $tags as $tag ) {
             ?>
            <label for="<?php echo $tag->name; ?>">
                <input type="radio" name="situacao_input" id="<?php echo $tag->name; ?>" value="<?php echo $tag->name; ?>" <?php checked($tag->name, 1); ?>>
                <?php echo $tag->name; ?>
                <span>(<?php echo $tag->count; ?>)</span>
                </br>
            </label>
            <?php } ?>

        </td>
    </tr> -->

    <tr>
        <td class="person_meta_box_td" colspan="2" style="vertical-align: top;">
            <label for="post_news[]"><b><?php _e('Notícias', 'twentyfifteen-child')?></b></label>
        </td>
        <td colspan="4">
            <?php
                if (! empty($posts)) :
                foreach ($posts as $post) {
                    $post = get_the_title($post->ID); ?>
            <label>
                <input type="checkbox" name="post_news[]" value="<?php echo $post; ?>" <?php checked((in_array($post, $noticias)) ? $post : '', $post); ?> /><?php echo $post; ?> <br />
            </label>
            <?php
                } else :
            ?>
            <span><?php _e('Nenhuma notícia criada no menu "Posts"', 'twentyfifteen-child')?></span>
            <?php
                endif; ?>
        </td>
    </tr>

</table>

<?php
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id
 */
function save_project_info_meta_box_data($post_id)
{
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_once = (isset($_POST['project_info_nonce']) && wp_verify_nonce($_POST['project_info_nonce']));

    if ($is_autosave || $is_revision || $is_valid_once) {
        return;
    }

    // cria o meta_key no banco
    if (isset($_POST['agencia_financiadora_input']) && $_POST['agencia_financiadora_input'] != '') {
        $agencia_financiadora_input = sanitize_text_field($_POST['agencia_financiadora_input']);
        update_post_meta($post_id, '_agencia_financiadora_input', $agencia_financiadora_input);
    }

    if (isset($_POST['parceiros_input']) && $_POST['parceiros_input'] != '') {
        $parceiros_input = sanitize_text_field($_POST['parceiros_input']);
        update_post_meta($post_id, '_parceiros_input', $parceiros_input);
    }

    if (isset($_POST['periodo_inicio_input']) && $_POST['periodo_inicio_input'] != '') {
        $periodo_inicio_projeto_input = sanitize_text_field($_POST['periodo_inicio_input']);
        $periodo_data_inicio_projeto = $periodo_inicio_projeto_input ? Carbon::createFromFormat(get_option('date_format'), $periodo_inicio_projeto_input, get_option('timezone_string'))->timestamp : '';

        update_post_meta($post_id, '_periodo_inicio_projeto_input', $periodo_data_inicio_projeto);
    }

    if (isset($_POST['periodo_fim_input']) && $_POST['periodo_fim_input'] != '') {
        $periodo_fim_projeto_input = sanitize_text_field($_POST['periodo_fim_input']);
        $periodo_data_fim_projeto = $periodo_fim_projeto_input ? Carbon::createFromFormat(get_option('date_format'), $periodo_fim_projeto_input, get_option('timezone_string'))->timestamp : '';

        update_post_meta($post_id, '_periodo_fim_projeto_input', $periodo_data_fim_projeto);
    }

    if (isset($_POST['situacao_input']) && $_POST['situacao_input'] != '') {
        $situacao_input = sanitize_text_field($_POST['situacao_input']);
        update_post_meta($post_id, '_situacao_input', $situacao_input);
    }

    if (isset($_POST['people'])) {
        $people = (array) ($_POST['people']);
        $people = array_map('sanitize_text_field', $people);

        update_post_meta($post_id, '_people', $people);
    }

    if (isset($_POST['equipe'])) {
        $equipes = (array) ($_POST['equipe']);
        $equipes = array_map('sanitize_text_field', $equipes);

        update_post_meta($post_id, '_equipes', $equipes);
    }

    if (isset($_POST['post_news'])) {
        $posts_news = (array) ($_POST['post_news']);
        $posts_news = array_map('sanitize_text_field', $posts_news);

        update_post_meta($post_id, '_checked_posts', $posts_news);
    }
}

add_action('save_post', 'save_project_info_meta_box_data');
