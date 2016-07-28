@extends('spark::layouts.dashboard')

@section('title', $blogger->name)

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">

                <div class="row animated fadeInRight">
                    <div class="col-md-4">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Profile Detail</h5>
                            </div>
                            <div>
                                <div class="ibox-content no-padding border-left-right">
                                    <img alt="image" class="img-responsive" src="{{ $blogger->photoUrl }}" style="margin: auto;">
                                </div>
                                <div class="ibox-content profile-content">
                                    <h4><strong>{{ $blogger->name }}</strong></h4>
                                    <p><i class="fa fa-map-marker"></i> {{ $country }}</p>
                                    <h5>About me</h5>
                                    <p>{{ $blogger->description }}</p>
                                    {{--<div class="row m-t-lg">--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<span class="bar">5,3,9,6,5,9,7,3,5,2</span>--}}
                                            {{--<h5><strong>0</strong> Completed projects</h5>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<span class="line">5,3,9,6,5,9,7,3,5,2</span>--}}
                                            {{--<h5><strong>{{ $blogger->follows()->count() }}</strong> Following</h5>--}}
                                        {{--</div>--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>--}}
                                            {{--<h5><strong>{{ $blogger->followers()->count() }}</strong> Followers</h5>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="user-button">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>
                                            </div>
                                            <div class="col-md-6">
                                                <follow :user="user" :follower="{{ $blogger->id }}" :follows="{{ $blogger->followers->contains(auth()->user()) }}" button="btn btn-default btn-sm btn-block"></follow>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Activities</h5>
                            </div>
                            <div class="ibox-content">
                                <activity-feed :user="user" :user-id="{{ $blogger->id }}"></activity-feed>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection