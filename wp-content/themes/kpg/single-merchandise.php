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
$terms = get_the_terms($att->ID,'book_type');

$term_names = array();
$term_slug = array();
if(count($terms)){
  foreach ($terms as $key => $value) {
    $term_names[] = $value->name;
    $term_slug[] = $value->slug;
  }
  $term_name = implode(', ', $term_names);
}
$author = get_field('author_id');
$book_authors = $author;
// echo "<pre>";print_r($authors);print_r($meta);exit();
$front_cover_id = get_post($meta['image'][0]);
$front_cover_url = $front_cover_id->guid;

$related_book = get_field('related_merchandise');
$idx = 0;
$counter = 0;
$book_list = array();
if(is_array($related_book)){
  foreach ($related_book as $key => $value) {
    $book_list[$idx][] = $value;
    $counter++;
    if($counter == 3){
      $idx++;
      $counter = 0;
    }
  }
}

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
  'posts_per_page' => 4
));
$event_list = $event_list_query->posts;

$event_list_query = new WP_Query(array(
  'post_status' => 'publish',
  'post_type' => 'event',
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => 3,
  'offset' => 4
));
$other_event_list = $event_list_query->posts;

//Video
$video = get_field('related_video');
if(is_array($video)){
  $video_list = array_splice($video, 0,1);
}
//Video

//audio
$audio = get_field('related_audio');
if(is_array($audio)){
  $audio_list = array_splice($audio, 0,3);
}
//audio

$merchandise_list_query = new WP_Query(array(
  'post_status' => 'publish',
  'post_type' => 'merchandise',
  'book_type' => $term_slug[0],
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => 1,
  'offset' => 10
));
$merchandise = $merchandise_list_query->posts;

//Article
$article_list_query = new WP_Query(array(
      'post_status' => 'publish',
      'post_type' => 'berita',
      'orderby' => 'post_date',
      'order'   => 'DESC',
      'posts_per_page' => 4
    ));
