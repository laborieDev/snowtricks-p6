jQuery(document).ready(function() {

    $(".search_figure").select2({
        "language": {
            "noResults": function () {
                return "Désolé... Aucun résultat trouvé";
            }
        }
    });

    $(".search_figure").val("");
    $(".select2-selection__rendered").html("");

    $(".search_figure").on("change", function(){
        window.location.href = $(".search_figure").val();
    });
});
