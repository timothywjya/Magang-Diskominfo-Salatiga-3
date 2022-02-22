@extends('adminlte::page')

@section('title', 'Tambah')

@section('content_header')
<h1 class="m-0 text-dark">Tambah Iklan</h1>
@stop

@section('content')
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">



				<form action="{{ route('simpan') }}" method="post">
					{{ csrf_field() }}
					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Nomor</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputEmail3" name="nomor" required="required" placeholder="Nomor" value="{{$nomorTerakhir}}">
						</div>
					</div>

					<?php
					$month = date('m');
					$day = date('d');
					$year = date('Y');

					$today = $year . '-' . $month . '-' . $day;
					?>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Tanggal</label>
						<div class="col-sm-10">
							<input type="date" name="tanggal" id="date" class="form-control" style="width: 100%; display: inline;" onchange="" required value="{!!$today!!}">
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Telah terima dari</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputEmail3" name="nama" required="required" placeholder="Nama">
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Uang sebanyak</label>
						<div class="col-sm-10">
							<input type="text" class="form-control jumlah" id="inputEmail3" name="jumlah" required="required" placeholder="Jumlah">
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail3" class="col-sm-2 col-form-label">Guna membayar</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="inputEmail3" name="keterangan" required="required" placeholder="Keterangan">
						</div>
					</div>



					<fieldset class="form-group">
						<div class="row">
							<legend class="col-form-label col-sm-2 pt-0">Metode Pembayaran</legend>
							<div class="col-sm-10">
								<div class="form-check">
									<input class="form-check-input" type="radio" name="metodePembayaran" id="gridRadios1" value="cash">
									<label class="form-check-label" for="gridRadios1">
										Cash
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="metodePembayaran" id="gridRadios2" value="transfer">
									<label class="form-check-label" for="gridRadios2">
										Transfer
									</label>
								</div>
							</div>
					</fieldset>
					<div class="form-group row">
						<div class="col-sm-10">
							<input type="submit" class="btn btn-primary" onclick="return myFunction();" value="Tambah">
							
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.13.4/jquery.mask.min.js"></script>
<script>
	$(document).ready(function($) {

		$('.jumlah').mask('###.#00', {
			reverse: true
		});

	})
</script>
@endpush