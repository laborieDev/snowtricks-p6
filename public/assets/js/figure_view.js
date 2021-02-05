function showImage(element){
    $("#message_modal .modal_content").html(
        element.innerHTML
    );
    $("#message_modal").fadeIn();
}

jQuery(document).ready(function() {
    var thisUrl = window.location.href;
    if(thisUrl.indexOf("?page=") !== -1){
        $("html, body").animate({
            scrollTop: $(".add_message").offset().top
        }, "slow");
    }

    $("#message_modal").hide();

    $(".show_more_medias").removeAttr("href");

    $(".show_more_medias").on("click", function(){
        if($(".figure_medias_list").css("height") === "200px"){
            $(".show_more_medias").html("<i class=\"fas fa-chevron-up\"></i>");
            $(".figure_medias_list").css({
                "overflow": "visible",
                "height" : "auto",
            });
        } else {
            $(".show_more_medias").html("<i class=\"fas fa-chevron-down\"></i>");
            $(".figure_medias_list").css({
                "overflow": "hidden",
                "height" : "200px",
            });
        }
    });

    $(".figure_medias_list .item").on("click", function(){
        showImage(this);
    });

    $("#message_modal .modal_close").on("click", function(){
        $("#message_modal").fadeOut();
        $("#message_modal .modal_content").html("");
    });
});
