<?php
/**
* Template Name: Blog Index
*  
* @package seaside
*/

get_header();




    global $post;

   // makes query respect paging rules
   $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
        
    $myposts = get_posts( array(
        'posts_per_page' => 10,
        'offset'         => 1,
        'category'       => 1,
        'orderby'        => 'date',
        'order'          => 'ASC',
        'paged'          => $paged,
    ) );
    $query = new WP_Query( $myposts );
?>

<div>
      <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark bg-blog">
        <div class="col-md-6 m-auto text-center">
          <h1 class="display-4 font-italic">Title of a longer featured blog post</h1>
          <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what's most interesting in this post's contents.</p>
          <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
        </div>
      </div>
      <div class="container">
        <div class="row mb-2">
            <div class="col-md-6">
              <div class="card">
               <div class="card-header bg-primary  text-white">Featured <i class="icofont-bullseye"></i></div>
                <img class="card-img-top" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/bologna-1.jpg" alt="Bologna">
                <div class="card-body">
                  <h4 class="card-title">Bologna</h4>
                  <h6 class="card-subtitle mb-2 text-muted">Emilia-Romagna Region, Italy</h6>
                  <p class="card-text">It is the seventh most populous city in Italy, at the heart of a metropolitan area of about one million people. </p>
                  <a href="#" class="card-link">Read More</a>
                  <a href="#" class="card-link">Book a Trip</a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-primary  text-white">Featured</div>
              <img class="card-img-top" src="https://s3.eu-central-1.amazonaws.com/bootstrapbaymisc/blog/24_days_bootstrap/bologna-1.jpg" alt="Bologna">
              <div class="card-body">
                <h4 class="card-title">Bologna</h4>
                <h6 class="card-subtitle mb-2 text-muted">Emilia-Romagna Region, Italy</h6>
                <p class="card-text">It is the seventh most populous city in Italy, at the heart of a metropolitan area of about one million people. </p>
                <a href="#" class="card-link">Read More</a>
                <a href="#" class="card-link">Book a Trip</a>
              </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <main role="main" class="container mt-5">
      <div class="row">
        <div class=" blog-index col-md-8">
          <h3 class="pb-3 mb-4 font-italic border-bottom">
          Latest
          </h3>
          <?php
 
            if ( $myposts ) :
                foreach ( $myposts as $post ) :
                setup_postdata( $post ); 
                // categories
                foreach(get_the_category() as $category) {
                   $postSlug =  $category->slug;
                  }
                  // img url 
                  /* grab the url for the full size featured image */
                  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                  $last_update = get_the_modified_date();
                  $date = get_the_date('d-m-Y');
                  $comments_count = get_comments_number();
                ?>
                <div class="card mb-3 mb-4 shadow-sm h-md-250">
                    <div class="row no-gutters">
                      <div class="col-md-8">
                        <div class="card-body">
                          <strong class="d-inline-block mb-2 badge bg-primary mr-2"><?php echo $postSlug ?></strong>
                          <i class="icofont-comment">  <?php echo $comments_count?> </i>
                          <h3 class="mb-0">
                            <a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                          </h3>
                          <span class="mr-2"><img width="30"  height="30" class="img-fluid rounded-circle" src="<?php echo get_avatar_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>"> by <?php echo get_the_author(); ?> </span>
                            <span class="mb-1 text-muted icon-date"> <i class="icofont-clock-time"> <?php echo $last_update ?></i> </span>
                          <p class="card-text m-0 p-0"><?php the_excerpt();?></p>
                          <strong class="d-block color-primary tags m-0 p-0"><?php echo the_tags('', ' ', '')?></strong>
                          <a href="<?php the_permalink(); ?>">Continue reading...</a>
                        </div>
                      </div>
                      <?php if ($post_id % 2 == 0){ ?>
                      <div class="col-md-4 bg-resp" style="background-image: url('<?php echo  esc_url($featured_img_url)?>')"></div>
                      <?php
                      }
                      ?>
                    </div>
                  </div>
               
                <?php

                endforeach;  ?>

               <div class="navigation">
                  <?php next_posts_link( 'Next Page &raquo;', $query->max_num_pages ); ?>
                </div>
                <?php
                wp_reset_postdata();
            endif;

            ?>


        </div><!-- /.blog-index -->

        <aside class="col-md-4 blog-sidebar">
         
          <?php get_sidebar(); ?>
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->
<?php

get_footer();