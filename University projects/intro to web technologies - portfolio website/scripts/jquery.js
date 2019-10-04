scrollSpeed = 1300;

$('.toTop').on('click', function(e) {
    $('html, body').animate({scrollTop: 0}, scrollSpeed);
    e.preventDefault();
});

$('.toBottom').on('click', function(e) {
    $('html, body').animate({scrollTop: $(document).height()}, scrollSpeed);
    e.preventDefault();
});

$('.imgBox').on('click', function(e) {
    $(this).parent().find('.imgModal').fadeIn();
});

$('.imgClose').on('click', function(e) {
    $(this).parent().parent().parent().parent().find('.imgModal').fadeOut();
});

$('.input-validate').on(
    "webkitAnimationEnd oanimationend msAnimationEnd animationend",
    function() {
        $(this).removeClass("input-error");
    }
);

$('#submit').on('click', function() {
    clearError();
    return submitForm();
});

$(window).scroll(function() {
    showScrollToggle();
});


$(document).ready(function() {
    $(".mainContainer").fadeIn();

    if (localStorage.getItem("first") != null && localStorage.getItem("shown") != 'true') {
        $("#results").fadeIn();
        localStorage.setItem("shown", true)
    }
});

