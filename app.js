const menuIcon = document.querySelector('.menu-icon');
const mainNav = document.querySelector('.main-nav');

menuIcon.addEventListener('click', () => {
  mainNav.classList.toggle('show');
});
