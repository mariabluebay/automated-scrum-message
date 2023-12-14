@extends('auth.layouts')

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <div class="">
                        <form action="{{ route('notify') }}" method="post">
                            @csrf
                            <div class="mb-3 row">
                                <label for="text" class="col-md-4 col-form-label text-md-end text-start">Text</label>
                                <div class="col-md-6">
                                    <textarea class="form-control" id="text" name="text" value="{{ old('text') }}"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Send">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
