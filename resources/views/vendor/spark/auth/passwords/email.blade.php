@extends('spark::layouts.auth')

@section('content')

    <div class="passwordBox animated fadeInDown">
        <div class="row">

            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="ibox-content">
                    <h2 class="font-bold">Forgot password</h2>
                    <p style="font-weight: normal;">Enter your email address and your password will be reset and emailed to you.</p>

                    <div class="row">
                        <div class="col-lg-12">
                            <form class="m-t" role="form" method="POST" action="{{ url('/password/email') }}">
                                {!! csrf_field() !!}

                                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <input type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary block full-width m-b">
                                    <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                                </button>
                            </form>
                        </div>
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