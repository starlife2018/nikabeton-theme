<?php
/**
 * The template for displaying concrete product archives (Table View)
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        <header class="page-header bg-dark text-white py-section text-center">
            <div class="container">
                <?php
                if ( is_post_type_archive('concrete') ) {
                    echo '<h1 class="page-title">Прайс-лист на Бетон</h1>';
                } elseif ( is_tax('concrete_type') ) {
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                }
                
                ?>
            </div>
        </header>

        <div class="container py-content" style="min-height:50vh;">
            <?php if ( have_posts() ) : ?>
                <div class="concrete-price-table-wrapper" style="overflow-x:auto;">
                    <table class="concrete-table" style="width:100%; border-collapse: collapse; margin-top: 2rem; text-align: left;">
                        <thead>
                            <tr style="background-color: var(--color-light); border-bottom: 2px solid var(--color-primary);">
                                <th style="padding:1rem;">Найменування</th>
                                <th style="padding:1rem;">Марка (M)</th>
                                <th style="padding:1rem;">Клас (B)</th>                                
                                <th style="padding:1rem;">Морозостійкість (F)</th>
                                <th style="padding:1rem;">Водонепроникність (W)</th>
                                <th style="padding:1rem;">Пластичність (P)</th>
                                <th style="padding:1rem;">Ціна (грн/м³)</th>
                                <th style="padding:1rem;"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ( have_posts() ) :
                            the_post();
                            
                            $price = get_post_meta(get_the_ID(), '_concrete_price', true);
                            $class = get_post_meta(get_the_ID(), '_concrete_class', true);
                            $mark = get_post_meta(get_the_ID(), '_concrete_mark', true);
                            $frost = get_post_meta(get_the_ID(), '_concrete_frost', true);
                            $water = get_post_meta(get_the_ID(), '_concrete_water', true);
                            $plasticity = get_post_meta(get_the_ID(), '_concrete_plasticity', true);
                            ?>
                            <tr style="border-bottom: 1px solid var(--color-border); transition: var(--transition-speed);" onmouseover="this.style.backgroundColor='#f9f9f9';" onmouseout="this.style.backgroundColor='transparent';">
                                <td style="padding:1rem;"><strong><a href="<?php the_permalink(); ?>" style="color:var(--color-dark); text-decoration:none;"><?php the_title(); ?></a></strong></td>
                                <td style="padding:1rem;"><?php echo esc_html($class ? $class : '-'); ?></td>
                                <td style="padding:1rem;"><?php echo esc_html($mark ? $mark : '-'); ?></td>
                                <td style="padding:1rem;"><?php echo esc_html($frost ? $frost : '-'); ?></td>
                                <td style="padding:1rem;"><?php echo esc_html($water ? $water : '-'); ?></td>
                                <td style="padding:1rem;"><?php echo esc_html($plasticity ? $plasticity : '-'); ?></td>
                                <td style="padding:1rem; font-weight:bold; color:var(--color-primary);"><?php echo esc_html($price ? $price : 'За запитом'); ?></td>
                                <td style="padding:1rem; text-align:right;">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">Замовити</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination mt-4 text-center">
                    <?php the_posts_pagination( array('prev_text' => '←', 'next_text' => '→') ); ?>
                </div>

            <?php else : ?>
                <p class="text-center mt-5">Прайс-лист порожній...</p>
            <?php endif; ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
