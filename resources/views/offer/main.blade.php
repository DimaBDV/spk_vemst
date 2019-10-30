@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @include('notify.notify')

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
