@extends('layouts.auth')

@section('title', 'Forgot Password')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Forgot Password</h4>
        </div>

        @if (Session::has('message'))
        <div class="alert alert-success" role="alert">
           {{ Session::get('message') }}
       </div>
   @endif

     <form action="{{ route('forget.password.post') }}" method="POST">
         @csrf

        <div class="card-body">
            <p class="text-muted">We will send a link to reset your password</p>
            <form action="{{ route('forget.password.post') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email_address">Email</label>
                    <input type="text" id="email_address" class="form-control" name="email" required autofocus>
                                  @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                  @endif
                </div>

                <div class="form-group">
                    <button type="submit"
                        class="btn btn-primary btn-lg btn-block"
                        tabindex="4">
                        Forgot Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
@endpush
