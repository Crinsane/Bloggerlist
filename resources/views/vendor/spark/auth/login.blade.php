@extends('spark::layouts.auth')

@section('content')

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name">IN+</h1>
            </div>
            <h3>Welcome to IN+</h3>
            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.</p>
            <p>Login in. To see it in action.</p>
            <form class="m-t" role="form" action="/login" method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="E-Mail Address" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="{{ route('password.reset') }}"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create an account</a>
            </form>
            <p class="m-t"> <small>The Bloggerlist &copy; {{ date('Y') }}</small> </p>
        </div>
    </div>

@endsection