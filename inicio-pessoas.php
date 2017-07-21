
<?php
/**
 * Template usado para mostrar as pessoas na página inicial (front-page.php)
 *
 */
?>
        <div class="entry-content" style="text-align: center;">
			<?php 
				$args = array( 'post_type' => 'wp_pessoa', 'showposts'=>10);
				$my_projetos = get_posts( $args );
				if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>
                   <div class="col-sm-4 col-md-4 col-lg-4" style="height: 450px;">
					   <div class="circle-img">
						  <span> <?php 
						   		$title = get_the_title();
								$words = explode(" ", $title, 2);
								$acronym = "";

								foreach ($words as $w) {
									$acronym .= $w[0];
								}

								echo $acronym;

								?>
							</span>
							
  							<?php the_post_thumbnail(false, array('class'=>'img-responsive responsive--full')); ?>  
						</div>
				<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="content"><?php the_excerpt(); ?></div>
		</div>
			 <?php
		    	endforeach;
		    	endif;
				wp_reset_postdata();
?>
		<!-- <div class="link"><a class="leia-mais" href="<?php echo the_title(); ?>">VER TODOS</a></div> -->
        </div>
        <!-- .entry-content -->