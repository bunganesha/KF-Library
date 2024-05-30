{{-- <x-app-web-layout> --}}
    @extends('layouts.master')
    @section('content')
    <div class="pagetitle">
        <h1>Permission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/permission">Permission</a></li>
                <li class="breadcrumb-item active"><a>Tambah Data</a></li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Buat Permission
                            <a class="btn btn-danger float-end" href="/permission">Back</a>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form action="/permission/save" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-12">
                                <label for="" class="form-label">Nama Permission</label>
                                <input type="text" name="name" class="form-control">
                                @error('name')
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
    @endsection
{{-- </x-app-web-layout> --}}