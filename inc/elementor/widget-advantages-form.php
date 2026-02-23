<?php
/**
 * NikaBeton Advantages & Form Block Widget
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Elementor_NikaBeton_Advantages_Form_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'nikabeton_advantages_form';
	}

	public function get_title() {
		return 'Переваги та Форма (NikaBeton)';
	}

	public function get_icon() {
		return 'eicon-columns';
	}

	public function get_categories() {
		return [ 'nikabeton-widgets' ];
	}

	protected function register_controls() {
        // Controls can be added later if needed. For now, it matches the exact design.
	}

	protected function render() {
		?>
        <section class="advantages-form-section py-section">
            <div class="container">
                <div class="grid grid-2" style="gap: 40px; align-items: start;">
                    
                    <!-- Left Column: Advantages -->
                    <div class="advantages-col">
                        <h2 style="font-weight: 700; margin-bottom: 30px;">Чому варто обрати Ніка Бетон</h2>
                        
                        <div class="adv-list">
                            
                            <div class="adv-item" style="display: flex; gap: 15px; margin-bottom: 25px;">
                                <div class="adv-icon" style="font-size: 1.5rem; color: var(--color-dark); margin-top:2px;">★</div>
                                <div class="adv-content">
                                    <h3 style="font-size: 1.2rem; margin-bottom: 5px; font-weight: 700;">30+ років на ринку</h3>
                                    <p style="margin: 0; line-height: 1.4;">Надаємо послуги з виробництва та доставки будматеріалів з 1992 року.</p>
                                </div>
                            </div>
                            
                            <div class="adv-item" style="display: flex; gap: 15px; margin-bottom: 25px;">
                                <div class="adv-icon" style="font-size: 1.5rem; color: var(--color-dark); margin-top:2px;">★</div>
                                <div class="adv-content">
                                    <h3 style="font-size: 1.2rem; margin-bottom: 5px; font-weight: 700;">Власне виробництво бетону</h3>
                                    <p style="margin: 0; line-height: 1.4;">Виготовляємо бетонні суміші, розчини, залізобетонні вироби (ЗБВ).</p>
                                </div>
                            </div>
                            
                            <div class="adv-item" style="display: flex; gap: 15px; margin-bottom: 25px;">
                                <div class="adv-icon" style="font-size: 1.5rem; color: var(--color-dark); margin-top:2px;">★</div>
                                <div class="adv-content">
                                    <h3 style="font-size: 1.2rem; margin-bottom: 5px; font-weight: 700;">Власний автопарк спецтехніки</h3>
                                    <p style="margin: 0; line-height: 1.4;">Надання послуг автобетономіксерів, стаціонарних бетононасосів, автобетононасосів, самоскидів, маніпуляторів для будівництва.</p>
                                </div>
                            </div>
                            
                            <div class="adv-item" style="display: flex; gap: 15px; margin-bottom: 25px;">
                                <div class="adv-icon" style="font-size: 1.5rem; color: var(--color-dark); margin-top:2px;">★</div>
                                <div class="adv-content">
                                    <h3 style="font-size: 1.2rem; margin-bottom: 5px; font-weight: 700;">Доставка по всій Київській області</h3>
                                    <p style="margin: 0; line-height: 1.4;">Постачаємо будівельні матеріали та надаємо послуги оренди бетононасосів у Києві, Вишгороді та всій області.</p>
                                </div>
                            </div>
                            
                            <div class="adv-item" style="display: flex; gap: 15px; margin-bottom: 25px;">
                                <div class="adv-icon" style="font-size: 1.5rem; color: var(--color-dark); margin-top:2px;">★</div>
                                <div class="adv-content">
                                    <h3 style="font-size: 1.2rem; margin-bottom: 5px; font-weight: 700;">Сертифікати якості</h3>
                                    <p style="margin: 0; line-height: 1.4;">Виробництво бетону відповідає ДСТУ України по міцності, щільності і вологості.</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <!-- Right Column: Form -->
                    <div class="form-col text-center">
                        <div style="color: #66b44b; font-size: 1rem; margin-bottom: 5px;">Форма зв'язку</div>
                        <h2 style="font-weight: 700; margin-bottom: 30px;">Зв'яжіться з нами!</h2>
                        
                        <form class="lead-form text-left" action="mailto:vicara8@gmail.com" method="POST" enctype="text/plain" style="max-width: 400px; margin: 0 auto;">
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="adv-name" style="display: block; margin-bottom: 5px;">1. Ваше ім'я</label>
                                <input type="text" id="adv-name" name="name" placeholder="..." required style="width: 100%; border: 1px solid #000; padding: 12px; font-family: inherit;">
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="adv-phone" style="display: block; margin-bottom: 5px;">2. Номер телефону*</label>
                                <input type="tel" id="adv-phone" name="phone" placeholder="..." required style="width: 100%; border: 1px solid #000; padding: 12px; font-family: inherit;">
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="adv-msg" style="display: block; margin-bottom: 5px;">3. Повідомлення</label>
                                <textarea id="adv-msg" name="message" placeholder="..." rows="3" style="width: 100%; border: 1px solid #000; padding: 12px; font-family: inherit; resize: vertical;"></textarea>
                            </div>
                            
                            <div class="form-group text-center" style="margin-top: 30px;">
                                <button type="submit" style="background: transparent; border: none; font-weight: bold; font-size: 1.1rem; cursor: pointer; color: inherit;">Надіслати</button>
                            </div>
                        </form>

                        <!-- Messengers -->
                        <div class="messengers mt-5 mb-4 d-flex justify-content-center align-items-center" style="display: flex; justify-content: center; gap: 20px;">
                            <!-- Viber -->
                            <a href="viber://chat?number=%2B380503824812" target="_blank" style="display:inline-block; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';">
                                <div style="width: 45px; height: 45px; background-color: #7360f2; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                    <svg viewBox="0 0 512 512" style="width: 24px; height: 24px; fill: currentColor;"><path d="M436.4 135c-23.8-31.5-59.5-51.4-100.8-56-30.8-3.4-62.8-1.5-93.5 6.6-47.5 12.6-90 44-116.5 87-21.7 34.6-28.8 77.2-20.7 116.6 6 29 21.6 55.4 44 76 6.3 5.4 9 13.5 7.4 21.6l-10 50.8c-1.6 8.5 7.4 15.3 15.2 11.5l55.8-27.4c7.6-3.7 16.4-3.7 24 0 25 12.4 52.8 19 81.3 19 41.5 0 81-15 112.5-42.5 35.8-31 58.6-76 62.6-125C502.2 220.5 476 172 436.4 135zm-59 131.5c-4 12-19.6 19.3-31 16-11.4-3.3-15-18.7-11-30.7 4-12 19.6-19.3 31-16 11.4 3.3 14.8 18.7 11 30.7z"/></svg>
                                </div>
                            </a>
                            <!-- Telegram -->
                            <a href="https://t.me/NikaBeton" target="_blank" style="display:inline-block; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';">
                                <div style="width: 45px; height: 45px; background-color: #2AABEE; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                    <svg viewBox="0 0 512 512" style="width: 24px; height: 24px; fill: currentColor; margin-right: 2px;"><path d="M473 70l-80 376c-6 26-21 32-43 20l-118-87-57 55c-6 6-12 12-24 12l8-120 219-198c9-8-2-12-14-4l-271 170-117-37c-25-8-26-25 5-37L448 45c21-8 39 5 25 25z"/></svg>
                                </div>
                            </a>
                            <!-- WhatsApp -->
                            <a href="https://wa.me/380503824812" target="_blank" style="display:inline-block; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';">
                                <div style="width: 45px; height: 45px; background-color: #25D366; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white;">
                                    <svg viewBox="0 0 448 512" style="width: 24px; height: 24px; fill: currentColor;"><path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zM224 430.7h-.1c-33.1-.1-65.5-8.9-94-25.7l-6.7-4-69.9 18.3L72 351.1l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.1 0-101.9 82.9-184.8 184.8-184.8 49.3 0 95.7 19.2 130.6 54.1 34.9 34.9 54.1 81.3 54.1 130.7.1 101.9-82.8 184.7-184.8 184.7z"/></svg>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
            <style>
                @media (max-width: 768px) {
                    .advantages-form-section .grid-2 { grid-template-columns: 1fr; gap: 60px !important; }
                }
            </style>
        </section>
		<?php
	}
}
