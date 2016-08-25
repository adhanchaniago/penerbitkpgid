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
$default_url = get_template_directory_uri().'/img/no-image.png';
$softcover = get_field('softcover');
$hardcover = get_field('hardcover');
$term_names = array();
$term_slug = array();
if(is_array($terms)){
  foreach ($terms as $key => $value) {
    $term_names[] = $value->name;
    $term_slug[] = $value->slug;
  }
  $term_name = implode(', ', $term_names);
}
$author_id = $meta['author'];
$book_authors = get_field('author');
// echo "<pre>";print_r($authors);print_r($meta);exit();
$front_cover_id = $meta['front_cover'][0];
$front_cover = wp_get_attachment_image_src($front_cover_id,'full');
$front_cover_url = $front_cover[0];
// print_r($front_cover_url);exit();
if($front_cover_url=='')
  $front_cover_url = $default_url;
$author_name = array();
if(count($book_authors)>=1){
  foreach ($book_authors as $key => $author) {     
    $author_name[] = $author->post_title;
  }
  $authors = implode(', ', $author_name);
}
if($meta['year_of_publication'][0]!=''){
  $date_obj = date_create($meta['year_of_publication'][0]);
  $date_post = $date_obj->format('j M Y');
}

$related_book = get_field('relation_book');
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
// echo "<pre>";print_r($book_list);exit();

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
  // 'book_type' => $term_slug[0],
  'meta_query' => array(
    array(
      'key' => 'author_id',
      'value' => $book_authors[0]->ID,
      'compare' => 'LIKE'
      ),
  ),
  'orderby' => 'post_date',
  'order'   => 'DESC',
  'posts_per_page' => 1,
));
$merchandise = $merchandise_list_query->posts;

