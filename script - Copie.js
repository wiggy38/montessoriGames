const hamburger = document.querySelector('.fa-bars');
const dropdownMenu = document.querySelector('.dropdown-menu');

hamburger.addEventListener('click', function() {
  dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
});
