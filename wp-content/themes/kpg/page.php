<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */
get_header();

/**
 * determine main column size from actived sidebar
 */
$main_column_size = bootstrapBasicGetMainColumnSize();
?> 
<!-- begin top section -->

          <?php 
          if(has_post_thumbnail()){ ?>
          <div class="top-inner book" style="background: url('<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>') top center no-repeat; background-attachment: fixed;">
          <?php }else{ ?>
          <div class="top-inner book">
          <?php } ?>
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

        <div class="container">
	        <div class="row">
	          <div class="col-md-12">
				<div class="col-md-<?php echo $main_column_size; ?> content-area" id="main-column">
					<main id="main" class="site-main default" role="main">
						<?php 

						while (have_posts()) {
							the_post();


							get_template_part('content', 'page');

							echo "\n\n";
							
							// If comments are open or we have at least one comment, load up the comment template
							if (comments_open() || '0' != get_comments_number()) {
								comments_template();
							}

							echo "\n\n";

						} //endwhile;
						?> 
					</main>
				</div>
	          </div>
	        </div>
	    </div>
<?php add_action('wp_footer', 'JSforNews'); ?>
<?php get_footer(); ?> 