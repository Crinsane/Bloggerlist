<div class="row">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Your followers</h5> <span class="label label-primary">{{ auth()->user()->followers()->count() }}</span>
                        </div>
                        <div class="ibox-content">
                            <div>
                                <div class="pull-right text-right">
                                    <span class="bar_dashboard">{{ implode(',', $followerCount) }}</span>
                                </div>
                                @if ($newFollowersLastWeek > 0)
                                    <h4>Last week {{ $newFollowersLastWeek }} new users started following you!
                                        <br/>
                                        <small class="m-r">You're doing great!</small>
                                    </h4>
                                @else
                                    <h4>Last week you did not get any new followers
                                        <br/>
                                        <small class="m-r">Why don't you go look for interesting <a href="{{ route('companies.index') }}">companies</a> or <a href="{{ route('bloggers.index') }}">bloggers</a>?</small>
                                    </h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{--<div class="ibox float-e-margins">--}}
                        {{--<div class="ibox-title">--}}
                            {{--<h5>Read below comments</h5>--}}
                            {{--<div class="ibox-tools">--}}
                                {{--<a class="collapse-link">--}}
                                    {{--<i class="fa fa-chevron-up"></i>--}}
                                {{--</a>--}}
                                {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
                                    {{--<i class="fa fa-wrench"></i>--}}
                                {{--</a>--}}
                                {{--<ul class="dropdown-menu dropdown-user">--}}
                                    {{--<li><a href="#">Config option 1</a>--}}
                                    {{--</li>--}}
                                    {{--<li><a href="#">Config option 2</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                                {{--<a class="close-link">--}}
                                    {{--<i class="fa fa-times"></i>--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="ibox-content no-padding">--}}
                            {{--<ul class="list-group">--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<p><a class="text-info" href="#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>--}}
                                    {{--<small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<p><a class="text-info" href="#">@Stock Man</a> Check this stock chart. This price is crazy! </p>--}}
                                    {{--<div class="text-center m">--}}
                                        {{--<span id="sparkline8"></span>--}}
                                    {{--</div>--}}
                                    {{--<small class="block text-muted"><i class="fa fa-clock-o"></i> 2 hours ago</small>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<p><a class="text-info" href="#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>--}}
                                    {{--<small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item ">--}}
                                    {{--<p><a class="text-info" href="#">@Jonathan Febrick</a> The standard chunk of Lorem Ipsum</p>--}}
                                    {{--<small class="block text-muted"><i class="fa fa-clock-o"></i> 1 hour ago</small>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<p><a class="text-info" href="#">@Alan Marry</a> I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>--}}
                                    {{--<small class="block text-muted"><i class="fa fa-clock-o"></i> 1 minuts ago</small>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<p><a class="text-info" href="#">@Kevin Smith</a> Lorem ipsum unknown printer took a galley </p>--}}
                                    {{--<small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <div class="col-lg-4">
                    <daily-feed :user="user"></daily-feed>
                </div>
                <div class="col-lg-4">
                    <subscribed-projects :user="user"></subscribed-projects>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        ;(function ($) {
            $(function () {
                $('.bar_dashboard').peity('bar', {
                    fill: ['#1ab394', '#d7d7d7'],
                    width: 100
                });
            });
        })(jQuery);
    </script>
@endpush