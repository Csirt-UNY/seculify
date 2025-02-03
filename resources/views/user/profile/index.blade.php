@extends('user.layouts.layout')

@section('title', 'Profil')

@section('profAct', 'active')

@section('content')
<main id="main">
    <section id="contact" class="contact" style="margin-top: 100px;">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Profil Anda</h2>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 mt-lg-0 d-flex align-items-stretch">
                    @if (Session::get('time') == 'first')
                    <form action="{{ route('user.profile.firstUpdate') }}" method="post" role="form"
                        class="php-email-form">
                        @else
                        <form action="{{ route('user.profile.update') }}" method="post" role="form"
                            class="php-email-form">
                            @endif
                            @method('PUT')
                            @csrf
                            @if (Session::get('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @elseif(Session::get('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                            @endif
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        value="{{ Auth::user()->name }}" required placeholder="Masukkan nama lengkap">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Email <span class="text-danger">*</span></label>
                                    <input type="email" disabled class="form-control" name="email" id="email"
                                        value="{{ Auth::user()->email }}" placeholder="Masukkan email">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Asal Instansi <span class="text-danger">*</span></label>
                                    <input type="text" name="agency" class="form-control" id="agency"
                                        value="{{ Auth::user()->agency }}" required
                                        placeholder="Masukkan asal instansi">
                                    @error('agency')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Sub Unit <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="sub_unit" id="sub_unit"
                                        value="{{ Auth::user()->sub_unit }}" required placeholder="Masukkan sub unit">
                                    @error('sub_unit')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button type="button" class="btn btn-learn-more" data-toggle="modal"
                                        data-target="#changePass">Ganti Password</button>
                                </div>
                            </div>
                            <div class="text-center"><button type="submit">Simpan Profil</button></div>
                        </form>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="changePass" tabindex="-1" role="dialog" aria-labelledby="deleteModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ganti Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('user.password.update')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card-body px-3">
                        <div class="form-group mb-3 mt-3">
                            <label for="name">Password Lama <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                name="old_password" required autocomplete="old_password">
                            @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="name">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" class="form-control @error('password_confirm') is-invalid @enderror"
                                name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Simpan perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@endsection
