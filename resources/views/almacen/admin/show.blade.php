@extends('almacen.app.base')

@section('title', 'Usuario - Olimpo')

@section('content')
    @include('almacen.admin.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detalle del usuario
                    "<span class="text-primary">{{ $user->name }}</span>"</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('almacen/admin') }}" class="text-muted">Lista de
                                    usuarios</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Detalle de usuario</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-row align-items-start justify-content-between">
                <div
                    class="col-sm-6 col-md-4 col-lg-3 col-xl-4 d-flex flex-column align-content-stretch mb-4 d-none d-sm-block">
                    <div class="card">
                        <img class="card-img-top img-fluid"
                            src="{{ url('backassets/assets/images/users/profile-pic.svg') }}" alt="Imagen de producto"
                            style="object-fit: cover; aspect-ratio: 4 / 3;">
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $user->name }}
                            </h4>
                            <p class="card-text mb-1">
                                <small class="text-muted"><i
                                        class="fa fa-envelope"></i>&nbsp;&nbsp;&nbsp;{{ $user->email }}</small>
                            </p>
                            <p class="card-text mb-1">
                                <small class="text-muted"><i
                                        class="fa fa-dice"></i>&nbsp;&nbsp;&nbsp;{{ $puestos[$user->puesto] }}</small>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-sm-7">
                    <div class="card-body">
                        <div class="row">
                            <h3 class="text-dark mb-4">Perfil del Usuario</h3>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="nombre">Nombre del usuario</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $user->name }}" disabled>
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="nombre">Email del usuario</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    value="{{ $user->email }}" disabled>
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="seccion">Puesto del usuario</label>
                                <input type="text" id="seccion" name="seccion" class="form-control"
                                    value="{{ $puestos[$user->puesto] }}" disabled>
                            </div>
                        </div>
                        <div class="row d-flex mt-4">
                            <div class="col-12 float-end">
                                <button data-url="{{ url('almacen/admin/' . $user->id) }}"
                                    data-nombre="{{ $user->name }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteAdminModal" form="deleteUsuarioForm"
                                    class="btn btn-danger btn-rounded float-end">
                                    <i class="fas fa-trash me-1"></i>
                                    Eliminar
                                </button>
                                <a href="{{ url('almacen/admin/' . $user->id . '/edit') }}"
                                    class="btn btn-warning btn-rounded float-end me-3">
                                    <i class="fas fa-pencil-alt me-1"></i>
                                    Editar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
