document.addEventListener("DOMContentLoaded", function () {
  const menuIcon = document.getElementById("menu-icon");
  const navList = document.querySelector("#nav ul");

  menuIcon.addEventListener("click", function () { 
      navList.classList.toggle("show");
  });
});
const userIcon = document.getElementById('userIcon');
const userDropdown = document.getElementById('userDropdown');
const notifIcon = document.getElementById('notifIcon');
const notifDropdown = document.getElementById('notifDropdown');


userIcon.addEventListener('click', function () {
  userDropdown.classList.toggle('show');
});

document.addEventListener('click', function (event) {
  if (!event.target.closest('#userIcon')) {
      // Close user dropdown if the user clicks outside the userIcon
      userDropdown.classList.remove('show');
  }
});
notifIcon.addEventListener('click', function () {
  notifDropdown.classList.toggle('show');
});

document.addEventListener('click', function (event) {
  if (!event.target.closest('#notifIcon')) {
      // Close user dropdown if the user clicks outside the userIcon
      notifDropdown.classList.remove('show');
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

