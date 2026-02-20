<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package NIKABETON
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="container footer-container">
            <div class="footer-widget-area">
                <div class="footer-branding">
                    <?php if ( has_custom_logo() ) : ?>
					    <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php else: ?>
                        <h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">Ніка Бетон</a></h2>
                    <?php endif; ?>
                    <p>Ніка Бетон — виробник та постачальник бетону, будівельних розчинів та ЗБВ. Надаємо послуги з оренди бетононасосів та спецтехніки. Якість, швидка доставка та професійний сервіс.</p>
                </div>
                
                <div class="footer-contacts">
                    <h3>Офіси Ніка Бетон</h3>
                    <div class="office">
                        <strong>Ніка Бетон у Вишгороді:</strong><br>
                        Вул. Набережна, 7Є, Вишгород
                    </div>
                    <div class="office mt-2">
                        <strong>Ніка Бетон в Києві:</strong><br>
                        Вул. Йорданська, 18, Київ
                    </div>
                    <div class="contact-methods mt-3">
                        <?php 
                        $email = get_theme_mod('nikabeton_email', 'hello@nikabeton.com');
                        $phone = get_theme_mod('nikabeton_phone_main', '+38(050)382-48-12'); 
                        $phone_clean = preg_replace('/[^0-9+]/', '', $phone);
                        $viber = get_theme_mod('nikabeton_social_viber', '#');
                        $telegram = get_theme_mod('nikabeton_social_telegram', '#');
                        $whatsapp = get_theme_mod('nikabeton_social_whatsapp', '#');
                        ?>
                        <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a><br>
                        <a href="tel:<?php echo esc_attr($phone_clean); ?>" class="footer-phone"><?php echo esc_html($phone); ?></a>
                    </div>
                    <div class="social-links mt-2">
                        <?php if($viber && $viber !== '#') echo '<a href="'.esc_url($viber).'" target="_blank" rel="nofollow">Viber</a> | '; ?>
                        <?php if($telegram && $telegram !== '#') echo '<a href="'.esc_url($telegram).'" target="_blank" rel="nofollow">Telegram</a> | '; ?>
                        <?php if($whatsapp && $whatsapp !== '#') echo '<a href="'.esc_url($whatsapp).'" target="_blank" rel="nofollow">WhatsApp</a>'; ?>
                    </div>
                </div>

                <div class="footer-zones">
                    <h3>Зони обслуговування</h3>
                    <div class="zones-grid">
                        <div>
                            <strong>Київ:</strong>
                            <ul class="clean-list">
                                <li>Оболонський р-н</li>
                                <li>Святошинський р-н</li>
                                <li>Подільський р-н</li>
                                <li>Дніпровський р-н</li>
                                <li>Деснянський р-н</li>
                            </ul>
                        </div>
                        <div>
                            <strong>Вишгородський р-н:</strong>
                            <ul class="clean-list">
                                <li>Вишгород, Осещина</li>
                                <li>Хотянівка, Нові Петрівці</li>
                                <li>Демидів, Катюжанка</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div><!-- .footer-widget-area -->
            
			<div class="site-info">
				<p>&copy; <?php echo date('Y'); ?> Ніка Бетон. Всі права захищені. | <a href="/privacy-policy/">Політика конфіденційності</a></p>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
