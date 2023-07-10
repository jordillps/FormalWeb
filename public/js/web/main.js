(function($) { "use strict";


//Preloder
jQuery(window).on('load', function () {
  $(".egns-preloader").delay(1600).fadeOut("slow");
});

 // niceSelect
 $('select').niceSelect();

// wow animate 
setTimeout(myGreeting, 1800);
function myGreeting() {
  var wow = new WOW(
    {
      boxClass:     'wow',      // animated element css class (default is wow)
      animateClass: 'animated', // animation css class (default is animated)
      offset:       0,          // distance to the element when triggering the animation (default is 0)
      mobile:       true,       // trigger animations on mobile devices (default is true)
      live:         true,       // act on asynchronously loaded content (default is true)
      callback:     function(box) {
        // the callback is fired every time an animation is started
        // the argument that is passed in is the DOM node being animated
      },
      scrollContainer: null,    // optional scroll container selector, otherwise use window,
      resetAnimation: true,     // reset animation on end (default is true)
    }
  );
  wow.init();
}

// sticky header

window.addEventListener('scroll',function(){
  const header = document.querySelector('header.style-1, header.style-2, header.style-3, header.style-4');
  header.classList.toggle("sticky",window.scrollY > 0);
});

// mobile-search-area

$('.search-btn').on("click", function(){
  $('.mobile-search').addClass('slide');
});

$('.search-cross-btn').on("click", function(){
  $('.mobile-search').removeClass('slide');
});

// scroll button
$(window).on('scroll',function() {
  if ($(window).scrollTop() > 300) {
    $('.scroll-btn').addClass('show');
  } else {
    $('.scroll-btn').removeClass('show');
  }
});
$('.scroll-btn').on('click',function(e){
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

// mobile-menu

$('.mobile-menu-btn').on("click",function(){
  $('.main-menu').addClass('show-menu');
});

$('.menu-close-btn').on("click",function(){
  $('.main-menu').removeClass('show-menu');
});

// mobile-drop-down
$('.dropdown-icon').on('click',function(){
  // $(this).next('.mob-submenu').slideToggle();
  $(this).toggleClass('active').next('ul').slideToggle();
  $(this).parent().siblings().children('ul').slideUp();
  $(this).parent().siblings().children('.active').removeClass('active');
});

// Menu Toggle button sidebar

var toggleIcon = document.querySelectorAll('.sidebar-menu-icon')
var closeIcon = document.querySelectorAll('.cross-icon')
var searchWrap = document.querySelectorAll('.menu-toggle-btn-full-shape')

toggleIcon.forEach((element)=>{
    element.addEventListener('click', ()=>{
        document.querySelectorAll('.menu-toggle-btn-full-shape').forEach((el)=>{
            el.classList.add('show-sidebar')
        })
    })
})

closeIcon.forEach((element)=>{
    element.addEventListener('click', ()=>{
        document.querySelectorAll('.menu-toggle-btn-full-shape').forEach((el)=>{
            el.classList.remove('show-sidebar')
        })
    })
})

 window.onclick = function(event){
    // Menu Toggle button sidebar
    searchWrap.forEach((el)=>{
      if(event.target === el){
        el.classList.remove('show-sidebar')
      }
    })
}


// password-hide and show
   
const togglePassword = document.querySelector('#togglePassword');

const password = document.querySelector('#password');

if(togglePassword){
 togglePassword.addEventListener('click', function (e) {
   // toggle the type attribute
   const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
   password.setAttribute('type', type);
   // toggle the eye / eye slash icon
   this.classList.toggle('bi-eye');
 });
}


// confirm-password
const togglePassword2= document.getElementById('togglePassword2');

const password2 = document.querySelector('#password2');

if (togglePassword2){
 togglePassword2.addEventListener('click', function (e) {
   // toggle the type attribute
   const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
   password2.setAttribute('type', type);
   // toggle the eye / eye slash icon
   this.classList.toggle('bi-eye');
 });
}

// Odometer Counter
$(".counter-item").each(function () {
  $(this).isInViewport(function (status) {
    if (status === "entered") {
        for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
        var el = document.querySelectorAll('.odometer')[i];
        el.innerHTML = el.getAttribute("data-odometer-final");
        }
    }
    });
  });

$(".counter-single").each(function () {
  $(this).isInViewport(function (status) {
  if (status === "entered") {
      for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
      var el = document.querySelectorAll('.odometer')[i];
      el.innerHTML = el.getAttribute("data-odometer-final");
      }
  }
  });
});

// Magnific Popup video
$('.popup-youtube').magnificPopup({
  type: 'iframe'
});
$('.popup-img').magnificPopup({
  type: 'iframe'
});


// isotop
$(document).ready(function(){
  $('.work-item').isotope(function(){
      itemSelector:'.item'
    });



  $('.works-tab-btn-area ul li').click(function(){
    $('.works-tab-btn-area ul li').removeClass('active');
    $(this).addClass('active');


    var selector = $(this).attr('data-filter');
      $('.work-item').isotope({
        filter: selector
      })
      return false;
  });
});
  //  magnificPopup
  $('.video-frame').magnificPopup({
    type: 'iframe'
  });
// testimonial slider-1
var swiper = new Swiper(".testimonial-slider-1", {
  loop: true,
  speed:2000,
      autoplay: {
        delay: 5000,
      },
  navigation: {
    nextEl: ".swiper-button-next-c",
    prevEl: ".swiper-button-prev-c",
  },
});

  //  Solution slider
  var swiper = new Swiper(".solution-slider-1", {
    slidesPerView: 3,
    spaceBetween: 30,
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    speed:2000,
      autoplay: {
        delay: 5000,
      },
    navigation: {
      nextEl: ".swiper-button-next-d",
      prevEl: ".swiper-button-prev-d",
    },
    breakpoints: {
        280:{
          slidesPerView: 1
        },
        480:{
          slidesPerView: 2
        },
        768:{
          slidesPerView: 3
        },
        992:{
          slidesPerView: 3
        },
        1200:{
          slidesPerView: 4
        },
        1400:{
          slidesPerView:4
        },
        1600:{
          slidesPerView: 4
        },
      }
  });


  // related-project-slider
  var swiper = new Swiper(".related-project-slider", {
    slidesPerView: 3,
    spaceBetween: 30,
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    speed:2000,
      autoplay: {
        delay: 5000,
      },
    navigation: {
      nextEl: ".swiper-button-next-i",
      prevEl: ".swiper-button-prev-i",
    },
    breakpoints: {
        280:{
          slidesPerView: 1
        },
        480:{
          slidesPerView: 1
        },
        768:{
          slidesPerView: 2
        },
        992:{
          slidesPerView: 3
        },
        1200:{
          slidesPerView: 3
        },
        1400:{
          slidesPerView:3
        },
        1600:{
          slidesPerView: 3
        },
      }
  });
  //  testimonil slider2
  var swiper = new Swiper(".testimonial-slider-2", {
    slidesPerView: 2,
    spaceBetween: 30,
    slidesPerGroup: 1,
    loop: true,
    loopFillGroupWithBlank: true,
    speed:2000,
      autoplay: {
        delay: 5000,
      },
    navigation: {
      nextEl: ".swiper-button-next-e",
      prevEl: ".swiper-button-prev-e",
    },
    breakpoints: {
        280:{
          slidesPerView: 1
        },
        480:{
          slidesPerView: 1
        },
        768:{
          slidesPerView: 1
        },
        992:{
          slidesPerView: 2
        },
        1200:{
          slidesPerView: 2
        },
        1400:{
          slidesPerView:2
        },
        1600:{
          slidesPerView: 2
        },
      }
  });
    //  Testomonial-3 slider
    var swiper = new Swiper(".testimonial-slider-top1", {
      slidesPerView: 1,
      spaceBetween: 30,
      slidesPerGroup: 1,
      loop: true,
      loopFillGroupWithBlank: true,
      allowTouchMove: false,
      speed:2000,
      autoplay: {
        delay: 5000,
      },
      navigation: {
        nextEl: ".swiper-button-next-f",
        prevEl: ".swiper-button-prev-f",
      },
    });
    var mySwiper = new Swiper(".testimonil-slider-btm1", {
      spaceBetween: 50,
      slidesPerView: 3,
      centeredSlides: true,
      roundLengths: true,
      loop: true,
      loopAdditionalSlides: 30,
      allowTouchMove: false,
      speed:2000,
      autoplay: {
        delay: 5000,
      },
      navigation: {
        nextEl: ".swiper-button-next-f",
        prevEl: ".swiper-button-prev-f"
      },
      breakpoints: {
        280:{
          slidesPerView: 1
        },
        480:{
          slidesPerView: 1
        },
        768:{
          slidesPerView: 3
        },
        992:{
          slidesPerView: 3
        },
        1200:{
          slidesPerView: 3
        },
        1400:{
          slidesPerView:3
        },
        1600:{
          slidesPerView: 3
        },
      }
    });
// project slider 1
    var swiper = new Swiper(".Project1", {
      speed:1200,
      autoplay: {
        delay: 5000,
      },
      loop:true,
      navigation: {
        nextEl: ".swiper-button-next-h",
        prevEl: ".swiper-button-prev-h",
      },
    });
// calender
// jQuery(document).ready(function () {
//   jQuery('#datepicker').datepicker({
//       format: 'dd-mm-yyyy',
//       startDate: '+1d'
//   });
// });
// progressbar.js@1.0.0 version is used
// Docs: http://progressbarjs.readthedocs.org/en/1.0.0/

var year = new Date().getFullYear();
document.getElementById("copyright").innerHTML =
  "<span>Copyright &copy " +
  year;

}(jQuery));
