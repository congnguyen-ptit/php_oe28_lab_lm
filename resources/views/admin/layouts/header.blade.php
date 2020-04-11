<header class="main-header">
    <a href="{{ route('admin.dashboard') }}" class="logo">
        <span class="logo-lg">{{ trans('page.home') }}</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @auth
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="bower_components/bower_package/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                      <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-header">
                            <img src="bower_components/bower_package/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                            <p>
                              {{ Auth::user()->role->name }}
                              <small>{{ trans('page.membersince') }} {{ Auth::user()->created_at }}</small>
                            </p>
                        </li>
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">{{ trans('page.profile') }}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" >{{ trans('page.logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                @endauth
            </ul>
        </div>
    </nav>
</header>
