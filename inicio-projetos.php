<?php
/**
 * Template usado para mostrar os projetos na página inicial (front-page.php)
 *
 */
?>
	<!-- Mostra todos os projetos -->
	<div class="entry-projects row-equal">
		<?php 
			$args = array( 'post_type' => 'wp_projeto', 'showposts'=>-1);
			$all_projects = get_posts( $args );

			if($all_projects) : foreach($all_projects as $post) : setup_postdata( $post );

			$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_input', true );
			$today =  date(get_option( 'date_format' ));
			$situacao = get_post_meta( $post->ID, '_situacao_input', true );

			if( $periodo_fim >= $today) :
		?>
		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 fix-safari-3" style="padding:5px;">
			<div class="fundo-gradiente">
				<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
				<div class="project-element blog-element" style="background-image: url(<?php echo $urlImg; ?>);">
					<div class="project-date">

					</div>
					<div>
						<?php the_title( sprintf('<h2 class="entry-title" style="margin-top: 0px;margin-bottom: 0px;"><a class="project-title" href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
						<!-- <?php if( ! empty( $periodo_fim) ) : echo '<p>até ' . $periodo_fim .'</p>'; endif; ?>								 -->
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
	<!-- .entry-content -->