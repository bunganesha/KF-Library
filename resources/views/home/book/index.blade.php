@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Buku</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Buku</li>
      </ol>
    </nav>
  </div>
<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>{{session('status')}}</div>
                    @endif
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h1>Halaman Data Buku</h1>
                            @can('tambah buku')
                            <a href="/book/create" class="btn btn-outline-primary">Tambah Data</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>ISBN</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Penulis</th>
                                            <th>Penerbit</th>
                                            <th>Tahun Terbit</th>
                                            <th>Stok</th>
                                            <th>Ringkasan</th>
                                            <th >Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($book as $b)
                                            <tr>
                                                <td>{{$b->isbn}}</td>
                                                <td>{{$b->Category->Shelf->shelf_name}}</td>
                                                <td>{{$b->title}}</td>
                                                <td>{{$b->writer}}</td>
                                                <td>{{$b->publisher}}</td>
                                                <td>{{$b->publication_year}}</td>
                                                <td>{{$b->stock}}</td>
                                                <td>{{$b->summary}}</td>
                                                <td >
                                                    @can('edit buku')
                                                    <a href="/book/{{$b->id}}/edit" class="btn btn-warning">Edit</a>
                                                    @endcan
                                                    @can('hapus buku')
                                                    <a href="/book/{{$b->id}}/delete" class="btn btn-danger" onclick="return confirm('Apakah anda sudah yakin untuk menghapus data ini?')">Hapus</a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

