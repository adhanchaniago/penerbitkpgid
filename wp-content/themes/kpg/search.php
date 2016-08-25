<?php
/**
 * Template for displaying pages
 * 
 * @package bootstrap-basic
 * Template Name: Search Page
 */
get_header();

/**
 * determine main column size from actived sidebar
 */
?> 
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

<section id="content">
  <div class="container">
    <hgroup class="mb20">
        <h1>Search Results</h1>
        <h2 class="lead"><strong class="text-danger"><?php echo count(have_posts()); ?></strong> results were found for the search for <strong class="text-danger"><?php echo $_GET['s']; ?></strong></h2>
    </hgroup>
    <section class="col-xs-12 col-sm-6 col-md-12">
      <?php
      // filter book
      $idx = $_GET['s'];
      $args = array(
        'post_status' => 'publish',
        'post_type' => array('event','book','merchandise','berita','video','imprint','palbar','book_author','imprint'),
        'orderby' => 'post_date',
        'order'   => 'DESC',
      );
      $args['meta_query'] = array(
        array(
          'key' => 'keyword',
          'value' => $idx,
          'compare' => 'LIKE'
          ),
      );
      $book_list_query = new WP_Query($args);
      if(!empty($book_list_query->posts))
        $book_list = $book_list_query->posts;
      // filter book
      if(have_posts()){
        while(have_posts()){
          the_post();
          $post = get_post(get_the_ID());
          if($post->post_type != 'page'):
          $date = $post->post_date;
          $date_obj = date_create($date);
          $date = $date_obj->format('d/m/Y');
          $hour = $date_obj->format('H:i a');
          switch ($post->post_type) {
            case 'book':
              $meta_post = get_post_meta(get_the_ID());
              $front_cover_id = $meta_post['front_cover'][0];
              $front_cover = wp_get_attachment_image_src($front_cover_id,'full');
              $image_url = $front_cover[0];
              // $image = get_field('front_cover',get_the_ID());
              // $image_url = $image['url'];
              break;

            case 'book_author':
              $image = get_field('photo',get_the_ID());
              $image_url = $image['url'];
              break;
            
            case 'event':
              $image = get_field('image',get_the_ID());
              $image_url = $image['url'];
              break;

            case 'merchandise':
              $image = get_field('image',get_the_ID());
              $image_url = $image['url'];
              break;

            case 'article':
              $image = get_post_thumbnail_id(get_the_ID());
              $image_url = wp_get_attachment_image_src($image)[0];
              break;

            case 'berita':
              $image = get_post_thumbnail_id(get_the_ID());
              $image_url = wp_get_attachment_image_src($image)[0];
              break;

            case 'video':
              $image = get_post_thumbnail_id(get_the_ID());
              $image_url = wp_get_attachment_image_src($image)[0];
              break;

            case 'audio':
              $image = get_field('image',get_the_ID());
              $image_url = $image['url'];
              break;

            case 'imprint':
              $image = get_field('logo',get_the_ID());
              $image_url = $image['url'];
              break;

            default:
              $image_url = 'http://lorempixel.com/250/140/people';
              break;
          }
          // $date = $post->
      ?>
        <article class="search-result row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <a href="<?php echo get_permalink(get_the_ID()); ?>" title="<?php echo get_the_title(); ?>" class="thumbnail"><img src="<?php echo $image_url; ?>" alt="<?php echo get_the_title(); ?>" /></a>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-2">
                <ul class="meta-search">
                    <li><i class="glyphicon glyphicon-calendar"></i> <span><?php echo $date; ?></span></li>
                    <li><i class="glyphicon glyphicon-time"></i> <span><?php echo $hour; ?></span></li>
                    <li><i class="glyphicon glyphicon-tags"></i> <span><?php echo $post->post_type; ?></span></li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                <h3><a href="<?php echo get_permalink(get_the_ID()); ?>" title=""><?php echo get_the_title(); ?></a></h3>
                <p><?php echo wp_trim_words(str_replace('&nbsp;',' ',get_the_content()),16,'...'); ?></p>
                <span class="plus"><a href="#" title="<?php echo get_the_title(); ?>"><i class="glyphicon glyphicon-plus"></i></a></span>
            </div>
            <span class="clearfix borda"></span>
        </article>
      <?php
        endif; }
      }elseif(count($book_list)){
        foreach ($book_list as $key => $post) {
          $date = $post->post_date;
          $date_obj = date_create($date);
          $date = $date_obj->format('d/m/Y');
          $hour = $date_obj->format('H:i a');
          switch ($post->post_type) {
            case 'book':
              $meta_post = get_post_meta(get_the_ID());
              $front_cover_id = $meta_post['front_cover'][0];
              $front_cover = wp_get_attachment_image_src($front_cover_id,'full');
              $image_url = $front_cover[0];
              // $image = get_field('front_cover',get_the_ID());
              // $image_url = $image['url'];
              break;

            case 'book_author':
              $image = get_field('photo',get_the_ID());
              $image_url = $image['url'];
              break;
            
            case 'event':
              $image = get_field('image',get_the_ID());
              $image_url = $image['url'];
              break;

            case 'merchandise':
              $image = get_field('image',get_the_ID());
              $image_url = $image['url'];
              break;

            case 'article':
              $image = get_post_thumbnail_id(get_the_ID());
              $image_url = wp_get_attachment_image_src($image)[0];
              break;

            case 'berita':
              $image = get_post_thumbnail_id(get_the_ID());
              $image_url = wp_get_attachment_image_src($image)[0];
              break;

            case 'video':
              $image = get_post_thumbnail_id(get_the_ID());
              $image_url = wp_get_attachment_image_src($image)[0];
              break;

            case 'audio':
              $image = get_field('image',get_the_ID());
              $image_url = $image['url'];
              break;

            case 'imprint':
              $image = get_field('logo',get_the_ID());
              $image_url = $image['url'];
              break;

            default:
              $image_url = 'http://lorempixel.com/250/140/people';
              break;
          }
          ?>
            <article class="search-result row">
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <a href="<?php echo get_permalink($post->ID); ?>" title="<?php echo get_the_title(); ?>" class="thumbnail"><img src="<?php echo $image_url; ?>" alt="<?php echo get_the_title(); ?>" /></a>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <ul class="meta-search">
                        <li><i class="glyphicon glyphicon-calendar"></i> <span><?php echo $date; ?></span></li>
                        <li><i class="glyphicon glyphicon-time"></i> <span><?php echo $hour; ?></span></li>
                        <li><i class="glyphicon glyphicon-tags"></i> <span><?php echo $post->post_type; ?></span></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                    <h3><a href="<?php echo get_permalink(get_the_ID()); ?>" title=""><?php echo get_the_title(); ?></a></h3>
                    <p><?php echo wp_trim_words(str_replace('&nbsp;',' ',get_the_content()),16,'...'); ?></p>
                    <span class="plus"><a href="#" title="<?php echo get_the_title(); ?>"><i class="glyphicon glyphicon-plus"></i></a></span>
                </div>
                <span class="clearfix borda"></span>
            </article>
          <?php
        }
      } else {
      ?>
        <div class="container">
        <div class="row">
          <div class="col-md-8 col-md-offset-2">
            <center>
            <h1>Search Not Found</h1>
            </center>
          </div>
        </div>
        </div>
      <?php } ?>
    </section>

  </div>
</section>
<?php add_action('wp_footer', 'JSforNews'); ?>
<?php get_footer(); ?> 