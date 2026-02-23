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
        // Static block for now based on design.
	}

	/**
	 * Render widget output on the frontend.
	 */
	protected function render() {
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
	}
}
