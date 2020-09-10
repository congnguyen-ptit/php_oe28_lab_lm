<footer class="site-footer">
        <div class="container">
            <div id="footer-widgets">
                <div class="row">
                    <div class="col-md-6 col-sm-8 widget-container">
                        <div id="text-2" class="widget widget_text">
                            <h3 class="footer-widget-title">{{ trans('page.about') }}</h3>
                            <span class="underline left"></span>
                            <div class="textwidget">
                                {{ trans('page.sd') }}
                            </div>
                            <address>
                                <div class="info">
                                    <i class="fa fa-location-arrow"></i>
                                    <span>{{ trans('page.ad') }}</span>
                                </div>
                                <div class="info">
                                    <i class="fa fa-envelope"></i>
                                    <span><a href="mailto:support@libraria.com">{{ trans('page.email') }}</a></span>
                                </div>
                                <div class="info">
                                    <i class="fa fa-phone"></i>
                                    <span><a href="tel:012-345-6789">{{ trans('page.0916718468') }}</a></span>
                                </div>
                            </address>
                        </div>
                    </div>
                    <div class="clearfix hidden-lg hidden-md hidden-xs tablet-margin-bottom"></div>
                    <div class="col-md-6 col-sm-8 widget-container">
                        <div id="text-4" class="widget widget_text">
                            <h3 class="footer-widget-title">{{ trans('page.timing') }}</h3>
                            <span class="underline left"></span>
                            <div class="timming-text-widget">
                                <time datetime="2020-02-13">{{ trans('page.t1') }}</time>
                                <time datetime="2020-02-13">{{ trans('page.t2') }}</time>
                                <time datetime="2020-02-13">{{ trans('page.t3') }}</time>
                                <time datetime="2020-02-13">{{ trans('t4.timing') }}</time>
                                <ul>
                                    <li><a href="#">{{ trans('page.closings') }}</a></li>
                                    <li><a href="#">{{ trans('page.branches') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 pull-center">
                        <ul>
                            <li><a href="{{ route('home') }}">{{ trans('page.home') }}</a></li>
                            <li><a href="#">{{ trans('page.category') }}</a></li>
                            <li><a href="#">{{ trans('page.newsandevents') }}</a></li>
                            <li><a href="#">{{ trans('page.newsandevents') }}</a></li>
                            <li><a href="#">{{ trans('page.blog') }}</a></li>
                            <li><a href="#">{{ trans('page.contact') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
