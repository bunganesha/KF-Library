@extends('layouts.master')
@section('content')
<div class="pagetitle">
    <h1>Pegawai</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Pegawai</li>
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
                            <h1>Halaman Data Pegawai</h1>
                            @can('tambah pegawai')
                                <a href="/employee/create" class="btn btn-outline-primary">Tambah Data</a>
                            @endcan
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Npp</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Jabatan</th>
                                            <th >Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employee as $e)
                                            <tr>
                                                <td>{{$e->npp}}</td>
                                                <td>{{$e->name}}</td>
                                                <td>{{$e->email}}</td>
                                                {{-- ROLE PERMISSION --}}
                                                <td >
                                                    <span class="badge bg-light text-dark">
                                                        <i class="bi bi-info-circle me-1"></i>
                                                        {{ implode( $e->getRoleNames()->toArray()) }}
                                                    </span>
                                                </td>
                                                <td >
                                                    @can('edit pegawai')
                                                        <a href="/employee/{{$e->id}}/edit" class="btn btn-warning">Edit</a>
                                                    @endcan
                                                    @can('hapus pegawai')
                                                        <a href="/employee/{{$e->id}}/delete" class="btn btn-danger" onclick="return confirm('Apakah anda sudah yakin untuk menghapus data ini?')">Hapus</a>
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
