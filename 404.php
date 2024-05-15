<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package XYZ_Bubble_Tea
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'xyz-bubble-tea' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p class='error-page'><?php esc_html_e( 'Sorry, we only sell bubble tea. Please go back to our home or search below and try again!', 'xyz-bubble-tea' ); ?></p>

					<?php
					get_search_form();

					?>

				

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
