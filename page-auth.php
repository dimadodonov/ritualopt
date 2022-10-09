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
 * @package mitroliti
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="main">
			<?php
				if ( function_exists('yoast_breadcrumb') ) {
					yoast_breadcrumb( '<div class="container"><div class="breadcrumbs">','</div></div>' );
				}
			?>
			<div class="container">
                <div class="page-content">
                    <?php
                        while ( have_posts() ) :
                            the_post();

                            ?>
                            <article id="page_<?php the_ID(); ?>" class="page-article page-<?php the_ID(); ?>">

                                <?php
                                    if(is_page('auth')) : 
                                        if ( is_user_logged_in() ) : the_title( '<h1 class="entry-title">', '</h1>' );  endif;
                                    endif;
                                ?>

                                <?php the_content(); ?>

                            </article><!-- #page-<?php the_ID(); ?> -->
                            
                            <?php
                        endwhile; // End of the loop.
                    ?>
                </div><!-- .page-content -->
			</div><!-- .container -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();