@extends('spark::layouts.dashboard')

@section('title', 'All our bloggers')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 project-pagination">
                        {{ $bloggers->links() }}
                    </div>
                </div>

                <div class="row">

                    @foreach ($bloggers as $key => $blogger)

                        <div class="col-lg-3">
                            <div class="contact-box center-version">
                                <a href="{{ route('bloggers.show', $blogger) }}">
                                    <img alt="image" class="img-circle" src="{{ $blogger->photoUrl }}">
                                    <h3 class="m-b-xs"><strong>{{ $blogger->name }}</strong></h3>
                                    @if ($blogger->branch)
                                        <span class="label {{ $blogger->branch->slug }}">
                                            {{ $blogger->branch->name }}
                                        </span>
                                    @endif
                                    <address class="m-t-md">
                                        <strong>Twitter, Inc.</strong><br>
                                        795 Folsom Ave, Suite 600<br>
                                        San Francisco, CA 94107<br>
                                        <abbr title="Phone">P:</abbr> (123) 456-7890
                                    </address>
                                </a>
                                <div class="contact-box-footer">
                                    <div class="m-t-xs btn-group">
                                        <a href="{{ route('bloggers.show', $blogger) }}" class="btn btn-xs btn-white"><i class="fa fa-user"></i> Profile</a>
                                        <a class="btn btn-xs btn-white"><i class="fa fa-envelope"></i> Message</a>
                                        <follow :user="user" :follower="{{ $blogger->id }}" :follows="{{ auth()->user()->follows->contains($blogger) }}" button="btn btn-xs btn-white"></follow>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (($key + 1) % 4 == 0)
                            </div><div class="row">
                        @endif

                    @endforeach

                </div>

                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 project-pagination">
                        {{ $bloggers->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection