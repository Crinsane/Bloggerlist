Vue.component('project-image', {
    template: `
        <div class="pull-left project-image-thumbnail">
            <img :src="imageUrl" alt="Project image" class="img-thumbnail">
            <a href="#" class="btn btn-xs btn-danger project-image-delete" @click.prevent="delete"><i class="fa fa-times"></i></a>
        </div>
    `,

    props: ['image'],

    computed: {
        imageUrl() {
            return '/media/'+this.image.id+'/'+this.image.file_name;
        }
    },

    methods: {
        delete() {
            this.$http.delete('/projects/'+this.image.model_id+'/media/'+this.image.id)
                .then(response => {
                    this.$dispatch('ImageRemoved', this.image)
                });
        }
    }
});