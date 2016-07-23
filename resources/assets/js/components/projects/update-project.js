Vue.component('update-project', {
    props: ['user'],

    data() {
        return {
            id: '',
            form: new SparkForm({
                title: '',
                description: '',
                category_id: '',
                reward: '',
                location: ''
            }),
            dropZone: null,
            images: [],
            files: []
        };
    },

    events: {
        ImageRemoved(image) {
            this.images.$remove(image);
        }
    },

    ready() {
        this.fetchProjectImages();

        this.dropZone = new Dropzone('div#project-images', {
            url: '/projects',
            clickable: false,
            autoProcessQueue: false,
            thumbnailWidth: 120,
            thumbnailHeight: 120,
            previewTemplate: `
                 <div id="preview-template" style="display: none;"></div>
            `
        });

        this.dropZone.on('addedfile', file => {
            this.addImage(file);
        });
    },

    methods: {
        fetchProjectImages() {
            this.$http.get('/projects/'+this.id+'/media')
                .then(response => {
                    this.images = response.data;
                });
        },

        update() {
            Spark.put('/projects/'+this.id, this.form)
                .then(response => {

                });
        },

        addImage(file) {
            const data = new FormData;

            data.append('image', file);

            this.sendImage(data, file);
        },

        sendImage(data, file) {
            this.$http.post('/projects/'+this.id+'/media', data)
                .then(response => {
                    this.images.push(response.data);

                    this.dropZone.removeFile(file);
                })
        }
    }
});