<?php
/**
 * Template usado para mostrar as pessoas na página inicial (front-page.php)
 *
 */

use Carbon\Carbon;
?>
	<div class="entry-people row-equal" style="text-align: center;">
		<?php 
			$args = array( 'post_type' => 'wp_pessoa', 'showposts'=>-1);
			$my_projetos = get_posts( $args );
			if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );

			$periodo_fim = get_post_meta( $post->ID, '_periodo_fim_pessoa_input', true );
			$situacao = get_post_meta( $post->ID, '_situacao_input', true );

			if( $periodo_fim >= Carbon::now()->timestamp ) :
		?>
		<div class="col-sm-4 col-md-4 col-lg-4 fix-safari" style="padding-bottom: 15px;">
			<div class="circle-img fundo-gradiente">
				<a href="<?php the_permalink(); ?>">
					<span> 
					<?php 
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
				</a>
			</div>
			<h3 class="person-title">
				<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
				</a>
			</h3>
			<div class="person-content" style="padding: 0 10%;">
				<p>
					<?php echo _get_excerpt(20); ?>
				</p>
				<div class="more-link-container">
					<a href="<?php the_permalink(); ?>"><span class="dashicons dashicons-arrow-right-alt"></span> <?php _e( 'Leia Mais', 'twentyfifteen-child' ) ?></a>
				</div>
			</div>
		</div>
		<?php
			endif;
			endforeach;
			endif;
			wp_reset_postdata();
		?>
	</div>
	<!-- .entry-content -->