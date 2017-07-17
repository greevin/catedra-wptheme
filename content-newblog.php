<?php
/**
 * The template used for displaying people content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
			the_content( );
		?>
	</header><!-- .entry-header -->

        <div class="entry-content" style="text-align: center;">
			<?php 

			$args = array( 'post_type'=> array('post', 'pessoa', 'projetos'), 
					'showposts'=>4);
		
		if( have_posts() ): $i = 0;
			
			while( have_posts() ): the_post(); ?>
				
				<?php 
					if($i==0): $column = 12; 
					elseif($i > 0 && $i <= 2): $column = 6; $class = ' second-row-padding';
					elseif($i > 2): $column = 4; $class = ' third-row-padding';
					endif;
				?>
				
					<div class="col-xs-<?php echo $column; echo $class; ?> blog-item">
						<?php if( has_post_thumbnail() ):
							$urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						endif; ?>
						<div class="blog-element" style="background-image: url(<?php echo $urlImg; ?>);">
							
							<?php the_title( sprintf('<h1 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h1>' ); ?>
							
							<small><?php the_category(' '); ?></small>
						</div>
					</div>
			
			<?php $i++; endwhile;
			
		endif;
				
?>
		</div>
    <!-- #post-## -->