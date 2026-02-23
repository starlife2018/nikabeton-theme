<?php
/**
 * The template for displaying services archives
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        <header class="page-header bg-white text-dark py-section text-center" style="border-bottom: 1px solid var(--color-border);">
            <div class="container">
                <h1 class="page-title">Наші Послуги</h1>
                <p class="mt-2 text-muted">Професійні послуги з доставки та заливки бетону</p>
            </div>
        </header>

        <div class="container py-content" style="min-height:50vh;">
            <?php if ( have_posts() ) : ?>
                <div class="grid grid-3 services-grid mt-4">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        
                        $price = get_post_meta(get_the_ID(), '_service_price', true);
                        $icon = get_post_meta(get_the_ID(), '_service_icon', true);
                        ?>
                        <div class="service-item hover-scale shadow border-radius overflow-hidden p-4" style="position:relative; background:var(--color-white); text-align:center; transition:var(--transition-speed);">
                            <a href="<?php the_permalink(); ?>" style="display:block; text-decoration:none; color:inherit;">
                                <?php if($icon): ?>
                                    <div class="service-icon mb-3 text-primary" style="font-size:3rem;">
                                        <?php 
                                        // If it's HTML/SVG, echo it directly, if it's a class e.g., 'fa fa-truck', wrap in <i>
                                        if (strpos($icon, '<') !== false) {
                                            echo $icon; // Allows SVG
                                        } else {
                                            echo '<i class="' . esc_attr($icon) . '"></i>'; 
                                        }
                                        ?>
                                    </div>
                                <?php elseif (has_post_thumbnail()) : ?>
                                    <div class="service-image mb-3" style="height: 150px; overflow:hidden; border-radius: var(--border-radius);">
                                        <?php the_post_thumbnail('medium', ['style' => 'width:100%; height:100%; object-fit:cover; display:block;']); ?>
                                    </div>
                                <?php endif; ?>

                                <h3 class="mb-2" style="font-size:1.2rem;"><?php the_title(); ?></h3>
                                
                                <div class="service-excerpt text-muted mb-3" style="font-size:0.9rem;">
                                    <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                                </div>
                                
                                <?php if($price): ?>
                                    <div class="service-price mb-3" style="font-weight:bold; color:var(--color-primary); font-size:1.1rem;">
                                        <?php echo esc_html($price); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <span class="btn btn-outline-primary btn-sm mt-auto" style="display:inline-block;">Детальніше</span>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>

                <div class="pagination mt-5 text-center">
                    <?php the_posts_pagination( array('prev_text' => '←', 'next_text' => '→') ); ?>
                </div>

            <?php else : ?>
                <p class="text-center mt-5">Послуги ще не додані...</p>
            <?php endif; ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
