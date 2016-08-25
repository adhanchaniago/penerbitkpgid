<?php
/**
 * Bootstrap Basic theme
 *
 * @package bootstrap-basic
 */


/**
 * Required WordPress variable.
 */

if (!isset($content_width)) {
	$content_width = 1170;
}

require_once('wp_bootstrap_navwalker.php');


if (!function_exists('bootstrapBasicSetup')) {
	/**
	 * Setup theme and register support wp features.
	 */
	function bootstrapBasicSetup()
	{
		/**
		 * Make theme available for translation
		 * Translations can be filed in the /languages/ directory
		 *
		 * copy from underscores theme
		 */
		load_theme_textdomain('bootstrap-basic', get_template_directory() . '/languages');

		// add theme support post and comment automatic feed links
		add_theme_support('automatic-feed-links');

		// enable support for post thumbnail or feature image on posts and pages
		add_theme_support('post-thumbnails');

		//disable admin bar
		show_admin_bar( false );

		// allow the use of html5 markup
		// @link https://codex.wordpress.org/Theme_Markup
		add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

		// add support menu
		register_nav_menus(array(
			'primary' => __('Primary Menu', 'bootstrap-basic'),
		));

		// add post formats support
		add_theme_support('post-formats', array('aside', 'image', 'video', 'quote', 'link'));

		// add support custom background
		add_theme_support(
			'custom-background',
			apply_filters(
				'bootstrap_basic_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => ''
				)
			)
		);
	}// bootstrapBasicSetup
}
add_action('after_setup_theme', 'bootstrapBasicSetup');


if (!function_exists('bootstrapBasicWidgetsInit')) {
	/**
	 * Register widget areas
	 */
	function bootstrapBasicWidgetsInit()
	{
		register_sidebar(array(
			'name'          => __('Header right', 'bootstrap-basic'),
			'id'            => 'header-right',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		register_sidebar(array(
			'name'          => __('Navigation bar right', 'bootstrap-basic'),
			'id'            => 'navbar-right',
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		));

		register_sidebar(array(
			'name'          => __('Sidebar left', 'bootstrap-basic'),
			'id'            => 'sidebar-left',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		register_sidebar(array(
			'name'          => __('Sidebar right', 'bootstrap-basic'),
			'id'            => 'sidebar-right',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h1 class="widget-title">',
			'after_title'   => '</h1>',
		));

		register_sidebar(array(
			'name'          => __('Sidebar Footer', 'bootstrap-basic'),
			'id'            => 'sidebar-footer',
			'before_widget' => '<div id="%1$s" class="col-md-3 col-sm-6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		));

		// register_sidebar(array(
		// 	'name'          => __('Footer left', 'bootstrap-basic'),
		// 	'id'            => 'footer-left',
		// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		// 	'after_widget'  => '</div>',
		// 	'before_title'  => '<h1 class="widget-title">',
		// 	'after_title'   => '</h1>',
		// ));
		//
		// register_sidebar(array(
		// 	'name'          => __('Footer right', 'bootstrap-basic'),
		// 	'id'            => 'footer-right',
		// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
		// 	'after_widget'  => '</div>',
		// 	'before_title'  => '<h1 class="widget-title">',
		// 	'after_title'   => '</h1>',
		// ));
	}// bootstrapBasicWidgetsInit
}
add_action('widgets_init', 'bootstrapBasicWidgetsInit');


if (!function_exists('bootstrapBasicEnqueueScripts')) {
	/**
	 * Enqueue scripts & styles
	 */
	function bootstrapBasicEnqueueScripts()
	{
    // wp_enqueue_style('bootstrap-theme-style', get_template_directory_uri() . '/css/bootstrap-theme.min.css');
    // wp_enqueue_style('fontawesome-style', get_template_directory_uri() . '/css/font-awesome.min.css');
    // wp_enqueue_style('fa-style', get_template_directory_uri() . '/css/main.css');
    wp_enqueue_style('bootstrap-style', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('ui-style', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('font-italic-style', 'https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic');
    wp_enqueue_style('playball-style', 'https://fonts.googleapis.com/css?family=Playball');
    wp_enqueue_style('font-raleway-style', 'https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic');
		wp_enqueue_style('bootstrap-basic-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style', get_template_directory_uri() . '/css/custom.css');
    wp_enqueue_style('magnify', get_template_directory_uri() . '/css/magnific-popup.css');
    // wp_enqueue_style('animation-ie-fix-style', get_template_directory_uri() . '/css/animations-ie-fix.css');


		// wp_enqueue_script('jquery', get_template_directory_uri() . '/js/jquery-1.11.3.min.js');
		// wp_enqueue_script('bootstrap-script', get_template_directory_uri() . '/js/vendor/bootstrap.min.js');
    // wp_enqueue_script('jquery-iframe', get_template_directory_uri() . '/js/jquery.iframe-transport.js');
		// wp_enqueue_script('main-script', get_template_directory_uri() . '/js/main.js');
		// wp_enqueue_script('css3-animate-it-script', get_template_directory_uri() . '/js/css3-animate-it.js');
		// wp_enqueue_script('isotope', get_template_directory_uri() . '/js/masonry-horizontal.js');
  //   wp_enqueue_script('isotope', get_template_directory_uri() . '/js/npm.js');
  //   wp_enqueue_script('isotope', get_template_directory_uri() . '/js/plugins.js');
		// wp_enqueue_script('jquery-sidr', get_template_directory_uri() . '/js/html5-3.6-respond-1.4.2.min.js');
		// wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js');
		// wp_enqueue_script('modernizr-script', get_template_directory_uri() . '/js/vendor/modernizr.min.js');
		// wp_enqueue_script('respond-script', get_template_directory_uri() . '/js/vendor/respond.min.js');
		// wp_enqueue_script('html5-shiv-script', get_template_directory_uri() . '/js/vendor/html5shiv.js');
		// wp_enqueue_script('html5-3.6-respond', get_template_directory_uri() . '/js/html5-3.6-respond-1.4.2.min.js');
		// wp_enqueue_script('jquery-mmenu', get_template_directory_uri() . '/js/jquery.mmenu.min.js');
		// wp_enqueue_script('plugins', get_template_directory_uri() . '/js/plugins.js');
		// wp_enqueue_script('jquery');

	}// bootstrapBasicEnqueueScripts
}
add_action('wp_enqueue_scripts', 'bootstrapBasicEnqueueScripts');

function JSforHome(){ ?>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery.magnific-popup.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery.elevateZoom-3.0.8.min.js"></script>
  <script>
   $(document).ready(function(){
          $(".resensi li").click(function(){
              var id = $(this).attr('id');
              var divid = "div#"+id;
              $(divid).show() && $(".resensi ul").hide() ;
          });
      });

      $(document).ready(function(){
          $(".back-to").click(function(){
              $(".resensi ul").show() &&  $(".resensi-detail").hide();
          });
      });
      $("#zoom_image").elevateZoom({constrainType:"height", constrainSize:274, zoomType: "lens", containLensZoom: true, gallery:'gallery_01', cursor: 'pointer', galleryActiveClass: "active"});
    $(function(){
      $('.magnific-all').each(function() {
        var $container = $(this);
        var $imageLinks = $container.find('.item');

        var items = [];
        $imageLinks.each(function() {
          var $item = $(this);
          var type = 'image';
          if ($item.hasClass('magnific-youtube')) {
            type = 'iframe';
          }
          var magItem = {
            src: $item.attr('href'),
            type: type
          };
          magItem.title = $item.data('title');    
          items.push(magItem);
          });

        $imageLinks.magnificPopup({
          mainClass: 'mfp-fade',
          items: items,
          gallery:{
              enabled:true,
              tPrev: $(this).data('prev-text'),
              tNext: $(this).data('next-text')
          },
          type: 'image',
          callbacks: {
            beforeOpen: function() {
              var index = $imageLinks.index(this.st.el);
              if (-1 !== index) {
                this.goTo(index);
              }
            }
          }
        });
      });
      $('.image-popup').magnificPopup({
         type: 'image'
       });
    });    
  </script>
<?php }

function JSforAuthor(){ ?>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
	<script>
	$(function(){
      $("#authorRecent").click(function() {
          $('html,body').animate({
              scrollTop: $(".author-recent").offset().top},
              'slow');
      });

       $("#authorPopular").click(function() {
          $('html,body').animate({
              scrollTop: $(".author-popular").offset().top},
              'slow');
      });

        $("#authorBest").click(function() {
          $('html,body').animate({
              scrollTop: $(".author-best").offset().top},
              'slow');
      });

          $("#authorRecently").owlCarousel({
              autoPlay: 3000,
              items : 4,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3],
              pagination: false,
              navigationText: [
              "<i class='wd-arrow395'></i>",
              "<i class='wd-pointer45'></i>"
              ],
              navigation: true
          });

           $("#PopularAuthor, #bestAuthor").owlCarousel({
              items : 4,
              itemsDesktop : [1199,3],
              itemsDesktopSmall : [979,3],
              pagination: false,
              navigationText: [
              "<i class='wd-arrow395'></i>",
              "<i class='wd-pointer45'></i>"
              ],
              navigation: true
          });




      // overlay
       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });

      });
	</script>
<?php }

function JSforBookDetail(){ ?>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/owl.carousel.min.js"></script>
	<script>
	$(function(){
      $("#authorBook").click(function() {
          $('html,body').animate({
              scrollTop: $(".book-related").offset().top},
              'slow');
      });

      // related book
      var owl = $("#relatedBook");
        owl.owlCarousel({
            itemsCustom : [
              [0, 1],
              [450, 2],
              [600, 3],
              [700, 4],
              [1000, 4],
              [1200, 6],
              [1400, 8],
              [1600, 10]
            ],
            navigation : true,
            pagination : false
        });

      // book carousel
        $("#bookSlide").owlCarousel({
          navigation : false,
          slideSpeed : 300,
          paginationSpeed : 400,
          singleItem:true
      });

      // overlay
       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });

      });
	</script>
<?php }

function JSforBook(){ ?>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/isotope.pkgd.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
	<script>
		$(function(){
       // book
      $('.book-item').hover(function(){
        $(this).toggleClass('flipped').siblings('.book-item').toggleClass('un-flipped');
      });


      // isotope
      $('.grid').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
      });

      // overlay

       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });
      });
	</script>
