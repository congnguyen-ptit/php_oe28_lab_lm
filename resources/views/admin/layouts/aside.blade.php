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
                    <span>{{ trans('page.book') }}</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-circle-o"></i>{{ trans('page.showall') }}
                        </a>
                    </li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>{{ trans('page.add') }}</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i>{{ trans('page.edit') }}</a></li>
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
                    <li><a href=""><i class="fa fa-circle-o"></i> {{ trans('page.showall') }}</a></li>
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
                    <li><a href="{{ route('category.data', 'all') }}"><i class="fa fa-circle-o"></i> {{ trans('page.showall') }}</a></li>
                    @foreach ($categories as $category)
                    <li class="treeview">
                        <a href="{{ route('category.data', $category->slug) }}"><i class="fa fa-circle-o"></i> {{ $category->name }}
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                        <ul class="treeview-menu">
                            @foreach ($category->children as $child_category)
                                <li class="treeview">
                                    <a href="{{ route('category.data', $child_category->slug) }}"><i class="fa fa-circle-o"></i> {{ $child_category->name }}
                                        <span class="pull-right-container">
                                          <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    @if ($child_category->children)
                                        <ul class="treeview-menu">
                                            @foreach ($child_category->children as $child)
                                                <li><a href="{{ route('category.data', $child->slug) }}"><i class="fa fa-circle-o"></i> {{ $child->name }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-share"></i> <span>{{ trans('page.bookrequest') }}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('page.all') }}</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('page.request') }}</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('page.borrowed') }}</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> {{ trans('page.returned') }}</a></li>
                </ul>
            </li>
        </ul>
    </section>
</aside>
