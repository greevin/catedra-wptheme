<?php
/**
 * The template used for displaying people content
 *
 */
?>

	<div class="entry-content">
		<?php 
				$args = array( 'post_type'=> array('post', 'wp_pessoa', 'wp_projeto'), 
					'showposts'=>-1);
				$my_projetos = get_posts( $args );
			if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>

		<div class="col-sm-12 col-md-12 col-lg-12" style="margin-bottom: 20px;">

			<div class="image-div thumbnail">

    			<?php the_post_thumbnail( array(250, 250) ); ?>

				<div class="sideText">
					<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
					<?php echo get_the_date(); ?>
					<?php the_author (); ?>
					<?php the_category(); ?>
					<p><?php echo _get_excerpt(35); ?></p> 
					<div class="more-link-container">
						<a href="<?php the_permalink(); ?>">Leia Mais</a>
					</div>
				</div>
			</div>
		</div>
		<?php
		    endforeach;
		    endif;
			wp_reset_postdata();
		?>
	</div>
	<!-- .entry-content -->