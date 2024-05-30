@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Buku</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/book">Buku</a></li>
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
                            <h5 class="card-title">Edit Data Buku</h5>
                            <form action="/book/{{$book->id}}/update" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="" class="form-label">ISBN</label>
                                    <input type="text" value="{{$book->isbn}}" name="isbn" class="form-control" aria-describedby="helpId">
                                    @error('isbn')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Kategori</label>
                                    <select name="id_category" id="" class="form-control">
                                        <option value="{{$book->id_category}}">{{$book->Category->Shelf->shelf_name}}</option>
                                        @foreach ($category as $c)
                                            <option value="{{$c->id}}">{{$c->Shelf->shelf_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Judul Buku</label>
                                    <input type="text" value="{{$book->title}}" name="title" class="form-control" aria-describedby="helpId">
                                    @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Penulis</label>
                                    <input type="text" value="{{$book->writer}}" name="writer" class="form-control" aria-describedby="helpId">
                                    @error('writer')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Penerbit</label>
                                    <input type="text" value="{{$book->publisher}}" name="publisher" class="form-control" aria-describedby="helpId">
                                    @error('publisher')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Tahun Terbit</label>
                                    <input type="date" value="{{$book->publication_year}}" name="publication_year" class="form-control" aria-describedby="helpId">
                                    @error('publication_year')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Stok</label>
                                    <input type="text" value="{{$book->stock}}" name="stock" class="form-control" aria-describedby="helpId">
                                    @error('stock')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Ringkasan</label>
                                    <input type="text" value="{{$book->summary}}" name="summary" class="form-control" aria-describedby="helpId">
                                    @error('summary')
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