Vue.component('projects-feed', {
    props: ['user', 'company'],

    data() {
        return {
            loading: true,
            projects: [],
        }
    },

    template: `
        <div>
            <div class="ibox" v-if="loading">
                <div class="ibox-content" style="padding: 100px 0;">
                    <h4 class="text-center">Loading projects...</h4>
                    <div class="sk-spinner sk-spinner-three-bounce">
                        <div class="sk-bounce1"></div>
                        <div class="sk-bounce2"></div>
                        <div class="sk-bounce3"></div>
                    </div>
                </div>
            </div>
            
            <div v-else>
                <div class="social-feed-box" v-for="project in projects">
                    <div class="social-avatar">
                        <!--<a href="" class="pull-left">-->
                            <!--<img alt="image" src="img/a1.jpg">-->
                        <!--</a>-->
                        <div class="media-body">
                            <a href="/projects/{{ project.id }}">{{ project.title }}</a>
                            <small class="text-muted">{{ project.created_at | human }}</small>
                        </div>
                    </div>
                    <div class="social-body">
                        <p>{{ project.description }}</p>
    
                        <div class="btn-group">
                            <!--<favorite :user="user" :project="project" :favorited="0"></favorite>-->
                            <button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>
                            <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>
                            <button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>
                        </div>
                    </div>
                    <div class="social-footer">
                        <div class="social-comment">
                            <a href="" class="pull-left">
                                <img alt="image" src="img/a1.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#">
                                    Andrew Williams
                                </a>
                                Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.
                                <br/>
                                <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> -
                                <small class="text-muted">12.06.2014</small>
                            </div>
                        </div>
    
                        <div class="social-comment">
                            <a href="" class="pull-left">
                                <img alt="image" src="img/a2.jpg">
                            </a>
                            <div class="media-body">
                                <a href="#">
                                    Andrew Williams
                                </a>
                                Making this the first true generator on the Internet. It uses a dictionary of.
                                <br/>
                                <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                                <small class="text-muted">10.07.2014</small>
                            </div>
                        </div>
    
                        <div class="social-comment">
                            <a href="" class="pull-left">
                                <img alt="image" src="img/a3.jpg">
                            </a>
                            <div class="media-body">
                                <textarea class="form-control" placeholder="Write comment..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,

    ready() {
        this.fetchProjectsFeed();
    },

    methods: {

        // Fetch the projects feed for the given company
        fetchProjectsFeed() {
            this.$http.get(`/api/company/${this.company}/projects`)
                .then(response => {
                    this.projects = response.data;
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
