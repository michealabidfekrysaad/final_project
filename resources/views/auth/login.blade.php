@extends('layouts.app')

@section('content')
<div class="main">
    <section class="sign-in">
        <div class="container">
            <div class="signin-content">
                <!-- <div class="signin-image">
                        
                        <a href="#" class="signup-image-link">Create an account</a>
                    </div> -->

                <div class="signin-form">
                    <h2 class="form-title">{{ __('messages.Login') }}</h2>
                    <form method="POST" class="register-form" id="login-form" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('messages.Your Email') }}">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror</div>
                        <div class="form-group">
                            <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('messages.Password') }}">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror</div>
                        <div class="form-group">
                            <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>{{ __('messages.Remember me') }}</label>
                        </div>
                        <div class="form-group form-button">
                            <button type="submit" class="btn btn-primary">
                                {{ __('messages.Login') }} 
                            </button>

                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('messages.Forgot Your Password?') }}  
                            </a>
                            @endif
                        </div>
                    </form>
                    <div class="social-login">
                        <span class="social-label">{{ __('messages.Or login with') }}</span>
                        <ul class="socials">
                            <li><a href="{{ url('auth/redirect/facebook') }}"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                            <li><a href="{{ url('auth/redirect/google') }}"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection