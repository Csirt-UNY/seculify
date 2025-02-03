@extends('user.layouts.layout')

@section('title', 'Tes yang Tersedia')

@section('testAct', 'active')

@section('content')
<main id="main">
    <section id="why-us" class="why-us section-bg">
        <div class="container-fluid" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch  order-2 order-lg-1">
                    <div class="content">
                        <h3><strong>Daftar Tes</strong> yang bisa Anda ikuti</h3>
                        <p>Lakukan tes untuk menguji pengetahuan Anda tentang Phising.</p>
                    </div>
                    <div class="accordion-list">
                        <ul>
                            @foreach ($tests as $key => $test)
                            <li>
                                <a class="collapse" data-bs-target="#accordion-list-{{$key}}"><span>{{$key+1}}:</span>
                                    {{$test->title}}
                                    <small
                                        class="ms-2 @if($test->level == 'mudah') text-success @elseif($test->level == 'sedang') text-warning @else text-danger @endif">
                                        ({{$test->level}})
                                    </small>
                                </a>
                                <div id="accordion-list-{{$key}}" class="collapse show"
                                    data-bs-parent=".accordion-list">
                                    <p>{{$test->description}}</p>
                                    <div class="mt-4 d-flex justify-content-between align-items-end">
                                        <small>Percobaan: <small class="text-success">{{
                                                Auth::user()->attempts->where('test_id', $test->id)->count()
                                                }}</small></small>
                                        @if ($test->questions->count() > 0)
                                        @if (Auth::user()->attempts->where('test_id', $test->id)->where('status',
                                        'on_going')->count() > 0)
                                        <button type="button" class="btn btn-learn-more" data-toggle="modal"
                                            data-target="#continue{{$test->id}}">Lanjutkan</button>
                                        <div class="modal fade" id="continue{{$test->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Lanjutkan tes</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div
                                                        class="d-flex align-items-center justify-content-center pt-1 pb-3">
                                                        <p>Selesaikan tes yang masih berjalan!</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
                                                        <a href="{{ route('user.doTest', \Illuminate\Support\Facades\Crypt::encrypt(Auth::user()->attempts->where('test_id', $test->id)->where('status', 'on_going')->first()->id)) }}"
                                                            class="btn btn-primary">Lanjutkan</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <button type="button" class="btn btn-learn-more" data-toggle="modal"
                                            data-target="#start{{$test->id}}">Mulai Tes</button>
                                        <div class="modal fade" id="start{{$test->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="deleteModalTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Mulai tes</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('user.start', \Illuminate\Support\Facades\Crypt::encrypt($test->id)) }}" method="post">
                                                        @csrf
                                                        <div
                                                            class="d-flex align-items-center justify-content-center pt-2 pb-3">
                                                            <p>Yakin ingin memulai tes?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Mulai</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @else
                                        <small class="text-muted">Belum ada pertanyaan yang tersedia.</small>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img"
                    style="background-image: url({{ asset('assets/img/why-us.png') }});" data-aos="zoom-in"
                    data-aos-delay="150">
                    &nbsp;
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

@section('js')
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
@endsection
