<?php
/**
 * The theme header
 *
 * @package bootstrap-basic
 */

get_header();
setPostViews(get_the_ID());
?>

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
        <div class="top-description">
          <div class="container">
            <h2><i class="wd wd-crayon3"></i> Welcome to Short story </h2>
          </div>
        </div>
         <!-- begin inner page -->
        <div class="inner-page">
          <div class="inner-top no-margin">
            <div class="container">
              <div class="top-title">
                <h3>Short story</h3>
              </div>
              <div class="breadcrumb">
                <div class="btn-group btn-breadcrumb">
                  <a href="/" class="btn btn-default"><i class="wd wd-home148"></i></a>
                  <a href="" class="btn btn-default active"><?php the_title(); ?></a>
                </div>
              </div>
            </div>
          </div>

          <div class="book-detail">
            <div class="container">
              <div class="col-md-4">
                <div class="book-cover">
                <?php 
                $image = get_field('image');
                if(file_exists('.'.@$image['url'])) {
                  if(@$image['url']) { ?>
                  <img src="<?php echo @$image['url'] ; ?>" alt="short story detail" class="img-responsive">
                  <?php } else { ?>
                  <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg ?>" alt="related book" class="img-responsive">
                  <?php } ?>
                <?php } else { ?>
                  <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg ?>" alt="related book" class="img-responsive">
                <?php } ?>
                </div>
              </div>
              <div class="col-md-8">
              <?php 
              wp_reset_query();
              $authorid = get_field('author',get_post()->ID);
              ?>
                <div class="book-title-split clearfix">
                  <div class="book-main-title">
                    <h3><?php echo get_field('sinopsis_title'); ?></h3>
                    <h5><i class="wd wd-contact10"></i>by <a href="javaascript:;" id="authorBook"><?php echo $authorid->post_title; ?></a></h5>
                  </div>
                  <div class="book-top-cta">
                      <?php
                      $link = get_field('link_short_story');
                      if($link) { ?>
                        <a href="<?php echo $link; ?>" target="_blank" class="btn btn-purple">buy now <i class="wd wd-shopping229"></i></a>
                      <?php } else { ?>
                        <a href="http://www.gramedia.com/catalogsearch/result/?q=<?php echo get_the_title(); ?>&cat=" target="_blank" class="btn btn-purple">buy now <i class="wd wd-shopping229"></i></a>
                      <?php } ?>
                  </div>
                </div>
                <span class="page-divider"></span>
                <div class="book-description short-text">
                  
                    <div id="scrolled" class="short-story-entry">
                    <!-- <h4 class="text-capitalize">Sinopsis</h4> -->
                      <p>
                      <?php echo nl2br(get_post()->post_content); ?>
                      </p>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="book-related">
            <div class="container">
              <div class="row">
                <div class="col-md-8">
                  <div class="author-current">
                    <div class="author-thumb">
                      <div class="author-circle">
                      <?php
                      $photo = get_field('photo',$authorid->ID);
                      if(file_exists('.'.@$photo['url'])) {
                        if(@$photo) { ?>
                        <img src="<?php echo $photo['sizes']['thumbnail']; ?>" class="img-responsive img-circle" alt="author name" width="120px" height="120px">
                        <?php } else { ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/unknown.png" class="img-responsive img-circle" alt="author name" width="120px" height="120px">
                        <?php } ?>
                      <?php } else { ?>
                        <img src="<?php echo get_template_directory_uri() ?>/images/unknown.png" class="img-responsive img-circle" alt="author name" width="120px" height="120px">
                      <?php } ?>
                      </div>
                      <a href="<?php echo get_permalink($authorid->ID); ?>"><?php echo get_the_title($authorid->ID); ?></a>
                      <div class="btn-group" role="group">
                        <a href="<?php echo get_permalink($authorid->ID); ?>" class="btn btn-default"><i class="wd wd-smiling"></i> Author Detail</a>
                        <button type="button" class="btn btn-default" data-toggle="modal" data-target=".author-popup"><i class="wd wd-speech107" ></i> Ask to author</button>
                      </div>
                    </div>
                    <div class="author-short">
                      <h3 class="underline-title"><?php echo get_the_title($authorid->ID); ?> Information</h3>
                      <p>
                      <?php
                      echo wp_trim_words(get_field('about',$authorid->ID),45,'...');
                      ?>
                      </p>
                    </div>
                  </div>
                </div>
                <?php
                //   }
                // }
                ?>
                <div class="col-md-4">
                    <div class="book-option">
                      <div class="book-type">
                        <h4 class="underline-title text-capitalize">Short Story detail</h4>
                        <ul>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Judul:</strong>  <?php the_title(); ?></p>
                          </li>

                          <li>
                            <p><i class="wd wd-list85"></i><strong>Harga:</strong> <?php echo get_field('price'); ?></p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Tebal:</strong> <?php echo get_field('pages'); ?></p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Ukuran:</strong> <?php echo get_field('dimension'); ?></p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Cover:</strong> <?php echo get_field('cover'); ?></p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Kertas isi:</strong> <?php echo get_field('paper'); ?></p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>ISBN/ID ORIN:</strong> <?php echo get_field('isbn'); ?></p>
                          </li>
                        </ul>
                      </div>
                      <div class="book-cta">
                      <?php
                      $link = get_field('link_short_story');
                      if($link) { ?>
                        <a href="<?php echo $link; ?>" target="_blank" class="btn btn-purple">buy now <i class="wd wd-shopping229"></i></a>
                      <?php } else { ?>
                        <a href="http://www.gramedia.com/catalogsearch/result/?q=<?php echo get_the_title(); ?>&cat=" target="_blank" class="btn btn-purple">buy now <i class="wd wd-shopping229"></i></a>
                      <?php } ?>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
            <div class="related-book">
              <div class="container">

                  <h3>related short story</h3>

              </div>
              <div id="relatedBook" class="owl-carousel owl-theme">
              <?php
              $args = array(
                    'post_type' => 'short-story',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                                array(
                                  'key' => 'author',
                                  'value' => $authorid->ID,
                                  'compare' => 'LIKE'
                          )
                  )
              );
              $query = new WP_Query($args);
              if($query->have_posts()){
                while($query->have_posts()){
                  $query->the_post();
              ?>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                    <?php
                    $imej = get_field('image');
                    if(file_exists('.'.@$imej['url'])) {
                      if(@$imej['url']) { ?>
                      <img src="<?php echo @$imej['url']; ?>" alt="related book" class="img-responsive">
                      <?php } else { ?>
                      <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg ?>" alt="related book" class="img-responsive" style="max-height: 500px;">
                      <?php } ?>
                    <?php } else { ?>
                      <img src="<?php echo get_template_directory_uri() ?>/images/no_image_available.jpg ?>" alt="related book" class="img-responsive" style="max-height: 500px;">
                    <?php } ?>
                      <figcaption>
                        <a href="<?php echo get_permalink(); ?>"><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <?php
                }
              }
              wp_reset_query();
                ?>

              </div>
            </div>
          </div>



        </div> <!-- end inner page -->








      </div><!-- end main page -->
      <div class="push"></div>
    </div><!-- end wrap page -->
<?php add_action('wp_footer', 'JSforShortStoryDetail'); ?>
<?php get_footer(); ?>
