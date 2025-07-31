document.querySelector('.menu-toggle').addEventListener('click', function() {
    const menu = document.querySelector('.main-menu');
    const isExpanded = this.getAttribute('aria-expanded') === 'true';

    menu.classList.toggle('show');
    this.setAttribute('aria-expanded', !isExpanded);
});


document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.carousel-container');
    const items = document.querySelectorAll('.carousel-item');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');
    let index = 0;

    function showSlide(i) {
        index = (i + items.length) % items.length;
        container.style.transform = `translateX(${-index * 100}%)`;
    }

    nextButton.addEventListener('click', () => {
        showSlide(index + 1);
    });

    prevButton.addEventListener('click', () => {
        showSlide(index - 1);
    });

    showSlide(index);
});






document.getElementById('contact-form').addEventListener('submit', function(event) {
    let nameInput = document.getElementById('name');
    let phoneInput = document.getElementById('phone');
    let messageInput = document.getElementById('message');
    
    let error = false;

    // Name validation
    if (nameInput.value.trim() === '' || !/^[a-zA-Z\s.]+$/.test(nameInput.value.trim())) {
        document.getElementById('name-error').style.display = 'block';
        error = true;
    } else {
        document.getElementById('name-error').style.display = 'none';
    }

    // Phone number validation
    if (phoneInput.value.trim() === '' || !/^\d{10}$/.test(phoneInput.value.trim())) {
        document.getElementById('phone-error').style.display = 'block';
        error = true;
    } else {
        document.getElementById('phone-error').style.display = 'none';
    }

    // Message validation
    if (messageInput.value.trim() === '') {
        document.getElementById('message-error').style.display = 'block';
        error = true;
    } else {
        document.getElementById('message-error').style.display = 'none';
    }

    // If any field is invalid, prevent form submission
    if (error) {
        event.preventDefault();
        document.getElementById('form-error').style.display = 'block';
    } else {
        document.getElementById('form-error').style.display = 'none';
    }
});


const scrollUpBtn = document.getElementById("scrollUpBtn");

// Show the button when scrolling down
window.onscroll = function () {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        scrollUpBtn.style.display = "block";
    } else {
        scrollUpBtn.style.display = "none";
    }
};

// Scroll to the top when the button is clicked
scrollUpBtn.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});