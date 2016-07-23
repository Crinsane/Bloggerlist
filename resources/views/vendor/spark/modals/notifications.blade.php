<!-- Notifications Modal -->
<spark-notifications
    :notifications="notifications"
    :has-unread-announcements="hasUnreadAnnouncements"
    :loading-notifications="loadingNotifications" inline-template>

    <div id="right-sidebar">
        <div class="sidebar-container">

            <ul class="nav nav-tabs navs-2">
                <li class="active"><a data-toggle="tab" href="#notifications" @click="showNotifications">Notifications</a></li>
                <li><a data-toggle="tab" href="#announcements" @click="showAnnouncements">Announcements <i class="fa fa-circle text-danger p-l-xs" v-if="hasUnreadAnnouncements"></i></a></li>
            </ul>

            <div class="tab-content">

                <div v-if="showingNotifications && hasNotifications">

                    <div>
                        <div class="sidebar-message" v-for="notification in notifications.notifications">
                            <div class="pull-left text-center">
                                <img v-if="notification.creator" :src="notification.creator.photo_url" class="img-circle message-avatar">
                                <span v-else class="fa-stack fa-2x">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa @{{ notification.icon }} fa-stack-1x fa-inverse"></i>
                                </span>
                        </div>
                        <div class="media-body">
                            @{{{ notification.parsed_body }}}
                            <br>
                            <small class="text-muted">@{{ notification.created_at | relative }}</small>
                            <a :href="notification.action_url" class="btn btn-primary" v-if="notification.action_text">@{{ notification.action_text }}</a>
                        </div>
                    </div>
                </div>
            </div>

                <div v-if="showingAnnouncements && hasAnnouncements">

                    <ul class="sidebar-list">
                        <li v-for="announcement in notifications.announcements">
                            <a href="#">
                                <img :src="announcement.creator.photo_url" class="spark-profile-photo">
                                <div class="small pull-right m-t-xs">@{{ announcement.created_at | relative }}</div>
                                <h4>@{{ announcement.creator.name }}</h4>
                                @{{{ announcement.parsed_body }}}
                                <a :href="announcement.action_url" class="btn btn-primary" v-if="announcement.action_text">
                                    @{{ announcement.action_text }}
                                </a>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</spark-notifications>
