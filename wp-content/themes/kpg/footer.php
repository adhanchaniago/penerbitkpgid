<?php
/**
 * The theme footer
 *
 * @package bootstrap-basic
 */
$sosmed_url = get_option('social_options','null');
$general_option = get_option('general_settings','null');
$address = $general_option['address_pubh'];
$address = str_replace(' | ', '<br />', $address);

$footer_menu = wp_get_nav_menu_items('footer');
$arr_menu = array();
foreach ($footer_menu as $key => $value) {
  if($value->menu_item_parent == 0){
    $arr_menu[$value->ID] = array(
        'name' =>$value->title,
        'url' =>$value->url,
        'submenu' => array()
      );
  }else{
    $arr_menu[$value->menu_item_parent]['submenu'][$value->ID] = array(
      'name' => $value->title,
      'url' => $value->url
    );
  }
}
?>

			<!--.site-content-->
			<footer>
      <div class="container">
        <div class="row">
          <div class="col-md-5 col-sm-6 footerleft">
            <address>
             <p>
                 <img src="<?php echo get_template_directory_uri() ?>/img/kpg-logo-small.png" class="pull-left"/>
                <!-- Gedung Kompas Gramedia . Blok 1 lt.3<br /> Jl. Palmerah Brat 29-37. Jakarta 10270, Indonesia<br />  Telp. 021-53650110, 536550111 ext 3362 - 3364. <br /> Fax. 021 - 53698044 -->
                <?php echo $address;  ?>
            </p>
            </address>
          </div>
          <?php 
            foreach ($arr_menu as $key => $value) {
              echo '<div class="col-md-2 col-sm-6 paddingtop-bottom">';
              echo '<h6 class="heading7">'.$value['name'].'</h6>';
              if(count($value['submenu'])){
                echo '<ul class="footer-ul">';  
                foreach ($value['submenu'] as $subkey => $subvalue) {
                  echo '<li><a href="'.$subvalue['url'].'"> '.$subvalue['name'].'</a></li>';
                }
                echo '</ul>';
              }              
            echo '</div>';
            }
           ?>
          <div class="col-md-3 col-sm-6 paddingtop-bottom text-right">
            <a href="<?php echo $general_option['catalog']; ?>" download class="btn btn-yellow"><i class="fa fa-upload"></i> UNDUH KATALOG</a>
            <div class="clear"></div>
            <a href="" class="kompas-logo">
                <img src="<?php echo get_template_directory_uri() ?>/img/kompas-logo.png" />
            </a>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyright">
        <div class="container">
            <div class="col-md-12">
                <p class="text-center">Copyright (c) <?php echo date('Y'); ?> Kepustakaan Gramedia . All RIght Reserved.</p>
            </div>

        </div>
    </div>

<?php wp_footer(); ?>
<?php if(is_home()): ?>
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
<?php endif; ?>
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
<!-- add mansory -->
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/vendor/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri() ?>/js/vendor/imagesloaded.pkgd.min.js"></script>

<script type="text/javascript">
$(function () {
  var grid = document.querySelector('#grid-container');
  var msnry,msnry2;
  
  imagesLoaded( grid, function() {
    // init Isotope after all images have loaded
    msnry = new Masonry( grid, {
      itemSelector: '.grid-item',
    });
  });
});
</script>
<!-- add mansory -->
</body>
</html>
