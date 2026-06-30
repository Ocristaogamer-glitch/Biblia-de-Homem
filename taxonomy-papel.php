<?php
/**
 * Archive for the "papel" taxonomy — Marido today, and Pai/Filho/Sacerdote
 * automatically the moment posts get tagged with those terms (same template,
 * no extra code needed per role).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$term = get_queried_object();

if ( $term->parent ) {
	$parent  = get_term( $term->parent, 'papel' );
	$current = $term;
} else {
	$parent  = $term;
	$current = null;
}

$children = get_terms( array(
	'taxonomy'   => 'papel',
	'parent'     => $parent->term_id,
	'hide_empty' => false,
) );

$descriptions = array(
	'marido'    => 'Amar, liderar e servir sua esposa de forma bíblica — no dia a dia real do casamento.',
	'pai'       => 'Educar, estar presente e disciplinar com amor — formando o caráter dos seus filhos.',
	'filho'     => 'Honrar pai e mãe, mesmo adulto — gratidão como base de uma vida plena.',
	'sacerdote' => 'Liderar espiritualmente sua casa: culto, intercessão e exemplo diário de fé.',
);
$description = term_description( $parent->term_id, 'papel' );
if ( ! $description ) {
	$description = isset( $descriptions[ $parent->slug ] ) ? $descriptions[ $parent->slug ] : '';
}

$tax_query = array(
	array(
		'taxonomy' => 'papel',
		'field'    => 'term_id',
		'terms'    => $current ? $current->term_id : $parent->term_id,
	),
);

$query = new WP_Query( array(
	'posts_per_page' => 12,
	'tax_query'      => $tax_query,
) );
?>

<main>

	<!-- HEADER -->
	<section class="bdh-hdr">
		<div class="bdh-hdr__bigletter"><?php echo esc_html( mb_substr( $parent->name, 0, 1 ) ); ?></div>
		<a href="<?php echo esc_url( bdh_ensinamentos_url() ); ?>" class="bdh-hdr__back">← Ensinamentos</a>
		<div class="bdh-hdr__tag"><span class="dot"></span><span>Ensinamentos</span></div>
		<h1><?php echo esc_html( mb_strtoupper( $parent->name ) ); ?></h1>
		<?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
	</section>

	<?php if ( $children ) : ?>
	<!-- SUBCATEGORY CHIPS -->
	<nav class="chip-row" aria-label="<?php esc_attr_e( 'Subcategorias', 'bdh' ); ?>">
		<div class="chip-scroll no-scrollbar">
			<a href="<?php echo esc_url( get_term_link( $parent ) ); ?>" class="chip<?php echo ! $current ? ' is-active' : ''; ?>">Todos</a>
			<?php foreach ( $children as $child ) : ?>
				<a href="<?php echo esc_url( get_term_link( $child ) ); ?>" class="chip<?php echo ( $current && $current->term_id === $child->term_id ) ? ' is-active' : ''; ?>"><?php echo esc_html( $child->name ); ?></a>
			<?php endforeach; ?>
		</div>
	</nav>
	<?php endif; ?>

	<!-- POST LIST -->
	<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
		$post_id     = get_the_ID();
		$post_terms  = get_the_terms( $post_id, 'papel' );
		$sub_name    = '';
		if ( $post_terms ) {
			foreach ( $post_terms as $t ) {
				if ( $t->parent ) {
					$sub_name = $t->name;
					break;
				}
			}
		}
		$cover = has_post_thumbnail() ? 'cover-img' : bdh_cover_class( $post_id );
		$style = has_post_thumbnail() ? 'style="background-image:url(' . esc_url( get_the_post_thumbnail_url( $post_id, 'bdh-card' ) ) . ')"' : '';
	?>
	<a href="<?php the_permalink(); ?>" class="papel-post">
		<div class="papel-post__row">
			<div style="flex:1">
				<div class="papel-post__meta">
					<span class="papel-post__date"><?php echo esc_html( bdh_format_date_pt( get_the_date( 'U' ) ) ); ?> · <?php echo esc_html( bdh_reading_time( $post_id ) ); ?> min</span>
					<?php if ( $sub_name ) : ?><span class="papel-post__dot"></span><div class="papel-post__tag"><span><?php echo esc_html( $sub_name ); ?></span></div><?php endif; ?>
				</div>
				<div class="papel-post__title"><?php the_title(); ?></div>
				<div class="papel-post__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 16 ) ); ?></div>
			</div>
			<div class="papel-post__cover <?php echo esc_attr( $cover ); ?>" <?php echo $style; ?>></div>
		</div>
	</a>
	<?php endwhile; else : ?>
		<div class="section-white">
			<p><?php esc_html_e( 'Nenhum post nessa categoria ainda.', 'bdh' ); ?></p>
		</div>
	<?php endif; wp_reset_postdata(); ?>

</main>

<?php get_footer(); ?>
