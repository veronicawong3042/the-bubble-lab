<?php
/**
 * The template for displaying the contact page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package XYZ_Bubble_Tea
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			if(function_exists('get_field')){
        if(get_field('contact_description')){
          echo "<p class='contact-description'>".get_field('contact_description')."</p>";
        }
      }
		
			echo do_shortcode('[contact-form-7 id="dde70f5" title="Contact form 1"]');

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->

<?php
get_footer();
