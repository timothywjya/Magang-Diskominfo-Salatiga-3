@extends('adminlte::page')
@section('title', 'Edit User')
@section('content_header')
<h1 class="m-0 text-dark">Profile</h1>
@stop
@section('content')
<form action="{{route('users.update', Auth::user()->id)}}" method="post">
    @method('PUT')
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="rounded-circle mt-5" width="150px" src="/images/radio.png"><span class="font-weight-bold">{{Auth::user()->name}}</span><span class="text-black-50">{{Auth::user()->email}}</span><span> </span></div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right">Pengaturan Profile</h4>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Nama</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Nama lengkap" name="name" value="{{Auth::user()->name}}">
                                        @error('name') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail">Email address</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail" placeholder="Masukkan Email" name="email" value="{{Auth::user()->email}}">
                                        @error('email') <span class="text-danger">{{$message}}</span> @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12"><label class="labels">Level</label>
                                            <br>
                                            {{ ucwords(Auth::user()->level) }}


                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Password</label>
                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="Password" name="password">
                                            @error('password') <span class="text-danger">{{$message}}</span> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword">Konfirmasi Password</label>
                                            <input type="password" class="form-control" id="exampleInputPassword" placeholder="Konfirmasi Password" name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                       
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center experience"><span>Edit Experience</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Experience</span></div><br>
                                        <div class="col-md-12"><label class="labels">Experience in Designing</label><input type="text" class="form-control" placeholder="experience" value=""></div> <br>
                                        <div class="col-md-12"><label class="labels">Additional Details</label><input type="text" class="form-control" placeholder="additional details" value=""></div>
                                    </div>
                                </div> -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    
    @stop
    @push('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session()->has('message1'))
    <script>
        Swal.fire(
            'Data Berhasil Disimpan',
            '',
            'success'
        )
    </script>
    @endif
    @endpush