<?php }

function JSforCareer(){ ?>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
	<script>
    $(function(){

      // overlay
       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });

      });
  	</script>
<?php }

function JSforContact(){ ?>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery.iframe-transport.js"></script>
  <script src='https://maps.googleapis.com/maps/api/js?key=&sensor=false&extension=.js'></script>
	<script>
    $(function(){

      // overlay
       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });

      });
  </script>
  <script>



    google.maps.event.addDomListener(window, 'load', init);
    var map;
    function init() {
        var mapOptions = {
            center: new google.maps.LatLng(-6.239879,106.863612),
            zoom: 12,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.DEFAULT,
            },
            disableDoubleClickZoom: true,
            mapTypeControl: true,
            mapTypeControlOptions: {
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            },
            scaleControl: true,
            scrollwheel: true,
            panControl: true,
            streetViewControl: true,
            draggable : true,
            overviewMapControl: true,
            overviewMapControlOptions: {
                opened: false,
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        }
        var mapElement = document.getElementById('bipjakarta');
        var map = new google.maps.Map(mapElement, mapOptions);
        var locations = [

        ];
        for (i = 0; i < locations.length; i++) {
      if (locations[i][1] =='undefined'){ description ='';} else { description = locations[i][1];}
      if (locations[i][2] =='undefined'){ telephone ='';} else { telephone = locations[i][2];}
      if (locations[i][3] =='undefined'){ email ='';} else { email = locations[i][3];}
           if (locations[i][4] =='undefined'){ web ='';} else { web = locations[i][4];}
           if (locations[i][7] =='undefined'){ markericon ='';} else { markericon = locations[i][7];}
            marker = new google.maps.Marker({
                icon: markericon,
                position: new google.maps.LatLng(locations[i][5], locations[i][6]),
                map: map,
                title: locations[i][0],
                desc: description,
                tel: telephone,
                email: email,
                web: web
            });
if (web.substring(0, 7) != "http://") {
link = "http://" + web;
} else {
link = web;
}
            bindInfoWindow(marker, map, locations[i][0], description, telephone, email, web, link);
     }
 function bindInfoWindow(marker, map, title, desc, telephone, email, web, link) {
      var infoWindowVisible = (function () {
              var currentlyVisible = false;
              return function (visible) {
                  if (visible !== undefined) {
                      currentlyVisible = visible;
                  }
                  return currentlyVisible;
               };
           }());
           iw = new google.maps.InfoWindow();
           google.maps.event.addListener(marker, 'click', function() {
               if (infoWindowVisible()) {
                   iw.close();
                   infoWindowVisible(false);
               } else {
                   var html= "<div style='color:#000;background-color:#fff;padding:5px;width:150px;'><h4>"+title+"</h4><p>"+desc+"<p><p>"+telephone+"<p><a href='mailto:"+email+"' >"+email+"<a><a href='"+link+"'' >"+web+"<a></div>";
                   iw = new google.maps.InfoWindow({content:html});
                   iw.open(map,marker);
                   infoWindowVisible(true);
               }
        });
        google.maps.event.addListener(iw, 'closeclick', function () {
            infoWindowVisible(false);
        });
 }
}
</script>
<?php }

