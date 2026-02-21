<?php
/**
 * Template Name: Зони обслуговування
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

        <section class="zones-section py-section" style="background: var(--color-light);">
            <div class="container" style="padding-top: 3rem; padding-bottom: 3rem;">
                
                <?php
                while ( have_posts() ) :
                    the_post();
                    if ( get_the_content() ) {
                        echo '<div class="page-content mb-4" style="font-size: 1.1rem; line-height: 1.6;">';
                        the_content();
                        echo '</div>';
                    }
                endwhile;
                ?>

                <div class="grid grid-2 align-start">
                    
                    <div class="zones-content">
                        <?php
                        $zone_query = new WP_Query(array('post_type' => 'zone', 'posts_per_page' => -1));
                        if ($zone_query->have_posts()) :
                            while ($zone_query->have_posts()) : $zone_query->the_post();
                                $address = get_post_meta(get_the_ID(), '_zone_address', true);
                                $map = get_post_meta(get_the_ID(), '_zone_map_iframe', true);
                        ?>
                        <div class="zone-block mb-4 p-4 border-radius shadow" style="background:var(--color-white); border-left: 4px solid var(--color-primary);">
                            <h2 class="text-primary mb-2" style="font-size: 1.5rem; margin-top:0;">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align: middle; margin-right: 6px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <?php the_title(); ?>
                            </h2>
                            
                            <?php if($address): ?>
                                <p class="text-sm mb-2"><strong>Адреса:</strong> <?php echo esc_html($address); ?></p>
                            <?php endif; ?>
                            
                            <div class="text-sm mt-2 text-muted" style="line-height: 1.5;">
                                <?php the_content(); ?>
                            </div>
                            
                            <?php if($map): ?>
                                <div class="mt-3 zone-map-wrapper shadow-sm" style="border-radius:12px; overflow:hidden;">
                                    <?php echo wp_unslash($map); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php 
                            endwhile; wp_reset_postdata(); 
                        else:
                        ?>
                            <div class="zone-block mb-3 p-3 bg-white border-radius shadow">
                                <h3 class="text-primary">Зони відсутні</h3>
                                <p>Додайте ваші зони обслуговування (меню "Зони Доставки" в адмінці), щоб вони тут відображалися.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="contact-form-wrapper bg-white shadow p-4 border-radius" style="position: sticky; top: 120px;">
                        <h2 style="margin-top:0; margin-bottom: 1.5rem; font-size: 1.8rem;">Зв’яжіться з нами!</h2>
                        <form class="lead-form mt-4" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain">
                            <div class="form-row">
                                <label for="form-name" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">1. Ваше ім’я</label>
                                <input type="text" id="form-name" name="name" required class="form-control" style="border-radius: 8px;">
                            </div>
                            <div class="form-row">
                                <label for="form-phone" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">2. Номер телефону*</label>
                                <input type="tel" id="form-phone" name="phone" required class="form-control" style="border-radius: 8px;">
                            </div>
                            <div class="form-row">
                                <label for="form-message" style="font-weight: 600; margin-bottom: 0.5rem; display: block;">3. Повідомлення</label>
                                <textarea id="form-message" name="message" rows="4" class="form-control" style="border-radius: 8px;"></textarea>
                            </div>
                            <div class="form-row" style="margin-bottom:0; margin-top:1.5rem;">
                                <button type="submit" class="btn btn-primary btn-full shadow-sm" style="font-size: 1.1rem; border-radius: 8px;">Надіслати заявку</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

	</main><!-- #main -->

<?php
get_footer();
