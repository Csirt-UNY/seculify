@extends('user.layouts.layout')

@section('title', 'Riwayat Tes')

@section('hisAct', 'active')

@section('content')
<main id="main">
    <section id="pricing" class="pricing" style="margin-top: 100px">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>Riwayat Tes</h2>
                <p>Evaluasi dan ulangi tes kamu 😊</p>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="box">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tes</th>
                                        <th>Nilai</th>
                                        <th>Status</th>
                                        <th>Dikerjakan pada</th>
                                        <th>Durasi pengerjaan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($attempts as $att)
                                    @php
                                    $corrects = $att->scores->where('attempt_id', $att->id)->where('is_correct', 1)->count();
                                    $totals = $att->scores->where('attempt_id', $att->id)->count();
                                    $grade = ($corrects / $totals) * 100;
                                    $createdAt = \Carbon\Carbon::parse($att->created_at);
                                    $updatedAt = \Carbon\Carbon::parse($att->updated_at);
                                    $formattedDate = $createdAt->format('d F Y | H:i:s');
                                    $minuteDifference = $updatedAt->diffInMinutes($createdAt);
                                    @endphp
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $att->test->title }}</td>
                                        <td class="@if ($grade > 85) text-success @elseif ($grade > 70) text-warning @else text-danger @endif">
                                            {{ $corrects . '/' . $totals }}
                                        </td>
                                        <td class="@if ($att->status == 'completed') text-success @else text-warning @endif">
                                            {{ $att->status }}
                                        </td>
                                        <td>{{ $formattedDate }}</td>
                                        <td>{{ $minuteDifference }} menit</td>
                                        <td>
                                            @if ($att->status == 'completed')
                                            <a href="{{ route('user.attempts.show', \Illuminate\Support\Facades\Crypt::encrypt($att->id)) }}" class="btn btn-sm btn-success">Detail</a>
                                            @else
                                            <a href="{{ route('user.doTest', \Illuminate\Support\Facades\Crypt::encrypt(Auth::user()->attempts->where('test_id', $att->test->id)->where('status', 'on_going')->first()->id)) }}" class="btn btn-sm btn-warning">Lanjutkan</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
