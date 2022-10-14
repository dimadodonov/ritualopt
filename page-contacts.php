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
			<div class="page__wrap page-contacts">
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
								<div class="page__title hidden"><?php the_title( '<h1 class="entry-title">', '</h1>' ); ?></div>
							<?php endif;
							
							if($the_content) : ?>
								<div class="page__content"><?php the_content(); ?></div>
							<?php endif;
						endwhile; // End of the loop.
                    ?>
					<div class="page-contacts__wrap">
						<div class="page-contacts__col">
							<div class="page-contacts__info">
								<h2>Как мы можем вам помочь?</h2>
								<span>Мы можем проконсультировать вас по телефону или в мессенджерах</span>
							</div>
							<div class="page-contacts__inner">
								<div class="social">
									<a class="social__item whatsapp" href="" target="_blank">
										<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--social-whatsapp"></use></svg>
									</a>
									<a class="social__item telegram" href="" target="_blank">
										<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--social-telegram"></use></svg>
									</a>
									<a class="social__item viber" href="" target="_blank">
										<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--social-viber"></use></svg>
									</a>
								</div>
								<div class="page-contacts__phone">
									<a href="tel:+79260400495">
										<span>Телефон</span>
										<strong>+7 (926) 040-04-95</strong>
									</a>
									<a href="mailto:r-vitrina@mail.ru">
										<span>Email</span>
										<strong>r-vitrina@mail.ru</strong>
									</a>
								</div>
							</div>
							<div class="page-contacts__info">
								<strong>121500 г. Москва, ул. Василия Ботылева, д. 20.</strong>
								<span>Пн-Пт, с 09:00 до 17:00</span>
							</div>
						</div>
						<div class="page-contacts__col page-contacts__map">
							<div id="yamap" class="map"></div>
						</div>
					</div>
                </div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();