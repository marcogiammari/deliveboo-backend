@extends('layouts.app')

@section('content')
<div class="container-fluid m-0 p-0 vh-100">
    <div class="row">
        <div class="col-5 p-0 m-0">
            <img src="https://i.postimg.cc/j597w09D/21.jpg" alt="" class="img-fluid vh-100">
        </div>
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="card-custom w-75">
                <div class="text-center fw-bolder text-white fs-2 my-4">{{ __('Recupera la tua Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-md-end text-white fw-bolder fs-4 ">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control form-control bg-transparent-custom text-white fs-4 fw-bold @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn border-0 btn-light button-login-register mb-4">
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
