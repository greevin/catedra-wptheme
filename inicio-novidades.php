<?php
/**
 * The template used for displaying people content
 *
 */
?>
	<div class="entry-news row-equal">
	<?php
        // $args = array( 'post_type'=> 'post', 'showposts' => get_option('posts_per_page') );
        // $all_posts = get_posts($args);
        // if ($all_posts) : foreach ($all_posts as $post) : setup_postdata($post);
		 query_posts(array(
            'post_type' => 'post', // can be custom post type
            'showposts' => get_option('posts_per_page') / 2,
        ));

		if (have_posts()):

        while (have_posts()): the_post(); ?>


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
