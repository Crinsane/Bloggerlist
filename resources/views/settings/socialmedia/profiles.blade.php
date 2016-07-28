<update-socialmedia-profiles :user="user" inline-template>
    <div class="ibox">
        <div class="ibox-title"><h5>Social Media Profiles</h5></div>

        <div class="ibox-content">
            <!-- Success Message -->
            <div class="alert alert-success" v-if="form.successful">
                Your social media profiles have been updated!
            </div>

            <form class="form-horizontal" role="form">
                <!-- Facebook -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Facebook</label>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-facebook"><i class="fa fa-btn fa-facebook"></i>Authorize Facebook</button>
                    </div>
                </div>

                <!-- Twitter -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Twitter</label>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-twitter"><i class="fa fa-btn fa-twitter"></i>Authorize Twitter</button>
                    </div>
                </div>

                <!-- Instagram -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Instagram</label>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-instagram"><i class="fa fa-btn fa-instagram"></i>Authorize Instagram</button>
                    </div>
                </div>

                <!-- YouTube -->
                <div class="form-group">
                    <label class="col-md-4 control-label">YouTube</label>
                    <div class="col-md-4">
                        <button class="btn btn-block btn-youtube"><i class="fa fa-btn fa-youtube"></i>Authorize YouTube</button>
                    </div>
                </div>

                <!-- Update Button -->
                {{--<div class="form-group">--}}
                    {{--<div class="col-md-offset-4 col-md-6">--}}
                        {{--<button type="submit" class="btn btn-primary"--}}
                                {{--@click.prevent="update"--}}
                                {{--:disabled="form.busy">--}}

                            {{--Update--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </form>
        </div>
    </div>
</update-socialmedia-profiles>