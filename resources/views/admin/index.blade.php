@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('notify.notify')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center">Все предложения</h4>
                        <hr/>

                        @if( isset($offer) )
                            @foreach($offer as $item)
                                @include('admin.components.card')
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
