jQuery(document).ready(function($){
    var offset = 300,
        offset_opacity = 1200,
        scroll_top_duration = 700,
        $back_to_top = $('.wd-top');

    $(window).scroll(function(){
        ( $(this).scrollTop() > offset ) ? $back_to_top.addClass('wd-is-visible') : $back_to_top.removeClass('wd-is-visible wd-fade-out');
        if( $(this).scrollTop() > offset_opacity ) {
            $back_to_top.addClass('wd-fade-out');
        }
    });

    //smooth scroll to top
    $back_to_top.on('click', function(event){
        event.preventDefault();
        $('body,html').animate({
            scrollTop: 0 ,
            }, scroll_top_duration
        );
    });


    // nav
    var didScroll;
      var lastScrollTop = 0;
      var delta = 5;
      var navbarHeight = $('.main-header').outerHeight();

      $(window).scroll(function(event){
          didScroll = true;
      });

      setInterval(function() {
          if (didScroll) {
              hasScrolled();
              didScroll = false;
          }
      }, 250);

      function hasScrolled() {
          var st = $(this).scrollTop();
          if(Math.abs(lastScrollTop - st) <= delta)
              return;
          if (st > lastScrollTop && st > navbarHeight){
              $('.main-header').removeClass('nav-down').addClass('nav-up');
          } else {
              if(st + $(window).height() < $(document).height()) {
                  $('.main-header').removeClass('nav-up').addClass('nav-down');
              }
          }

          lastScrollTop = st;
      }

    $('#submitMailContact').click(function(e){
    var formcontact = $('#frmMailContact').serialize();
    // This does the ajax request
    $.ajax({
        type : 'POST',
        url : '/wp-admin/admin-ajax.php',
        // dataType:'json',
        data: {
            'action': 'ajax_MailContact',
            'frmcontact' : formcontact,
        },
        success:function(data) {
            // This outputs the result of the ajax request
            document.getElementById("frmMailContact").reset();
            alert(data);
        },
        error: function(errorThrown){
            // console.log(errorThrown);
            alert('asdad');
        }
    }); 
    });

    $('#SubmitSendEmails').click(function(e){
    var formsend = $('#frmSendEmails').serialize();
    var reg = /\<body[^>]*\>([^]*)\<\/body/m;
    var validator = jQuery("#frmSendEmails").validate({
        
      rules: {
        name: "required",
        books: "required",
        urls: {
          required: true,
          url: true
        }
      }

      });
    if(jQuery("#frmSendEmails").valid() ){
          $('.mailLoad').show();
          $.ajax({
              type : 'POST',
              iframe: true,
              processData: false,
              // cache: false,
              // contentType: false,
              // dataType: 'json',
              files: $('#attachs'),
              url : '/wp-admin/admin-ajax.php',
              data: {
                  // type: 'POST',
                  action: 'ajax_SendMails',
                  frmsend : formsend,
              },
              success:function(data) {
                  // This outputs the result of the ajax request
                  $('.mailLoad').hide();
                  document.getElementById("frmSendEmails").reset();
                  alert(data.match(reg)[1]);
              },
              error: function(errorThrown){
                  // console.log(errorThrown);
                  alert('errorThrown');
              }
          }); 
    } else {
      validator.focusInvalid();
    }

    });

  $('#submitmailcareer').click(function(e){
    var formsend = $('#frmmailcareer').serialize();
    var reg = /\<body[^>]*\>([^]*)\<\/body/m;
    $('.eror').hide();
    var validator = jQuery("#frmmailcareer").validate({
        
      rules: {
        namecareer: "required",
        emailcareer: {
              required: true,
              email: true
        },
        phonecareer: {
                    required: true,
                    number: true
        },
        subjectcareer: "required",
        addresscareer: "required",
        messagecareer: "required"
        // attachcareer: "required"
      }

      });
    if(jQuery("#frmmailcareer").valid() ){
          $('.mailLoad').show();
          $.ajax({
              type : 'POST',
              url : '/wp-admin/admin-ajax.php',
              data: {
                  action: 'ajax_SendMailCareer',
                  frmsend : formsend,
              },
              success: function(data) {
                  // This outputs the result of the ajax request
                  if (data == 'Please enter your reCAPTCHA' || data == 'Please re-enter your reCAPTCHA') {
                        $('.mailLoad').hide();
                        grecaptcha.reset(); // reloads a new code
                        $("#hiddenRecaptcha").before('<label class="eror">'+data+'</label>'); // error message
                    } else {
                        $('.mailLoad').hide();
                        document.getElementById("frmmailcareer").reset();
                        grecaptcha.reset();
                        // alert(data.match(reg)[1]);
                        alert(data);
                    }
              },
              error: function(errorThrown){
                  $('.mailLoad').hide();
                  // console.log(errorThrown);
                  grecaptcha.reset();
                  alert('errorThrown');
              }
          }); 
    } else {
      validator.focusInvalid();
    }

    });

    $('#submitmailauthor').click(function(e){
    var formsend = $('#frmmailauthor').serialize();
    var validator = jQuery("#frmmailauthor").validate({
        
      rules: {
        subjectcontact: "required",
        namecontact: "required",
        messagecontact: "required",
      }

      });

    if(jQuery("#frmmailauthor").valid()){
      $('.mailLoad').show();
          $.ajax({
              type : 'POST',
              url : '/wp-admin/admin-ajax.php',
              data: {
                  action: 'ajax_mailauthor',
                  frmsend : formsend,
              },
              success:function(data) {
                  // This outputs the result of the ajax request
                  $('.mailLoad').hide();
                  document.getElementById("frmmailauthor").reset();
                  alert(data);
              },
              error: function(errorThrown){
                  // console.log(errorThrown);
                  alert('errorThrown');
              }
          }); 
    } else {
      validator.focusInvalid();
    }
    });
  $(document).ready(function(){
    var showChar = 1052;
    var ellipsestext = "...";
    var moretext = "more";
    var lesstext = "less";
    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar-1, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
            console.log(html);
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
  });

$('.ModalLink').on('click', function(){
        var passID = $(this).data('id');
        $('#id').val(passID);

        $('.subjectcareer').val( '[JOB APPLY]'+passID );
      });
});