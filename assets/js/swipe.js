import Swiper, { Navigation } from "swiper";

import "swiper/css";
import "swiper/css/navigation";

let slider = document.getElementsByClassName("swiper");

for (var i = 0; i < slider.length; i++) {
  const instance = slider[i].dataset.instance;
  const slides = slider[i].dataset.slides;
  const slidesMobile = slider[i].dataset.responsiveMobile;
  const slidesTablet = slider[i].dataset.responsiveTablet;
  const slidesView = slider[i].dataset.responsiveView;

  const spacing = slider[i].dataset.spacing;
  const swiper = new Swiper(slider[i], {
    modules: [Navigation],
    slidesPerView: slidesView ? "auto" : parseInt(slidesMobile),
    spaceBetween: parseInt(spacing),
    navigation: {
      nextEl: ".swiper-next-" + instance,
      prevEl: ".swiper-prev-" + instance,
    },
    rewind: true,
    loop: false,
    centerInsufficientSlides: true,
    slidesPerGroupAuto: slidesView ? true : false,
    breakpoints: {
      768: {
        slidesPerView: slidesView ? "auto" : parseInt(slidesTablet),
        slidesPerGroupAuto: slidesView ? true : false,
      },
      992: {
        slidesPerView: parseInt(slides),
        slidesPerGroup: parseInt(slides),
      },
    },
  });
}
