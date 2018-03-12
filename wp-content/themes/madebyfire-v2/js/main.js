/* Build-in Functions */
function setWinHgt(){
	var winWid = $(window).width();
	var winHgt = $(window).height();
	$('#navSliderScroll').css('width', $(window).width()+"px");
} 
function slideFull(){
    var breadheight = $('.maindiv').outerHeight();
    var sideheight = $('.sticky').outerHeight();
    var introheight = $('.equaldiv .col-xs-10').outerHeight();
    $('.sticky').css({'top':breadheight});
    // if(sideheight <= introheight) {
    //    $('.sticky').css({'top':breadheight});
    // }else{
    //     $('.sticky').css({'top':0});
    // }
    

	var winWid = $(window).width();
	var containerWidth = $('.container').width();
    var containerOuter = $('.container').outerWidth();
    
    var outSlide1 = $('.outContain').width(); 
    var centerWidth = $('.title-head .center-block').width();
    var centermaxWidth = Math.round((containerWidth - centerWidth)/2);
    var containerFullwidth = Math.round((containerOuter - centerWidth)/2);
	var outSlide2 = Math.round((winWid - containerWidth)/2);
    var outSlide3 = centermaxWidth + outSlide2;
    $('.fullslider').css({'margin-left':-outSlide3, 'margin-right':-outSlide3});
	$('.slideCap').css({width:containerWidth});
    $('.leftcaption').css({'margin-left':-containerFullwidth,'width':containerWidth});

    if(winWid <= 640) {
        $('.sidebar-paragraph').insertAfter('.sidebar--line ul');
        $('.sub-introcontent .col-xs-2').insertBefore('.col-xs-10');
    } else {
         $('.sub-introcontent .col-xs-2').insertAfter('.col-xs-10');
        $('.sidebar-paragraph').insertBefore('.sidebar--line ul');
    }
    
    $('.container-stretched').css({width:containerWidth});
    $('.container-fullwidth').css({'margin-left':-containerFullwidth, 'width':containerOuter})
} 

