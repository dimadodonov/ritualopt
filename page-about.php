<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ritualopt
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="main">
			<div class="page__wrap page-blog">
                <div class="container">
                    <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb( '<div class="breadcrumbs">','</div>' );
                        }
						
                        while ( have_posts() ) :
                            the_post(); 

							$the_title = get_the_title();
							$the_content = get_the_content();
							
							if($the_title) : ?>
								<div class="page__title"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></div>
							<?php endif;
							
							if($the_content) : ?>
								<div class="page__content"><?php the_content(); ?></div>
							<?php endif;
						endwhile; // End of the loop.
                    ?>
                </div>
			</div>
            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();