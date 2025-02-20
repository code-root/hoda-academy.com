 

     <div class="page-banner-with-full-image item-bg4 ">
        <div class="container center">
            <div class="page-banner-content-two">
                <h2>{!! __('web.404 Error') !!}</h2>
                <ul>
                    <li>
                        <a  >{{ __('web.home') }}</a>
                    </li>
                    <li>{!! __('web.404 Error') !!}</li>
                </ul>
            </div>
        </div>
    </div>


    <section class="error-area ptb-100 ">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="error-content">
                        <img src="{{ asset('web') }}/assets/images/404.png" alt="error">
                        <h3>{!! __('web.Error 404 : page not found') !!}</h3>
                        <p>{!! __(
                            'web.The page you are looking for might have been removed had its name changed or is temporarily unavailable.',
                        ) !!}</p>
                        <a class="default-btn">{{ __('web.Go To Home') }} <i
                                class="flaticon-pointer"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
 