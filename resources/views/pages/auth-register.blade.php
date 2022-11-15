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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form class="user needs-validation" method="POST" action="{{route('registeruser')}}">
                @csrf
                <div class="row">
                    <div class="form-group col-6">
                        <input type="text" required class="form-control form-control-user" id="Name"
                            placeholder="Name" name="name" autofocus>
                            <div class="invalid-feedback">
                                Name Can't Be Empty.
                            </div>
                    </div>
                    <div class="form-group col-6">
                        <input type="text" required class="form-control form-control-user" id="Nim"
                            placeholder="NIM" name="nim">
                            <div class="invalid-feedback">
                                NIM Can't Be Empty.
                            </div>
                    </div>
                </div>

                <div class="form-group">
                    <input type="email" required class="form-control form-control-user" id="Email"
                        placeholder="Email Address" name="email">
                        <div class="invalid-feedback">
                            Email Can't Be Empty.
                        </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <input type="password" for="password" class="form-control form-control-user pwstrength"
                        id="Password" data-indicator="pwindicator" required placeholder="Password" name="password">
                        <div class="invalid-feedback">
                            Password Can't Be Empty.
                        </div>
                        <div id="pwindicator"
                            class="pwindicator">
                            <div class="bar"></div>
                            <div class="label"></div>
                        </div>
                    </div>
                    <div class="form-group col-6">
                        <input type="password" for="password_confirmation" class="form-control form-control-user"
                        id="password_confirmation" required placeholder="Confirm Password" name="password_confirmation">
                        <div class="invalid-feedback">
                            Please Confirm The Password.
                        </div>
                    </div>
                </div>

                {{-- Recaptcha --}}
                <div class="row">
                    {{-- <label for="captcha" class="col-md-3 col-form-label">Captcha</label> --}}
                    <div class="row ml-2 col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group col-9 captcha ">
                            <span>{!! captcha_img() !!}</span>
                        </div>
                        <div class="col-3">
                            <button type="button" class="btn btn-primary" class="reload" id="reload">
                                &#x21bb;
                            </button>
                        </div>    
                    </div>
                    <div class="form-group col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <input id="captcha" type="text" class="form-control form-control-user" required placeholder="Enter Captcha" name="captcha">
                        <div class="invalid-feedback">
                            Captcha Can't Be Empty.
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-user btn-block">
                    Register Account
                </button>
                <div class="mt-5 text-center">
                    already have an account? <a href="/auth-login2">Login</a>
                </div>
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
