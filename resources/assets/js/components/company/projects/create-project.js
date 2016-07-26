Vue.component('create-project', {
    props: ['user'],

    data() {
        return {
            form: new SparkForm({
                title: '',
                description: '',
                category_id: '',
                reward: '',
                location: ''
            }),
            dropZone: null,
            files: [],
            steps: [{
                title: '',
                description: ''
            }]
        };
    },

    ready() {
        this.dropZone = new Dropzone('div#project-images', {
            url: '/company/projects',
            clickable: false,
            autoProcessQueue: false,
            thumbnailWidth: 120,
            thumbnailHeight: 120,
            previewTemplate: `
                 <div id="preview-template" style="display: none;"></div>
            `
        });

        this.dropZone.on('thumbnail', (file, dataUrl) => {
            this.files.push({ file: file, url: dataUrl });
        });
    },

    methods: {

        store() {
            this.form.startProcessing();

            // We need to gather a fresh FormData instance with the form data and the images
            // appended to the data so we can POST it up to the server.
            this.$http.post('/company/projects', this.gatherFormData())
                .then(function(response) {
                    this.form.finishProcessing();

                    window.location = response.data.redirect;
                })
                .catch(function(response) {
                    this.form.setErrors(response.data);
                });
        },

        deleteImage(file) {
            this.files.$remove(file);

            this.dropZone.removeFile(file.file);
        },

        /**
         * Gather the form data for the photo upload.
         */
        gatherFormData() {
            const data = new FormData();

            const form = JSON.parse(JSON.stringify(this.form));

            for (var key in form) {
                data.append(key, form[key]);
            }

            let files = this.dropZone.files;

            for (var i in files) {
                data.append('images[]', files[i]);
            }

            for (var i in this.steps) {
                data.append('steps[]', JSON.stringify(this.steps[i]));
            }

            return data;
        }
    }
});