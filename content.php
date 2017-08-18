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
		<p><?php the_content( ); ?></p>
	<div>
	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>
</article><!-- #post-## -->