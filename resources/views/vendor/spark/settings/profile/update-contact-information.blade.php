<spark-update-contact-information :user="user" inline-template>
    <div class="ibox">
        <div class="ibox-title"><h5>Contact Information</h5></div>

        <div class="ibox-content">
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                Your contact information has been updated!
            </div>

            <p>This contact information will be used when we need to contact your for anything. If you want to edit your billing information, please click <a href="/settings#/payment-method">here</a></p>

            <form class="form-horizontal" role="form">
                <!-- Name -->
                <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                    <label class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" v-model="form.name">

                        <span class="help-block" v-show="form.errors.has('name')">
                            @{{ form.errors.get('name') }}
                        </span>
                    </div>
                </div>

                <!-- E-Mail Address -->
                <div class="form-group" :class="{'has-error': form.errors.has('email')}">
                    <label class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" v-model="form.email">

                        <span class="help-block" v-show="form.errors.has('email')">
                            @{{ form.errors.get('email') }}
                        </span>
                    </div>
                </div>

                <!-- Address -->
                <div class="form-group" :class="{'has-error': form.errors.has('address')}">
                    <label class="col-md-4 control-label">Address</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address" v-model="form.address">

                        <span class="help-block" v-show="form.errors.has('address')">
                            @{{ form.errors.get('address') }}
                        </span>
                    </div>
                </div>

                <!-- Address Line 2 -->
                <div class="form-group" :class="{'has-error': form.errors.has('address_line_2')}">
                    <label class="col-md-4 control-label">Address Line 2</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="address_line_2" v-model="form.address_line_2">

                        <span class="help-block" v-show="form.errors.has('address_line_2')">
                            @{{ form.errors.get('address_line_2') }}
                        </span>
                    </div>
                </div>

                <!-- City -->
                <div class="form-group" :class="{'has-error': form.errors.has('city')}">
                    <label class="col-md-4 control-label">City</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="city" v-model="form.city">

                        <span class="help-block" v-show="form.errors.has('city')">
                            @{{ form.errors.get('city') }}
                        </span>
                    </div>
                </div>

                <!-- State & ZIP Code -->
                <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                    <label class="col-md-4 control-label">State & ZIP / Postal Code</label>

                    <!-- State -->
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="State" v-model="form.state" lazy>

                        <span class="help-block" v-show="form.errors.has('state')">
                            @{{ form.errors.get('state') }}
                        </span>
                    </div>

                    <!-- Zip Code -->
                    <div class="col-sm-3">
                        <input type="text" class="form-control" placeholder="Postal Code" v-model="form.zip" lazy>

                        <span class="help-block" v-show="form.errors.has('zip')">
                            @{{ form.errors.get('zip') }}
                        </span>
                    </div>
                </div>

                <!-- Country -->
                <div class="form-group" :class="{'has-error': form.errors.has('country')}">
                    <label class="col-md-4 control-label">Country</label>

                    <div class="col-sm-6">
                        <select class="form-control" name="country" v-model="form.country" lazy>
                            @foreach (app(Laravel\Spark\Repositories\Geography\CountryRepository::class)->all() as $key => $country)
                                <option value="{{ $key }}">{{ $country }}</option>
                            @endforeach
                        </select>

                        <span class="help-block" v-show="form.errors.has('country')">
                            @{{ form.errors.get('country') }}
                        </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <button type="submit" class="btn btn-primary"
                                @click.prevent="update"
                                :disabled="form.busy">

                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</spark-update-contact-information>
