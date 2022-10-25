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
            <form class="user needs-validation" method="POST" action="{{route('registeruser')}}" novalidate>
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="text" required class="form-control form-control-user" id="Name"
                            placeholder="First Name" name="name">
                            <div class="invalid-feedback">
                                Name Can't Be Empty.
                            </div>
                    </div>
                    <div class="col-sm-6">
                        <input type="text" required class="form-control form-control-user" id="Nim"
                            placeholder="NIM" name="nis">
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
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control @error('password') is-invalid @enderror form-control-user"
                        id="Password" required placeholder="Password" name="password">
                        <div class="invalid-feedback">
                            Password Can't Be Empty.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <input type="password" class="form-control @error('password') is-invalid @enderror form-control-user"
                        id="Password2" required placeholder="Confirm Password" name="password_confirmation">
                        <div class="invalid-feedback">
                            Please Confirm The Password.
                        </div>
                    </div>
                </div>

                {{-- Recaptcha --}}
                <div class="form-group row">
                    {{-- <label for="captcha" class="col-md-3 col-form-label">Captcha</label> --}}
                    <div class="col-md-3 captcha">
                        <span>{!! captcha_img() !!}</span>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" class="reload" id="reload">
                            &#x21bb;
                        </button>
                    </div>
                    <div class="col-md-6">
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
