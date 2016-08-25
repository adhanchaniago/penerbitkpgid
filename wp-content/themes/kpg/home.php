<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman Home
 */
$sosmed_url = get_option('social_options','null');

//banner
$sql="SELECT * FROM wp_huge_itslider_images WHERE slider_id = 1 ORDER BY ordering ASC";
$banner_list = $wpdb->get_results($sql);

$sql="SELECT * FROM wp_huge_itslider_images WHERE slider_id = 2 ORDER BY ordering ASC";
$quote_list = $wpdb->get_results($sql);
// echo "<pre>";print_r($banner_list);exit();
//banner
$default_url = get_template_directory_uri().'/img/no-image.png';
// books
$total = 3;
$total_books = 5;
$type_book = array('new_arrival','best_seller','up_coming');
$book_list_type = array();
foreach ($type_book as $key => $value) {
  $book_list = array();
  for ($i=0; $i < $total; $i++) { 
    $offset = $i*5;
    $book_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'book',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'meta_query' => array(
        array(
          'key' => 'kategori',
          'value' => $value,
          'compare' => 'LIKE'
          ),
      ),
      'posts_per_page' => 6,
      'offset' => $offset
    ));
    if(!empty($book_list_query->posts))
      $book_list[] = $book_list_query->posts;
  }
  $book_list_type[$value] = $book_list;
}
$new_book_list = $book_list_type['new_arrival'];
$best_book_list = $book_list_type['best_seller'];
$upcoming_book_list = $book_list_type['up_coming'];
// books

// event
$date = date_create();
$date_now = $date->format('Ymd');
$event_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'event',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      // 'meta_query' => array(
      //   array(
      //     'key' => 'event_date',
      //     'value' => $date_now,
      //     'compare' => '>'
      //     ),
      // ),
      'posts_per_page' => 3
    ));
$event_list = $event_list_query->posts;
// echo "<pre>";print_r($event_list);exit();
// event

//Article
$article_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'berita',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 1
    ));
$article_list = $article_list_query->posts;
//Article

// dari palbar
$palbar_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'palbar',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 1
    ));
$palbar_list = $palbar_list_query->posts;
// dari palbar

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

//kolom penulis
$writing_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'book_author',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 3
    ));
$writing_list = $writing_list_query->posts;
//kolom penulis

//kolom katalog
$catalog_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'catalog',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 1
    ));
$catalog_list = $catalog_list_query->posts;
$ig_feed = do_shortcode('[instagram-feed]');
// print_r($ig_feed);
//kolom katalog

