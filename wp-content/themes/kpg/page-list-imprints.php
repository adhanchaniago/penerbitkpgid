<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */
get_header();
$sosmed_url = get_option('social_options','null');
$count_item = wp_count_posts('imprint');
$publish_count_item = $count_item->publish;
$page = (int) (isset($_GET['pages']))? $_GET['pages'] : 1;
// print_r($page);exit();
$pagination = 40;
$current_page = $page-1;
$total_page = floor($publish_count_item/$pagination);
if($publish_count_item%$pagination)
  $total_page++;
/**
 * determine main column size from actived sidebar
 */
// echo "<pre>"; print_r($terms);exit();

// list buku
$args = array(
  'post_status' => 'publish',
  'post_type' => 'imprint',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => $pagination,
  'offset' => $current_page*$pagination
);
// if($category != 'no')
//   $args['book_type'] = $category;
$book_list_query = new WP_Query($args);
if(!empty($book_list_query->posts))
  $book_list = $book_list_query->posts;
// list buku

$imprints_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'imprint',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 6
    ));
$imprints_list = $imprints_list_query->posts;

$main_column_size = bootstrapBasicGetMainColumnSize();
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
      <div class="book-featured grid-box book-listing">
        <div class="row">
          <!-- filter -->
          <div class="col-md-12">
            <div class="filter clearfix">
              <div class="pull-right">
                  <form method="GET">
                      <div class="form-control select-box">
                          <select name="sortby">
                              <option value="">
                                  Urut Berdasarkan
                              </option>
                              <option value="newest">
                                  Terbaru
                              </option>
                              <option value="populer">
                                  Terpopuler
                              </option>
                              <option value="author">
                                  Penulis
                              </option>
                              <option value="price">
                                  Harga
                              </option>
                          </select>
                          <i class="fa fa-caret-down"></i>
                      </div>
                      <button type="submit" class="btn btn-yellow">
                          Filter
                      </button>
                  </form>
              </div>
            </div>
          </div>
          <!-- filter -->
          <!-- list buku -->
          <div class="col-md-12">
            <div class="row" id="grid-container">
            <div class="grid-sizer"></div>
              <?php
                // for ($i=0; $i < 40; $i++) {
                if(count($book_list)):
                foreach ($book_list as $key => $value) {
                  $meta_post = get_post_meta($value->ID);
                  $cover = get_template_directory_uri().'/kpg-logo-small.png';
                  if($meta_post['logo'][0] != ''){
                    $front_cover_id = $meta_post['logo'][0];
                    $front_cover = get_post($front_cover_id);
                    $cover = $front_cover->guid;
                  }
                  $desc = $value->post_content;
                  $desc = str_replace("&nbsp;", ' ', $desc);
                  $explode_desc = explode(" ", $desc);
                  $splice_desc = array_splice($explode_desc,0, 10);
                  $desc = implode(" ",$splice_desc);
              ?>
                <span class="grid-item"><div class="book-item list">
                  <a href="<?php echo get_permalink($value->ID); ?>">
                      <span class="cover"><img src="<?php echo $cover; ?>" /></span>
                      <div class="overlay">
                        <!-- <div class="cover-small"><img src="<?php echo $cover; ?>" class="img-grid" oncontextmenu="return false;" /></div> -->
                        <div class="info">
                          <h1 style="text-align: center;"><?php echo $value->post_title; ?></h1>
                        </div>

                        <div class="clear"></div>
                        <div class="desc">
                          <p><?php echo $desc; ?></p>
                          <span class="btn yellow-outline">
                            Selengkapnya
                          </span>
                        </div>
                      </div>
                  </a>
                </div></span>
              <?php
                }endif;
              ?>
            </div>
            <!-- pagination -->
            <div class="page-nation">
              <ul class="pagination pull-right">
                <?php 
                  if($page==1)
                  {
                    echo '<li class="disabled"><span>First</span></li>';
                    // echo '<li class="disabled"><i class="fa fa-caret-left"></i></li>';
                  }
                  else{
                    echo '<li><a href="'.get_permalink().'?pages=1"><span>First</span></a></li>';
                    echo '<li><a href="'.get_permalink().'?pages='.($page-1).'"><i class="fa fa-caret-left"></i></a></li>';
                  }
                 ?>
                <?php
                  $pagination_page = $page+7;
                  if($pagination_page > $total_page)
                    $pagination_page = $total_page;
                  for ($i=$page; $i <= $pagination_page; $i++) { 
                    if($page == $i)
                      echo '<li class="active"><span>'.($i).'</span></li>';
                    else{
                      echo '<li><a href="'.get_permalink().'?pages='.$i.'">'.$i.'</a></li>';
                    }
                  }
                  echo '<li><a href="#">...</a></li>';
                ?>
                <?php
                  if($page==$total_page){
                    echo '<li class="disabled"><a><i class="fa fa-caret-right"></i></a></li>';
                    echo '<li class="disabled"><a>Next</a></li>';
                  }
                  else{
                    echo '<li><a href="'.get_permalink().'?pages='.($page+1).'"><i class="fa fa-caret-right"></i></a></li>';
                    echo '<li><a rel="next" href="#">Next</a></li>';
                  }
                ?>
              </ul>
              <?php  echo '<p class="pull-right">Menampilkan '.$pagination.' dari '.$publish_count_item.'</p>'; ?>
            </div>
            <!-- pagination -->
          </div>
          <!-- list buku -->
        </div>
      </div>
  </div>
</section>
<?php add_action('wp_footer', 'JSforHome'); ?>
<?php get_footer(); ?> 