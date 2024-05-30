{{-- <x-app-web-layout> --}}
    @extends('layouts.master')
    @section('content')
    <div class="pagetitle">
        <h1>Role Permission</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/role">Role</a></li>
                <li class="breadcrumb-item active"><a>Tambah Edit Role Permission</a></li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success">{{(session('status'))}}</div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h3>Role : {{$role->name}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="/role/{{$role->id}}/give-permission" method="POST" class="row g-3">
                            @csrf
                            @error($permission)
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <h5>Permission :</h5>
                            @foreach ($permission as $permission)
                                    {{-- <div class="row"> --}}
                                        <div class="col-md-3">
                                            <label for="">
                                                <input type="checkbox" class="form-check-input me-1" value="{{$permission->name}}" name="permission[]" {{in_array($permission->id, $rolePermission) ? 'checked':''}}>
                                                {{$permission->name}}
                                            </label>
                                        </div>
                                    {{-- </div> --}}
                                @endforeach
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