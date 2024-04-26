

function loader(){
    document.querySelector('.loader').style.display = 'none';
}

function fadeOut(){
    setInterval(loader, 500);
}

window.onload = fadeOut;

navbar = document.querySelector('.header .flex .navbar');
document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle("active");
    profile.classList.remove("active");
}

profile = document.querySelector('.header .flex .profile');
document.querySelector('#user-btn').onclick = () => {
    profile.classList.toggle("active");
    navbar.classList.remove("active");
}

window.onscroll = () => {
    navbar.classList.remove("active");  
    profile.classList.remove("active");
}

document.querySelectorAll('input[type="number"]').forEach(input => {
    input.oninput = () => {
        if(input.value.length > input.maxLength) input.value = input.value.slice(0, input.maxLangth);
    }
})



//auto slide of hero section 
// document.addEventListener("DOMContentLoaded", function() {
//     var slides = document.querySelectorAll('.slide');
//     var slideIndex = 0;

//     function showSlide() {
//       // Hide all slides
//       slides.forEach(function(slide) {
//         slide.style.display = 'none';
//       });

//       // Show current slide
//       slides[slideIndex].style.display = 'block';

//       // Increment slideIndex or reset to 0 if it reaches the end
//       slideIndex = (slideIndex + 1) % slides.length;
//     }

//     // Show the first slide initially
//     showSlide();

//     // Auto slide every 5 seconds
//     setInterval(showSlide, 2000);
// });






