<?php
/**
 * Template Name: Post Full-Width
 * Template Post Type: post, page, product
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package seaside
 */

get_header();
?>

	<main id="primary" class="site-main mt-5">
		 <!-- Page Content -->
		 <div class="container mt-3">

			<div class="row">

			<!-- Post Content Column -->
			<div class="col-lg-12 post-full-width mt-4">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'seaside' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'seaside' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
				</div>
				
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
?>
    
    
