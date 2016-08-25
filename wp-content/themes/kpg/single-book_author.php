<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman Book Detail
 */

get_header(); 
$default_url = get_template_directory_uri().'/img/no-image.png';
$sosmed_url = get_option('social_options','null');
setPostViews(get_the_ID());
$att = get_post(get_the_ID());
$meta = get_post_meta(get_the_ID());
$terms = get_the_terms(get_the_ID(),'book_type');
$term_names = array();
$term_slug = array();
if(is_array($terms)!=''){
  foreach ($terms as $key => $value) {
    $term_names[] = $value->name;
    $term_slug[] = $value->slug;
  }
  $term_name = implode(', ', $term_names);
}
// print_r($term_names);exit();
//author terkait
$author_list_query = new WP_Query(array(
    'post_status' => 'publish',
    'post_type' => 'book_author',
    'orderby' => 'post_date',
    'book_type' => 'aktivitas',
    'order'   => 'DESC',
    'posts_per_page' => 1,
    'post__not_in' => array(get_the_ID())
));
$book_authors = $author_list_query->posts;
//author terkait
if($meta['photo'][0] != ''){
  $front_cover_id = get_post($meta['photo'][0]);
  $front_cover_url = $front_cover_id->guid;
}
else
  $front_cover_url = get_template_directory_uri()."/img/unknown.png";

$book_list = array();
$book_list_query = new WP_Query(array(
    'post_status' => 'publish',
    'post_type' => 'book',
    'orderby' => 'post_date',
    'meta_query' => array(
      array(
        'key' => 'author',
        'value' => get_the_ID(),
        'compare' => 'LIKE'
        ),
    ),
    'order'   => 'DESC'
  ));
if(!empty($book_list_query->posts)){
  $related_book = $book_list_query->posts;
}
$idx = 0;
$counter = 0;
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
$event = get_field('related_event');
if(is_array($event)){
  $event_list = array_splice($event, 0,3);
  $other_event_list = array_splice($event, 3,4);
}

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
  'orderby' => 'post_date',
  'meta_query' => array(
      array(
        'key' => 'author_id',
        'value' => get_the_ID(),
        'compare' => 'LIKE'
        ),
    ),
  'order'   => 'DESC',
  'posts_per_page' => 1,
));
$merchandise = $merchandise_list_query->posts;

//Article
$news = get_field('related_news');
if(is_array($news)){
  $article_list = $news;
}
//Article

