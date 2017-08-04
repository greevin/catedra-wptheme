<?php

use Carbon\Carbon;

// Criando um meta box de pessoa
function adicionar_pessoa_info_meta_box() {

    add_meta_box(
        'project-info', 
		__( 'Informações da Pessoa', 'twentyfifteen-child'),
        'adicionar_pessoa_info_meta_box_callback',
        'wp_pessoa',
		'normal',
		'high'
    );
}

add_action( 'add_meta_boxes', 'adicionar_pessoa_info_meta_box' );

function adicionar_pessoa_info_meta_box_callback($post) {
	// Add a nonce field so we can check for it later.
    wp_nonce_field( 'pessoa_info_nonce', 'pessoa_info_meta_box_nonce' );

    $value = get_post_meta( $post->ID );

    $args = array(
        'numberposts' => -1,
        'post_type'   => 'wp_projeto',
    );
 
    $projects_array = get_posts( $args );

	$instituicao = isset( $value['_instituicao_input'] ) ? esc_attr( $value['_instituicao_input'][0] ) : '';
	$email_contato = isset( $value['_email_contato_input'] ) ? esc_attr( $value['_email_contato_input'][0] ) : '';
    $projetos = isset( $value['_projetos_input'] ) ? get_post_meta( $post->ID, '_projetos_input', true ) : array();
	$links_contato = isset( $value['links_contato_input'] ) ? esc_attr( $value['links_contato_input'][0] ) : '';
	$linhas_pesquisa = isset( $value['_linhas_pesquisa_input'] ) ? esc_attr( $value['_linhas_pesquisa_input'][0] ) : '';
	$periodo_inicio_pessoa = isset( $value['_periodo_inicio_pessoa_input'] ) ? esc_attr( $value['_periodo_inicio_pessoa_input'][0] ) : '';
	$periodo_fim_pessoa = isset( $value['_periodo_fim_pessoa_input'] ) ? esc_attr( $value['_periodo_fim_pessoa_input'][0] ) : '';
    $situacao = isset( $value['_situacao_input'] ) ? esc_attr( $value['_situacao_input'][0] ) : '';
    
    $periodo_inicio_pessoa = $periodo_inicio_pessoa ? Carbon::createFromTimeStamp($periodo_inicio_pessoa)->format(get_option( 'date_format' )) : '';
    $periodo_fim_pessoa = $periodo_fim_pessoa ? Carbon::createFromTimeStamp($periodo_fim_pessoa)->format(get_option( 'date_format' )) : '';
    
?>

<table class="form-table">
    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="instituicao_input"><b><?php _e( 'Instituição', 'twentyfifteen-child' )?></b></label>
        </td>
        <td colspan="4">
            <input type="text" name="instituicao_input" class="regular-text" value="<?php echo $instituicao; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="email_contato_input"><b><?php _e( 'E-mail de Contato', 'twentyfifteen-child' )?></b></label>
        </td>
        <td colspan="4">
            <input type="text" name="email_contato_input" class="regular-text" value="<?php echo $email_contato; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="projetos[]"><b><?php _e( 'Projetos', 'twentyfifteen-child' )?></b></label>
        </td>
        <td colspan="4">
            <?php
                foreach ( $projects_array as $project ) {
                    $project_guid = get_the_guid( $project->ID );
                    $project = get_the_title( $project->ID );
                    
            ?>
            <label> 
                <input type="checkbox" name="projetos[]" value="<?php echo $project; ?>" <?php checked( ( in_array( $project, $projetos, $project_guid ) ) ? $project : '', $project ); ?> /><a href="<?php echo $project_guid;?>"><?php echo $project; ?></a> <br />
            </label>
            <?php    
                }
            ?>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="linhas_pesquisa_input"><b><?php _e( 'Linhas de pesquisa', 'twentyfifteen-child' )?></b></label>
        </td>
        <td colspan="4">
            <input type="text" name="linhas_pesquisa_input" class="regular-text" value="<?php echo $linhas_pesquisa; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="periodo_checkbox"><b><?php _e( 'Período', 'twentyfifteen-child' )?></b></label>
        </td>
        <td colspan="4">
            <span> <?php _e( 'de', 'twentyfifteen-child' )?> </span>
            <input type="text" class="datepicker" name="periodo_inicio_pessoa_input" value="<?php echo $periodo_inicio_pessoa; ?>" placeholder="<?php _e( 'Data de Início', 'twentyfifteen-child' )?>"/>
            <span> <?php _e( 'até', 'twentyfifteen-child' )?> </span>
            <input type="text" class="datepicker" name="periodo_fim_pessoa_input" value="<?php echo $periodo_fim_pessoa; ?>" placeholder="<?php _e( 'Data de Término', 'twentyfifteen-child' )?>"/>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="situacao_input"><b><?php _e( 'Situação', 'twentyfifteen-child' )?></b></label>
        </td>
        <td colspan="4">
            <label for="ativo">
                <input type="radio" name="situacao_input" id="ativo" value="1" <?php checked( $situacao, 1 ); ?>>
                <?php _e( 'Ativo', 'twentyfifteen-child' )?>
            </label>
            <label for="inativo">
                <input type="radio" name="situacao_input" id="inativo" value="0" <?php checked( $situacao, 0 ); ?>>
                <?php _e( 'Inativo', 'twentyfifteen-child' )?>
            </label>
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
function salvar_pessoa_info_meta_box_data( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_once = (isset( $_POST['pessoa_info_nonce']) && wp_verify_nonce( $_POST['pessoa_info_nonce'] )); 

    if ( $is_autosave || $is_revision || $is_valid_once ) {
        return;
    }

	// cria o meta_key no banco
	if ( isset( $_POST['instituicao_input'] ) && $_POST['instituicao_input'] != '') {
	    $instituicao_input = sanitize_text_field( $_POST['instituicao_input'] );
        update_post_meta( $post_id, '_instituicao_input', $instituicao_input);
    }

    if ( isset( $_POST['email_contato_input'] ) && $_POST['email_contato_input'] != '') {
        $email_contato_input = sanitize_text_field( $_POST['email_contato_input'] );
        update_post_meta( $post_id, '_email_contato_input', $email_contato_input);
    }

    if ( isset( $_POST['periodo_inicio_pessoa_input'] ) && $_POST['periodo_inicio_pessoa_input'] != '') {
        $periodo_inicio_pessoa_input = sanitize_text_field( $_POST['periodo_inicio_pessoa_input'] );
        $periodo_data_inicio = $periodo_inicio_pessoa_input ? Carbon::createFromFormat(get_option( 'date_format' ), $periodo_inicio_pessoa_input, get_option('timezone_string'))->timestamp : '';
        
        update_post_meta( $post_id, '_periodo_inicio_pessoa_input', $periodo_data_inicio);
    }

    if ( isset( $_POST['periodo_fim_pessoa_input'] ) && $_POST['periodo_fim_pessoa_input'] != '') {
        $periodo_fim_pessoa_input = sanitize_text_field( $_POST['periodo_fim_pessoa_input'] );
        $periodo_data_fim = $periodo_fim_pessoa_input ? Carbon::createFromFormat(get_option( 'date_format' ), $periodo_fim_pessoa_input, get_option('timezone_string'))->timestamp : '';
        
        update_post_meta( $post_id, '_periodo_fim_pessoa_input', $periodo_data_fim);
    }

    if ( isset( $_POST['linhas_pesquisa_input'] ) && $_POST['linhas_pesquisa_input'] != '') {
        $linhas_pesquisa_input = sanitize_text_field( $_POST['linhas_pesquisa_input'] );
        update_post_meta( $post_id, '_linhas_pesquisa_input', $linhas_pesquisa_input);
    }

    if ( isset( $_POST['projetos'] ) ) {
        $projetos = array_map( 'sanitize_text_field', (array) $_POST['projetos']);
        update_post_meta( $post_id, '_projetos_input', $projetos);
    }

    if ( isset( $_POST['situacao_input'] ) ) {
	    $situacao_input = sanitize_text_field( $_POST['situacao_input'] );
        update_post_meta( $post_id, '_situacao_input', $situacao_input);
    }

}

add_action( 'save_post', 'salvar_pessoa_info_meta_box_data' );
