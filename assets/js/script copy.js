document.addEventListener("DOMContentLoaded", function () {
  const menuIcon = document.getElementById("menu-icon");
  const navList = document.querySelector("#nav ul");

  menuIcon.addEventListener("click", function () { 
      navList.classList.toggle("show");
  });
});
const userIcon = document.getElementById('userIcon');
const userDropdown = document.getElementById('userDropdown');
const cart = document.getElementById('cart');
const cartdrop = document.getElementById('cartdrop');

userIcon.addEventListener('click', function () {
  userDropdown.classList.toggle('show');
});

document.addEventListener('click', function (event) {
  if (!event.target.closest('#userIcon')) {
      // Close user dropdown if the user clicks outside the userIcon
      userDropdown.classList.remove('show');
  }
});
cart.addEventListener('click', function () {
  cartdrop.classList.toggle('show');
});

document.addEventListener('click', function (event) {
  if (!event.target.closest('#cart')) {
      // Close user dropdown if the user clicks outside the userIcon
      cartdrop.classList.remove('show');
  }
});


var swiper = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});