//Article
$related_news = get_field('relation_news');
if(is_array($related_news)){
  $article_list = $related_news;
}
// print_r($article_list);exit();
//Article
$banner_image = get_field('banner_image');
$banner_link = get_field('banner_link');
$resensi = get_field('resensi');
$link_book = get_field('link_book');
// echo "<pre>"; print_r($link_book);exit();
global $dynamic_featured_image;
$featured_images = $dynamic_featured_image->get_featured_images( );
// print_r($featured_images);exit();
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
                   <span class="cover">
                        <img id="zoom_image" src="<?php echo $front_cover_url; ?>" data-zoom-image="<?php echo $front_cover_url; ?>" onerror="this.src='<?php echo $default_url; ?>';"/>
                        <p><?php echo get_field('image_caption'); ?></p>
                   </span>
              </div>
              <ul class="link-detail small center no-margin">
                <?php if($link_book): ?>
                <li>
                  <a href="<?php echo $link_book; ?>" class="button-detail">
                    <i class="fa fa-shopping-cart fa-2x"></i>
                  </a>
                </li>
                <?php endif; ?>
                <li>
                  <section class="magnific-all">
                  <div class="half left">
                  <?php 
                    foreach ($featured_images as $key => $value) {
                      $url = $value[full];
                      $wrong_url = stristr($url, 'http:///wp-content');
                      if($wrong_url){
                        $url = str_replace('http:///wp-content/uploads', '', $url);
                      }
                      if($key == 0){
                        echo '<a href="'.$url.'" class="magnific item  button-detail" data-title="'.$meta->post_title.'"><i class="fa fa-book fa-2x"></i></a>';
                      }
                      else{
                        echo '<a href="'.$url.'" class="magnific item" data-title="item '.($key+1).'"> </a>';
                      }
                    }
                  ?>
                  </div>
                  </section>
                </li>
              </ul>
            </div>
            <!-- left -->
            <!-- detail -->
            <div class="col-md-7">
              <h2 class="name"><?php echo $att->post_title; ?></h2>
              <h5><?php echo $authors; ?></h5>
              <div class="berita-list no-margin">
                <h2>
                <?php 
                  $price_book = 'Rp.' .number_format((float)$meta['price'][0], 2, '.', ',');
                  echo $price_book; 
                ?>
                </h2>
              </div>
              <hr>
              <div class="clearfix list-info">
                <label class="left">Tanggal Terbit</label>
                <label class="right">: <?php echo $date_post; ?></label>
              </div>
              <div class="clearfix list-info">
                <label class="left">ISBN</label>
                <label class="right">: <?php echo $meta['isbn'][0]; ?></label>
              </div>
              <div class="clearfix list-info">
                <label class="left">KPG</label>
                <label class="right">: <?php echo $meta['kpg'][0]; ?></label>
              </div>
              <div class="clearfix list-info">
                <label class="left">Kategori</label>
                <label class="right">: <?php echo $term_name; ?></label>
              </div>
              <div class="clearfix list-info">
                <label class="left">Jumlah Halaman</label>
                <label class="right">: <?php echo $meta['pages'][0]; ?></label>
              </div>
              <div class="clearfix list-info">
                <label class="left">Ukuran</label>
                <label class="right">: <?php echo $meta['dimension_(wxl)'][0].' mm'; ?></label>
              </div>
              <div class="clearfix list-info">
                <label class="left">Format</label>
                <?php
                  if(get_field('format') == 'soft'){
                    $cover = 'Soft Cover';
                  }else{
                    $cover = 'Hard Cover';
                  }
                ?>
                <label class="right">: <?php echo $cover; ?></label>
              </div>
              <div class="clearfix list-info">
                <label class="left">Penerbit</label>
                <?php 
                  $publisher = get_field('publishers');
                  $publisher_name = $publisher[0]->post_title;
                 ?>
                <label class="right">: <?php echo $publisher_name; ?></label>
              </div>

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
        <div class="whitebox berita-box height-auto activity book-featured">
          <ul class="nav nav-tabs" role="tablist" id="myTab">
              <li role="presentation" class="active"><a href="#tab03-01" aria-controls="home" role="tab" data-toggle="tab">Sinopsis</a></li>
              <?php if(is_array($resensi)): ?>
              <li role="presentation"><a href="#tab03-02" aria-controls="#tab03-02" role="tab" data-toggle="tab">Resensi</a></li>
              <?php endif; ?>
          </ul>
          <div class="tab-content no-padding margintop-30" id="myTabContent">
            <div role="tabpanel" class="tab-pane active" id="tab03-01">
                <div class="row">
                    <div class="col-md-12">
                        <p class="sinopsis"><?php echo $att->post_content.'<br/>'.$hardcover.' '.$softcover; ?></p>
                    </div>
                </div>
            </div>
            <!-- resensi -->
            <?php if(is_array($resensi)): ?>
              <div role="tabpanel" class="tab-pane" id="tab03-02">
                  <div class="row">
                      <div class="col-md-12">
                            <div class="whitebox berita-box height-auto resensi">
                                <ul>
                                    <?php
                                      foreach ($resensi as $key => $value) {
                                        $date = get_field('date',$value->ID);
                                        if($date!= ''):
                                        $date_obj = date_create($date);
                                        $formated_date = $date_obj->format('d m Y');
                                        $day = $date_obj->format('l');
                                        $arr_month = array(
                                          '01' => 'Januari',
                                          '02' => 'Februari',
                                          '03' => 'Maret',
                                          '04' => 'April',
                                          '05' => 'Mei',
                                          '06' => 'Juni',
                                          '07' => 'Juli',
                                          '08' => 'Agustus',
                                          '09' => 'September',
                                          '10' => 'Oktober',
                                          '11' => 'November',
                                          '12' => 'Desember'
                                          );
                                        $array_day = array(
                                        'Monday' => 'Senin',
                                        'Tuesday' => 'Selasa',
                                        'Wednesday' => 'Rabu',
                                        'Thursday' => 'Kamis',
                                        'Friday' => 'Jumat',
                                        'Saturday' => 'Sabtu',
                                        'Sunday' => 'Minggu',
                                        );
                                        $day = $array_day[$day];
                                        $explode_date  =explode(' ', $formated_date);
                                        $date = $day.', '.$explode_date[0].' '.$arr_month[$explode_date[1]].' '.$explode_date[2];
                                        endif;
                                        // print_r($formated_date);exit();
                                        echo '<li id="resensi-'.$key.'">';
                                        echo $value->post_title;
                                        echo '<small>'.$date.'</small>';

                                        echo "</li>";
                                      }
                                    ?>
                                </ul>
                                <?php
                                  foreach ($resensi as $key => $value) {
                                    echo '<div class="resensi-detail" id="resensi-'.$key.'" style="display:none">';
                                    echo '<div class="resensi-content">';
                                    echo '<p><strong>'.get_field('media',$value->ID).'</strong></p>';
                                    echo '<p>'.$value->post_content.'</p>';
                                    echo '</div>';
                                    echo '<a href="javascript:void(0)" id="back" class="back-to"><i class="fa fa-arrow-circle-o-left"></i> kembali</a>';
                                    echo "</div>";
                                  }
                                ?>
                            </div>
                      </div>
                  </div>
              </div>
            <?php endif; ?>
            <!-- resensi -->
          </div>
        </div>
        <!-- Buku Terkait -->
          <?php if(count($book_list)): ?>
          <div class="whitebox berita-box height-auto">
            <div class="panel-title">
              Buku Terkait
              <a href="/list-books" class="btn grey-outline look-atallbook">Lihat Semua Buku <i class="fa fa-caret-right" aria-hidden="true"></i></a>
            </div>
            <div class="author-list text-left margintop-50">
              <div id="Carousel" class="carousel slide">
                <ol class="carousel-indicators">
                  <?php 
                    for ($i=0; $i < count($book_list); $i++) { 
                      if($i== 0)
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
                        $front_cover_id = $meta_post['front_cover'][0];
                        $front_cover = wp_get_attachment_image_src($front_cover_id,'full');
                        $thumb_cover = $front_cover[0];
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
                        $splice_desc = array_splice($explode_desc,0, 20);
                        $desc = implode(" ",$splice_desc);
                        $desc = strip_tags($desc);
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
                  <div class="whitebox carousel-articles col-md-12">
                    
                    <?php if(count($article_list)): ?>
                        <div id="carousel-articles" class="carousel slide">           
                            <ol class="carousel-indicators">
                                <?php 
                                    $a = 0;
                                    for ($i=0; $i < count($article_list); $i++): ?>
                                    <?php if($i== 0): ?>
                                        <li data-target="#carousel-articles" data-slide-to="0" class="active"></li>
                                    <?php elseif($i%3 == 0): ?>
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
                <?php echo strip_tags(wp_trim_words( $value->post_content, 50, '' )); ?>
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
              <img src="<?php echo $image_url; ?>">
            </span>
              <h2 class="margintop-20"><?php echo $value->post_title; ?></h2>
              <h2><?php echo $price; ?></h2>
              <p><?php echo strip_tags(wp_trim_words($value->post_content,30,'')) ?></p>
            <?php } ?>
          </div>
        </div>
          <?php endif; ?>
          
        <?php if(is_array($banner_image)): ?>
          <div class="whitebox">
              <a href="<?php echo $banner_link; ?>" target="_blank"><img class="full-width" src="<?php echo $banner_image['url']; ?>" onerror="this.src='<?php echo $default_merchandise_img; ?>';" /></a>
          </div>
        <?php endif; ?>
        </div>
      </div>
      <!-- Righ Content -->
    </div>
  </div>
</section>
<script>
  function play($id){
       var audio = document.getElementById($id);
       audio.play();

   }
 </script>
<?php add_action('wp_footer', 'JSforHome'); ?>
<?php get_footer(); ?>
