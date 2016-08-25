<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman Book Detail
 */

get_header(); 
$sosmed_url = get_option('social_options','null');
$default_url = get_template_directory_uri().'/img/no-image.png';
setPostViews(get_the_ID());
$att = get_post(get_the_ID());
$meta = get_post_meta(get_the_ID());
$comments = get_comments( array(
  'post_id' => get_the_ID(),
  'number' => 100
));
$count_comment = count($comments);
// echo "<pre>";print_r($comments);exit();
$book = get_field('book_id');

$video_meta = get_post_meta(get_the_ID());
$video_url = $video_meta['url'][0].'?autoplay=0';
setPostViews(get_the_ID());
// $terms = get_the_terms($att->ID,'book_type');
$author_list_query = new WP_Query(array(
    'post_status' => 'publish',
    'post_type' => 'book_author',
    'orderby' => 'post_date',
    // 'book_type' => $term_slug[0],
    'order'   => 'DESC',
    'posts_per_page' => 2,
    // 'post__not_in' => array(get_the_ID())
));
$book_authors = $author_list_query->posts;
// echo "<pre>";print_r($authors);print_r($meta);exit();

$date = date_create();
$date_now = $date->format('Ymd');

$event_list_query = new WP_Query(array(
  'post_status' => 'publish',
  'post_type' => 'event',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'meta_query' => array(
    array(
      'key' => 'event_date',
      'value' => $date_now,
      'compare' => '>'
      ),
  ),
  'posts_per_page' => 3,
  // 'offset' => 4
));
$other_event_list = $event_list_query->posts;

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

//audio
$audio_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'audio',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 3
    ));
$audio_list = $audio_list_query->posts;
//audio

$merchandise_list_query = new WP_Query(array(
  'post_status' => 'publish',
  'post_type' => 'merchandise',
  // 'book_type' => $term_slug[0],
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => 1,
  'offset' => 10
));
$merchandise = $merchandise_list_query->posts;

