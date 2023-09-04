// Services Carousel
$(document).ready(function () {
  $(".owl-carousel-services").owlCarousel({
    loop: false,
    margin: 16,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      580: {
        items: 2,
      },
      800: {
        items: 3,
      },
    },
  });
});
$(document).ready(function () {
  $(".owl-carousel-preview").owlCarousel({
    loop: false,
    margin: 16,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
    },
  });
});
$(document).ready(function () {
  $(".owl-carousel-reviews").owlCarousel({
    loop: false,
    margin: 16,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      480: {
        items: 2,
      },
    },
  });
});

if (window.innerWidth > 480) {
  $(".app-preview .image-wrapper").removeClass("owl-carousel-preview");
  $(".app-preview .image-wrapper").removeClass("owl-carousel");
}

// Hospital Facilities Carousel

//saurabh changes things
$(document).ready(function () {
  $(".owl-carousel-facilities").owlCarousel({
    loop: false,
    margin: 40,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      480: {
        items: 2,
      },
      800: {
        items: 3,
      },
      1000: {
        items: 4,
      },
    },
  });
});
