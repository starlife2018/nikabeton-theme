<?php
/**
 * NikaBeton Concrete Calculator Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Calculator_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'nikabeton_calculator';
	}

	public function get_title() {
		return 'Калькулятор Бетону';
	}

	public function get_icon() {
		return 'eicon-calculator';
	}

	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => 'Налаштування Калькулятора',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'widget_title',
			[
				'label' => 'Заголовок секції',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Калькулятор об\'єму бетону',
			]
		);
		
		$this->add_control(
			'widget_desc',
			[
				'label' => 'Опис секції',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => 'Розрахуйте необхідний об\'єм бетону для вашого фундаменту. Рекомендуємо замовляти з запасом 5-10%.',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="calculator-section py-section" style="background:var(--color-light);">
			<div class="container" style="max-width: 800px; margin: 0 auto;">
				<?php if ( ! empty( $settings['widget_title'] ) ) : ?>
					<h2 class="section-title text-center" style="margin-bottom:0.5rem;"><?php echo esc_html( $settings['widget_title'] ); ?></h2>
				<?php endif; ?>
				
				<?php if ( ! empty( $settings['widget_desc'] ) ) : ?>
					<p class="text-center text-muted" style="margin-bottom:2rem;"><?php echo wp_kses_post( $settings['widget_desc'] ); ?></p>
				<?php endif; ?>

				<div class="calculator-card shadow border-radius bg-white p-4" style="background:#fff; border-radius:12px; padding:2rem; box-shadow:0 10px 30px rgba(0,0,0,0.05);">
					
					<!-- Calculator Tabs -->
					<div class="calc-tabs mb-4" style="display:flex; border-bottom:2px solid var(--color-light);">
						<button class="calc-tab active" data-target="calc-slab" style="flex:1; padding:15px; border:none; background:transparent; font-weight:bold; cursor:pointer; border-bottom:3px solid var(--color-primary); color:var(--color-primary);">Плитний (Стяжка)</button>
						<button class="calc-tab" data-target="calc-strip" style="flex:1; padding:15px; border:none; background:transparent; font-weight:bold; cursor:pointer; color:var(--color-dark);">Стрічковий</button>
						<button class="calc-tab" data-target="calc-column" style="flex:1; padding:15px; border:none; background:transparent; font-weight:bold; cursor:pointer; color:var(--color-dark);">Стовпчастий</button>
					</div>

					<!-- Slab Calculator -->
					<div id="calc-slab" class="calc-pane" style="display:block;">
						<div class="grid grid-3" style="column-gap:15px;">
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Довжина (м)</label>
								<input type="number" id="slab-l" min="0.1" step="0.1" value="10" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Ширина (м)</label>
								<input type="number" id="slab-w" min="0.1" step="0.1" value="8" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Товщина (м)</label>
								<input type="number" id="slab-h" min="0.01" step="0.01" value="0.2" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
						</div>
					</div>

					<!-- Strip Calculator -->
					<div id="calc-strip" class="calc-pane" style="display:none;">
						<div class="grid grid-3" style="column-gap:15px;">
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold; font-size: 0.9rem;">Загальна довжина (м)</label>
								<input type="number" id="strip-l" min="0.1" step="0.1" value="40" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Ширина (м)</label>
								<input type="number" id="strip-w" min="0.1" step="0.1" value="0.4" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Висота (м)</label>
								<input type="number" id="strip-h" min="0.1" step="0.1" value="1" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
						</div>
					</div>

					<!-- Column Calculator -->
					<div id="calc-column" class="calc-pane" style="display:none;">
						<div class="grid grid-3" style="column-gap:15px;">
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Кількість (шт)</label>
								<input type="number" id="col-count" min="1" step="1" value="20" placeholder="0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Діаметр (м)</label>
								<input type="number" id="col-d" min="0.1" step="0.05" value="0.4" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
							<div class="form-group mb-3">
								<label style="display:block; margin-bottom:5px; font-weight:bold;">Глибина (м)</label>
								<input type="number" id="col-h" min="0.1" step="0.1" value="1.5" placeholder="0.0" style="width:100%; padding:10px; border:1px solid #ddd; border-radius:6px;">
							</div>
						</div>
					</div>

					<!-- Result Area -->
					<div class="calc-result border-radius p-3 mt-4 text-center" style="background:#f2f5f9; border:2px dashed var(--color-primary); position:relative;">
						<div style="font-size:1.1rem; margin-bottom:10px; color:var(--color-dark);">Орієнтовний об'єм бетону:</div>
						<div style="font-size:3rem; font-weight:900; color:var(--color-primary); line-height:1;"><span id="calc-total">16.00</span> <span style="font-size:1.5rem;">м³</span></div>
						<div style="font-size:0.9rem; margin-top:10px; color:#555;">(Включено запас +10%: <strong id="calc-pure">14.55</strong> м³)</div>
						<a href="/#order" class="btn btn-primary mt-3 open-modal-btn">Замовити бетон</a>
					</div>
				</div>
			</div>
		</section>

		<script>
		document.addEventListener('DOMContentLoaded', function() {
			const tabs = document.querySelectorAll('.calc-tab');
			const panes = document.querySelectorAll('.calc-pane');
			const inputs = document.querySelectorAll('.calculator-card input');
			
			let activeType = 'calc-slab';

			const totalEl = document.getElementById('calc-total');
			const pureEl = document.getElementById('calc-pure');

			tabs.forEach(tab => {
				tab.addEventListener('click', function(e) {
					e.preventDefault();
					// Reset UI
					tabs.forEach(t => {
						t.style.borderBottom = 'none';
						t.style.color = 'var(--color-dark)';
					});
					panes.forEach(p => p.style.display = 'none');
					
					// Set active
					this.style.borderBottom = '3px solid var(--color-primary)';
					this.style.color = 'var(--color-primary)';
					activeType = this.getAttribute('data-target');
					document.getElementById(activeType).style.display = 'block';
					
					calculate();
				});
			});

			inputs.forEach(input => {
				input.addEventListener('input', calculate);
			});

			function calculate() {
				let pureVolume = 0;

				if (activeType === 'calc-slab') {
					const l = parseFloat(document.getElementById('slab-l').value) || 0;
					const w = parseFloat(document.getElementById('slab-w').value) || 0;
					const h = parseFloat(document.getElementById('slab-h').value) || 0;
					pureVolume = l * w * h;
				} else if (activeType === 'calc-strip') {
					const l = parseFloat(document.getElementById('strip-l').value) || 0;
					const w = parseFloat(document.getElementById('strip-w').value) || 0;
					const h = parseFloat(document.getElementById('strip-h').value) || 0;
					pureVolume = l * w * h;
				} else if (activeType === 'calc-column') {
					const count = parseFloat(document.getElementById('col-count').value) || 0;
					const d = parseFloat(document.getElementById('col-d').value) || 0;
					const h = parseFloat(document.getElementById('col-h').value) || 0;
					const radius = d / 2;
					pureVolume = count * (Math.PI * radius * radius * h);
				}

				const totalVolume = pureVolume * 1.10; // +10%

				pureEl.textContent = pureVolume.toFixed(2);
				totalEl.textContent = totalVolume.toFixed(2);
			}

			// Initial calculation
			calculate();
		});
		</script>
		<?php
	}
}