get_header(); 
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
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
              <?php
                for ($i=0; $i < count($banner_list); $i++) { 
                  echo '<li data-target="#carousel-example-generic" data-slide-to="'.$i.'" '.(($i==0)? 'class="active"' : '').'></li>';
                }
              ?>
          </ol>

          <!-- Wrapper for slides -->
          <div class="carousel-inner" role="listbox">
              <?php
                if(count($banner_list)):
                foreach ($banner_list as $key => $value) {
                // for ($i=0; $i < $total; $i++) { 
                
                  echo '<div class="item  '.(($key==0)? 'active': '').'">';
                    if($value->sl_url!=''){
                      echo '<a href="'.$value->sl_url.'"><img src="'.$value->image_url.'" alt="..."></a>';
                    }
                    else{
                      echo '<img src="'.$value->image_url.'" alt="...">';  
                    }
                  echo '</div>';
                }endif;
              ?>
          </div>

          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
              <i class="fa fa-chevron-left"></i>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
              <i class="fa fa-chevron-right"></i>
          </a>
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
        <div class=" row book-featured">

          <div class="panel-ribbon">
              <ul class="nav nav-tabs" role="tablist" id="myTab">
                  <li role="presentation" class="active"><a href="#tab-01" aria-controls="home" r ole="tab" data-toggle="tab">Buku Terbaru</a></li>
                  <li role="presentation"><a href="#tab-02" aria-controls="#tab-02" role="tab" data-toggle="tab">Akan Terbit</a></li>
                  <li role="presentation"><a href="#tab-03" aria-controls="#tab-03" role="tab" data-toggle="tab">Buku Terlaris</a></li>
              </ul>
          </div>

          <div class="tab-content" id="myTabContent">
            <!-- buku baru -->
            <div role="tabpanel" class="tab-pane active" id="tab-01">
                <div class="row">
                  <div class="col-md-12">
                    <div id="Carousel" class="carousel slide">

                      <ol class="carousel-indicators">
                        <?php
                          for ($i=0; $i < count($new_book_list); $i++) { 
                            echo '<li data-target="#Carousel" data-slide-to="'.$i.'" '.(($i==0)? 'class="active"' : '').'></li>';
                          }
                        ?>
                      </ol>

                      <!-- Carousel items -->
                        <div class="carousel-inner">

                        <?php
                          if(count($new_book_list)):
                          foreach ($new_book_list as $key_row => $book_row) {
                          // echo "<pre>"; print_r($value);exit();
                          // for ($i=0; $i < $total; $i++) { 
                         ?>
                          <div class="item <?php echo ($key_row==0)? 'active' : ''; ?>">
                            <div class="row">
                            <?php 
                              // for ($j=0; $j < $total_books ; $j++) {
                              foreach ($book_row as $key_book => $value_book) {  
                                $meta_post = get_post_meta($value_book->ID);
                                $post_att = get_attached_media( 'image', $value_book->ID );
                                $front_cover_id = $meta_post['front_cover'][0];
                                $front_cover = wp_get_attachment_image_src($front_cover_id,'full');
                                $cover = $front_cover[0];
                                if($cover=='')
                                  $cover = $default_url;
                                // print_r($cover);exit();
                                $back_cover_id = $meta_post['front_cover'][0];
                                $back_cover = wp_get_attachment_image_src($back_cover_id,'full');
                                $thumb_cover = $back_cover[0];
                                if($thumb_cover=='')
                                  $thumb_cover = $default_url;
                                // $booktypes = get_the_terms($value_book->ID,'book_type');
                                // echo "<pre>";print_r($thumb_cover);exit();
                                $author = get_post($meta_post['author'][0]);
                                $author_name = $author->post_title;
                                $price = (float)$meta_post['price'][0];
                                $price = 'Rp. ' .number_format($price, 2, '.', ',');
                                $desc = $value_book->post_content;
                                $explode_desc = explode(" ", $desc);
                                $splice_desc = array_splice($explode_desc,0, 5);
                                $desc = implode(" ",$splice_desc);
                                $desc = strip_tags($desc);
                                // $cover = $post_att[key($post_att)]->guid;
                                // $thumb_cover = end($post_att)->guid;
                                $stock = get_field('stock',$value_book->ID);
                            ?>
                              <div class="book-item">
                                <a href="<?php echo get_permalink($value_book->ID); ?>">
                                  <span class="cover"><img src="<?php echo $cover; ?>" onerror="this.src='<?php echo $default_url; ?>';" /></span>
                                  <div class="overlay">
                                    <div class="cover-small"><img src="<?php echo $thumb_cover; ?>" onerror="this.src='<?php echo $default_url; ?>';" /></div>
                                    <div class="info">
                                      <span class="yellow"><?php echo $author_name; ?></span>
                                      <span><?php echo $value_book->post_title; ?></span>
                                      <span><b><?php echo $price; ?></b></span>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="desc">
                                      <p><?php echo $desc; ?>...</p>
                                      <span class="btn yellow-outline">
                                          Selengkapnya
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </div>
                              <?php } ?>

                            </div>
                          </div>
                          <?php }endif; ?>

                        </div>
                      <!-- Carousel items -->
                      <a data-slide="prev" href="#Carousel" class="left carousel-control">‹</a>
                      <a data-slide="next" href="#Carousel" class="right carousel-control">›</a>

                    </div>

                    <div class="clear"></div>
                    <div class="text-center"><a href="/list-books" class="btn blue-outline">Lihat Buku Lainnya</a></div>
                  </div>
                </div>
              </div>
            <!-- buku baru -->
            <!-- buku terlaris -->
            <div role="tabpanel" class="tab-pane" id="tab-03">
                <div class="row">
                  <div class="col-md-12">
                    <div id="Carousel2" class="carousel slide">

                      <ol class="carousel-indicators">
                        <?php
                          for ($i=0; $i < count($best_book_list); $i++) { 
                            echo '<li data-target="#Carousel2" data-slide-to="'.$i.'" '.(($i==0)? 'class="active"' : '').'></li>';
                          }
                        ?>
                      </ol>

                      <!-- Carousel items -->
                        <div class="carousel-inner">

                        <?php
                          if(count($best_book_list)):
                          foreach ($best_book_list as $key_row => $book_row) {
                          // echo "<pre>"; print_r($value);exit();
                          // for ($i=0; $i < $total; $i++) { 
                         ?>
                          <div class="item <?php echo ($key_row==0)? 'active' : ''; ?>">
                            <div class="row">
                            <?php 
                              // for ($j=0; $j < $total_books ; $j++) {
                              foreach ($book_row as $key_book => $value_book) {  
                                $meta_post = get_post_meta($value_book->ID);
                                $post_att = get_attached_media( 'image', $value_book->ID );
                                $front_cover_id = $meta_post['front_cover'][0];
                                $front_cover = wp_get_attachment_image_src($front_cover_id,'full');
                                $cover = $front_cover[0];
                                if($cover=='')
                                  $cover = $default_url;
                                // print_r($cover);exit();
                                $back_cover_id = $meta_post['front_cover'][0];
                                $back_cover = wp_get_attachment_image_src($back_cover_id,'full');
                                $thumb_cover = $back_cover[0];
                                if($thumb_cover=='')
                                  $thumb_cover = $default_url;
                                // $booktypes = get_the_terms($value_book->ID,'book_type');
                                // echo "<pre>";print_r($thumb_cover);exit();
                                $author = get_post($meta_post['author'][0]);
                                $author_name = $author->post_title;
                                $price = (float)$meta_post['price'][0];
                                $price = 'Rp. ' .number_format($price, 2, '.', ',');
                                $desc = $value_book->post_content;
                                $explode_desc = explode(" ", $desc);
                                $splice_desc = array_splice($explode_desc,0, 5);
                                $desc = implode(" ",$splice_desc);
                                $desc = strip_tags($desc);
                                $stock = get_field('stock',$value_book->ID);
                                // $cover = $post_att[key($post_att)]->guid;
                                // $thumb_cover = end($post_att)->guid;
                            ?>
                              <div class="book-item">
                                <a href="<?php echo get_permalink($value_book->ID); ?>">
                                  <span class="cover"><img src="<?php echo $cover; ?>" onerror="this.src='<?php echo $default_url; ?>';" /></span>
                                  <div class="overlay">
                                    <div class="cover-small"><img src="<?php echo $thumb_cover; ?>" onerror="this.src='<?php echo $default_url; ?>';" /></div>
                                    <div class="info">
                                      <span class="yellow"><?php echo $author_name; ?></span>
                                      <span><?php echo $value_book->post_title; ?></span>
                                      <span><b><?php echo $price; ?></b></span>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="desc">
                                      <p><?php echo $desc; ?>...</p>
                                      <span class="btn yellow-outline">
                                          Selengkapnya
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </div>
                              <?php } ?>

                            </div>
                          </div>
                          <?php }endif; ?>

                        </div>
                      <!-- Carousel items -->
                      <a data-slide="prev" href="#Carousel2" class="left carousel-control">‹</a>
                      <a data-slide="next" href="#Carousel2" class="right carousel-control">›</a>

                    </div>

                    <div class="clear"></div>
                    <div class="text-center"><a href="" class="btn blue-outline">Lihat Buku Lainnya</a></div>
                  </div>
                </div>
              </div>
            <!-- buku terlaris -->
            <!-- buku akan terbit -->
            <div role="tabpanel" class="tab-pane" id="tab-02">
                <div class="row">
                  <div class="col-md-12">
                    <div id="Carousel3" class="carousel slide">

                      <ol class="carousel-indicators">
                        <?php
                          for ($i=0; $i < count($upcoming_book_list); $i++) { 
                            echo '<li data-target="#Carousel3" data-slide-to="'.$i.'" '.(($i==0)? 'class="active"' : '').'></li>';
                          }
                        ?>
                      </ol>

                      <!-- Carousel items -->
                        <div class="carousel-inner">

                        <?php
                        if(count($upcoming_book_list)):
                          foreach ($upcoming_book_list as $key_row => $book_row) {
                          // echo "<pre>"; print_r($value);exit();
                          // for ($i=0; $i < $total; $i++) { 
                         ?>
                          <div class="item <?php echo ($key_row==0)? 'active' : ''; ?>">
                            <div class="row">
                            <?php 
                              // for ($j=0; $j < $total_books ; $j++) {
                              foreach ($book_row as $key_book => $value_book) {  
                                $meta_post = get_post_meta($value_book->ID);
                                $post_att = get_attached_media( 'image', $value_book->ID );
                                $front_cover_id = $meta_post['front_cover'][0];
                                $front_cover = wp_get_attachment_image_src($front_cover_id,'full');
                                $cover = $front_cover[0];
                                if($cover=='')
                                  $cover = $default_url;
                                // print_r($cover);exit();
                                $back_cover_id = $meta_post['front_cover'][0];
                                $back_cover = wp_get_attachment_image_src($back_cover_id,'full');
                                $thumb_cover = $back_cover[0];
                                if($thumb_cover=='')
                                  $thumb_cover = $default_url;
                                // $booktypes = get_the_terms($value_book->ID,'book_type');
                                // echo "<pre>";print_r($thumb_cover);exit();
                                $author = get_post($meta_post['author'][0]);
                                $author_name = $author->post_title;
                                $price = (float)$meta_post['price'][0];
                                $price = 'Rp. ' .number_format($price, 2, '.', ',');
                                $desc = $value_book->post_content;
                                $explode_desc = explode(" ", $desc);
                                $splice_desc = array_splice($explode_desc,0, 5);
                                $desc = implode(" ",$splice_desc);
                                $desc = strip_tags($desc);
                                $stock = get_field('stock',$value_book->ID);
                                // $cover = $post_att[key($post_att)]->guid;
                                // $thumb_cover = end($post_att)->guid;
                            ?>
                              <div class="book-item">
                                <a href="<?php echo get_permalink($value_book->ID); ?>">
                                  <span class="cover"><img src="<?php echo $cover; ?>" onerror="this.src='<?php echo $default_url; ?>';" /></span>
                                  <div class="overlay">
                                    <div class="cover-small"><img src="<?php echo $thumb_cover; ?>" onerror="this.src='<?php echo $default_url; ?>';" /></div>
                                    <div class="info">
                                      <span class="yellow"><?php echo $author_name; ?></span>
                                      <span><?php echo $value_book->post_title; ?></span>
                                      <span><b><?php echo $price; ?></b></span>
                                    </div>

                                    <div class="clear"></div>
                                    <div class="desc">
                                      <p><?php echo $desc; ?>...</p>
                                      <span class="btn yellow-outline">
                                          Selengkapnya
                                      </span>
                                    </div>
                                  </div>
                                </a>
                              </div>
                              <?php } ?>

                            </div>
                          </div>
                          <?php }endif; ?>

                        </div>
                      <!-- Carousel items -->
                      <a data-slide="prev" href="#Carousel3" class="left carousel-control">‹</a>
                      <a data-slide="next" href="#Carousel3" class="right carousel-control">›</a>

                    </div>

                    <div class="clear"></div>
                    <div class="text-center"><a href="" class="btn blue-outline">Lihat Buku Lainnya</a></div>
                  </div>
                </div>
              </div>
            <!-- buku akan terbit -->
          </div>
        </div>

          <div class="row clearfix">

            <div class="col-md-4 ">
              <div class="berita-box">
                <div class="panel-title">
                    Dari Palbar
                </div>
                <?php 
                  $value = $palbar_list[0];
                  $desc = $value->post_content;
                  $explode_desc = explode(" ", $desc);
                  $splice_desc = array_splice($explode_desc,0, 20);
                  $desc = implode(" ",$splice_desc);
                  $desc = strip_tags($desc);
                  $image = get_field('image',$value->ID);
                  $image_url = $image['url'];
                ?>
                <div class="berita-list">
                  <span class="image">
                      <img src="<?php echo $image_url; ?>" />
                  </span>
                  <h2><?php echo $value->post_title; ?></h2>
                  <p>
                      <?php echo $desc; ?> <a href="<?php echo get_permalink($value->ID); ?>">Selengkapnya…</a>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-md-4 ">
              <div class="author-box">
                <div id="carousel-author" class="carousel slide" data-ride="carousel">

                  <div class="carousel-inner" role="listbox">
                    <!-- loop -->
                      <?php 
                        foreach ($writing_list as $key => $value) {
                          $desc = get_field('about',$value->ID);
                          $explode_desc = explode(" ", $desc);
                          $splice_desc = array_splice($explode_desc,0, 40);
                          $desc = implode(" ",$splice_desc);
                          // $desc = strip_tags($desc);
                          $image = get_field('photo',$value->ID);
                          $image_url = $image['url'];
                          if($image_url == '')
                            $image_url = get_template_directory_uri().'/img/unknown.png';
                       ?>
                      <div class="item <?php echo ($key==0)? 'active' : ''; ?>">
                        <div class="author-list">
                          <span class="cover-author">
                            <img src="<?php echo $image_url; ?>" />
                          </span>
                          <h2><?php echo $value->post_title; ?></h2>
                          <p>
                              <?php echo $desc; ?> <a href="<?php echo get_permalink($value->ID); ?>">Selengkapnya…</a>
                          </p>
                        </div>
                      </div>
                      <?php } ?>
                    <!-- loop -->
                  </div>
                  <a class="left carousel-control" href="#carousel-author" role="button" data-slide="prev">
                      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                  </a>
                  <a class="right carousel-control" href="#carousel-author" role="button" data-slide="next">
                      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                  </a>
                </div>
              </div>
            </div>

            <div class="col-md-4 ">
              <div class="berita-box">
                  <div class="panel-title">
                      Berita
                  </div>
                  <?php 
                    $value = $article_list[0];
                    $desc = $value->post_content;
                    $explode_desc = explode(" ", $desc);
                    $splice_desc = array_splice($explode_desc,0, 20);
                    $desc = implode(" ",$splice_desc);
                    $desc = strip_tags($desc);
                    $default_news_img =  get_template_directory_uri()."/img/news_default.png";
                    $img = get_the_post_thumbnail($value->ID,'full');
                    if(!$img)
                      $img = '<img src="'.$default_news_img.'">';
                   ?>
                  <div class="berita-list">

                      <span class="image">
                          <?php echo $img; ?>
                      </span>
                      <h2><?php echo $value->post_title; ?></h2>
                      <p>
                        <?php echo $desc; ?> <a href="<?php echo get_permalink($value->ID) ?>">Selengkapnya…</a>
                      </p>
                  </div>
              </div>
            </div>

          </div>

          <div class="row clearfix">
            <div class="col-md-4"><div class="video-box">
              <?php
                if(count($video_list)):
                foreach ($video_list as $key => $value) {
                  $video_meta = get_post_meta($value->ID);
                  $video_url = $video_meta['url'][0].'?autoplay=0';
              ?>
              <div class="video-big">
                <iframe width="100%" height="100%" src="<?php echo $video_url; ?>" frameborder="0" allowfullscreen></iframe>
                <div class="overlay">
                  <div class="panel-title">
                      <?php echo $value->post_title; ?>
                  </div>
                  <h2><?php echo wp_trim_words($value->post_content,20,''); ?></h2>

                  <a href="/list-video" class="btn btn-white">
                     Lihat Video Lainnya
                  </a>
                </div>
                <?php }endif; ?>
              </div>
            </div></div>
            <div class="col-md-4"><div class="event-box">
              <div class="event-list">
                <div class="overlay">
                  <div class="panel-title">
                      Acara Terkini
                  </div>
                  <ul>
                    <?php
                      if(count($event_list)):
                      $default_event_img =  get_template_directory_uri()."/img/kegiatan_default.png";
                      foreach ($event_list as $key => $value) {
                        $event_meta = get_post_meta($value->ID);
                        $event_date = date_create($event_meta['event_date'][0]);
                        // $event_date = $event_date->date;
                        $formated_date = $event_date->format('Y-M-d');
                        $explode_date = explode('-', $formated_date);
                        $year = $explode_date[0];
                        $month = $explode_date[1];
                        $date = $explode_date[2];
                    ?>
                      <li class="clearfix">
                          <div class="date">
                              <span>
                              <?php echo $date; ?>
                              </span>
                              <span>
                              <?php echo $month; ?>
                              </span>
                              <span><?php echo $year; ?></span>
                          </div>
                          <span>
                              <b> <?php echo $value->post_title; ?></b>
                      <?php
                        $desc = $value->post_content;
                        $explode_desc = explode(" ", $desc);
                        $splice_desc = array_splice($explode_desc,0, 20);
                        $desc = implode(" ",$splice_desc);
                        $desc = strip_tags($desc);
                        echo $desc; 
                      ?> 
                          </span>
                      </li>
                    <?php }endif; ?>
                  </ul>
                </div>
              </div>
            </div></div>
            <div class="col-md-4">
              <div class="box-twitter">
                <div class="panel-title clearfix">
                    <a href="" class="twitter-ico">
                        <i class="fa fa-twitter"></i>
                    </a> KPG Twitter
                </div>
                <div class="clear"></div>
                <div class="twitter-timeline">
                <a class="twitter-timeline" href="https://twitter.com/penerbitkpg" data-widget-id="734588603054051328"></a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                </div>
                <div class="panel-title clearfix">
                  <a href="" class="instagram-ico">
                      <i class="fa fa-instagram"></i>
                  </a> KPG Instagram
                </div>
                <div class="clear"></div>
                <div class="carousel slide" data-ride="carousel" id="instagram-01">
                  <?php echo $ig_feed; ?>
                </div>
                <div class="clear"></div>
              </div>

            </div>
          </div>

        <!-- </div> -->
      </div>
  </section>
  <div class="row clearfix">
    <div id="myCarousel" class="quote-carousel carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php 
          for ($i=0; $i < count($quote_list); $i++) { 
            echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.(($i==0)? 'class="active">' : '').'</li>';
          }
         ?>
      </ol>
      <div class="carousel-inner" role="listbox">
        <?php
          foreach ($quote_list as $key => $value) {
            echo '<div class="item '.(($key == 0)? 'active' : '').'">';
              echo '<div class="quotes-box">';
                // echo '<div class="qotd">';
                //   echo '<h3>'.$value->name.'</h3>';
                //   echo '<p>'.$value->description.'</p>';
                // echo '</div>';
                if($value->sl_url!=''){
                  echo '<a href="'.$value->sl_url.'"><img src="'.$value->image_url.'" alt="..."></a>';
                }
                else{
                  echo '<img src="'.$value->image_url.'">';
                }
              echo '</div>';
            echo '</div>';
          }
         ?>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <i class="fa fa-chevron-left"></i>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <i class="fa fa-chevron-right"></i>
      </a>
    </div>
  </div>
<?php add_action('wp_footer', 'JSforHome'); ?>
<?php get_footer(); ?>