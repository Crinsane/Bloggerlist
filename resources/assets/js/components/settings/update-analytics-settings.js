Vue.component('update-analytics-settings', {
    props: ['user'],

    data() {
        return {
            form: new SparkForm({
                analytics_id: ''
            }),
            data: [],
            error: '',
            showChart: false
        };
    },

    ready() {
        if (this.user.social_media) {
            this.form.analytics_id = this.user.social_media.analytics_id;
        }
    },

    events: {
        sparkHashChanged(hash) {
            if (hash == 'analytics') {
                if (this.form.analytics_id) {
                    this.showChart = true;
                    this.fetchAnalyticsData();
                }
            }
        }
    },

    methods: {

        update() {
            this.error = '';

            Spark.put('/settings/analytics', this.form)
                .then(response => {
                    this.$dispatch('updateUser');

                    if (this.form.analytics_id == '') {
                        this.showChart = false;
                    } else {
                        this.showChart = true;
                        this.fetchAnalyticsData();
                    }
                })
                .catch(errors => {
                    this.error = errors.message;
                });
        },

        fetchAnalyticsData() {
            this.$http.get('/api/analytics')
                .then(response => {
                    this.data = response.data;

                    this.$nextTick(() => {
                        this.drawChart();
                    });
                });
        },

        drawChart() {
            var labels = [];
            var visitors = [];
            var pageViews = [];

            this.data.forEach((item, key) => {
                labels.push(item.date);
                visitors.push(item.visitors);
                pageViews.push(item.pageViews);
            });

            var lineData = {
                labels: labels,
                datasets: [
                    {
                        label: 'Pageviews',
                        fillColor: 'rgba(220,220,220,0.5)',
                        strokeColor: 'rgba(220,220,220,1)',
                        pointColor: 'rgba(220,220,220,1)',
                        pointStrokeColor: '#fff',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: pageViews
                    },
                    {
                        label: 'Visitors',
                        fillColor: 'rgba(26,179,148,0.5)',
                        strokeColor: 'rgba(26,179,148,0.7)',
                        pointColor: 'rgba(26,179,148,1)',
                        pointStrokeColor: '#fff',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(26,179,148,1)',
                        data: visitors
                    }
                ]
            };

            var lineOptions = {
                scaleShowGridLines: true,
                scaleGridLineColor: 'rgba(0,0,0,.05)',
                scaleGridLineWidth: 1,
                bezierCurve: true,
                bezierCurveTension: 0.4,
                pointDot: true,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: true,
                datasetStrokeWidth: 2,
                datasetFill: true,
                responsive: true,
            };

            var context = document.getElementById('lineChart').getContext('2d');
            new Chart(context).Line(lineData, lineOptions);
        }

    }
});