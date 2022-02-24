import Swiper, { Navigation } from "swiper";

import "swiper/css";
import "swiper/css/navigation";

let slider = document.getElementsByClassName("swiper");
// let slider2 = document.getElementsByClassName("amazed-blog-posts-column");

for (var i = 0; i < slider.length; i++) {
  const instance = slider[i].dataset.instance;
  const slides = slider[i].dataset.slides;
  const spacing = slider[i].dataset.spacing;
  const swiper = new Swiper(".swiper-" + slider[i].dataset.instance, {
    modules: [Navigation],
    slidesPerView: parseInt(slides),
    // autoHeight: true,
    spaceBetween: parseInt(spacing),
    navigation: {
      nextEl: ".swiper-next-" + instance,
      prevEl: ".swiper-prev-" + instance,
    },
    rewind: false,
    loop: false,
  });
}
