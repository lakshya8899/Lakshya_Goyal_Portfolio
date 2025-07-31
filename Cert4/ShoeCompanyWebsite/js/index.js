
  document.addEventListener("DOMContentLoaded", function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mainMenu = document.querySelector('.navbar ul.main-menu');

    menuToggle.addEventListener('click', function() {
      mainMenu.classList.toggle('collapsed');
    });
  });

