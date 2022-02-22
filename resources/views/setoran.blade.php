<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@extends('adminlte::page')

@section('title', 'Setoran')

@section('content_header')
<h1 class="m-0 text-dark">Setoran</h1>
@stop

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">


        <table class="table table-bordered" id="iklan-radio-table">
          <thead>
            <tr>
              <th width="100">
                <center>Aksi</center>
              </th>
              <th width="100">Nomor Dokumen</th>
              <th width="100">Nomor Billing</th>
              <th width="250">Tanggal Setor</th>
              <th width="100">jumlah</th>
              <!-- <th width="250">Aksi</th> -->
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
<script>
  const table = $('#iklan-radio-table').DataTable({
    processing: true,
    serverSide: true,
    ajax: '{!! url("/iklansetoran") !!}',
    table: 'iklan-radio-table',
    columns: [{
      data: 'aksi',
        name: 'aksi'
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
        data: 'jumlah',
        name: 'jumlah'
      }

    ]
  });
  $('#head-cb').on('click', function() {
    var isChecked = $("#head-cb").prop('checked')
    $(".cb-child").prop('checked', isChecked)
    $("#button-setor-all").prop('disabled', !isChecked)
  })

  //   if ($('#head-cb').prop('checked')==true) {
  //     $(".cb-child").prop('checked', true)
  //   }else{
  //     $(".cb-child").prop('checked', false)
  //   }
  // })

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
      url: "{{url('')}}/IklanRadio/setorpdf",
      method: 'post',
      data: {
        ids: semua_id
      },
      success: function(res) {
        top.location.href = '/admin/setorpdf/' + semua_id;
        // //   table.ajax.reload(null, false)
        // //   $("button-setor-all").prop('disabled', false)
      }
    })
    // console.log(semua_id)
    // console.log(checkbox_terpilih)
  }
</script>

@endpush