/* Ready Functions */
$(function(){
        $('.mobile-heading h2').text($('.title-head h1').text());
        $("#homePage, #subPage").delay(500).animate({opacity:1},{duration:800});
        $('.logo').animate({'opacity':1}, 1500);
		$('[data-bg]').each(function(){
    		var curBg = $(this).data('bg');
    		$(this).css({'background-image':'url('+curBg+')','filter':'progid:DXImageTransform.Microsoft.AlphaImageLoader(src='+curBg+',sizingMethod=scale)'});
	    });
	    /* Animation */ 
	    $('*[data-animated]').addClass('animated');
	    function animated_contents() {
	       $(".animated:appeared").each(function (i) {
    			var $this    = $(this),
    				animated = $(this).data('animated'),
    				delay = $(this).data('delay');
    			setTimeout(function () { 
    				$this.addClass(animated);
    				$this.addClass('delay'+delay);
    			}, 70 * i);
    		});		
    	}
        function animated_load() {
            $(".animated:appeared").each(function (i) {
			var $this    = $(this),
			animated = $(this).data('animates'),
			delay = $(this).data('delay');
			setTimeout(function () {
				$this.addClass(animated);
				$this.addClass('delay'+delay);
			}, 70 * i);
		});
	}
	setTimeout(animated_load,1000);
	$(window).scroll(function() {
		animated_contents();
	});
	
	$('.menuHum').on('click', function(){
		$('body, header, .menuHum').toggleClass('open');
	});

    //accordion
    var $title = $('.accordion h2');
    var copy   = '.accordion-copy';
        $('.accordion').each(function(){
      // $(this).find('.accordion-item:first').addClass('active');
      // $(this).find('.accordion-item:first').find(copy).show();
    });   

    $title.click(function () { 
      $(this).parent().siblings().removeClass('active'); 
      $(this).parent().toggleClass('active');
      $(this).next(copy).slideToggle(); 
      $(this).parent().siblings().children().next().slideUp();
      return false; 
    });

	slideFull();
    formElements();
	$('.slideImg').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        arrows: true
	});
    $('.slideImg').slickLightbox({
        src: 'src',
        itemSelector: '.image-slider img'
    });

    // $('.genericpageslider-js').slick({ 
    //     slidesToShow: 1, 
    //     slidesToScroll: 1,
    //     dots: true,
    //     arrows: true,
    //     infinite: true,
    // }); 
    $('#cardSlider').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        autoplay: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                centerMode: true,
                centerPadding: '30px',
                dots: true,
                slidesToShow: 1,
                slidesToScroll: 1
            }
         }]
    });
    $('.slider-2').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        dots: false,
        arrows: true,
        autoplay: true,
        responsive: [{
            breakpoint: 940,
            settings: {
              dots: true,
              slidesToShow: 3,
              slidesToScroll: 1
            }
         }, {
            breakpoint: 768,
            settings: {
                dots: true,
                slidesToShow: 2,
                slidesToScroll: 1
            }
         }, {
            breakpoint: 640,
            settings: {
                centerMode: true,
                centerPadding: '30px',
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1
            }
         }]
     });

	var li_width = 0;
	$('#navSliderScroll li').each(function(){
		li_width += $(this).innerWidth();
	});
	$('#navSliderScroll ul').css('width', li_width+"px");
	$('#navSliderScroll li a').click(function(){
		$('html, body').animate({
			scrollTop:$('#navSlider').offset().top-95
		}, 700)
		return false; 
	});

	$('.expt-desc p').matchHeight();
	$('.pro-box').matchHeight();
    $('.portfolioItems .news-card').matchHeight();
    $('#cardSlider .news-desc').matchHeight();
        
    $('.email-btn').on('click', function(){
       $(this).parents('.email-blk').fadeOut(500, function(){
           $('.thank-u').fadeIn();
       }); 
    });


    
    $('.done-btn').on('click', function(){
        $(this).parents('.thank-u').fadeOut(500, function(){
           $('.email-blk').fadeIn();
       }); 
    });

    // isotope
    var $activeCategory = $('.worknav li a.active').data('filter');

    var highestBox = 0;
    $('.eqHeight', this).each(function(){
        if($(this).height() > highestBox) {
            highestBox = $(this).height(); 
        }          
    });             
    $('.eqHeight',this).height(highestBox);


    $('.worknav li a').click(function() {
        $('.worknav li a').removeClass('active');
        $(this).addClass('active');
        var $thisAttr = $(this).data('filter')
        $portfolioItems.isotope({
            filter: $thisAttr
        });
        return false;
    });

    $('.image-blk .images-col').each(function(){
		var imgUrl = $(this).find('img').attr('src');
		$(this).css('background-image', 'url('+ imgUrl +')');
	});

    /* select menu */
    function formElements() {
       /*jquery ui selectbox placeholder start*/
        $.widget('app.selectmenu', $.ui.selectmenu, {
            _drawButton: function() {
                this._super();
                var selected = this.element
                .find('[selected]')
                .length,
                placeholder = this.options.placeholder;

                if (!selected && placeholder) {
                    this.buttonItem.text(placeholder);
                } 
            }
        });

        //Select menu
        $('.select-menu').each(function() {
          var $placeholder = $(this).data('placeholder');
          $(this).selectmenu({
              placeholder: $placeholder,
              appendTo: $(this).parent(".select-row"),
              create: function(event, ui) {
                  $('.ui-selectmenu-text').addClass('placeholder');
              },
              change: function(event, ui) {
                  $('.ui-selectmenu-text').removeClass('placeholder');
              }
          });
        });
        $(".select-menu").selectmenu({
            change: function(event, ui) {
              if ($('.select-menu option:selected').val() != 0) {
                  $('.select-menu').find('.error-message').hide();
                  $('.select-menu').parent('.form-row').removeClass('error-row');
              }
            }
        });

        $('.floating-item input, textarea').focus(function(){
            $(this).parent('.floating-item').addClass('input-animate'); 
        });
    }

	/* Contact page form */

    // Email validation
    $('input[type="email"], input[type="text"], input[type="number"], input[type="tel"], textarea').keyup(function() {
        if ($(this).val() !== "") {
            $(this).addClass('input-email-active');
        } else {
            $(this).removeClass('input-email-active');
        }
    });

    // form validation
    $(".form-wrap .input-item").not(".non-mandatory").bind({                
        keyup: function() {
            var $thisValue = $(this).val();
            var errorText  = $(this).parents('.form-row').find('label').attr('data-error');
            if ($thisValue.length != 0) {
                $(this).parents('.form-row').removeClass('error-row');
                $(this).parents('.form-row').find('.error-message').fadeOut(function(){
                    $(this).remove();
                });
            }
        },
        blur: function() {
            var $thisValue = $(this).val();
            var $errorText  = $(this).parents('.form-row').find('label').attr('data-error');

            if ($thisValue.length == 0) {
                $(this).parents('.form-row').addClass('error-row');
                if($(this).parents('.form-row').find('.error-message').length==0) {
                    $(this).parents('.form-row').append('<div class="error-message">'+$errorText+'</div>');
                }
            } else {
                $(this).parents('.form-row').removeClass('error-row');
            }
        }
    });

    $('.button-submit').on('click', function(){
        var $val = 0;

        var $fname = $('#name'),
            $fnameVal = $fname.val();
        if ($fnameVal.length == 0) {
             var $errorText  = $fname.parents('.form-row').find('label').attr('data-error');
            $fname.parents('.form-row').addClass('error-row');
            if($fname.parents('.form-row').find('.error-message').length==0) {
                $fname.parents('.form-row').append('<div class="error-message">'+$errorText+'</div>');
            }else {
                $fname.parents('.form-row').removeClass('error-row');
            }
            $val += 1;
        }

        var $lname = $('#phone'),
            $lnameVal = $lname.val();
        if ($lnameVal.length == 0) {
             var $errorText  = $lname.parents('.form-row').find('label').attr('data-error');
            $lname.parents('.form-row').addClass('error-row');
            if($lname.parents('.form-row').find('.error-message').length==0) {
                $lname.parents('.form-row').append('<div class="error-message">'+$errorText+'</div>');
            }else {
                $lname.parents('.form-row').removeClass('error-row');
            }
            $val += 1;
        }

        var $email = $('#email'),
            $emailVal = $email.val();
        if ($emailVal.length == 0) {
             var $errorText  = $email.parents('.form-row').find('label').attr('data-error');
            $email.parents('.form-row').addClass('error-row');
            if($email.parents('.form-row').find('.error-message').length==0) {
                $email.parents('.form-row').append('<div class="error-message">'+$errorText+'</div>');
            }else {
                $email.parents('.form-row').removeClass('error-row');
            }
            $val += 1;
        }
        var $message = $('#message'),
            $messageVal = $message.val();
        if ($messageVal.length == 0) {
             var $errorText  = $message.parents('.form-row').find('label').attr('data-error');
            $message.parents('.form-row').addClass('error-row');
            if($message.parents('.form-row').find('.error-message').length==0) {
                $message.parents('.form-row').append('<div class="error-message">'+$errorText+'</div>');
            }else {
                $message.parents('.form-row').removeClass('error-row');
            }
            $val += 1;
        }
    });

    $('#email').bind('keyup',function () {
	    var $email = this.value;
	    validateEmail($email);
	});

        
	setWinHgt();  
	// midDiv();
    NProgress.configure({ showSpinner: false }).start();
});

