<?php
/**
 * The template for displaying a single concrete product
 *
 * @package NIKABETON
 */

get_header();

$price = get_post_meta(get_the_ID(), '_concrete_price', true);
$class = get_post_meta(get_the_ID(), '_concrete_class', true);
$mark  = get_post_meta(get_the_ID(), '_concrete_mark', true);
$frost = get_post_meta(get_the_ID(), '_concrete_frost', true);
$water = get_post_meta(get_the_ID(), '_concrete_water', true);
$plasticity = get_post_meta(get_the_ID(), '_concrete_plasticity', true);

// Build display title
$display_title = get_the_title();
if ($mark) $display_title .= ' ' . $mark;
if ($class) $display_title .= ' ' . $class;
//if ($frost) $display_title .= ' ' . $frost;
?>

<style>
/* Concrete Single Page Styles */
.concrete-single-wrap {
    background-color: #fbfbfb;
    padding-top: 40px;
    padding-bottom: 60px;
}
.concrete-back-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: var(--color-dark);
    font-weight: 500;
    text-decoration: none;
    margin-bottom: 25px;
    transition: color 0.3s ease;
}
.concrete-back-link:hover {
    color: var(--color-primary);
}
.concrete-card-layout {
    display: grid;
    grid-template-columns: 1fr;
    gap: 40px;
}
@media (min-width: 992px) {
    .concrete-card-layout {
        grid-template-columns: 1.2fr 0.8fr;
    }
}
.concrete-image-wrapper {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 30px rgba(0,0,0,0.06);
    margin-bottom: 30px;
}
.concrete-image-wrapper img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.8s ease;
}
.concrete-image-wrapper:hover img {
    transform: scale(1.03);
}
.concrete-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #111;
    margin-bottom: 20px;
    line-height: 1.2;
}
.concrete-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 30px;
}
.c-badge {
    display: inline-flex;
    align-items: center;
    padding: 6px 14px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: #fff;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.c-badge-class { background: linear-gradient(135deg, var(--color-primary), var(--color-primary-dark)); }
.c-badge-mark { background: linear-gradient(135deg, #444, #111); }
.c-badge-frost { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
.c-badge-water { background: linear-gradient(135deg, #14b8a6, #0f766e); }
.c-badge-plasticity { background: linear-gradient(135deg, #f59e0b, #d97706); }

.concrete-price-block {
    background: #fff;
    border: 1px solid #eee;
    padding: 24px;
    border-radius: 12px;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    border-left: 5px solid var(--color-primary);
}
.c-price-label {
    font-size: 1.1rem;
    color: #555;
    font-weight: 600;
    margin-bottom: 5px;
    display: block;
}
.c-price-value {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--color-primary-dark);
    line-height: 1;
}
.c-price-currency {
    font-size: 1.2rem;
    color: #888;
    font-weight: 600;
    margin-left: 5px;
}

.concrete-desc-block {
    background: #fff;
    padding: 30px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.04);
}
.concrete-desc-block h3 {
    font-size: 1.3rem;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    color: #222;
}
.concrete-desc-block h3::before {
    content: '';
    display: block;
    width: 24px;
    height: 24px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23f87e00' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z'%3E%3C/path%3E%3Cpolyline points='14 2 14 8 20 8'%3E%3C/polyline%3E%3Cline x1='16' y1='13' x2='8' y2='13'%3E%3C/line%3E%3Cline x1='16' y1='17' x2='8' y2='17'%3E%3C/line%3E%3Cpolyline points='10 9 9 9 8 9'%3E%3C/polyline%3E%3C/svg%3E");
}
.concrete-desc-block p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 0;
}

.concrete-order-box {
    background: #fff;
    border-radius: 16px;
    padding: 35px 30px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    position: sticky;
    top: 30px;
    border-top: 5px solid var(--color-primary);
}
.concrete-order-box h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
    font-weight: 800;
    color: #111;
}
.concrete-order-box p.subtitle {
    font-size: 0.95rem;
    color: #666;
    margin-bottom: 25px;
    line-height: 1.5;
}
.order-form-modern .form-row {
    margin-bottom: 20px;
}
.order-form-modern label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
    font-size: 0.95rem;
}
.order-form-modern .form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1rem;
    background: #fafafa;
    transition: all 0.3s ease;
}
.order-form-modern .form-control:focus {
    background: #fff;
    border-color: var(--color-primary);
    box-shadow: 0 0 0 3px rgba(248, 126, 0, 0.15);
    outline: none;
}
.btn-modern-submit {
    width: 100%;
    background: var(--color-primary);
    color: #fff;
    border: none;
    padding: 16px;
    font-size: 1.1rem;
    font-weight: 700;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 6px 15px rgba(248, 126, 0, 0.3);
}
.btn-modern-submit:hover {
    background: var(--color-primary-dark);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(248, 126, 0, 0.4);
}
.order-form-modern .note {
    font-size: 0.85rem;
    color: #888;
    text-align: center;
    margin-top: 15px;
}
</style>

	<main id="primary" class="site-main concrete-single-wrap">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
            <div class="container">
                
                <a href="/concrete/" class="concrete-back-link">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Повернутися до Прайс-листа Бетону
                </a>

                <div class="concrete-card-layout">
                    <!-- Product Info -->
                    <div class="concrete-info">
                        
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="concrete-image-wrapper">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </div>
                        <?php endif; ?>

                        <h1 class="concrete-title"><?php echo esc_html($display_title); ?></h1>
                        
                        <div class="concrete-badges">
                            <?php if($class): ?><span class="c-badge c-badge-class">Клас: <?php echo esc_html($class); ?></span><?php endif; ?>
                            <?php if($mark): ?><span class="c-badge c-badge-mark">Марка: <?php echo esc_html($mark); ?></span><?php endif; ?>
                            <?php if($frost): ?><span class="c-badge c-badge-frost">F: <?php echo esc_html($frost); ?></span><?php endif; ?>
                            <?php if($water): ?><span class="c-badge c-badge-water">W: <?php echo esc_html($water); ?></span><?php endif; ?>
                            <?php if($plasticity): ?><span class="c-badge c-badge-plasticity">П: <?php echo esc_html($plasticity); ?></span><?php endif; ?>
                        </div>

                        <?php if($price): ?>
                            <div class="concrete-price-block">
                                <div>
                                    <span class="c-price-label">Вартість від виробника:</span>
                                    <span class="c-price-value"><?php echo esc_html($price); ?></span>
                                    <span class="c-price-currency">грн / м³</span>
                                </div>
                                <div class="price-icon" style="opacity:0.15; padding-right:10px;">
                                    <svg width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="var(--color-primary-dark)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2" ry="2"></rect><line x1="12" y1="12" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="8"></line><line x1="12" y1="16" x2="12" y2="16"></line><line x1="8" y1="12" x2="8" y2="12"></line><line x1="16" y1="12" x2="16" y2="12"></line></svg>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="concrete-desc-block">
                            <h3>Опис та застосування</h3>
                            <div class="desc-content">
                                <?php the_content(); ?>
                                <?php if(empty(get_the_content())): ?>
                                    <p>Використовується для будівельних робіт згідно з проектною документацією щодо вказаного класу міцності та інших характеристик.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Order Form Area -->
                    <div class="concrete-sidebar">
                        <div class="concrete-order-box">
                            <h3>Замовити Бетон</h3>
                            <p class="subtitle">Вкажіть дані, і ми розрахуємо точну вартість з урахуванням доставки міксером.</p>
                            
                            <form class="order-form-modern" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain">
                                <input type="hidden" name="concrete_type" value="<?php echo esc_attr($display_title); ?>">
                                
                                <div class="form-row">
                                    <label>Потрібний об'єм (м³)*</label>
                                    <input type="number" name="volume" step="0.5" min="1" required class="form-control" placeholder="Наприклад: 10">
                                </div>

                                <div class="form-row">
                                    <label>Місце доставки*</label>
                                    <input type="text" name="delivery_address" required class="form-control" placeholder="Київ / Вишгород / Область...">
                                </div>
                                
                                <div class="form-row">
                                    <label>Номер телефону*</label>
                                    <input type="tel" name="phone_number" required class="form-control" placeholder="+380...">
                                </div>

                                <div class="form-row" style="margin-top: 30px;">
                                    <button type="submit" class="btn-modern-submit">Оформити замовлення</button>
                                </div>
                                
                                <p class="note">🚚 Доставка розраховується індивідуально залежно від відстані до об'єкта.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
