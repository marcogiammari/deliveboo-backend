@extends('layouts.app')

@section('content')
<div class="">
    <div class="d-flex justify-content-center vh-100 position-relative">
        <div class="bottom-0 start-0 position-absolute">
            <img src="https://i.postimg.cc/j597w09D/21.jpg" alt="" class="d-block img-full-size img-fluid">
        </div>
        <div class="col-md-6 col-10 offset-md-4 d-flex align-items-center justify-content-center pt-5 overflow-y-auto resize">
            <div class="card-custom w-75">
                
                <div class="text-center mb-4 pb-1 pt-4" >
                    <h1 class="text-white fw-bolder">Registrati</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3 px-md-0 px-5">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4"><span class="{{ $errors->has('name') ? 'text-danger' : '' }}">Nome</span></label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 px-md-0 px-5">
                            <label for="surname" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4"><span class="{{ $errors->has('surname') ? 'text-danger' : '' }}">Cognome</span></label>
                            <div class="col-md-6">
                                <input id="surname" type="text" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 px-md-0 px-5">
                            <label for="email" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4"> <span class="{{ $errors->has('email') ? 'text-danger' : '' }}">Email</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 px-md-0 px-5">
                            <label for="password" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control bg-transparent-custom text-white fs-4 fw-bold @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"  onChange="onChange()">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 px-md-0 px-5">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end text-white fw-bolder fs-4 lh-1">Conferma Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control bg-transparent-custom text-white fs-4 fw-bold " name="password_confirmation" required autocomplete="new-password"  onChange="onChange()">
                            </div>
                        </div>

                        <div class="row px-md-0 px-5">
                            <div class="col text-center pb-5">
                                <button type="submit" class="btn btn-light border-0 px-3 button-login-register">
                                    <span class=" fw-bold fs-5 text-secondary text-white">{{ __('Registrati') }}</span>
                                </button>
                            </div>
                        </div>

                        <script>

                            function onChange() {
                                const password = document.querySelector('input[name=password]');
                                const confirm = document.querySelector('input[name=password_confirmation]');
                                if (confirm.value === password.value) {
                                    confirm.setCustomValidity('');
                                } else {
                                    confirm.setCustomValidity('Le password non coincidono');
                                }
                            }

                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
