Vue.component('favorite', {
    props: ['user', 'project', 'favorited'],

    template: `
        <button v-el:button class="btn btn-info pull-right" :class="{ 'btn-outline' : !favorited }" @click="process">
            <span v-if="favorited"><i class="fa fa-btn fa-star"></i>Unfavorite</span>
            <span v-else><i class="fa fa-btn fa-star-o"></i>Favorite</span>
        </button>
    `,

    ready() {
        //
    },

    methods: {

        process() {
            if (this.favorited) {
                this.unfavorite();
            } else {
                this.favorite();
            }
        },

        favorite() {
            this.$http.post(`/projects/${this.project}/favorite`)
                .then(response => {
                    this.favorited = 1;
                    $(this.$els.button).blur();
                })
        },

        unfavorite() {
            this.$http.delete(`/projects/${this.project}/unfavorite`)
                .then(response => {
                    this.favorited = 0;
                    $(this.$els.button).blur();
                })
        }
    }
});
