<spark-navbar
    :user="user"
    :teams="teams"
    :current-team="currentTeam"
    :has-unread-notifications="hasUnreadNotifications"
    :has-unread-announcements="hasUnreadAnnouncements"
    inline-template>

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header" style="max-height: 156px;">
                    <div class="dropdown profile-element">
                        <span>
                            <img alt="image" class="img-circle" :src="user.photo_url" style="max-width: 48px;"/>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear">
                                <span class="block m-t-xs">
                                    <strong class="font-bold">@{{ user.name }}</strong>
                                </span>
                                <span class="text-muted text-xs block">@{{ user.title }} <b class="caret"></b></span>
                            </span>
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">

                            <!-- Impersonation -->
                            @if (session('spark:impersonator'))
                                <li class="dropdown-header">Impersonation</li>
                                <!-- Stop Impersonating -->
                                <li><a href="/spark/kiosk/users/stop-impersonating"><i class="fa fa-fw fa-btn fa-user-secret"></i>Back To My Account</a></li>
                                <li class="divider"></li>
                            @endif

                            <!-- Developer -->
                            @if (Spark::developer(Auth::user()->email))
                                @include('spark::nav.developer')
                            @endif

                            <!-- Subscription Reminders -->
                            @include('spark::nav.subscriptions')

                            <!-- Settings -->
                            <li class="dropdown-header">Settings</li>
                            <!-- Your Settings -->
                            <li><a href="{{ route('settings') }}"><i class="fa fa-fw fa-btn fa-cog"></i>Settings</a></li>
                            <li class="divider"></li>

                            <!-- Support -->
                            <li class="dropdown-header">Support</li>
                            <li><a @click.prevent="showSupportForm" style="cursor: pointer;"><i class="fa fa-fw fa-btn fa-paper-plane"></i>Email Us</a></li>
                            <li class="divider"></li>

                            <!-- Logout -->
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                        IN+
                    </div>
                </li>
                <li {!! Route::currentRouteName() == 'home' ? 'class="active"' : '' !!}>
                    <a href="{{ route('home') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
                @can('store', new App\Projects\Project)
                <li {!! Route::is('company.projects.*') ? 'class="active"' : '' !!}>
                    <a href="{{ route('company.projects.index') }}"><i class="fa fa-bars"></i> <span class="nav-label">Projects</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li {!! Route::is('company.projects.index') ? 'class="active"' : '' !!}><a href="{{ route('company.projects.index') }}">Personal projects</a></li>
                        <li {!! Route::is('company.projects.create') ? 'class="active"' : '' !!}><a href="{{ route('company.projects.create') }}">Create new project</a></li>
                    </ul>
                </li>
                @endcan
                <li {!! Route::is('projects.*') ? 'class="active"' : '' !!}>
                    <a href="{{ route('projects.index') }}"><i class="fa fa-desktop"></i> <span class="nav-label">All Projects</span></a>
                </li>
                <li {!! Route::is('bloggers.*') ? 'class="active"' : '' !!}>
                    <a href="{{ route('bloggers.index') }}"><i class="fa fa-users"></i> <span class="nav-label">Our Bloggers</span></a>
                </li>
                <li {!! Route::is('companies.*') ? 'class="active"' : '' !!}>
                    <a href="{{ route('companies.index') }}"><i class="fa fa-building"></i> <span class="nav-label">Our Companies</span></a>
                </li>
            </ul>
        </div>
    </nav>

</spark-navbar>