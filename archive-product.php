<?php
/**
 * The template for displaying product archives
 *
 * @package NIKABETON
 */

get_header();
?>

	<main id="primary" class="site-main">
        <header class="page-header bg-dark text-white py-section text-center">
            <div class="container">
                <?php
                if ( is_post_type_archive('product') ) {
                    echo '<h1 class="page-title">Каталог Продукції та Послуг</h1>';
                } elseif ( is_tax('product_category') ) {
                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                    the_archive_description( '<div class="archive-description mt-2">', '</div>' );
                }
                ?>
            </div>
        </header>

        <div class="container py-content" style="min-height:50vh;">
            <?php if ( have_posts() ) : ?>
                <div class="grid grid-3 products-grid mt-4">
                    <?php
                    while ( have_posts() ) :
                        the_post();
                        
                        $price = get_post_meta(get_the_ID(), '_product_price', true);
                        $application = get_post_meta(get_the_ID(), '_product_application', true);
                        ?>

                        <div class="product-card border-radius shadow">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="product-image"><?php the_post_thumbnail('medium'); ?></div>
                                <?php else: ?>
                                    <div class="product-image placeholder-image text-center" style="line-height:200px; color:#fff;">Фото</div>
                                <?php endif; ?>
                            </a>
                            <div class="product-content p-3 text-center">
                                <h3 class="product-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php if($application): ?>
                                    <p class="product-desc text-sm text-muted mt-2"><?php echo esc_html($application); ?></p>
                                <?php endif; ?>
                                
                                <?php if($price): ?>
                                    <div class="product-price mt-3 mb-3"><strong><?php echo esc_html($price); ?></strong></div>
                                <?php endif; ?>
                                
                                <a href="<?php the_permalink(); ?>" class="btn btn-outline" style="color:var(--color-primary); border-color:var(--color-primary); display:block;">Детальніше</a>
                            </div>
                        </div>

                    <?php endwhile; ?>
                </div>

                <div class="pagination mt-4 text-center">
                    <?php the_posts_pagination( array('prev_text' => '←', 'next_text' => '→') ); ?>
                </div>

            <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
            <?php endif; ?>
        </div>
	</main><!-- #main -->

<?php
get_footer();
