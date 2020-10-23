<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

?>
<header class="woocommerce-products-header">

<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark bg-blog">
	<div class="col-md-6 m-auto text-center">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php endif; ?>
		<p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
		<p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
	</div>
	<?php
	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	do_action( 'woocommerce_before_main_content' );
	?>
</div>

	<?php


	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<div class="container shop-items">
	<div class="row">
		<div class="col-4">
			<?php
			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			do_action( 'woocommerce_sidebar' );
			?>
		</div><!-- /shop sidebar -->
		<div class="col-8">	
			<!-- <div class="d-flex">	 -->

			<section id="portfolio" class="portfolio">
      			<div class="container">
				<?php
					if ( woocommerce_product_loop() ) {

						/**
						* Hook: woocommerce_before_shop_loop.
						*
						* @hooked woocommerce_output_all_notices - 10
						* @hooked woocommerce_result_count - 20
						* @hooked woocommerce_catalog_ordering - 30
						*/
						do_action( 'woocommerce_before_shop_loop' );
					?>
				</div>
				<?php


                    // Only run on shop archive pages, not single products or other pages
                    if ( is_shop() || is_product_category() || is_product_tag() ) {
                        // Products per page
                        $per_page = 24;
                        if ( get_query_var( 'taxonomy' ) ) { // If on a product taxonomy archive (category or tag)
                            $args = array(
                                'post_type' => 'product',
                                'posts_per_page' => $per_page,
                                'paged' => get_query_var( 'paged' ),
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => get_query_var( 'taxonomy' ),
                                        'field'    => 'slug',
                                        'terms'    => get_query_var( 'term' ),
                                    ),
                                ),
                            );
                        } else { // On main shop page
                            $args = array(
                                'post_type' => 'product',
                                'orderby' => 'date',
                                'order' => 'DESC',
                                'posts_per_page' => $per_page,
                                'paged' => get_query_var( 'paged' ),
                            );
						}
						
                        // Set the query
                        $products = new WP_Query( $args );
						// Standard loop
						?>
						<!-- <ul class="products d-flex  flex-sm-row flex-column flex-wrap list-none"> -->

						<div class="row portfolio-container" data-aos="fade-up">
					<?php

					
						if ( $products->have_posts() ) :

							
					while ( $products->have_posts() ) : $products->the_post();
					//Get product gallery images
					$attachment_ids = $product->get_gallery_image_ids();

					foreach( $attachment_ids as $attachment_id ) {
						$image_link = wp_get_attachment_url( $attachment_id );
					}
				
										
                                ?>
								
								<div class="col-lg-4 col-md-6 portfolio-item filter-app">
									<div class="portfolio-wrap">
										<img src="<?php echo the_post_thumbnail_url(); ?>" class="img-fluid" alt="product thumbnail">
										<div class="portfolio-links">
											<a href="<?php  echo $image_link ?>" data-gall="portfolioGallery" class="venobox w-100" title="Product Gallery"><i class="icofont-eye-alt"></i></a>
										</div>
									</div>
									<a href="<?php echo $product->get_permalink();?>" class="shop-prod-title text-center">
										<h4><?php echo $product->get_name();?></h4>
										<div class="shop-prod-price"><?php echo $product->get_price_html();?></div>
									</a>
									<div class="shop-prod-links">
										<a href="<?php echo   $product->add_to_cart_url() ?>"  data-toggle="tooltip" title="Add to Cart"><i class="bx bx-cart"></i></a>
										<a href="portfolio-details.html" title="Wish List"  data-toggle="tooltip" title="Add to Wishing List"><i class="bx bx-heart"></i></a>
					
									</div>
									
								</div>
								
							
                                <?php
							endwhile;
							?>
							</div>
							<?php
                            wp_reset_postdata();
                        endif;
                    } else { // If not on archive page (cart, checkout, etc), do normal operations
                        woocommerce_content();
                    }
                
					
					woocommerce_product_loop_start();

					if ( wc_get_loop_prop( 'total' ) ) {
						while ( have_posts() ) {
							the_post();
	
							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action( 'woocommerce_shop_loop' );

							wc_get_template_part( 'content', 'product' );
						}
					}

					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action( 'woocommerce_after_shop_loop' );
					} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action( 'woocommerce_no_products_found' );
					}
					?>
					</div>
				</section>
			</div>
	</div><!-- /row -->
</div><!-- /container -->
<?php

get_footer( 'shop' );
