////////////////////
//Application Module
////////////////////
 var app = (function () {   
     "use strict";  
     //-----------------------------------------------------------------
     // Page Initalization handler : exposed to app.init();
     //-----------------------------------------------------------------
     var init = function () {         
            _accordionHandler();
            _commenEvents();
            _formElements();
            _menuToggle();
            _wowAnimated();
            viewportCondition();  
            _fileBrowes(); 
            _resize();         
         },
          _fileBrowes = function(){
              $(".file-upload").change(function(){
                var x = ($(".file-upload").val());
                $('#file-upload-value').val(x);
              });
           },

        _accordionHandler = function(){
           $('.accordion-item h4').on('click', function(){
              if(!$(this).hasClass('active')){
                   $('.accordion-item h4').removeClass('active');
                   $(".accordion-content").stop(true, true).slideUp();
                   $(this).addClass('active');
                   $(this).parents('.accordion-item').find(".accordion-content").slideDown();
              }else{
                $('.accordion-item h4').removeClass('active');
                   $(".accordion-content").stop(true, true).slideUp();
              }
          });
        },
        _wowAnimated = function() {
          var wow = new WOW(
            {
            animateClass: 'animated',
            offset:60
            }
          );
          wow.init();
        },

        _rippleActions = function() {
            // ripple
            window.rippler = $.ripple('.button', {
                debug: true,
                multi: true,
                opacity: 0.45,
                color: "auto",
                duration: 1
            });
        },

        viewportCondition = function() {

           var containerWidth=$('.container').innerWidth(), 
            windowWidth = $(window).width(),
            xWidth = (windowWidth-containerWidth)/2 + 15; 

          $('.footer-divider hr').css('margin-left', -xWidth);
          $('.footer-divider hr').css('margin-right', -xWidth);
           
        },

        _formElements = function() {
            //form 
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

           if($('.select-menu').length>0){
               $(".select-menu").selectmenu({
                   select: function(event, ui) {
                       var errorText  = $(this).parents('.form-row').find('label').attr('data-error');
                       if($('option:selected',$(this)).index()>0) {
                           $(this).parents('.form-row').removeClass('error-row');
                           $(this).parents('.form-row').find('.error-message').slideUp(function(){
                               $(this).remove();
                           });
                       } else {
                           $(this).parents('.form-row').addClass('error-row');
                           $(this).parents('.form-row').find('.error-message').slideDown(); 
                       }
                   }
               });
           }

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

            $('input, textarea').keyup(function() {
                if ($(this).val() !== "") {
                    $(this).addClass('input-email-active'); 
                } else {
                    $(this).removeClass('input-email-active');  
                } 
            });

            $('.client-slider').slick({ 
              autoplay:true,
              autoplaySpeed:1500,
              infinite: false,
              speed: 300,
              arrows: false,
              slidesToShow: 4,
              slidesToScroll: 1,
              dots: true
            });
            $('.insta-slider').slick({              
              infinite: false,
              speed: 300,
              arrows: false,
              slidesToShow: 1,
              slidesToScroll: 1,
              dots: false
            });
            $('.prev').click(function(){
              $('.insta-slider').slick('slickPrev');
            })

            $('.next').click(function(){
              $('.insta-slider').slick('slickNext');
            })
        },

        _menuToggle = function() {
          $('.menu-toggle').on('click', function() {
            $('body').addClass('y-hidden');
            $('.menu-open').addClass('slide');
          });
          $('.menu-close').on('click', function() {
            $('body').removeClass('y-hidden');
            $('.menu-open').removeClass('slide');
          });
        },

        _resize = function(){
          var containerWidth = $('.container').innerWidth();
           var windowWidth = $(window).width();
          var xWidth = (windowWidth-containerWidth)/2 + 15;
          console.log(xWidth);
           $('.extand-section').css('margin-left', -xWidth);
          $('.extand-section').css('margin-right', -xWidth);
        },

        _commenEvents = function() {
            // Add common js here
        };


    // Expose Global Functions
    return {
         init: init,
         viewportCondition: viewportCondition
     };
 })();

$(window).scroll(function() { 
   //scroll function here

});

$().ready(function () {
    app.init();           
});

$(window).resize(function(){
  app.viewportCondition();
});
if(Modernizr.touch){  
  //modernizer touch function code here for mobile
}
$(window).on('load', function() { 
  $('.render-blk').stop(true, true).animate({opacity:1}, 1000);
  if(sessionStorage.getItem('loader') == null) {
    NProgress.done();  
    sessionStorage.setItem('loader', 'true');
  }else{      
    NProgress.done();
  }
});
