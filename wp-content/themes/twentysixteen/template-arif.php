<?php
/**
 * Template Name: Actions
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<form>
		<?php do_action('before_form'); ?>
			<?php

			$args = array(
					'post_type' => 'book',
			);

			$args = apply_filters('modify_args',$args,'textmessage');


			$query = new WP_Query( $args );

			ob_start();

			if($query->have_posts()){

				while ( $query->have_posts() ) : $query->the_post();

					//echo '<h1>' . the_title() . '</h1>';
					echo '<h1><a href="'.get_permalink().'">' . get_the_title() . '</a></h1>';

				endwhile; // end of the loop.
			}

			?>

		<input type="text" name='arif' />
		<input type="submit" name='submit' value='submit' />
		
		<?php do_action('after_form'); ?>
		</form>
	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
