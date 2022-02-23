import Swiper, { Navigation } from "swiper";

import "swiper/css";
import "swiper/css/navigation";

let slider = document.getElementsByClassName("swiper");

for (var i = 0; i < slider.length; i++) {
  // console.log(slider[i].dataset.instance);
  const mySwiper = new Swiper(slider[i], {
    // const swiper = new Swiper(".swiper-" + i.grid.dataset.instance, {
    modules: [Navigation],
    slidesPerView: 1,
    // autoHeight: true,
    spaceBetween: 40,
    navigation: {
      nextEl: ".swiper-next",
      prevEl: ".swiper-prev",
    },
    rewind: false,
    loop: false,
  });
}
