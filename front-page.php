<?php
/**
 * The template for displaying all pages
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

	<main id="primary" class="site-main-home">

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<?php

		if (function_exists('get_field')){
			?>
			<div class="Banner bg-color">
				<?php
				?>
				<div class="banner-promotion">
					<h1>
					<?php
					the_field('banner_entry');?>
					<span>
					<?php
					the_field('banner_special');?></span></h1>
					<p>
					<?php
					the_field('banner_description');?></p>
					<?php
					$our_drinks_button = get_field('home_to_menu');

					if ($our_drinks_button) {
				
						echo '<div class="our-drinks">';
						echo '<a href="' . esc_url($our_drinks_button) . '" class="button">BROWSE DRINKS</a>';
						echo '</div>';
					}
					?>
				</div>
				<div class="banner-image">
					<?php
						
					$image = get_field('banner_image',31);
					
					$size = 'large'; // (thumbnail, medium, large, full or custom size)
					if( $image ) {
						echo wp_get_attachment_image( $image, $size );
					}
					};?>
				</div>
			</div>
		

		<div class="gallery-button-wrapper bg-color">	
	<?php
	
	if( function_exists('get_field')){
		
		

		if( have_rows('image_gallery') ):
			
			echo '<section class="image-gallery">';
            
            while ( have_rows('image_gallery') ) : the_row();
        
                $image_id = get_sub_field('image_1'); 

                $image = wp_get_attachment_image_src($image_id, 'full');
                
                if (is_array($image) && isset($image[0])) {
                    echo '<img src="' . esc_url($image[0]) . '" alt="' . esc_attr(get_post_meta($image_id, '_wp_attachment_image_alt', true)) . '">';
                }
            endwhile;

            echo '</section>';
		endif;
		
		if( get_field('home_to_menu')){
          $our_drinks_button = get_field('home_to_menu');

			if ($our_drinks_button) {
		
				echo '<div class="our-drinks bg-color">';
				echo '<a href="' . esc_url($our_drinks_button) . '" class="button">BROWSE DRINKS</a>';
				echo '</div>';
			}?>
			</div>
			<?php
			
			echo '<section class="testimonials bg-color">';

			get_template_part( 'template-parts/bbt-testimonial' );

			echo '</section>';
		}

	}
			?>
		
			<?php
		endwhile; // End of the loop.
		?>
		<?php echo do_shortcode('[sp_wpcarousel id="1452"]'); ?>

	</main><!-- #main -->

<?php
get_footer();
