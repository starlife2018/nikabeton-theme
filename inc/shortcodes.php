<?php
/**
 * Elementor Shortcodes for Nikabeton Theme
 *
 * This file registers custom shortcodes that output the professional
 * landing page blocks originally built into the theme.
 */

// 1. Hero Block
add_shortcode('nikabeton_hero', 'nikabeton_shortcode_hero');
function nikabeton_shortcode_hero() {
    ob_start();
    
    $hero_bg       = get_theme_mod('nikabeton_hero_bg', '');
    $hero_title    = get_theme_mod('nikabeton_hero_title', "ДОСТАВКА БЕТОНУ<br>ОРЕНДА БЕТОНОНАСОСУ");
    $hero_subtitle = get_theme_mod('nikabeton_hero_subtitle', 'В КИЄВІ ТА ВИШГОРОДСЬКОМУ РАЙОНІ Від 400 грн/м³');
    $hero_features = get_theme_mod('nikabeton_hero_features', "<li>✓ Без Вихідних</li>\n<li>✓ Доставка за 2 години</li>\n<li>✓ Сертифікати якості</li>");
    $hero_btn_text = get_theme_mod('nikabeton_hero_btn_text', 'Детальніше');
    $hero_btn_link = get_theme_mod('nikabeton_hero_btn_link', '#order');

    $hero_style = '';
    if ( ! empty( $hero_bg ) ) {
        $hero_style = 'style="background-image: linear-gradient(135deg, rgba(30, 30, 30, 0.8) 0%, rgba(30, 30, 30, 0.5) 100%), url(\'' . esc_url($hero_bg) . '\'); background-size: cover; background-position: center;"';
    }
    ?>
    <section class="hero-section" <?php echo $hero_style; ?>>
        <div class="container hero-container">
            <div class="hero-slider" id="home-slider">
                <div class="hero-slide active">
                    <div class="hero-content">
                        <h1 class="hero-title"><?php echo wp_kses_post($hero_title); ?></h1>
                        <p class="hero-subtitle"><?php echo esc_html($hero_subtitle); ?></p>
                        <?php if(!empty($hero_features)): ?>
                            <ul class="clean-list hero-features mb-3">
                                <?php echo wp_kses_post($hero_features); ?>
                            </ul>
                        <?php endif; ?>
                        
                        <?php if(!empty($hero_btn_text)): ?>
                            <div class="hero-actions">
                                <a href="<?php echo esc_url($hero_btn_link); ?>" class="btn btn-primary btn-lg"><?php echo esc_html($hero_btn_text); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero-overlay"></div>
    </section>
    <?php
    return ob_get_clean();
}

/////////////////////////////////////////
// 2. Concrete Products Grid
/////////////////////////////////////////
add_shortcode('nikabeton_products', 'nikabeton_shortcode_products');
function nikabeton_shortcode_products() {
    ob_start();
    ?>
    <section class="products-section py-section" id="concrete">
        <div class="container">
          <h2 class="section-title text-center">ВИРОБНИЦТВО ТА ДОСТАВКА БЕТОНУ</h2>
            <div class="grid grid-3 products-grid mt-4">
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
                        
                        /*$display_title = get_the_title();
                        if ($mark) $display_title .= ' - ' . $mark;
                        if ($frost) $display_title .= ' ' . $frost;*/
                        $display_title = get_the_title();
                ?>
                <div class="product-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="product-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('medium'); ?>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="product-image placeholder-image text-center">
                            <a href="<?php the_permalink(); ?>" style="color:inherit; text-decoration:none; display:flex; width:100%; height:100%; align-items:center; justify-content:center;">Фото</a>
                        </div>
                    <?php endif; ?>
                    
                    <div class="product-content">
                        <a href="<?php the_permalink(); ?>"><h3 class="product-title"><?php echo esc_html($display_title); ?></h3></a>
                        
                        <div class="product-desc">
                            <div style="display:flex; flex-wrap:wrap; gap:8px;">
                                <?php if ($mark) : ?><span class="product-badge">Марка: <strong><?php echo esc_html($mark); ?></strong></span><?php endif; ?>
                                <?php if ($frost) : ?><span class="product-badge">Морозостійкість: <strong>F<?php echo esc_html($frost); ?></strong></span><?php endif; ?>    
                                <?php if ($class) : ?><span class="product-badge">Клас: <strong><?php echo esc_html($class); ?></strong></span><?php endif; ?>
                                <?php if ($water) : ?><span class="product-badge">Водонепроникність: <strong>W<?php echo esc_html($water); ?></strong></span><?php endif; ?>
                                <?php if ($plasticity) : ?><span class="product-badge">Рухливість: <strong>P<?php echo esc_html($plasticity); ?></strong></span><?php endif; ?>
                            </div>
                        </div>
                        
                        <?php if ($price) : ?>
                            <div class="product-price">
                                <strong><?php echo esc_html($price); ?></strong> <span class="unit">грн/м³</span>
                            </div>
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
    <?php
    return ob_get_clean();
}

// 3. Services Grid
add_shortcode('nikabeton_services', 'nikabeton_shortcode_services');
function nikabeton_shortcode_services() {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}

// 4. Other Materials
add_shortcode('nikabeton_materials', 'nikabeton_shortcode_materials');
function nikabeton_shortcode_materials() {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}

// 5. Why Choose Us (Advantages)
add_shortcode('nikabeton_advantages', 'nikabeton_shortcode_advantages');
function nikabeton_shortcode_advantages() {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}

