<?php
/**
 * The template used for displaying people content
 *
 */
?>
	<div class="entry-news row-equal">
	<?php
        	$sticky_posts = count(get_option( 'sticky_posts' ));
			$posts_per_page = (int) get_option( 'posts_per_page' );
            
			$args = array(
				// 'ignore_sticky_posts' => 1,
				// 'posts_per_page' =>  $posts_per_page - $sticky_posts,
				'paged' => $paged
			);
        	$wp_query = new WP_Query($args); 

		if ($wp_query->have_posts()):

        while ($wp_query->have_posts()): $wp_query->the_post(); ?>


		<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 post-content fix-safari">
			<?php $urlImg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
			<a href="<?php the_permalink(); ?>">
			<div class="<?php echo $urlImg == false ? 'fundo-gradiente' : 'fundo-branco'; ?>">
				<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
			</div>
			</a>
				<div class="novidades-content">
					<p>
						<?php echo get_the_date(); ?>
					</p>
					<?php 
							if ( is_sticky() ) {
								the_title(sprintf('<h4 class="entry-title"><a href="%s"><span class="dashicons dashicons-sticky"></span>', esc_url(get_permalink())), '</a></h4>');
							} else {
								the_title(sprintf('<h4 class="entry-title"><a href="%s">', esc_url(get_permalink())), '</a></h4>');
							}
						?>
					<p>
						<?php echo _get_excerpt(35); ?>
					</p>
					<div class="more-link-container">
						<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span> <?php _e('Leia Mais', 'twentyfifteen-child') ?></a>
					</div>
				</div>
		</div>

	<?php
        // endforeach;
		endwhile;
        endif;
        wp_reset_postdata();
?>
	</div>
