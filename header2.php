<!-- if ( is_front_page() && is_home() ) :
				?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php
			else :
				?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
			endif;
			$xyz_bubble_tea_description = get_bloginfo( 'description', 'display' );
			if ( $xyz_bubble_tea_description || is_customize_preview() ) :
				?>
				<p class="site-description"><?php echo $xyz_bubble_tea_description;  ?></p>
			<?php endif; ?> -->