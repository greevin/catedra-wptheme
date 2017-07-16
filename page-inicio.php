<?php /* Template Name: Página Inicial */ ?>

<?php get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<!-- Sobre -->
		<div class="about" id="sobre">
			<?php
				$args = array(
					'post_type'=>'page', 
					'pagename'=>'sobre'
				);
				$sobre = new WP_Query($args);
				// Start the loop.
				while ( $sobre->have_posts() ) : $sobre->the_post();

				// Include the page content template.
				get_template_part( 'content', 'page' );

				// End the loop.
				endwhile;

				wp_reset_postdata();
			?> 
		</div>

		<!-- Projetos -->
		<div class="projects" id="projetos">
			<?php
				$args = array(
					'post_type'=>'page', 
					'pagename'=>'projeto'
				);
				$sobre = new WP_Query($args);
				
				// Start the loop.
				while ( $sobre->have_posts() ) : $sobre->the_post();

				// Include the page content template.
				get_template_part( 'content', 'project' );

				// End the loop.
				endwhile;

				wp_reset_postdata();
		?>	
		<div style="margin-bottom: 60px;"></div>
		</div>

		<!-- Pessoas -->
		<div class="people" id="pessoas">
			<?php
				$args = array(
					'post_type'=>'page', 
					'pagename'=>'pessoas'
				);
				$sobre = new WP_Query($args);
				
				// Start the loop.
				//carrega apenas a página
				while ( $sobre->have_posts() ) : $sobre->the_post();

				// Include the page content template.
				get_template_part( 'content', 'people' );

				// End the loop.
				endwhile;

				wp_reset_postdata();
			?>
			<div style="margin-bottom: 60px;"></div>
		</div>

		<!-- Blog -->
		<div class="blog" id="blog">
			<?php
				$args = array(
					// 'post_type'=> array('post', 'pessoa', 'projetos'), 
					// 'showposts'=>2
					'post_type'=>'page', 
					'pagename'=>'blog'
				);
				$sobre = new WP_Query($args);
				// Start the loop.
				while ( $sobre->have_posts() ) : $sobre->the_post();

				// Include the page content template.
				get_template_part( 'content', 'blog' );

				// End the loop.
				endwhile;

				wp_reset_postdata();
			?>
		</div>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?>