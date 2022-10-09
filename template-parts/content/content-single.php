<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Ritualopt
 */

?>

<article id="post-<?php the_ID(); ?>" class="articles-item">
		<div class="articles-item__wrap">
			<div class="articles-item__images">
				<?php if ( has_post_thumbnail()) { ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<?php the_post_thumbnail('medium'); ?>
					</a>
				<?php } ?>
			</div>
			<div class="articles-item__desc">
				<?php
					if( has_term( 'sale', 'category', $post_id ) ) {
						$post_term = 'Акция!';
						$post_term_class = 'sale';
					} 
					elseif(has_term( 'news', 'category', $post_id )) {
						$post_term = 'Новинка!';
						$post_term_class = 'new';
					} else {
						$post_term = 'Статья';
					}
				?>
				<div class="articles-item__term <?php if($post_term_class) : echo $post_term_class; endif; ?>">
					<?php if($post_term) : echo $post_term; endif; ?>
				</div>
				<div class="articles-item__title">
					<ins><?php if($post_term) : echo $post_term; endif; ?></ins> <?php echo get_the_title(); ?>
				</div>

				<a href="<?php the_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="articles-item__btn">
					<div class="btn btn-articles">Подробнее...</div>
				</a>
			</div>
		</div>
</article><!-- #post-<?php the_ID(); ?> -->