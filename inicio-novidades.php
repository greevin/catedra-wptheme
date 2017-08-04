<?php
/**
 * The template used for displaying people content
 *
 */
?>

	<div class="entry-news row-equal">
	<?php 
		$args = array( 'post_type'=> array('post', 'wp_pessoa', 'wp_projeto'), 'showposts'=>-1);
		$all_posts = get_posts( $args );
		if($all_posts) : foreach($all_posts as $post) : setup_postdata( $post );
	?>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 post-content fix-safari">

			<div class="fundo-gradiente">
				<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
				<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
			</div>

			<div class="thumbnail">
				<div class="novidades-content">
					<p>
						<?php echo get_the_date(); ?>
					</p>
					<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
					<p>
						<?php echo _get_excerpt(35); ?>
					</p>
					<div class="more-link-container">
						<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span> Leia Mais</a>
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