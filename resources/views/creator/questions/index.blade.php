@extends('creator.layouts.layout')

@section('title', 'Pertanyaan')

@section('tesAct', 'active')

@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.css')}}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Kelola Pertanyaan</h1>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{Session::get("success")}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @elseif (Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{Session::get("error")}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <div class="form-group col-2">
                        <label>Daftar pertanyaan untuk:</label>
                        <select class="form-control " name="test" onchange="navigateToQuests(this)" required>
                            @foreach ($allTests as $eachTest)
                            <option value="{{ $eachTest->id }}" @if ($eachTest->id == $test) selected
                                @endif>{{$eachTest->title}}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="button" class="mb-3 btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                        <span class="mr-2">&#10010;</span>Tambah Pertanyaan
                    </button>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Phising</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($quests as $quest)
                            <tr>
                                <td width="50px" class="text-center">{{$loop->iteration}}</td>
                                <td>{{$quest->title}}</td>
                                <td>{{$quest->description}}</td>
                                <td width="50px">{{$quest->is_phising ? '✅' : '❌'}}</td>
                                {{-- <td>
                                    <img width="200px" src="{{Storage::url('quests/' . $quest->image)}}" alt="">
                                </td> --}}
                                <td width="120px">
                                    <button type="button" class="btn btn-sm btn-warning mr-1" data-toggle="modal"
                                        data-target="#showDetailModal{{$quest->id}}">Lihat</button>
                                </td>
                                <td>{{$quest->proof}}</td>
                                <td>{{$quest->category->name}}</td>
                                <td width="120px">
                                    <button type="button" class="btn btn-sm btn-success mr-1" data-toggle="modal"
                                        data-target="#editModal{{$quest->id}}">Edit</button>
                                    <button type="button" class="btn btn-sm btn-danger mr-1" data-toggle="modal"
                                        data-target="#deleteModal{{$quest->id}}">Hapus</button>
                                </td>
                            </tr>
                            @include('creator.questions.modals.delete-modal')
                            @include('creator.questions.modals.edit-modal')
                            @include('creator.questions.modals.show_question-modal')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('creator.questions.modals.create-modal')
@endsection

@section('js')
<script>
    function navigateToQuests(select) {
        var testId = select.value;
        if (testId) {
            window.location.href = '/creator/' + testId + '/quests';
        }
    }
</script>
<script src="{{asset('assets/admin/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<script src="{{asset('assets/admin/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('assets/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
    $(function () {
      // Summernote
      $('.summern').summernote()
      $('#summernote-add').summernote()

    })
</script>
<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endsection
