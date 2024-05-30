@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Kategori</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="/category">Kategori</a></li>
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
                            <h5 class="card-title">Edit Data Kategori</h5>
                            <form action="/category/{{$category->id}}/update" method="POST" class="row g-3">
                                @csrf
                                <div class="col-md-12">
                                    <label for="" class="form-label"> Nama Rak</label>
                                    <select name="id_shelf" id="" class="form-control">
                                        <option value="{{$category->id_shelf}}">{{$category->Shelf->shelf_name}}</option>
                                        @foreach($shelf as $s)
                                            <option value="{{$s->id}}">{{$s->shelf_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="" class="form-label">Deskripsi</label>
                                    <input type="text" value="{{$category->description}}" name="description" class="form-control" aria-describedby="helpId">
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