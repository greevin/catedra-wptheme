<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="padding-top: 3.5%;">
	<?php

		$instituicao = get_post_meta( $post->ID, '_instituicao_input', true );
		$email_contato = get_post_meta( $post->ID, '_email_contato_input', true );
		$periodo_inicio = get_post_meta( $post->ID, '_periodo_inicio_pessoa_input', true );
		$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_pessoa_input', true );
		$linhas_pesquisa = get_post_meta( $post->ID, '_linhas_pesquisa_input', true );
		$projetos = get_post_meta( $post->ID, '_projetos_input', true );
		$situacao = get_post_meta( $post->ID, '_situacao_input', true );

		$people_info = ! empty( $instituicao) || ! empty( $email_contato) || ! empty( $periodo_inicio) || ! empty( $periodo_fim) || ! empty( $linhas_pesquisa) || ! empty( $projetos) || ! empty( $situacao);
	?>

	<div class="entry-content">
		<div class="thumbnail" style="height: 100%;">
				<div class="sideText">
					<?php the_title( sprintf('<h1 class="entry-title" style="text-align: center;"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
					<?php if (get_the_post_thumbnail() != '') : ?>
					<div class="align-image">
						<?php the_post_thumbnail( 'medium' ); ?>
					</div>
					 <p><?php the_content( ); ?></p>
					 <?php else : ?>
					 <p><?php the_content( ); ?></p>
					 <?php endif; ?>  
				</div>
				<div>
		<div>
			
		</div>
	</div><!-- .entry-content -->
	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>
</article><!-- #post-## -->

<?php if( $people_info == true ) : ?>
	<section class="entry-section">
		<table>
			<tbody>
				<?php if( ! empty( $instituicao) ) : ?>
				<tr>
					<td><b>Instituição: </b></td>
					<td><?php echo $instituicao; ?></td>
				</tr>
				<?php endif; ?>
				<?php if( ! empty( $email_contato) ) : ?>
				<tr>
					<td><b>E-mail de Contato: </b></td>
					<td><a href="mailto:<?php echo $email_contato; ?>"><?php echo $email_contato; ?></a></p></td>
				</tr>
				<?php endif; ?>
				<?php if( ! empty( $periodo_inicio || $periodo_fim) ) : ?>
				<tr>
					<td><b>Período: </b></td>
					<td><?php echo date_i18n( get_option( 'date_format' ), $periodo_inicio ) ?> - <?php echo date_i18n( get_option( 'date_format' ), $periodo_fim ); ?></td>
				</tr>
				<?php endif; ?>
				<?php if( ! empty( $linhas_pesquisa) ) : ?>
				<tr>
					<td><b>Linha(s) de Pesquisa: </b></td>
					<td><?php echo $linhas_pesquisa; ?></td>
				</tr>
				<?php endif; ?>
				<?php if( ! empty( $projetos) ) : ?>
				<tr>
					<td><b>Projetos: </b></td>
					<td class="projects-link"><?php 
						foreach ( $projetos as $person ) {
							$post_url=$wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE post_title = '$person' AND post_status = 'publish' ");
							echo '<a href="' . $post_url . '"><span class="dashicons dashicons-arrow-right-alt" style="margin-top: 3px;"></span>' . $person . '</a></br>';
						}
					 ?></td>
				</tr>
				<?php endif; ?>
				<?php if( ! empty( $situacao) ) : ?>
				<tr>
					<td><b>Situação: </b></td>
					<td><?php echo $situacao; ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>			
	</section><!-- .entry-footer -->
<?php endif; ?>