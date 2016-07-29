<update-analytics-settings :user="user" inline-template>
    <div>
        <div class="ibox" v-show="showChart">
            <div class="ibox-title"><h5>Google Analytics visitors &amp; pageviews</h5></div>

            <div class="ibox-content">
                <canvas id="lineChart" height="200" width="400"></canvas>
            </div>
        </div>

        <div class="ibox">
            <div class="ibox-title"><h5>Google Analytics</h5></div>

            <div class="ibox-content">
                <!-- Success Message -->
                <div class="alert alert-success" v-if="form.successful">
                    Your Google Analytics ID has been updated!
                </div>

                <form class="form-horizontal" role="form">
                    <!-- Analytics ID -->
                    <div class="form-group" :class="{'has-error': error}">
                        <label class="col-md-4 control-label">Google Analytics ID <a href="#" data-toggle="modal" data-target="#myModal5"><i class="fa fa-question-circle"></i></a></label>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="analytics_id" v-model="form.analytics_id">

                            <span class="help-block" v-show="error">
                                Could not contact your Google Analytics account.
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

        <div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Google Analytics ID</h4>
                        <small class="font-bold">How to get your Google Analytics ID?</small>
                    </div>
                    <div class="modal-body" style="background-color: #ffffff;">
                        <p>You can get your Google Analytics ID value on the <a href="https://analytics.google.com/analytics" target="_blank">Analytics site</a>. Go to "View setting" in the Admin-section of the property.</p>
                        <p>You'll need the <strong>View ID</strong> displayed there.</p>
                        <img src="{{ asset('img/google-analytics-id-screenshot.jpg') }}" style="max-width: 100%;">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</update-analytics-settings>