@extends('layouts.master')
@section('content')
    <div class="pagetitle">
        <h1>Permission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active"><a>Permission</a></li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show"><button type="button" class="btn-close"
                            data-bs-dismiss="alert" aria-label="close"></button>{{ session('status') }}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Halaman Data Permission</h3>
                        @can('tambah permission')
                            <a href="permission/create" class="btn btn-outline-primary">Buat Permission</a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped datatable">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permission as $p)
                                        <tr>
                                            <td>{{ $p->name }}</td>
                                            <td>
                                                @can('edit permission')
                                                    <a href="/permission/{{ $p->id }}/edit"
                                                        class="btn btn-warning">Edit</a>
                                                @endcan
                                                @can('hapus permission')
                                                    <a href="/permission/{{ $p->id }}/delete" class="btn btn-danger"
                                                        onclick="return confirm('Apakah anda sudah yakin untuk menghapus data ini?')">Hapus</a>
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

