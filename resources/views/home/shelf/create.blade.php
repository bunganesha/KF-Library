@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Rak</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/shelf">Rak</a></li>
            <li class="breadcrumb-item active">Tambah Data</li>
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
                            <h5 class="card-title">Tambah Data Rak</h5>
                            <form action="/shelf/save" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="" class="form-label">Nama Rak</label>
                                    <input type="text" name="shelf_name" class="form-control" aria-describedby="helpId">
                                    @error('shelf_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <input type="text" name="description" class="form-control" aria-describedby="helpId">
                                    @error('description')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
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