Vue.component('project-steps', {
    props: ['user', 'steps', 'form'],

    ready() {
        let el = document.getElementById('project-steps');
        Sortable.create(el, {
            handle: '.project-step-handle',
            onEnd: e => {
                let step = this.steps[e.oldIndex];
                this.steps.$remove(step);
                this.steps.splice(e.newIndex, 0, step);
            }
        });
    },

    methods: {

        addStep() {
            this.steps.push({ title: '', description: '' });
        },

        removeStep(step) {
            this.steps.$remove(step);
        },

        hasError(index, field) {
            return this.form.errors.has('steps.'+index+'.'+field);
        },

    }
});
