function removeActualImage(button){
    $("#message_modal .modal_content").html("<div class='ajax-preloader'><div></div><div></div><div></div></div>");
    $("#message_modal").fadeIn();

    var mediaID = button.getAttribute("data-id");

    $.ajax({
        url: "/ajax/remove_media", 
        data: {
            id: mediaID
        },
        success: function(result){
            $(".old-images-"+mediaID).remove();
            $("#message_modal .modal_content").html("Suppression bien effectuée !");
        },
        error: function(){
            $("#message_modal .modal_content").html("Une erreure s'est produite !");
        }
    });
}

function addTagFormDeleteLink($tagFormLi) {
    var $removeFormButton = $("<button type='button' class='btn-primary btn-delete'><i class='fas fa-trash'></i></button>");
    $tagFormLi.append($removeFormButton);

    $removeFormButton.on("click", function(e) {
        // remove the li for the tag form
        $tagFormLi.remove();
    });
}

function addFormToCollection($collectionHolderClass) {
    // Get the ul that holds the collection of tags
    var $collectionHolder = $("." + $collectionHolderClass);

    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data("prototype");

    // get the new index
    var index = $collectionHolder.data("index");

    if($("#nb_actuals_images").length > 0 && parseInt($("#nb_actuals_images").val(), 10) > index){
        index = parseInt($("#nb_actuals_images").val(), 10) + 1;
    }

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data("index", index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $("<li></li>").append(newForm);
    // Add the new form at the end of the list
    $collectionHolder.append($newFormLi);

    addTagFormDeleteLink($newFormLi);
}

function setRequiredInputMedia(){
    $("label[for='figure_featuredImage_url']").hide();
    $("#figure_featuredImage_url").hide();

    if($("#action-label").val() !== "edit"){
        $("#figure_featuredImage_image").attr("required", "true");
    }
    else {
        // $("gest-figure-submit-form").on("click", function(e){
        //     e.preventDefault();
        // });
    }
}

jQuery(document).ready(function() {
    $("label").last().hide();
    setRequiredInputMedia();
    // Get the ul that holds the collection of tags
    var $tagsCollectionHolder = $("ul.images");
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $tagsCollectionHolder.data("index", $tagsCollectionHolder.find("input").length);

    $("body").on("click", ".add_item_link", function(e) {
        var $collectionHolderClass = $(e.currentTarget).data("collectionHolderClass");
        // add a new tag form (see next code block)
        addFormToCollection($collectionHolderClass);
    });

    if($(".old-images-delete").length > 0){
        $(".old-images-delete").on("click", function(){
            removeActualImage(this);
        });
    }

    $("#message_modal").fadeOut();
});
