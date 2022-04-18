<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script>
$(window).on('load',function(){
    
    $('.js_slick').on('init', function(){
        $(this).css({visibility: 'visible'});
    });

    $('.latest_slick').slick({
        
        dots: false,
        arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: {{$slidesToShow}},
    rtl: {{ (getDir() == "rtl") ? 'true' : 'false' }},
    responsive: [
    {
    breakpoint: 1024,
    settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
    }
    },
    {
    breakpoint: 600,
    settings: {
        slidesToShow: 2,
        slidesToScroll: 2
    }
    },
    {
    breakpoint: 480,
    settings: {
        slidesToShow: 1,
        slidesToScroll: 1
    }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
    ]

    });


    $('.latest_home_slick').slick({
            
            dots: false,
            arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    rtl: {{ (getDir() == "rtl") ? 'true' : 'false' }},
    responsive: [
        {
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
        }
        },
        {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
        }
        },
        {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]

    });



    $('.courses_slick').slick({
            
            dots: false,
            arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    rtl: {{ (getDir() == "rtl") ? 'true' : 'false' }},
    responsive: [
        {
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
        }
        },
        {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
        }
        },
        {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]

    });


            $('.diplomas_slick').slick({
            
            dots: false,
            arrows: true,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    rtl: {{ (getDir() == "rtl") ? 'true' : 'false' }},
    responsive: [
        {
        breakpoint: 1024,
        settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
            dots: true
        }
        },
        {
        breakpoint: 600,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
        }
        },
        {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]

    });


});




</script>
