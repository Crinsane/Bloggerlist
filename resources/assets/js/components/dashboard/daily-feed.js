Vue.component('daily-feed', {
    props: ['user'],

    data() {
        return {
            currentPage: 0,
            totalPages: 1,
            activities: [],
            fetching: true,
            loading: true
        }
    },

    computed: {
        hasMore() {
            return this.currentPage < this.totalPages;
        }
    },

    template: `
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Your daily feed</h5>
            </div>
            <div class="ibox-content">
                <div style="padding: 100px 0;" v-if="loading">
                    <h4 class="text-center">Loading feed...</h4>
                    <div class="sk-spinner sk-spinner-three-bounce">
                        <div class="sk-bounce1"></div>
                        <div class="sk-bounce2"></div>
                        <div class="sk-bounce3"></div>
                    </div>
                </div>
                
                <div v-else>
                    <div class="feed-activity-list">
                    
                        <div class="feed-element" v-for="activity in activities">
                            <a href="#" class="pull-left">
                                <img alt="image" class="img-circle" :src="activity.user.photo_url">
                            </a>
                            <div class="media-body">
                                <small class="pull-right">{{ activity.created_at | relative }} ago</small>
                                {{{ activity.title }}}<br>
                                <small class="text-muted">{{ activity.created_at | human }}</small>
                                <!--<div class="actions">-->
                                    <!--<a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like</a>-->
                                    <!--<a class="btn btn-xs btn-danger"><i class="fa fa-heart"></i> Love</a>-->
                                <!--</div>-->
                                <!--<div class="well">-->
                                    <!--Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.-->
                                    <!--Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).-->
                                <!--</div>-->
                                <!--<div class="pull-right">-->
                                    <!--<a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like</a>-->
                                    <!--<a class="btn btn-xs btn-white"><i class="fa fa-heart"></i> Love</a>-->
                                    <!--<a class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Message</a>-->
                                <!--</div>-->
                            </div>
                        </div>
                        
                    </div>
                    
                    <button class="btn btn-primary btn-block m" style="margin-left: 0;" @click.prevent="fetchActivityFeed" :disabled="fetching" v-if="hasMore">
                        <span v-if="fetching"><i class="fa fa-spinner fa-spin"></i> Show More</span>
                        <span v-else><i class="fa fa-arrow-down"></i> Show More</span>
                    </button>
                </div>
            </div>
        </div>
    `,

    ready() {
        this.fetchActivityFeed();
    },

    methods: {

        // Fetch the activity feed for the given user
        fetchActivityFeed() {
            this.$http.get(`/api/activity`, { page: this.currentPage + 1 })
                .then(response => {
                    this.currentPage = response.data.current_page;
                    this.totalPages = response.data.last_page;
                    this.activities = this.activities.concat(response.data.data);
                    this.fetching = false;
                    this.loading = false;
                });
        }

    },

    filters: {

        human(value) {
            let formatDate = moment.utc(value).local();
            let format = '';

            if (formatDate.diff(moment(), 'days') == 0) {
                format += 'today ';
            } else if (moment().diff(formatDate, 'days') == 1) {
                format += 'yesterday ';
            } else {
                format += formatDate.fromNow();
            }

            let time = formatDate.format('hh:mm');
            let date = formatDate.format('DD-MM-YYYY');

            return `${format} at ${time} - ${date}`;
        }

    }
});
