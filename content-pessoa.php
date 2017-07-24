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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="padding-top: 5%;">
	<?php
		$instituicao = get_post_meta( $post->ID, '_instituicao_input', true );
		$email_contato = get_post_meta( $post->ID, '_email_contato_input', true );
		$periodo_inicio = get_post_meta( $post->ID, '_periodo_inicio_input', true );
		$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_input', true );
		$linhas_pesquisa = get_post_meta( $post->ID, '_linhas_pesquisa_input', true );
		$projetos = get_post_meta( $post->ID, '_people', true );
		$situacao = get_post_meta( $post->ID, '_situacao_input', true );
	?>

	<div class="entry-content">
		<div class="thumbnail" style="height: 100%;">
				<div class="sideText">
					<?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
					<p style="text-align: center;"><?php the_author (); ?> | <?php comments_number( '0 comentários', '1 comentário', '% comentários' ); ?> | <?php echo get_the_date('j M Y'); ?></p>
					<?php the_category(); ?>
					<div style="text-align:center;">
						<?php twentyfifteen_post_thumbnail(); ?>
					</div>
					<p><?php the_content( ); ?></p>
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

<footer class="entry-footer">
		<?php if( ! empty( $instituicao) ) : echo '<h2>Mais informações</h2><br />' . '<p><b>Instituição: </b>' . $instituicao . '</p>'; endif; ?>
		<?php if( ! empty( $email_contato) ) : echo '<p><b>E-mail de Contato: </b><a href="mailto:' . $email_contato . '">'. $email_contato .'</a></p>'; endif; ?>
		<?php if( ! empty( $periodo_inicio || $periodo_fim) ) : echo '<p><b>Período: </b>' . $periodo_inicio . ' - '. $periodo_fim .'</p>'; endif; ?>
		<?php if( ! empty( $linhas_pesquisa) ) : echo '<p><b>Linha(s) de Pesquisa: </b>' . $linhas_pesquisa . '</p>'; endif; ?>			
		<?php if( ! empty( $projetos) ) : 

		echo '<p><b>Projetos: </b>';
			foreach ( $projetos as $person ) {
				echo '<br />' . $person;
			}
		echo '</p>';

		endif; 
		?>
		<?php if( ! empty( $situacao) ) : echo '<p><b>Situação: </b>' . $situacao . '</p>'; endif; ?>			
	</footer><!-- .entry-footer -->
