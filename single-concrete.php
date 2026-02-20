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
if ($mark) $display_title .= ' - ' . $mark;
if ($frost) $display_title .= ' ' . $frost;
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
            <div class="container py-section">
                
                <div class="mb-4">
                    <a href="/concrete/" class="btn-link">&larr; Повернутися до Прайс-листа Бетону</a>
                </div>

                <div class="grid grid-2">
                    <!-- Product Info -->
                    <div class="product-info-panel">
                        <h1 class="product-title mb-3" style="color:var(--color-primary);"><?php echo esc_html($display_title); ?></h1>
                        
                        <div class="concrete-badge-group mb-4" style="display:flex; gap:10px; flex-wrap:wrap;">
                            <?php if($class): ?><span class="badge" style="background:var(--color-dark); color:var(--color-white); padding:5px 10px; border-radius:4px; font-weight:bold;">Клас: <?php echo esc_html($class); ?></span><?php endif; ?>
                            <?php if($mark): ?><span class="badge" style="background:#444; color:var(--color-white); padding:5px 10px; border-radius:4px; font-weight:bold;">Марка: <?php echo esc_html($mark); ?></span><?php endif; ?>
                            <?php if($frost): ?><span class="badge" style="background:#555; color:var(--color-white); padding:5px 10px; border-radius:4px; font-weight:bold;">F: <?php echo esc_html($frost); ?></span><?php endif; ?>
                            <?php if($water): ?><span class="badge" style="background:#666; color:var(--color-white); padding:5px 10px; border-radius:4px; font-weight:bold;">W: <?php echo esc_html($water); ?></span><?php endif; ?>
                            <?php if($plasticity): ?><span class="badge" style="background:#777; color:var(--color-white); padding:5px 10px; border-radius:4px; font-weight:bold;">П: <?php echo esc_html($plasticity); ?></span><?php endif; ?>
                        </div>

                        <?php if($price): ?>
                            <div class="product-price mb-4" style="font-size:1.75rem;">
                                <span style="color:var(--color-primary-dark); font-weight:800;"><?php echo esc_html($price); ?></span>
                                <span style="font-size:1rem; color:var(--color-text-muted);">грн/м³</span>
                            </div>
                        <?php endif; ?>

                        <div class="product-description mb-4 p-4 border-radius" style="background:var(--color-light);">
                            <h3 class="mb-2">Опис та застосування:</h3>
                            <?php the_content(); ?>
                            <?php if(empty(get_the_content())): ?>
                                <p>Використовується для будівельних робіт згідно з проектною документацією щодо вказаного класу міцності та інших характеристик.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Order Form Area -->
                    <div class="product-order-box border-radius p-4" style="border: 2px solid var(--color-border); align-self:start; position:sticky; top:20px;">
                        <h3 class="mb-3">Замовити Бетон з Доставкою</h3>
                        <p class="text-sm text-muted mb-3">Заповніть форму, і наш менеджер зв'яжеться з вами для уточнення деталей доставки та оплати.</p>
                        
                        <form class="lead-form mt-2" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain">
                            <input type="hidden" name="concrete_type" value="<?php echo esc_attr($display_title); ?>">
                            
                            <div class="form-row">
                                <label>Об'єм (м³)*</label>
                                <input type="number" name="volume" step="0.5" min="1" required class="form-control" placeholder="Наприклад: 10">
                            </div>

                            <div class="form-row">
                                <label>Куди доставити? (Київ / Вишгород)*</label>
                                <input type="text" name="delivery_address" required class="form-control" placeholder="Наприклад: Вишгород, вул. Лісова 5">
                            </div>
                            
                            <div class="form-row">
                                <label>Телефон для зв'язку*</label>
                                <input type="tel" name="phone_number" required class="form-control" placeholder="+380...">
                            </div>

                            <div class="form-row mt-4">
                                <button type="submit" class="btn btn-primary btn-full" style="font-size:1.1rem; padding: 1rem;">Замовити <?php echo esc_html($display_title); ?></button>
                            </div>
                            
                            <p class="text-xs text-muted mt-2 text-center">* Доставка розраховується окремо залежно від відстані від заводу.</p>
                        </form>
                    </div>
                </div>
            </div>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
