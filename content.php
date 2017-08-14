<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('page-background'); ?> style="padding-top:0;padding-bottom:0;">
	<div class="entry-content">
		<div>
			<h1><?php the_title( ); ?></h1>
		</div>
		<div class="sideText">
			<?php if (get_the_post_thumbnail() != '') : ?>
			<div class="align-image">
				<?php the_post_thumbnail( 'medium' ); ?>
			</div>
			<p><?php the_content( ); ?></p>
				<?php else : ?>
			<p><?php the_content( ); ?></p>
				<?php endif; ?>  
		</div>
	<div>
	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>
</article><!-- #post-## -->