function JSforNews(){ ?>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/isotope.pkgd.min.js"></script>
	<script>
	  $(function(){

      // init Isotope
    var $grid = $('.feat-news').isotope({
      itemSelector: '.grid-item',
      layoutMode: 'masonry',
      masonry: {
        columnWidth: 110
      },
      cellsByRow: {
        columnWidth: 220,
        rowHeight: 220
      },
      masonryHorizontal: {
        rowHeight: 110
      },
      cellsByColumn: {
        columnWidth: 220,
        rowHeight: 220
      }
    });

    var isHorizontal = false;
    var $window = $( window );



      // overlay
       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });

      });
	</script>
<?php }

function JSforNewsDetail(){ ?>

	<script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
	<script src="<?php echo get_template_directory_uri()?>/js/owl.carousel.min.js"></script>

  <script>
    $(function(){
        $("#relatedPost").owlCarousel({
      autoPlay: 3000,
      items : 4,
      pagination: false,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,2]
      });


      // overlay
       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });

      });
  </script>

<?php }

function JSforShortStory(){ ?>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/isotope.pkgd.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>

<script>
    $(function(){
       // book
      $('.book-item').hover(function(){
        $(this).toggleClass('flipped').siblings('.book-item').toggleClass('un-flipped');
      });


      // isotope
      $('.grid').isotope({
        itemSelector: '.grid-item',
        layoutMode: 'fitRows'
      });

      // overlay

       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });


      });
  </script>
<?php }

function JSforAbout(){ ?>

  <script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/owl.carousel.min.js"></script>

  <script>
    $(function(){

      $('.show-modal').on('click', function () {
            var id = $(this).data('id');
        $('.gallery-popup').modal('show');
        // $('.gallery-popup').on('show.bs.modal', function (e) {
          $('.pm').hide();
          $('.modal-'+id).show();
        // })
          return false;
      })


      // related news about
      var owl = $("#relatedAbout");
        owl.owlCarousel({
            itemsCustom : [
               [0, 1],
              [450, 2],
              [600, 3],
              [700, 4],
              [1000, 4],
              [1200, 6],
              [1400, 8],
              [1600, 10]
            ],
            navigation : false,
            pagination : false
        });

        // related gallery about
      var owl = $("#relatedGallery");
        owl.owlCarousel({
            itemsCustom : [
              [0, 1],
              [450, 2],
              [600, 3],
              [700, 4],
              [1000, 4],
              [1200, 6],
              [1400, 8],
              [1600, 10]
            ],
            navigation : true,
            pagination : false,
            navigationText: [
      "previous gallery",
      "next gallery"
      ]
        });


      // overlay

       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });


      });
  </script>

<?php }

function JSforShortStoryDetail() { ?>

  <script src="<?php echo get_template_directory_uri()?>/js/jquery-1.11.3.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/vendor/bootstrap.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/main.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery.sidr.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/owl.carousel.min.js"></script>
  <script src="<?php echo get_template_directory_uri()?>/js/jquery.nicescroll.min.js"></script>

<script>
    $(function(){

      $("#scrolled").niceScroll({cursorcolor:"#33CCFF"});

      $("#authorBook").click(function() {
          $('html,body').animate({
              scrollTop: $(".book-related").offset().top},
              'slow');
      });

      // related book
      var owl = $("#relatedBook");
        owl.owlCarousel({
            itemsCustom : [
              [0, 1],
              [450, 2],
              [600, 3],
              [700, 4],
              [1000, 4],
              [1200, 6],
              [1400, 8],
              [1600, 10]
            ],
            navigation : true,
            pagination : false
        });



      // overlay
       $('#leftOverlay').sidr({
          displace: false
      });

      $('#btnClose').click(function(){
          $.sidr('close', 'sidr');
      });

      $('#mobMenu').sidr({
        name: 'left-menu',
        side: 'left',
       source: '#left-menu'
      });

      });
  </script>

<?php }

/**
 * admin page displaying help.
 */
