<?php
/**
 * The template for displaying all single posts for 'product'
 *
 * @package NIKABETON
 */

get_header();

$price = get_post_meta(get_the_ID(), '_product_price', true);
$application = get_post_meta(get_the_ID(), '_product_application', true);
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
            <div class="container py-section">
                <div class="grid grid-2">
                    
                    <!-- Product Image Gallery -->
                    <div class="product-gallery">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="product-image shadow border-radius" style="overflow:hidden;">
                                <?php the_post_thumbnail('large', ['style' => 'width:100%; height:auto; display:block;']); ?>
                            </div>
                        <?php else: ?>
                            <div class="product-image placeholder-image text-center shadow border-radius" style="background:var(--color-light); line-height:300px; color:var(--color-dark);">Фото Відсутнє</div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Info & Order Form -->
                    <div class="product-info-panel">
                        <h1 class="product-title mb-3" style="color:var(--color-primary);"><?php the_title(); ?></h1>
                        
                        <?php if($price): ?>
                            <div class="product-price mb-3" style="font-size:1.5rem;">
                                <strong>Ціна: </strong> <span style="color:var(--color-primary-dark); font-weight:700;"><?php echo esc_html($price); ?></span>
                            </div>
                        <?php endif; ?>

                        <?php if($application): ?>
                            <div class="product-application mb-3 p-3 bg-light border-radius">
                                <strong>Сфера застосування:</strong><br>
                                <?php echo esc_html($application); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="product-description mb-4">
                            <?php the_content(); ?>
                        </div>

                        <!-- Order Form Area -->
                        <div class="product-order-box border-radius p-4" style="border: 2px solid var(--color-border);">
                            <h3 class="mb-3">Замовити "<?php the_title(); ?>"</h3>
                            <form class="lead-form mt-2" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain">
                                <input type="hidden" name="product_name" value="<?php the_title(); ?>">
                                <div class="form-row">
                                    <label>Куди доставити? (Київ / Вишгород / і т.д.)</label>
                                    <input type="text" name="delivery_address" required class="form-control" placeholder="Наприклад: Вишгород, вул. Лісова 5">
                                </div>
                                <div class="form-row">
                                    <label>Об'єм або кількість</label>
                                    <input type="text" name="quantity" required class="form-control" placeholder="Наприклад: 10 м³">
                                </div>
                                <div class="form-row">
                                    <label>Телефон для зв'язку*</label>
                                    <input type="tel" name="phone_number" required class="form-control" placeholder="+380...">
                                </div>
                                <div class="form-row mt-3">
                                    <button type="submit" class="btn btn-primary btn-full" style="font-size:1.1rem; padding: 1rem;">Замовити з доставкою</button>
                                </div>
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
