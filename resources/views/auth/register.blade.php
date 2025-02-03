@extends('layouts.layout')
@section('title', 'Daftar')
@section('content')
<main id="main">
    <section id="contact" class="contact">
        <div class="container" data-aos="fade-up">

            <div class="section-title">
                <img style="width: 100px; margin: 64px 0 24px 0;" src="assets/img/seculify/logo.png" alt="">
                <h2>DAFTAR AKUN</h2>
                {{-- <p>Daftar untuk menggunakan fitur EduCsirt.</p> --}}
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-lg-6 mt-5 mt-lg-0 align-items-stretch">
                    @if (Session::get('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @elseif (Session::get('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>

                    @endif
                    <form method="POST" action="{{ route('register') }}" role="form" class="php-email-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" name="name" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
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
                        <div class="form-group">
                            <label for="name">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('login') }}">Sudah punya akun? Login</a>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit">Buat Akun</button>
                        </div>
                        <p class="text-center mt-4 mb-3">Atau daftar dengan</p>
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
