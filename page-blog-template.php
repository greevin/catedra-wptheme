<?php
/**
 *
 * Template Name: Template Blog
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<article id="post-<?php the_ID(); ?>" <?php post_class('panel-title-container'); ?>>
			<?php
                // Post thumbnail.
                twentyfifteen_post_thumbnail();
            ?>

			<header class="entry-header">
				<?php the_title('<h1 class="entry-title">', '</h1>'); ?>
			</header>
			<!-- .entry-header -->
			<?php if (get_the_content() != '') : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<?php endif; ?>
			<!-- .entry-content -->

		</article>

		<?php
            
        	global $paged;

            query_posts(array(
            'post_type' => 'post', // can be custom post type
            'showposts' => get_option('posts_per_page'),
            'paged' => $paged
        ));
        ?>

		<div class="entry-content row-equal news-content">
			<div class="row-equal">
				<?php

        if (have_posts()):

        while (have_posts()): the_post(); ?>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 post-content fix-safari">
				<?php $urlImg = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>
				<div class="<?php echo $urlImg == false ? 'fundo-gradiente' : 'fundo-branco'; ?>">
					<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
				</div>

					<div class="page-novidades-content">
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
		<?php endwhile;
        endif;
wp_reset_postdata();
?>
			</div>
		</div>
		<?php
        the_posts_pagination(array(
                'prev_text'          => __('Previous page', 'twentyfifteen'),
                'next_text'          => __('Next page', 'twentyfifteen'),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'twentyfifteen') . ' </span>',
            ));
?>
	</div>
	<!-- .content-area -->
	<?php get_footer(); ?>
