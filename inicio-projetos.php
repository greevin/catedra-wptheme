<?php
/**
 * The template used for displaying people content
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>
		<!-- Relativo aos posts nessa página -->
        <div class="entry-content entry-projects">
			<?php 
				$i = 0;
				$args = array( 'post_type' => 'projetos');
				$my_projetos = get_posts( $args );
				if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>
				<?php 
					if($i==0): $column = 6; 
					elseif($i >= 2): $column = 4; $class = ' second-row-padding';
					endif;
				?>
                   <div class="col-md-<?php echo $column; echo $class; ?> col-xs-12" style="padding-left: 0px;padding-right: 0px;">

					<div style="background: #404040;">
						<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
						<div class="blog-element" style="border:1px solid;background-image: url(<?php echo $urlImg; ?>);">
							
							<?php the_title( sprintf('<h2 class="entry-title"><a href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
							 <!-- <div class="content"><?php the_excerpt(); ?></div>  -->
						</div>
					</div>
					
		</div>
			<?php
			$i++;
		    	endforeach;
		    	endif;
				wp_reset_postdata();
?>
		</div>
        <!-- .entry-content -->