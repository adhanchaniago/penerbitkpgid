<?php
/**
 * The theme header
 *
 * @package bootstrap-basic
 * Template Name: Halaman Popular Book
 */

get_header(); ?>
<!-- begin top section -->
        <div class="top-inner book">
          <header class="main-header nav-down">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="top-logo clearfix">
                    <a href="/" class="bip-logo"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <a href="/" class="logo-white"><img src="<?php echo get_template_directory_uri() ?>/images/logo-white.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <h1>bhuana ilmu populer</h1>
                  </div>
                </div>
                <div class="col-md-8">
                  <nav class="main-navigation">
                   <?php
echo  wp_nav_menu(array('echo' => false,'theme_location' => 'primary', 'container' => false, 'container_class' => false, 'menu_class' => 'navigation-list list-unstyled', 'walker' => new BootstrapBasicMyWalkerNavMenu()));
?>
                  </nav>
                  <form class="language-option" style="display: none;">
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
                    <?php get_search_form(); ?>
                  </div>
                </div>
              </div>
            </div>
          </header>
        </div><!-- end of top section -->

         <!-- begin inner page -->
        <div class="inner-page">

          <div class="inner-top">
            <div class="container">
              <div class="top-title">
                <h3>Books Page</h3>
              </div>
              <div class="breadcrumb">
                <div class="btn-group btn-breadcrumb">
                  <a href="/" class="btn btn-default"><i class="wd wd-home148"></i></a>
                  <a href="" class="btn btn-default active">Books</a>
                </div>
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">


              <div class="col-md-3 col-sm-4">
                <aside class="bip-sidebar">
                  <div class="outline-sidebar">
                    <div class="iconic-title clarfix">
                      <i class="wd wd-child4"></i>
                      <h3>filter book</h3>
                    </div>
                    <div class="sidebar-content">
                      <a href="/books/" class="btn btn-accent blocking">all books <i class="wd wd-sketched14"></i></a>
                      <a href="/new-arrival/" class="btn btn-accent blocking">new books <i class="wd wd-sketched14"></i></a>
                      <a href="/popular/" class="btn btn-accent blocking">popular books <i class="wd wd-sketched14"></i></a>
                      <a href="/up-coming/" class="btn btn-accent blocking">upcoming books <i class="wd wd-sketched14"></i></a>
                      <!-- <a href="" class="btn btn-purple blocking">reset <i class="wd wd-x13"></i></a> -->
                      <div class="side-icons">
                        <ul>
                          <li>
                            <a href=""><img src="<?php echo get_template_directory_uri() ?>/images/side-icon.png" alt="bip" class="img-responsive"></a>
                          </li>
                          <li>
                            <a href=""><img src="<?php echo get_template_directory_uri() ?>/images/book-side.png" alt="bip" class="img-responsive"></a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </aside>
              </div>
              <div class="col-md-9 col-sm-8">
                <div class="book-list">
                  <div class="grid">
                  <?php
                  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                  $args = array(
                          'post_type' => 'book',
                          'posts_per_page' => 16,
                          'paged' => $paged,
                          'meta_key' => 'post_views_count',
                          'orderby' => 'meta_value_num',
                          'order' => 'DESC',
                    );
                  query_posts($args);
                  if(have_posts()){
                    while(have_posts()){
                      the_post();
                      $authorid = get_field('author',get_the_ID());
                  ?>
                    <div class="grid-item">
                      <div class="book-item">
                        <div class="book-front">
                          <span class="thumbnail">
                          <?php 
                          $fc = get_field('front_cover',get_the_ID());
                          if(file_exists('.'.@$fc['url'])) {
                            if(@$fc['url']) { ?>
                              <img src="<?php echo @$fc['url']; ?>" class="img-responsive" alt="book new release">
                            <?php } else { ?>
                              <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg" class="img-responsive" alt="book new release">
                            <?php } ?>
                          <?php } else { ?>
                              <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg" class="img-responsive" alt="book new release">
                          <?php } ?>
                              <h3><?php the_title(); ?></h3>
                            </span>
                        </div>
                        <div class="book-back">
                          <div class="book-list-info">
                            <div class="book-list-detail">
                              <p>
                              <?php
                              echo wp_trim_words(str_replace('&nbsp;',' ',get_the_content()),30,'...');
                              ?>
                              </p>
                              <a href="<?php echo get_permalink($authorid->ID); ?>"><i class="wd wd-pencil124 circle-icon"></i> by <?php echo $authorid->post_title; ?></a>
                              <a href="<?php echo get_permalink(); ?>" class="btn btn-default">detail</a>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <?php
                    }
                  }
                    ?>
                  </div>
                  <div class="bip-pagination">
                    <div class="circle-page">
                      <span class="circle-iconic"><i class="wd wd-rocket72"></i></span>
                      <ul class="pagination">
                        <li>
                          <?php
                        the_posts_pagination( array(
                                    'mid_size' => 2,
                                    'prev_text' => __( '<<', 'textdomain' ),
                                    'next_text' => __( '>>', 'textdomain' ),
                          ));
                        ?>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>

                </div>
              </div>



          </div>
        </div> <!-- end inner page -->








      </div><!-- end main page -->
      <div class="push"></div>
    </div><!-- end wrap page -->
<?php add_action('wp_footer', 'JSforBook'); ?>
<?php get_footer(); ?>
