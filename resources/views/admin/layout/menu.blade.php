<!-- Menu -->
@php
    use App\Models\Setting;
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


    <div class="app-brand demo ">
        <a href="{{ route('home') }}" class="app-brand-link">
            <span class="app-brand-logo demo">

                <img style="width: 45px; height:auto"
                    src="{{ asset('images') }}/{{ Setting::find(1)->photo != null ? Setting::find(1)->photo : 'no-image.png' }}"
                    class="  ms-auto" alt="logo" width="30" />
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2">{{ Setting::find(1)->name }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>



    <ul class="menu-inner py-1">

        <!-- e-commerce-app menu start -->


        <li class="menu-item  {{ Request::route()->getName() == 'home' ? 'active open' : '' }} ">
            <a href="{{ route('home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-home "></i>
                <div class="text-truncate">{!! __('admin.Dashboards') !!}</div>
            </a>
        </li>





        <!-- Products end -->
        <li class="menu-item  {{ Request::route()->getName() == 'booking.index' ? 'active open' : '' }} ">
            <a href="{{ route('booking.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-calendar'></i>

                <div class="text-truncate"> {!! __('admin.Bookings') !!}</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::route()->getName() == 'meeting.index' ? 'active open' : '' }} ">
            <a href="{{ route('meeting.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-video'></i>

                <div class="text-truncate">{!! __('admin.Meetings') !!}</div>
            </a>
        </li>


        <li class="menu-item  {{ Request::route()->getName() == 'contact.index' ? 'active open' : '' }} ">
            <a href="{{ route('contact.index') }}" class="menu-link">

                <i class='menu-icon tf-icons bx bxs-chat'></i>
                <div class="text-truncate">{!! __('admin.Contact Us') !!}</div>
            </a>
        </li>

        <li class="menu-item   {{ Request::route()->getName() == 'customer.index' ? 'active open' : '' }}">
            <a href="{{ route('customer.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-id-card'></i>
                <div class="text-truncate">{!! __('admin.Customers') !!}</div>
            </a>
        </li>





        <li class="menu-item   {{ Request::route()->getName() == 'teachers.index' ? 'active open' : '' }}">
            <a href="{{ route('teachers.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-id-card'></i>
                <div class="text-truncate">{!! __('admin.Teachers') !!}</div>
            </a>
        </li>

        <!-- Order start -->



        {{-- <li class="menu-item  {{ Request::route()->getName() == 'order.index' ? 'active open' : '' }} ">
            <a href="{{ route('order.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-notepad'></i>

                <div class="text-truncate">{!! __('admin.Orders') !!}</div>
            </a>
        </li> --}}

        <!-- Order end -->

        <li class="menu-item  {{ Request::route()->getName() == 'courses.index' ? 'active open' : '' }} ">
            <a href="{{ route('courses.index') }}" class="menu-link">

                <i class='menu-icon tf-icons bx bxs-carousel'></i>
                <div class="text-truncate">{!! __('admin.Online Sessions') !!}</div>
            </a>
        </li>


        {{-- <li class="menu-item  {{ Request::route()->getName() == 'product.index' ? 'active open' : '' }} ">
            <a href="{{ route('product.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-book'></i>

                <div class="text-truncate">{!! __('admin.Products') !!}</div>
            </a>
        </li> --}}




        <!-- Order start -->
        <li
            class="menu-item {{ (Request::route()->getName() == 'review.index' or \Request::route()->getName() == 'courses_review.index') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">

                <i class='menu-icon tf-icons bx bxs-star'></i>


                <div class="text-truncate">{!! __('admin.Reviews') !!}</div>
            </a>
            <ul class="menu-sub">
                {{-- <li class="menu-item {{ Request::route()->getName() == 'review.index' ? 'active' : '' }}">
                    <a href="{{ route('review.index') }}" class="menu-link">
                        <div class="text-truncate">{!! __('admin.Products') !!}</div>
                    </a>
                </li> --}}


                <li class="menu-item {{ Request::route()->getName() == 'courses_review.index' ? 'active' : '' }}">
                    <a href="{{ route('courses_review.index') }}" class="menu-link">
                        <div class="text-truncate">{!! __('admin.Online Sessions') !!}</div>
                    </a>
                </li>

            </ul>
        </li>
        <!-- Order end -->

        <li class="menu-item  {{ Request::route()->getName() == 'subscribe.index' ? 'active open' : '' }} ">
            <a href="{{ route('subscribe.index') }}" class="menu-link">

                <i class='menu-icon tf-icons bx bxs-bell-ring'></i>
                <div class="text-truncate">{!! __('admin.Subscribe') !!}</div>
            </a>
        </li>



        <li class="menu-item  {{ Request::route()->getName() == 'blog.index' ? 'active open' : '' }} ">
            <a href="{{ route('blog.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-book'></i>

                <div class="text-truncate">{!! __('admin.Blogs') !!}</div>
            </a>
        </li>
        <li class="menu-item  {{ Request::route()->getName() == 'rateing.index' ? 'active open' : '' }} ">
            <a href="{{ route('rateing.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-book'></i>

                <div class="text-truncate">{!! __('admin.Rateing') !!}</div>
            </a>
        </li>

        <li class="menu-item  {{ Request::route()->getName() == 'slider.index' ? 'active open' : '' }} ">
            <a href="{{ route('slider.index') }}" class="menu-link">

                <i class='menu-icon tf-icons bx bxs-cog'></i>
                <div class="text-truncate">{!! __('admin.Settings') !!}</div>
            </a>
        </li>









    </ul>
    </li>
    <!-- Products end -->





    </ul>



</aside>
<!-- / Menu -->
