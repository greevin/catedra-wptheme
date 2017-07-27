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

		foreach ( $pages as $page ) {
			$content = $page->post_content;
			$content = apply_filters( 'the_content', $content );
		?>
			
		<div id="<?php echo $page->post_name; ?>" class="page-<?php echo $page->post_name; ?>">
			<section id="post-<?php echo $page->ID; ?>" <?php post_class(); ?>>

				<!-- Layout padrão de página -->
				<div class="entry-header">
					<h1 class="entry-title">
						<a href="<?php echo get_page_link( $page->ID ); ?>"><?php echo $page->post_title; ?></a>
					</h1>
					<?php echo $content; ?>
				</div>
				<!-- .entry-header -->

				<!-- Template para novidades, pessoas e projetos -->
				 <div class="entry-content"> 
					<?php get_template_part( 'inicio', $page->post_name ); ?>	
				 </div> 
				 <!-- .entry-content -->
			</section>
		</div>
		<?php
		} // fim do foreach
		?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer();
