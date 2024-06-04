const burgerIcon = document.querySelector(".header-navigation-hamburger");
const menu = document.querySelector(".header-navigation");
const date = document.querySelector(".footer-text-date");
const menuItems = document.querySelectorAll(
  ".header-navigation-container-item"
);
AOS.init();
burgerIcon.addEventListener("click", () => {
  menu.classList.toggle("active");
});

menuItems.forEach((e) =>
  e.addEventListener("click", () => {
    menu.classList.toggle("active");
  })
);
date.textContent = new Date().getFullYear();
