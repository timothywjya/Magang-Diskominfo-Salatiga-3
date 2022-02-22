<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@extends('adminlte::page')

@section('title', 'Detail')

@section('content_header')
<h1 class="m-0 text-dark">Detail Setoran</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">



                <table class="table table-bordered" id="iklan-radio-table">
                    <thead>
                        <tr>
                            <!-- <th>
                      <center><input type="checkbox" id="head-cb"></center>
                    </th> -->
                            <th width="10">
                                <center>Nomor</center>
                            </th>
                            <th width="100">
                                <center>Tanggal</center>
                            </th>
                            <th width="300">
                                <center>Nama</center>
                            </th>
                            <th width="300">
                                <center>Keterangan</center>
                            </th>
                            <th width="60">
                                <center>Jumlah</center>
                            </th>
                            <th width="60">Metode</th>
                            <th width="60">Operator</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $d)
                        <tr>
                            <td>{{ $d->nomor }}</td>
                            <td>{{ \Carbon\Carbon::parse($d->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->keterangan }}</td>
                            <td>{{ number_format($d->jumlah, 0,',','.') }}</td>
                            <td>{{ $d->metode_pembayaran }}</td>
                            <td>{{ $d->user->name }}</td>
                            <type=hidden {{ $d->id }}>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@push('js')
<form action="" id="delete-form" method="post">
    @method('delete')
    @csrf
</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="sweetalert2.all.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@endpush