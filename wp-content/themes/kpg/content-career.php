<?php
/**
 * The theme header
 * 
 * @package bootstrap-basic
 * Template Name: Halaman Career
 */

get_header(); 
?>
<!-- begin top section -->
        <div class="top-inner career">
          <header class="main-header nav-down">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="top-logo clearfix">
                    <a href="/" class="bip-logo"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <a href="/" class="logo-white"><img src="<?php echo get_template_directory_uri() ?>/images/logo-white.png" alt="bhuana ilmu populer indonesia" class="img-responsive"></a>
                    <h1>bhuana ilmu populer</h1>
                  </div>
                </div>
                <div class="col-md-8">
                  <nav class="main-navigation">
                    <?php
echo  wp_nav_menu(array('echo' => false,'theme_location' => 'primary', 'container' => false, 'container_class' => false, 'menu_class' => 'navigation-list list-unstyled', 'walker' => new BootstrapBasicMyWalkerNavMenu()));
?>
                  </nav>
                  <form class="language-option" style="display: none;">
                    <select class="form-control">
                      <option selected>English</option>
                      <option>Indonesia</option>
                    </select>
                  </form>
                  <a href="#search" class="search-top" role="button" data-toggle="collapse"  aria-expanded="false" aria-controls="search">
                    <span class="wd wd-search67"></span>
                  </a>
                  <a id="leftOverlay" href="#sidr"><i class="wd wd-clipboard96"></i></a>

                  <a id="mobMenu" href="#left-menu">Left Menu</a>
                </div>
              </div>
            </div>
            <div class="main-search collapse" id="search">
              <div class="container">
                <div class="row">
                  <div class="col-md-8 col-md-offset-2 col-sm-12">
                    <?php get_search_form(); ?>
                  </div>
                </div>
              </div>
            </div>
          </header>
          <!-- <div class="top-tagline">
            <h2>make it happen</h2>
            <h4>join us at bhuana ilmu populer</h4>
          </div> -->
        </div><!-- end of top section -->

         <!-- begin inner page -->
        <div class="inner-page no-margin">

          <div class="inner-top">
            <div class="container">
              <div class="top-title">
                <h3>Career</h3>
              </div>
              <div class="breadcrumb">
                <div class="btn-group btn-breadcrumb">
                  <a href="/" class="btn btn-default"><i class="wd wd-home148"></i></a>
                  <a href="" class="btn btn-default active">Career</a>
                </div>
              </div>
            </div>
          </div>

          <div class="career-page">
            <div class="career-top">
                <div class="container">
                  <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-12">
                      <h3>It's like the Dream Team...</h3>
                      <p>
                        A lot of companies talk about culture--their awesome office, fun events and great perks. But we differently. We believe it's about people who enjoy each job and respect each other's skill. grab it with you the next.
                      </p>
                    </div>
                  </div>
                </div>
            </div>
            <?php while(have_posts()) : the_post(); ?>
                <div class="container">
                  <div class="row">
                    <div class="col-md-6 col-sm-6">
                      <div class="career-row">
                        <?php 
                        if(has_post_thumbnail()){ ?>
                          <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>">
                        <?php }else{ ?>
                          <img src="<?php echo get_template_directory_uri(); ?>/images/sample-career.jpg ">
                        <?php } ?>
                      </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                      <h3>Work You Can Hang out</h3>
                      <p>
                      <?php echo nl2br(get_the_content()); ?>
                      </p>
                    </div>
                  </div>
                </div>
          <?php endwhile; wp_reset_query(); ?>
            <div class="career-bottom">
              <div class="container">
                <div class="row">
                  <div class="col-md-6 col-md-offset-3 col-sm-12">
                    <h3>
                      Working here is very challenging. and you'll absolutely love it.
                    </h3>
                  </div>
                </div>
                <div class="row">
                <?php
                $args = array('post_type' => 'career', 'post_per_page' => -1, 'orderby' => 'post_date', 'order' => 'DESC');
                $query = new WP_Query($args);
                if($query->have_posts()){
                  while($query->have_posts()){
                    $query->the_post();
                ?>
                  <div class="col-md-3">
                    <div class="career-listed">
                      <h3 class="underline-title"><?php the_title(); ?></h3>
                      <p>
                        <?php echo get_field('description'); ?><br>
                        <strong>Location</strong>: <?php echo get_field('location'); ?>
                      </p>
                      <a href="" class="btn btn-purple blocking ModalLink" data-toggle="modal" data-id="<?php echo get_the_title(); ?>" data-target=".bip-career">apply</a>

                    </div>
                  </div>
                <?php
                  }
                }
                ?>
                </div>
                <!-- <span class="page-divider"></span>
                <div class="row">
                  <div class="col-md-3">
                    <div class="career-listed">
                      <h3 class="underline-title">accounting</h3>
                      <p>
                        some description Sed ut perspiciatis unde omnis iste natus<br>
                        <strong>location</strong>: jakarta main office
                      </p>
                      <a href="" class="btn btn-purple blocking">apply</a>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="career-listed">
                      <h3 class="underline-title">accounting</h3>
                      <p>
                        some description Sed ut perspiciatis unde omnis iste natus<br>
                        <strong>location</strong>: jakarta main office
                      </p>
                      <a href="" class="btn btn-purple blocking">apply</a>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="career-listed">
                      <h3 class="underline-title">accounting</h3>
                      <p>
                        some description Sed ut perspiciatis unde omnis iste natus<br>
                        <strong>location</strong>: jakarta main office
                      </p>
                      <a href="" class="btn btn-purple blocking">apply</a>

                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="career-listed">
                      <h3 class="underline-title">accounting</h3>
                      <p>
                        some description Sed ut perspiciatis unde omnis iste natus<br>
                        <strong>location</strong>: jakarta main office
                      </p>
                      <a href="" class="btn btn-purple blocking">apply</a>

                    </div>
                  </div>
                </div> -->
              </div>
            </div>


          </div>



        </div> <!-- end inner page -->








      </div><!-- end main page -->
      <div class="push"></div>
    </div><!-- end wrap page -->

    <!-- pop up apply -->
    <div class="modal fade bip-career" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="wd wd-cross96"></i></span></button>
            <h3 class="modal-title"><i class="wd wd-document272"></i> Apply</h3>
          </div>
          <div class="modal-guide">
            <div class="author-form">
              <div class="container-fluid">
                <div class="row">
                  <form class="form-horizontal" id="frmmailcareer">
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="namecareer" name="namecareer" placeholder="Your Name">
                      <!-- <input type="hidden" class="form-control jobcareer" id="jobcareer" name="jobcareer"> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="emailcareer" name="emailcareer" placeholder="Your Email">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Phone/Mobile Phone</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="phonecareer" name="phonecareer" placeholder="Your Phone/Mobile Phone">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Subject</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control subjectcareer" id="subjectcareer" name="subjectcareer" placeholder="Subject" readonly>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Address</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="addresscareer" name="addresscareer" placeholder="Your Address" rows="3"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Message</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" rows="3" name="messagecareer" id="messagecareer" placeholder="enter your message"></textarea>
                      <?php
                        // $idauthor = get_field('author',get_the_ID());
                        // if($idauthors){
                        //   foreach($idauthors as $idauthor){
                      ?>
                      <!-- <input type="hidden" name="mailauthor" value="<?php echo get_field('email', $idauthor->ID); ?>"> -->
                      
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Le_sQ4TAAAAACTCitxsO55_LvtAEOR9lf5VXmwk" style="margin-left: 114px;"></div>
                    <div style="margin-left: 114px;">
                      <label class="error required" name="hiddenRecaptcha" id="hiddenRecaptcha"></label>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="" class="col-sm-2 control-label">Attachment</label>
                    <div class="col-sm-10">
                      <input type="file" name="attachcareer" id="attachcareer" class="atcc" accept=".pdf,.docx,.epub,.text" multiple>
                      <p class="help-block">.pdf, .docx, .epub, .text. 5mb maximum</p>
                    </div>

                  </div> -->



                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="button" id="submitmailcareer" class="btn btn-purple">Send</button>&nbsp&nbsp&nbsp
                      <img src="<?php echo get_template_directory_uri() ?>/images/ajax-loader.gif" style="display:none;" class="mailLoad" >
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div><!-- end modal guide -->

        </div>
      </div>
    </div>
<?php add_action('wp_footer', 'JSforCareer'); ?>
<?php get_footer(); ?>