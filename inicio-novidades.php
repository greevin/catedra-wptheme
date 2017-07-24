<?php
/**
 * The template used for displaying people content
 *
 */
?>

	<div class="entry-content row-equal">
		<?php 
				$args = array( 'post_type'=> array('post', 'wp_pessoa', 'wp_projeto'), 
					'showposts'=>-1);
				$all_posts = get_posts( $args );
			if($all_posts) : foreach($all_posts as $post) : setup_postdata( $post );?>

		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 post-content fix-safari-3" style="margin-bottom: 20px;">
			<div style="background: #123652;">
				<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
				<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
			</div>

			<div class="thumbnail">
				<p class="circle-date"><?php echo get_the_date('j M Y'); ?></p>
				<div class="sideText">
					<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
					<p style="text-align: center;"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a> | <?php comments_number( '0 comentários', '1 comentário', '% comentários' ); ?></p>
					 <?php the_category(); ?>
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