if (is_admin()) {
	require get_template_directory() . '/inc/BootstrapBasicAdminHelp.php';
	$bbsc_adminhelp = new BootstrapBasicAdminHelp();
	add_action('admin_menu', array($bbsc_adminhelp, 'themeHelpMenu'));
	unset($bbsc_adminhelp);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';


/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';


/**
 * Custom dropdown menu and navbar in walker class
 */
require get_template_directory() . '/inc/BootstrapBasicMyWalkerNavMenu.php';


/**
 * Template functions
 */
require get_template_directory() . '/inc/template-functions.php';


/**
 * --------------------------------------------------------------
 * Theme widget & widget hooks
 * --------------------------------------------------------------
 */
require get_template_directory() . '/inc/widgets/BootstrapBasicSearchWidget.php';
require get_template_directory() . '/inc/template-widgets-hook.php';

/* Rewrite Template */
// add_action( 'wp', 'author_rewrite_slug' );
// function author_rewrite_slug()
// {
//   global $posts;
//  $current_url = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
//  $explode_current_url = explode('/', $current_url);
//    if (($explode_current_url[1] == 'author') && $explode_current_url[2]){
// $the_slug = $explode_current_url[2];
// $args = array(
//  'name'        => $the_slug,
//  'post_type'   => 'author',
//  'post_status' => 'publish',
//  'numberposts' => 1
// );
// $author_posts = get_posts($args);

// if( $author_posts ) :
// foreach ( $author_posts as $post ) : setup_postdata( $post );
//  $posts=  $post;
//  get_template_part('content', 'author');
// endforeach;
// wp_reset_postdata();
// endif;

//      exit();
//    }
// }

add_action( 'wp_ajax_ajax_MailContact', 'ajax_MailContact' );
add_action('wp_ajax_nopriv_ajax_MailContact', 'ajax_MailContact' );
function ajax_MailContact() {

    // The $_REQUEST contains all the data sent via ajax
    // ob_start();
    // require(get_template_directory()."/inc/class.phpmailer.php");
    require(get_template_directory()."/inc/phpmailer/class.phpmailer.php");
    require(get_template_directory()."/inc/phpmailer/class.smtp.php");

    parse_str(urldecode($_POST['frmcontact']), $datas);
    // print_r($datas);
    $name = $datas['name'];
    $phone = $datas['phone'];
    $email = $datas['email'];
    $address = 'henry.susilo@penerbitbip.id';
    $subject = $datas['subject'];
    $message = $datas['mesej'];
    // echo 'asdasd';

        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server
        $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "yusup.handian@kiranatama.com"; // SMTP account username18.
        $mail->Password   = "olsVswL2";        // SMTP account password

        $mail->From     = $email;
                $mail->Subject  = $subject;
  $mail->Body = $message.'<br><br>Name :'.$name.'<br>Phone Number :'.$phone;
  $mail->AddAddress ( $address );

  $envio = $mail->Send(); //send email

      if($envio){
          echo "email sent";
        }else{
          echo 'email not sent';
        }

   die();
}

add_action( 'wp_ajax_ajax_SendMails', 'ajax_SendMails' );
add_action('wp_ajax_nopriv_ajax_SendMails', 'ajax_SendMails' );
function ajax_SendMails() {
    require(get_template_directory()."/inc/phpmailer/class.phpmailer.php");
    require(get_template_directory()."/inc/phpmailer/class.smtp.php");

    parse_str(urldecode($_POST['frmsend']), $datamail);
    $name = $datamail['name'];
    $book = $datamail['books'];
    $urls = $datamail['urls'];
    $address = my_option('email_pubh');
    $myAddress = explode(',', $address);
    $attach = $_FILES['attachs']['tmp_name'];
    $attachname = $_FILES['attachs']['name'];
    $attachtype = $_FILES['attachs']['type'];
    $attachsize = $_FILES['attachs']['size'];

    // print_r($datamail);
    // die();

        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server
        $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "yusup.handian@kiranatama.com"; // SMTP account username18.
        $mail->Password   = "olsVswL2";        // SMTP account password

        $mail->From     = 'no-reply@bip.co.id';
        $mail->FromName = '[BIP] Admin';
        $mail->Subject  = '[BIP] Kirim Naskah';
        $mail->Body = 'Book :  '.$book.'<br><br>'.'URL  :  '.$urls.'<br><br>'.'Name  :  '.$name;
        $mail->AddAttachment($attach, $attachname);
        foreach($myAddress as $email){
          $mail->AddCC ( $email );
        }


  $envio = $mail->Send(); //send email

      if($envio){
          echo "email sent";
        }else{
          echo 'email not sent';
        }
      die();
}

add_action( 'wp_ajax_ajax_SendMailCareer', 'ajax_SendMailCareer' );
add_action('wp_ajax_nopriv_ajax_SendMailCareer', 'ajax_SendMailCareer' );
function ajax_SendMailCareer() {
    require(get_template_directory()."/inc/phpmailer/class.phpmailer.php");
    require(get_template_directory()."/inc/phpmailer/class.smtp.php");
    // require(get_template_directory()."/inc/recaptchalib.php");

    parse_str(urldecode($_POST['frmsend']), $datacareer);
    $name = $datacareer['namecareer'];
    $message = $datacareer['messagecareer'];
    $address = my_option('email_pubh');
    $myAddress = explode(',', $address);
    $emailcareer = $datacareer['emailcareer'];
    $phone = $datacareer['phonecareer'];
    $subject = $datacareer['subjectcareer'];
    $addresss = $datacareer['addresscareer'];

    // recaptcha
    $privatekey = '6Le_sQ4TAAAAAPw7Vq86dtqk22ka8ewaKIPHmLXn';
    $googleurl = 'https://www.google.com/recaptcha/api/siteverify';
    $response = $datacareer['g-recaptcha-response'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $googleurl."?secret=".$privatekey."&response=".$response."&remoteip=".$ip;
    $resp = file_get_contents($url);
    $resp = json_decode($resp, true);

    // print_r($subject);
    // die();
    if(empty($response)) {
      echo 'Please enter your reCAPTCHA';
      die();
    }
    if($resp['success']){

        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server
        $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "yusup.handian@kiranatama.com"; // SMTP account username18.
        $mail->Password   = "olsVswL2";        // SMTP account password

        $mail->From     = $emailcareer;
        $mail->FromName = $name . '<'. $emailcareer . '>';
        $mail->Subject  = $subject;
        $mail->Body = $message . '<br><br><br>' . 'Name : '. $name . '<br><br>' . 'Phone : ' . $phone . '<br><br>' . 'Address : ' . $addresss;
        // $mail->AddAttachment($attach, $attachname);
        foreach($myAddress as $email){
          $mail->AddCC ( $email );
        }


      $envio = $mail->Send(); //send email

      if($envio){
          echo "email sent";
        }else{
          echo 'email not sent';
        }
    } else {
      echo 'Please re-enter your reCAPTCHA';
    }

    die();
}


add_action( 'wp_ajax_ajax_mailauthor', 'ajax_mailauthor' );
add_action('wp_ajax_nopriv_ajax_mailauthor', 'ajax_mailauthor' );
function ajax_mailauthor() {

    require(get_template_directory()."/inc/phpmailer/class.phpmailer.php");
    require(get_template_directory()."/inc/phpmailer/class.smtp.php");

    parse_str(urldecode($_POST['frmsend']), $datamailauthor);
    $name = $datamailauthor['namecontact'];
    $subject = $datamailauthor['subjectcontact'];
    $message = $datamailauthor['messagecontact'];
      // $address = $datamailauthor['mailauthor'];
    $address = my_option('email_pubh');
    $myAddress = explode(',', $address);

    // print_r($address);
    // die();
        $mail = new PHPMailer();
        $mail->IsHTML(true);
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server

        $mail->IsSMTP(); // telling the class to use SMTP
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->Host       = "pro.turbo-smtp.com"; // SMTP server
        $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "yusup.handian@kiranatama.com"; // SMTP account username18.
        $mail->Password   = "olsVswL2";        // SMTP account password

        $mail->From     = 'no-reply@bip.co.id';
        $mail->FromName = '[BIP] Admin';
        $mail->Subject  = $subject;
        // $mail->AddAttachment($attach, $attachname);
        $mail->Body = $message.'<br><br>'.'Name  : '.$name;
        foreach($myAddress as $email){
          $mail->AddCC ( $email );
        }

  $envio = $mail->Send(); //send email

      if($envio){
          echo "email sent";
        }else{
          echo 'email not sent';
        }
      die();
}
function getPostViews($postID){
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return "0 View";
        }
        return $count.' Views';
}

function setPostViews($postID) {
        $count_key = 'post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
          $count = 0;
          delete_post_meta($postID, $count_key);
          add_post_meta($postID, $count_key, '0');
        }else{
          $count++;
          update_post_meta($postID, $count_key, $count);
        }
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);

