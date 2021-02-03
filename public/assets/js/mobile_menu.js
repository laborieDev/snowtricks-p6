jQuery(document).ready(function() {
    
    $(".menu-mobile").on("click", function(){
        $(".menu-mobile-content").css("left", "0");
    });

    $(".close-mobile-menu").on("click", function(e){
        e.preventDefault();
        $(".menu-mobile-content").css("left", "100%");
    });


});
