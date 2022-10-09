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
        
    // $social = get_field('social', 'option');
    // $social_facebook = $social['facebook'];
    $social_vk = get_field('vk', 'option');
	$social_instagram = get_field('instagram', 'option');
    $social_whatsapp = get_field('whatsapp', 'option');
    $social_telegram = get_field('telegram', 'option');
    $social_viber = get_field('viber', 'option');
	
	$street_manufacture = get_field('street_manufacture', 'option');
	$street_office = get_field('street_office', 'option');
	$time_office = get_field('time_office', 'option');
	$street_shop = get_field('street_shop', 'option');
	$time_shop = get_field('time_shop', 'option');

    $contact_city = 'Москва';
    $contact_adress = $street_office;
    $contact_phone = get_field('phone', 'option');
    $contact_mobile = get_field('mobile', 'option');
    $contact_email = get_field('email', 'option');
    $contact_worktime = $time_office;
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
                </div>
			</div>
            
            <div class="contacts">
                <div class="container">

					<div class="contacts-btn">
						<div class="contacts-btn__wrap">
							<div class="contacts-btn__item">
								<div class="social">
									<?php if($social_vk) : ?>
										<a class="social__item vk" href="<?php echo $social_vk; ?>" target="_blank">
											<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--social-vk"/></svg>
										</a>
									<?php endif; ?>
									<?php if($social_whatsapp) : ?>
										<a class="social__item whatsapp" href="<?php echo $social_whatsapp; ?>" target="_blank">
											<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--social-whatsapp"/></svg>
										</a>
									<?php endif; ?>
									<?php if($social_instagram) : ?>
										<a class="social__item instagram" href="<?php echo $social_instagram; ?>" target="_blank">
											<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--social-instagram"/></svg>
										</a>
									<?php endif; ?>
								</div>
							</div>
							<div class="contacts-btn__item">
								<div class="contacts__link">
									<a href="tel:<?php echo $contact_mobile; ?>"><?php echo $contact_mobile; ?></a>
									<a href="tel:<?php echo $contact_phone; ?>"><?php echo $contact_phone; ?></a>
									<a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
								</div>
							</div>
						</div>
					</div>

					<div class="contacts__title">
						Адреса магазинов и точек продаж
					</div>

					<div class="contacts__row">
						<?php if($street_manufacture) : ?>
							<div class="contacts-item">
								<strong>Производство</strong>
								<?php 
								?>
								<span><?php echo $street_manufacture; ?></span>
							</div>
						<?php endif; ?>
						<?php if($street_office) : ?>
							<div class="contacts-item">
								<strong>Офис</strong>
								<span><?php echo $street_office; ?></span>
								<small><?php echo $time_office; ?></small>
							</div>
						<?php if($street_shop) : ?>
						<?php endif; ?>
							<div class="contacts-item">
								<strong>Магазин</strong>
								<span><?php echo $street_shop; ?></span>
								<small><?php echo $time_shop; ?></small>
							</div>
						<?php endif; ?>
					</div>

					<div class="contacts-map">
						<div id="yamap" class="map" data-city="<?php echo $contact_city; ?>" data-adres="<?php echo $contact_adress; ?>" data-phone="<?php echo $contact_phone; ?>" data-email="<?php echo $contact_email; ?>"></div>
					</div>
                </div>
            </div>

            
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();