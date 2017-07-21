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

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
		// Post thumbnail.
		twentyfifteen_post_thumbnail();
	?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s', 'twentyfifteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			$instituicao = get_post_meta( $post->ID, '_instituicao_input', true );
			$email_contato = get_post_meta( $post->ID, '_email_contato_input', true );
			$periodo_inicio = get_post_meta( $post->ID, '_periodo_inicio_input', true );
			$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_input', true );
			$linhas_pesquisa = get_post_meta( $post->ID, '_linhas_pesquisa_input', true );
			$projetos = get_post_meta( $post->ID, '_people', true );
			$situacao = get_post_meta( $post->ID, '_situacao_input', true );
		?>

		<div>
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

		</div>
		
		<?php

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfifteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php twentyfifteen_entry_meta(); ?>
		<?php edit_post_link( __( 'Edit', 'twentyfifteen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