//Article
$article_list = get_field('related_news');
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
        <!-- book -->
          <?php
            if(is_array($book)):
            $book_meta = get_post_meta($book[0]->ID);
            $book_authors = get_field('author',$book[0]->ID);
            $front_cover_id = $book_meta['front_cover'][0];
            $front_cover = wp_get_attachment_image_src($front_cover_id,'full');
            $front_cover_url = $front_cover[0];
            if($front_cover_url=='')
              $front_cover_url = $default_url;
            // print_r($cover);exit();
            $author_name = array();
            if(count($book_meta['author'])>=1){
              foreach ($book_authors as $key => $author) {     
                $author_name[] = $author->post_title;
              }
              $authors = implode(', ', $author_name);
            }
            if($book_meta['year_of_publication'][0]!=''){
              $date_obj = date_create($book_meta['year_of_publication'][0]);
              $date_post = $date_obj->format('j M Y');
            }
            $terms = get_the_terms($book[0]->ID,'book_type');
            $term_names = array();
            if(count($terms)){
              foreach ($terms as $key => $value) {
                $term_names[] = $value->name;
              }
              $term_name = implode(', ', $term_names);
            }
          ?>
          <div class="whitebox berita-box height-auto margintop-min15">
            <div class="clearfix row">
              <!-- left -->
              <div class="col-md-5">

                <div class="book-item">
                  <a href="">
                      <span class="cover"><img src="<?php echo $front_cover_url; ?>" onerror="this.src='<?php echo $default_url; ?>';" ></span>
                  </a>
                </div>
              </div>
              <!-- left -->
              <!-- detail -->
              <div class="col-md-7">
                <h2 class="name"><?php echo $book[0]->post_title; ?></h2>
                <h5><?php echo $authors; ?></h5>
                <hr>
                <p><?php echo $book[0]->post_content; ?></p>

                <hr>
                <h5>Share this Article:</h5>
                <div class="join-social share-article no-margin">
                  <a href="" class="fb-btn"><i class="fa fa-facebook" oncontextmenu="return false;" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php echo $_SERVER['HTTP_HOST'].get_permalink(); ?>', 'newwindow', 'width=300, height=250');"></i></a>
                  <a href="" class="twitter-btn"><i class="fa fa-twitter" onclick="window.open('https://twitter.com/share', 'newwindow', 'width=400, height=350');" data-count="none"></i></a>
                  <a href="http://pinterest.com/pin/create/button/?url=<?php echo $_SERVER['HTTP_HOST'].get_permalink(); ?>%2f&description=Static%20social%20media%20%22share%22%20buttons&media=<?php echo $_SERVER['HTTP_HOST'].$front_cover_url; ?>" target="_blank" class="pinterest-btn"><i class="fa fa-pinterest"></i></a>
                  <a href="whatsapp://send?text=You must look this!" class="whatsapp-btn"><i class="fa fa-whatsapp"></i></a>
                </div>
              </div>
              <!-- detail -->
            </div>
          </div>
          <?php endif; ?>
        <!-- book -->
        <div class="multimedia-detail margintop-30 clearfix">
          <div class="col-md-12">
            <div class="video-box">
              <div class="video-big" style="height: auto;">
                <iframe width="100%" height="600px" src="<?php echo $video_url; ?>" frameborder="0" allowfullscreen></iframe>
                <div class="overlay"></div>
              </div>
            </div>

            <p class="date-news">Jumat, 20 Mei 2016</p>
            <h2 class="main-title"><?php echo $att->post_title; ?></h2>
            <div class="description">
              <p><?php echo $att->post_content; ?></p>
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
        <?php if(count($book_authors)): ?>
        <div class="whitebox berita-box height-auto">
          <div class="panel-title">
            Profil Penulis
          </div>
          <?php //print_r($book_authors);exit(); ?>
          <div class="author-list">
          <?php
            
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
                <?php echo wp_trim_words( $meta_author['about'][0], 50, '' ); ?>
                <br/><a href="<?php echo get_permalink($value->ID); ?>">Selengkapnya…</a>
            </p>

            <hr>
          <!-- loop -->
          <?php } ?>
          </div>
        </div>
        <?php endif; ?>
        <div class="whitebox berita-box height-auto">
          <?php if(count($merchandise)): ?>
          <div class="panel-title">
            Merchandise Terkait
          </div>
          <div class="berita-list">
            <?php
              $default_merchandise_img =  get_template_directory_uri()."/img/merchandise_default.png";
              foreach ($merchandise as $key => $value) {
                $meta = get_post_meta($value->ID);
                $price = (float)$meta['price'][0];
                $price = 'Rp. ' .number_format($price, 2, '.', ',');
                $image_id = $meta['image'][0];
                $image = get_post($image_id);
                $image_url = $image->guid;
            ?>
            <span class="image">
              <img src="<?php echo $image_url; ?>" onerror="this.src='<?php echo $default_merchandise_img; ?>';">
            </span>
              <h2 class="margintop-20"><?php echo $value->post_title; ?></h2>
              <h2><?php echo $price; ?></h2>
              <p><?php echo wp_trim_words($value->post_content,30,'') ?></p>
            <?php } ?>
          </div>
          <?php endif; ?>
          <div class="whitebox event-box height-auto">
            <div class="event-list">
              <div class="overlay">
                <div class="panel-title">
                    ACARA LAINNYA
                </div>
                <ul>
                <?php
                if(count($other_event_list)):
                  foreach ($other_event_list as $key => $value) {
                    $event_meta = get_post_meta($value->ID);
                    $event_date = date_create($event_meta['event_date'][0]);
                    // echo "<pre>"; print_r($event_meta);exit();
                    $formated_date = $event_date->format('Y-M-d');
                    $explode_date = explode('-', $formated_date);
                    $year = $explode_date[0];
                    $month = $explode_date[1];
                    $date = $explode_date[2];                          
                ?>
                <!-- loop -->
                  <li class="clearfix">
                    <div class="date">
                        <span><?php echo $date; ?></span>
                        <span><?php echo $month; ?></span>
                        <span><?php echo $year; ?></span>
                    </div>
                    <span>
                      <b><?php echo $value->post_title; ?></b>
                      <?php echo wp_trim_words($value->post_content,10,''); ?>
                    </span>
                  </li>
                  <!-- loop -->
                  <?php }endif; ?>
                </ul>
                <div class="text-center"><a href="/list-events" class="btn grey-outline">Lihat Semua Acara <i class="fa fa-caret-right" aria-hidden="true"></i></a></div>
              </div>
            </div>
          </div>
          <?php 
            if(is_array($article_list)): 
            $value = $article_list[0];
            $link = '<a href="'.get_permalink($value->ID).'">Selengkapnya…</a>';
            $article_meta = get_post_meta($value->ID);
            $image_id = $article_meta['_thumbnail_id'][0];
            $image = get_post($image_id);
            $image_url = $image->guid;
          ?>
          <div class="whitebox berita-box height-auto">
            <div class="panel-title">
                Artikel Lainnya
            </div>
            <div class="berita-list">
              <span class="image"><img src="<?php echo $image_url; ?>"></span>
              <h2 class="margintop-20"><?php echo $value->post_title; ?></h2>
              <p>
                  <?php echo wp_trim_words($value->post_content, 20, '').' '.$link; ?>
              </p>
            </div>
            <hr>
            <div class="text-center"><a href="/list-article" class="btn grey-outline border-none no-padding no-margin">Lihat Semua Berita <i class="fa fa-caret-right" aria-hidden="true"></i></a></div>
          </div>
        <?php endif; ?>
        </div>
      </div>
      <!-- Righ Content -->
    </div>
  </div>
</section>

<?php add_action('wp_footer', 'JSforHome'); ?>
<?php get_footer(); ?>
