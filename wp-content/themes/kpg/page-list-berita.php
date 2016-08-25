<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */
get_header();
$sosmed_url = get_option('social_options','null');
$count_item = wp_count_posts('berita');
$publish_count_item = $count_item->publish;
$page = (int) (isset($_GET['pages']))? $_GET['pages'] : 1;
// print_r($page);exit();
$pagination = 9;
$current_page = $page-1;
$total_page = round($publish_count_item/$pagination);
if($publish_count_item%$pagination)
  $total_page++;
$sort_by = (isset($_GET['sortby']))?$_GET['sortby'] : 'no';
$category = (isset($_GET['cat']))? $_GET['cat'] : 'no';
if(!array_key_exists('month', $_GET)) $_GET['month'] = '00';
$month = ($_GET['month']=='' && !array_key_exists('month', $_GET))? '00' : str_pad($_GET['month'], 2,'0',STR_PAD_LEFT);
if(!array_key_exists('y', $_GET)) $_GET['y'] = '0000';
$year = ($_GET['y']=='')? '0000' : $_GET['y'];
$date_now = $year.$month;
/**
 * determine main column size from actived sidebar
 */
$terms = get_terms('book_type', array('parent'=>0));
// echo "<pre>"; print_r($terms);exit();

// list buku
$args = array(
  'post_status' => 'publish',
  'post_type' => 'berita',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => $pagination,
  'offset' => $current_page*$pagination
);
if($year!='0000'){
  $args['meta_query'] = array(
    array(
      'key' => 'date',
      'value' => $date_now,
      'compare' => 'LIKE'
      ),
  );
}

$book_list_query = new WP_Query($args);
if(!empty($book_list_query->posts))
  $book_list = $book_list_query->posts;
// list buku
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
      <div class="book-featured grid-box">
        <div class="row">
          <!-- filter -->
          <div class="col-md-12">
            <div class="filter clearfix">
              <div class="pull-left">
                  <div class="panel-title">
                    Berita
                  </div>
              </div>
              <div class="pull-right">
                  <form method="GET">
                      <div class="form-control select-box">
                    <select name="month">
                      <option value="all">Bulan</option>
                      <option value="1">Januari</option>
                      <option value="2">Februari</option>
                      <option value="3">Maret</option>
                      <option value="4">April</option>
                      <option value="5">Mei</option>
                      <option value="6">juni</option>
                      <option value="7">Juli</option>
                      <option value="8">Agustus</option>
                      <option value="9">September</option>
                      <option value="10">Oktober</option>
                      <option value="11">November</option>
                      <option value="12">Desember</option>
                    </select>
                    <i class="fa fa-caret-down"></i>
                  </div>
                  <div class="form-control select-box ">
                    <select name="y">
                        <option value="all">Tahun</option>
                        <?php
                          $max_age = (int) date('Y');
                          $min_age = $max_age - 10;
                          foreach (range($max_age, $min_age) as $year){
                            echo '<option value="'.$year.'">'.$year.'</option>';
                          }
                        ?>
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
            <div class="row">
              <?php
                // for ($i=0; $i < 40; $i++) {
                if(count($book_list)):
                foreach ($book_list as $key => $value) {
                  $meta_post = get_post_meta($value->ID);
                  $quote = $meta_post['author'][0];
                  $desc = wp_trim_words($value->post_content,30,'');
                  $desc = strip_tags($desc);
                  $default_news_img =  get_template_directory_uri()."/img/news_default.png";
                  $img = get_the_post_thumbnail($value->ID,'full');
                  if(!$img)
                    $img = '<img src="'.$default_news_img.'">';
              ?>
                <a href="<?php echo get_permalink($value->ID); ?>">
                <div class="col-md-4">
                  <div class=" whitebox berita-box height-auto">
                    <div class="berita-list">
                      <span class="image">
                        <?php echo $img; ?>
                      </span>
                      <a href="<?php echo get_permalink($value->ID); ?>" class="btn grey-outline border-none no-padding no-margin"><h2 class="margintop-20"><?php echo $value->post_title; ?></h2></a>
                    </div>
                  </div>
                </div>
                </a>
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
                    echo '<li class="disabled"><a>Last</a></li>';
                  }
                  else{
                    echo '<li><a href="'.get_permalink().'?pages='.($page+1).'"><i class="fa fa-caret-right"></i></a></li>';
                    echo '<li><a rel="next" href="'.get_permalink().'?pages='.$total_page.'">Last</a></li>';
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