@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Rak</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Rak</li>
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
                            <h1>Halaman Data Rak</h1>
                            @can('tambah rak')
                            <a href="/shelf/create" class="btn btn-outline-primary">Tambah Data</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Nama Rak</th>
                                            <th>Deksripsi</th>
                                            <th >Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shelf as $s)
                                            <tr>
                                                <td>{{$s->shelf_name}}</td>
                                                <td>{{$s->description}}</td>
                                                <td >
                                                    @can('edit rak')
                                                    <a href="/shelf/{{$s->id}}/edit" class="btn btn-warning">Edit</a>
                                                    @endcan
                                                    @can('hapus rak')
                                                    <a href="/shelf/{{$s->id}}/delete" class="btn btn-danger" onclick="return confirm('Apakah anda sudah yakin untuk menghapus data ini?')">Hapus</a>
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

