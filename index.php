<?php
/**
 * Fallback template (search results, default category/tag archives, etc).
 * The 5 designed views live in front-page.php, single.php, taxonomy-papel.php
 * and the page-templates/ — this only covers anything outside that scope.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main>
	<section class="bdh-hdr">
		<h1><?php echo is_search() ? esc_html__( 'BUSCA', 'bdh' ) : esc_html__( 'POSTS', 'bdh' ); ?></h1>
		<?php if ( is_search() ) : ?>
			<p><?php printf( esc_html__( 'Resultados para "%s"', 'bdh' ), esc_html( get_search_query() ) ); ?></p>
		<?php endif; ?>
	</section>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
		$post_id = get_the_ID();
		$cover   = has_post_thumbnail() ? 'cover-img' : bdh_cover_class( $post_id );
		$style   = has_post_thumbnail() ? 'style="background-image:url(' . esc_url( get_the_post_thumbnail_url( $post_id, 'bdh-card' ) ) . ')"' : '';
	?>
	<a href="<?php the_permalink(); ?>" class="papel-post">
		<div class="papel-post__row">
			<div style="flex:1">
				<div class="papel-post__meta">
					<span class="papel-post__date"><?php echo esc_html( bdh_format_date_pt( get_the_date( 'U' ) ) ); ?> · <?php echo esc_html( bdh_reading_time( $post_id ) ); ?> min</span>
				</div>
				<div class="papel-post__title"><?php the_title(); ?></div>
				<div class="papel-post__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></div>
			</div>
			<div class="papel-post__cover <?php echo esc_attr( $cover ); ?>" <?php echo $style; ?>></div>
		</div>
	</a>
	<?php endwhile; ?>
		<div class="loadmore-block"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<div class="section-white"><p><?php esc_html_e( 'Nada por aqui ainda.', 'bdh' ); ?></p></div>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
