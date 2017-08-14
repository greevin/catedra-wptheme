<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<article id="post-<?php the_ID(); ?>" class="panel-title-container hentry">
			<header class="entry-header">
				<h1 class="entry-title" style="font-size: 4rem;"><?php printf(__('Search Results for: %s', 'twentyfifteen'), get_search_query()); ?></h1>
			</header>
		</article>

		<div class="entry-content row-equal search-entry-content">
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
