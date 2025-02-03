@extends('layouts.layout')
@section('title', 'Login')
@section('content')
<main id="main">
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <img style="width: 110px; margin: 64px 0 24px 0;" src="assets/img/seculify/logo.png" alt="">
                <h2>LOGIN</h2>
                <p>Masuk untuk menggunakan fitur {{ config('app.name') }}.</p>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 mt-5 mt-lg-0 align-items-stretch">
                    @if (Session::get('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @elseif (Session::get('warning'))
                    <div class="alert alert-warning">
                        {{ Session::get('warning') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" role="form" class="php-email-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" name="email" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="name">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('register') }}">Belum punya akun? Daftar</a>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit">Login</button>
                        </div>
                        <p class="text-center mt-4 mb-3">Atau login dengan</p>
                        <div class="text-center d-flex justify-content-center">
                            <a href="auth/redirect"
                                class="btn rounded-5 btn-danger d-flex justify-content-center align-items-center gap-2">
                                <img src="{{asset('assets/img/google.svg')}}" alt="Google" width="28px">Google
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section><!-- End Contact Section -->
</main><!-- End #main -->
@endsection