<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */
get_header();
$sosmed_url = get_option('social_options','null');
$count_item = wp_count_posts('video');
$publish_count_item = $count_item->publish;
if(!array_key_exists('pages', $_GET)) $_GET['pages']=1;
$page = (int) ($_GET['pages'] != '')? $_GET['pages'] : 1;
if(!array_key_exists('month', $_GET)) $_GET['month'] = '00';
if(!array_key_exists('y', $_GET)) $_GET['y'] = '0000';
if(!array_key_exists('sortby', $_GET)) $_GET['sortby'] = 'no';
$pagination = 40;
$current_page = $page-1;
$total_page = round($publish_count_item/$pagination);
if($publish_count_item%$pagination)
  $total_page++;
/**
 * determine main column size from actived sidebar
 */
// list buku
$args = array(
  'post_status' => 'publish',
  'post_type' => 'video',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => $pagination,
  'offset' => $current_page*$pagination
);

$category = (isset($_GET['filter']))? $_GET['filter'] : 'no';
if($category != 'no')
  $args['s'] = $category;
$book_list_query = new WP_Query($args);

$book_list_query = new WP_Query($args);
if(!empty($book_list_query->posts))
  $book_list = $book_list_query->posts;
// echo "<pre>";;print_r($book_list);exit();
// list buku
$imprints_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'imprint',
      'orderby' => 'menu_order',
      'order'   => 'ASC',
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
                  <a href="" class="logo"><img src="<?php echo get_template_directory_uri() ?>/img/logo.png" /></a>
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
      <div class="book-featured book-author-list grid-box">
        <div class="row">
          <!-- filter -->
          <div class="col-md-12">
            <div class="filter clearfix">
              <div class="pull-left">
                  <!-- loop imprint -->
                <?php 
                  foreach ($imprints_list as $key => $value) {
                    $logo = get_field('logo',$value->ID);
                    $logo_url = $logo['url'];
                    echo '<a href="'.get_permalink($value->ID).'"><img src="'.$logo_url.'" /></a>';
                  } 
                ?>
                <!-- loop imprint -->
              </div>
              <div class="pull-right">
                <form method="GET">
                    <div class="form-control select-box">
                      <input type="text" class="form-control" name="filter"></input>
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
            <div class="row">
              <ul class="list-unstyled video-list-thumbs row">
              <?php
                if(count($book_list)):
                foreach ($book_list as $key => $value) {
                  $meta_post = get_post_meta($value->ID);
                  $url = get_field('url',$value->ID);
                  $explode_url = explode('embed/', $url);
                  $ytid = end($explode_url);
                  $image_url = 'http://img.youtube.com/vi/'.$ytid.'/0.jpg';
                  $ytimage_url = 'http://img.youtube.com/vi/'.$ytid.'/0.jpg';
                  // print_r($ytid);exit();
                  if($meta_post['photo'][0]!='')
                  {
                    $cover_id = $meta_post['photo'][0];
                    $cover = get_post($cover_id);
                    $image_url = $cover->guid;
                  }
              ?>
                <li class="col-lg-3 col-sm-4 col-xs-6">
                  <a href="<?php echo get_permalink($value->ID); ?>" title="<?php echo $value->post_title; ?>">
                      <img src="<?php echo $image_url; ?>">
                      <h2><?php echo $value->post_title; ?></h2>
                      <img class="play-icon" src="<?php echo get_template_directory_uri(); ?>/img/play-icon.png" onerrror="this.src='<?php echo $ytimage_url; ?>';" />
                  </a>
                </li>
              <?php
                }endif;
              ?>
              </ul>
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
                    echo '<li class="disabled"><a>Last</a></li>';
                  }
                  else{
                    echo '<li><a href="'.get_permalink().'?pages='.($page+1).'"><i class="fa fa-caret-right"></i></a></li>';
                    echo '<li><a rel="next" href="'.get_permalink().'?pages='.$total_page.'">Next</a></li>';
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