$article_list = $article_list_query->posts;
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
          <div class="clearfix row">
            <!-- left -->
            <div class="col-md-5">

              <div class="book-item">
                <a href="">
                    <span class="cover"><img src="<?php echo $front_cover_url; ?>"></span>
                </a>
              </div>
              
            </div>
            <!-- left -->
            <!-- detail -->
            <div class="col-md-7">
              <h2 class="name"><?php echo $att->post_title; ?></h2>
              <div class="berita-list no-margin">
                <h2><?php
                 $price = (float)$meta['price'][0];
                 $price = 'Rp. ' .number_format($price, 2, '.', ',');
                 echo $price; 
                 ?></h2>
              </div>
              <hr>
              <?php if($meta['color'][0]!=''): ?>
              <div class="clearfix list-info">
                <label class="left">Tersedia Warna</label>
                <label class="right">: <?php echo $meta['color'][0]; ?></label>
              </div>
              <?php endif; ?>
              <p class="sinopsis">
                  <?php echo $att->post_content; ?>
              </p>
              <hr>
              <?php if(array_key_exists('link', $meta)){ 
                  if($meta['link'][0]!=''){
                ?>
              <div class="clearfix list-info add-cart">
                  <a href="<?php echo $meta['link'][0]; ?>" class="btn btn-yellow"><i class="fa fa-shopping-cart"></i> Add to Cart</a>
              </div>
              <hr>
              <?php }} ?>
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
        <!-- Buku Terkait -->
          <?php if(count($book_list)): ?>
          <div class="whitebox berita-box height-auto">
            <div class="panel-title">
              Merchandise Terkait
              <a href="/list-merchandise" class="btn grey-outline look-atallbook">Lihat Semua Merchandise <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            </div>
            <div class="author-list text-left margintop-50">
              <div id="Carousel" class="carousel slide">
                <ol class="carousel-indicators">
                  <?php
                    for ($i=0; $i < count($book_list); $i++) { 
                      if($i==0)
                        echo '<li data-target="#Carousel" data-slide-to="0" class="active"></li>';
                      else
                      echo '<li data-target="#Carousel" data-slide-to="'.$i.'"></li>';
                    }
                  ?>
                </ol>
                <!-- Carousel items -->
                <div class="carousel-inner">

                <?php
                  foreach ($book_list as $key_row => $book_row) {
                 ?>
                  <div class="item <?php echo ($key_row==0)? 'active' : ''; ?>">
                    <div class="row">
                    <?php 
                      // for ($j=0; $j < $total_books ; $j++) {
                      foreach ($book_row as $key_book => $value_book) {  
                        $meta_post = get_post_meta($value_book->ID);
                        $post_att = get_attached_media( 'image', $value_book->ID );
                        $front_cover_id = $meta_post['image'][0];
                        $front_cover = get_post($front_cover_id);
                        $cover = $front_cover->guid;
                        
                        $price = (float)$meta_post['price'][0];
                        $price = 'Rp. ' .number_format($price, 2, '.', ',');
                        $desc = $value_book->post_content;
                        $explode_desc = explode(" ", $desc);
                        $splice_desc = array_splice($explode_desc,0, 20);
                        $desc = implode(" ",$splice_desc);
                        $desc = strip_tags($desc);
                        // $cover = $post_att[key($post_att)]->guid;
                        // $thumb_cover = end($post_att)->guid;
                    ?>
                      <div class="merchandise-item">
                        <a href="<?php echo get_permalink($value_book->ID); ?>">
                          <span class="cover-img"><img src="<?php echo $cover; ?>" /></span>
                          <h2>
                            <?php echo $value_book->post_title; ?>
                            <br />
                            <?php 
                            $price =  (float)$meta_post['price'][0];
                            $price = 'Rp. ' .number_format($price, 2, '.', ',');
                            echo $price;
                             ?>
                          </h2>
                          <p><?php echo strip_tags(wp_trim_words($value->post_content,20,'')); ?></p>
                        </a>
                      </div>
                      <?php } ?>

                    </div>
                  </div>
                  <?php } ?>

                </div>
              <!-- Carousel items -->
              <a data-slide="prev" href="#Carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
              <a data-slide="next" href="#Carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
              </div>
            </div>
          </div>
        <?php endif; ?>
        <!-- Buku Terkait -->
        <!-- Kegiatan -->
          <div class="activity book-featured margintop-30">
            <div class="panel-ribbon">
                <h2>Kegiatan</h2>
            </div>
            <!-- <ul class="nav nav-tabs" role="tablist" id="myTab">
                <li role="presentation" class="active"><a href="#tab-01" aria-controls="home" r ole="tab" data-toggle="tab">Acara</a></li>
                <li role="presentation"><a href="#tab-02" aria-controls="#tab-02" role="tab" data-toggle="tab">Berita</a></li>
            </ul> -->

            <div class="tab-content" id="myTabContent">
              <div role="tabpanel" class="tab-pane active" id="tab-02">
                <div class="row">
                  <div class="col-md-12">
                    <ul class="more-article clearfix row">
                      <?php
                        if(count($article_list)):
                        foreach ($article_list as $key => $value) {
                          if($key!=3):
                          $link = '<a href="'.get_permalink($value->ID).'">Selengkapnya…</a>';
                          $article_meta = get_post_meta($value->ID);
                          // print_r($article_meta);exit();
                          $image_id = $article_meta['_thumbnail_id'][0];
                          $image = get_post($image_id);
                          $image_url = $image->guid;
                          $default_news_img =  get_template_directory_uri()."/img/news_default.png";
                      ?>
                      <!-- loop -->
                      <li class="clearfix berita-list col-md-4 text-left">
                          <div class="clearfix box-img"><img class="full-width" src="<?php echo $image_url; ?>" onerror="this.src='<?php echo $default_news_img; ?>';"></div>
                          <div class="clearfix box-info">
                              <h2><?php echo $value->post_title; ?></h2>
                              <p>
                                  <?php echo strip_tags(wp_trim_words($value->post_content,30,'')).' '.$link; ?>
                              </p>
                          </div>
                      </li>
                      <!-- loop -->
                      <?php endif;}endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>
        <!-- Kegiatan -->

        <!-- Multimedia -->
        <div class="activity book-featured margintop-30">
          <div class="panel-ribbon">
              <h2>MULTIMEDIA</h2>
          </div>
          <ul class="nav nav-tabs" role="tablist" id="myTab-02">
              <?php if(is_array($video_list)): ?>
              <li role="presentation" class="active"><a href="#tab02-01" aria-controls="home" role="tab" data-toggle="tab">Video</a></li>
              <?php endif; ?>
              <?php if(is_array($audio_list)): ?>
              <li role="presentation"><a href="#tab02-02" aria-controls="#tab02-02" role="tab" data-toggle="tab">Audio</a></li>
              <?php endif; ?>
          </ul>
          <div class="tab-content no-padding" id="myTabContent-02">
            <?php if(is_array($video_list)): ?>
            <div role="tabpanel" class="tab-pane active" id="tab02-01">
                <div class="row">
                    <div class="col-md-12">
                        <div class="video-box">
                            <?php
                              foreach ($video_list as $key => $value) {
                                $video_meta = get_post_meta($value->ID);
                                $video_url = $video_meta['url'][0].'?autoplay=0';
                            ?>
                            <div class="video-big">
                                <iframe width="100%" height="100%" src="<?php echo $video_url; ?>" frameborder="0" allowfullscreen></iframe>
                                <div class="overlay">
                                    <!-- <a href=""><img src="<?php echo get_template_directory_uri() ?>/img/play-icon.png"></a> -->
                                    <div class="panel-title">
                                        <?php echo $value->post_title; ?>
                                    </div>
                                    <h2><?php echo strip_tags(wp_trim_words($value->post_content, 20, ' ')); ?></h2>

                                    <a href="/list-video" class="btn btn-white">
                                      Lihat Video Lainnya
                                    </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <!-- audio -->
            <?php if(is_array($audio_list)): ?>
            <div role="tabpanel" class="tab-pane" id="tab02-02">
              <div class="row">
                <div class="col-md-12">
                  <ul class="list-unstyled video-list-thumbs row">
                    <!-- loop -->
                    <?php
                      foreach ($audio_list as $key => $value) {
                        $meta_audio = get_post_meta($value->ID);
                        if($meta_audio['image'][0]!=''){
                          $image_id = get_post($meta_audio['image'][0]);
                          $image_url = $image_id->guid;
                          $video_mp3 = get_field('file',$value->ID);
                          $mp3_url = $video_mp3['url'];
                        }
                    ?>
                    <li class="col-lg-4 col-xs-6">
                      <a title="" style="min-height: inherit;">
                        <img src="<?php echo $image_url; ?>" alt="Barca" class="img-responsive" onerror="this.src='<?php echo $default_url; ?>';" />
                        <h2><?php echo strip_tags(wp_trim_words($value->post_content, 10, '')); ?> </h2>
                        <img class="play-icon" src="<?php echo get_template_directory_uri(); ?>/img/audio-icon.png" onclick="play(<?php echo $value->ID; ?>)" />
                        <audio style="display: none;" id="<?php echo $value->ID; ?>" controls>
                          <source src="<?php echo $mp3_url; ?>" type="audio/mp3" />
                        </audio>
                        <?php
                          if($meta_audio['duration'][0])
                          echo '<span class="duration">'.$meta_audio['duration'][0].'</span>';
                        ?>
                      </a>
                    </li>
                    <?php } ?>
                    <!-- loop -->
                  </ul>
                </div>
              </div>
            </div>
            <?php endif; ?>
            <!-- audio -->
          </div>
        </div>
        <!-- Multimedia -->
      </div>

      <!-- Righ Content -->
      <div class="col-md-4">
        <div class="whitebox berita-box height-auto">
          <div class="panel-title">
            Profil Penulis
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
          <?php if(count($merchandise)): ?>
        <div class="whitebox berita-box height-auto">
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
              <p><?php echo strip_tags(wp_trim_words($value->post_content,30,'')); ?></p>
            <?php } ?>
          </div>
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
                      <?php echo strip_tags(wp_trim_words($value->post_content,10,'')); ?>
                    </span>
                  </li>
                  <!-- loop -->
                  <?php }endif; ?>
                </ul>
                <div class="text-center"><a href="" class="btn grey-outline">Lihat Semua Acara <i class="fa fa-caret-right" aria-hidden="true"></i></a></div>
              </div>
            </div>
          </div>
          <?php 
            if(array_key_exists(3, $article_list)): 
            $value = $article_list[3];
            $link = '<a href="'.get_permalink($value->ID).'">Selengkapnya…</a>';
            $article_meta = get_post_meta($value->ID);
            // print_r($article_meta);exit();
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
                  <?php echo strip_tags(wp_trim_words($value->post_content, 20, '')).' '.$link; ?>
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

<?php add_action('wp_footer', 'JSforBookDetail'); ?>
<script>
    function sticky_relocate() {
        var window_top = $(window).scrollTop();
        var div_top = $('#sticky-anchor').offset().top;
        if (window_top > div_top) {
            $('#sticky').addClass('stick');
            $('#sticky-anchor').height($('#sticky').outerHeight());
        } else {
            $('#sticky').removeClass('stick');
            $('#sticky-anchor').height(0);
        }
    }

    $(function () {
        $(window).scroll(sticky_relocate);
        sticky_relocate();
    });

    var dir = 1;
    var MIN_TOP = 200;
    var MAX_TOP = 350;

    function autoscroll() {
        var window_top = $(window).scrollTop() + dir;
        if (window_top >= MAX_TOP) {
            window_top = MAX_TOP;
            dir = -1;
        } else if (window_top <= MIN_TOP) {
            window_top = MIN_TOP;
            dir = 1;
        }
        $(window).scrollTop(window_top);
        window.setTimeout(autoscroll, 100);
    }

    $('#myTabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
</script>
<?php get_footer(); ?>
