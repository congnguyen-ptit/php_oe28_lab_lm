<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="bower_components/bower_package/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>
                {{ trans('page.online') }}</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{ trans('page.main') }}</li>
            <li class="active">
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa fa-dashboard"></i>
                    <span>{{  trans('page.dashboard') }}</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    <span>{{ trans('page.books') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('book.list') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('page.showall') }}
                        </a>
                    </li>
                    <li><a href="{{ route('book.add') }}"><i class="fa fa-circle-o"></i>{{ trans('page.add') }}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    <span>{{ trans('page.members') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('user.list') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('page.showall') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.author') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('page.author') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.reader') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('page.user') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.add') }}">
                            <i class="fa fa-circle-o"></i>{{ trans('page.add') }}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                  <i class="fa fa-edit"></i> <span>{{ trans('page.publishers') }}</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('publisher.all') }}"><i class="fa fa-circle-o"></i> {{ trans('page.showall') }}</a></li>
                    <li><a href="{{ route('publisher.add') }}"><i class="fa fa-circle-o"></i> {{ trans('page.add') }}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>{{ trans('page.categories') }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('category.list') }}"><i class="fa fa-circle-o"></i> {{ trans('page.showall') }}</a></li>
                    <li><a href="{{ route('category.add') }}"><i class="fa fa-circle-o"></i> {{ trans('page.add') }}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>{{ trans('page.bookrequests') }}</span>
                    <span class="pull-right-container">
                        <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('record.list') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('page.allrc') }}
                        </a>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-yellow">{{ $request->count() }}</small>
                        </span>
                    </li>
                    <li>
                        <a href="{{ route('record.request') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('page.request') }}
                        </a>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-blue">{{ $borrowed->count() }}</small>
                        </span>
                    </li>
                    <li>
                        <a href="{{ route('record.borrowed') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('page.borrowed') }}
                        </a>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-green">{{ $returned->count() }}</small>
                        </span>
                    </li>
                    <li>
                        <a href="{{ route('record.returned') }}">
                            <i class="fa fa-circle-o"></i> {{ trans('page.returned') }}
                        </a>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-red">{{ $rejected->count() }}</small>
                        </span>
                    <li><a href="{{ route('record.rejected') }}"><i class="fa fa-circle-o"></i> {{ trans('page.rejected') }}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>{{ trans('page.roles') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('role.list') }}"><i class="fa fa-circle-o"></i> {{ trans('page.showall') }}</a></li>
                    <li><a href="{{ route('role.add') }}"><i class="fa fa-circle-o"></i> {{ trans('page.add') }}</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
