$(window).on('load', function(){
    $('.loading').fadeOut(500);
  });
  
  $('.section-2 .owl-carousel').owlCarousel({
    loop:false,
    autoplay:true,
    autoplayTimeout:6000,
    autoplaySpeed: 2000,
    rtl: true,
    margin:10,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true,
            dots:false,
        },
        600:{
            items:1,
            nav:true,
            dots:false,
        },
        1000:{
            items:1,
            nav:true,
            dots:false,
            loop:false
        }
    }
  })
  
  $('.section-3 .owl-carousel').owlCarousel({
    loop:false,
    autoplay:true,
    autoplayTimeout:6000,
    rtl: true,
    autoplaySpeed: 2000,
    margin:40,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:false,
            dots:true,
        },
        600:{
            items:2,
            nav:false,
            dots:true,
        },
        1000:{
            items:3,
            nav:false,
            dots:true,
            loop:false
        }
    }
  })

  $('.section-7 .owl-carousel').owlCarousel({
    loop:false,
    items: 1,
    nav: false,
    dots: true,
    rtl: true,
  })
  
  $('#video').parent().click(function () {
    if($(this).children("#video").get(0).paused){
        $(this).children("#video").get(0).play();
        $(this).children(".playpause").fadeOut();
    }else{
       $(this).children("#video").get(0).pause();
        $(this).children(".playpause").fadeIn();
    }
  });
  
  
  
  $('.main-header .nav-link').click(function(){
    $('html, body').animate({
        scrollTop: $( $(this).attr('href') ).offset().top
    }, 500);
    return false;
  });
  
  
  $('.main-header .nav-link').on('click', function(){
    $('.navbar-collapse').collapse('hide');
  });
  
  
  
  
  
  