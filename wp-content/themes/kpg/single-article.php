<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman Book Detail
 */

get_header(); 
$sosmed_url = get_option('social_options','null');
setPostViews(get_the_ID());
$att = get_post(get_the_ID());
$meta = get_post_meta(get_the_ID());
$comments = get_comments( array(
  'post_id' => get_the_ID(),
  'number' => 100
));
$event_date = get_field('date');
$date = date_create($event_date);
$array_day = array(
  'Monday' => 'Senin',
  'Tuesday' => 'Selasa',
  'Wednesday' => 'Rabu',
  'Thursday' => 'Kamis',
  'Friday' => 'Jumat',
  'Saturday' => 'Sabtu',
  'Sunday' => 'Minggu',
  );
$day = $date->format('l');
$formated_date = $date->format('j M Y');
$article_date = $array_day[$day].', '.$formated_date;
$count_comment = count($comments);

$video_meta = get_post_meta(get_the_ID());
setPostViews(get_the_ID());
// $terms = get_the_terms($att->ID,'book_type');
$author_list_query = new WP_Query(array(
    'post_status' => 'publish',
    'post_type' => 'book_author',
    'orderby' => 'post_date',
    'order'   => 'DESC',
    'posts_per_page' => 1,
    'post__not_in' => array(get_the_ID())
));
$book_authors = $author_list_query->posts;
// echo "<pre>";print_r($authors);print_r($meta);exit();

// $date = date_create();
if(!array_key_exists('month', $_GET)) $_GET['month'] ='00';
if(!array_key_exists('y', $_GET)) $_GET['y'] ='0000';
$month = ($_GET['month']=='')? '00' : str_pad($_GET['month'], 2,'0',STR_PAD_LEFT);
$year = ($_GET['y']=='')? '0000' : $_GET['y'];
$date_now = $year.$month.'00';
$event_arg = array(
  'post_status' => 'publish',
  'post_type' => 'article',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => 4,
);
if($year!='0000'){
  $event_arg['meta_query'] = array(
    array(
      'key' => 'date',
      'value' => $date_now,
      'compare' => '>'
      ),
  );
}
$event_list_query = new WP_Query($event_arg);
$other_event_list = $event_list_query->posts;
// print_r($other_event_list);

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

$new_book_list_query = new WP_Query(array(
  'post_status' => 'publish',
  'post_type' => 'book',
  'meta_query' => array(
    array(
      'key' => 'kategori',
      'value' => 'new_arrival',
      'compare' => 'LIKE'
      ),
  ),
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => 1
));
$new_book = $new_book_list_query->posts;
//Article
$article_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'article',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 3,
      'post__not_in' => array(get_the_ID())
    ));
