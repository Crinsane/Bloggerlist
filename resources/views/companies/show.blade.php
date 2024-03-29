@extends('spark::layouts.dashboard')

@section('title', $company->title)

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="row m-b-lg m-t-lg">
                    <div class="col-md-6">
                        <div class="profile-image">
                            <img src="{{ $company->photoUrl }}" class="img-circle circle-border m-b-md" alt="profile">
                        </div>
                        <div class="profile-info">
                            <div class="">
                                <div>
                                    <h2 class="no-margins">{{ $company->title }}</h2>
                                    <h4>
                                        @if ($company->branch)
                                            <span class="label {{ $company->branch->slug }}">
                                                    {{ $company->branch->name }}
                                                </span>
                                        @endif
                                    </h4>
                                    <small>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form Ipsum available.
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <table class="table small m-b-xs">
                            <tbody>
                                <tr>
                                    <td>
                                        <strong>{{ $company->projects->count() }}</strong> Projects
                                    </td>
                                    <td>
                                        <strong>{{ $company->followers()->count() }}</strong> Followers
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <strong>0</strong> Events
                                    </td>
                                    <td>
                                        <strong>{{ $company->follows()->count() }}</strong> Following
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-3">
                        <h3>Latest project</h3>
                        <h2 class="no-margins">
                            <a href="{{ route('projects.show', $latestProject) }}">{{ $latestProject->title }}</a><br>
                        </h2>
                        <small>{{ $latestProject->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="ibox">
                            <div class="ibox-content">
                                <h3>About {{ $company->title }}</h3>
                                <p class="small">
                                    {{ $company->description }}
                                </p>
                                {{--<p class="small font-bold">--}}
                                    {{--<span><i class="fa fa-circle text-navy"></i> Online status</span>--}}
                                {{--</p>--}}
                            </div>
                        </div>

                        <div class="ibox">
                            <div class="ibox-content">
                                <h3>
                                    Followers
                                    <follow :user="user" :follower="{{ $company->id }}" :follows="{{ $company->followers->contains(auth()->user()) }}" button="btn btn-xs btn-white pull-right"></follow>
                                </h3>
                                <p class="small">
                                    Would you like to be kept up-to-date with our latest activities? Follow us now!
                                </p>
                                <div class="user-friends">
                                    @foreach ($company->followers as $follower)
                                        <a href="#"><img alt="image" class="img-circle" src="{{ $follower->photoUrl }}"></a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <projects-feed :user="user" :company="{{ $company->id }}"></projects-feed>
                        {{--<div class="social-feed-box">--}}
                            {{--<div class="pull-right social-action dropdown">--}}
                                {{--<button data-toggle="dropdown" class="dropdown-toggle btn-white">--}}
                                    {{--<i class="fa fa-angle-down"></i>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu m-t-xs">--}}
                                    {{--<li><a href="#">Config</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="social-avatar">--}}
                                {{--<a href="" class="pull-left">--}}
                                    {{--<img alt="image" src="img/a1.jpg">--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<a href="#">--}}
                                        {{--Andrew Williams--}}
                                    {{--</a>--}}
                                    {{--<small class="text-muted">Today 4:21 pm - 12.06.2014</small>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="social-body">--}}
                                {{--<p>--}}
                                    {{--Many desktop publishing packages and web page editors now use Lorem Ipsum as their--}}
                                    {{--default model text, and a search for 'lorem ipsum' will uncover many web sites still--}}
                                    {{--in their infancy. Packages and web page editors now use Lorem Ipsum as their--}}
                                    {{--default model text.--}}
                                {{--</p>--}}

                                {{--<div class="btn-group">--}}
                                    {{--<button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>--}}
                                    {{--<button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>--}}
                                    {{--<button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="social-footer">--}}
                                {{--<div class="social-comment">--}}
                                    {{--<a href="" class="pull-left">--}}
                                        {{--<img alt="image" src="img/a1.jpg">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--Andrew Williams--}}
                                        {{--</a>--}}
                                        {{--Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.--}}
                                        {{--<br/>--}}
                                        {{--<a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> ---}}
                                        {{--<small class="text-muted">12.06.2014</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="social-comment">--}}
                                    {{--<a href="" class="pull-left">--}}
                                        {{--<img alt="image" src="img/a2.jpg">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--Andrew Williams--}}
                                        {{--</a>--}}
                                        {{--Making this the first true generator on the Internet. It uses a dictionary of.--}}
                                        {{--<br/>--}}
                                        {{--<a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> ---}}
                                        {{--<small class="text-muted">10.07.2014</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="social-comment">--}}
                                    {{--<a href="" class="pull-left">--}}
                                        {{--<img alt="image" src="img/a3.jpg">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<textarea class="form-control" placeholder="Write comment..."></textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="social-feed-box">--}}
                            {{--<div class="pull-right social-action dropdown">--}}
                                {{--<button data-toggle="dropdown" class="dropdown-toggle btn-white">--}}
                                    {{--<i class="fa fa-angle-down"></i>--}}
                                {{--</button>--}}
                                {{--<ul class="dropdown-menu m-t-xs">--}}
                                    {{--<li><a href="#">Config</a></li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="social-avatar">--}}
                                {{--<a href="" class="pull-left">--}}
                                    {{--<img alt="image" src="img/a6.jpg">--}}
                                {{--</a>--}}
                                {{--<div class="media-body">--}}
                                    {{--<a href="#">--}}
                                        {{--Andrew Williams--}}
                                    {{--</a>--}}
                                    {{--<small class="text-muted">Today 4:21 pm - 12.06.2014</small>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="social-body">--}}
                                {{--<p>--}}
                                    {{--Many desktop publishing packages and web page editors now use Lorem Ipsum as their--}}
                                    {{--default model text, and a search for 'lorem ipsum' will uncover many web sites still--}}
                                    {{--in their infancy. Packages and web page editors now use Lorem Ipsum as their--}}
                                    {{--default model text.--}}
                                {{--</p>--}}
                                {{--<p>--}}
                                    {{--Lorem Ipsum as their--}}
                                    {{--default model text, and a search for 'lorem ipsum' will uncover many web sites still--}}
                                    {{--in their infancy. Packages and web page editors now use Lorem Ipsum as their--}}
                                    {{--default model text.--}}
                                {{--</p>--}}
                                {{--<img src="img/gallery/3.jpg" class="img-responsive">--}}
                                {{--<div class="btn-group">--}}
                                    {{--<button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>--}}
                                    {{--<button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>--}}
                                    {{--<button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="social-footer">--}}
                                {{--<div class="social-comment">--}}
                                    {{--<a href="" class="pull-left">--}}
                                        {{--<img alt="image" src="img/a1.jpg">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--Andrew Williams--}}
                                        {{--</a>--}}
                                        {{--Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.--}}
                                        {{--<br/>--}}
                                        {{--<a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> ---}}
                                        {{--<small class="text-muted">12.06.2014</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="social-comment">--}}
                                    {{--<a href="" class="pull-left">--}}
                                        {{--<img alt="image" src="img/a2.jpg">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--Andrew Williams--}}
                                        {{--</a>--}}
                                        {{--Making this the first true generator on the Internet. It uses a dictionary of.--}}
                                        {{--<br/>--}}
                                        {{--<a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> ---}}
                                        {{--<small class="text-muted">10.07.2014</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="social-comment">--}}
                                    {{--<a href="" class="pull-left">--}}
                                        {{--<img alt="image" src="img/a8.jpg">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<a href="#">--}}
                                            {{--Andrew Williams--}}
                                        {{--</a>--}}
                                        {{--Making this the first true generator on the Internet. It uses a dictionary of.--}}
                                        {{--<br/>--}}
                                        {{--<a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> ---}}
                                        {{--<small class="text-muted">10.07.2014</small>--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                                {{--<div class="social-comment">--}}
                                    {{--<a href="" class="pull-left">--}}
                                        {{--<img alt="image" src="img/a3.jpg">--}}
                                    {{--</a>--}}
                                    {{--<div class="media-body">--}}
                                        {{--<textarea class="form-control" placeholder="Write comment..."></textarea>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    </div>
                    <div class="col-lg-4 m-b-lg">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Activities</h5>
                            </div>
                            <div class="ibox-content">
                                <activity-feed :user="user" :user-id="{{ $company->id }}"></activity-feed>
                            </div>
                        </div>

                        {{--<div id="vertical-timeline" class="vertical-container light-timeline no-margins">--}}
                            {{--<div class="vertical-timeline-block">--}}
                                {{--<div class="vertical-timeline-icon navy-bg">--}}
                                    {{--<i class="fa fa-briefcase"></i>--}}
                                {{--</div>--}}

                                {{--<div class="vertical-timeline-content">--}}
                                    {{--<h2>Meeting</h2>--}}
                                    {{--<p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.--}}
                                    {{--</p>--}}
                                    {{--<a href="#" class="btn btn-sm btn-primary"> More info</a>--}}
                                    {{--<span class="vertical-date">--}}
                                        {{--Today <br>--}}
                                        {{--<small>Dec 24</small>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="vertical-timeline-block">--}}
                                {{--<div class="vertical-timeline-icon blue-bg">--}}
                                    {{--<i class="fa fa-file-text"></i>--}}
                                {{--</div>--}}

                                {{--<div class="vertical-timeline-content">--}}
                                    {{--<h2>Send documents to Mike</h2>--}}
                                    {{--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>--}}
                                    {{--<a href="#" class="btn btn-sm btn-success"> Download document </a>--}}
                                    {{--<span class="vertical-date">--}}
                                        {{--Today <br>--}}
                                        {{--<small>Dec 24</small>--}}
                                    {{--</span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="vertical-timeline-block">--}}
                                {{--<div class="vertical-timeline-icon lazur-bg">--}}
                                    {{--<i class="fa fa-coffee"></i>--}}
                                {{--</div>--}}

                                {{--<div class="vertical-timeline-content">--}}
                                    {{--<h2>Coffee Break</h2>--}}
                                    {{--<p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>--}}
                                    {{--<a href="#" class="btn btn-sm btn-info">Read more</a>--}}
                                    {{--<span class="vertical-date"> Yesterday <br><small>Dec 23</small></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="vertical-timeline-block">--}}
                                {{--<div class="vertical-timeline-icon yellow-bg">--}}
                                    {{--<i class="fa fa-phone"></i>--}}
                                {{--</div>--}}

                                {{--<div class="vertical-timeline-content">--}}
                                    {{--<h2>Phone with Jeronimo</h2>--}}
                                    {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>--}}
                                    {{--<span class="vertical-date">Yesterday <br><small>Dec 23</small></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="vertical-timeline-block">--}}
                                {{--<div class="vertical-timeline-icon navy-bg">--}}
                                    {{--<i class="fa fa-comments"></i>--}}
                                {{--</div>--}}

                                {{--<div class="vertical-timeline-content">--}}
                                    {{--<h2>Chat with Monica and Sandra</h2>--}}
                                    {{--<p>Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>--}}
                                    {{--<span class="vertical-date">Yesterday <br><small>Dec 23</small></span>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

            </div>
        </div>
    </div>

@endsection