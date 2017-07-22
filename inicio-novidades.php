<?php
/**
 * The template used for displaying people content
 *
 */
?>

	<div class="entry-content">
		<?php 
				$args = array( 'post_type'=> array('post', 'wp_pessoa', 'wp_projeto'), 
					'showposts'=>-1);
				$my_projetos = get_posts( $args );
			if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>

		<div class="col-sm-12 col-md-6 col-lg-6 post-content" style="margin-bottom: 20px;">
			<div style="background: #404040;">
				<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
				<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
			</div>

			<div class="thumbnail">
				<p class="circle-date"><?php echo get_the_date('j M Y'); ?></p>
				<div class="sideText">
					<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
					<p><span class="dashicons dashicons-admin-users"></span> <?php the_author (); ?></p>
					 <p><?php the_category(); ?></p> 
					<p><?php echo _get_excerpt(35); ?></p> 
					<div class="more-link-container">
						<a href="<?php the_permalink(); ?>">Leia Mais</a>
					</div>
				</div>
			</div>
		</div>
		<?php
		    endforeach;
		    endif;
			wp_reset_postdata();
		?>
	</div>
	<!-- .entry-content -->