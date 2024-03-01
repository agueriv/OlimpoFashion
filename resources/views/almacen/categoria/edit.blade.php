@extends('almacen.app.base')

@section('title', 'Editar Categoría - Olimpo')

@section('content')
    @include('almacen.categoria.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Editar categoría {{ $cat->nombre }}
                </h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('almacen/categoria') }}" class="text-muted">Lista de
                                    categorías</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Editar categoría</li>
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
                            action="{{ url('almacen/categoria/' . $cat->id) }}" method="post">
                            @csrf
                            @method('put')
                            <h2 class="text-dark mb-4 font-weight-medium">Editar categoría</h2>
                            <div class="form-group col-12">
                                <input type="text" class="form-control" name="nombre" id="nombre"
                                    placeholder="Introduce la categoría..." value="{{ old('nombre', $cat->nombre) }}">
                                @error('nombre')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="row d-flex mt-4">
                                <div class="col-12 float-end">
                                    <button data-url="{{ url('almacen/categoria/' . $cat->id) }}"
                                        data-nombre="{{ $cat->nombre }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteCategoriaModal" form="deleteUsuarioForm"
                                        class="btn btn-danger btn-rounded float-end">
                                        <i class="fas fa-trash me-1"></i>
                                        Eliminar
                                    </button>
                                    <a href="{{ url('almacen/categoria/' . $cat->id . '/edit') }}"
                                        class="btn btn-warning btn-rounded float-end me-3">
                                        <i class="fas fa-pencil-alt me-1"></i>
                                        Editar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
