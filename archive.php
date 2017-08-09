<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<article id="post-<?php the_ID(); ?>" class="panel-title-container hentry">
			<header class="entry-header">
				<?php
					the_archive_title( '<h1 class="entry-title">', '</h1>' );
				?>
			</header><!-- .page-header -->
		</article>

		<div class="entry-content row-equal">
			<div class="row-equal">
				<?php
		
		if( have_posts() ):
			
		while( have_posts() ): the_post(); ?>

		<?php
				
			get_template_part( 'content', 'search' );
			
		endwhile;

		else :
			get_template_part( 'content', 'none' );
		endif;
		wp_reset_postdata();	
		?>
			</div>
		</div>
		<?php 
		the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
				'next_text'          => __( 'Next page', 'twentyfifteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
			) );
?>
	</div>

<?php get_footer(); ?>
