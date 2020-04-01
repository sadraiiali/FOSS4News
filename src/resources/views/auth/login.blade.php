@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">ورود به سایت</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __('general.Email') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" dir="auto"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    {{ __('general.Password') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password" dir="auto"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-10">
                                <div class="row justify-content-end">
                                    <div class="form-group mb-0 col-md-3">
                                        <button type="submit" class="btn btn-primary" style="margin-left: 30px">
                                            ورود
                                        </button>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <div class="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                       id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label mr-4" for="remember">
                                                    مرا به خاطر داشته باش!
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @if (Route::has('password.request'))
                                                <a class="btn btn-link pr-0" href="{{ route('password.request') }}">
                                                    کلمه‌ی عبور خود را فراموش کرده‌اید؟
                                                </a>
                                            @endif
                                        </div>

                                    </div>


                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
