import Swiper, { Navigation } from "swiper";

import "swiper/css";
import "swiper/css/navigation";

let slider = document.getElementsByClassName("swiper");

for (var i = 0; i < slider.length; i++) {
  const instance = slider[i].dataset.instance;
  const slides = slider[i].dataset.slides;
  const spacing = slider[i].dataset.spacing;
  const swiper = new Swiper(slider[i], {
    modules: [Navigation],
    slidesPerView: 1,
    spaceBetween: parseInt(spacing),
    navigation: {
      nextEl: ".swiper-next-" + instance,
      prevEl: ".swiper-prev-" + instance,
    },
    rewind: false,
    loop: false,
    breakpoints: {
      576: {
        slidesPerView: parseInt(slides) === 1 ? 1 : 2,
      },
      768: {
        slidesPerView: parseInt(slides) === 1 ? 1 : 3,
      },
      992: {
        slidesPerView: parseInt(slides) === 1 || parseInt <= 2 ? 1 : 4,
      },
    },
  });
}
