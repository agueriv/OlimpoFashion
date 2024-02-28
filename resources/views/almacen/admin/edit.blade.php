@extends('almacen.app.base')

@section('title', 'Editar Usuario - Olimpo')

@section('content')
    @include('almacen.categoria.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Editar usuario {{ $user->name }}
                </h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('almacen/admin') }}" class="text-muted">Lista de
                                    usuario</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Editar usuario</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body d-flex justify-content-center p-5">
                        <form class="col-xl-5 col-lg-7 col-md-6 d-flex flex-column align-items-center"
                            action="{{ url('almacen/admin/' . $user->id) }}" method="post">
                            @csrf
                            @method('put')
                            <h2 class="text-dark mb-4 font-weight-medium">Editar usuario</h2>
                            <div class="form-group col-12">
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                    placeholder="Introduce la categoría..." value="{{ old('nombre', $user->name) }}">
                                @error('nombre')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-warning btn-rounded float-end mt-4">
                                <i class="fas fa-pencil-alt"></i>
                                Editar usuario
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
