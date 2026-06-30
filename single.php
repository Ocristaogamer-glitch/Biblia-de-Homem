<?php
/**
 * Single post — Devocionais and Ensinamentos share this template; the
 * devotional day badge and the "Como Fazer" reflection box only render
 * for posts that have a devotional day number set.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$post_id    = get_the_ID();
	$is_dev     = bdh_is_devocional( $post_id );
	$dia        = $is_dev ? get_post_meta( $post_id, '_bdh_dia', true ) : '';
	$cover      = has_post_thumbnail() ? 'cover-img' : bdh_cover_class( $post_id );
	$cover_style = has_post_thumbnail() ? 'style="background-image:url(' . esc_url( get_the_post_thumbnail_url( $post_id, 'bdh-cover' ) ) . ')"' : '';
	$back_url   = $is_dev ? bdh_devocionais_url() : bdh_ensinamentos_url();
	$back_label = $is_dev ? 'Devocionais' : 'Ensinamentos';
	$cat_label  = $is_dev ? 'Devocionais' : wp_strip_all_tags( get_the_term_list( $post_id, 'papel', '', ', ' ) );
	$youtube    = bdh_youtube_embed_url( get_post_meta( $post_id, '_bdh_youtube', true ) );
	$author_id  = get_the_author_meta( 'ID' );
	$author     = get_the_author();
	?>

	<main>

		<!-- COVER -->
		<div class="post-cover <?php echo esc_attr( $cover ); ?>" <?php echo $cover_style; ?>>
			<div class="post-cover__fade"></div>
			<div class="post-cover__bar">
				<a href="<?php echo esc_url( $back_url ); ?>" class="post-cover__back">← <?php echo esc_html( $back_label ); ?></a>
				<button type="button" class="post-cover__share" data-bdh-share data-title="<?php the_title_attribute(); ?>">COMPARTILHAR</button>
			</div>
			<?php if ( $is_dev ) : ?>
			<div class="post-cover__badge">
				<span class="num"><?php echo esc_html( $dia ); ?></span>
				<span class="sep"></span>
				<span class="of">de <?php echo esc_html( BDH_TOTAL_DIAS ); ?></span>
			</div>
			<?php endif; ?>
		</div>

		<!-- ARTICLE HEADER -->
		<div class="article-header">
			<?php if ( $cat_label ) : ?>
			<div class="article-header__cat"><span><?php echo esc_html( $cat_label ); ?></span></div>
			<?php endif; ?>
			<h1><?php the_title(); ?></h1>
			<div class="article-header__byline">
				<div class="article-header__avatar"><span><?php echo esc_html( mb_substr( $author, 0, 1 ) ); ?></span></div>
				<div>
					<div class="article-header__name"><?php echo esc_html( $author ); ?></div>
					<div class="article-header__date"><?php echo esc_html( bdh_format_date_pt( get_the_date( 'U' ), true ) ); ?> · <?php echo esc_html( bdh_reading_time( $post_id ) ); ?> min de leitura</div>
				</div>
			</div>
		</div>

		<!-- ARTICLE BODY -->
		<div class="article-body">
			<?php the_content(); ?>
		</div>

		<?php if ( $youtube ) : ?>
		<!-- YOUTUBE EMBED -->
		<div class="video-block">
			<div class="video-block__label">Assista também</div>
			<div class="video-embed">
				<iframe src="<?php echo esc_url( $youtube ); ?>" title="<?php the_title_attribute(); ?>" loading="lazy" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>
		<?php endif; ?>

		<?php if ( $is_dev ) :
			$q1 = get_post_meta( $post_id, '_bdh_pergunta_1', true ) ?: 'O que Deus disse para mim hoje através desse devocional?';
			$q2 = get_post_meta( $post_id, '_bdh_pergunta_2', true ) ?: 'Como isso muda a forma como estou lidando com minha família hoje?';
			$q3 = get_post_meta( $post_id, '_bdh_pergunta_3', true ) ?: 'Qual é a UMA ação concreta que vou tomar hoje por causa disso?';
		?>
		<!-- COMO FAZER BOX -->
		<div class="cf-block">
			<div class="cf-block__inner">
				<div class="cf-prompt">
					<div class="cf-prompt__label">Faça o seu devocional</div>
					<div class="cf-prompt__desc">Leu esse devocional? Agora escreva o seu. Use esse post como base para a sua reflexão pessoal.</div>
					<button type="button" class="cf-toggle" id="bdh-cf-toggle" aria-controls="bdh-cf-panel" aria-expanded="false">
						<span class="label">COMO FAZER</span>
						<span class="arrow">→</span>
					</button>
				</div>
				<div class="cf-panel" id="bdh-cf-panel">
					<div class="cf-panel__intro">Separe 10–15 minutos. Abra um caderno ou bloco de notas. Releia o devocional de hoje e responda as três perguntas abaixo com honestidade:</div>
					<div class="cf-question"><div class="cf-question__num"><span>1</span></div><div class="cf-question__text"><?php echo esc_html( $q1 ); ?></div></div>
					<div class="cf-question"><div class="cf-question__num"><span>2</span></div><div class="cf-question__text"><?php echo esc_html( $q2 ); ?></div></div>
					<div class="cf-question"><div class="cf-question__num"><span>3</span></div><div class="cf-question__text"><?php echo esc_html( $q3 ); ?></div></div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php
		$related_args = array(
			'posts_per_page' => 4,
			'post__not_in'   => array( $post_id ),
			'orderby'        => 'rand',
		);
		if ( $is_dev ) {
			$related_args['category'] = bdh_devocionais_category_id();
		} else {
			$related_args['category'] = bdh_ensinamentos_category_id();
		}
		$related = get_posts( $related_args );
		?>
		<?php if ( $related ) : ?>
		<!-- RELATED -->
		<div class="related-block">
			<div class="related-block__label">Leia Também</div>
			<div class="related-grid">
				<?php foreach ( $related as $r ) :
					$r_cover = has_post_thumbnail( $r ) ? 'cover-img' : bdh_cover_class( $r->ID );
					$r_style = has_post_thumbnail( $r ) ? 'style="background-image:url(' . esc_url( get_the_post_thumbnail_url( $r, 'bdh-card' ) ) . ')"' : '';
				?>
				<a href="<?php echo esc_url( get_permalink( $r ) ); ?>" class="related-card">
					<div class="related-card__cover <?php echo esc_attr( $r_cover ); ?>" <?php echo $r_style; ?>></div>
					<div class="related-card__body">
						<div class="related-card__title"><?php echo esc_html( get_the_title( $r ) ); ?></div>
						<div class="related-card__meta"><?php echo esc_html( bdh_reading_time( $r->ID ) ); ?> min</div>
					</div>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endif; ?>

	</main>

<?php
endwhile;

get_footer();
