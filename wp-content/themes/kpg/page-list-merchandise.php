<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */
get_header();
$sosmed_url = get_option('social_options','null');
$count_item = wp_count_posts('merchandise');
$publish_count_item = $count_item->publish;
if(!array_key_exists('pages', $_GET)) $_GET['pages'] = 1;
if(!array_key_exists('sortby', $_GET)) $_GET['sortby'] = 'no';
$page = (int) ($_GET['pages'] != '')? $_GET['pages'] : 1;
$pagination = 40;
$current_page = $page-1;
$total_page = floor($publish_count_item/$pagination);
if($publish_count_item%$pagination)
  $total_page++;
$sort_by = ($_GET['sortby'] != '')?$_GET['sortby'] : 'no';
$category = (isset($_GET['cat']))? $_GET['cat'] : 'no';
$terms = get_terms('book_type', array('parent'=>0));

$args = array(
  'post_status' => 'publish',
  'post_type' => 'merchandise',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => $pagination,
  'offset' => $current_page*$pagination
);
if($category != 'no')
  $args['book_type'] = $category;
if($sort_by != 'no'){
  switch ($sort_by) {

    case 'price-asc':    
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'price';
        $args['order'] = 'ASC';
      break;

    case 'price-desc':    
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'price';
        $args['order'] = 'DESC';
      break;

    case 'oldest':    
        $args['orderby'] = 'post_date';
        $args['order'] = 'ASC';
      break;

    case 'newest':    
        $args['orderby'] = 'post_date';
        $args['order'] = 'DESC';
      break;

    case 'asc':
        $args['orderby'] = 'post_title';
        $args['order'] = 'ASC';
      break;

    case 'desc':
        $args['orderby'] = 'post_title';
        $args['order'] = 'DESC';
      break;    

    default:
      # code...
      break;
  }
}

$merchandise_list_query = new WP_Query($args);
if(!empty($merchandise_list_query->posts))
  $merchandise_list = $merchandise_list_query->posts;
// echo "<pre>";;print_r($book_list);exit();
// list buku

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
      <div class="book-featured grid-box">
        <div class="row">
          <!-- filter -->
          <div class="col-md-12">
            <div class="filter clearfix">
              <div class="pull-left">
                  <div class="panel-title">
                    Merchandise
                  </div>
              </div>
              <div class="pull-right">
                  <form>
                      <div class="form-control select-box">
                          <select name="sortby">
                              <option value="">
                                  Urut Berdasarkan
                              </option>
                              <option value="price-asc">
                                  Termurah
                              </option>
                              <option value="price-desc">
                                  Termahal
                              </option>
                              <option value="oldest">
                                  Terlama
                              </option>
                              <option value="newest">
                                  Terbaru
                              </option>
                              <option value="asc">
                                  0-Z
                              </option>
                              <option value="desc">
                                  Z-0
                              </option>
                          </select>
                          <i class="fa fa-caret-down"></i>
                      </div>
                      <div class="form-control select-box ">
                          <select name="cat">
                              <option value="">
                                  Kategori
                              </option>
                              <?php
                                foreach ($terms as $key => $value) {
                                  echo '<option value="'.$value->slug.'">'.$value->name.'</option>';
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
                if(is_array($merchandise_list)):
                $default_merchandise_img =  get_template_directory_uri()."/img/merchandise_default.png";
                foreach ($merchandise_list as $key => $value) {
                  $meta_post = get_post_meta($value->ID);
                  $price = (float)$meta_post['price'][0];
                  $price = 'Rp. ' .number_format($price, 2, '.', ',');
                  // echo "<pre>"; print_r($meta_post);exit();
                  if($meta_post['image'][0]!='')
                  {
                    $cover_id = $meta_post['image'][0];
                    $cover = get_post($cover_id);
                    $image_url = $cover->guid;
                  }
                  else{
                    $image_url =  $default_merchandise_img;
                  }
                  $desc = $value->post_content;
                  if($desc!='')
                  {
                    $desc = wp_trim_words( $value->post_content, 20, '' );
                    $desc = strip_tags($desc);
                  }
              ?>
                <div class="merchandise-item">
                  <a href="<?php echo get_permalink($value->ID); ?>">
                    <span class="cover-img"><img src="<?php echo $image_url; ?>" onerror="this.src='<?php echo $default_merchandise_img; ?>';" /></span>
                    <h2>
                      <?php echo $value->post_title; ?>
                      <br>
                      <?php echo $price; ?>
                    </h2>
                    <p><?php echo $desc; ?></p>
                  </a>
                </div>
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