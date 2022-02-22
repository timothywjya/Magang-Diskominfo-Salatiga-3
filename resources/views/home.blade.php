@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('isAdmin')
                        <h4>Anda punya akses sebagai Admin</h4>
                    @elsecan('isOperator')
                        <h4>Anda punya akses sebagai Operator</h4>
                    @endcan
            </div>
        </div>
    </div>
</div>
@stop