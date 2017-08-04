<?php
/**
 *
 * Template Name: Template Projeto
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<?php 
		$args = array('post_type' => 'wp_projeto', 'showposts' => -1 );
		$loop = new WP_Query( $args );
	?>
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
	?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'panel-title-container'); ?>>
				<?php
			twentyfifteen_post_thumbnail();
		?>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title" style="font-size: 4rem;">', '</h1>' ); ?>
				</header>
				<!-- .entry-header -->

				<div class="entry-content entry-projects-content">
					<?php the_content(); ?>
				</div>
				<!-- .entry-content -->

			</article>
			<!-- #post-## -->
			<?php
	// End the loop.
	endwhile;
	?>

	<div class="entry-content">
		<div class="row-equal page-projetos">
			<?php
		
		if( $loop->have_posts() ):
			
		while( $loop->have_posts() ): $loop->the_post(); ?>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 fix-safari">
				<div class="fundo-gradiente">
					<a href="<?php the_permalink(); ?>">
						<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
						<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
					</a>
				</div>

				<div class="thumbnail">
					<div class="projects-content">
						<p>
							<?php echo get_the_date(); ?>
						</p>
						<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
						<p>
							<?php echo _get_excerpt(35); ?>
						</p>
						<div class="more-link-container">
							<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span><?php _e( 'Leia Mais', 'twentyfifteen-child' ) ?></a>
						</div>
					</div>
				</div>
			</div>

		<?php endwhile;
		endif;
		wp_reset_postdata();
			
		?>
		</div>
		</div>
	</div>
	<!-- .content-area -->

	<?php get_footer(); ?>