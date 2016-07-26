Vue.component('project-unsubscribe', {
    props: ['user', 'project'],

    template: `
        <div>
            <h4>You've signed up for this project <small>(<a href="#" @click.prevent="showModal">unsubscribe</a>)</small></h4>

            <div class="modal inmodal" v-el:modal tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated bounceInTop">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Unsubscribe from the project</h4>
                            <small class="font-bold">Are you sure you want to unsubscribe?</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="unsubscribe">Unsubscribe</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,

    ready() {
        //
    },

    methods: {

        showModal() {
            $(this.$els.modal).modal('show');
        },

        closeModal() {
            $(this.$els.modal).modal('hide');
        },

        unsubscribe() {
            this.$http.delete(`/projects/${this.project}/unsubscribe`)
                .then(response => {
                    this.$dispatch('updateUser');

                    this.closeModal();

                    toastr.info('You\'ve successfully unsubscribed yourself for this project.');
                });
        }

    }
});
