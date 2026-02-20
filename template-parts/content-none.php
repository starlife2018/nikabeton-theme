<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package NIKABETON
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Ничего не найдено', 'nikabeton' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_search() ) :
			?>
			<p><?php esc_html_e( 'Извините, но по вашему запросу ничего не найдено. Пожалуйста, попробуйте изменить поисковую фразу.', 'nikabeton' ); ?></p>
			<?php
			get_search_form();

		else :
			?>
			<p><?php esc_html_e( 'Кажется, мы не можем найти то, что вы ищете. Возможно, поиск поможет.', 'nikabeton' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
