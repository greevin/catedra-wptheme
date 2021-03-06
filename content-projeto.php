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

<article id="post-<?php the_ID(); ?>" <?php post_class('page-background'); ?> style="padding-top:0;">
	<?php
        $agencia_financiadora = get_post_meta($post->ID, '_agencia_financiadora_input', true);
		$parceiros = get_post_meta($post->ID, '_parceiros_input', true);
        $periodo_inicio = get_post_meta($post->ID, '_periodo_inicio_projeto_input', true);
        $periodo_fim = get_post_meta($post->ID, '_periodo_fim_projeto_input', true);
        $coordenadores = get_post_meta($post->ID, '_people', true);
        $equipes = get_post_meta($post->ID, '_equipes', true);
        $situacao = get_post_meta($post->ID, '_situacao_input', true);
		$tags_news = get_post_meta($post->ID, '_tags_news_input', true);
		$noticias = get_post_meta($post->ID, '_checked_posts', true);
		$publicacoes = get_post_meta($post->ID, '_publicacoes_input', true);

        $project_info = ! empty($agencia_financiadora) || ! empty($periodo_inicio) || ! empty($periodo_fim) || ! empty($coordenadores) || ! empty($equipes) || ! empty($situacao) || ! empty($noticias);
?>

	<div class="entry-content">
		<div class="post-content fix-safari" style="height: 100%;margin-bottom: 0px;padding:0">
			<div>
				<h1><?php the_title( ); ?></h1>
			</div>
			<?php if ($project_info == true) : ?>
<section class="entry-section project-table">
	<table>
			<tbody>
				<?php if (! empty($agencia_financiadora)) : ?>
				<tr>
					<td><b><?php _e('Financiamento', 'twentyfifteen-child')?></b></td>
					<td><?php echo $agencia_financiadora; ?></td>
				</tr>
				<?php endif; ?>

				<?php if (! empty($parceiros)) : ?>
				<tr>
					<td><b><?php _e('Parceiros', 'twentyfifteen-child')?></b></td>
					<td><?php echo $parceiros; ?>
				</td>
				</tr>
				<?php endif; ?> 

				<?php if (! empty($periodo_inicio || $periodo_fim)) : ?>
				<tr>
					<td><b><?php _e('Período', 'twentyfifteen-child')?></b></td>
					<td><?php echo date(get_option('date_format'), $periodo_inicio) ?>
					<?php $fim = ! empty($periodo_fim) ? date(get_option('date_format'), $periodo_fim) : __('atual', 'twentyfifteen-child'); ?>
					<?php echo ' - ' . $fim ?></td>
				</tr>
				<?php endif; ?>

				<?php if (! empty($coordenadores)) : ?>
				<tr>
					<td><b><?php _e('Coodernador(es)', 'twentyfifteen-child')?></b></td>
					<td class="projects-link"><?php
                        foreach ($coordenadores as $person) {
                            $post_url=$wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE post_title = '$person' AND post_status = 'publish' ");
                            echo '<a href="' . $post_url . '">' . $person . '<br />';
                        }
                     ?></td>
				</tr>
				<?php endif; ?>

				<?php if (! empty($equipes)) : ?>
				<tr>
					<td><b><?php _e('Equipe', 'twentyfifteen-child')?></b></td>
					<td class="projects-link"><?php
                        foreach ($equipes as $equipe) {
                            $post_url=$wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE post_title = '$equipe' AND post_status = 'publish' ");
                            echo '<a href="' . $post_url . '">' . $equipe . '<br />';
                        }
                     ?></td>
				</tr>
				<?php endif; ?>

				<?php if (! empty($tags_news)) : ?>
				<tr>
					<td><b><?php _e('Notícias', 'twentyfifteen-child')?></b></td>
					<td class="projects-link">
						<?php
						$the_query = new WP_Query( 'tag='. $tags_news .'&posts_per_page=-1' );

                        if ( $the_query->have_posts() ) {
							while ( $the_query->have_posts() ) {
								$the_query->the_post();
								echo '<a href="' . get_the_permalink() .'">' . get_the_title() . '<br />';
							}
						} 
						wp_reset_postdata();
						?>
					</td>
				</tr>
				<?php endif; ?>
				
				<?php if (! empty($situacao)) : ?>
				<tr>
					<td><b><?php _e('Situação', 'twentyfifteen-child')?></b></td>
					<?php $situacao ? 'Ativo' : 'Inativo'; ?>
					<td><?php echo $situacao ? __('Ativo', 'twentyfifteen-child') : __('Inativo', 'twentyfifteen-child'); ?></td>
				</tr>
				<?php endif; ?>

				<?php if (! empty($publicacoes)) : ?>
				<tr>
					<td>
						<b><?php _e('Publicações', 'twentyfifteen-child')?></b>
					</td>
					<td>
						<?php echo do_shortcode($publicacoes); ?>
					</td>
				</tr>
				<?php endif; ?> 
			</tbody>
		</table>
</section>
<?php endif; ?>
			<p><?php the_content(); ?></p>
		<div>
	</div><!-- .entry-content -->

	<?php
        // Author bio.
        if (is_single() && get_the_author_meta('description')) :
            get_template_part('author-bio');
        endif;
    ?>
</article><!-- #post-## -->