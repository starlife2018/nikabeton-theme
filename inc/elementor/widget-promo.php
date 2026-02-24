<?php
/**
 * NikaBeton Promo Block Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Promo_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 */
	public function get_name() {
		return 'nikabeton_promo_block';
	}

	/**
	 * Get widget title.
	 */
	public function get_title() {
		return 'Прайс Блок Бетону (NikaBeton)';
	}

	/**
	 * Get widget icon.
	 */
	public function get_icon() {
		return 'eicon-table-of-contents';
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
        // Section: Concrete Production
        $this->start_controls_section(
			'section_concrete',
			[
				'label' => 'Блок: Виробництво Бетону',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'title_concrete',
			[
				'label' => 'Заголовок',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'ВИРОБНИЦТВО ТА ДОСТАВКА БЕТОНУ',
			]
		);

        $this->add_control(
			'price_concrete',
			[
				'label' => 'Ціна акцент',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Від <strong>400 грн/м³</strong>',
			]
		);

        // Repeater for Concrete Classes
        $repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'column_title',
			[
				'label' => 'Заголовок колонки (напр. Підготовчий)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Підготовчий бетон',
			]
		);

        // Item 1
        $repeater->add_control(
			'item1_image',
			[
				'label' => 'Фото Бетону 1',
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
        $repeater->add_control(
			'item1_mark',
			[
				'label' => 'Марка 1 (напр. M100)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'M100',
			]
		);
        $repeater->add_control(
			'item1_desc',
			[
				'label' => 'Клас та Хар-ки 1',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'B7,5 F50',
			]
		);
        $repeater->add_control(
			'item1_link',
			[
				'label' => 'Посилання на сторінку бетону 1',
				'type' => \Elementor\Controls_Manager::URL,
			]
		);

        // Item 2
        $repeater->add_control(
			'item2_image',
			[
				'label' => 'Фото Бетону 2',
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);
        $repeater->add_control(
			'item2_mark',
			[
				'label' => 'Марка 2 (напр. M150)',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'M150',
			]
		);
        $repeater->add_control(
			'item2_desc',
			[
				'label' => 'Клас та Хар-ки 2',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'B12,5 F50',
			]
		);
        $repeater->add_control(
			'item2_link',
			[
				'label' => 'Посилання на сторінку бетону 2',
				'type' => \Elementor\Controls_Manager::URL,
			]
		);

		$this->add_control(
			'concrete_columns',
			[
				'label' => 'Колонки бетону',
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ column_title }}}',
			]
		);

        $this->add_control(
			'btn_text_1',
			[
				'label' => 'Текст кнопки "Отримати прайс"',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Отримати прайс',
			]
		);

        $this->add_control(
			'btn_link_1',
			[
				'label' => 'Посилання кнопки',
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#pricelist',
				],
			]
		);

        $this->end_controls_section();

        // Section: Pump Rent
        $this->start_controls_section(
			'section_rent',
			[
				'label' => 'Блок: Оренда Техніки',
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'image_rent',
			[
				'label' => 'Зображення техніки',
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'title_rent',
			[
				'label' => 'Заголовок',
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => "ОРЕНДА БЕТОНОНАСОСА\nТА СПЕЦТЕХНІКИ",
			]
		);

        $this->add_control(
			'list_rent',
			[
				'label' => 'Список параметрів',
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => '<ul><li>Довжина стріли від <strong>24</strong> до <strong>42</strong> метрів</li><li>Автобетононасоси</li><li>Стаціонарні бетононасоси</li><li>Бетонозмішувачі</li><li>Самоскиди</li><li>Тягачі-маніпулятори</li></ul>',
			]
		);

        $this->add_control(
			'btn_text_2',
			[
				'label' => 'Текст кнопки',
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => 'Отримати прайс',
			]
		);

        $this->add_control(
			'btn_link_2',
			[
				'label' => 'Посилання кнопки',
				'type' => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#pricelist',
				],
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
        <section class="promo-blocks-section py-section">
            <div class="container text-center">
                
                <!-- Part 1: Concrete Production -->
                <div class="promo-concrete mb-5">
                    <h2 class="mb-2" style="font-weight:700;"><?php echo nl2br(esc_html($settings['title_concrete'])); ?></h2>
                    <div class="promo-price-accent mb-4" style="font-size:1.4rem; color:var(--color-primary);"><?php echo wp_kses_post($settings['price_concrete']); ?></div>
                    
                    <?php if ( $settings['concrete_columns'] ) : ?>
                    <div class="promo-concrete-grid" style="display:grid; grid-template-columns: repeat(<?php echo count($settings['concrete_columns']) > 0 ? count($settings['concrete_columns']) : 3; ?>, 1fr); gap: 15px; text-align:center;">
                        
                        <?php foreach ( $settings['concrete_columns'] as $col ) : ?>
                            <div class="promo-col" style="border:1px solid var(--color-border); border-radius:4px; overflow:hidden; display: flex; flex-direction: column;">
                                <div class="promo-col-header" style="background:var(--color-light); padding:10px; font-weight:700; border-bottom:1px solid var(--color-border);">
                                    <?php echo esc_html($col['column_title']); ?>
                                </div>
                                <div class="promo-sub-grid" style="display:grid; grid-template-columns: 1fr 1fr; flex-grow: 1;">
                                    
                                    <!-- Item 1 -->
                                    <div class="promo-item" style="padding:15px; border-right:1px solid var(--color-border); display: flex; flex-direction: column;">
                                        <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd; overflow:hidden;">
                                            <?php if(!empty($col['item1_image']['url'])): ?>
                                                <img src="<?php echo esc_url($col['item1_image']['url']); ?>" style="width:100%; height:100%; object-fit:cover;" alt="<?php echo esc_attr($col['item1_mark']); ?>">
                                            <?php else: ?>
                                                Фото
                                            <?php endif; ?>
                                        </div>
                                        <div style="flex-grow: 1;"><strong><?php echo esc_html($col['item1_mark']); ?></strong><br><?php echo esc_html($col['item1_desc']); ?></div>
                                        <?php if(!empty($col['item1_link']['url'])): ?>
                                            <a href="<?php echo esc_url($col['item1_link']['url']); ?>" class="btn btn-primary mt-3" style="font-size: 0.8rem; padding: 6px 12px; border-radius: 4px; display:inline-block;">Замовити</a>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Item 2 -->
                                    <div class="promo-item" style="padding:15px; display: flex; flex-direction: column;">
                                        <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; margin-bottom:10px; font-size:0.8rem; border:1px dashed #ddd; overflow:hidden;">
                                            <?php if(!empty($col['item2_image']['url'])): ?>
                                                <img src="<?php echo esc_url($col['item2_image']['url']); ?>" style="width:100%; height:100%; object-fit:cover;" alt="<?php echo esc_attr($col['item2_mark']); ?>">
                                            <?php else: ?>
                                                Фото
                                            <?php endif; ?>
                                        </div>
                                        <div style="flex-grow: 1;"><strong><?php echo esc_html($col['item2_mark']); ?></strong><br><?php echo esc_html($col['item2_desc']); ?></div>
                                        <?php if(!empty($col['item2_link']['url'])): ?>
                                            <a href="<?php echo esc_url($col['item2_link']['url']); ?>" class="btn btn-primary mt-3" style="font-size: 0.8rem; padding: 6px 12px; border-radius: 4px; display:inline-block;">Замовити</a>
                                        <?php endif; ?>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                    <?php endif; ?>
                    
                    <div class="mt-4 pb-5" style="border-bottom:1px solid var(--color-light);">
                        <a <?php echo !empty($settings['btn_link_1']['url']) ? 'href="' . esc_url($settings['btn_link_1']['url']) . '"' : ''; ?> class="btn btn-outline-primary open-modal-btn">
                            <?php echo esc_html($settings['btn_text_1']); ?>
                        </a>
                    </div>
                </div>

                <!-- Part 2: Pump Rent -->
                <div class="promo-rent text-left mt-5 pt-3" style="max-width:900px; margin:0 auto;">
                    <div class="grid grid-2 align-center" style="gap:40px;">
                        <div class="promo-rent-image">
                            <?php if(!empty($settings['image_rent']['url'])): ?>
                                <img src="<?php echo esc_url($settings['image_rent']['url']); ?>" alt="Rent" style="max-width:100%; height:auto; border-radius:4px;">
                            <?php else: ?>
                                <div class="promo-img-placeholder" style="aspect-ratio:1/1; background:#f5f5f5; display:flex; align-items:center; justify-content:center; color:#999; border:1px dashed #ddd;">
                                    <span class="text-center">Фото<br>автобетононасос<br>на чистому фоні</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="promo-rent-content">
                            <h2 class="mb-3" style="font-weight:700; font-size:1.6rem;"><?php echo nl2br(esc_html($settings['title_rent'])); ?></h2>
                            <div class="promo-list" style="font-size:1.1rem; line-height:1.6; margin-bottom:20px;">
                                <?php echo wp_kses_post($settings['list_rent']); ?>
                            </div>
                            <a <?php echo !empty($settings['btn_link_2']['url']) ? 'href="' . esc_url($settings['btn_link_2']['url']) . '"' : ''; ?> class="btn btn-outline-primary open-modal-btn">
                                <?php echo esc_html($settings['btn_text_2']); ?>
                            </a>
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
	}
}
