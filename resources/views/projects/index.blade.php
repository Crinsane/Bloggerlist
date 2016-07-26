@extends('spark::layouts.dashboard')

@section('title', 'All available projects')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">

                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 project-pagination">
                        {{ $projects->links() }}
                    </div>
                </div>

                <div class="row">

                    <?php $i = 1;?>

                    @foreach($projects as $project)

                        <div class="col-lg-4">
                            <div class="ibox">
                                <div class="ibox-title">
                                    @if($project->created_at->diffInDays(\Carbon\Carbon::now()) <= 7)
                                        <span class="label label-primary pull-right">NEW</span>
                                    @endif
                                    <h5>
                                        <span class="label {{ $project->category->slug }}" style="margin-right: 8px;">{{ $project->category->name }}</span>
                                        <a href="{{ route('projects.show', $project) }}" style="color: #676a6c;">{{ $project->title }}</a>
                                    </h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="team-members" style="height: 82px;">
                                        @foreach($project->getMedia('images')->take(6) as $image)
                                            <a href="{{ $image->getUrl() }}"><img alt="member" class="img-circle" src="{{ $image->getUrl('thumbnail') }}"></a>
                                        @endforeach
                                    </div>
                                    <h4>Project description:</h4>
                                    <p>{{ $project->description }}</p>
                                    <h4>Project reward:</h4>
                                    <p>{{ $project->reward }}</p>
                                    <hr>
                                    <div class="row m-t-sm">
                                        <div class="col-sm-6">
                                            <div class="font-bold">COMPANY</div>
                                            {{ $project->user->title }}
                                        </div>
                                        <div class="col-sm-3 text-right">
                                            <div class="font-bold">LOCATION</div>
                                            {{ $project->location }}
                                        </div>
                                        <div class="col-sm-3">
                                            <button class="btn btn-sm btn-primary pull-right m-t-sm"><i class="fa fa-btn fa-check"></i>Subscribe!</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($i++ % 3 == 0 && $i < 9)
                            </div><div class="row">
                        @endif
                    @endforeach

                </div>

                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 project-pagination">
                        {{ $projects->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection