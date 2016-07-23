<spark-navbar
    :user="user"
    :teams="teams"
    :current-team="currentTeam"
    :has-unread-notifications="hasUnreadNotifications"
    :has-unread-announcements="hasUnreadAnnouncements"
    inline-template>

    <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <span class="m-r-sm text-muted welcome-message">Welcome @{{ user.name }}</span>
                </li>
                <li>
                    <a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Log out</a>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-bell"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</spark-navbar>