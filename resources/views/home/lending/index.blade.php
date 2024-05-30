@extends('layouts.master')
@section('content')
    <div class="pagetitle">
        <h1>Peminjaman</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active">Peminjaman</li>
            </ol>
        </nav>
    </div>
    <div class="content-wrapper">
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show"><button type="button"
                                    class="btn-close" data-bs-dismiss="alert"
                                    aria-label="close"></button>{{ session('status') }}</div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h1>Halaman Data Peminjaman</h1>
                                @can('tambah peminjaman')
                                <a href="/lending/create" class="btn btn-outline-primary">Tambah Data</a>
                                @endcan
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama Peminjam</th>
                                                <th>Judul Buku</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Batas Pinjam</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($lending as $l)
                                                <tr>
                                                    <td>{{ $l->User->name }}</td>
                                                    <td>{{ $l->Book->title }}</td>
                                                    <td>{{ $l->loan_date }}</td>
                                                    <td>{{ $l->return_date }}</td>
                                                    <td>{{ $l->loan_limit }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $l->status == 1 ? 'text-dark bg-warning bi-collection me-1' : 'bg-success bi-check-circle me-1'}}">
                                                            {{ $l->status == 1 ? 'Dipinjam' : 'Dikembalikan'  }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        @can('hapus peminjaman')
                                                        <a href="/lending/{{ $l->id }}/delete" class="btn btn-danger"
                                                            onclick="return confirm('Apakah anda sudah yakin untuk menghapus data ini?')">Hapus</a>
                                                        @endcan
                                                        @if ($l->status == 1)
                                                            <a href="/lending/status/{{ $l->id }}" class="btn btn-info text-white" onclick="return confirm('Apakah anda sudah yakin untuk mengembalikan buku?')">
                                                                Kembalikan
                                                            </a>
                                                        @endif
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
