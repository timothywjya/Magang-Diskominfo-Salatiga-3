<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@extends('adminlte::page')

@section('title', 'Iklan')

@section('content_header')
<h1 class="m-0 text-dark">Data Iklan</h1>
@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">

        <button id="button-setor-all" type="button" disabled onclick="SetorkanTerpilih()" class="btn btn-primary" style="margin-bottom: 1rem;">
          SETOR
        </button>
        <table class="table table-bordered" id="iklan-radio-table">
          <thead>
            <tr>
              <th width="80">
                <center>Pilih</center>
              </th>
              <th width="1500">
                <center>Aksi</center>
              </th>
              <th width="10">ID</th>
              <th width="20">
                <center>Nomor</center>
              </th>
              <th width="250">
                <center>Tanggal</center>
              </th>
              <th width="500">
                <center>Nama</center>
              </th>
              <th width="500">
                <center>Keterangan</center>
              </th>
              <th width="150">
                <center>Jumlah</center>
              </th>
              <th width="150">Status</th>
              <th width="250">Metode</th>
              <th width="250">Nomor Dokumen</th>
              <th width="250">Nomor Billing</th>
              <th width="250">Tanggal Setor</th>
              <th width="250">Operator</th>
            </tr>
          </thead>
          <tbody></tbody>
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session()->has('message1'))
<script>
  Swal.fire(
    'Data Berhasil Disimpan',
    '',
    'success'
  )
</script>
@elseif(session()->has('message2'))
<script>
  Swal.fire(
    'Data Berhasil Dihapus',
    '',
    'success'
  )
</script>
@endif
<script>
  const table = $('#iklan-radio-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! url("/iklanradio/$status") !!}',
    table: 'iklan-radio-table',
    columns: [{
        "targets": [0],
        "searcable": false,
        "visible": true,
        "orderable": false,
        "render": function(data, type, row, meta) {
          return `<center><input type="checkbox" class="cb-child" value="${row.id}"></center>`;
        }
      },
      {
        data: 'aksi',
        name: 'aksi'
      },
      {
        data: 'id',
        name: 'id'
      },
      {
        data: 'nomor',
        name: 'nomor'
      },
      {
        name: 'tanggal.fungsi_sorting',
        data: {
          _: 'tanggal.display',
          sort: 'tanggal.fungsi_sorting'
        }
      },
      {
        data: 'nama',
        name: 'nama'
      },
      {
        data: 'keterangan',
        name: 'keterangan'
      },
      {
        data: 'jumlah',
        name: 'jumlah'
      },
      {
        data: 'status',
        name: 'status'
      },
      {
        data: 'metode_pembayaran',
        name: 'metode_pembayaran'
      },
      {
        data: 'nomor_dokumen',
        name: 'nomor_dokumen'
      },
      {
        data: 'nomor_billing',
        name: 'nomor_billing'
      },
      {
        data: 'tanggal_setor',
        name: 'tanggal_setor'
      },
      {
        data: 'operator',
        name: 'operator'
      }

    ]
  });
  table.columns([2]).visible(false);

  $('#head-cb').on('click', function() {
    var isChecked = $("#head-cb").prop('checked')
    $(".cb-child").prop('checked', isChecked)
    $("#button-setor-all").prop('disabled', !isChecked)
  })

  $("#iklan-radio-table tbody").on('click', '.cb-child', function() {
    if ($(this).prop('checked') != true) {
      $("#head-cb").prop('checked', false)
    }

    let semua_checkbox = $("#iklan-radio-table tbody .cb-child:checked")
    let button_non_aktif_status = (semua_checkbox.length > 0)
    $('#button-setor-all').prop('disabled', !button_non_aktif_status)
  })

  function SetorkanTerpilih() {
    let checkbox_terpilih = $("#iklan-radio-table tbody .cb-child:checked")
    let semua_id = []
    $.each(checkbox_terpilih, function(index, elm) {
      semua_id.push(elm.value)
    })

    $('#button-setor-all').prop('disabled', true)
    $.ajax({
      url: "{{url('')}}/IklanRadio/setor",
      method: 'post',
      data: {
        ids: semua_id
      },

      success: function(res) {
        top.location.href = '/admin/setor/' + semua_id;
      }
    })
  }

  function myFunction() {
    if (!confirm("Apakah Anda Yakin Akan Menghapus Data Ini?"))
      event.preventDefault();
  }
</script>

@endpush