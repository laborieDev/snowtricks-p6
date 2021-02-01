jQuery(document).ready(function() {
    $(".agl_modal").fadeOut();

    $(".remove-figure").on("click", function(e){
        e.preventDefault();
        openDeleteReoveModal(this);
    });
});

function openDeleteReoveModal(button){
    $("#remove-figure-modal .modal_content").html(
        "<div>"+
            "<h3>Veuillez confirmer la suppression de cette figure !</h3>" +
            "<div class=\"all-btns\">"+
                "<a href='#' class='confirm-remove'>Confirmer</a> <a href='#' class='cancel'>Annuler</a>"+
            "</div>"+
        "</div>"
    );

    $(".confirm-remove").on("click", function(e){
        e.preventDefault();
        removeFigure(button);
    });

    $(".cancel").on("click", function(e){
        e.preventDefault();
        $(".agl_modal .modal_content").html();
        $(".agl_modal").fadeOut();
    });

    $("#remove-figure-modal").fadeIn();
}

function removeFigure(button){
    $("#remove-figure-modal .modal_content").html("<div class='ajax-preloader'><div></div><div></div><div></div></div>");
    var figureID = button.getAttribute('data-id');
    var successAction = button.getAttribute('data-success');

    $.ajax({
        url: "/connected/ajax/delete_figure/"+figureID, 
        data: {},
        success: function(result){
            if(successAction != "reload"){
                document.location = successAction;
            } else {
                document.location.reload();
            }
        },
        error: function(){
            console.log('Error for Remove Figure');
        }
    });
}
