<?php
/**
 * Template Name: Page Flexible Content Layout 
 * Template Type: ACF Flexible Content Layout
 *
 * @package WordPress
 * @subpackage untitled_group
 * @since Untitled Group 1.0
 */

get_header();
?>

<main id="site-content" role="main">
    <section class="home__section">
	<?php

	if ( have_posts() ) {

		while ( have_posts() ) {
			the_post();

			get_template_part( 'template-parts/content', 'global-flex' );
		}
	}

	?>
    </section>

</main><!-- #site-content -->
<?php get_footer(); ?>