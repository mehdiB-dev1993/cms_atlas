jalaliDatepicker.startWatch();

    $('body').on('click','#submit-menu-store',function ()
    {
        $('#menu-store').submit()
    }
    )


$('body').on('click','#submit-page-store',function ()
    {
        $('#page-store').submit()
    }
)


$('body').on('click','#submit-page-update',function ()
    {
        $('#page-update').submit()
    }
)



$('body').on('click','#submit-gallery-store',function ()
    {
        $('#gallery-store').submit()
    }
)


$('body').on('click','#submit-gallery-update',function ()
    {
        $('#gallery-update').submit()
    }
)

$('body').on('click','#submit-slider-store',function ()
    {
        $('#slider-store').submit()
    }
)

$('body').on('click','#submit-menu-update',function ()
    {
        $('#menu-update').submit()
    }
)


$('body').on('click','#submit-course-group-store',function ()
    {
        $('#course-group-store').submit()
    }
)

$('body').on('click','#submit-course-group-update',function ()
    {
        $('#course-group-update').submit()
    }
)

$('body').on('click','#submit-course-store',function ()
    {
        $('#course-store').submit()
    }
)

$('body').on('click','#submit-course-update',function ()
    {
        $('#course-update').submit()
    }
)







    $(document).ready(function() {
        $(".toggle-btn").click(function() {
            var target = $(this).parent().siblings(".submenu");
            target.toggle();
            if (target.is(":visible")) {
                $(this).text("➖");
            } else {
                $(this).text("➕");
            }
        });
    });


CKEDITOR.replace( 'text' );

/**************************************************/

function preview_main(tag)
{
    var file = tag.files[0];

    var reader = new FileReader();


    if (file && file.type.startsWith('image')) {
        reader.onload = function(e) {
            var previewImage = $(tag).parents('.box-thumbnail-lg').find('.preview-image');

            previewImage.attr('src', e.target.result);
            previewImage.show();
        };
    }
    reader.readAsDataURL(file);
    $(tag).parents('tr').find('.help').remove()
    console.log(file)
}
/**************************************************/

