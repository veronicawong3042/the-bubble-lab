<?php
$args = array(
    'post_type'      => 'bbt-testimonial',
    'posts_per_page' => 3
);
 
$query = new WP_Query( $args );
 
if ( $query->have_posts() ){
    while ( $query->have_posts() ) {
        $query->the_post();
        // Retrieve testimonial content from custom fields
        $testimonial_image = get_field('testimonial_image');
        $testimonial_quote = get_field('testimonial_quote');
        $testimonial_author = get_field('testimonial_author');
        $size = 'full';

        echo '<div class="testimonial">';

        if( $testimonial_image ) {
            echo wp_get_attachment_image( $testimonial_image, $size );
        }

        if ($testimonial_quote && $testimonial_author) {
            // Display testimonial quote if available
            echo '<blockquote>' . esc_html($testimonial_quote) . '</blockquote>';
            echo '<p>' . esc_html($testimonial_author) . '</p>';
        }

        echo '</div>';
    }
    wp_reset_postdata();
}
?>