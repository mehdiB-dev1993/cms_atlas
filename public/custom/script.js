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
            <input name="item[]" type="file" class="form-control">
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
        <button type="button" class="btn btn-primary add">اضافه</button>
    `;
    container.appendChild(newItem);

    // گوش دادن به رویداد حذف برای دکمه حذف جدید
    newItem.querySelector('.remove').addEventListener('click', function () {
        this.parentElement.remove();
    });

    // گوش دادن به رویداد `add` برای دکمه `add` جدید
    newItem.querySelector('.add').addEventListener('click', function () {
        let newItemClone = document.createElement('div');
        newItemClone.classList.add('gallery-item');
        newItemClone.innerHTML = `
            <div class="input-group mb-3">
                <input name="item[]"  type="file" class="form-control">
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
            <button type="button" class="btn btn-primary add">اضافه</button>
        `;
        container.appendChild(newItemClone);

        // گوش دادن به رویداد حذف برای دکمه حذف جدید
        newItemClone.querySelector('.remove').addEventListener('click', function () {
            this.parentElement.remove();
        });
    });
});
/**************************************************/

