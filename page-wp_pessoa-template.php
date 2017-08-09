<?php
/**
 *
 * Template Name: Template Pessoa
 */

get_header(); ?>

	<div id="primary" class="content-area">
	<?php
        $args = array('post_type' => 'wp_pessoa', 'showposts' => -1 );
        $loop = new WP_Query($args);
        while (have_posts()) : the_post();
    ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('panel-title-container'); ?>>
		<?php
            twentyfifteen_post_thumbnail();
        ?>
			<header class="entry-header">
				<?php the_title('<h1 class="entry-title" style="font-size: 4rem;">', '</h1>'); ?>
			</header>
			<!-- .entry-header -->

			<div class="entry-content people-content">
				<?php the_content(); ?>
			</div>
				<!-- .entry-content -->
		</article>
			<!-- #post-## -->
	<?php endwhile; ?>

		<div class="entry-content">
			<div class="row-equal page-pessoas">
				<?php
            if ($loop->have_posts()):

            while ($loop->have_posts()): $loop->the_post(); ?>
				<div class="col-sm-12 col-md-6 col-lg-6 fix-safari">
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
							<?php the_excerpt(); ?>
						</h3>
						<div class="content-pessoa">
							<p style="margin-bottom: 5px;">
								<?php echo wp_trim_words(get_the_content(), 30, '...'); ?>
							</p>
							<div class="more-link-container">
								<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span> <?php _e('Leia Mais', 'twentyfifteen-child') ?></a>
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
