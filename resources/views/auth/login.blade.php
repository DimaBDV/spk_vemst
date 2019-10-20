@extends('layouts.start')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="content">

                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col  flex-center">
                                        <div class="px-1 py-1 text-center">
                                            <img class="flex" src="{{ asset('storage/img/logo.png') }}" alt=""
                                                 style="width: 100px;
                                            background-color: #293e59;
                                            border-radius: .3rem;
                                            padding: 0.2rem;">
                                        </div>
                                    </div>

                                    <div class="col flex-center">
                                        <p class="h3 mt-2 mb-0 text-center">
                                            Авторизация
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <hr/>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email"
                                           placeholder="...@vemst.ru" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password"
                                           placeholder="Ваш пароль">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" name="remember"
                                               id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="custom-control-label" for="remember">
                                            {{ __('Запомнить меня') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-child"></i> {{ __('Вход') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Забыли пароль?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <hr/>
                        <div class="container-fluid">
                            <h3 class="text-center">Впервые здесь?</h3>
                            <a href="{{route('register')}}" class="btn btn-outline-primary btn-block">
                                <i class="fas fa-plus"></i> Регистрация </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
