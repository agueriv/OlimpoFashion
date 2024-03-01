@extends('almacen.app.base')

@section('title', 'Artículo - Olimpo')

@section('content')
    @include('almacen.articulo.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detalle del artículo
                    "<span class="text-primary">{{ $art->nombre }}</span>"</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('almacen/articulo') }}" class="text-muted">Lista de
                                    artículos</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Detalle de artículo</li>
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
                        <img class="card-img-top img-fluid" src="data:image/jpeg;base64,{{ $art->picture }}"
                            alt="Imagen de producto" style="object-fit: cover; aspect-ratio: 4 / 3">
                        <div class="card-body">
                            <h4 class="card-title">
                                {{ $art->nombre }}
                            </h4>
                            <p class="card-text">
                                {{ $art->descripcion }}
                            </p>
                            <p class="card-text mb-1">
                                <small class="text-muted"><i
                                        class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;{{ $secciones[$art->seccion] }}</small>
                            </p>
                            <p class="card-text mb-1">
                                <small class="text-muted"><i
                                        class="fa fa-sun"></i>&nbsp;&nbsp;&nbsp;{{ $temporadas[$art->temporada] }}</small>
                            </p>
                            <p class="card-text mb-1">
                                <small class="text-muted"><i
                                        class="fa fa-tag"></i>&nbsp;&nbsp;&nbsp;{{ $art->categoria->nombre }}</small>
                            </p>
                        </div>
                        <div class="card-footer">
                            @if ($art->en_rebaja)
                                <span
                                    class="badge rounded-pill text-bg-secondary float-end text-decoration-line-through">{{ $art->precio }}
                                    €</span>
                                <span class="badge rounded-pill text-bg-primary float-end me-2">{{ $art->precio_rebaja }}
                                    €</span>
                            @else
                                <span class="badge rounded-pill text-bg-primary float-end">{{ $art->precio }}
                                    €</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card col-12 col-sm-7">
                    <div class="card-body">
                        <div class="row">
                            <h3 class="text-dark mb-4">Especificaciones del artículo</h3>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="nombre">Nombre del artículo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control"
                                    value="{{ $art->nombre }}" disabled>
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="descripcion">Descripción del artículo</label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" disabled>{{ $art->descripcion }}</textarea>
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="seccion">Sección del artículo</label>
                                <input type="text" id="seccion" name="seccion" class="form-control"
                                    value="{{ $secciones[$art->seccion] }}" disabled>
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="temporada">Temporada del artículo</label>
                                <input type="text" id="temporada" name="temporada" class="form-control"
                                    value="{{ $temporadas[$art->temporada] }}" disabled>
                            </div>

                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="categoria">Categoría del artículo</label>
                                <input type="text" id="temporada" name="temporada" class="form-control"
                                    value="{{ $art->categoria->nombre }}" disabled>
                            </div>

                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="precio">Precio del artículo €</label>
                                <input type="number" step=".01" id="precio" name="precio" class="form-control"
                                    disabled value="{{ $art->precio }}">
                            </div>

                            {{-- en rebaja checkbox --}}
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-3 d-block">¿Artículo en rebajas?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="en_rebaja" id="en_rebaja1"
                                        value="1" {{ $art->en_rebaja == 1 ? 'checked' : 'disabled' }}>
                                    <label class="form-check-label" for="en_rebaja1">Si, está rebajado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="en_rebaja" id="en_rebaja2"
                                        value="0" {{ $art->en_rebaja == 0 ? 'checked' : 'disabled' }}>
                                    <label class="form-check-label" for="en_rebaja2">No, no está rebajado</label>
                                </div>
                            </div>
                            <script>
                                document.getElementsByName('en_rebaja').forEach(radio => radio.addEventListener('change', () => {
                                    if (document.getElementById('en_rebaja2').checked) {
                                        document.getElementById('precio_rebajado_in').style.display = 'none';
                                    } else {
                                        document.getElementById('precio_rebajado_in').style.display = 'block';
                                    }
                                }))
                            </script>
                            <div id="precio_rebajado_in" class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="precio_rebaja">Precio rebajado del artículo €</label>
                                <input type="number" step=".01" id="precio_rebaja" name="precio_rebaja"
                                    class="form-control" disabled value="{{ $art->precio_rebaja }}">
                            </div>
                        </div>
                        <div class="row d-flex mt-4">
                            <div class="col-12 float-end">
                                <button data-url="{{ url('almacen/articulo/' . $art->id) }}"
                                    data-nombre="{{ $art->nombre }}" data-bs-toggle="modal"
                                    data-bs-target="#deleteArticuloModal" form="deleteArticuloForm"
                                    class="btn btn-danger btn-rounded float-end">
                                    <i class="fas fa-trash me-1"></i>
                                    Eliminar
                                </button>
                                <a href="{{ url('almacen/articulo/' . $art->id . '/edit') }}"
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
    <script>
        (() => {
            'use strict'
            if (document.getElementById('en_rebaja2').checked) {
                document.getElementById('precio_rebajado_in').style.display = 'none';
            } else {
                document.getElementById('precio_rebajado_in').style.display = 'block';
            }
        })();
    </script>
@endsection
