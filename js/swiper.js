var swiper = new swiper(".hero-slider", {
    loop: true,
    grabCursor: true, // It should be "grabCursor" not "grapCursor"
    effect: "flip",
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});