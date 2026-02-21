<?php
/**
 * Template Name: Контакти
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        
        <!-- Header banner -->
        <header class="page-header py-section text-center text-white" style="background: var(--gradient-primary); padding-top: 4rem; padding-bottom: 4rem;">
            <div class="container">
                <h1 class="page-title text-white" style="margin: 0;"><?php the_title(); ?></h1>
            </div>
        </header>

        <section class="contact-section py-section" style="background: var(--color-light);">
            <div class="container" style="padding-top: 3rem; padding-bottom: 3rem;">
                
                <?php
                while ( have_posts() ) :
                    the_post();
                    if ( get_the_content() ) {
                        echo '<div class="page-content mb-4 text-center" style="font-size: 1.1rem; line-height: 1.6; max-width:800px; margin: 0 auto 2rem auto;">';
                        the_content();
                        echo '</div>';
                    }
                endwhile;
                ?>

                <div class="grid grid-2 align-start" style="gap: 2rem;">
                    
                    <!-- Contact Info Block -->
                    <div class="contact-info-wrapper bg-white shadow p-5 border-radius" style="border-top: 4px solid var(--color-primary);">
                        <h2 style="margin-top:0; margin-bottom: 1.5rem; font-size: 1.8rem;">Наші Контакти</h2>
                        
                        <div class="contact-item mb-4">
                            <h4 class="text-primary mb-1"><i class="dashicons dashicons-phone"></i> Телефон</h4>
                            <p class="mb-0" style="font-size: 1.1rem;">
                                <a href="tel:+380503824812" style="color:var(--color-darker); font-weight:600; text-decoration:none;">050-382-4812</a>
                            </p>
                        </div>
                        
                        <div class="contact-item mb-4">
                            <h4 class="text-primary mb-1"><i class="dashicons dashicons-email"></i> E-mail</h4>
                            <p class="mb-0" style="font-size: 1.1rem;">
                                <a href="mailto:vicara8@gmail.com" style="color:var(--color-darker); font-weight:600; text-decoration:none;">vicara8@gmail.com</a>
                            </p>
                        </div>

                        <div class="contact-item mb-4">
                            <h4 class="text-primary mb-1"><i class="dashicons dashicons-clock"></i> Графік роботи</h4>
                            <p class="mb-0" style="line-height:1.5;">
                                <strong>Пн-Пт:</strong> 8:00 - 20:00<br>
                                <strong>Сб-Нд:</strong> 9:00 - 18:00
                            </p>
                        </div>

                        <div class="contact-item mb-4">
                            <h4 class="text-primary mb-1"><i class="dashicons dashicons-location"></i> Адреси виробництва</h4>
                            <p class="mb-2" style="line-height:1.5;">
                                <strong>м. Вишгород:</strong> вул. Набережна, 7Є<br>
                                <strong>м. Київ:</strong> вул. Йорданська, 18
                            </p>
                        </div>

                        <div class="contact-socials mt-4 pt-4" style="border-top: 1px solid #eee;">
                            <h4 class="mb-3">Ми у соцмережах:</h4>
                            <div class="social-icons d-flex" style="gap: 12px;">
                                <a href="viber://chat?number=%2B380503824812" class="social-icon" title="Viber" style="background:#59267c;"><img src="https://cdn.jsdelivr.net/npm/simple-icons@v10/icons/viber.svg" alt="Viber" width="20" height="20" style="filter: brightness(0) invert(1);"></a>
                                <a href="https://t.me/NikaBeton" class="social-icon" title="Telegram" style="background:#26A5E4;"><img src="https://cdn.jsdelivr.net/npm/simple-icons@v10/icons/telegram.svg" alt="Telegram" width="20" height="20" style="filter: brightness(0) invert(1);"></a>
                                <a href="https://wa.me/380503824812" class="social-icon" title="WhatsApp" style="background:#25D366;"><img src="https://cdn.jsdelivr.net/npm/simple-icons@v10/icons/whatsapp.svg" alt="WhatsApp" width="20" height="20" style="filter: brightness(0) invert(1);"></a>
                                <a href="https://www.youtube.com/@nikabeton" class="social-icon" title="YouTube" style="background:#FF0000;"><img src="https://cdn.jsdelivr.net/npm/simple-icons@v10/icons/youtube.svg" alt="YouTube" width="20" height="20" style="filter: brightness(0) invert(1);"></a>
                            </div>
                        </div>

                    </div>

                    <!-- Contact Form Box -->
                    <div class="contact-form-wrapper bg-white shadow p-5 border-radius">
                        <h2 style="margin-top:0; margin-bottom: 1.5rem; font-size: 1.8rem;">Написати нам</h2>
                        <form class="lead-form mt-4" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain">
                            <p class="text-muted mb-4 text-sm">Залиште ваші дані, і наш менеджер зв'яжеться з вами найближчим часом для консультації або оформлення замовлення.</p>
                            <div class="form-row">
                                <label for="form-name" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Ваше ім’я</label>
                                <input type="text" id="form-name" name="name" required class="form-control" style="border-radius: 8px; background:#f9f9f9;">
                            </div>
                            <div class="form-row">
                                <label for="form-phone" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Номер телефону*</label>
                                <input type="tel" id="form-phone" name="phone" required class="form-control" style="border-radius: 8px; background:#f9f9f9;">
                            </div>
                            <div class="form-row">
                                <label for="form-message" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">Повідомлення (Який бетон цікавить?)</label>
                                <textarea id="form-message" name="message" rows="5" class="form-control" style="border-radius: 8px; background:#f9f9f9;"></textarea>
                            </div>
                            <div class="form-row" style="margin-bottom:0; margin-top:1.5rem;">
                                <button type="submit" class="btn btn-primary btn-full shadow-sm" style="font-size: 1.1rem; border-radius: 8px; padding: 1rem;">Надіслати заявку</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

        <!-- Full Width Map Section -->
        <section class="contact-map border-top" style="border-color: #eee;">
            <!-- Kyiv Map as default -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2538.560411306161!2d30.505030276856525!3d50.48644347159781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4d1e2e1bcfa7b%3A0x1d47343e5be02202!2z0LLRg9C7LiDQmdC-0YDQtNCw0L3RgdGM0LrQsCwgMTgsINCa0LjRl9CyLCAwMjAwMA!5e0!3m2!1suk!2sua!4v1700000000000!5m2!1suk!2sua" width="100%" height="450" style="border:0; display:block;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>

	</main><!-- #main -->

<?php
get_footer();
