@extends('admin.layouts.layout')

@section('title', 'Riwayat')

@section('attAct', 'active')

@section('css')
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/fontawesome-free/css/all.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/admin/dist/css/adminlte.min.css')}}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Riwayat Pengerjaan Tes</h1>
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
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>
                                <th>Tes</th>
                                <th>Kategori</th>
                                <th>Nilai</th>
                                <th>Status</th>
                                <th>Dikerjakan</th>
                                <th>Durasi pengerjaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attempts as $att)
                            @php
                            $corrects = $att->scores->where('attempt_id', $att->id)->where('is_correct', 1)->count();
                            $totals = $att->scores->where('attempt_id', $att->id)->count();
                            $grade = ($corrects/$totals)*100;
                            $createdAt = \Carbon\Carbon::parse($att->created_at);
                            $updatedAt = \Carbon\Carbon::parse($att->updated_at);
                            $formattedDate = $createdAt->format('d F Y | H:i:s');
                            $minuteDifference = $updatedAt->diffInMinutes($createdAt);
                            @endphp
                            <tr>
                                <td width="50px" class="text-center">{{$loop->iteration}}</td>
                                <td>{{$att->user->name}}</td>
                                <td>{{$att->test->title}}</td>
                                <td>
                                    @foreach ($att->scores as $key => $score)
                                    @if ($key != 0), @endif{{$score->question->category->name}}
                                    @endforeach
                                </td>
                                <td
                                    class="@if ($grade > 85) text-success @elseif ($grade > 70) text-warning @else text-danger @endif">
                                    {{$corrects.'/'.$totals}}</td>
                                <td class="@if ($att->status == 'completed') text-success @else text-danger @endif">
                                    {{$att->status}}</td>
                                <td>{{$formattedDate}}</td>
                                <td>{{$minuteDifference}} menit</td>
                                <td width="120px">
                                    <a href="{{ route('admin.attempts.show', $att->id) }}"
                                        class="btn btn-sm btn-warning">Detail</a>
                                    <button type="button" class="btn btn-sm btn-danger mr-1" data-toggle="modal"
                                        data-target="#deleteModal{{$att->id}}">Hapus</button>
                                </td>
                                <div class="modal fade" id="deleteModal{{$att->id}}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Hapus riwayat</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('admin.attempts.delete', $att->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="card-body">
                                                    <p>Apakah Anda yakin ingin menghapus riwayat ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
