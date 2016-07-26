@extends('spark::layouts.dashboard')

@section('title', $project->title)

@section('body')
    <div class="row">
        <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    {{--<a href="#" class="btn btn-white btn-xs pull-right">Edit project</a>--}}
                                    <h2>{{ $project->title }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <dl class="dl-horizontal">
                                    <dt>Created At:</dt> <dd>{{ $project->created_at->format('D, M j, Y h:i') }}</dd>
                                    <dt>Last updated:</dt> <dd>{{ $project->updated_at->format('D, M j, Y h:i') }}</dd>
                                    <dt>Number of steps:</dt> <dd>{{ $project->steps->count() }}</dd>
                                </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                                <dl class="dl-horizontal" >
                                    <dt>Branch</dt> <dd><span class="label {{ $project->category->slug }}">{{ $project->category->name }}</span></dd>
                                    <dt>Location</dt> <dd>{{ $project->location }}</dd>
                                    {{--<dt>Participants:</dt>--}}
                                    {{--<dd class="project-people">--}}
                                        {{--<a href=""><img alt="image" class="img-circle" src="img/a3.jpg"></a>--}}
                                        {{--<a href=""><img alt="image" class="img-circle" src="img/a1.jpg"></a>--}}
                                        {{--<a href=""><img alt="image" class="img-circle" src="img/a2.jpg"></a>--}}
                                        {{--<a href=""><img alt="image" class="img-circle" src="img/a4.jpg"></a>--}}
                                        {{--<a href=""><img alt="image" class="img-circle" src="img/a5.jpg"></a>--}}
                                    {{--</dd>--}}
                                </dl>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <project-subscribe :user="user" :project="{{ $project->id }}" v-if="!subscribedToProject({{ $project->id }})"></project-subscribe>
                                <project-unsubscribe :user="user" :project="{{ $project->id }}" v-if="subscribedToProject({{ $project->id }})"></project-unsubscribe>
                            </div>
                            <div class="col-lg-6">
                                <favorite :user="user" :project="{{ $project->id }}" :favorited="0"></favorite>
                            </div>
                        </div>
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <div class="panel blank-panel">
                                    <div class="panel-heading">
                                        <div class="panel-options">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#description" data-toggle="tab">Description</a></li>
                                                <li><a href="#steps" data-toggle="tab">Steps</a></li>
                                                <li><a href="#gallery" data-toggle="tab">Gallery</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="description">
                                                <h4>Project description:</h4>
                                                <p>{{ $project->description }}</p>
                                                <hr>
                                                <h4>Project reward:</h4>
                                                <p>{{ $project->reward }}</p>
                                            </div>
                                            <div class="tab-pane" id="steps">
                                                <h4>These are the steps we'd like you to complete for us during this project.</h4>
                                                <div class="feed-activity-list">
                                                    @foreach($project->steps()->orderBy('order', 'asc')->get() as $step)
                                                        <div class="feed-element">
                                                            <div class="media-body">
                                                                <strong>Step {{ $step->order }}:</strong>&nbsp;{{ $step->title }}<br>
                                                                <div class="well">{{ $step->description }}</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="gallery">
                                                <?php $images = $project->getMedia('images');?>

                                                <div class="carousel slide" id="project-carousel">
                                                    <ol class="carousel-indicators">
                                                        @foreach($images as $key => $image)
                                                            <li data-slide-to="{{ $key }}" data-target="#project-carousel" {!! $key == 0 ? 'class="active"' : '' !!}></li>
                                                        @endforeach
                                                    </ol>
                                                    <div class="carousel-inner">
                                                        @foreach($images as $key => $image)
                                                            <div class="item {{ $key == 0 ? 'active' : '' }}">
                                                                <img alt="image" class="img-responsive" src="{{ $image->getUrl('big') }}">
                                                                {{--<div class="carousel-caption">--}}
                                                                    {{--<p>This is simple caption {{ $key }}</p>--}}
                                                                {{--</div>--}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <a data-slide="prev" href="#project-carousel" class="left carousel-control">
                                                        <span class="icon-prev"></span>
                                                    </a>
                                                    <a data-slide="next" href="#project-carousel" class="right carousel-control">
                                                        <span class="icon-next"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="wrapper wrapper-content project-manager">
                <h4>{{ $project->user->title }}</h4>
                <img src="{{ $project->user->photoUrl }}" class="img-responsive">
                <p class="small">
                    {{ $project->user->description }}
                </p>
                {{--<ul class="tag-list" style="padding: 0">--}}
                    {{--<li><a href=""><i class="fa fa-tag"></i> Zender</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-tag"></i> Lorem ipsum</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-tag"></i> Passages</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-tag"></i> Variations</a></li>--}}
                {{--</ul>--}}
                {{--<h5>Project files</h5>--}}
                {{--<ul class="list-unstyled project-files">--}}
                    {{--<li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>--}}
                    {{--<li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>--}}
                {{--</ul>--}}
                {{--<div class="text-center m-t-md">--}}
                    {{--<a href="#" class="btn btn-xs btn-primary">Add files</a>--}}
                    {{--<a href="#" class="btn btn-xs btn-primary">Report contact</a>--}}
                {{--</div>--}}
            </div>
        </div>
    </div>

@endsection