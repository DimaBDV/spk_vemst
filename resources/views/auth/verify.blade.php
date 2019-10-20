@extends('layouts.app')

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
                                            Подтверждение личности
                                        </p>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <hr/>
                        @if (session('resent'))
                            <div class="alert alert-success text-center" role="alert">
                                <i class="far fa-envelope"></i> {{ __('Ссылка для подтверждения отправлена на Ваш ящик.') }}
                            </div>
                        @endif

                        {{ __('Прежде чем начать пользоваться сервисом Вы должны подтвердить что Вы являетесь сотрудником ВЭМТ.') }}
                        <hr>
                        {{ __('Если в течение 5 минут Вам не пришло сообщение попробуйте отправить его снова') }}
                        <i class="far fa-hand-point-down"></i>
                        <form class="" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit"
                                    class="btn btn-block btn-outline-primary">
                                <i class="fas fa-sync"></i>
                                {{ __('Отправить снова') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
