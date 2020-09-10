<header class="main-header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-lg">{{ trans('page.home') }}</span>
    </a>
    <nav class="navbar navbar-inverse">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only"></span>
        </a>
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">{{ Auth::user()->name }}</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="#" data-url="{{ route('logout') }}" id="logout">{{ trans('page.logout') }}</a></li>
                    <li class="dropdown dropdown-notifications">
                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>

                        <div class="dropdown-container">
                            <div class="dropdown-toolbar">
                                <div class="dropdown-toolbar-actions">
                                    <a href="#">Mark all as read</a>
                                </div>
                                <h3 class="dropdown-toolbar-title">{{  trans('page.notifications') }} (<span class="notif-count">{{ config('const.empty') }}</span>)</h3>
                            </div>
                            <ul class="dropdown-menu">
                                @foreach (Auth::user()->unreadNotifications as $notification)
                                <li class="notification active">
                                    <div class="media">
                                        <div class="media-left">
                                        </div>
                                        <div class="media-body">
                                            <a href="{{ route('record.detail', $notification->data['request_id']) }}" class="markAsRead" data-url="{{ route('read', $notification->id) }}">
                                                <strong class="notification-title">{{ $notification->data['user_name'] }} {{ trans('page.sendrequest') }}</strong>
                                            </a>
                                            <div class="notification-meta">
                                                <small class="timestamp">about a minute ago</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
