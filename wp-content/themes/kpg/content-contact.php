<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman Kontak
 */

get_header(); 
$sosmed_url = get_option('social_options','null');
$about_us = get_option('about_us','null');

$date = date_create();
$date_now = $date->format('Ymd');

$general_option = get_option('general_settings','null');
$address = $general_option['address_pubh'];
$address = str_replace(' | ', '<br />', $address);
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
              <div id="navbar" class="navbar-collapse collapse " aria-expanded="false" style="height: 1px;">
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
<section class="map">
    <div class="contact-box">
        <iframe width="100%" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.4212980106186!2d106.79226194987913!3d-6.208030262516109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6b7fa97d783%3A0x38da9b939fa2ce32!2sGedung+Kompas+Gramedia!5e0!3m2!1sen!2sus!4v1464406446171" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</section>
<section id="content">
  <div class="container">
      <div class="row">
        <div class="col-sm-4">
          <div class="side-contact">
            <h3>KPG Office</h3>
            <hr>
            <address>
             <p>
                <?php echo $address;  ?>
            </p>
            </address>
            <a href="" class="btn btn-yellow">KIRIM NASKAH</a>
          </div>
        </div>
        <div class="col-sm-8 contact-form">
          <?php
            if(have_posts()){
              while(have_posts()){
                the_post();

                the_content();
              }
            }
          ?>
        </div>
      </div>
  </div>
</section>
<?php add_action('wp_footer', 'JSforHome'); ?>
<?php get_footer(); ?>
