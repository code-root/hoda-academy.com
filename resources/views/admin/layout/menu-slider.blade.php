<div class="container">
    <ul class="nav nav-pills row row-cols-4 row-cols-md-12 g-3">
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'slider.index' ? 'active' : '' }}"
                href="{{ route('slider.index') }}">
                <i class='bx bxs-slideshow me-1'></i>
                {!! __('admin.Sliders') !!}
            </a>
        </li>
        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'service.index' ? 'active' : '' }}"
                href="{{ route('service.index') }}">
                <i class='bx bx-plus-medical me-1'></i>
                {!! __('admin.Services') !!}
            </a>
        </li> --}}
        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'faq.index' ? 'active' : '' }}"
                href="{{ route('faq.index') }}">
                <i class='bx bxs-add-to-queue me-1'></i>
                {!! __('admin.FAQ') !!}
            </a>
        </li> --}}
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'settings.index' ? 'active' : '' }}"
                href="{{ route('settings.index') }}">
                <i class='me-1 bx bxs-cog'></i>
                {!! __('admin.Settings') !!}
            </a>
        </li>
        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'color.index' ? 'active' : '' }}"
                href="{{ route('color.index') }}">
                <i class='me-1 bx bxs-cog'></i>
                {!! __('admin.Color') !!}
            </a>
        </li> --}}
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'user.index' ? 'active' : '' }}"
                href="{{ route('user.index') }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.Account') !!}
            </a>
        </li>
        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'page.show' ? 'active' : '' }}"
                href="{{ route('page.show') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Page Banner') !!}
            </a>
        </li> --}}
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'meeting.edit' ? 'active' : '' }}"
                href="{{ route('meeting.edit') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Zoom') !!}
            </a>
        </li>
        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'about.index' ? 'active' : '' }}"
                href="{{ route('about.index') }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.About Us') !!}
            </a>
        </li>

        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'policy.index' ? 'active' : '' }}"
                href="{{ route('policy.index') }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.Privacy Policy') !!}
            </a>
        </li>


        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'card.index' ? 'active' : '' }}"
                href="{{ route('card.index') }}">
                <i class="bx bx-user me-1"></i>
                {!! __('admin.Card') !!}
            </a>
        </li>

        <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'meta.index' ? 'active' : '' }}"
                href="{{ route('meta.index') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Meta') !!}
            </a>
        </li>


        {{-- <li class="nav-item col">
            <a class="nav-link {{ Request::route()->getName() == 'faq.index' ? 'active' : '' }}"
                href="{{ route('faq.index') }}">
                <i class="bx bx-user me-1"></i> {!! __('admin.Page Banner') !!}
            </a>
        </li> --}}
    </ul>
</div>
