@extends('layouts.app')

@section('content')
<div class="container-fluid m-0 p-0 vh-100">
    <div class="row">
        <div class="col-5 p-0 m-0">
            <img src="https://i.postimg.cc/j597w09D/21.jpg" alt="" class="img-fluid vh-100">
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="card-custom w-75">
                
                <div class="text-center mb-4 pb-1 pt-4" >
                    <h1 class="text-white fw-bolder">Registrati</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4 lh-1">Conferma Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control bg-transparent-custom text-white fs-4 fw-bold " name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center pb-5">
                                <button type="submit" class="btn btn-light border-0 px-3 button-login-register">
                                    <span class=" fw-bold fs-5 text-secondary text-white">{{ __('Registrati') }}</span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
