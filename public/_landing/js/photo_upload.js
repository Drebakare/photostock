const upload_tabs = $(".upload_tabs").find("li").find("a");
const upload_tabs_content = $(".upload_tabs_content");
const upload_previous_button = $(".upload_previous_button");
const upload_next_button = $(".upload_next_button");
const upload_photos_form = $("form#upload_photos");
let upload_photos_form_submit = false;

let current_upload_photo_count = 1;
let upload_photo_count_limit = 5;

upload_next_button.on("click", function()
{
    // TODO: Validate before changing the tab in view

    let title = $("input[name=description"+current_upload_photo_count+"]");
    let image = $("input[name=image"+current_upload_photo_count+"]");
    let type = $("input[name=type"+current_upload_photo_count+"]");
    let category = $("input[name=category"+current_upload_photo_count+"]");
    let feature = $("input[name=feature"+current_upload_photo_count+"]");
    let price = $("input[name=price"+current_upload_photo_count+"]");
    let tag = $("input[name=tag"+current_upload_photo_count+"]");


    if(title.val() === "") {
        toastr.error('Please fill all the required fields');
        return false;
    }

   /* if(image.val() === "") {
        toastr.error('Please fill all the required fields');
        return false;
    }*/

    if(type.val() === "") {
        toastr.error('Please fill all the required fields');
        return false;
    }
    if(category.val() === "") {
        toastr.error('Please fill all the required fields');
        return false;
    }
    /*if(feature.val() === "") {
        toastr.error('Please fill all the required fields');
        return false;
    }*/
   /* if(price.val() === "") {
        toastr.error('Please fill all the required fields');
        return false;
    }*/
    if(tag.val() === "") {
        toastr.error('Please fill all the required fields');
        return false;
    }




    // Change the tab in view
    if(current_upload_photo_count >= upload_photo_count_limit)
    {
        upload_next_button.html('Finish & Upload <i class="icon-feather-send"></i>').attr({
            "type": "submit"
        });
    } else {
        upload_previous_button.css({
            "display": "inline-block"
        });
        upload_next_button.html('Next <i class="icon-feather-arrow-right"></i>').attr({
            "type": "button"
        });
    }

    if(current_upload_photo_count < upload_photo_count_limit)
    {
        current_upload_photo_count++;
        showUploadPhotoTabContent(current_upload_photo_count);
    }
});

// When the previous button is clicked
upload_previous_button.on("click", function()
{
    current_upload_photo_count--;
    if(current_upload_photo_count === 1)
    {
        upload_previous_button.css({
            "display": "none"
        });
    } else {
        upload_next_button.css({
            "display": "inline-block"
        });
    }
    upload_next_button.html('Next <i class="icon-feather-arrow-right"></i>').attr({
        "type": "button"
    });
    showUploadPhotoTabContent(current_upload_photo_count);
});

// When the upload form is submitted
upload_photos_form.on("submit", function (e) {

    // TODO: Validate to Be sure all required fields are still filled, then change variable of "upload_photos_form" to true


    let title = $("input[name=description"+current_upload_photo_count+"]");
    let image = $("input[name=image"+current_upload_photo_count+"]");
    let type = $("input[name=type"+current_upload_photo_count+"]");
    let category = $("input[name=category"+current_upload_photo_count+"]");
    let feature = $("input[name=feature"+current_upload_photo_count+"]");
    let price = $("input[name=price"+current_upload_photo_count+"]");
    let tag = $("input[name=tag"+current_upload_photo_count+"]");

    if(title.val() !== ""  && type.val() !== "" && category.val() !== "" /*&& feature.val() !== ""*/ /*&& price.val() !== ""*/ && tag.val() !== "" )
    {
        upload_photos_form_submit = true;
    }

    if(upload_photos_form_submit)
    {
        upload_photos_form.submit();
    } else {
        e.preventDefault();
    }
});

function showUploadPhotoTabContent(tab_target) {
    upload_tabs_content.hide();
    $("#tabs"+tab_target).fadeIn();

    upload_tabs.removeClass("active");
    $(".nav-link[data-target=tabs"+tab_target+"]").addClass("active");

}

function showUploadButton(button_type) {

    switch(button_type) {
        case "next":
            upload_next_button.css({
                "display": "inline-block"
            });
            break;
        case "previous":
            upload_previous_button.css({
                "display": "inline-block"
            });
            break;
    }

}
function hideUploadButton(button_type) {

    switch(button_type) {
        case "next":
            upload_next_button.css({
                "display": "none"
            });
            break;
        case "previous":
            upload_previous_button.css({
                "display": "none"
            });
            break;
    }

}
