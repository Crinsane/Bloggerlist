@inject('facebook', 'App\SocialMedia\Facebook')
@inject('twitter', 'App\SocialMedia\Twitter')
@inject('instagram', 'App\SocialMedia\Instagram')

{{--<update-socialmedia-profiles :user="user" inline-template>--}}
    <div class="ibox">
        <div class="ibox-title"><h5>Social Media Profiles</h5></div>

        <div class="ibox-content">
            <form class="form-horizontal" role="form">
                <!-- Facebook -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Facebook</label>
                    @if (auth()->user()->socialMedia->facebook_token)
                        <div class="col-md-5">
                            <p class="form-control-static font-bold"><i class="fa fa-check text-success"></i> You've successfully authorized Facebook</p>
                        </div>
                    @else
                        <div class="col-md-4">
                            <a href="{{ $facebook->getLoginUrl() }}" class="btn btn-block btn-facebook"><i class="fa fa-btn fa-facebook"></i>Authorize Facebook</a>
                        </div>
                    @endif
                </div>

                <!-- Twitter -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Twitter</label>
                    @if (auth()->user()->socialMedia->twitter_token)
                        <div class="col-md-5">
                            <p class="form-control-static font-bold"><i class="fa fa-check text-success"></i> You've successfully authorized Twitter</p>
                        </div>
                    @else
                        <div class="col-md-4">
                            <a href="{{  $twitter->getLoginUrl() }}" class="btn btn-block btn-twitter"><i class="fa fa-btn fa-twitter"></i>Authorize Twitter</a>
                        </div>
                    @endif
                </div>

                <!-- Instagram -->
                <div class="form-group">
                    <label class="col-md-4 control-label">Instagram</label>
                    @if (auth()->user()->socialMedia->instagram_token)
                        <div class="col-md-5">
                            <p class="form-control-static font-bold"><i class="fa fa-check text-success"></i> You've successfully authorized Instagram</p>
                        </div>
                    @else
                        <div class="col-md-4">
                            <a href="{{ $instagram->getLoginUrl() }}" class="btn btn-block btn-instagram"><i class="fa fa-btn fa-instagram"></i>Authorize Instagram</a>
                        </div>
                    @endif
                </div>

                <!-- YouTube -->
                <div class="form-group">
                    <label class="col-md-4 control-label">YouTube</label>
                    @if (auth()->user()->socialMedia->youtube_token)
                        <div class="col-md-5">
                            <p class="form-control-static font-bold"><i class="fa fa-check text-success"></i> You've successfully authorized YouTube</p>
                        </div>
                    @else
                        <div class="col-md-4">
                            <a href="/socialmedia/youtube" class="btn btn-block btn-youtube"><i class="fa fa-btn fa-youtube"></i>Authorize YouTube</a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
{{--</update-socialmedia-profiles>--}}