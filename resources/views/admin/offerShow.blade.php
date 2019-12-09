@extends('layouts.app')

@section('content')
    @php
        $news = 'Новости';
        $docs = 'Документы';
        $schedule = 'Расписание';
        $any = 'Другое';
    @endphp

    <div class="container-fluid">
        @include('notify.notify')

        <div class="row justify-content-center">

            @if($offer->deleted_at != null)
                <div class="col-md-8 mb-2">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="text-center text-muted">Это архивное предложение</h5>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">

                        @if( isset($offer) )
                        <h4 class="text-center"> Раздел: {{ $offer->section }}</h4>
                        <hr/>

                        @if($offer->section == $news)
                            @include('admin.offerSection.news')
                        @endif

                        @if($offer->section == $docs)
                            @include('admin.offerSection.docs')
                        @endif

                        @if($offer->section == $schedule)
                            @include('admin.offerSection.schedule')
                        @endif

                        @if($offer->section == $any)
                            @include('admin.offerSection.any')
                        @endif


                            @if($offer->description != null)
                                <div class="row">
                                    <div class="col-7 col-md-3">
                                        <p>
                                            <i class="fas fa-book-reader"></i> Примечание:
                                        </p>
                                    </div>
                                    <div class="col-6 col-md-9">
                                        <p>
                                            {{ $offer->description }}
                                        </p>
                                    </div>
                                </div>
                            @endif

                        @include('admin.offerSection.file')

                        @endif
                    </div>
                </div>
            </div>


            @if($offer->deleted_at == null)
            <div class="col-md-8 mt-2">
                <div class="card">

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.offer.complete', $offer->id ?? null) }}">
                            @method('PUT')
                            @csrf
                            <button type="submit" class="btn btn-outline-success btn-block"> Выполнено </button>
                        </form>

                        <hr/>

                        <form method="POST" action="{{ route('admin.offer.delete', $offer->id ?? null) }}">
                            @method('DELETE')
                            @csrf

                            <div class="form-group">
                                <label for="description">Причина отказа</label>
                                <input required name="description" type="text" class="form-control" id="description" aria-describedby="descriptionHelp" placeholder="Почему отказ">
                                <small id="descriptionHelp" class="form-text text-muted">Укажите причину отказа. Она будет отправлена создателю предложения.</small>
                            </div>

                            <button type="submit" class="btn btn-outline-danger btn-block"> Отказ + архив </button>
                        </form>

                    </div>


                </div>
            </div>
            @endif

        </div>

    </div>
@endsection