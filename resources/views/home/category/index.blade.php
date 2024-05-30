@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Kategori</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Kategori</li>
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
                    <div class="card">
                        <div class="card-header">
                            <h1>Halaman Data Kategori</h1>
                            @can('tambah kategori')
                            <a href="/category/create" class="btn btn-outline-primary">Tambah Data</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Nama Rak</td>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($category as $c)
                                            <tr>
                                                <td>{{$c->Shelf->shelf_name}}</td>
                                                <td>{{$c->description}}</td>
                                                <td >
                                                    @can('edit kategori')
                                                    <a href="/category/{{$c->id}}/edit" class="btn btn-warning">Edit</a>
                                                    @endcan
                                                    @can('hapus kategori')
                                                    <a href="/category/{{$c->id}}/delete" class="btn btn-danger" onclick="return confirm('Apakah anda sudah yakin untuk menghapus data ini?')">Hapus</a>
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

