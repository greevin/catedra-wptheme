<?php
/**
 *
 * Template Name: Template Projeto
 */

get_header(); ?>

<div id="primary" class="content-area">
		<?php 
			$args = array('post_type' => 'wp_pessoa', 'showposts' => -1 );
			$loop = new WP_Query( $args );
		?>
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="
        padding-top: 5rem;
    padding-bottom: 20px;
    margin-bottom: 20px;
	background: #294F6D;
	color:white;
	margin-left: 3px;
">
			<?php
				// Post thumbnail.
				twentyfifteen_post_thumbnail();
			?>

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title" style="font-size: 5rem;">', '</h1>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content" style="text-align: center;">
				<?php the_content(); ?>
			</div><!-- .entry-content -->

		</article><!-- #post-## -->
		<?php
		// End the loop.
		endwhile;
		?>

	<div class="entry-content row-equal">
		<?php
		
		if( $loop->have_posts() ):
			
		while( $loop->have_posts() ): $loop->the_post(); ?>
			<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 post-content fix-safari" style="height: 100%;margin-bottom: 20px;">
				<div style="background: #123652;">
					<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
					<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
				</div>

				<div class="thumbnail" style="height: 100%;">
					<p class="circle-date"><?php echo get_the_date('j M Y'); ?></p>
					<div class="sideText">
						<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
						<p style="text-align: center;"><?php the_author (); ?> | <?php comments_number( '0 comentários', '1 comentário', '% comentários' ); ?></p>
						<?php the_category(); ?>
						<p><?php echo _get_excerpt(40); ?></p>
					</div>
				</div>
			</div>
			
		<?php endwhile;
			
		endif;

		wp_reset_postdata();
				
		?>
	</div>

</div><!-- .content-area -->

<?php get_footer(); ?>
