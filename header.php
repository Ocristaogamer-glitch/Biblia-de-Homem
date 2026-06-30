<?php
/**
 * Shared <head>, sticky nav and mobile menu overlay.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="bdh-nav">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bdh-nav__brand">
		<?php echo bdh_icon_svg( 28, '#F4EFE6' ); ?>
		<span class="bdh-nav__wordmark">BÍBLIA DE HOMEM</span>
	</a>

	<nav class="bdh-nav__links" aria-label="<?php esc_attr_e( 'Navegação principal', 'bdh' ); ?>">
		<a href="<?php echo esc_url( bdh_devocionais_url() ); ?>" class="bdh-nav__link">Devocionais</a>
		<a href="<?php echo esc_url( bdh_ensinamentos_url() ); ?>" class="bdh-nav__link">Ensinamentos</a>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bdh-nav__cta">COMECE AQUI</a>
	</nav>

	<button type="button" class="bdh-nav__burger" id="bdh-menu-open" aria-controls="bdh-mobile-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Abrir menu', 'bdh' ); ?>">
		<span></span><span></span><span></span>
	</button>
</header>

<div class="bdh-menu" id="bdh-mobile-menu">
	<button type="button" class="bdh-menu__close" id="bdh-menu-close" aria-label="<?php esc_attr_e( 'Fechar menu', 'bdh' ); ?>">✕</button>
	<div class="bdh-menu__icon"><?php echo bdh_icon_svg( 36, 'rgba(244,239,230,.25)' ); ?></div>
	<nav class="bdh-menu__links" aria-label="<?php esc_attr_e( 'Menu mobile', 'bdh' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bdh-menu__link">Início</a>
		<a href="<?php echo esc_url( bdh_devocionais_url() ); ?>" class="bdh-menu__link">Devocionais</a>
		<a href="<?php echo esc_url( bdh_ensinamentos_url() ); ?>" class="bdh-menu__link">Ensinamentos</a>
	</nav>
	<div class="bdh-menu__footer">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-cream">COMECE AQUI →</a>
	</div>
</div>
