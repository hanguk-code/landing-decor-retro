$(function () {

    // $(".btn-header").fancybox({});

    // $('.menu__dropdown').on('click', function () {
    //     $(this).next('ul').toggle(600);
    //     $(this).toggleClass('active')
    //     return false;
    // });

    // Menu opener hamburger
    // $('.container').on('click', '.gamburger-link', function (event) {
    //     event.preventDefault()
    //     if ($('.menu-collapse').is(":hidden")) {
    //         $(".menu-collapse").show("slow");
    //         $('.gumb').addClass('d-none');
    //         $('.exit').addClass('d-block');
    //     } else {
    //         $(".menu-collapse").hide("slow");
    //         $('.exit').removeClass('d-block');
    //         $('.gumb').removeClass('d-none');
    //     }
    // });

    // $(".zoom_01").elevateZoom({
    //     zoomWindowWidth: 300,
    //     zoomWindowHeight: 300,
    //     zoomWindowPosition: 1,
    //     zoomWindowOffetx: 15,
    //     lensSize: 500,
    // });
    //
    // $(".zoom_02").elevateZoom({
    //     zoomWindowWidth: 300,
    //     zoomWindowHeight: 300,
    //     zoomWindowPosition: 1,
    //     zoomWindowOffetx: 15,
    //     gallery: 'gallery_01',
    //     cursor: 'pointer',
    // })

    // $(".polzunok-5").slider({
    //     min: 1928,
    //     max: 1976,
    //     values: [1928, 1976],
    //     range: true,
    //     animate: "fast",
    //     slide: function (event, ui) {
    //         $(".polzunok-input-5-left").val(ui.values[0] + " год.");
    //         $(".polzunok-input-5-right").val(ui.values[1] + " год.");
    //     }
    // });
    // $(".polzunok-input-5-left").val($(".polzunok-5").slider("values", 0) + " год.");
    // $(".polzunok-input-5-right").val($(".polzunok-5").slider("values", 1) + " год.");
    // $(document).focusout(function () {
    //     var input_left = $(".polzunok-input-5-left").val().replace(/[^0-9]/g, ''),
    //         opt_left = $(".polzunok-5").slider("option", "min"),
    //         where_right = $(".polzunok-5").slider("values", 1),
    //         input_right = $(".polzunok-input-5-right").val().replace(/[^0-9]/g, ''),
    //         opt_right = $(".polzunok-5").slider("option", "max"),
    //         where_left = $(".polzunok-5").slider("values", 0);
    //     if (input_left > where_right) {
    //         input_left = where_right;
    //     }
    //     if (input_left < opt_left) {
    //         input_left = opt_left;
    //     }
    //     if (input_left == "") {
    //         input_left = 0;
    //     }
    //     if (input_right < where_left) {
    //         input_right = where_left;
    //     }
    //     if (input_right > opt_right) {
    //         input_right = opt_right;
    //     }
    //     if (input_right == "") {
    //         input_right = 0;
    //     }
    //     $(".polzunok-5").slider("values", [input_left, input_right]);
    //     $(".polzunok-input-5-left").val($(".polzunok-5").slider("values", 0) + " год.");
    //     $(".polzunok-input-5-right").val($(".polzunok-5").slider("values", 1) + " год.");
    //
    // });
    //
    // $(".polzunok-6").slider({
    //     min: 3400,
    //     max: 134980,
    //     values: [3400, 134980],
    //     range: true,
    //     animate: "fast",
    //     slide: function (event, ui) {
    //         $(".polzunok-input-6-left").val(ui.values[0] + " ₽.");
    //         $(".polzunok-input-6-right").val(ui.values[1] + " ₽.");
    //     }
    // });
    // $(".polzunok-input-6-left").val($(".polzunok-6").slider("values", 0) + " ₽.");
    // $(".polzunok-input-6-right").val($(".polzunok-6").slider("values", 1) + " ₽.");
    // $(document).focusout(function () {
    //     var input_left = $(".polzunok-input-6-left").val().replace(/[^0-9]/g, ''),
    //         opt_left = $(".polzunok-6").slider("option", "min"),
    //         where_right = $(".polzunok-6").slider("values", 1),
    //         input_right = $(".polzunok-input-6-right").val().replace(/[^0-9]/g, ''),
    //         opt_right = $(".polzunok-6").slider("option", "max"),
    //         where_left = $(".polzunok-6").slider("values", 0);
    //     if (input_left > where_right) {
    //         input_left = where_right;
    //     }
    //     if (input_left < opt_left) {
    //         input_left = opt_left;
    //     }
    //     if (input_left == "") {
    //         input_left = 0;
    //     }
    //     if (input_right < where_left) {
    //         input_right = where_left;
    //     }
    //     if (input_right > opt_right) {
    //         input_right = opt_right;
    //     }
    //     if (input_right == "") {
    //         input_right = 0;
    //     }
    //     $(".polzunok-6").slider("values", [input_left, input_right]);
    //     $(".polzunok-input-6-left").val($(".polzunok-6").slider("values", 0) + " ₽.");
    //     $(".polzunok-input-6-right").val($(".polzunok-6").slider("values", 1) + " ₽.");
    //
    // });
});

// var galleryThumbs = new Swiper('.gallery-thumbs', {
//     spaceBetween: 5,
//     slidesPerView: 4,
//     loop: true,
//     freeMode: true,
//     watchSlidesVisibility: true,
//     watchSlidesProgress: true,
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },
//     breakpoints: {
//         0: {
//             slidesPerView: 2,
//             spaceBetween: 20,
//         },
//         576: {
//             slidesPerView: 4,
//             spaceBetween: 20,
//         },
//         768: {
//             slidesPerView: 3,
//             spaceBetween: 10,
//         },
//         992: {
//             slidesPerView: 4,
//         },
//     }
// });
//
// var galleryTop = new Swiper('.gallery-top', {
//     spaceBetween: 10,
//
//     thumbs: {
//         swiper: galleryThumbs
//     }
// });

// var swiper = new Swiper('.slider-inner-swiper', {
//     slidesPerView: 4,
//     spaceBetween: 30,
//     slidesPerGroup: 1,
//     autoplay: {
//         delay: 2500,
//         disableOnInteraction: false,
//     },
//     loop: true,
//     loopFillGroupWithBlank: true,
//     navigation: {
//         nextEl: '.swiper-button-next',
//         prevEl: '.swiper-button-prev',
//     },
//     breakpoints: {
//         0: {
//             slidesPerView: 1,
//         },
//         576: {
//             slidesPerView: 2,
//             spaceBetween: 20,
//         },
//         768: {
//             slidesPerView: 3,
//             spaceBetween: 40,
//         },
//         992: {
//             slidesPerView: 4,
//         },
//     }
// });
