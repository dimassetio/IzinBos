@extends('layouts.app')

@section('content')
<!-- <div class="limiter">
<div class="container-login-100">
    <div class="row justify-content-center">
        <div class="col-sm-2">
            .
            <h1>EIS</h1>
        </div>
        <div class="col-md">
            <div class="card rounded-5">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div> -->
<div class="container-login100">
    <div class="row p-1 mw-75">
        <div class="col-sm-5 align-middle m-auto">
            <h1>EIS</h1>
            <h4>Employee Information System</h4>
        </div>
        <div class="col shadow-lg p-3 rounded-lg">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email </label>
                    <div class="col-sm">
                        {!! Form::email('email', null, array('placeholder' => 'Email ','class' => 'form-control', 'id' => 'InputEmail')) !!}
                    </div>
                    <div class="col-sm">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>       
                <div class="form-group">
                    <label for="InputPassword" class="col-sm-2 control-label">Password </label>
                    <div class="col-sm">
                        {!! Form::Password('password', array('placeholder' => 'Password','class' => 'form-control', 'id' => 'InputPassword')) !!}
                    </div>
                    <div class="col-sm">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>       

                <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary rounded-pill mx-auto px-4">
                            {{ __('Login') }}
                        </button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('css')
    <link rel="stylesheet" href="/css/mainlogin.css">
@stop
@endsection 