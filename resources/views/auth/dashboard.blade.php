@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
            <div class="col-md-10">
            @if ($message = Session::get('errors'))
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif
            <div id="app">
            </div>
        </div>

@endsection
