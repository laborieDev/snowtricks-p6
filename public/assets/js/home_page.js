jQuery(document).ready(function() {
    $(".agl_modal").fadeOut();

    var thisUrl = window.location.href;
    if(thisUrl.indexOf('?page=') != -1){
        $('html, body').animate({
            scrollTop: $('#all_figures').offset().top
        }, 'slow');
    }
});
