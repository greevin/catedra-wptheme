<?php
/**
 *
 * The template for displaying archive pages
 *
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<article id="post-<?php the_ID(); ?>" class="panel-title-container hentry">
			<header class="entry-header">
				<?php the_archive_title('<h1 class="entry-title">', '</h1>'); ?>
			</header><!-- .page-header -->
		</article>

		<div class="entry-content row-equal">
			<div class="row-equal">
				<?php

        if (have_posts()):

        while (have_posts()): the_post(); ?>

		<?php

            get_template_part('content', 'search');

        endwhile;

        else :
            get_template_part('content', 'none');
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

<?php get_footer(); ?>
