@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Peminjaman</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/lending">Peminjaman</a></li>
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
                            <h5 class="card-title">Edit Data Peminjaman</h5>
                            <form action="/lending/{{$lending->id}}/update" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="" class="form-label">Nama Peminjam</label>
                                    <select name="id_employee" id="" class="form-control">
                                        <option value="{{$lending->id_employee}}">{{$lending->User->name}}</option>
                                        @foreach ($employee as $e)
                                            <option value="{{$e->id}}">{{$e->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Judul Buku</label>
                                    <select name="id_book" id="" class="form-control">
                                        <option value="{{$lending->id_book}}">{{$lending->Book->title}}</option>
                                        @foreach ($book as $b)
                                            <option value="{{$b->id}}">{{$b->title}}</option>
                                        @endforeach
                                    </select>                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Tanggal Pinjam</label>
                                    <input type="date" value="{{$lending->loan_date}}" name="loan_date" class="form-control" aria-describedby="helpId">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Tanggal Kembali</label>
                                    <input type="date" value="{{$lending->return_date}}" name="return_date" class="form-control" aria-describedby="helpId">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Batas Kembali</label>
                                    <input type="date" value="{{$lending->loan_limit}}" name="loan_limit" class="form-control" aria-describedby="helpId">
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Status</label>
                                    <input type="text" value="{{$lending->status}}" name="status" class="form-control" aria-describedby="helpId">
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