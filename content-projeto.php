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
		$agencia_financiadora = get_post_meta( $post->ID, '_agencia_financiadora_input', true );
		$periodo_inicio = get_post_meta( $post->ID, '_periodo_inicio_input', true );
		$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_input', true );
		$coordenadores = get_post_meta( $post->ID, '_people', true );
		$equipes = get_post_meta( $post->ID, '_equipes', true );
		$situacao = get_post_meta( $post->ID, '_situacao_input', true );
		$noticias = get_post_meta( $post->ID, '_checked_posts', true );

		$project_info = ! empty( $agencia_financiadora) || ! empty( $periodo_inicio) || ! empty( $periodo_fim) || ! empty( $coordenadores) || ! empty( $equipes) || ! empty( $situacao) || ! empty( $noticias);
?>

	<div class="entry-content">
		<div class="post-content fix-safari" style="height: 100%;margin-bottom: 0px;">
			<div class="thumbnail" style="height: 100%;">
				<div class="sideText">
					<?php the_title( sprintf('<h1 class="entry-title" style="text-align: center;"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
					<p style="text-align: center;"><?php echo get_the_date('j M Y'); ?></p>
					<div style="text-align:center;">
						<?php twentyfifteen_post_thumbnail(); ?>
					</div>
				<p><?php the_content( ); ?></p>
			</div>
		<div>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>
</article><!-- #post-## -->

<?php if( $project_info == true ) : ?>
<section class="entry-section">
		<h2>Mais informações</h2><br />
		<?php if( ! empty( $agencia_financiadora) ) : echo '<p><b>Agência Financiadora: </b>' . $agencia_financiadora . '</p>'; endif; ?>
			<?php if( ! empty( $periodo_inicio || $periodo_fim) ) : echo '<p><b>Período: </b>' . $periodo_inicio . ' - '. $periodo_fim .'</p>'; endif; ?>
			<?php if( ! empty( $linhas_pesquisa) ) : echo '<p><b>Linha(s) de Pesquisa: </b>' . $linhas_pesquisa . '</p>'; endif; ?>			
			<?php if( ! empty( $coordenadores) ) : 

			echo '<p><b>Coordenador(es): </b>';
				foreach ( $coordenadores as $person ) {
					echo '<br />' . $person;
				}
			echo '</p>';

			endif; 
			?>
			<?php if( ! empty( $coordenadores) ) : 

			echo '<p><b>Equipe: </b>';
				foreach ( $equipes as $equipe ) {
					echo '<br />' . $equipe;
				}
			echo '</p>';

			endif; 
			?>
			<?php if( ! empty( $situacao) ) : echo '<p><b>Situação: </b>' . $situacao . '</p>'; endif; 

			if( ! empty( $noticias) ) : 

			echo '<p><b>Notícias: </b>';
				foreach ( $noticias as $noticia ) {
					echo '<br />' . $noticia;
				}
			echo '</p>';

			endif; 
			
	?>	
					
</section>
<?php endif; ?>
