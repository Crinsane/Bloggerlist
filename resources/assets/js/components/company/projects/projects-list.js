Vue.component('projects-list', {
    props: ['user'],

    data() {
        return {
            projects: [],
            category: {},
            search: '',
            loading: true,
            refreshing: false
        }
    },

    computed: {
        filteredProjects() {
            let projects = this.projects;

            if (this.category.slug) {
                projects = projects.filter(project => project.category.slug == this.category.slug);
            }

            if (this.search) {
                let search = this.search.toLowerCase();

                projects = projects.filter(project => project.title.toLowerCase().indexOf(search) > -1 || project.description.indexOf(search) > -1);
            }

            return projects;
        }
    },

    ready() {
        this.fetchProjects();
    },

    methods: {

        fetchProjects() {
            this.$http.get('/api/projects')
                .then(response => {
                    this.projects = response.data;

                    this.loading = false;
                    this.refreshing = false;
                });
        },

        filterByCategory(category) {
            this.category = category;

            $('html, body').animate({ scrollTop: 0 });
        },

        removeCategoryFilter() {
            this.category = {};
        },

        projectCompletionPercentage(project) {
            if (project.subscribers.length == 0) return '0%';

            return 100 * (project.bloggers / project.subscribers.length) + '%';
        },

        refresh() {
            this.search = '';
            this.category = {};

            this.refreshing = true;

            this.fetchProjects();
        }

    }
});
