Vue.component('favorite', {
    props: ['user', 'project', 'favorited'],

    template: `
        <button class="btn btn-info pull-right">
            <span v-if="favorited"><i class="fa fa-btn fa-star"></i>Unfavorite</span>
            <span v-else><i class="fa fa-btn fa-star-o"></i>Favorite</span>
        </button>
    `,

    ready() {
        //
    }
});
