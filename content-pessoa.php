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
		$periodo_inicio = get_post_meta( $post->ID, '_periodo_inicio_input', true );
		$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_input', true );
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
		<?php if( ! empty( $instituicao) ) : echo '<p><b>Instituição: </b>' . $instituicao . '</p>'; endif; ?>
		<?php if( ! empty( $email_contato) ) : echo '<p><b>E-mail de Contato: </b><a href="mailto:' . $email_contato . '">'. $email_contato .'</a></p>'; endif; ?>
		<?php if( ! empty( $periodo_inicio || $periodo_fim) ) : echo '<p><b>Período: </b>' . $periodo_inicio . ' - '. $periodo_fim .'</p>'; endif; ?>
		<?php if( ! empty( $linhas_pesquisa) ) : echo '<p><b>Linha(s) de Pesquisa: </b>' . $linhas_pesquisa . '</p>'; endif; ?>			
		<?php if( ! empty( $projetos) ) : 

		echo '<p><b>Projetos: </b>';
			foreach ( $projetos as $person ) {
				$post_url=$wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE post_title = '$person' AND post_status = 'publish' ");
				echo '<br /><a href="' . $post_url . '"><span class="dashicons dashicons-arrow-right-alt"></span>' . $person;
			}
		echo '</a></p>';

		endif; 
		?>
		<?php if( ! empty( $situacao) ) : echo '<p><b>Situação: </b>' . $situacao . '</p>'; endif; ?>			
	</section><!-- .entry-footer -->
<?php endif; ?>