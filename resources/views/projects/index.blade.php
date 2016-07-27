@extends('spark::layouts.dashboard')

@section('title', 'All available projects')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content">

                <div class="row">
                    <div class="col-md-8">
                        @if (isset($category))
                            <div style="margin-bottom: 22px;">
                                <label>Filter by: </label>
                                <span class="project-category-filter">{{ $category->name }} <a href="{{ route('projects.index') }}"><i class="fa fa-times"></i></a></span>
                            </div>
                        @endif
                    </div>
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
                                        <a href="{{ route('projects.index', ['category' => $project->category->slug]) }}" class="label {{ $project->category->slug }}" style="margin-right: 8px;">{{ $project->category->name }}</a>
                                        <a href="{{ route('projects.show', $project) }}" style="color: #676a6c;">{{ $project->title }}</a>
                                    </h5>
                                </div>
                                <div class="ibox-content">
                                    <div class="team-members" style="height: 82px; overflow: hidden;">
                                        @forelse($project->getMedia('images')->take(6) as $image)
                                            <a href="{{ route('projects.show', $project) }}"><img alt="member" class="img-circle" src="{{ $image->getUrl('thumbnail') }}"></a>
                                        @empty
                                            <a href="{{ route('projects.show', $project) }}" style="display: block; width: 100%; height: 82px; background: url({{ $project->user->photoUrl }}) no-repeat center center; background-size: cover;"></a>
                                        @endforelse
                                    </div>
                                    <h4>Project description:</h4>
                                    <p>{{ str_limit($project->description, 150) }} <a href="{{ route('projects.show', $project) }}">more</a></p>
                                    <h4>Project reward:</h4>
                                    <p>{{ str_limit($project->reward, 90) }}</p>
                                    <hr>
                                    <div class="row m-t-sm">
                                        <div class="col-sm-8">
                                            <div class="font-bold">COMPANY</div>
                                            {{ $project->user->title }}
                                        </div>
                                        <div class="col-sm-4">
                                            <button class="btn btn-sm btn-primary pull-right m-t-sm"><i class="fa fa-btn fa-share"></i>View details</button>
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