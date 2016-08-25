<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman About
 */

get_header(); 
$sosmed_url = get_option('social_options','null');
$about_us = get_option('about_us','null');
// print_r($about_us);exit();

$date = date_create();
$date_now = $date->format('Ymd');

$event_list_query = new WP_Query(array(
  'post_status' => 'publish',
  'post_type' => 'event',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'meta_query' => array(
    array(
      'key' => 'event_date',
      'value' => $date_now,
      'compare' => '>'
      ),
  ),
  'posts_per_page' => 3,
  // 'offset' => 4
));
$event_list = $event_list_query->posts;

//Video
$video_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'video',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 1
    ));
$video_list = $video_list_query->posts;
//Video

$gallery_list_query = new WP_Query(array(
  'post_status' => 'publish',
  'post_type' => 'gallery',
  'gallery_type' => 'slide',
  'orderby' => 'post_date',
  'order'   => 'DESC',
));
$gallery = $gallery_list_query->posts;

//Article
$article_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'berita',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 1
    ));
$article_list = $article_list_query->posts;

$imprints_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'imprint',
      'orderby' => 'menu_order',
      'order'   => 'ASC',
      'posts_per_page' => 5
    ));
$imprints_list = $imprints_list_query->posts;
$ig_feed = do_shortcode('[instagram-feed]');
// print_r($article_list);exit();
//Article
?>

<!-- begin top section -->
  <header>
      <div class="top-header">
          <div class="container">
              <div class="pull-left">
                  <a href="/" class="logo"><img src="<?php echo get_template_directory_uri() ?>/img/logo.png" /></a>
              </div>
              <div class="pull-left">
                  <ul class="link-social small">
                      <li>
                          <a href="<?php echo $sosmed_url['facebook']; ?>" class="fb-ico">
                              <i class="fa fa-facebook"></i>
                          </a>
                      </li>
                      <li>
                          <a href="<?php echo $sosmed_url['youtube']; ?>" class="youtube-ico">
                              <i class="fa fa-youtube"></i>
                          </a>
                      </li>
                      <li>
                          <a href="<?php echo $sosmed_url['twitter']; ?>" class="twitter-ico">
                              <i class="fa fa-twitter"></i>
                          </a>
                      </li>
                      <li>
                          <a href="<?php echo $sosmed_url['instagram']; ?>" class="instagram-ico">
                              <i class="fa fa-instagram"></i>
                          </a>
                      </li>
                  </ul>
              </div>
              <div class="pull-right">
              <!-- <input type="search" id="form-search-input" class="form-control" placeholder="Search …" value="" name="s" title="Search for:"> -->
                  <form role="search" method="get" class="search-top" action="/">
                      <input type="search" id="form-search-input" class="form-control" placeholder="Cari..." value="" name="s" title="Search for:" />
                      <button type="submit"><i class="fa fa-search"></i></button>
                  </form>
              </div>
          </div>
      </div>
      <div id="sticky-anchor"></div>
      <nav id="sticky" class="navbar navbar-default navbar-static-top">
           <div class="container">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
              </div>
              <div id="navbar" class="navbar-collapse collapse" aria-expanded="false" style="height: 1px;">
                  <?php
                    wp_nav_menu( array(
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 2,
                        'container'         => 'div',
                        // 'container_class'   => 'collapse navbar-collapse',
                        // 'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker())
                    );
                  ?>
              </div>
              <!--/.nav-collapse -->
          </div> 
          <?php
            // echo  wp_nav_menu(array('echo' => false,'theme_location' => 'primary', 'container' => false, 'container_class' => false, 'menu_class' => 'navigation-list list-unstyled', 'walker' => new BootstrapBasicMyWalkerNavMenu()));
            ?>
      </nav>
  </header>
<!-- end of top section -->

<section id="content">
  <div class="container">
    <div class="book-featured about-us grid-box">
      <div class="row">
        <div class="col-md-12 profil-box">
          <div class="filter clearfix">
            <div class="pull-left">
              <div class="panel-title">
                Profil Perusahaan
              </div>
            </div>
          </div>

          <div class="desc-profile">
            <div class="col-md-12">
                <img src="<?php echo $about_us['ab_img']; ?>" />
            </div><!-- 
            <div class="col-md-8"> -->
              <h3>Kepustakaan Populer Gramedia</h3>
              <h5><?php echo $about_us['visi_misi']; ?></h5>
              <p><?php echo $about_us['history']; ?></p>
            </div>

            <div class="col-md-6">
                <p><?php echo $about_us['join_text']; ?></p>
            </div>
            <div class="col-md-6">
              <p><?php echo $about_us['requirement_about']; ?></p>
            </div>
          </div>
        </div>        

      </div>
    </div>
  </div>
</section>
<section class="map">
    <div class="contact-box">
        <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4212980106186!2d106.79226194987913!3d-6.208030262516109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6b7fa97d783%3A0x38da9b939fa2ce32!2sGedung+Kompas+Gramedia!5e0!3m2!1sen!2sus!4v1464406446171" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</section>
<?php add_action('wp_footer', 'JSforHome'); ?>
<?php get_footer(); ?>
