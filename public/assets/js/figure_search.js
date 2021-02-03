jQuery(document).ready(function() {

    $(".search_figure").select2();

    $(".search_figure").on("change", function(){
        window.location.href = $(".search_figure").val();
    })
});
