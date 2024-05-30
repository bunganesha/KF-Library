@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Pegawai</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/employee">Pegawai</a></li>
            <li class="breadcrumb-item active">Edit Data</li>
        </ol>
    </nav>
</div>
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body"> 
                            <h5 class="card-title">Edit Data Pegawai</h5>
                            <form action="/employee/{{$employee->id}}/update" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="" class="form-label">Npp</label>
                                    <input type="text" value="{{$employee->npp}}" name="npp" class="form-control" aria-describedby="helpId">
                                    @error('npp')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" value="{{$employee->name}}" name="name" class="form-control" aria-describedby="helpId">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" value="{{$employee->email}}" name="email" class="form-control" aria-describedby="helpId">
                                    @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" aria-describedby="helpId">
                                    @error('password')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Jabatan</label>
                                    <select name="position" class="form-control" >
                                    {{-- <option value="{{$employee->position}}">{{$employee->Role}}</option> --}}
                                        @foreach ($role as $r)
                                            <option value="{{$r->id}}">{{$r->name}}</option>
                                        @endforeach
                                    </select>                                
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary rounded-pill col-md-1">Simpan</button>
                                    <button type="reset" class="btn btn-secondary rounded-pill col-md-1">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection