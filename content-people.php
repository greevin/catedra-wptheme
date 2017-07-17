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

        <div class="entry-content owl-carousel owl-theme" style="text-align: center;">
			<?php 
				$args = array( 'post_type' => 'pessoa', 'showposts'=>4);
				$my_projetos = get_posts( $args );
				if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>
                   <div class="col-sm-12 col-md-12 col-lg-12" style="height: 450px;">
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
    </article>
    <!-- #post-## -->