function posts_column_views($defaults){
     $defaults['post_views'] = __('Views');
     return $defaults;
}
function posts_custom_column_views($column_name, $id){
    if($column_name === 'post_views'){
      echo getPostViews(get_the_ID());
    }
}

function my_post_object_query( $args, $field, $post )
{
    // modify the order
    $args['orderby'] = 'title';

    return $args;
}

// filter for every field
add_filter('acf/fields/post_object/query', 'my_post_object_query', 10, 3);

// filter for a specific field based on it's name
add_filter('acf/fields/post_object/query/name=my_select', 'my_post_object_query', 10, 3);

// filter for a specific field based on it's key
add_filter('acf/fields/post_object/query/key=field_508a263b40457', 'my_post_object_query', 10, 3);


// function widget_categories_args_filter( $cat_args ) {
//   $exclude_arr = array( 29 );

//   if( isset( $cat_args['exclude'] ) && !empty( $cat_args['exclude'] ) )
//     $exclude_arr = array_unique( array_merge( explode( ',', $cat_args['exclude'] ), $exclude_arr ) );
//   $cat_args['exclude'] = implode( ',', $exclude_arr );
//   return $cat_args;
// }

// add_filter( 'widget_categories_args', 'widget_categories_args_filter', 10, 1 );


/**
 * BIP Settings
 */
class my_Admin {

    /**
     * Default Option key
     * @var string
     */
    private $key = 'my_options';

    /**
     * Array of metaboxes/fields
     * @var array
     */
    protected $option_metabox = array();

    /**
     * Options Page title
     * @var string
     */
    protected $title = '';

    /**
     * Options Tab Pages
     * @var array
     */
    protected $options_pages = array();

    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct() {
        // Set our title
        $this->title = __( 'KPG Settings', 'theme_textdomain' );
    }

    /**
     * Initiate our hooks
     * @since 0.1.0
     */
    public function hooks() {
        add_action( 'admin_init', array( $this, 'init' ) );
        add_action( 'admin_menu', array( $this, 'add_options_page' ) ); //create tab pages
    }

