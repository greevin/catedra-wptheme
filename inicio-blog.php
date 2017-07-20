<?php
/**
 * The template used for displaying people content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

        <div class="entry-content">
			<?php 
				$args = array( 'post_type'=> array('post', 'pessoa', 'projetos'), 
					'showposts'=>10);
				$my_projetos = get_posts( $args );
				if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>

                   <div class="col-sm-6 col-md-6 col-lg-6" style="margin-bottom: 20px;">

					<div style="background: #404040;">
						<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
						<div class="blog-element" style="border:1px solid;background-image: url(<?php echo $urlImg; ?>);">
							
							<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
							<!-- <div class="content"><?php the_excerpt(); ?></div> -->
							<small><?php the_category(' '); ?></small>
						</div>
					</div>
					
		</div>
			 <?php
		    	endforeach;
		    	endif;
				wp_reset_postdata();
?>
		<!-- <div class="link"><a class="leia-mais" href="<?php echo the_title(); ?>">VER TODOS</a></div> -->
        </div>
        <!-- .entry-content -->