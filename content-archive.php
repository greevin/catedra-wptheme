<?php
/**
 * The template part for displaying results in search pages
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 post-content fix-safari" style="height: 100%;margin-bottom: 20px;">
				<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
				<div class="<?php echo $urlImg == false ? 'fundo-gradiente' : 'fundo-branco'; ?>">
					<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);"></div>
				</div>

				<div class="thumbnail">
					<div class="page-novidades-content">
						<p>
							<?php echo get_the_date(); ?>
						</p>
						<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
						<p>
							<?php echo _get_excerpt(35); ?>
						</p>
						<div class="more-link-container">
							<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span> <?php _e( 'Leia Mais', 'twentyfifteen-child' ) ?></a>
						</div>
					</div>
				</div>
			</div>