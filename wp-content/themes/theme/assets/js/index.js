function openNav() {
    $('#menu-mobile').css({
        transform: 'translateX(0)'
    });
    $('#menu-mobile').css({
        transition: 'all 0.5s'
    });
    $('body').css({
        overflow: 'hidden'
    });
}

function closeNav() {
    $('#menu-mobile').css({
        transform: 'translateX(-300px)'
    });
    $('#menu-mobile').css({
        transition: 'all 0.5s'
    });
    $('body').css({
        overflow: 'visible'
    });
}

$(document).ready(function(){
    var  menuOfsetTop = $(".menu--top").offset().top;
    $('body').append('<button id="scroll-top"  class="scroll-to-top"> <i class="fa fa-arrow-up" aria-hidden="true"></i></button>');
    $(window).on('scroll',function () {
        if ($(this).scrollTop() != 0) {
            $('#scroll-top').fadeIn();
        } else {
            $('#scroll-top').fadeOut();
        }

        if(window.pageYOffset > menuOfsetTop){
            $('.menu--top').addClass('fix-top');
        }else{
            $('.menu--top').removeClass('fix-top');
        }

        $('#scroll-top').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 600);
            return false;
        });
        
    }); 
    var ccc = $('#menu-mobile ul li').find('ul');
    if (ccc.length !== 0) {
        ccc.before('<button class="accordion"></button>');
        ccc.addClass('sub-menu');
    }
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight +"px";
            }
        }
    }

    new WOW().init();
    $('.slide--banner--js').owlCarousel({
        loop:true,
        nav:true,
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    })
    $('.slide-khach-hang').owlCarousel({
        loop:true,
        nav:true,
        margin: 30,
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
    });

    $(".question").each(function(){
        console.log("1")
        $(this).click(function(){
            $(this).parent(".cau-hoi").toggleClass("show");
        })
    });

    $('a[href^="#"]').on('click', function(event) {
    var target = $( $(this).attr('href') );
    if( target.length ) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: target.offset().top,
            scrollBottom: target.offset().bottom
        }, 3000);
    } })
})
