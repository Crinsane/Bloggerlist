<update-analytics-settings :user="user" inline-template>
    <div class="ibox">
        <div class="ibox-title"><h5>Google Analytics</h5></div>

        <div class="ibox-content">
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                Your profile has been updated!
            </div>

            <form class="form-horizontal" role="form">
                <!-- Analytics ID -->
                <div class="form-group" :class="{'has-error': form.errors.has('analytics_id')}">
                    <label class="col-md-4 control-label">Google Analytics ID</label>

                    <div class="col-md-4">
                        <input type="text" class="form-control" name="analytics_id" v-model="form.analytics_id">

                        <span class="help-block" v-show="form.errors.has('analytics_id')">
                            @{{ form.errors.get('analytics_id') }}
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
</update-analytics-settings>