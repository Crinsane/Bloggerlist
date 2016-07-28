Vue.component('subscribed-projects', {
    props: ['user'],

    data() {
        return {
            projects: [],
            loading: true
        }
    },

    template: `
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Subscribed projects</h5>
            </div>
            <div class="ibox-content ibox-heading">
                <h3>Below are the projects you've signed up for</h3>
                <small><i class="fa fa-star"></i> We've notified the companies, so they should get back to you soon with more information.</small>
            </div>
            <div class="ibox-content" style="padding: 100px 0;" v-if="loading">
                <h4 class="text-center">Loading projects...</h4>
                <div class="sk-spinner sk-spinner-three-bounce">
                    <div class="sk-bounce1"></div>
                    <div class="sk-bounce2"></div>
                    <div class="sk-bounce3"></div>
                </div>
            </div>
            <div class="ibox-content inspinia-timeline" v-else>
                <div class="timeline-item" v-for="project in projects">
                    <div class="row">
                        <div class="col-xs-3 date">
                            <i class="fa fa-file-text"></i> {{ project.pivot.created_at | relative }}<br/>
                            <small class="text-navy">{{ project.pivot.created_at | format 'DD-MM-YYYY H:mm' }}</small>
                        </div>
                        <div class="col-xs-7 content no-top-border">
                            <p class="m-b-xs"><strong>{{ project.title }}</strong></p>
                            <p>{{ project.description | truncate '200' }}</p>
                            <p><a href="/projects/{{ project.id }}" class="btn btn-sm btn-primary pull-right" style="margin-bottom: 10px;">View details</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,

    ready() {
        this.fetchSubscribedProjects();
    },

    methods: {

        fetchSubscribedProjects() {
            this.$http.get('/api/blogger/projects')
                .then(response => {
                    this.projects = response.data;
                    this.loading = false;
                });
        }

    },

    filters: {

        format(value, format) {
            return moment.utc(value).local().format(format);
        },

        truncate: function(string, value) {
            if (string.length <= value) return string;

            return string.substring(0, value) + '...';
        }
    }

});