    /**
     * Register our setting tabs to WP
     * @since  0.1.0
     */
    public function init() {
      $option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
          register_setting( $option_tab['id'], $option_tab['id'] );
        }
    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {
        $option_tabs = self::option_fields();
        foreach ($option_tabs as $index => $option_tab) {
          if ( $index == 0) {
            $this->options_pages[] = add_menu_page( $this->title, $this->title, 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) ); //Link admin menu to first tab
            add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) ); //Duplicate menu link for first submenu page
          } else {
            $this->options_pages[] = add_submenu_page( $option_tabs[0]['id'], $this->title, $option_tab['title'], 'manage_options', $option_tab['id'], array( $this, 'admin_page_display' ) );
          }
        }
    }

    /**
     * Admin page markup. Mostly handled by CMB
     * @since  0.1.0
     */
    public function admin_page_display() {
      $option_tabs = self::option_fields(); //get all option tabs
      $tab_forms = array();
        ?>
        <div class="wrap cmb_options_page <?php echo $this->key; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

            <!-- Options Page Nav Tabs -->
            <h2 class="nav-tab-wrapper">
              <?php foreach ($option_tabs as $option_tab) :
                $tab_slug = $option_tab['id'];
                $nav_class = 'nav-tab';
                if ( $tab_slug == $_GET['page'] ) {
                  $nav_class .= ' nav-tab-active'; //add active class to current tab
                  $tab_forms[] = $option_tab; //add current tab to forms to be rendered
                }
              ?>
              <a class="<?php echo $nav_class; ?>" href="<?php menu_page_url( $tab_slug ); ?>"><?php esc_attr_e($option_tab['title']); ?></a>
              <?php endforeach; ?>
            </h2>
            <!-- End of Nav Tabs -->

            <?php foreach ($tab_forms as $tab_form) : //render all tab forms (normaly just 1 form) ?>
            <div id="<?php esc_attr_e($tab_form['id']); ?>" class="group">
              <?php cmb_metabox_form( $tab_form, $tab_form['id'] ); ?>
            </div>
            <?php endforeach; ?>
        </div>
        <?php
    }

    /**
     * Defines the theme option metabox and field configuration
     * @since  0.1.0
     * @return array
     */
    public function option_fields() {

        // Only need to initiate the array once per page-load
        if ( ! empty( $this->option_metabox ) ) {
            return $this->option_metabox;
        }

        $this->option_metabox[] = array(
            'id'         => 'general_settings', //id used as tab page slug, must be unique
            'title'      => 'General Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'general_settings' ), ), //value must be same as id
            'show_names' => true,
            'fields'     => array(
                              array(
                                'name' => __('Catalog', 'theme_textdomain'),
                                // 'desc' => __('Logo to be displayed in the header menu.', 'theme_textdomain'),
                                'id' => 'catalog', //each field id must be unique
                                'default' => '',
                                'type' => 'file',
                              ),
                              array(
                                'name' => __('Email Publisher', 'theme_textdomain'),
                                'desc' => __('Email for "Kirim Naskah" and "Send to Author/Publisher".', 'theme_textdomain'),
                                'id' => 'email_pubh', //each field id must be unique
                                'default' => '',
                                'type' => 'text',
                              ),
                              array(
                                'name' => __('Text Title', 'theme_textdomain'),
                                'desc' => __('Text Tile on background home page', 'theme_textdomain'),
                                'id' => 'text_title', //each field id must be unique
                                'default' => 'have fun and read a book',
                                'type' => 'text',
                              ),
                              array(
                                'name' => __('Address', 'theme_textdomain'),
                                'desc' => __('Address on contact page.', 'theme_textdomain'),
                                'id' => 'address_pubh', //each field id must be unique
                                'default' => 'Jalan Kerajinan No. 3-7 Kota Jakarta Propinsi jakarta 11140 Indonesia',
                                'type' => 'text',
                              ),
                              array(
                                'name' => __('Phone', 'theme_textdomain'),
                                'desc' => __('Phone on contact page.', 'theme_textdomain'),
                                'id' => 'phone_pubh', //each field id must be unique
                                'default' => '(021) 260 1616 ext.4003',
                                'type' => 'text',
                              ),
                              array(
                                'name' => __('Email Contact', 'theme_textdomain'),
                                'desc' => __('Email on contact page.', 'theme_textdomain'),
                                'id' => 'email_contact', //each field id must be unique
                                'default' => 'promosibip@gmail.com',
                                'type' => 'text_email',
                              ),
                              array(
                                'name' => __('Embed Video Youtube', 'theme_textdomain'),
                                'desc' => __('Video for slide on home page.', 'theme_textdomain'),
                                'id' => 'embed_youtube', //each field id must be unique
                                'default' => '',
                                'type' => 'text_url',
                              ),

          )
        );

        $this->option_metabox[] = array(
            'id'         => 'social_options',
            'title'      => 'Social Media Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'social_options' ), ),
            'show_names' => true,
            'fields'     => array(
                              array(
                                'name' => __('Facebook Username', 'theme_textdomain'),
                                'desc' => __('Username of Facebook page.', 'theme_textdomain'),
                                'id' => 'facebook',
                                'default' => '',
                                'type' => 'text'
                              ),
                              array(
                                'name' => __('Twitter Username', 'theme_textdomain'),
                                'desc' => __('Username of Twitter profile.', 'theme_textdomain'),
                                'id' => 'twitter',
                                'default' => '',
                                'type' => 'text'
                              ),
                              array(
                                'name' => __('Youtube Username', 'theme_textdomain'),
                                'desc' => __('Username of Youtube channel.', 'theme_textdomain'),
                                'id' => 'youtube',
                                'default' => '',
                                'type' => 'text'
                              ),
                              array(
                                'name' => __('Instagram Username', 'theme_textdomain'),
                                'desc' => __('Username of Instagram profile/page.', 'theme_textdomain'),
                                'id' => 'instagram',
                                'default' => '',
                                'type' => 'text'
                              ),
                              // array(
                              //   'name' => __('Google+ Profile ID', 'theme_textdomain'),
                              //   'desc' => __('ID of Google+ profile.', 'theme_textdomain'),
                              //   'id' => 'google_plus',
                              //   'default' => '',
                              //   'type' => 'text'
                              // ),
            )
        );

        $this->option_metabox[] = array(
            'id'         => 'about_us',
            'title'      => 'About Us Settings',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( 'about_us' ), ),
            'show_names' => true,
            'fields'     => array(
                              array(
                                'name' => __('About', 'theme_textdomain'),
                                'desc' => __('Our History on About page.', 'theme_textdomain'),
                                'id' => 'history',
                                'default' => '',
                                'type' => 'wysiwyg'
                              ),
                              array(
                                'name' => __('Visi & Misi', 'theme_textdomain'),
                                'desc' => __('Visi & Misi on About Page.', 'theme_textdomain'),
                                'id' => 'visi_misi',
                                'default' => '',
                                'type' => 'text'
                              ),
                              array(
                                'name' => __('Join', 'theme_textdomain'),
                                'desc' => __('Text how join', 'theme_textdomain'),
                                'id' => 'join_text',
                                'default' => '',
                                'type' => 'wysiwyg'
                              ),
                              array(
                                'name' => __('Requirement', 'theme_textdomain'),
                                'desc' => __('List Requirement', 'theme_textdomain'),
                                'id' => 'requirement_about',
                                'default' => '',
                                'type' => 'wysiwyg'
                              ),
                              array(
                                'name' => __('About US Image', 'theme_textdomain'),
                                // 'desc' => __('Logo to be displayed in the header menu.', 'theme_textdomain'),
                                'id' => 'ab_img', //each field id must be unique
                                'default' => '',
                                'type' => 'file',
                              ),
                              // array(
                              //   'name' => __('Misi', 'theme_textdomain'),
                              //   'desc' => __('Misi on About Page.', 'theme_textdomain'),
                              //   'id' => 'misi',
                              //   'default' => '',
                              //   'type' => 'textarea'
                              // ),
                              // array(
                              //   'name' => __('Google+ Profile ID', 'theme_textdomain'),
                              //   'desc' => __('ID of Google+ profile.', 'theme_textdomain'),
                              //   'id' => 'google_plus',
                              //   'default' => '',
                              //   'type' => 'text'
                              // ),
            )
        );

        //insert extra tabs here

        return $this->option_metabox;
    }

    /**
     * Returns the option key for a given field id
     * @since  0.1.0
     * @return array
     */
    public function get_option_key($field_id) {
      $option_tabs = $this->option_fields();
      foreach ($option_tabs as $option_tab) { //search all tabs
        foreach ($option_tab['fields'] as $field) { //search all fields
          if ($field['id'] == $field_id) {
            return $option_tab['id'];
          }
        }
      }
      return $this->key; //return default key if field id not found
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {

        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'fields', 'title', 'options_pages' ), true ) ) {
            return $this->{$field};
        }
        if ( 'option_metabox' === $field ) {
            return $this->option_fields();
        }

        throw new Exception( 'Invalid property: ' . $field );
    }

}

// Get it started
$my_Admin = new my_Admin();
$my_Admin->hooks();

