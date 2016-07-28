Vue.component('follow', {
    props: ['user', 'follower', 'follows', 'button'],

    template: `
        <button v-el:button class="{{ button }}" @click="process">
            <span v-if="follows"><i class="fa fa-user-times"></i> Unfollow</span>
            <span v-else><i class="fa fa-user-plus"></i> Follow</span>
        </button>
    `,

    ready() {
        //
    },

    methods: {

        process() {
            if (this.follows) {
                this.unfollow();
            } else {
                this.follow();
            }
        },

        follow() {
            this.$http.post(`/users/${this.follower}/follow`)
                .then(response => {
                    this.follows = 1;
                    $(this.$els.button).blur();
                })
        },

        unfollow() {
            this.$http.delete(`/users/${this.follower}/unfollow`)
                .then(response => {
                    this.follows = 0;
                    $(this.$els.button).blur();
                })
        }
    }
});
