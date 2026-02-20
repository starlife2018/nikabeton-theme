<?php
/**
 * The front page template file (Updated from PDF specs)
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">

        <!-- HERO SECTION (Slider or Rotating Banners) -->
        <section class="hero-section">
            <div class="container hero-container">
                <div class="hero-slider" id="home-slider">
                    <!-- Variant 1 -->
                    <div class="hero-slide active">
                        <div class="hero-content">
                            <h1 class="hero-title">ДОСТАВКА БЕТОНУ<br>ОРЕНДА БЕТОНОНАСОСУ</h1>
                            <p class="hero-subtitle">В КИЄВІ ТА ВИШГОРОДСЬКОМУ РАЙОНІ</p>
                            <ul class="clean-list hero-features mb-3">
                                <li>✓ Без Вихідних</li>
                                <li>✓ Доставка за 2 години</li>
                                <li>✓ Сертифікати якості</li>
                            </ul>
                            <div class="hero-actions">
                                <a href="#order" class="btn btn-primary btn-lg">Замовити</a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Further variants can be implemented via JS slider or ACF repeater. Hidden for simplicity here but structured for JS -->
                    <div class="hero-slide" style="display:none;">
                        <div class="hero-content">
                            <h1 class="hero-title">ТОП Продаж</h1>
                            <p class="hero-subtitle">Бетон В20 М250 F200 W6 - 2600 грн/м3<br>Найвигідніше співвідношення ціна/якість</p>
                            <div class="hero-actions"><a href="#order" class="btn btn-primary btn-lg">Замовити</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="hero-overlay"></div>
        </section>

        <!-- CONCRETE PRODUCTION (Виробництво Бетону) -->
        <section class="products-section py-section" id="concrete">
            <div class="container">
                <h2 class="section-title text-center">ВИРОБНИЦТВО БЕТОНУ</h2>
                <div class="grid grid-3 products-grid mt-4">
                    <!-- Dynamic Loop mapping to the new 'concrete' Custom Post Type -->
                    <?php
                    $args = array(
                        'post_type'      => 'concrete',
                        'posts_per_page' => 6,
                        'orderby'        => 'title',
                        'order'          => 'ASC'
                    );
                    $concrete_query = new WP_Query($args);
                    
                    if ($concrete_query->have_posts()) :
                        while ($concrete_query->have_posts()) : $concrete_query->the_post();
                            
                            $price = get_post_meta(get_the_ID(), '_concrete_price', true);
                            $class = get_post_meta(get_the_ID(), '_concrete_class', true);
                            $mark  = get_post_meta(get_the_ID(), '_concrete_mark', true);
                            $frost = get_post_meta(get_the_ID(), '_concrete_frost', true);
                            $water = get_post_meta(get_the_ID(), '_concrete_water', true);
                            $plasticity = get_post_meta(get_the_ID(), '_concrete_plasticity', true);
                            
                            // Build nice title showing Mark and Frost if available, typical for Nikabeton
                            $display_title = get_the_title();
                            if ($mark) $display_title .= ' - ' . $mark;
                            if ($frost) $display_title .= ' ' . $frost;
                    ?>
                    <div class="product-card">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="product-image"><?php the_post_thumbnail('medium'); ?></div>
                        <?php else: ?>
                            <div class="product-image placeholder-image text-center" style="line-height:200px; color:#fff;">Фото</div>
                        <?php endif; ?>
                        
                        <div class="product-content">
                            <h3 class="product-title"><?php echo esc_html($display_title); ?></h3>
                            <div class="product-desc text-sm">
                                <?php if ($class) echo 'Клас: <strong>'.esc_html($class).'</strong><br>'; ?>
                                <?php if ($water) echo 'Водонепроникність: <strong>'.esc_html($water).'</strong><br>'; ?>
                                <?php if ($plasticity) echo 'Рухливість: <strong>'.esc_html($plasticity).'</strong><br>'; ?>
                            </div>
                            <?php if ($price) : ?>
                                <div class="product-price mt-2 mb-2"><strong><?php echo esc_html($price); ?> грн/м³</strong></div>
                            <?php endif; ?>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-full mt-2">КУПИТИ</a>
                        </div>
                    </div>
                    <?php 
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p class="text-center" style="grid-column: 1/-1;">Бетон ще не додано. Будь ласка, заповніть каталог в адмін-панелі.</p>';
                    endif;
                    ?>
                </div>
                <div class="text-center mt-4">
                    <a href="#" class="btn btn-outline" style="color:var(--color-dark); border-color:var(--color-dark);">Прайс Ліст</a>
                </div>
            </div>
        </section>

        <!-- SERVICES BLOCK -->
        <section class="services-overview py-section bg-light">
            <div class="container">
                <div class="grid grid-2">
                    <?php
                    $service_query = new WP_Query(array('post_type' => 'service', 'posts_per_page' => 4));
                    if ($service_query->have_posts()) :
                        while ($service_query->have_posts()) : $service_query->the_post();
                            $price = get_post_meta(get_the_ID(), '_service_price', true);
                            $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                    ?>
                    <div class="service-block bg-white border-radius p-4 shadow">
                        <div style="font-size:2rem; color:var(--color-primary); margin-bottom:1rem;"><?php echo $icon ? $icon : '⚙️'; ?></div>
                        <h2><?php the_title(); ?></h2>
                        <div class="mt-3 text-sm text-muted">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php if($price): ?>
                            <div class="mt-3 p-2 border-radius text-center" style="background:var(--color-light); font-weight:bold; color:var(--color-dark);">
                                <?php echo esc_html($price); ?>
                            </div>
                        <?php endif; ?>
                        <div class="text-center mt-4">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-full">Детальніше</a>
                        </div>
                    </div>
                    <?php 
                        endwhile; wp_reset_postdata(); 
                    else:
                        echo '<p class="text-center" style="grid-column:1/-1;">Послуги ще не додано. Налаштуйте їх в адмінці.</p>';
                    endif; 
                    ?>
                </div>
            </div>
        </section>

        <!-- OTHER MATERIALS TABS/GRIDS -->
        <section class="materials-section py-section">
            <div class="container text-center">
                <h2>Доставка будівельних розчинів</h2>
                <div class="grid grid-4 mt-3">
                    <div class="mat-card border-radius shadow p-3"><h4>Цементний</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                    <div class="mat-card border-radius shadow p-3"><h4>Кладочний</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                    <div class="mat-card border-radius shadow p-3"><h4>Гарцовка</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                    <div class="mat-card border-radius shadow p-3"><h4>Вапняний</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                </div>
                <a href="#" class="btn-link mt-3" style="display:inline-block;">Перейти в розділ &rarr;</a>

                <h2 class="mt-4">Сипучі Матеріали</h2>
                <div class="grid grid-2 mt-3" style="max-width:600px; margin-left:auto; margin-right:auto;">
                    <div class="mat-card border-radius shadow p-3"><h4>Пісок</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                    <div class="mat-card border-radius shadow p-3"><h4>Щебінь</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                </div>

                <h2 class="mt-4">Бетонні Вироби</h2>
                <div class="grid grid-4 mt-3">
                    <div class="mat-card border-radius shadow p-3"><h4>Бетонні Блоки</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                    <div class="mat-card border-radius shadow p-3"><h4>Плити перекриття</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                    <div class="mat-card border-radius shadow p-3"><h4>Кільця</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                    <div class="mat-card border-radius shadow p-3"><h4>Перемички</h4><button class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</button></div>
                </div>
            </div>
        </section>

        <!-- WHY CHOOSE US -->
        <section class="advantages-section bg-dark text-white py-section">
            <div class="container">
                <h2 class="section-title text-center text-white">Чому варто обрати Ніка Бетон</h2>
                <div class="grid grid-3 advantages-grid mt-4">
                    <div class="adv-item">
                        <h3 class="text-primary">★ 30+ років на ринку</h3>
                        <p>Надаємо послуги з виробництва та доставки будматеріалів з 1992 року.</p>
                    </div>
                    <div class="adv-item">
                        <h3 class="text-primary">★ Власне виробництво бетону</h3>
                        <p>Виготовляємо бетонні суміші, розчини, залізобетонні вироби (ЗБВ).</p>
                    </div>
                    <div class="adv-item">
                        <h3 class="text-primary">★ Власний автопарк спецтехніки</h3>
                        <p>Надання послуг автобетономіксерів, стаціонарних бетононасосів, автобетононасосів, самоскидів, маніпуляторів для будівництва.</p>
                    </div>
                    <div class="adv-item">
                        <h3 class="text-primary">★ Доставка по всій Київській області</h3>
                        <p>Постачаємо будівельні матеріали та надаємо послуги оренди бетононасосів у Києві, Вишгороді та всій області.</p>
                    </div>
                    <div class="adv-item">
                        <h3 class="text-primary">★ Сертифікати якості</h3>
                        <p>Виробництво бетону відповідає ДСТУ України по міцності, щільності і вологості.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ZONES & CONTACT FORM -->
        <section class="zones-section py-section" id="order">
            <div class="container">
                <div class="grid grid-2 align-start">
                    
                    <div class="zones-content">
                        <h2>Зони Обслуговування</h2>
                        <?php
                        $zone_query = new WP_Query(array('post_type' => 'zone', 'posts_per_page' => 5));
                        if ($zone_query->have_posts()) :
                            while ($zone_query->have_posts()) : $zone_query->the_post();
                                $address = get_post_meta(get_the_ID(), '_zone_address', true);
                                $map = get_post_meta(get_the_ID(), '_zone_map_iframe', true);
                        ?>
                        <div class="zone-block mb-4 p-4 border-radius shadow" style="background:var(--color-white); border-left: 4px solid var(--color-primary);">
                            <h3 class="text-primary mb-2"><i class="dashicons dashicons-location"></i> <?php the_title(); ?></h3>
                            <?php if($address): ?>
                                <p class="text-sm mb-2"><strong>Адреса:</strong> <?php echo esc_html($address); ?></p>
                            <?php endif; ?>
                            <div class="text-sm mt-2 text-muted">
                                <?php the_content(); ?>
                            </div>
                            <?php if($map): ?>
                                <div class="mt-3 zone-map-wrapper" style="border-radius:8px; overflow:hidden;">
                                    <?php echo wp_unslash($map); // Outputs the HTML iframe ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php 
                            endwhile; wp_reset_postdata(); 
                        else:
                        ?>
                            <div class="zone-block mb-3 p-3 bg-white border-radius shadow">
                                <h3 class="text-primary">Київ та Область</h3>
                                <p>Додайте ваші зони обслуговування (меню "Зони Доставки" в адмінці), щоб вони відображалися на карті.</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="contact-form-wrapper bg-white shadow p-4 border-radius">
                        <h2>Зв’яжіться з нами!</h2>
                        <form class="lead-form mt-4" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain">
                            <div class="form-row">
                                <label for="form-name">1. Ваше ім’я</label>
                                <input type="text" id="form-name" name="name" required class="form-control">
                            </div>
                            <div class="form-row">
                                <label for="form-phone">2. Номер телефону*</label>
                                <input type="tel" id="form-phone" name="phone" required class="form-control">
                            </div>
                            <div class="form-row">
                                <label for="form-message">3. Повідомлення</label>
                                <textarea id="form-message" name="message" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-row">
                                <button type="submit" class="btn btn-primary btn-full">Надіслати</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>

        <!-- REVIEWS SECTION -->
        <section class="reviews-section py-section bg-dark text-white">
            <div class="container">
                <h2 class="section-title text-center text-white">Відгуки наших клієнтів</h2>
                <div class="grid grid-3 reviews-grid mt-4">
                    <?php
                    $review_query = new WP_Query(array('post_type' => 'review', 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC'));
                    if ($review_query->have_posts()) :
                        while ($review_query->have_posts()) : $review_query->the_post();
                            $rating = get_post_meta(get_the_ID(), '_review_rating', true);
                            $source = get_post_meta(get_the_ID(), '_review_source', true);
                            
                            $stars_html = '';
                            for($i=1; $i<=5; $i++) {
                                $stars_html .= ($i <= $rating) ? '★' : '☆';
                            }
                    ?>
                    <div class="review-card p-4 border-radius shadow text-center" style="background:#2a2a2a; border-top:3px solid var(--color-primary);">
                        <div class="review-stars mb-3" style="color:#FFD700; font-size:1.5rem; letter-spacing:2px;"><?php echo $stars_html; ?></div>
                        <div class="review-text text-sm mb-4" style="font-style:italic;">"<?php echo wp_strip_all_tags(get_the_content()); ?>"</div>
                        <h4 class="review-author m-0" style="color:var(--color-white);"><?php the_title(); ?></h4>
                        <?php if($source): ?>
                            <div class="review-source text-xs mt-2" style="color:#aaa;">через <?php echo esc_html($source); ?></div>
                        <?php endif; ?>
                    </div>
                    <?php 
                        endwhile; wp_reset_postdata(); 
                    else:
                        echo '<p class="text-center w-100" style="grid-column: 1/-1; color:#aaa;">Відгуки поки що відсутні. Додайте їх в меню "Відгуки".</p>';
                    endif; 
                    ?>
                </div>
            </div>
        </section>

	</main><!-- #main -->

    <!-- Modal for Order Buttons -->
    <div id="orderModal" class="modal-overlay hidden">
        <div class="modal-content border-radius bg-white p-4 shadow">
            <span class="close-modal">&times;</span>
            <h2>Швидке замовлення</h2>
            <form class="lead-form mt-2" onsubmit="event.preventDefault(); alert('Повідомлення відправлено (Demo)'); this.closest('.modal-overlay').classList.add('hidden');">
                <div class="form-row">
                    <input type="text" placeholder="Ваше ім’я" required class="form-control">
                </div>
                <div class="form-row">
                    <input type="tel" placeholder="Телефон" required class="form-control">
                </div>
                <div class="form-row">
                    <button type="submit" class="btn btn-primary btn-full">Відправити заявку</button>
                </div>
            </form>
        </div>
    </div>

<?php
get_footer();
