@extends('layouts.master')
    @section('content')
    <div class="pagetitle">
        <h1>Role</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a>Role</a></li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>{{session('status')}}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Halaman Data Role</h3>
                        @can('tambah role')
                            <a href="role/create" class="btn btn-outline-primary">Buat Role</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th >Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($role as $r)
                                        <tr>
                                            <td>{{$r->name}}</td>
                                            <td >
                                                @can('tambah role permission')
                                                <a href="/role/{{$r->id}}/add-permission" class="btn btn-info">Buat / Edit Role Permission</a>
                                                @endcan
                                                @can('edit role')
                                                <a href="/role/{{$r->id}}/edit" class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('hapus role')
                                                <a href="/role/{{$r->id}}/delete" class="btn btn-danger" onclick="return confirm('Apakah anda sudah yakin untuk menghapus data ini?')">Hapus</a>
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
    @endsection