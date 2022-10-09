<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Ritualopt
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="main">
			<div class="page__wrap container">

				<?php
					if ( function_exists('yoast_breadcrumb') ) {
						yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
					}
				?>

				<div class="page__content">
					<?php
						while ( have_posts() ) :
							the_post();

							get_template_part( 'template-parts/content/content', 'page' );

						endwhile; // End of the loop.
					?>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

	
	<?php
	/**
	* Functions hooked in to Single Page action
	*
	* @hooked hook_related_post                       - 10
	*/
	do_action( 'hook_single' ); ?>

<?php
get_footer();
