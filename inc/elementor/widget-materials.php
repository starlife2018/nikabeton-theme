<?php
/**
 * NikaBeton Materials Grid Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Materials_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_materials_blocks';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Сипучі/ЗБВ (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	/**
	 * Get widget categories.
	 */
	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => 'Налаштування',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_solutions',
			[
				'label' => 'Заголовок Розчинів',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Доставка будівельних розчинів',
			]
		);

		$this->add_control(
			'title_bulk',
			[
				'label' => 'Заголовок Сипучих',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Сипучі Матеріали',
			]
		);

		$this->add_control(
			'title_precast',
			[
				'label' => 'Заголовок ЗБВ',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Бетонні Вироби',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<section class="materials-section py-section">
			<div class="container text-center">
				<?php if ( ! empty( $settings['title_solutions'] ) ) : ?>
					<h2><?php echo esc_html( $settings['title_solutions'] ); ?></h2>
				<?php endif; ?>
				<div class="grid grid-4 mt-3">
					<div class="mat-card border-radius shadow p-3"><h4>Цементний</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
					<div class="mat-card border-radius shadow p-3"><h4>Кладочний</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
					<div class="mat-card border-radius shadow p-3"><h4>Гарцовка</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
					<div class="mat-card border-radius shadow p-3"><h4>Вапняний</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
				</div>
				<a href="/concrete" class="btn-link mt-3" style="display:inline-block;">Перейти в розділ &rarr;</a>

				<?php if ( ! empty( $settings['title_bulk'] ) ) : ?>
					<h2 class="mt-5"><?php echo esc_html( $settings['title_bulk'] ); ?></h2>
				<?php endif; ?>
				<div class="grid grid-2 mt-3" style="max-width:600px; margin-left:auto; margin-right:auto;">
					<div class="mat-card border-radius shadow p-3"><h4>Пісок</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
					<div class="mat-card border-radius shadow p-3"><h4>Щебінь</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
				</div>

				<?php if ( ! empty( $settings['title_precast'] ) ) : ?>
					<h2 class="mt-5"><?php echo esc_html( $settings['title_precast'] ); ?></h2>
				<?php endif; ?>
				<div class="grid grid-4 mt-3 mb-4">
					<div class="mat-card border-radius shadow p-3"><h4>Бетонні Блоки</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
					<div class="mat-card border-radius shadow p-3"><h4>Плити перекриття</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
					<div class="mat-card border-radius shadow p-3"><h4>Кільця</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
					<div class="mat-card border-radius shadow p-3"><h4>Перемички</h4><a href="/#order" class="btn btn-primary btn-sm mt-2 open-modal-btn">Замовити</a></div>
				</div>
			</div>
		</section>
		<?php
	}
}
