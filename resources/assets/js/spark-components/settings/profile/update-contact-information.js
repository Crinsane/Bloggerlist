var base = require('settings/profile/update-contact-information');

Spark.forms.updateContactInformation = {
    address: '',
    address_line_2: '',
    city: '',
    state: '',
    zip: '',
    country: 'US'
};

Vue.component('spark-update-contact-information', {
    mixins: [base],

    ready() {
        this.form.address = this.user.address;
        this.form.address_line_2 = this.user.address_line_2;
        this.form.city = this.user.city;
        this.form.state = this.user.state;
        this.form.zip = this.user.zip;
        this.form.country = this.user.country;
    }
});
