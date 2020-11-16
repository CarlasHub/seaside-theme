<?php
/**
 * The template for the Landing page
 *
 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package seaside
 */

get_header();
?>
  <div id="primary" class="content-area">
  <?php get_template_part( 'template-parts/hero'); ?>
        <main id="main" class="site-main">
        <?php get_template_part( 'template-parts/section-about'); ?>
        <?php get_template_part( 'template-parts/section-services'); ?>
        <?php get_template_part( 'template-parts/section-counter'); ?>
        <?php get_template_part( 'template-parts/section-cta'); ?>
        <?php get_template_part( 'template-parts/section-portofolio'); ?>
        <?php get_template_part( 'template-parts/testimonials'); ?>
        <?php get_template_part( 'template-parts/teams'); ?>
        <?php get_template_part( 'template-parts/product-showcase'); ?>

   
        
        </main><!-- #main -->
    </div><!-- #primary -->
  
<?php

get_footer();
