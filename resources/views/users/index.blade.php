@extends('adminlte::page')

@section('title', 'List User')

@section('content_header')
<h1 class="m-0 text-dark">List User</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <a href="{{route('users.create')}}" class="btn btn-primary mb-2">
                    Tambah
                </a>

                <table class="table table-hover table-bordered table-stripped" id="example2">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Level</th>
                            <th>Email</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key => $user)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->level}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <a href="{{route('users.edit', $user)}}" class="btn btn-primary btn-xs">
                                    Edit
                                </a>
                                <a href="{{route('users.destroy', $user)}}" onclick="notificationBeforeDelete(event, this)" class="btn btn-danger btn-xs">
                                    Delete
                                </a>
                            </td>
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
@if(session()->has('message1'))
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    $('#example2').DataTable({
        "responsive": true,
    });

    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        if (confirm('Apakah anda yakin akan menghapus data ? ')) {
            $("#delete-form").attr('action', $(el).attr('href'));
            $("#delete-form").submit();
        }
    }
</script>
@endpush