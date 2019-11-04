@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('notify.notify')
        <div class="row">

            {{-- Левая колонка, предложить новость --}}
            <div class="col-12 col-md-12 col-lg-8 py-1">
                <div class="container-fluid">
                    @include('offer.modules.new')
                </div>
            </div>

            {{-- Правая колонка, список предложенных но ещё не выполненных --}}
            <div class="col-12 col-md-12 col-lg-4 py-1">
                <div class="container-fluid">
                    @include('offer.modules.history')
                </div>
            </div>
        </div>

    </div>
@endsection
