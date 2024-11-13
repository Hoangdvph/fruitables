@extends('auth.layouts.master')

@section('content')

    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image d-flex justify-content-center align-items-center">
                @if ($errors->any())
                    <div class="alert alert-primary " role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form method="POST" action="{{ route('register') }}" class="user">

                        @csrf

                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Name " name="name">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                placeholder="Email Address" name="email">
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="exampleInputPassword"
                                    placeholder="Password" name="password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="exampleRepeatPassword"
                                    placeholder="Repeat Password" name="password_confirmation">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-user btn-block">Register Account </button>

                        <hr>

                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="login.html">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
