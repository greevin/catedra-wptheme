<?php
/**
 * Template usado para mostrar os projetos na página inicial (front-page.php)
 *
 */
 use Carbon\Carbon;

 ?>
	<!-- Mostra todos os projetos -->
	<div class="entry-projects row-equal">
		<?php
            $args = array( 'post_type' => 'wp_projeto', 'showposts'=>-1);
            $all_projects = get_posts($args);

            if ($all_projects) : foreach ($all_projects as $post) : setup_postdata($post);

            $periodo_fim = get_post_meta($post->ID, '_periodo_fim_projeto_input', true);
            $situacao = get_post_meta($post->ID, '_situacao_input', true);

            if ($periodo_fim >= Carbon::now()->timestamp || $situacao == 1) :
        ?>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 fix-safari">
			<?php $urlImg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
			<div class="<?php echo $urlImg == false ? 'fundo-gradiente' : 'fundo-branco'; ?>">
				<a href="<?php the_permalink(); ?>">
				
				<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
				</a>
			</div>

			<div>
				<div class="project-content">
					<?php the_title(sprintf('<h4 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h4>'); ?>
					<?php if ( ! has_excerpt() ) { ?>
      							<p><?php echo wp_trim_words( get_the_content(), 30, '...' ); ?></p>
							 <?php } else { 
								the_excerpt();
							} ?>
					<div class="more-link-container">
						<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span> <?php _e('Leia Mais', 'twentyfifteen-child') ?></a>
					</div>
				</div>
			</div>
		</div>
		<?php
            endif;
            endforeach;
            endif;
            wp_reset_postdata();
        ?>
	</div>
