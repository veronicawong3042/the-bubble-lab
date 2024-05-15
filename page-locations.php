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
    while (have_posts()) :
        the_post();

        get_template_part('template-parts/content', 'page');

        // Check if ACF function exists to avoid errors if ACF plugin is not active
        if (function_exists('get_field')) {
            // Check if intro_message field exists
            $intro = get_field('intro_message');
            if ($intro) {
                echo "<p class='location-p'>$intro</p>";
            }

            // Check if google_map_test field exists
            $map_markers = array();
            echo "<section class='main-container'>";
            // Check if single_location field exists and has rows
            if (have_rows('single_location')) {
              echo "<section class='cards-container'>";
                while (have_rows('single_location')) {
                    the_row();
                    $location_title = get_sub_field('location_title');
                    $address = get_sub_field('address');
                    $hours = get_sub_field('hours');
                    $image = get_sub_field('image_of_store');
                    $google_maps = get_sub_field('google_maps_location');

                    if ($google_maps) {
                        // Add marker data to the array
                        $map_markers[] = array(
                            'title' => $location_title,
                            'lat' => $google_maps['lat'],
                            'lng' => $google_maps['lng'],
                            'address' => $address
                        );
                    }

                    if ($location_title && $address) {
                        echo "<div class='location-card'>";
                        if ($image) {
                            echo wp_get_attachment_image($image, 'large');
                        }
                        echo "<h3>" . esc_html($location_title) . "</h3>";
                        echo "<p>" . esc_html($address) . "</p>";

                        if (have_rows('hours')) {
                            echo "<div class='location-hours'>";
                            while (have_rows('hours')) {
                                the_row();
                                $day = get_sub_field('day');
                                $time = get_sub_field('time');
                                if ($day && $time) {
                                    echo "<p class='day-time'>$day: $time</p>";
                                }
                            }
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                }
                echo "</section>";
            }

            // Output Google Maps
            if (!empty($map_markers)) {
                ?>
                <div class="acf-map" data-zoom="16">
                    <?php

                    foreach ($map_markers as $marker) {
                      // Construct the Google Maps URL
                        $google_maps_url = "https://maps.google.com/?ll=" . $marker['lat'] . "," . $marker['lng'];
                        // Output marker with clickable link
                        echo "<a href='" . esc_url($google_maps_url) . "' target='_blank' rel='noopener noreferrer'>
                                <div class=\"marker\" data-lat=\"" . esc_attr($marker['lat']) . "\" data-lng=\"" . esc_attr($marker['lng']) . "\" data-title=\"" . esc_attr($marker['title']) . "\">
                                    <h4>" . esc_html($marker['title']) . "</h4>
                                    <p>" . esc_html($marker['address']) . "</p>
                                </div>
                              </a>";              }
                    ?>
                </div>
                <?php
            }
        }
        echo "</section>";
    endwhile;
    ?>
</main><!-- #main -->

<?php
get_footer();
