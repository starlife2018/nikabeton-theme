<?php
/**
 * The template for displaying a single portfolio project
 *
 * @package NIKABETON
 */

get_header();

$location = get_post_meta(get_the_ID(), '_portfolio_location', true);
$volume = get_post_meta(get_the_ID(), '_portfolio_volume', true);
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
            <div class="container py-section">
                
                <div class="mb-4">
                    <a href="/portfolio/" class="btn-link">&larr; Повернутися до всіх робіт</a>
                </div>

                <div class="grid grid-2">
                    <div class="portfolio-gallery">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('full', ['style' => 'width:100%; height:auto; border-radius:8px;', 'class' => 'shadow']); ?>
                        <?php else: ?>
                            <div class="placeholder-image border-radius" style="height:400px; display:flex; align-items:center; justify-content:center; background:#eee;">Фото об'єкту</div>
                        <?php endif; ?>
                    </div>

                    <div class="portfolio-details p-4 border-radius" style="background:var(--color-light);">
                        <h1 class="mb-3" style="color:var(--color-dark);"><?php the_title(); ?></h1>
                        
                        <div class="project-meta mb-4 mt-4" style="border-top: 1px solid var(--color-border); border-bottom: 1px solid var(--color-border); padding: 15px 0;">
                            <?php if($location): ?>
                                <div class="mb-2"><strong>Локація:</strong> <?php echo esc_html($location); ?></div>
                            <?php endif; ?>
                            
                            <?php if($volume): ?>
                                <div class="mb-2"><strong>Матеріали / Об'єм:</strong> <?php echo esc_html($volume); ?></div>
                            <?php endif; ?>
                            
                            <div class="mb-0"><strong>Дата виконання:</strong> <?php echo get_the_date(); ?></div>
                        </div>

                        <div class="project-content">
                            <h3 class="mb-2">Опис виконаних робіт:</h3>
                            <?php the_content(); ?>
                        </div>
                        
                        <div class="mt-5 text-center">
                            <a href="/#order" class="btn btn-primary" style="font-size:1.1rem; padding: 1rem 2rem;">Потрібний схожий розчин? Замовити!</a>
                        </div>
                    </div>
                </div>
            </div>

			<?php
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
