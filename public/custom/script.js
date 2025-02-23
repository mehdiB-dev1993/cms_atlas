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


CKEDITOR.replace( 'full_text' );

/**************************************************/


document.querySelector('.add').addEventListener('click', function () {
    let container = document.getElementById('gallery-container');
    let newItem = document.createElement('div');
    newItem.classList.add('gallery-item');
    newItem.innerHTML = `
        <div class="input-group mb-3">
            <input name="item[]" multiple type="file" class="form-control">
        </div>
        <div class="input-group mb-3">
            <input name="item_alt[]" type="text" class="form-control" placeholder="متن جایگزین">
        </div>
        <div class="input-group mb-3">
            <input name="item_description[]" type="text" class="form-control" placeholder="توضیحات">
        </div>

           <div class="input-group mb-3">
                                            <input name="item_link[]" type="text" class="form-control" placeholder="لینک">
                                        </div>
        <button type="button" class="btn btn-danger remove">حذف</button>
    `;
    container.appendChild(newItem);

    newItem.querySelector('.remove').addEventListener('click', function () {
        this.parentElement.remove();
    });
});
