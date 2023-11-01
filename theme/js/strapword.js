/*!
 * strapword JS
 */
function waitForElm(selector) {
    return new Promise(resolve => {
        if (document.querySelector(selector)) {
            return resolve(document.querySelector(selector));
        }

        const observer = new MutationObserver(mutations => {
            if (document.querySelector(selector)) {
                resolve(document.querySelector(selector));
                observer.disconnect();
            }
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
}

(function ($) {
    'use strict';
    $(document).ready(function () {

        /* =============================== */
        /*            Login Form           */
        /* =============================== */
        var lis = $('#wppb-loginform').find('p:not(.login-remember)');
        //console.log('#wppb-loginform lis', lis);
        lis.each(function( index ) {
            var li = $( this );
            //console.log('li', li);
            
            var label = li.find('> label:first-of-type');
            //console.log('label', label);
            li.find('input.input').insertBefore(label);
        });

        /* =============================== */
        /*          Lost password          */
        /* =============================== 
        var lis = $('#wppb-recover-password').find('p:not(.login-remember)');
        console.log('lis', lis);
        lis.each(function( index ) {
            var li = $( this );
            console.log('li', li);
            
            var label = li.find('> label:first-of-type');
            console.log('label', label);
            li.find('input.input').insertBefore(label);
        });*/
        /* =============================== */
        /*          Register Form          */
        /* =============================== */
        if ($('input[name=username]').length > 0) {
            $('input[name=username]').on( 'keyup', function( e ) {
                //console.log('e', $(this))
                var newVal = $(this).val().replace(/\s/g, "");
                $(this).val(newVal);
            })
        }

        var lis = $('.wppb-register-user, #wppb-recover-password, #wppb-edit-user-wppb-default-edit-profile').find('.wppb-form-field');
        //console.log('#wppb-recover-password lis', lis);
        lis.each(function( index ) {
            var li = $( this );
            //console.log('# li', li);
            
            var input = li.find('input.text-input, input.password, select, textarea');
            //console.log('# input', input);
            var label = li.find('> label:first-of-type');
            //console.log('# label', label);
1
            input.insertBefore(label);
        });

        /* =============================== */
        /*        Messages privates        */
        /* =============================== */
        waitForElm('#message_content_ifr').then((elm) => {
            //var iframe = document.getElementById("message_content_ifr");
            console.log('te encontre', elm);
            var elmnt = elm.contentWindow.document.getElementsByTagName('body')[0];
            elmnt.style.background = '#121212';
            elmnt.style.color = '#00d950';
            elmnt.style.fontFamily = '"Roboto Mono", monospace';

        });
        
        /* =============================== */
        /*              Go Top             */
        /* =============================== */
        if (location.hash) {
            console.log('location', location.hash);            
            if (location.hash[1] != '.') {
                smoothScrollingTo(location.hash);
            }
        }

        function smoothScrollingTo(target) {
            console.log('smoothScrollingTo target', target);
            $('html,body').animate({ scrollTop: $(target).offset().top - 90 }, 300);
        }


        $('.smooth > a[href^="#"], a[href^="#"].smooth').on('click', function (event) {
            event.preventDefault();

            console.log('gola estaba abierto', document.querySelector('.mobile-offcanvas.show'));
            if (document.querySelector('.mobile-offcanvas.show') != null) {
                close_offcanvas();
            }

            smoothScrollingTo(this.hash);
        });

        function onScroll(event) {
            var scrollPos = $(document).scrollTop();
            //console.log('scrollPos '+scrollPos);
            
            if (scrollPos > 300) {
                $('.go-top').addClass('on');

            } else {
                $('.go-top').removeClass('on');
            }
            
        }
        $(document).on("scroll", onScroll);

        /* =============================== */
        /*           Swiper Init           */
        /* =============================== */

        /** Slide Home */
        new Swiper(".swiper-home", { //Change class with class slide
            
            //watchOverflow: true,
            slidesPerView: 1,
            spaceBetween: 20,
            
            //loop: true,
  
            autoplay: false,

            navigation: {
                nextEl: ".swiper-home .swiper-button-next",
                prevEl: ".swiper-home .swiper-button-prev",
            },
            /* pagination: {
                el: ".swiper-home .swiper-pagination",
                clickable: true
            }, */
            /* breakpoints: {
                // when window width is >= 768px
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
            } */
        });

        /** Slide Destacados */
        new Swiper(".swiper-destacados", { //Change class with class slide
            //watchOverflow: true,
            slidesPerView: 1,
            spaceBetween: 10,
            //loop: true,
            //autoplay: false,
            navigation: {
                nextEl: ".swiper-destacados .swiper-button-next",
                prevEl: ".swiper-destacados .swiper-button-prev",
            },
            pagination: {
                el: ".swiper-destacados .swiper-pagination",
                clickable: true
            },
            breakpoints: {
                // when window width is >= 768px
                768: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 20,
                },
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 20,
                },
            }
        });

        /** Slide Destacados */
        new Swiper(".swiper-cats", { //Change class with class slide
            //watchOverflow: true,
            slidesPerView: 1,
            spaceBetween: 10,
            //loop: true,
            //autoplay: false,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            breakpoints: {
                // when window width is >= 768px
                768: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                }
            }
        });

        /* =============================== */
        /*           Logs Gallery          */
        /* =============================== */
        // Function that actually builds the swiper 
        const thumbSwiperSlider = thumbElm => {
            return new Swiper(`#${thumbElm.dataset.id}`, {
                slidesPerView: 2,
                spaceBetween: 10,
    
                loop: false,
                autoplay: false,
                freeMode: true,

                breakpoints: {
                    // when window width is >= 768px
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    1200: {
                        slidesPerView: 5,
                        spaceBetween: 20,
                    },
                } 
            });
        }
        // Function that actually builds the swiper 
        const modalSwiperSlider = modalElm => {
            let thumbsId = 'thumb' + modalElm.dataset.id.slice(5);
            let thumbsSwiper = document.getElementById(`${thumbsId}`).swiper;

            return new Swiper(`#${modalElm.dataset.id}`, {
                slidesPerView: 1,
                spaceBetween: 20,

                loop: false,
                autoplay: false,

                thumbs: {
                    swiper: thumbsSwiper,
                },
                navigation: {
                    nextEl: `.swiper-button-next`,
                    prevEl: `.swiper-button-prev`
                },
                /* pagination: {
                    el: `.swiper-modal .swiper-pagination-${sliderIdentifier}`,
                    type: 'progressbar',
                }, */
            });
        }

        // Get all of the swipers on the page
        const thumbSliders = document.querySelectorAll('.swiper-thumb');
        const modalSliders = document.querySelectorAll('.swiper-modal');

        // Loop over all of the fetched sliders and apply Swiper on each one.
        thumbSliders.forEach( slider => thumbSwiperSlider(slider));
        modalSliders.forEach( slider => modalSwiperSlider(slider));

        /*===============================
        =            Scrolla            =
        ===============================*/
        $('.animate').scrolla({
            once: true // only once animation play on scroll
        });

        /* =============================== */
        /*               ACF               */
        /* =============================== */
        if ($('.buddypress .buddypress-wrap a.button, body #buddypress input[type=submit]').length > 0) {
            $('.buddypress .buddypress-wrap a.button, body #buddypress input[type=submit]').removeClass('button');
        }

		/*====================================
		=            OFERTA BADGE            =
		====================================*/
		if (!$('.flex-control-nav.flex-control-thumbs').length) {
			//console.log('que once');
			$('span.onsale').addClass('superleft');
		}

        // acomodar soldout abajo sobre la imagen
		if ($('.soldout').length > 0) {
            let badge = $('.soldout');
            var img = badge.prev().height();            
            let alto =  img - 34;
			badge.css('top', '' + alto + 'px');
		}

        /* =============================== */
        /*       same height products      */
        /* =============================== */
        //document.documentElement.style.setProperty("--product-h", '460px');
        $(window).on('load resize', function() {
            let h = $('ul.products li.product');
            let t = 0; // the height of the highest element (after the function runs)
            let t_elem;  // the highest element (after the function runs)

            $(h,t_elem).each(function () {
                var myThis = $(this);
                if ( myThis.outerHeight() > t ) {
                    t_elem=this;
                    t=myThis.outerHeight();
                }
            });
            //let productH = t_elem.height()
            //console.log('h', h);
            document.documentElement.style.setProperty("--product-h", t+'px');
        })


    });
}(jQuery));
