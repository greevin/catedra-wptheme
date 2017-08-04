<?php
/**
 * The template used for displaying page content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('panel-title-container'); ?>>
    <header class="entry-header panel-title-container">
        <?php the_title( '<h1 class="entry-title" style="font-size: 4rem;">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <?php
        // Post thumbnail.
        twentyfifteen_post_thumbnail();
    ?>
</article><!-- #post-## -->
<div class="entry-content">
    <?php the_content(); ?>
</div><!-- .entry-content -->
