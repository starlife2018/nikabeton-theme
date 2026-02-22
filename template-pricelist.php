<?php
/**
 * Template Name: Прайс-лист (Прайс Бетону і Послуг)
 */

get_header(); ?>

<div class="page-content py-section bg-light">
	<div class="container">
		
		<div class="text-center mb-5">
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php if ( has_excerpt() ) : ?>
				<p class="text-muted mt-2 mx-auto" style="max-width: 600px;">
					<?php echo get_the_excerpt(); ?>
				</p>
			<?php endif; ?>
		</div>

		<?php
		while ( have_posts() ) :
			the_post();
			if ( get_the_content() ) {
				echo '<div class="content-area mb-5 bg-white p-4 border-radius shadow">';
				the_content();
				echo '</div>';
			}
		endwhile;
		?>

		<!-- SECTION: CONCRETE PRICES -->
		<div class="pricelist-section mb-5">
			<h2 class="section-title mb-4" style="border-bottom: 2px solid var(--color-primary); padding-bottom: 10px; display: inline-block;">Прайс-лист на Бетон</h2>
			
			<div class="table-responsive bg-white border-radius shadow" style="overflow-x: auto;">
				<table class="pricelist-table" style="width: 100%; border-collapse: collapse; text-align: left;">
					<thead>
						<tr style="background-color: #f8f9fa; border-bottom: 2px solid #ddd;">
							<th style="padding: 15px;">Марка / Клас</th>
							<th style="padding: 15px;">Рухливість (П)</th>
							<th style="padding: 15px;">Водонепроникність (W)</th>
							<th style="padding: 15px;">Морозостійкість (F)</th>
							<th style="padding: 15px; text-align: right; color: var(--color-primary);">Ціна (грн/м³)</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$concrete_args = array(
							'post_type' => 'concrete',
							'posts_per_page' => -1,
							'meta_key' => '_concrete_price', // Order by price or title ideally.
							'orderby' => 'meta_value_num',
							'order' => 'ASC',
						);
						$concrete_query = new WP_Query( $concrete_args );

						if ( $concrete_query->have_posts() ) :
							while ( $concrete_query->have_posts() ) : $concrete_query->the_post();
								$mark = get_post_meta(get_the_ID(), '_concrete_mark', true);
								$class = get_post_meta(get_the_ID(), '_concrete_class', true);
								$frost = get_post_meta(get_the_ID(), '_concrete_frost', true);
								$water = get_post_meta(get_the_ID(), '_concrete_water', true);
								$plasticity = get_post_meta(get_the_ID(), '_concrete_plasticity', true);
								$price = get_post_meta(get_the_ID(), '_concrete_price', true);

								// Determine name fallback
								$display_name = $mark ? "Марка $mark" : get_the_title();
								$display_class = $class ? " ($class)" : "";
								?>
								<tr style="border-bottom: 1px solid #eee; transition: background 0.3s;">
									<td style="padding: 15px; font-weight: bold;">
										<a href="<?php the_permalink(); ?>" style="color: var(--color-dark); text-decoration: none;">
											<?php echo esc_html($display_name . $display_class); ?>
										</a>
									</td>
									<td style="padding: 15px;"><?php echo $plasticity ? esc_html('П' . $plasticity) : '-'; ?></td>
									<td style="padding: 15px;"><?php echo $water ? esc_html('W' . $water) : '-'; ?></td>
									<td style="padding: 15px;"><?php echo $frost ? esc_html('F' . $frost) : '-'; ?></td>
									<td style="padding: 15px; text-align: right; font-weight: bold; color: var(--color-primary); font-size: 1.1rem;">
										<?php echo $price ? esc_html($price . ' грн') : '-'; ?>
									</td>
								</tr>
								<?php
							endwhile;
							wp_reset_postdata();
						else :
							echo '<tr><td colspan="5" style="padding: 20px; text-align: center;">Немає даних про бетон.</td></tr>';
						endif;
						?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- SECTION: SERVICES PRICES -->
		<div class="pricelist-section">
			<h2 class="section-title mb-4" style="border-bottom: 2px solid var(--color-primary); padding-bottom: 10px; display: inline-block;">Прайс-лист на Послуги</h2>
			
			<div class="table-responsive bg-white border-radius shadow" style="overflow-x: auto;">
				<table class="pricelist-table" style="width: 100%; border-collapse: collapse; text-align: left;">
					<thead>
						<tr style="background-color: #f8f9fa; border-bottom: 2px solid #ddd;">
							<th style="padding: 15px; width: 60%;">Найменування послуги</th>
							<th style="padding: 15px; text-align: right; color: var(--color-primary);">Вартість</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$services_args = array(
							'post_type' => 'service',
							'posts_per_page' => -1,
						);
						$services_query = new WP_Query( $services_args );

						if ( $services_query->have_posts() ) :
							while ( $services_query->have_posts() ) : $services_query->the_post();
								$price = get_post_meta(get_the_ID(), '_service_price', true);
								?>
								<tr style="border-bottom: 1px solid #eee; transition: background 0.3s;">
									<td style="padding: 15px; font-weight: bold;">
										<a href="<?php the_permalink(); ?>" style="color: var(--color-dark); text-decoration: none;">
											<?php the_title(); ?>
										</a>
									</td>
									<td style="padding: 15px; text-align: right; font-weight: bold; color: var(--color-primary); font-size: 1.1rem;">
										<?php echo $price ? esc_html($price) : 'За домовленістю'; ?>
									</td>
								</tr>
								<?php
							endwhile;
							wp_reset_postdata();
						else :
							echo '<tr><td colspan="2" style="padding: 20px; text-align: center;">Немає даних про послуги.</td></tr>';
						endif;
						?>
					</tbody>
				</table>
			</div>
		</div>

		<!-- CTA -->
		<div class="text-center mt-5">
			<a href="#order" class="btn btn-primary btn-lg open-modal-btn">Замовити Бетон / Послугу</a>
			<p class="text-muted mt-3 text-sm">* Ціни можуть змінюватись, уточнюйте остаточну вартість у менеджера.</p>
		</div>

	</div>
</div>

<style>
.pricelist-table tbody tr:hover {
	background-color: #fff9f5 !important;
}
.table-responsive {
	width: 100%;
}
@media (max-width: 768px) {
	.pricelist-table th, .pricelist-table td {
		padding: 10px !important;
		font-size: 0.9rem;
	}
}
</style>

<?php get_footer(); ?>
