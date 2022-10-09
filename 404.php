<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package ЕВРО-РС
 */

get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="main">
			<div class="page__wrap container">

				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
					}
				?>

				<h1 class="page-title"><?php _e( 'Страница не найдена', 'twentythirteen' ); ?></h1>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>