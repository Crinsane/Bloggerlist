Vue.component('update-analytics-settings', {
    props: ['user'],

    data() {
        return {
            form: new SparkForm({
                analytics_id: ''
            })
        };
    },

    ready() {
        if (this.user.social_media) {
            this.form.analytics_id = this.user.social_media.analytics_id;
        }

        var chart = new Chart(
            document.getElementById(id).getContext('2d')
        ).Line(data);
    },

    methods: {
        update() {
            Spark.put('/settings/analytics', this.form)
                .then(response => {
                    this.$dispatch('updateUser');
                });
        }
    }
});