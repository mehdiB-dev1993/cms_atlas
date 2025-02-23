<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-title">
                پنل مدیریت
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="icon-speedometer"></i> داشبورد {{--<span class="badge badge-primary"></span>--}}</a>
            </li>

            <li class="divider"></li>





            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-menu"></i>تنظیمات منو</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu.index') }}" target="_top">مشاهده لیست منو</a>

                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-menu"></i>تنظیمات صفحات</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.index') }}" target="_top">مشاهده لیست صفحات</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-menu"></i>تنظیمات گالری</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gallery.index') }}" target="_top">مشاهده لیست گالری</a>
                    </li>
                </ul>
            </li>


        </ul>
    </nav>
</div>
