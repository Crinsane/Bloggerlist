Vue.component('project-subscribe', {
    props: ['user', 'project'],

    template: `
        <div>
            <button class="btn btn-primary" @click="showModal">
                <i class="fa fa-btn fa-check"></i>Subscribe for this project
            </button>

            <div class="modal inmodal" v-el:modal tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Subscribe for the project</h4>
                            <small class="font-bold">So you want to subscribe yourself for this project? Cool!</small>
                        </div>
                        <div class="modal-body">
                            <p>
                                We will let the company know you'd like to help them with this project. After that it's up to the company to pick the blogger they think fits best.
                            </p>
                            <p><strong>Why don't you leave them a message so they'll know a little more about your and your motivation!</strong></p>
                            <div class="form-group">
                                <textarea placeholder="What's your motivation for subscribing?" class="form-control" v-model="form.message"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="subscribe">Subscribe!</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,

    data() {
        return {
            form: new SparkForm({
                message: ''
            })
        }
    },

    ready() {
        //
    },

    methods: {

        showModal() {
            $(this.$els.modal).modal('show');
        },

        closeModal() {
            $(this.$els.modal).modal('hide');

            this.form.message = '';
        },

        subscribe() {
            Spark.post(`/projects/${this.project}/subscribe`, this.form)
                .then(response => {
                    this.$dispatch('updateUser');

                    this.closeModal();

                    toastr.success('You\'ve successfully subscribed yourself for this project. We will let you know if the company picked you!');
                });
        }

    }
});