/**
 * Wrapper function around cmb_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function my_option( $key = '' ) {
    global $my_Admin;
    return cmb_get_option( $my_Admin->get_option_key($key), $key );
}

add_action( 'init', 'bip_settings', 9999 );
function bip_settings() {

    if ( ! class_exists( 'cmb_Meta_Box' ) ) {
        require_once (get_template_directory() . '/inc/cmb/init.php');
      }
}


add_filter('widget_text','execute_php',100);
function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}

function format_number($number) {
    if($number >= 1000 && $number < 1000000) {
       return $number/1000 . "k";   // NB: you will want to round this
    }
    elseif($number >= 1000000) {
      return $number/1000000 . "M";
    }
    else {
        return $number;
    }
}

add_theme_support( 'post-thumbnails', array( 'video' ) );
add_theme_support( 'post-thumbnails', array( 'single-video' ) );
add_theme_support( 'post-thumbnails', array( 'event' ) );
add_theme_support( 'post-thumbnails', array( 'single-event' ) );
if ( ! function_exists( 'kpg_setup' ) ) :
function kpg_setup() {
add_theme_support( 'html5', array(
'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
) );
}
endif;
add_action( 'after_setup_theme', 'kpg_setup' );

// add_action( 'admin_menu', 'sql_importer' );

function sql_importer() {
  add_menu_page( 'SQL importer', 'SQL Importer', 'manage_options', 'sql-importer.php', 'sql_importss_page', 'dashicons-tickets', 13  );
}

function author_importer() {
  add_menu_page( 'Author importer', 'Author Importer', 'manage_options', 'author-importer.php', 'sql_import_author_page', 'dashicons-tickets', 13  );
}

function sql_import_page(){
  ?>
  <div class="wrap">
    <h2>Welcome To My Plugin</h2>
  </div>
  <?php
  global $wpdb;
  $sql="SELECT * FROM kpg_books";
  $list_books = $wpdb->get_results($sql);
  if($_GET['migration'] == 'true'):
      $succes = 0;
      foreach ($list_books as $key => $value) {
        $my_post = array(
          'post_title'    => $value->title,
          'post_content'  => $value->synopsis,
          'post_type'     => 'book',
          'post_status'   => 'publish',
          'post_author'   => 1,
        );
        $post_id = wp_insert_post( $my_post, $wp_error );
        if($post_id){
          $succes++;
          $image_url = get_template_directory_uri().'/img/books/'.$value->cover;
          $photo = new WP_Http();
          $photo = $photo->request($image_url);
          if (!is_wp_error($photo)) {
            if($photo['headers']['content-type'] == 'image/jpeg'):
              $attachment = wp_upload_bits($post_id . '_image.jpg', null, $photo['body'], date("Y-m", strtotime($photo['headers']['last-modified'])));

              $filetype = wp_check_filetype(basename($attachment['file']), null);

              $postinfo = array(
                  //'guid'           => $wp_upload_dir['url'] . '/' . basename( $attachment['file'] ),
                  'post_mime_type' => $filetype['type'],
                  'post_title'     => $value->title.' IMAGE',
                  'post_content'   => '',
                  'post_status'    => 'inherit'
              );
              $filename = $attachment['file'];
              $attach_id = wp_insert_attachment($postinfo, $filename, $post_id);
              $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
              wp_update_attachment_metadata($attach_id, $attach_data);
              add_post_meta($post_id, 'front_cover', $attach_id, true);
              add_post_meta($post_id, 'back_cover', $attach_id, true);
            endif;
          }
          add_post_meta($post_id, 'price', $value->price, true);
          add_post_meta($post_id, 'isbn', $value->isbn, true);
          add_post_meta($post_id, 'publishers', $value->price, true);
          add_post_meta($post_id, 'year_of_publication', $value->published, true);
          add_post_meta($post_id, 'pages', $value->pages, true);
          add_post_meta($post_id, 'weight', $value->weight, true);
          $dimension = $value->width.'x'.$value->height;
          add_post_meta($post_id, 'dimension_(wxl)', $dimension, true);
        }
        // add_post_meta($post_id, 'price', $value->price, true);
        // add_post_meta($post_id, 'price', $value->price, true);

    }
    echo "Success import : ".$succes." data";
    // $sql="DELETE FROM kpg_books";
    // $list_books = $wpdb->get_results($sql);
    // $sql="DROP TABLE kpg_books";
    // $list_books = $wpdb->get_results($sql);
    echo '<br><br><a href="edit.php?post_type=book"><button>Back to List</button></a>';
    // wp_redirect(site_url().'admin.php?page=sql-importer.php');
    else:
      echo "<table>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Title</th>";
            echo "<th>Price</th>";
            echo "<th>ISBN</th>";
            echo "<th>AUTHOR</th>";
            echo "<th>PUBLISHER</th>";
            echo "<th>YEAR</th>";
            echo "<th>FORMAT</th>";
            echo "<th>PAGE</th>";
            echo "<th>WEIGHT</th>";
            echo "<th>COVER</th>";
            echo "<th>DIMENSION</th>";
            echo "<th>SERIES</th>";
            echo "<th>KPG</th>";
            echo "<th>COVER</th>";
          echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($list_books as $key => $value) {
          echo "<tr>";
            echo "<td>".$value->id."</td>";
            echo "<td>".$value->title."</td>";
            echo "<td>".$value->price."</td>";
            echo "<td>".$value->isbn."</td>";
            echo "<td>".$value->publisher."</td>";
            echo "<td>".$value->publisher."</td>";
            echo "<td>".$value->published."</td>";
            echo "<td>".$value->title."</td>";
            echo "<td>".$value->pages."</td>";
            echo "<td>".$value->weight."</td>";
            echo "<td>".$value->title."</td>";
            echo "<td>".$value->width.'x'.$value->height."</td>";
            echo "<td>".$value->title."</td>";
            echo "<td>".$value->kpg_id."</td>";
            echo "<td>".$value->cover."</td>";
          echo "</tr>";
        }
        echo "</tbody>";
      echo "</table>";
      if(count($list_books)==0):
        echo "There is no data to import";
      else:
      ?>
      <form method="GET">
        <input type="hidden" name="migration" value="true" />
        <input type="hidden" name="page" value="sql-importer.php" />
        <input type="submit" value="MIGRATE" />
      </form>
      <?php
    endif;endif;
}

function sql_import_author_page(){
  ?>
  <div class="wrap">
    <h2>Welcome To My Plugin</h2>
  </div>
  <?php
  global $wpdb;
  $sql="SELECT * FROM kpg_author";
  $list_books = $wpdb->get_results($sql);
  if($_GET['migration'] == 'true'):
      $succes = 0;
      foreach ($list_books as $key => $value) {
        $my_post = array(
          'post_title'    => $value->name,
          'post_type'     => 'book_author',
          'post_status'   => 'publish',
          'post_author'   => 1,
        );
        $post_id = wp_insert_post( $my_post, $wp_error );
        if($post_id){
          $succes++;
          $image_url = get_template_directory_uri().'/img/author/'.$value->img;
          $photo = new WP_Http();
          $photo = $photo->request($image_url);
          if (!is_wp_error($photo)) {
            if($photo['headers']['content-type'] == 'image/jpeg'):
              $attachment = wp_upload_bits($post_id . '_image.jpg', null, $photo['body'], date("Y-m", strtotime($photo['headers']['last-modified'])));

              $filetype = wp_check_filetype(basename($attachment['file']), null);

              $postinfo = array(
                  //'guid'           => $wp_upload_dir['url'] . '/' . basename( $attachment['file'] ),
                  'post_mime_type' => $filetype['type'],
                  'post_title'     => $value->title.' IMAGE',
                  'post_content'   => '',
                  'post_status'    => 'inherit'
              );
              $filename = $attachment['file'];
              $attach_id = wp_insert_attachment($postinfo, $filename, $post_id);
              $attach_data = wp_generate_attachment_metadata($attach_id, $filename);
              wp_update_attachment_metadata($attach_id, $attach_data);
              add_post_meta($post_id, 'photo', $attach_id, true);
            endif;
          }
          add_post_meta($post_id, 'author_id', $value->id, true);
          add_post_meta($post_id, 'about', $value->bio, true);
          $date = null;
          if($value->birth != '0000-00-00' && $time = date_create($value->birth)){
            $date = $time->format('Ymd');
            add_post_meta($post_id, 'ttl', $date, true);
          }
        }
    }
    echo "Success import : ".$succes." data";
    // $sql="DELETE FROM kpg_books";
    // $list_books = $wpdb->get_results($sql);
    // $sql="DROP TABLE kpg_books";
    // $list_books = $wpdb->get_results($sql);
    echo '<br><br><a href="edit.php?post_type=book"><button>Back to List</button></a>';
    // wp_redirect(site_url().'admin.php?page=sql-importer.php');
    else:
      echo "<table>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Name</th>";
            echo "<th>Birth</th>";
            echo "<th>ORIGIN</th>";
            echo "<th>BIO</th>";
          echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($list_books as $key => $value) {
          $date = null;
          if($value->birth != '0000-00-00' && $time = date_create($value->birth)){
            $date = $time->format('Ymd');
          }
          echo "<tr>";
            echo "<td>".$value->id."</td>";
            echo "<td>".$value->name."</td>";
            echo "<td>".$date."</td>";
            echo "<td>".$value->origin."</td>";
            echo "<td>".$value->img."</td>";
          echo "</tr>";
        }
        echo "</tbody>";
      echo "</table>";
      if(count($list_books)==0):
        echo "There is no data to import";
      else:
      ?>
      <form method="GET">
        <input type="hidden" name="migration" value="true" />
        <input type="hidden" name="page" value="sql-importer.php" />
        <input type="submit" value="MIGRATE" />
      </form>
      <?php
    endif;endif;
}

function sql_imports_page(){
  ?>
  <div class="wrap">
    <h2>Welcome To My Plugin</h2>
  </div>
  <?php
  global $wpdb;
  $sql="SELECT post_id, meta_value FROM  wp_postmeta WHERE meta_key =  'author_id'";
  $list_books = $wpdb->get_results($sql);
  // if($_GET['migration'] == 'true'):
  $arr_author = array();
  foreach ($list_books as $key => $value) {
    $arr_author[$value->meta_value] = $value->post_id;
  }
  $sql="SELECT * FROM kpg_books a inner join kpg_books2author b on a.kpg_id = b.kpg_id";
  $list_relation = $wpdb->get_results($sql);
  // print_r($list_relation);exit();
  // if($_GET['migration'] == 'true'):
  $succes = 0;
  foreach ($list_relation as $key => $value) {
    $product_ch = new WP_Query(array(
            'post_status' => 'publish',
            'post_type' => 'book',
            's' => $value->title,
            'posts_per_page'=> 1
      ));
    $upc = @$product_ch->posts[0]->ID;
    if($upc){
      $succes++;
      $author_id =  $arr_author[$value->author];
      update_post_meta($upc, 'author', $author_id, true);
    }
  }
  echo "Success found : ".$succes." data";
}

function sql_importss_page(){
  ?>
  <div class="wrap">
    <h2>Welcome To My Plugin</h2>
  </div>
  <?php
  global $wpdb;
  $sql="SELECT * FROM kpg_books";
  $list_books = $wpdb->get_results($sql);
      $succes = 0;
      foreach ($list_books as $key => $value) {
        $book_ch = new WP_Query(array(
                    'post_status' => 'publish',
                    'post_type' => 'book',
                    's' => $value->title,
                    'posts_per_page'=> 1
              ));
        $post_id = @$book_ch->posts[0]->ID;
        // print_r($post_id);exit();
        if($post_id){
          $succes++;
        }
        update_post_meta($post_id, 'kpg', $value->kpg_id, true);
        if(update_post_meta($post_id, 'isbn', $value->isbn))
          echo $value->isbn."<br>";
        echo "new: ".$post_id." old: ".$value->kpg_id.'-'.$value->isbn."<br/>";
    }
    echo "Success import : ".$succes." data";
    // $sql="DELETE FROM kpg_books";
    // $list_books = $wpdb->get_results($sql);
    // $sql="DROP TABLE kpg_books";
    // $list_books = $wpdb->get_results($sql);
    echo '<br><br><a href="edit.php?post_type=book"><button>Back to List</button></a>';
}

function category_import(){
  global $wpdb;
  $sql="SELECT c.title, c.kpg_id, b.name FROM kpg_books2category a JOIN kpg_category b ON ( a.category_id = b.id ) JOIN kpg_books c ON ( a.kpg_id = c.kpg_id )";
  $list_relation = $wpdb->get_results($sql);
  $succes = 0;
  foreach ($list_relation as $key => $value) {
    $product_ch = new WP_Query(array(
            'post_status' => 'publish',
            'post_type' => 'book',
            's' => $value->title,
            'posts_per_page'=> 1
      ));
    $upc = @$product_ch->posts[0]->ID;
    if($upc){
      print_r($upc."<br/>");
      $succes++;
      $taxonomy = 'book_type';
      $term = term_exists( $value->name, $taxonomy );
      if ( 0 === $term || null === $term ) {          
        $term = wp_insert_term($value->name,$taxonomy,array('slug' => strtolower( str_ireplace( ' ', '-', $value->name ))));          
      }
      wp_set_post_terms( $upc, $term, $taxonomy,true );
    }
  }
  echo "Success found : ".$succes." data";
}

?>
