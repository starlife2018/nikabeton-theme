<?php
/**
 * Template Name: Услуги и Калькулятор
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        <!-- PAGE HEADER -->
        <header class="page-header bg-dark text-white py-section">
            <div class="container text-center">
                <h1 class="page-title"><?php the_title(); ?></h1>
                <?php if (has_excerpt()) : ?>
                    <p class="page-subtitle"><?php echo get_the_excerpt(); ?></p>
                <?php endif; ?>
            </div>
        </header>

        <div class="container py-content">
            <div class="grid grid-2 align-start">
                
                <!-- CONTENT AREA -->
                <div class="page-content-wrapper">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        the_content();
                    endwhile; // End of the loop.
                    ?>

                    <h3 class="mt-4">Прайс-лист (Ориентировочный)</h3>
                    <table class="price-table mt-2">
                        <thead>
                            <tr>
                                <th>Марка бетона (Класс)</th>
                                <th>Цена за м³ (П3, П4)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>М100 (В7.5)</td><td>от 3 800 ₽</td></tr>
                            <tr><td>М150 (В10)</td><td>от 4 000 ₽</td></tr>
                            <tr><td>М200 (В15)</td><td>от 4 200 ₽</td></tr>
                            <tr><td>М250 (В20)</td><td>от 4 400 ₽</td></tr>
                            <tr><td>М300 (В22.5)</td><td>от 4 600 ₽</td></tr>
                            <tr><td>М350 (В25)</td><td>от 4 800 ₽</td></tr>
                        </tbody>
                    </table>
                </div>

                <!-- CALCULATOR SIDEBAR -->
                <aside class="calculator-sidebar bg-light p-4 border-radius">
                    <h3 class="mb-3">Калькулятор объема</h3>
                    <p class="text-sm mb-3">Рассчитайте необходимый объем бетона для вашего фундамента.</p>
                    
                    <form id="concrete-calculator" class="calc-form">
                        <div class="form-row">
                            <label for="calc-length">Длина (м):</label>
                            <input type="number" id="calc-length" step="0.1" min="0" required class="form-control" placeholder="Например, 10">
                        </div>
                        <div class="form-row">
                            <label for="calc-width">Ширина (м):</label>
                            <input type="number" id="calc-width" step="0.1" min="0" required class="form-control" placeholder="Например, 8">
                        </div>
                        <div class="form-row">
                            <label for="calc-depth">Толщина/Глубина (м):</label>
                            <input type="number" id="calc-depth" step="0.05" min="0" required class="form-control" placeholder="Например, 0.3">
                        </div>
                        <div class="form-row">
                            <button type="button" id="calc-btn" class="btn btn-primary btn-full mt-2">Рассчитать</button>
                        </div>
                        
                        <div id="calc-result" class="calc-result mt-3 hidden">
                            <h4>Необходимый объем: <span id="calc-volume" class="text-primary">0</span> м³</h4>
                            <p class="text-xs text-muted mt-1">* Рекомендуем заказывать на 5-10% больше расчетного объема на уплотнение и потери.</p>
                        </div>
                    </form>
                </aside>

            </div>
        </div>
	</main><!-- #main -->

<?php
get_footer();
