<?php
/**
 * Shared footer, social icons and the mobile bottom tab bar.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$bdh_active = bdh_active_tab();
?>

<footer class="bdh-footer">
	<div class="bdh-footer__icon"><?php echo bdh_icon_svg( 36, 'rgba(244,239,230,.28)' ); ?></div>
	<div class="bdh-footer__wordmark">BÍBLIA DE HOMEM</div>

	<nav class="bdh-footer__links" aria-label="<?php esc_attr_e( 'Links do rodapé', 'bdh' ); ?>">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a>
		<a href="<?php echo esc_url( bdh_devocionais_url() ); ?>">Devocionais</a>
		<a href="<?php echo esc_url( bdh_ensinamentos_url() ); ?>">Ensinamentos</a>
	</nav>

	<div class="bdh-footer__social">
		<a href="<?php echo esc_url( get_theme_mod( 'bdh_linkedin_url', '#' ) ); ?>" aria-label="LinkedIn">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="rgba(244,239,230,.5)" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"></path></svg>
		</a>
		<a href="<?php echo esc_url( get_theme_mod( 'bdh_youtube_url', '#' ) ); ?>" aria-label="YouTube">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="17" height="17" fill="rgba(244,239,230,.5)" aria-hidden="true"><path d="M23.495 6.205a3.007 3.007 0 00-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 00.527 6.205a31.247 31.247 0 00-.522 5.805 31.247 31.247 0 00.522 5.783 3.007 3.007 0 002.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 002.088-2.088 31.247 31.247 0 00.5-5.783 31.247 31.247 0 00-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"></path></svg>
		</a>
		<a href="<?php echo esc_url( get_theme_mod( 'bdh_instagram_url', '#' ) ); ?>" aria-label="Instagram">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16" fill="rgba(244,239,230,.5)" aria-hidden="true"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
		</a>
	</div>

	<div class="bdh-footer__copy">&copy; <?php echo esc_html( date( 'Y' ) ); ?> Bíblia de Homem</div>
</footer>

<nav class="bdh-tabs" aria-label="<?php esc_attr_e( 'Navegação rápida mobile', 'bdh' ); ?>">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bdh-tab<?php echo 'home' === $bdh_active ? ' is-active' : ''; ?>">
		<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
			<polyline points="9 22 9 12 15 12 15 22"></polyline>
		</svg>
		<span>INÍCIO</span>
	</a>
	<a href="<?php echo esc_url( bdh_devocionais_url() ); ?>" class="bdh-tab<?php echo 'devocionais' === $bdh_active ? ' is-active' : ''; ?>">
		<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
			<line x1="16" y1="2" x2="16" y2="6"></line>
			<line x1="8" y1="2" x2="8" y2="6"></line>
			<line x1="3" y1="10" x2="21" y2="10"></line>
		</svg>
		<span>365 DIAS</span>
	</a>
	<a href="<?php echo esc_url( bdh_ensinamentos_url() ); ?>" class="bdh-tab<?php echo 'ensinamentos' === $bdh_active ? ' is-active' : ''; ?>">
		<svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
			<path d="M4 19.5A2.5 2.5 0 016.5 17H20"></path>
			<path d="M6.5 2H20v20H6.5A2.5 2.5 0 014 19.5v-15A2.5 2.5 0 016.5 2z"></path>
		</svg>
		<span>ENSINAR</span>
	</a>
</nav>

<?php wp_footer(); ?>
</body>
</html>