$article_list = $article_list_query->posts;
// print_r($article_list);exit();
//Article
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
    <div class="clearfix row">
      <div class="col-md-8">
        <div class="whitebox berita-box height-auto margintop-min15">
          <div class="row">
            <div class="col-md-12">
              <div class="panel-title left-title">
                Artikel
              </div>
              <h2 class="main-title"><?php echo $att->post_title; ?></h2>
              <p class="date-news"><?php echo $article_date; ?></p>
              <?php echo get_the_post_thumbnail(get_the_ID(),'full'); ?>

              <div class="description">
                <p><?php echo $att->post_content; ?></p>
                <hr>
                <div class="center">
                  <h5>Share this Article:</h5>
                  <div class="join-social share-article no-margin">
                    <a href="" class="fb-btn"><i class="fa fa-facebook" oncontextmenu="return false;" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['HTTP_HOST'].get_permalink(); ?>', 'newwindow', 'width=300, height=250');"></i></a>
                    <a href="" class="twitter-btn"><i class="fa fa-twitter" onclick="window.open('https://twitter.com/share', 'newwindow', 'width=400, height=350');" data-count="none"></i></a>
                    <a href="http://pinterest.com/pin/create/button/?url=<?php echo $_SERVER['HTTP_HOST'].get_permalink(); ?>%2f&description=Static%20social%20media%20%22share%22%20buttons&media=<?php echo $_SERVER['HTTP_HOST'].$front_cover_url; ?>" target="_blank" class="pinterest-btn"><i class="fa fa-pinterest"></i></a>
                    <a href="whatsapp://send?text=You must look this!" class="whatsapp-btn"><i class="fa fa-whatsapp"></i></a>
                  </div>
                </div>
                <div class="panel-title margintop-50">
                  Artikel Terkait
                </div>
                <ul class="more-article clearfix row">
                  <!-- loop -->
                    <?php
                      foreach ($article_list as $key => $value) {
                    ?>
                    <li class="clearfix berita-list col-md-4">
                      <div class="clearfix box-img"><?php echo get_the_post_thumbnail($value->ID,'full'); ?></div>
                      <div class="clearfix box-info">
                          <h2><?php echo $value->post_title; ?></h2>
                          <p>
                              <?php echo strip_tags(wp_trim_words($value->post_content,15,'')); ?>
                          </p>
                      </div>
                    </li>
                    <?php } ?>
                  <!-- loop -->
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="whitebox berita-box height-auto">
          <div class="panel-title">
              Pembicaraan
          </div>
          <div class="comment-list text-left margintop-30">
            <div class="clearfix">
              <h2 class="pull-left"><?php echo $count_comment; ?> Comments</h2>
              <div class="pull-right">
                <span>Urut Berdasarkan:</span>
                <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                    Komentar Terbaru
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                      <li><a href="#">HTML</a></li>
                      <li><a href="#">CSS</a></li>
                      <li><a href="#">JavaScript</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <hr>
            <ul class="clearfix comments">
              <!-- form comment -->
              <li class="clearfix">
                <?php
                  $fields = array();
                    if(!is_user_logged_in()){
                      $fields =  array(
                          'author' =>
                            '<input type="text" id="author" name="author" class="name-from" placeholder="Your Name..." value="" />',

                          'email' =>
                            '<input type="text" id="email" name="email" class="email-from" placeholder="Your Email..." value="" />',

                          'url' =>
                            '<input id="url" name="url" type="hidden" value=""/>',
                        );
                      $photo = '<img src="'.get_template_directory_uri().'/img/unknown.png">';
                    }
                    else{
                      $current_user = wp_get_current_user();
                      // echo "<pre>"; print_r();exit();
                      $photo = get_avatar($current_user->ID,64);
                    }
                ?>
                <div class="photo-wrapper"><?php echo $photo; ?></div>
                <div class="comment-wrapper">
                  <div class="widget-area no-padding blank">
                    <div class="status-upload">
                          <?php
                            $args = array(
                              'id_form'           => 'commentform',
                              'class_form'      => 'comment-form',
                              'id_submit'         => 'submit',
                              'class_submit'      => 'btn btn-yellow',
                              'name_submit'       => 'submit',
                              'title_reply'       => '',
                              'title_reply_to'    => __( 'Leave a Reply to %s' ),
                              'cancel_reply_link' => __( 'Cancel Reply' ),
                              'label_submit'      => __( 'Comment' ),
                              'format'            => 'xhtml',

                              'fields' => apply_filters( 'comment_form_default_fields', $fields ),
                              'comment_field' =>  '<textarea id="comment" name="comment" placeholder="Add Comment…"></textarea>',

                              'must_log_in' => '<p class="must-log-in">' .
                                sprintf(
                                  __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
                                  wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
                                ) . '</p>',

                              'logged_in_as' => '',

                              'comment_notes_before' => '',
                              'comment_notes_after' => '',

                            );
                           comment_form($args, get_the_ID());
                          ?>
                    </div>
                  </div>
                </div>
              </li>
              <!-- form comment -->
              <?php
                foreach ($comments as $key => $value) {
                  $date = date_create($value->comment_date);
                  // print_r(); exit();
                  $formated_date = $date->format('F j').' at '.$date->format('H:i');
              ?>
              <li class="clearfix">
                <div class="photo-wrapper"><?php echo get_avatar($value->user_id); ?></div>
                <div class="comment-wrapper">
                  <div class="widget-area no-padding blank">
                    <div class="status-upload">
                      <div class="panel-body">
                        <header class="text-left">
                          <div class="comment-user"><i class="fa fa-user"></i> <?php echo $value->comment_author; ?></div>
                          <time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i> <?php echo $formated_date; ?></time>
                        </header>
                        <div class="comment-post">
                          <p>
                              <?php echo $value->comment_content; ?>
                          </p>
                        </div>
                      </div>
                    </div>
                    <!-- Status Upload  -->
                  </div>
                  <!-- Widget Area -->
                </div>
              </li>
              <?php
                }
              ?>
            </ul>
          </div>
        </div>
      </div>

      <!-- Righ Content -->
      <div class="col-md-4">
        <div class="whitebox berita-box height-auto">
          <div class="event-list">
            <div class="overlay">
              <div class="panel-title">
                  Cari Artikel
              </div>
              <div class="search-acara clearfix">
                <form id="event-search" method="GET">
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
                    <select onchange="submit_form()" name="y">
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
                </form>
              </div>
              <ul>
                <?php
                if(is_array($other_event_list)):
                  foreach ($other_event_list as $key => $value) {
                    $event_meta = get_post_meta($value->ID);
                    $tags = wp_get_post_tags($value->ID);
                ?>
                  <li class="clearfix berita-list">
                    <div class="col-md-5"><?php echo get_the_post_thumbnail($value->ID,'thumbnail'); ?></div>
                    <div class="col-md-7 no-padding-left">
                      <p><?php echo $formated_date; ?></p>
                      <h2 class="no-margin-top"><?php echo $value->post_title; ?></h2>
                      <p>
                        <?php 
                          foreach ($tags as $tag_key => $tag) {
                            echo '<a href="">#'.$tag->name.'</a> ';
                          }
                         ?>
                      </p>
                    </div>
                  </li>
                <?php }endif; ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="whitebox berita-box height-auto">
          <div class="panel-title">
            Buku Baru
          </div>
          <?php 
            foreach ($new_book as $key => $value) {
              $image = get_field('front_cover',$value->ID);
              $image_url = $image['url'];
           ?>
          <div class="berita-list clearfix row">
            <div class="col-md-7">
              <h2><?php echo $value->post_title; ?></h2>
              <p>
                <?php echo strip_tags(wp_trim_words($value->post_content,20,'')); ?>
                <br><a href="<?php echo get_permalink($value->ID); ?>">Selengkapnya….</a>
              </p>
              <h2><?php echo get_field('price',$value->ID); ?></h2>
            </div>
            <div class="col-md-5">
              <div class="book-item">
                <a href="">
                    <span class="cover new-book"><img src="<?php echo $image_url; ?>"></span>
                </a>
              </div>
            </div>
          </div>
          <?php } ?>
        </div>
        <div class="whitebox berita-box height-auto">
            <div class="panel-title">
                Artikel Lainnya
            </div>
            <div class="berita-list">
              <span class="image"><img src="<?php echo $image_url; ?>"></span>
              <h2 class="margintop-20"><?php echo $value->post_title; ?></h2>
              <p>
                  <?php echo strip_tags(wp_trim_words($value->post_content, 20, '')).' <a href="'.get_permalink($value->ID).'">Selengkapnya….</a>'; ?>
              </p>
            </div>
            <hr>
            <div class="text-center"><a href="/list-article" class="btn grey-outline border-none no-padding no-margin">Lihat Semua Berita <i class="fa fa-caret-right" aria-hidden="true"></i></a></div>
          </div>
        <div class="whitebox berita-box height-auto">
          <div class="panel-title">
            Penulis Bulan ini
          </div>
          <div class="author-list">
          <?php
            if(count($book_authors)):
            foreach ($book_authors as $key => $value) {
              $meta_author = get_post_meta($value->ID);
              $photo_url = get_template_directory_uri()."/img/unknown.png";
              if($meta_author['photo'][0]!=''):
              $photo_id = $meta_author['photo'][0];
              $photo_obj = get_post($photo_id);
              $photo_url = $photo_obj->guid;
              endif;
          ?>
          <!-- loop -->
            <span class="cover-author">
              <img src="<?php echo $photo_url; ?>">  
            </span>
            <h2><?php echo $value->post_title; ?></h2>
            <p>
                <?php echo strip_tags(wp_trim_words( $meta_author['about'][0], 50, '' )); ?>
                <br/><a href="<?php echo get_permalink($value->ID); ?>">Selengkapnya…</a>
            </p>

            <hr>
          <!-- loop -->
          <?php }endif; ?>
          </div>
        </div>
        <?php
          foreach ($video_list as $key => $value) { 
        ?>
        <div class="video-box whitebox">
          <div class=" video-box">
            <div class="video-big">
              <iframe width="100%" height="100%" src="<?php echo get_field('url',$value->ID); ?>" frameborder="0" allowfullscreen></iframe>
              <div class="overlay">
                <div class="panel-title">
                    <?php echo $value->post_title; ?>
                </div>
                <h2><?php echo strip_tags(wp_trim_words($value->post_content,10,'')); ?></h2>

                <a href="/list-video" class="btn btn-white">
                 Lihat Video Lainnya
                </a>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <!-- Righ Content -->
    </div>
  </div>
</section>

<?php add_action('wp_footer', 'JSforHome'); ?>
<?php get_footer(); ?>
