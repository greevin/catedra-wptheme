<?php
// Criando um meta box do projeto
function add_people_info_meta_box() {

    add_meta_box(
        'project-info', 
		'Adicionar Informações do Pessoa',
        'add_people_info_meta_box_callback',
        'pessoa',
		'normal',
		'high'
    );
}

add_action( 'add_meta_boxes', 'add_people_info_meta_box' );

function add_people_info_meta_box_callback($post) {
	// Add a nonce field so we can check for it later.
    wp_nonce_field( 'people_info_nonce', 'people_info_meta_box_nonce' );

    $value = get_post_meta( $post->ID );

    $args = array(
        'numberposts' => -1,
        'post_type'   => 'pessoa',
    );
 
    $people = get_posts( $args );

	$instituicao = isset( $value['_instituicao_input'] ) ? esc_attr( $value['_instituicao_input'][0] ) : '';
	$email_contato = isset( $value['_email_contato_input'] ) ? esc_attr( $value['_email_contato_input'][0] ) : '';
    $projetos = isset( $value['_people'] ) ? get_post_meta( $post->ID, '_people', true ) : array();
	$links_contato = isset( $value['links_contato_input'] ) ? esc_attr( $value['links_contato_input'][0] ) : '';
	$linhas_pesquisa = isset( $value['_linhas_pesquisa_input'] ) ? esc_attr( $value['_linhas_pesquisa_input'][0] ) : '';
	$periodo_inicio = isset( $value['_periodo_inicio_input'] ) ? esc_attr( $value['_periodo_inicio_input'][0] ) : '';
	$periodo_fim = isset( $value['_periodo_fim_input'] ) ? esc_attr( $value['_periodo_fim_input'][0] ) : '';
    $situacao = isset( $value['_situacao_input'] ) ? esc_attr( $value['_situacao_input'][0] ) : '';
?>

<table class="form-table">
    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="instituicao_input"><b>Instituição</b></label>
        </td>
        <td colspan="4">
            <input type="text" name="instituicao_input" class="regular-text" value="<?php echo $instituicao; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="email_contato_input"><b>E-mail de Contato</b></label>
        </td>
        <td colspan="4">
            <input type="text" name="email_contato_input" class="regular-text" value="<?php echo $email_contato; ?>">
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="people[]"><b>Projetos</b></label>
        </td>
        <td colspan="4">
            <?php
                foreach ( $people as $person ) {
                    $person = get_the_title( $person->ID );
            ?>
            <label> 
                <input type="checkbox" name="people[]" value="<?php echo $person; ?>" <?php checked( ( in_array( $person, $projetos ) ) ? $person : '', $person ); ?> /><?php echo $person; ?> <br />
            </label>
            <?php    
                }
            ?>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="linhas_pesquisa_input"><b>Linhas de Pesquisa</b></label>
        </td>
        <td colspan="4">
            <input type="text" name="linhas_pesquisa_input" class="regular-text" value="<?php echo $linhas_pesquisa; ?>">
        </td>
    </tr>


    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="periodo_checkbox"><b>Período</b></label>
        </td>
        <td colspan="4">
            <span> de </span>
            <input type="text" class="datepicker" name="periodo_inicio_input" value="<?php echo $periodo_inicio; ?>" placeholder="Data de Inicio"/>
            <span> até </span>
            <input type="text" class="datepicker" name="periodo_fim_input" value="<?php echo $periodo_fim; ?>" placeholder="Data de Fim"/>
        </td>
    </tr>

    <tr>
        <td class="person_meta_box_td" colspan="2">
            <label for="situacao_input"><b>Situação</b></label>
        </td>
        <td colspan="4">
            <label for="ativo">
                <input type="radio" name="situacao_input" id="ativo" value="Ativo" <?php checked( $situacao, 'Ativo' ); ?>>
                Ativo
            </label>
            <label for="inativo">
                <input type="radio" name="situacao_input" id="inativo" value="Inativo" <?php checked( $situacao, 'Inativo' ); ?>>
                Inativo
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
function save_people_info_meta_box_data( $post_id ) {

	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_once = (isset( $_POST['people_info_nonce']) && wp_verify_nonce( $_POST['people_info_nonce'] )); 

    if ( $is_autosave || $is_revision || $is_valid_once ) {
        return;
    }

	$instituicao_input = sanitize_text_field( $_POST['instituicao_input'] );
    $email_contato_input = sanitize_text_field( $_POST['email_contato_input'] );
    $periodo_inicio_input = sanitize_text_field( $_POST['periodo_inicio_input'] );
    $periodo_fim_input = sanitize_text_field( $_POST['periodo_fim_input'] );
	$situacao_input = sanitize_text_field( $_POST['situacao_input'] );
    $linhas_pesquisa_input = sanitize_text_field( $_POST['linhas_pesquisa_input'] );
    $people = (array) $_POST['people'];
    $people = array_map( 'sanitize_text_field', $people);

	// cria o meta_key no banco
	if ( isset( $_POST['instituicao_input'] ) ) {
        update_post_meta( $post_id, '_instituicao_input', $instituicao_input);
    }

    if ( isset( $_POST['email_contato_input'] ) ) {
        update_post_meta( $post_id, '_email_contato_input', $email_contato_input);
    }

    if ( isset( $_POST['periodo_inicio_input'] ) ) {
        update_post_meta( $post_id, '_periodo_inicio_input', $periodo_inicio_input);
    }

    if ( isset( $_POST['periodo_fim_input'] ) ) {
        update_post_meta( $post_id, '_periodo_fim_input', $periodo_fim_input);
    }

    if ( isset( $_POST['linhas_pesquisa_input'] ) ) {
        update_post_meta( $post_id, '_linhas_pesquisa_input', $linhas_pesquisa_input);
    }

    if ( isset( $_POST['people'] ) ) {
        update_post_meta( $post_id, '_people', $people);
    }

    if ( isset( $_POST['situacao_input'] ) ) {
        update_post_meta( $post_id, '_situacao_input', $situacao_input);
    }

}

add_action( 'save_post', 'save_people_info_meta_box_data' );

