var base = require('auth/register-stripe');

Vue.component('spark-register-stripe', {
    mixins: [base],

    computed: {
        /**
         * Get all of the free plans.
         */
        freePlans() {
            return _.filter(this.plans, plan => {
                return plan.active && plan.price == 0;
            });
        },
    }
});
