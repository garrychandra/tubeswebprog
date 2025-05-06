$(document).ready(function () {
    const $slides = $(".slide");
    const $prev = $(".prev");
    const $next = $(".next");
    let currentSlide = 0;

    $slides.eq(0).addClass("active");

    $prev.on("click", function () {
        $slides.removeClass("active");
        if (currentSlide === 0) {
            currentSlide = $slides.length - 1;
        } else {
            currentSlide--;
        }
        $slides.eq(currentSlide).addClass("active");
    });

    $next.on("click", function () {
        $slides.removeClass("active");
        if (currentSlide === $slides.length - 1) {
            currentSlide = 0;
        } else {
            currentSlide++;
        }
        $slides.eq(currentSlide).addClass("active");
    });
});

