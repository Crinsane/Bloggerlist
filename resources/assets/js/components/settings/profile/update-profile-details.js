Vue.component('update-profile-details', {
    props: ['user'],

    data() {
        return {
            form: new SparkForm({
                title: '',
                website: '',
                branch: '',
                description: ''
            })
        };
    },

    ready() {
        this.form.title = this.user.title;
        this.form.website = this.user.website;
        this.form.branch = this.user.branch_id ? this.user.branch_id : '';
        this.form.description = this.user.description;
    },

    methods: {
        update() {
            Spark.put('/settings/profile/details', this.form)
                .then(response => {
                    this.$dispatch('updateUser');
                });
        }
    }
});