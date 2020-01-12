const browse_photos_section = $("div#browse-photos-section");
let page_number = 2;
const md_width = 992;
let is_fetching_more = false;
let is_photos_still_available = true;

let width_key = null;

if($(window).width() <= md_width)
{
    // Columns = 1
    width_key = 2;
}

$(window).scroll(function() {
    if($(window).scrollTop() + $(window).height() >= $(document).height() - 1000) {
        // Load more photos
        if(!is_fetching_more && is_photos_still_available) {
            loadMorePhotos();
            console.log(webRoot1);
        }
    }
});

function loadMorePhotos() {
    is_fetching_more = true;
    // Create ajax request to dynamically fetch more images, using the page number variable set above
    $.ajax({
        url: webRoot+"/get-more-for-search",
        method: 'post',
        data: {
            page_number: page_number,
            _token: _token,
        },
        cache: false,

        success: function(results){
            let photos = results.results;

            $.each(photos, function(key, val)
            {
                $.each(val, function(key_1, val_1){
                    browse_photos_section.find(".browse-photos-section-column-"+((width_key !== null) ? width_key : key)).append('<a href="'+webRoot+'/photo/'+val_1.slug+'/'+val_1.id+'"><div class="browse-photos-section-each"><div class="browse-photos-each-photo"><img src="'+webRoot+'/storage/uploads/original/'+val_1.image+'" class="img-responsive"></div><div class="browse-photos-each-info"><div><div class="browse-photos-each-title">'+val_1.title+'</div></div></div></div></a>');
                });
            });

            if(photos.length() < 1) {
                is_photos_still_available = false;
            }

            page_number++;
            console.log(page_number);
            is_fetching_more = false;

        },
        failure: function (result) {
            console.log(result);
            is_fetching_more = false;
        }
    });

    // TODO: Place the following loop block inside your ajax success response


    // TODO: After looping through the result of photos, remember to increment
}

//http://localhost:7000/photo/image

function getDocHeight() {
    var D = document;
    return Math.max(
        D.body.scrollHeight, D.documentElement.scrollHeight,
        D.body.offsetHeight, D.documentElement.offsetHeight,
        D.body.clientHeight, D.documentElement.clientHeight
    );
}
