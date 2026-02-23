<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package NIKABETON
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nikabeton' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container header-container">
			<div class="site-branding">
				<?php if ( has_custom_logo() ) : ?>
					<div class="site-logo"><?php the_custom_logo(); ?></div>
				<?php else : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					$nikabeton_description = get_bloginfo( 'description', 'display' );
					if ( $nikabeton_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $nikabeton_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				<?php endif; ?>
			</div><!-- .site-branding -->

			
            <!-- Work schedule -->
            <div class="header-info-block">                
                <div>
                    <i class="dashicons dashicons-clock" style="color: #d84519ff; font-size: 20px; margin-right: 10px;"> </i><span class="info-value"><?php echo esc_html(get_theme_mod('nikabeton_schedule_1', 'Пн-Пт: 8:00-20:00')); ?></span><br>
					<i class="dashicons dashicons-clock" style="color: #d84519ff; font-size: 20px; margin-right: 10px;"> </i><span class="info-value"><?php echo esc_html(get_theme_mod('nikabeton_schedule_2', 'Сб-Нд: 9:00-18:00')); ?></span>
                </div>
            </div>

            <!-- Main Office Kyiv -->
            <div class="header-info-block">                
                <div>
                    <i class="dashicons dashicons-location" style="color: #d84519ff; font-size: 20px; margin-right: 10px;"> </i><span class="info-value"><?php echo esc_html(get_theme_mod('nikabeton_address_1', 'Київ')); ?></span><br>
                    <i class="dashicons dashicons-location" style="color: #d84519ff; font-size: 20px; margin-right: 10px;"> </i><span class="info-value"><?php echo esc_html(get_theme_mod('nikabeton_address_2', 'Вишгород')); ?></span>
                </div>
            </div>

            <div class="header-contacts">
                <?php $main_phone = get_theme_mod('nikabeton_phone_main', '+38(050)382-48-12'); ?>
                <!--<a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $main_phone)); ?>" class="header-phone">
                    <?php echo esc_html($main_phone); ?>
                </a>-->
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $main_phone)); ?>" class="btn btn-primary btn-sm open-modal-btn"><?php echo get_theme_mod('nikabeton_phone_main', '+38(050)382-48-12'); ?></a>
            </div>
			
		</div><!-- .container -->
		<nav style="border-top: 1px solid #cdcdcd;" id="site-navigation" class="main-navigation">
			<div style="margin: 0 auto;">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Меню', 'nikabeton' ); ?></button>
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
			?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

    <div id="content" class="site-content">

