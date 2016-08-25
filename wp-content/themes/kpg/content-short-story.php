<?php
/**
 * The theme header
 *
 * @package bootstrap-basic
 * Template Name: Halaman Short Story
 */

get_header(); ?>

<!-- begin top section -->
        <div class="top-inner book">
          <header class="main-header nav-down">
            <div class="container">
              <div class="row">
                <div class="col-md-4 col-sm-1 col-xs-9">
                  <div class="top-logo clearfix">
                    <a href="/" class="bip-logo"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <a href="/" class="logo-white"><img src="<?php echo get_template_directory_uri() ?>/images/logo-white.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <a id="mobMenu" href="#left-menu" class="mobile-icon"><i class="mdi mdi-reorder"></i></a>
                    <h1>bhuana ilmu populer</h1>
                  </div>
                </div>
                <div class="col-md-8 col-sm-11 col-xs-3">
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
                <h3>Short Story</h3>
              </div>
              <div class="breadcrumb">
                <div class="btn-group btn-breadcrumb">
                  <a href="/" class="btn btn-default"><i class="wd wd-home148"></i></a>
                  <a href="" class="btn btn-default active">Short Story</a>
                </div>
              </div>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-md-8 col-md-offset-2 col-sm-12">
                <div class="short-story-top">
                  <span class="medium-circle">
                    <i class="wd wd-draw32"></i>
                  </span>
                  <h3 class="medium-title">We believe that the short story matters.</h3>
                  <p>
                    Welcome to short story section. the short story is one of the most exciting and important literary forms, and that it can, and should, reach the widest possible readership.
                  </p>
                </div>
              </div>
            </div>
          </div>
          <div class="book-list short-story">
              <div class="grid">
              <?php
              $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
              $args = array('post_type' => 'short-story', 'posts_per_page' => 12, 'paged' => $paged);
              query_posts($args);
              if(have_posts()){
                while(have_posts()){
                  the_post();
              ?>
                    <div class="grid-item">
                      <div class="book-item">
                        <div class="book-front">
                          <span class="thumbnail">
                          <?php
                          $image = get_field('image') ;

                          if(file_exists('.'.@$image['url'])) {
                            if(@$image['url']) { ?>
                              <img src="<?php echo @$image['url']; ?>" class="img-responsive" alt="short story">
                            <?php } else { ?>
                              <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg" class="img-responsive" alt="short story">
                            <?php } ?>
                          <?php } else { ?>
                              <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg" class="img-responsive" alt="short story">
                          <?php } ?>
                              <h3><?php the_title(); ?></h3>
                            </span>
                        </div>
                        <div class="book-back">
                          <div class="book-list-info">
                            <div class="book-list-detail">
                              <p>
                              <?php echo wp_trim_words(str_replace('&nbsp;',' ',get_the_content()),60,'...'); ?>
                              </p>
                              <?php
                              $authorid = get_field('author',get_the_ID());
                              ?>
                              <a href="<?php echo get_permalink($authorid->ID); ?>"><i class="wd wd-pencil124 circle-icon"></i> by <?php echo $authorid->post_title; ?></a>
                              <?php                              
                              // }
                              // }
                              ?>
                              <a href="<?php echo get_permalink(); ?>" class="btn btn-default" type="submit">detail</a>
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
              <div class="container">
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
        </div> <!-- end inner page -->

      </div><!-- end main page -->
      <div class="push"></div>
    </div><!-- end wrap page -->

<?php add_action('wp_footer', 'JSforShortStory'); ?>
<?php get_footer(); ?>
