<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 */
get_header();
$sosmed_url = get_option('social_options','null');
$default_url = get_template_directory_uri().'/img/no-image.png';
// detail imprint
$image = get_field('logo');
$image_url = $image['url'];
$att = get_post(get_the_ID());
$banner = get_field('banner');
if($banner=='')
  $banner = get_template_directory_uri().'/img/slider-top.png';
// list books
$args = array(
  'post_status' => 'publish',
  'post_type' => 'book',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'meta_query' => array(
      array(
        'key' => 'imprint_id',
        'value' => get_the_ID(),
        'compare' => 'LIKE'
        ),
    ),
);
$book_list_query = new WP_Query($args);

$publish_count_item = count($book_list_query->posts);

$page = (int) (isset($_GET['pages']))? $_GET['pages'] : 1;
$pagination = 40;
$total_page = floor($publish_count_item/$pagination);
$current_page = $page-1;
if($publish_count_item%$pagination)
  $total_page++;
$sort_by = (isset($_GET['sortby']))?$_GET['sortby'] : 'no';
$category = (isset($_GET['cat']))? $_GET['cat'] : 'no';

$terms = get_terms('book_type', array('parent'=>0));


$args = array(
  'post_status' => 'publish',
  'post_type' => 'book',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'meta_query' => array(
      array(
        'key' => 'imprint_id',
        'value' => get_the_ID(),
        'compare' => 'LIKE'
        ),
    ),
  'posts_per_page' => $pagination,
  'offset' => $current_page*$pagination
);
if($sort_by != 'no'){
  switch ($sort_by) {
    case 'newest':    
        $args['orderby'] = 'post_date';
      break;

    case 'oldest':    
        $args['orderby'] = 'post_date';
        $args['order'] = 'ASC';
      break;

    case 'author':    
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'author';
      break;

    case 'desc':    
        $args['orderby'] = 'post_title';
        $args['order'] = 'DESC';
      break;

    case 'asc':    
        $args['orderby'] = 'post_title';
        $args['order'] = 'ASC';
      break;

    case 'price':    
        $args['orderby'] = 'meta_value_num';
        $args['meta_key'] = 'price';
      break;
    
    default:
      # code...
      break;
  }
}

if($category != 'no')
  $args['book_type'] = $category;
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
<div class="banner-image">
    <img src="<?php echo $banner; ?>" />
</div>
<section id="content">
  <div class="container">
      <div class="book-featured grid-box book-listing">
        <div class="row">
          <!-- detail imprint -->
          <div class="col-md-12 imprint-box imprint-detail clearfix">
            <img src="<?php echo $image_url; ?>" class="pull-left" />
            <h3><?php echo $att->post_title; ?></h3>
            <p><?php echo $att->post_content; ?></p>
          </div>
          <!-- detail imprint -->

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
                              <option value="asc">
                                  0-Z
                              </option>
                              <option value="desc">
                                  Z-0
                              </option>
                              <option value="newest">
                                  Terbaru
                              </option>
                              <option value="oldest">
                                  Terlama
                              </option>
                              <option value="price">
                                  Harga
                              </option>
                              <option value="author">
                                  Penulis
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
            <div class="row" id="grid-container">
            <div class="grid-sizer"></div>
              <?php
                // for ($i=0; $i < 40; $i++) {
                if(count($book_list)):
                foreach ($book_list as $key => $value) {
                  $meta_post = get_post_meta($value->ID);
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
                  $author = get_post($meta_post['author'][0]);
                  $author_name = $author->post_title;
                  $price = "Rp." . number_format($meta_post['price'][0],2,',','.');
                  $desc = $value->post_content;
                  $desc = str_replace("&nbsp;", ' ', $desc);
                  $explode_desc = explode(" ", $desc);
                  $splice_desc = array_splice($explode_desc,0, 20);
                  $desc = implode(" ",$splice_desc);
                  $desc = strip_tags($desc);
              ?>
                <span class="grid-item"><div class="book-item list">
                  <a href="<?php echo get_permalink($value->ID); ?>">
                      <span class="cover"><img src="<?php echo $cover; ?>" onerror="this.src='<?php echo $default_url; ?>';" /></span>
                      <div class="overlay">
                        <div class="cover-small"><img src="<?php echo $thumb_cover; ?>" class="img-grid" oncontextmenu="return false;" onerror="this.src='<?php echo $default_url; ?>';" /></div>
                        <div class="info">
                          <span class="yellow"><?php echo $author_name; ?></span>
                          <span><?php echo $value->post_title; ?></span>
                          <span><b><?php echo $price; ?></b></span>
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