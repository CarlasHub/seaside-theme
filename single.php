<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package seaside
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark bg-blog">
			<div class="col-md-6 m-auto text-center">
				<h1 class="display-4 font-italic"><?php  echo get_the_title( $post_id ); ?></h1>
				<p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
			</div>
      	</div>
		 <!-- Page Content -->
		 <div class="container mt-3">

			<div class="row">

			<!-- Post Content Column -->
			<div class="col-lg-8">
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
				<div class="col-md-4">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
?>
    
    
