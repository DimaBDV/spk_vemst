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
                                            <img class="flex" src="{{ asset('img/logo.png') }}" alt=""
                                                 style="width: 100px;
                                            background-color: #293e59;
                                            border-radius: .3rem;
                                            padding: 0.2rem;">
                                        </div>
                                    </div>

                                    <div class="col flex-center">
                                        <p class="h3 mt-2 mb-0 text-center">
                                            Регистрация
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <hr/>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Имя --}}
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Имя') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Отчетсво --}}
                            <div class="form-group row">
                                <label for="fathers_name"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Отчество') }}</label>

                                <div class="col-md-6">
                                    <input id="fathers_name" type="text"
                                           class="form-control @error('fathers_name') is-invalid
                                           @enderror" name="fathers_name"
                                           value="{{ old('fathers_name') }}" required autocomplete="fathers_name">

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Подразделение --}}
                            <div class="form-group row">
                                <label for="unit"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Подразделение') }}</label>

                                <div class="col-md-6">
                                    <input id="unit" type="text"
                                           class="form-control @error('unit') is-invalid
                                           @enderror" name="unit"
                                           value="{{ old('unit') }}" required autocomplete="unit"
                                           placeholder="Преподаватель" aria-describedby="unitHelp">
                                    <small id="unitHelp" class="form-text text-muted">Например: Преподаватель,
                                        Бухгалтерия, Администрация, ...
                                    </small>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- E-mail --}}
                            <div class="form-group row">
                                <label for="email"
                                       class="col-md-4 col-form-label text-md-right">{{ __('E-Mail адрес') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email"
                                           placeholder="...@vemst.ru" aria-describedby="emailHelp">
                                    <small id="emailHelp" class="form-text text-muted">После регистрации на этот ящик
                                        придёт уведомление с просьбой подтвердить регистрацию
                                    </small>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Пароль --}}
                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password" aria-describedby="passwordHelp">
                                    <small id="passwordHelp" class="form-text text-muted">Минимум 8 символов</small>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Пароль2 --}}
                            <div class="form-group row">
                                <label for="password-confirm"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Повторите пароль') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required autocomplete="new-password"
                                           aria-describedby="password2Help">
                                    <small id="password2Help" class="form-text text-muted">Повторите Ваш пароль</small>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> {{ __('Регистрация') }}
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