function validateEmail(email) {
    var $email = $('#email'),
    	$emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/, 
    	$errorText  = $email.parents('.form-row').find('label').attr('data-error-valid'),
    	$emailVal = $email.val();

    if (!$emailReg.test(email)) {
        $('.notvalid-error-message').show();
        $email.parents('.form-row').addClass('error-row-email');
    }else{
    	$('.notvalid-error-message').hide();
    	$email.parents('.form-row').removeClass('error-row-email');
    }
} 

if(!Modernizr.touch) {
	$(window).resize(function(){
		/* Init Functions */
		setWinHgt();
		// midDiv();
		slideFull();
	});
	$("input[type='tel']").attr('type', 'number'); 
}

$(window).scroll(function(e) {
	var winWid = $(window).width();
	if(winWid>1024) {
		var opac = 1-$(window).scrollTop() * 10 / $(window).height() / 10;
		$('.madeIntro .row').css('opacity',opac);
		}
});

$(window).on("orientationchange",function(){
	/* Init Functions */
	setWinHgt();
	// midDiv();
	setTimeout(function() { slideFull(); }, 200);
});

$(window).on('load', function() {

    $('.project-image').each(function(){
        $(this).find('img').css({width:$(this).find('img').innerWidth()/2})
    });
    if(sessionStorage.getItem('loader') == null) {
        NProgress.done();  
        sessionStorage.setItem('loader', 'true');
    }else{      
        NProgress.done();
    }
})