
<!-- ======= Product showcase by category ======= -->
<section id="portfolio" class="portfolio">
   <div class="container">

      <div class="section-title" data-aos="fade-in" data-aos-delay="100">
         <h2>Our Products</h2>
         <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>
     
      <div class="row" data-aos="fade-in"> <!-- filters row -->
         <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters"> <!-- filters -->
               <li data-filter="*" class="filter-active">All</li>
               <?php
                  $args = array('post_type' => 'product');
                  $product_categories = get_terms('product_cat', $args);
                  $count = count($product_categories);

                  if ($count > 0) {
                     foreach ($product_categories as $product_category) {
                  ?>
                  <li data-filter=".<?php echo $product_category->name ?>"><?php echo $product_category->name ?></li>
                  <?php
                        }// foreach end
                     }
                  ?>
            </ul><!-- filters end -->
         </div>
      </div><!-- filters row end -->
      
      <div class="row portfolio-container" data-aos="fade-up">

         <?php foreach ($product_categories as $product_category) {
         $args = array('posts_per_page' => - 1, 'tax_query' => array('relation' => 'AND', array('taxonomy' => 'product_cat', 'field' => 'slug',
         'terms' => $product_category->slug)), 'post_type' => 'product', 'orderby' => 'title,');
         $products = new WP_Query($args);
         ?>

       <?php
            while ($products->have_posts()) {
               $products->the_post();
         ?>

         <div class="col-lg-4 col-md-6 portfolio-item <?php echo $product_category->name ?>">
          <div class="portfolio-wrap">
         
               <?php the_post_thumbnail(); ?> 
               <div class="portfolio-links"> 
                  <a href="<?php bloginfo('template_url'); ?>/img/portfolio/portfolio-9.jpg" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="bx bx-plus"></i></a>
                  <a href="<?php echo get_permalink($products->post->ID) ?>" title="More Details"><i class="bx bx-link"></i></a>
               </div> 

            </div><!-- end of portfolio-wrap -->
         </div><!-- end of portofolio item -->

         <?php } ?> <!-- end of while loop -->

         <?php } ?><!-- end of foreach -->
      </div><!-- end of row -->

   </div> <!-- end of container -->
</section><!-- End showcase Section -->