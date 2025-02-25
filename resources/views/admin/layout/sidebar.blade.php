<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">

            <li class="nav-title">
               {{ __('messages.Management_panel') }}
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-menu"></i>{{__('messages.Menu_settings')}}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('menu.index') }}" target="_top">{{__('messages.View_the_menu_list')}}</a>

                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="bi bi-file-earmark-richtext"></i>{{ __('messages.Page_settings') }}</a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('page.index') }}" target="_top">{{ __('messages.View_the_list_of_pages') }}</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="bi bi-images"></i><span>{{ __('messages.Gallery_settings') }}</span></a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gallery.index') }}" target="_top">{{ __('messages.View_the_gallery_list') }}</a>

                    </li>
                </ul>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="bi bi-image-alt"></i><span>{{ __('messages.Site_banner_settings') }}</span></a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('slider.index') }}" target="_top">{{ __('messages.View_the_list_of_banners') }}</a>

                    </li>
                </ul>
            </li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#"><i class="bi bi-box-fill"></i><span>{{ __('messages.Courses') }}</span></a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('course_group.index') }}" target="_top">{{ __('messages.View_the_list_of_Courses_groups') }}</a>

                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('course.index') }}" target="_top">{{ __('messages.View_the_list_of_Courses') }}</a>

                    </li>



                </ul>
            </li>



        </ul>
    </nav>
</div>
