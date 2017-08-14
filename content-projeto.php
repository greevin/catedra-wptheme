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
        $periodo_inicio = get_post_meta($post->ID, '_periodo_inicio_projeto_input', true);
        $periodo_fim = get_post_meta($post->ID, '_periodo_fim_projeto_input', true);
        $coordenadores = get_post_meta($post->ID, '_people', true);
        $equipes = get_post_meta($post->ID, '_equipes', true);
        $situacao = get_post_meta($post->ID, '_situacao_input', true);
        $noticias = get_post_meta($post->ID, '_checked_posts', true);

        $project_info = ! empty($agencia_financiadora) || ! empty($periodo_inicio) || ! empty($periodo_fim) || ! empty($coordenadores) || ! empty($equipes) || ! empty($situacao) || ! empty($noticias);
?>

	<div class="entry-content">
		<div class="post-content fix-safari" style="height: 100%;margin-bottom: 0px;">
			<div>
				<h1><?php the_title( ); ?></h1>
			</div>
				<div class="sideText">
					<?php if (get_the_post_thumbnail() != '') : ?>
					<div class="align-image">
						<?php the_post_thumbnail('medium'); ?>
					</div>
				<div>
					<?php the_content(); ?>
				</div>
				<?php else : ?>
					 <p><?php the_content(); ?></p>
					 <?php endif; ?>
		<div>
	</div><!-- .entry-content -->

	<?php
        // Author bio.
        if (is_single() && get_the_author_meta('description')) :
            get_template_part('author-bio');
        endif;
    ?>
</article><!-- #post-## -->

<?php if ($project_info == true) : ?>
<section class="entry-section project-table">
	<table>
			<tbody>
				<?php if (! empty($agencia_financiadora)) : ?>
				<tr>
					<td><b><?php _e('Agência(s) financiadora(s)', 'twentyfifteen-child')?></b></td>
					<td><?php echo $agencia_financiadora; ?></td>
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
                            echo '<a href="' . $post_url . '"><span class="dashicons dashicons-arrow-right-alt"></span> ' . $person . '<br />';
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
                            echo '<a href="' . $post_url . '"><span class="dashicons dashicons-arrow-right-alt"></span> ' . $equipe . '<br />';
                        }
                     ?></td>
				</tr>
				<?php endif; ?>
				<?php if (! empty($noticias)) : ?>
				<tr>
					<td><b><?php _e('Notícias', 'twentyfifteen-child')?></b></td>
					<td class="projects-link"><?php
                        foreach ($noticias as $noticia) {
                            $post_url=$wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE post_title = '$noticia' AND post_status = 'publish' ");
                            echo '<a href="' . $post_url . '"><span class="dashicons dashicons-arrow-right-alt"></span> ' . $noticia . '<br />';
                        }
                     ?></td>
				</tr>
				<?php endif; ?>
				<?php if (! empty($situacao)) : ?>
				<tr>
					<td><b><?php _e('Situação', 'twentyfifteen-child')?></b></td>
					<?php $situacao ? 'Ativo' : 'Inativo'; ?>
					<td><?php echo $situacao ? __('Ativo', 'twentyfifteen-child') : __('Inativo', 'twentyfifteen-child'); ?></td>
				</tr>
				<?php endif; ?>
			</tbody>
		</table>
</section>
<?php endif; ?>
