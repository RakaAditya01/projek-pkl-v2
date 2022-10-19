@extends('layouts.auth')

@section('title', 'Register')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="card card-primary">
        <div class="card-header">
            <h4>Register</h4>
        </div>

        <div class="card-body">
            <form class="user" method="POST" action="{{route('registeruser')}}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                            placeholder="First Name" name="name">
                    </div>
                    <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="exampleLastNim"
                            placeholder="NIM" name="nis">
                    </div>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                        placeholder="Email Address" name="email">
                </div>
                <div class="form-group">
                     <input type="password" class="form-control form-control-user"
                        id="exampleInputPassword" placeholder="Password" name="password">
                </div>

                {{-- Recaptcha --}}
                <div class="form-group row">
                    {{-- <label for="captcha" class="col-md-3 col-form-label">Captcha</label> --}}
                    <div class="col-md-6 captcha">
                        <span>{!! captcha_img() !!}</span>
                        <button type="button" class="btn btn-primary" class="reload" id="reload">
                        &#x21bb;
                        </button>
                    </div>
                    <div class="col-md-6">
                        <input id="captcha" type="text" class="form-control form-control-user" placeholder="Enter Captcha" name="captcha">
                    </div>
                </div>
                    
                <button class="btn btn-primary btn-user btn-block">
                    Register Account
                </button>
                {{-- <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Register with Google
                </a>
                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                </a> --}}
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/auth-register.js') }}"></script>

    
@endpush
