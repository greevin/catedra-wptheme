<?php
// Criando um meta box do projeto
function add_projects_info_meta_box() {

    add_meta_box(
        'project-info', 
		'Adicionar Informações do Projeto',
        'add_projects_info_meta_box_callback',
        'projetos',
		'normal',
		'high'
    );
}

add_action( 'add_meta_boxes', 'add_projects_info_meta_box' );

function add_projects_info_meta_box_callback($post) {
	// Add a nonce field so we can check for it later.
    wp_nonce_field( 'project_info_nonce', 'project_info_meta_box_nonce' );

    $value = get_post_meta( $post->ID);

	$text = isset( $value['_texto_meta_box'] ) ? esc_attr( $value['_texto_meta_box'][0] ) : '';
	$secondtext = isset( $value['_second_texto_meta_box'] ) ? esc_attr( $value['_second_texto_meta_box'][0] ) : '';

 ?>
	 <table class="form-table">
    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="instituicao_input"><b>Agência(s) financiadora(s)</b></label>
        </td>
        <td colspan="4">
            <input type="text" name="instituicao_input" class="regular-text" value="<?php echo $instituicao; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="profile_facebook"><b>Período</b></label>
        </td>
        <td colspan="4">
            <span> de </span>
            <input type="text" class="datepicker" name="start_date_input" value="<?php echo $periodo_inicio; ?>" placeholder="Data de Inicio"/>
            <span> até </span>
            <input type="text" class=" datepicker" name="end_date_input" value="<?php echo $periodo_fim; ?>" placeholder="Data de Fim"/>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="profile_facebook"><b>Situação</b></label>
        </td>
        <td colspan="4">
            <label for="ativo">
                <input type="radio" name="situacao_input" id="ativo" value="ativo" <?php checked( $situacao, 'ativo' ); ?>>
                Ativo
            </label>
            <label for="inativo">
                <input type="radio" name="situacao_input" id="inativo" value="inativo" <?php checked( $situacao, 'inativo' ); ?>>
                Inativo
            </label>
        </td>
	</tr>
	
	<tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="email_contato_input"><b>Coodernador(es)</b></label>
        </td>
        <td colspan="4">
            <input type="text" name="email_contato_input" class="regular-text" value="<?php echo $email_contato; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="profile_twitter"><b>Equipe</b></label>
        </td>
        <td colspan="4">
	
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="profile_facebook"><b>Notícias</b></label>
        </td>
        <td colspan="4">
            <input type="text" name="profile_facebook" class="regular-text" value="<?php echo $facebook; ?>">
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
function save_project_info_meta_box_data( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_once = (isset( $_POST['project_info_nonce']) && wp_verify_nonce( $_POST['project_info_nonce'] )); 

    if ( $is_autosave || $is_revision || $is_valid_once ) {
        return;
    }

	$my_data = sanitize_text_field( $_POST['texto_meta_box'] );
	$my_second_data = sanitize_text_field( $_POST['second_texto_meta_box'] );

	// cria o meta_key no banco
    if ( isset( $_POST['texto_meta_box'] ) ) {
        update_post_meta( $post_id, '_texto_meta_box', $my_data);
    }

	// cria o meta_key no banco
    if ( isset( $_POST['second_texto_meta_box'] ) ) {
        update_post_meta( $post_id, '_second_texto_meta_box', $my_second_data);
    }
}

add_action( 'save_post', 'save_project_info_meta_box_data' );
