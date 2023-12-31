@extends('layouts.app')

@section('content')
<div class="">
    <div class="d-flex justify-content-center vh-100 position-relative">
        <div class="bottom-0 start-0 position-absolute">
            <img src="https://i.postimg.cc/j597w09D/21.jpg" alt="" class="d-block img-full-size img-fluid">
        </div>
        <div class="col-md-6 col-10 offset-md-4 d-flex align-items-center justify-content-center pt-5">
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

                        <div class="row mb-3 px-md-0 px-5">
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

                        <div class="row mb-0 px-md-0 px-5">
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
