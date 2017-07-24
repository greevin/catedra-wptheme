<?php
/**
 * Template usado para mostrar os projetos na página inicial (front-page.php)
 *
 */
?>
		<!-- Relativo aos posts nessa página -->
        <div class="entry-content entry-projects row-equal">
			<?php 
				$args = array( 'post_type' => 'wp_projeto', 'showposts'=>-1);
				$all_projects = get_posts( $args );

				if($all_projects) : foreach($all_projects as $post) : setup_postdata( $post );?>
			<?php 

				$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_input', true );
				$today =  date('d/m/Y ');

				// var_dump($today >= $periodo_fim);
			?>
				<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 fix-safari-3" style="padding:5px;">
					<div style="background: #123652;">
						<?php $urlImg = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) ); ?>
						<div class="project-element blog-element" style="background-image: url(<?php echo $urlImg; ?>);">
							<div class="project-date">
								
							</div>
							<div>
								<?php the_title( sprintf('<h2 class="entry-title" style="margin-top: 0px;margin-bottom: 0px;"><a class="project-title" href="%s">', esc_url( get_permalink() ) ),'</a></h2>' ); ?>
								<!-- <?php if( ! empty( $periodo_fim) ) : echo '<p>até ' . $periodo_fim .'</p>'; endif; ?>								 -->
								<!-- <div class="content"><?php the_excerpt(); ?></div>  -->
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