// 6. Zones and Form
add_shortcode('nikabeton_zones', 'nikabeton_shortcode_zones');
function nikabeton_shortcode_zones() {
    ob_start();
    ?>
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
                                <?php echo wp_unslash($map); ?>
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
    <?php
    return ob_get_clean();
}

// 7. Reviews Grid
add_shortcode('nikabeton_reviews', 'nikabeton_shortcode_reviews');
function nikabeton_shortcode_reviews() {
    ob_start();
    ?>
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
    <?php
    return ob_get_clean();
}

// 8. Promo Block (Prices and Rent)
add_shortcode('nikabeton_promo_block', 'nikabeton_shortcode_promo_block');
function nikabeton_shortcode_promo_block() {
    ob_start();
    ?>
    <section class="promo-blocks-section py-section">
        <div class="container text-center">
            
            <!-- Part 1: Concrete Production -->
            <div class="promo-concrete mb-5">
                <h2 class="mb-2" style="font-weight:700;">ВИРОБНИЦТВО ТА ДОСТАВКА БЕТОНУ</h2>
                <div class="promo-price-accent mb-4" style="font-size:1.4rem; color:var(--color-primary);">Від <strong>400 грн/м³</strong></div>
                
                <div class="promo-concrete-grid" style="display:grid; grid-template-columns: repeat(3, 1fr); gap: 15px; text-align:center;">
                    <!-- Column 1 -->
                    <div class="promo-col" style="border:1px solid var(--color-border); border-radius:4px; overflow:hidden;">
                        <div class="promo-col-header" style="background:var(--color-light); padding:10px; font-weight:700; border-bottom:1px solid var(--color-border);">Підготовчий бетон</div>
                        <div class="promo-sub-grid" style="display:grid; grid-template-columns: 1fr 1fr;">
                            <div class="promo-item" style="padding:15px; border-right:1px solid var(--color-border);">
                                <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd;">Фото<br>бетон M100</div>
                                <div><strong>M100</strong><br>B7,5 F50</div>
                            </div>
                            <div class="promo-item" style="padding:15px;">
                                <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd;">Фото<br>бетон M150</div>
                                <div><strong>M150</strong><br>B12,5 F50</div>
                            </div>
                        </div>
                    </div>
                    <!-- Column 2 -->
                    <div class="promo-col" style="border:1px solid var(--color-border); border-radius:4px; overflow:hidden;">
                        <div class="promo-col-header" style="background:var(--color-light); padding:10px; font-weight:700; border-bottom:1px solid var(--color-border);">Загальнобудівельний бетон</div>
                        <div class="promo-sub-grid" style="display:grid; grid-template-columns: 1fr 1fr;">
                            <div class="promo-item" style="padding:15px; border-right:1px solid var(--color-border);">
                                <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd;">Фото<br>бетон M200</div>
                                <div><strong>M200</strong><br>B15 F50</div>
                            </div>
                            <div class="promo-item" style="padding:15px;">
                                <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd;">Фото<br>бетон M250</div>
                                <div><strong>M250</strong><br>B20 F200 W6</div>
                            </div>
                        </div>
                    </div>
                    <!-- Column 3 -->
                    <div class="promo-col" style="border:1px solid var(--color-border); border-radius:4px; overflow:hidden;">
                        <div class="promo-col-header" style="background:var(--color-light); padding:10px; font-weight:700; border-bottom:1px solid var(--color-border);">Міцний бетон</div>
                        <div class="promo-sub-grid" style="display:grid; grid-template-columns: 1fr 1fr;">
                            <div class="promo-item" style="padding:15px; border-right:1px solid var(--color-border);">
                                <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd;">Фото<br>бетон M350</div>
                                <div><strong>M350</strong><br>B25 F200 W6</div>
                            </div>
                            <div class="promo-item" style="padding:15px;">
                                <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd;">Фото<br>бетон M400</div>
                                <div><strong>M400</strong><br>B30 F200 W6</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 pb-5" style="border-bottom:1px solid var(--color-light);">
                    <a href="#pricelist" class="btn btn-outline-primary open-modal-btn">Отримати прайс</a>
                </div>
            </div>

            <!-- Part 2: Pump Rent -->
            <div class="promo-rent text-left mt-5 pt-3" style="max-width:900px; margin:0 auto;">
                <div class="grid grid-2 align-center" style="gap:40px;">
                    <div class="promo-rent-image">
                        <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; border:1px dashed #ddd;">
                            <span class="text-center">Фото<br>автобетононасос<br>на чистому фоні</span>
                        </div>
                    </div>
                    <div class="promo-rent-content">
                        <h2 class="mb-3" style="font-weight:700; font-size:1.6rem;">ОРЕНДА БЕТОНОНАСОСА<br>ТА СПЕЦТЕХНІКИ</h2>
                        <ul class="promo-list" style="list-style:disc; padding-left:20px; font-size:1.1rem; line-height:1.6; margin-bottom:20px;">
                            <li>Довжина стріли від <strong>24</strong> до <strong>42</strong> метрів</li>
                            <li>Автобетононасоси</li>
                            <li>Стаціонарні бетононасоси</li>
                            <li>Бетонозмішувачі</li>
                            <li>Самоскиди</li>
                            <li>Тягачі-маніпулятори</li>
                        </ul>
                        <a href="#pricelist" class="btn btn-outline-primary open-modal-btn">Отримати прайс</a>
                    </div>
                </div>
            </div>
            
        </div>
        
        <style>
            @media (max-width: 992px) {
                .promo-concrete-grid { grid-template-columns: 1fr !important; }
            }
            @media (max-width: 768px) {
                .promo-rent .grid-2 { grid-template-columns: 1fr; }
            }
        </style>
    </section>
    <?php
    return ob_get_clean();
}

