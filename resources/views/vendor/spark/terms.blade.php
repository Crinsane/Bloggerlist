@extends('spark::layouts.auth')

@section('content')
    <div class="passwordBox animated fadeInDown" style="max-width: 720px;">
        <div class="row">
            <div class="col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Terms Of Service</h5>
                    </div>

                    <div class="ibox-content terms-of-service">
                        {!! $terms !!}
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-md-6">
                The Bloggerlist
            </div>
            <div class="col-md-6 text-right">
                <small>&copy; {{ date('Y') }}</small>
            </div>
        </div>
    </div>
@endsection
