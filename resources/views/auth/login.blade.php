@extends('layouts.guest')

@section('title') Login @endsection

@section('body')

<body>
    @endsection

    @section('content')
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <img src="{{ asset('images/patikab-logo.png') }}" class="mx-auto d-block mb-4" style="width: 72px;">
                    <div class="text-center mb-4">
                        <h4>Sistem Pendaftaran Vaksinasi <strong>COVID-19</strong></h4>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="username" class="form-label">Email</label>
                                    <input name="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" id="username" placeholder="Enter Email"
                                        autocomplete="email" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div
                                        class="input-group auth-pass-inputgroup @error('password') is-invalid @enderror">
                                        <input type="password" name="password"
                                            class="form-control  @error('password') is-invalid @enderror"
                                            id="userpassword" placeholder="Enter password" aria-label="Password"
                                            aria-describedby="password-addon">
                                        <button class="btn btn-light " type="button" id="password-addon"><i
                                                class="mdi mdi-eye-outline"></i></button>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" {{ old('remember')
                                        ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        Remember me
                                    </label>
                                </div>

                                <div class="mt-3 d-grid">
                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log
                                        In</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <div>
                            <p>© <script>
                                    document.write(new Date().getFullYear())
                                </script> {{ config('app.name', 'Laravel') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
