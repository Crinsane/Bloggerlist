@extends('spark::layouts.dashboard')

@section('title', 'All our companies')

@section('body')
    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInRight">

                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 project-pagination">
                        {{ $companies->links() }}
                    </div>
                </div>

                <div class="row">

                    @foreach ($companies as $key => $company)

                        <div class="col-lg-4">
                            <div class="contact-box">
                                <a href="{{ route('companies.show', $company) }}">
                                    <div class="col-sm-4">
                                        <div class="text-center">
                                            <img alt="image" class="img-circle m-t-xs img-responsive" src="{{ $company->photoUrl }}">
                                            @if ($company->branch)
                                                <span class="label {{ $company->branch->slug }}">
                                                    {{ $company->branch->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <h3><strong>{{ $company->title }}</strong></h3>
                                        <p><i class="fa fa-map-marker"></i> {{ $company->address }} {{ $company->city }}, {{ $company->country }}</p>
                                        <address>
                                            <strong>Number of projects: </strong> {{ $company->projects->count() }}<br>
                                            {{ str_limit($company->description, 80) }}
                                        </address>
                                    </div>
                                    <div class="clearfix"></div>
                                </a>
                            </div>
                        </div>

                        @if (($key + 1) % 3 == 0)
                            </div><div class="row">
                        @endif

                    @endforeach

                </div>

                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-4 project-pagination">
                        {{ $companies->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection