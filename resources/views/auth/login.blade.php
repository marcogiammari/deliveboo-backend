@extends('layouts.app')

@section('content')
<div class="blur">
    <div class="container-fluid m-0 p-0 vh-100">
        <div class="row">
            <div class="col-md-5 p-0 m-0">
                <img src="https://i.postimg.cc/j597w09D/21.jpg" alt="" class="img-fluid vh-100">
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <div class="card-custom w-75">
                    <div class="card-body py-5">
                        <div class="text-center mb-4" >
                            <h1 class="text-white fw-bolder">Accedi</h1>
                        </div>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row mb-3">
                                
                                <label for="email" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4">{{ __('Email') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('email') is-invalid @enderror" name="email" value="{{ old('email') }} " required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback text-white" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end  text-white fw-bolder fs-4">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control bg-transparent-custom text-white fs-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label text-light" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-light border-0 px-3 button-login-register">
                                        <span class=" fw-bold text-white">{{ __('Login') }}</span>
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-light" href="{{ route('password.request') }}">
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
</div>
@endsection

