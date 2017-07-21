<?php 
	
/*
	Template Name: Template Projeto
*/
	
get_header(); ?>

	<?php 
		
	$args = array('post_type' => 'wp_projeto', 'post_per_page' => 3 );
	$loop = new WP_Query( $args );
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
		<div class="entry-content">

		</div>
    </article>
	<?php
	
	if( $loop->have_posts() ):
		
		while( $loop->have_posts() ): $loop->the_post(); ?>
			
			<?php get_template_part('content', 'page'); ?>
		
		<?php endwhile;
		
	endif;

	wp_reset_postdata();
			
	?>

<?php get_footer(); ?>