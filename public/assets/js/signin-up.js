const inputs = document.querySelectorAll(".input-field");
const bullets = document.querySelectorAll(".bullets span");
const images = document.querySelectorAll(".image");


inputs.forEach((input) => {

    // input class name rename when the clicked
    input.addEventListener("focus", () => {
        input.classList.add("active");
    })

    // input class name rename when the input field for values added
    if(input.value !=""){
        input.classList.add("active");
    }

    // input class name remove when the clicked outside the page
    input.addEventListener("blur", () => {
        if(input.value !=""){
            return;
        }else{
            input.classList.remove("active");
        }
    })
});

//password visibility
function togglePasswordVisibility(passwordId, IconId) {

    var passwordField = document.getElementById(passwordId);
    var toggleIcon = document.getElementById(IconId);

    if (passwordField.type === "password") {
        toggleIcon.setAttribute("name", "eye-off-outline");
        passwordField.type = "text";
    } else {
            passwordField.type = "password";
            toggleIcon.setAttribute("name", "eye-outline");
    }
}

// image slider & bullet navigation
let index = 0;

function moveSlider() {
    index = (index % images.length) + 1;

    let currentImage = document.querySelector(`.img-${index}`);
    images.forEach((img) => img.classList.remove("show"));
    currentImage.classList.add("show");

    const textSlider = document.querySelector(".text-group");
    textSlider.style.transform = `translateY(${-(index - 1) * 2.2}rem)`;

    let currentBullet = document.querySelector(`.bull-${index}`);
    bullets.forEach((bull) => bull.classList.remove("active"));
    currentBullet.classList.add("active");
}

setInterval(moveSlider, 2000);

document.addEventListener("DOMContentLoaded", () => {
    const toggleLinks = document.querySelectorAll('.toggle');
    const pageContent = document.querySelector('.page-content');
    const signInForm = document.querySelector('.sign-in-form');
    const signUpForm = document.querySelector('.sign-up-form');
    const signInBtn = document.querySelector('#sign-in-btn');
    const signUpBtn = document.querySelector('#sign-up-btn');

    // Toggle animation between Sign-In and Sign-Up forms
    toggleLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            if (pageContent.classList.contains('animate-in')) {
                pageContent.classList.replace('animate-in', 'animate-out');
            } else {
                pageContent.classList.replace('animate-out', 'animate-in');
            }

            setTimeout(() => {
                window.location.href = link.getAttribute('href');
            }, 500); // Match animation duration
        });
    });

    // Add animation when filling inputs
    document.querySelectorAll('.input-field').forEach(input => {
        input.addEventListener('focus', () => {
            input.parentElement.style.animation = 'fadeIn 0.3s ease-in-out';
        });
    });

    // Add animation when clicking Sign-In or Sign-Up button
    [signInBtn, signUpBtn].forEach(btn => {
        btn.addEventListener('click', () => {
            pageContent.classList.add('animate-out');
        });
    });
});


