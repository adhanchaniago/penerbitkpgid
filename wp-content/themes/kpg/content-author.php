<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 */

get_header();
?>

<!-- begin top section -->
        <div class="top-inner book">
          <header class="main-header nav-down">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="top-logo clearfix">
                    <a href="index.html" class="bip-logo"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <a href="index.html" class="logo-white"><img src="<?php echo get_template_directory_uri() ?>/images/logo-white.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <h1>bhuana ilmu populer</h1>
                  </div>
                </div>
                <div class="col-md-8">
                  <nav class="main-navigation">
                    <ul class="navigation-list list-unstyled">
                      <li>
                        <a href="/">home</a>
                      </li>
                      <li>
                        <a href="/new-arrival/">New Arrival</a>
                      </li>
                      <li>
                        <a href="/best-seller">Best Seller</a>
                      </li>
                      <li>
                        <a href="/career/">career</a>
                      </li>
                      <li>
                        <a href="/about/">about</a>
                      </li>
                      <li>
                        <a href="/contact/">contact us</a>
                      </li>
                    </ul>
                  </nav>
                  <form class="language-option">
                    <select class="form-control">
                      <option selected>English</option>
                      <option>Indonesia</option>
                    </select>
                  </form>
                  <a href="#search" class="search-top" role="button" data-toggle="collapse"  aria-expanded="false" aria-controls="search">
                    <span class="wd wd-search67"></span>
                  </a>
                  <a id="leftOverlay" href="#sidr"><i class="wd wd-clipboard96"></i></a>

                  <a id="mobMenu" href="#left-menu">Left Menu</a>
                </div>
              </div>
            </div>
            <div class="main-search collapse" id="search">
              <div class="container">
                <div class="row">
                  <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <form class="form-horizontal">
                      <input type="text" class="form-control" placeholder="search">
                      <button type="submit" class="btn btn-default">Search</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </header>
          
        </div><!-- end of top section -->

         <!-- begin inner page -->
        <div class="inner-page">

          <div class="inner-top no-margin">
            <div class="container">
              <div class="top-title">
                <h3>Author</h3>
              </div>
              <div class="breadcrumb">
                <div class="btn-group btn-breadcrumb">
                  <a href="/" class="btn btn-default"><i class="wd wd-home148"></i></a>
                  <a href="" class="btn btn-default active">Author</a>
                </div>
              </div>
            </div>
          </div>

          <div class="author-page">
            <div class="author-top">
              <div class="container">
                <div class="row">
                  <div class="col-md-4">
                    <h3 class="text-center"><?php echo get_the_title($posts->ID); ?></h3>
                    <div class="author-thumb">
                      <div class="author-circle">
                        <img src="<?php echo get_field('photo',$posts->ID)['sizes']['thumbnail']; ?>" class="img-responsive img-circle" alt="author name" width="120px" height="120px">
                      </div>
                      <button type="button" class="btn btn-white-outline"><i class="wd wd-speech107"></i> Contact</button>
                    </div>
                  </div>
                  <div class="col-md-8">
                    <div class="author-bio">
                      <h3>About <?php echo get_the_title($posts->ID); ?></h3>
                      <p>
                        <?php echo get_field('about',$posts->ID); ?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="author-middle">
              <div class="container">
                <div class="row no-gutters">
                  <div id="authorRecent" class="col-md-4">
                    <div class="book-author-nav">
                      <i class="wd wd-doodle4"></i>
                      <h3>recent books</h3>
                    </div>
                  </div>
                  <div id="authorPopular" class="col-md-4">
                      <div class="book-author-nav">
                        <i class="wd wd-favorites4"></i>
                        <h3>popular books</h3>
                      </div>
                  </div>
                  <div id="authorBest" class="col-md-4">
                    <div class="book-author-nav">
                      <i class="wd wd-smiling"></i>
                      <h3>best seller books</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="author-bottom">
              <div class="container">

                <div class="author-recent">
                  <h3 class="underline-title">recent published by <?php echo get_the_title($posts->ID); ?></h3>
                  <div id="authorRecently" class="author-inner-books">
                  <?php
                         $books = get_posts(array(
                          'post_type' => 'book',
                          'posts_per_page' => 4,
                          'orderby' => 'post_date',
                          'order' => 'DESC',
                          'meta_query' => array(
                            array(
                              'key' => 'author',
                              'value' => '"' . $posts->ID . '"',
                              'compare' => 'LIKE'
                            )
                          )
                         ));

                         if ($books){
                          foreach ($books as $book){
                  ?>
                    <div class="item">
                      <div class="bip-item">
                        <figure class="hovered">
                          <img src="<?php echo get_field('front_cover',$book->ID)['url'] ?>" alt="Owl Image">
                          <figcaption>
                            <h4><?php echo get_the_title($book->ID); ?></h4>
                            <p>
                              <a href="<?php echo get_permalink($book->ID); ?>" class="btn btn-white-outline">more detail</a>
                            </p>
                          </figcaption>
                        </figure>
                      </div>
                    </div>
                  <?php
                    }
                  }
                  ?> 
                  </div>
                </div>

                <div class="author-popular">
                  <h3 class="underline-title">Popular books by <?php echo get_the_title($posts->ID); ?></h3>
                  <div id="PopularAuthor" class="author-inner-books">
                  <?php
                         $books = get_posts(array(
                          'post_type' => 'book',
                          'posts_per_page' => 4,
                          'orderby' => 'post_date',
                          'order' => 'DESC',
                          'meta_query' => array(
                            'relation' => 'AND',
                            array(
                              'key' => 'author',
                              'value' => '"' . $posts->ID . '"',
                              'compare' => 'LIKE'
                            ),
                            array(
                              'key' => 'kategori',
                              'value' => 'new-arrival',
                              'compare' => 'LIKE'
                            )
                          )
                         ));

                         if ($books){
                          foreach ($books as $book){
                  ?>
                    <div class="item">
                      <div class="bip-item">
                        <figure class="hovered">
                          <img src="<?php echo get_field('front_cover',$book->ID)['url'] ?>" alt="Owl Image">
                          <figcaption>
                            <h4><?php echo get_the_title($book->ID); ?></h4>
                            <p>
                              <a href="<?php echo get_permalink($book->ID); ?>" class="btn btn-white-outline">more detail</a>
                            </p>
                          </figcaption>
                        </figure>
                      </div>
                    </div>
                  <?php
                    }
                  }
                  ?> 
                  </div>
                </div>

                <div class="author-best">
                  <h3 class="underline-title">Best books by <?php echo get_the_title($posts->ID); ?></h3>
                  <div id="bestAuthor" class="author-inner-books">
                  <?php
                         $books = get_posts(array(
                          'post_type' => 'book',
                          'posts_per_page' => 4,
                          'orderby' => 'post_date',
                          'order' => 'DESC',
                          'meta_query' => array(
                            'relation' => 'AND',
                            array(
                              'key' => 'author',
                              'value' => '"' . $posts->ID . '"',
                              'compare' => 'LIKE'
                            ),
                            array(
                              'key' => 'kategori',
                              'value' => 'best_seller',
                              'compare' => 'LIKE'
                            )
                          )
                         ));

                         if ($books){
                          foreach ($books as $book){
                  ?>
                    <div class="item">
                      <div class="bip-item">
                        <figure class="hovered">
                          <img src="<?php echo get_field('front_cover',$book->ID)['url'] ?>" alt="Owl Image">
                          <figcaption>
                            <h4><?php echo get_the_title($book->ID); ?></h4>
                            <p>
                              <a href="<?php echo get_permalink($book->ID); ?>" class="btn btn-white-outline">more detail</a>
                            </p>
                          </figcaption>
                        </figure>
                      </div>
                    </div>
                  <?php
                    }
                  }
                  ?> 
                  </div>
                </div>

              </div>
            </div>


          </div>

          


        </div> <!-- end inner page -->








      </div><!-- end main page -->
      <div class="push"></div>
    </div><!-- end wrap page -->
<?php add_action('wp_footer', 'JSforAuthor'); ?>
<?php get_footer(); ?>