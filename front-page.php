<?php
/**
 * Home — hero, verse strip, Em Destaque, Explore por Tema, Devocional do Dia,
 * Homens de Honra CTA.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$hero_image  = get_theme_mod( 'bdh_hero_image' );
$hero_style  = $hero_image ? sprintf( 'background-image:linear-gradient(rgba(31,36,33,.68),rgba(31,36,33,.92)),url(%s)', esc_url( $hero_image ) ) : '';

$featured = get_posts( array(
	'category__in'   => array_filter( array( bdh_devocionais_category_id(), bdh_ensinamentos_category_id() ) ),
	'posts_per_page' => 3,
) );

$daily = bdh_current_devocional();
?>

<main>

	<!-- HERO -->
	<section class="bdh-hero" <?php echo $hero_style ? 'style="' . esc_attr( $hero_style ) . '"' : ''; ?>>
		<div class="bdh-hero__rule"></div>
		<div class="bdh-hero__watermark"><?php echo bdh_icon_svg( 320, '#F4EFE6' ); ?></div>
		<div class="bdh-hero__verseref">Hb 6:19</div>
		<p class="bdh-hero__kicker">Devocionais · Ensinamentos · Reflexões</p>
		<h1>BÍBLIA<br>DE HOMEM.</h1>
		<p>Para o homem que quer crescer como marido, pai, filho e sacerdote mas nunca teve um guia.</p>
		<div class="bdh-hero__actions">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-cream">COMECE AQUI <span>→</span></a>
			<a href="<?php echo esc_url( bdh_devocionais_url() ); ?>" class="bdh-hero__secondary">ver posts</a>
		</div>
	</section>

	<!-- VERSE STRIP -->
	<div class="bdh-verse">
		<div class="bdh-verse__bar"></div>
		<div>
			<div class="bdh-verse__text">&ldquo;...a esperança nos é como âncora da alma, segura e firme...&rdquo;</div>
			<div class="bdh-verse__ref">Hebreus 6:19</div>
		</div>
	</div>

	<?php if ( $featured ) : ?>
	<!-- EM DESTAQUE -->
	<section class="section-cream">
		<div class="section-head">
			<span class="eyebrow">Em Destaque</span>
			<a href="<?php echo esc_url( bdh_devocionais_url() ); ?>" class="link-leather">ver todos →</a>
		</div>
		<div class="hscroll no-scrollbar">
			<?php foreach ( $featured as $post ) :
				$is_dev = bdh_is_devocional( $post->ID );
				$badge  = $is_dev ? 'Dia ' . get_post_meta( $post->ID, '_bdh_dia', true ) : wp_strip_all_tags( get_the_term_list( $post->ID, 'papel', '', ', ' ) );
				$cat    = $is_dev ? 'Devocionais' : 'Ensinamentos';
			?>
			<a href="<?php echo esc_url( get_permalink( $post ) ); ?>" class="card-feat">
				<div class="card-feat__cover <?php echo has_post_thumbnail( $post ) ? 'cover-img' : esc_attr( bdh_cover_class( $post->ID ) ); ?>"
					<?php if ( has_post_thumbnail( $post ) ) : ?>style="background-image:url(<?php echo esc_url( get_the_post_thumbnail_url( $post, 'bdh-card' ) ); ?>)"<?php endif; ?>>
					<?php if ( $badge ) : ?><div class="card-feat__tag"><span><?php echo esc_html( $badge ); ?></span></div><?php endif; ?>
				</div>
				<div class="card-feat__body">
					<div class="card-feat__cat"><?php echo esc_html( $cat ); ?></div>
					<div class="card-feat__title"><?php echo esc_html( get_the_title( $post ) ); ?></div>
					<div class="card-feat__meta"><?php echo esc_html( bdh_reading_time( $post->ID ) ); ?> min · <?php echo esc_html( bdh_format_date_pt( get_the_date( 'U', $post ) ) ); ?></div>
				</div>
			</a>
			<?php endforeach; ?>
		</div>
	</section>
	<?php endif; ?>

	<!-- EXPLORE POR TEMA -->
	<section class="section-white">
		<span class="eyebrow" style="display:block;margin-bottom:18px">Explore por Tema</span>
		<div class="theme-grid">
			<div class="theme-tile">
				<div class="theme-tile__num">01</div>
				<div class="theme-tile__title">Comece<br>Aqui</div>
				<div class="theme-tile__desc">Como o site funciona</div>
			</div>
			<a href="<?php echo esc_url( bdh_devocionais_url() ); ?>" class="theme-tile">
				<div class="theme-tile__num">02</div>
				<div class="theme-tile__title">Devo-<br>cionais</div>
				<div class="theme-tile__desc">365 reflexões diárias</div>
			</a>
			<a href="<?php echo esc_url( bdh_ensinamentos_url() ); ?>" class="theme-tile theme-tile--wide">
				<div class="bdh-watermark"><?php echo bdh_icon_svg( 110, '#F4EFE6' ); ?></div>
				<div class="theme-tile__num">03</div>
				<div class="theme-tile__title">Ensinamentos</div>
				<div class="theme-tile__sub">Marido · Pai · Filho · Sacerdote</div>
				<div class="theme-tile__cta">EXPLORAR →</div>
			</a>
		</div>
	</section>

	<?php if ( $daily ) :
		$day = get_post_meta( $daily->ID, '_bdh_dia', true );
	?>
	<!-- DEVOCIONAL DO DIA -->
	<section class="section-cream">
		<div class="section-head">
			<span class="eyebrow">Devocional do Dia</span>
			<div class="daily-card__badge"><span>Dia <?php echo esc_html( $day ); ?></span></div>
		</div>
		<a href="<?php echo esc_url( get_permalink( $daily ) ); ?>" class="daily-card">
			<div class="daily-card__title"><?php echo esc_html( get_the_title( $daily ) ); ?></div>
			<div class="daily-card__excerpt"><?php echo esc_html( wp_trim_words( $daily->post_content, 28 ) ); ?></div>
			<span class="daily-card__link">LER COMPLETO →</span>
		</a>
	</section>
	<?php endif; ?>

	<!-- HOMENS DE HONRA CTA -->
	<section class="bdh-cta-dark">
		<div class="bdh-watermark"><?php echo bdh_icon_svg( 280, '#F4EFE6' ); ?></div>
		<div class="bdh-cta-dark__kicker">Comunidade</div>
		<h2>HOMENS<br>DE HONRA</h2>
		<p>Homens comprometidos com Deus, com a família e com o crescimento mútuo.</p>
		<button type="button" class="btn-cream">QUERO FAZER PARTE →</button>
	</section>

</main>

<?php get_footer(); ?>
