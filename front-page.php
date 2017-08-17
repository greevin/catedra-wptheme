<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" role="main">

		<?php
        // pega todas as páginas de acordo com a ordem do menu
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'menu_order',
            'post_type' => 'page',
            'post_status' => 'publish'
        );
        $pages = get_pages($args);

        foreach ($pages as $page) {
            $content = $page->post_content;
            $content = apply_filters('the_content', $content);

            $image_url = wp_get_attachment_url(get_post_thumbnail_id($page)); ?>

		<div id="<?php echo $page->post_name; ?>" class="page-<?php echo $page->post_name; ?>">
			<section id="post-<?php echo $page->ID; ?>" class="hentry">

				<!-- Layout padrão de página -->
				<div class="entry-header">
					<h1 class="entry-title">
						<a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
						<!-- <?php if ($page->post_name == 'novidades') : ?> -->
						<!-- <a href="<?php echo get_page_link($page->ID); ?>" class="leia-mais-<?php echo $page->post_name; ?>"><span class="dashicons dashicons-arrow-right-alt"></span><?php _e('Ler todas', 'twentyfifteen-child') ?></a> -->
						<!-- <?php endif; ?> -->
					</h1>
					<?php if (! empty($image_url)) : ?>
						<img src="<?php echo $image_url; ?>">
					<?php endif; ?>
				</div>
				<!-- .entry-header -->

				<!-- Template para novidades, pessoas e projetos -->
				 <div class="entry-content">
					  <?php echo $content; ?> 
					<?php get_template_part('inicio', $page->post_name); ?>
				 </div>
				 <!-- .entry-content -->
			</section>
		</div>
		<?php
		wp_reset_postdata();
        } // fim do foreach
        ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer();
