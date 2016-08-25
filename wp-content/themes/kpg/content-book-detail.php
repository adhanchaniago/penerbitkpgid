<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman Book Detail
 */

get_header(); ?>

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
                        <a href="/book-bhuana-ilmu-popular/">books</a>
                      </li>
                      <li>
                        <a href="/author-bhuana-ilmu-popular/">author</a>
                      </li>
                      <li>
                        <a href="/career-bhuana-ilmu-popular/">career</a>
                      </li>
                      <li>
                        <a href="">about</a>
                      </li>
                      <li>
                        <a href="/contact-bhuana-ilmu-popular/">contact us</a>
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
        <div class="top-description">
          <div class="container">
            <h2><i class="wd wd-educational18"></i> book detail page</h2>
          </div>
        </div>
         <!-- begin inner page -->
        <div class="inner-page">
          <div class="inner-top no-margin">
            <div class="container">
              <div class="top-title">
                <h3>Book detail</h3>
              </div>
              <div class="breadcrumb">
                <div class="btn-group btn-breadcrumb">
                  <a href="#" class="btn btn-default"><i class="wd wd-home148"></i></a>
                  <a href="#" class="btn btn-default">Book</a>
                  <a href="#" class="btn btn-default active">Book title</a>
                </div>
              </div>
            </div>
          </div>

          <div class="book-detail">
            <div class="container">
              <div class="col-md-4">
                <div class="book-cover">
                  <div id="bookSlide" class="book-cover owl-carousel owl-theme">
                    <div class="single-item"><img src="<?php echo get_template_directory_uri() ?>/images/sample-book-cover.jpg" alt="book detail" class="img-responsive"></div>
                    <div class="single-item"><img src="<?php echo get_template_directory_uri() ?>/images/sample-book-cover1.jpg" alt="book detail" class="img-responsive"></div>
                  </div>
                </div>
              </div>
              <div class="col-md-8">
                <h3>book title</h3>
                <h5><i class="wd wd-contact10"></i>by <a href="javaascript:;" id="authorBook">author name</a></h5>
                <span class="page-divider"></span>
                <div class="row no-gutters">
                  <div class="col-md-6">
                    <div class="book-description">
                      <h4 class="text-capitalize">about the book</h4>
                      <p>
                        Vivamus purus ligula, varius in bibendum et, dictum a elit. Proin ultricies lacinia sapien, ut suscipit augue condimentum accumsan. Suspendisse potenti. Ut ornare rhoncus lacus et placerat. Curabitur semper nulla justo, non suscipit tellus ullamcorper at. Fusce egestas, mauris sit amet tincidunt iaculis, purus tellus pulvinar turpis, at blandit ante orci non sapien. Cras ultrices at nibh sit amet aliquam. Aenean tincidunt eleifend suscipit. Sed massa nibh, ultricies in libero nec, ultricies sagittis sem. Fusce vel blandit enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.<br><br>
                        at blandit ante orci non sapien. Cras ultrices at nibh sit amet aliquam. Aenean tincidunt eleifend suscipit. Sed massa nibh, ultricies in libero nec, ultricies sagittis sem. Fusce vel blandit enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                      </p>

                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="book-option">
                      <div class="book-type">
                        <h4 class="text-capitalize">book detail</h4>
                        <ul>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Format:</strong> Paperback</p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Publisher:</strong> Name of publisher</p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>Section:</strong> Kids book</p>
                          </li>
                          <li>
                            <p><i class="wd wd-list85"></i><strong>ISBN:</strong> 1234541439549 </p>
                          </li>
                        </ul>
                      </div>
                      <div class="book-cta">
                        <a href="" class="btn btn-purple">buy now <i class="wd wd-shopping229"></i></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="book-related">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <div class="author-current">
                    <div class="author-thumb">
                      <div class="author-circle">
                        <img src="<?php echo get_template_directory_uri() ?>/images/author.jpg" class="img-responsive img-circle" alt="author name">
                      </div>
                      <a href="">author name</a>
                      <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default"><i class="wd wd-smiling"></i> Author Detail</button>
                        <button type="button" class="btn btn-default"><i class="wd wd-speech107"></i> Ask to author</button>
                      </div>
                    </div>
                    <div class="author-short">
                      <h3>Author Information</h3>
                      <p>
                        Vivamus scelerisque fringilla consectetur. Donec eu mauris velit. Aenean tempus venenatis enim ac volutpat. Fusce felis mi, dictum et erat sit amet, dictum porta neque. Nullam in nisl vel nulla accumsan laoreet. Ut et nulla est. Nunc ut ligula non arcu vestibulum porta non quis mi. Vivamus id cursus
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="author-current">
                    <h3>additional author information</h3>
                    <div class="tabbable tabs-left">
                      <ul class="nav nav-tabs">
                        <li><a href="#auhtorFirst" data-toggle="tab">Overview</a></li>
                        <li><a href="#auhtorSecond" data-toggle="tab">Activity</a></li>
                        <li class="active"><a href="#auhtorThird" data-toggle="tab">Published</a></li>
                      </ul>
                      <div class="tab-content">
                       <div class="tab-pane" id="auhtorFirst">Other author overview  Vivamus scelerisque fringilla consectetur. Donec eu mauris velit. Aenean tempus venenatis enim ac volutpat. Fusce felis mi, dictum et erat sit amet, dictum porta neque.</div>
                       <div class="tab-pane" id="auhtorSecond">author has published 123 books since 2014 and Vivamus scelerisque fringilla consectetur. Donec eu mauris velit. Aenean tempus venenatis enim ac volutpat. Fusce felis mi, dictum et erat sit amet</div>
                       <div class="tab-pane active" id="auhtorThird">
                         <div class="author-publish-book">
                          <div class="publish-item">
                            <a href="">
                              <img src="<?php echo get_template_directory_uri() ?>/images/sample.jpg" alt="" class="img-responsive">
                            </a>
                          </div>
                          <div class="publish-item">
                            <a href="">
                              <img src="<?php echo get_template_directory_uri() ?>/images/sample.jpg" alt="" class="img-responsive">
                            </a>
                          </div>
                          <div class="publish-item">
                            <a href="">
                              <img src="<?php echo get_template_directory_uri() ?>/images/sample.jpg" alt="" class="img-responsive">
                            </a>
                          </div>
                          <div class="publish-item">
                            <a href="">
                              <img src="<?php echo get_template_directory_uri() ?>/images/sample.jpg" alt="" class="img-responsive">
                            </a>
                          </div>
                         </div>
                       </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="related-book">
              <div class="container">
               
                  <h3>related book</h3>
               
              </div>
              <div id="relatedBook" class="owl-carousel owl-theme">
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample2.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample3.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                 <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample4.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample3.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample2.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample2.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample3.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                 <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample4.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample3.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                <div class="related-item">
                  <div class="bip-item">
                    <figure class="boxed">
                      <img src="<?php echo get_template_directory_uri() ?>/images/related-book-sample2.jpg" alt="related book" class="img-responsive">
                      <figcaption>
                        <a href=""><i class="wd wd-transit11"></i> more detail</a>
                      </figcaption>
                    </figure>
                  </div>
                </div>
                
              </div>
            </div>
          </div>



        </div> <!-- end inner page -->








      </div><!-- end main page -->
      <div class="push"></div>
    </div><!-- end wrap page -->
<?php add_action('wp_footer', 'JSforBookDetail'); ?>
<?php get_footer(); ?>