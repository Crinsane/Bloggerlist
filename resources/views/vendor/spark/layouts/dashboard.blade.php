@extends('spark::layouts.app')

@section('content')

    @include('dashboard.navigation')

    <div id="page-wrapper" class="gray-bg">
        @include('dashboard.header-menu')

        @unless(Route::currentRouteName() == 'home')
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>@yield('title')</h2>
                    {!! Breadcrumbs::renderIfExists() !!}
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        @endunless

        @yield('body')
    </div>

    @include('chat.small-chat')

@endsection