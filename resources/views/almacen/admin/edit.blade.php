@extends('almacen.app.base')

@section('title', 'Editar Usuario - Olimpo')

@section('content')
    @include('almacen.admin.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Editar usuario</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
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
                    <div class="card-body p-5">
                        <form id="createForm" action="{{ url('almacen/admin/' . $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="nombre">Nombre de usuario</label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Introduce el nombre..." required value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="descripcion">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Introduce su email..." required value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="seccion">Puesto</label>
                                <select class="form-select mr-sm-2" id="puesto" name="puesto" required>
                                    <option disabled selected>Selecciona el puesto...</option>
                                    {{-- foreach --}}
                                    @foreach ($puestos as $value => $text)
                                        <option value="{{ $value }}"
                                            {{ $value == old('puesto', $user->puesto) ? 'selected' : '' }}>
                                            {{ $text }}</option>
                                    @endforeach

                                </select>
                                @error('seccion')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="nombre">Contraseña</label>
                                <input type="text" id="password" name="password" class="form-control"
                                    placeholder="Restablecer su contraseña..." value="{{ old('password') }}">
                                @error('password')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