$banner_image = get_field('banner_image');
$banner_link = get_field('banner_link');
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
                    <p class="center"><?php echo get_field('photo_caption'); ?></p>
                </a>
              </div>
              <ul class="link-social small center no-margin">
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
            <!-- left -->
            <!-- detail -->
            <div class="col-md-7">
              <h2 class="name"><?php echo $att->post_title; ?></h2>
              <div class="clearfix list-info">
                <p>
                    <?php echo preg_replace("/\r\n|\r|\n/",'<br/>',$meta['about'][0]); ?>
                </p>
              </div>
            </div>
            <!-- detail -->
          </div>
        </div>
        <!-- Buku Terkait -->
        <?php if(count($book_list)): ?>
          <div class="whitebox berita-box height-auto">
            <div class="panel-title">
              Buku yang Ditulis
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
                        $price = $meta_post['price'][0];
                        $desc = $value_book->post_content;
                        $explode_desc = explode(" ", $desc);
                        $splice_desc = array_splice($explode_desc,0, 20);
                        $desc = implode(" ",$splice_desc);
                        $desc = strip_tags($desc);
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
            <!-- <div class="panel-ribbon">
                <h2>Kegiatan</h2>
            </div> -->
            <ul class="nav nav-tabs" role="tablist" id="myTab">
                <?php if(count($event_list)): ?>
                <li role="presentation" class="active"><a href="#tab-01" aria-controls="home" role="tab" data-toggle="tab">Acara</a></li>
                <?php endif; ?>
                <?php if(count($article_list)): ?>
                <li role="presentation" <?php echo !is_array($video_list) ? 'class="active"' : ''; ?>><a href="#tab-02" aria-controls="#tab-02" role="tab" data-toggle="tab">Berita</a></li>
                <?php endif; ?>
            </ul>

            <div class="tab-content" id="myTabContent">
              <div role="tabpanel" class="tab-pane active" id="tab-01">
                <div class="row">
                  <div class="col-md-6 with-border">
                    <div class="event-list">
                      <div class="overlay">
                        <ul>
                        <!-- loop -->
                        <?php
                          if(count($event_list)):
                          foreach ($event_list as $key => $value) {
                            if($key!=0):
                            $event_meta = get_post_meta($value->ID);
                            $event_date = date_create($event_meta['event_date'][0]);
                            // echo "<pre>"; print_r($event_meta);exit();
                            $formated_date = $event_date->format('Y-M-d');
                            $explode_date = explode('-', $formated_date);
                            $year = $explode_date[0];
                            $month = $explode_date[1];
                            $date = $explode_date[2];                          
                        ?>
                          <li class="clearfix">
                            <div class="date">
                              <span><?php echo $date; ?></span>
                              <span><?php echo $month; ?></span>
                              <span><?php echo $year; ?></span>
                            </div>
                            <span>
                              <b><?php echo $value->post_title; ?></b>
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
                        <?php endif;}endif; ?>
                        <!-- loop -->
                        </ul>
                      </div>
                    </div>
                  </div>
                  <!-- main event -->
                   <?php
                      if(count($event_list)):
                      $value = $event_list[0];
                      $event_meta = get_post_meta($value->ID);
                      $event_date = date_create($event_meta['event_date'][0]);
                      // echo "<pre>"; print_r($event_meta);exit();
                      $formated_date = $event_date->format('d F Y');                         
                    ?>
                  <div class="col-md-6 text-left detail-event">
                    <h4><?php echo $formated_date; ?></h4>
                    <h3><?php echo $value->post_title; ?></h3>
                    <p><?php echo $value->post_content; ?></p>
                    <?php
                      $explode_event = explode(',', $event_meta['program'][0]);
                      foreach ($explode_event as $key => $value) {
                        echo '<div class="clearfix">';
                            echo '<label>'.$value.'</label>';
                        echo '</div>';
                      }
                    ?>
                  </div>
                  <!-- main event -->
                <?php endif; ?>
                </div>
              </div>
              <?php if(count($article_list)): ?>
              <div role="tabpanel" class="tab-pane <?php echo !is_array($video_list) ? 'active' : ''; ?>" id="tab-02">
                <div class="row">
                  <div class="col-md-12">
                   <?php if(count($article_list)): ?>
                        <div id="carousel-articles" class="carousel slide">           
                            <ol class="carousel-indicators">
                                <?php 
                                    $a = 0;
                                    for ($i=0; $i < count($article_list); $i++): ?>
                                    <?php if($i== 0): ?>
                                        <li data-target="#carousel-articles" data-slide-to="0" class="active"></li>
                                    <?php elseif($i%4 == 0): ?>
                                        <li data-target="#carousel-articles" data-slide-to="<?php echo ++$a; ?>"></li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                            </ol>

                            <div class="carousel-inner">
                                <?php foreach ($article_list as $key_row => $value): ?>
                                    <?php
                                        $link = '<a href="'.get_permalink($value->ID).'">Selengkapnya…</a>';
                                        $article_meta = get_post_meta($value->ID);
                                        $image_id = $article_meta['_thumbnail_id'][0];
                                        $image = get_post($image_id);
                                        $image_url = $image->guid;
                                    ?>
                                
                                    <?php if ($key_row == 0 || $key_row%4==3): ?>
                                        <div class="item <?php echo ($key_row==0)? 'active' : ''; ?>">
                                            <div class="row">
                                    <?php endif; ?>

                                    <div class="book-item">
                                        <ul class="more-article clearfix row">
                                            <li class="clearfix berita-list col-md-12 text-left">
                                                <div class="clearfix box-img"><img class="full-width" src="<?php echo $image_url; ?>" onerror="this.src='<?php echo get_template_directory_uri().'/img/unknown.png'; ?>';"></div>
                                                <div class="clearfix box-info">
                                                    <h2><?php echo $value->post_title; ?></h2>
                                                    <p>
                                                        <?php echo strip_tags(wp_trim_words($value->post_content,30,'')).' '.$link; ?>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>   

                                    <?php  if ($key_row%3==2 || end(array_keys($article_list)) == $key_row): ?>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>

                            <a data-slide="prev" href="#carousel-articles" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                            <a data-slide="next" href="#carousel-articles" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                        </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <?php endif; ?>
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
              <li role="presentation" <?php echo !is_array($video_list) ? 'class="active"' : ''; ?>><a href="#tab02-02" aria-controls="#tab02-02" role="tab" data-toggle="tab">Audio</a></li>
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
          <?php if(count($merchandise)): ?>
        <div class="whitebox berita-box height-auto">
          <!-- <div class="panel-title">
            Merchandise Terkait
          </div> -->
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
              <img src="<?php echo $image_url; ?>">
            </span>
              <h2 class="margintop-20"><?php echo $value->post_title; ?></h2>
              <h2><?php echo $price; ?></h2>
              <p><?php echo strip_tags(wp_trim_words($value->post_content,30,'')); ?></p>
            <?php } ?>
          </div>
        </div>
          <?php endif; ?>
        <?php if(is_array($banner_image)): ?>
          <div class="whitebox">
              <a href="<?php echo $banner_link; ?>" target="_blank"><img class="full-width" src="<?php echo $banner_image['url']; ?>" onerror="this.src='<?php echo $default_merchandise_img; ?>';"></a>
          </div>
        <?php endif; ?>
        </div>
      </div>
      <!-- Righ Content -->
    </div>
  </div>
</section>

<?php add_action('wp_footer', 'JSforHome'); ?>
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
<script>
  function play($id){
       var audio = document.getElementById($id);
       audio.play();

   }
 </script>
<?php get_footer(); ?>
