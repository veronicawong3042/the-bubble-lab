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

<main id="primary" class="site-main-about">
	<?php
	while ( have_posts() ) :
		the_post();
	?>
		<div class= "staff-image">
			<?php 
				$our_story_image = get_field('our_story_image', 22); // Get the our story image URL
				$size = 'full'; // (thumbnail, medium, large, full or custom size)

				if ($our_story_image) {
					$our_story_image_id = attachment_url_to_postid($our_story_image); // Get the attachment ID from URL

					if ($our_story_image_id) {
						echo wp_get_attachment_image($our_story_image_id, $size);
					} else {
						echo '<img src="' . esc_url($our_story_image) . '" alt="Our Story Image">';
					}
				}
			?>
		</div>
		<section class="about-body-container">
			<div class="about-body">
				<div class="about-story-container">
					<header class="about-us-header">
						<?php if (function_exists('get_field') && get_field('title_header')) : ?>
							<h1><?php the_field('title_header'); ?></h1>
						<?php endif; ?>
					</header>
					<div class="about-content">
						<p>
						<?php 
						if (get_field('about_us_content')) {
								the_field('about_us_content');
						} 
						?>
						</p>
					</div>
					<div class="our-story">
						<h2>
							<?php 
							if(get_field('our_story_heading')){
								the_field('our_story_heading');
							};
							?>
						</h2>
						<p>
							<?php if (get_field('our_story_content')) {
								the_field('our_story_content');
							} ?>
						</p>
					</div>
				</div>
				<div class= "about-us-image">
				<?php 
					$about_us_image = get_field('about_us_image', 22); // Get the our story image URL
					$size = 'large'; // (thumbnail, medium, large, full or custom size)

					if ($about_us_image) {
						$about_us_image_id = attachment_url_to_postid($about_us_image); // Get the attachment ID from URL

						if ($about_us_image_id) {
							echo wp_get_attachment_image($about_us_image_id, $size);
						} else {
							echo '<img src="' . esc_url($about_us_image) . '" alt="Serving Bubble Teas">';
						}
					}
				?>
				</div>
			</div>
			<div class="ingredients">
				<h2>
					<?php 
					if(get_field('ingredients_header')){
						the_field('ingredients_header');
					};
					?>
				</h2>
				<?php 
				$repeater_rows = get_field('ingredients', 22);
				if ($repeater_rows) {
					foreach ($repeater_rows as $row) {
						$ingredientName = $row['ingredient_name'];
						$ingredientDescription = $row['ingredient_description'];
						$ingredientImageURL = $row['ingredient_image'];
						$ingredientImageID = attachment_url_to_postid($ingredientImageURL); // Get attachment ID from URL
						$ingredientImageSize = "large";
						?>
						<div class="ingredient-card">
							<?php if ($ingredientImageID) : ?>
								<div class="ingredient-image">
									<img src="<?php echo wp_get_attachment_image_src($ingredientImageID, $ingredientImageSize)[0]; ?>" alt="<?php echo $ingredientName; ?>">
								</div>
							<?php endif; ?>
							<div class="ingredient-details">
								<h3><?php echo $ingredientName; ?></h3>
								<p><?php echo $ingredientDescription; ?></p>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</section>
	<?php endwhile;?>
</main><!-- #main -->

<?php
get_footer();