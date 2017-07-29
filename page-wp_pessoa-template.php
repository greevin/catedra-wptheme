<?php
/**
 *
 * Template Name: Template Pessoa
 */

get_header(); ?>

	<div id="primary" class="content-area">
	<?php 
		$args = array('post_type' => 'wp_pessoa', 'showposts' => -1 );
		$loop = new WP_Query( $args );
		while ( have_posts() ) : the_post();
	?>
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'panel-title-container'); ?> style="height: 300px;">
		<?php
			twentyfifteen_post_thumbnail();
		?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title" style="font-size: 4rem;margin-bottom: 20px;">', '</h1>' ); ?>
			</header>
			<!-- .entry-header -->

			<div class="entry-content people-content">
				<?php the_content(); ?>
			</div>
				<!-- .entry-content -->
		</article>
			<!-- #post-## -->
	<?php endwhile; ?>

		<div class="entry-content row-equal page-pessoas" style="margin-top: -120px;">
		<?php
			if( $loop->have_posts() ):
			
			while( $loop->have_posts() ): $loop->the_post(); ?>
				<div class="col-sm-4 col-md-4 col-lg-4 fix-safari-3 fix-safari" style="height: 100%;margin-bottom: 20px;">
					<div class="thumbnail" style="text-align: center;">
						<div class="circle-img fundo-gradiente">
							<a href="<?php the_permalink(); ?>">
								<span> 
									<?php 
										$title = get_the_title();
										$words = explode(" ", $title, 2);
										$acronym = "";

										foreach ($words as $w) {
											$acronym .= $w[0];
										}

										echo $acronym;

										?>
								</span>
								<?php the_post_thumbnail(false, array('class'=>'img-responsive responsive--full')); ?>
							</a>
						</div>
						<h3 class="person-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<div class="content-pessoa">
							<p>
								<?php echo _get_excerpt(20); ?>
							</p>
							<div class="more-link-container">
								<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span> Leia Mais</a>
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
	<!-- .content-area -->

	<?php get_footer(); ?>