<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@extends('adminlte::page')

@section('title', 'Detail')

@section('content_header')
<h1 class="m-0 text-dark">Ubah Data</h1>
@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">



        <form action="{{ url('/iklan/update', $data_iklan->id) }}" method="post">
          {{ csrf_field() }}

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nomor</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputEmail3" name="nomor" required="required" value="{{ $data_iklan->nomor }}">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputEmail3" name="nama" required="required" value="{{ $data_iklan->nama }}">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
            <div class="col-sm-10">
              <input name="tanggal" type="date" id="date" class="form-control" style="width: 100%; display: inline;" value="<?php echo strftime('%Y-%m-%d', strtotime($data_iklan->tanggal)); ?>" />

            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Keterangan</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="inputEmail3" name="keterangan" required="required" value="{{ $data_iklan->keterangan }}">
            </div>
          </div>

          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Jumlah</label>
            <div class="col-sm-10">
              <input type="text" class="form-control jumlah" id="inputEmail3" name="jumlah" required="required" value="{{ $data_iklan->jumlah }}">
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Metode Pembayaran</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="metodePembayaran" id="gridRadiosCash" value="cash" {{ $data_iklan->metode_pembayaran=='cash'? ' checked' : '' }}>
                  <label class="form-check-label" for="gridRadiosCash">
                    Cash
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="metodePembayaran" id="gridRadiosTransfer" value="transfer" {{ $data_iklan->metode_pembayaran=='transfer'? ' checked' : '' }}>
                  <label class="form-check-label" for="gridRadiosTransfer">
                    Transfer
                  </label>
                </div>
              </div>
          </fieldset>
          <div class="form-group row">
            <div class="col-sm-10">
              <input type="submit" class="btn btn-primary" onclick="return myFunction();" value="Simpan">
              <a href="{{ route('iklan')}} " type="submit" class="btn btn-primary">Kembali</a>
            </div>
          </div>
        </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script>
  $(document).ready(function($) {

    $('.jumlah').mask('###.#00', {
      reverse: true
    });

  })
</script>

@endpush