@php
    $news = 'Новости';
    $docs = 'Документы';
    $schedule = 'Расписание';
    $any = 'Другое';
@endphp

@if( $item->section == $news )
    {{-- Открытие карточки для типа Новости --}}
    <div class="card text-white my-1 shadow-sm bg-primary">
        {{-- тело карточки --}}
        <div class="card-body">
            <h5 class="text-left card-title">{{ $item->section }}</h5>
            <div class="row">
                <div class="col">
                    <h6 class="card-title">Тема - {{ $item->theme }}</h6>
                </div>

                <div class="col">
                    @include('admin.components.body')
                </div>


@endif

@if( $item->section == $docs )
    {{-- Открытие карточки для типа Документы --}}
    <div class="card text-white my-1 shadow-sm bg-info">
        {{-- тело карточки --}}
        <div class="card-body">
            <h5 class="text-left card-title">{{ $item->section }}</h5>
            <div class="row">
                <div class="col">
                    <h6 class="card-title">Раздел - {{ $item->theme }}</h6>
                </div>

                <div class="col">
                    @include('admin.components.body')
                </div>

@endif

@if( $item->section == $schedule )
    {{-- Открытие карточки для типа Расписание --}}
    <div class="card text-white my-1 shadow-sm bg-success">
        {{-- тело карточки --}}
        <div class="card-body">
            <h5 class="text-left card-title">{{ $item->section }}</h5>
            <div class="row">
                <div class="col">
                    <h6 class="card-title">Отделение - {{ $item->theme }}</h6>
                </div>

                <div class="col">
                    @include('admin.components.body')
                </div>

@endif

@if( $item->section == $any )
    {{-- Открытие карточки для типа Другое --}}
    <div class="card text-white my-1 shadow-sm bg-secondary">
        {{-- тело карточки --}}
        <div class="card-body">
            <h5 class="text-left card-title">{{ $item->section }}</h5>
            <div class="row">
                <div class="col">
                    <h6 class="card-title">Тема - {{ $item->theme }}</h6>
                </div>

                <div class="col">
                    @include('admin.components.body')
                </div>

@endif
                <div class="col">
                    <p>Создатель: {{ $item->user->name . ' ' . $item->user->fathers_name  }}</p>
                </div>
            </div>
            <a class="btn btn-block btn-outline-light" href="{{route('admin.offer.show', $item->id)}}">Просмотр</a>
        </div>
    </div>