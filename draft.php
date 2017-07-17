<?php /* Template Name: Página Inicial */ ?>

<?php get_header(); ?>

<!-- Sobre -->
<div class="about">
    <?php 
				$args = array('post_type'=>'page', 'pagename'=>'sobre');
				$my_sobre = get_posts( $args );
				if($my_sobre) : foreach($my_sobre as $post) : setup_postdata( $post );?>

                <?php get_template_part( 'content', get_post_format() ); ?>
			 <?php
		    	endforeach;
		    	endif;
	?>
</div>

<!-- Projetos -->
<div class="projects" style="background: lightblue; margin:40px 0 40px 0">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <h1 class="entry-title">Projetos</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
				$args = array('post_type'=>'post', 'showposts'=>3, 'category__in'=>4);
				$my_projetos = get_posts( $args );
				if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>
<div class="col-md-12 col-lg-12">
                    <?php get_template_part( 'content', get_post_format() ); ?>
			 <?php
		    	endforeach;
		    	endif;
?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
</div>

<!-- Pessoas -->
<div class="people" style="background: lightgreen; margin:40px 0 40px 0">
    
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
        <h1 class="entry-title">Pessoas</h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php 
				$args = array('post_type'=>'post', 'showposts'=>3, 'category__in'=>3);
				$my_projetos = get_posts( $args );
				if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>
<div class="col-md-12 col-lg-12">
                    <?php get_template_part( 'content', get_post_format() ); ?>
			 <?php
		    	endforeach;
		    	endif;
?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
</div>

<!-- Blog -->
<div class="blog" style="background: yellow">
    <h1>Blog</h1>
    <?php 
				$args = array('post_type'=>'post', 'showposts'=>3);
				$my_projetos = get_posts( $args );
				if($my_projetos) : foreach($my_projetos as $post) : setup_postdata( $post );?>
				
				<div class="col-md-12 col-lg-12">
					<h2><?php the_title(); ?></h2>
				</div>

				<div class="col-md-6 col-lg-6">
					<?php the_content(); ?>
				</div>
				
				<div class="col-md-6 col-lg-6">
					<?php the_post_thumbnail(true, array('class'=>'img-responsive')); ?>
				</div>

			 <?php
		    	endforeach;
		    	endif;
?>
</div>

<?php get_footer(); ?>

-------------------

<div class="col-sm-12 col-md-12 col-lg-12" style="border:1px solid;margin-bottom: 20px;">
						 <div class="col-sm-4 col-md-4 col-lg-4">
						  <a href="#">
							<!-- <?php the_post_thumbnail(false, array('class'=>'img-responsive responsive--full')); ?> -->
						 </a> 
					   </div>
					    <div class="col-sm-8 col-md-8 col-lg-8">
								<h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<div class="content"><?php the_excerpt(); ?></div>
							</div> 