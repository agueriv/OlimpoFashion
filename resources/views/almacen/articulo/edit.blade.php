@extends('almacen.app.base')

@section('title', 'Editar Artículo - Olimpo')

@section('content')
    @include('almacen.articulo.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Editar cartículo {{ $art->nombre }}
                </h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('almacen/categoria') }}" class="text-muted">Lista de
                                    artículos</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Editar artículo</li>
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
                        <form action="{{ url('almacen/articulo/' . $art->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="nombre">Nombre del artículo</label>
                                <input type="text" id="nombre" name="nombre" class="form-control"
                                    placeholder="Introduce el nombre..." required value="{{ old('nombre', $art->nombre) }}">
                                @error('nombre')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="descripcion">Descripción del artículo</label>
                                <input type="text" id="descripcion" name="descripcion" class="form-control"
                                    placeholder="Introduce una descripcion..." required
                                    value="{{ old('descripcion', $art->descripcion) }}">
                                @error('descripcion')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="seccion">Sección del artículo</label>
                                <select class="form-select mr-sm-2" id="seccion" name="seccion" required>
                                    <option disabled selected>Selecciona una seccion...</option>
                                    {{-- foreach --}}
                                    @foreach ($secciones as $value => $text)
                                        <option value="{{ $value }}"
                                            {{ $value == old('seccion', $art->seccion) ? 'selected' : '' }}>
                                            {{ $text }}</option>
                                    @endforeach

                                </select>
                                @error('seccion')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="temporada">Temporada del artículo</label>
                                <select class="form-select mr-sm-2" id="temporada" name="temporada" required>
                                    <option disabled selected>Selecciona una temporada...</option>
                                    {{-- foreach --}}
                                    @foreach ($temporadas as $value => $text)
                                        <option value="{{ $value }}"
                                            {{ $value == old('temporada', $art->temporada) ? 'selected' : '' }}>
                                            {{ $text }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('temporada')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- imagen --}}
                            <div class="input-group flex-nowrap mb-4 align-items-center">
                                <div class="col-3">
                                    <img class="card-img-top img-fluid" src="data:image/jpeg;base64,{{ $art->picture }}"
                                        alt="Imagen de producto" style="object-fit: cover; aspect-ratio: 4 / 3">
                                </div>
                                <div class="col-9 custom-file ps-5">
                                    <label class="mr-sm-2 mb-1" for="picture">Imagen del artículo</label>
                                    <input class="form-control" type="file" id="picture" name="picture"
                                        value="{{ old('picture', $art->picture) }}">
                                    @error('picture')
                                        <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="categoria">Categoría del artículo</label>
                                <select class="form-select mr-sm-2" id="categoria" name="categoria" required>
                                    <option disabled selected>Selecciona una categoría...</option>
                                    {{-- foreach --}}
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ $cat->id == old('categoria', $art->idcategoria) ? 'selected' : '' }}>
                                            {{ $cat->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categoria')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-1" for="precio">Precio del artículo</label>
                                <input type="number" step=".01" id="precio" name="precio" class="form-control"
                                    placeholder="Introduce el precio..." required
                                    value="{{ old('precio', $art->precio) }}">
                                @error('precio')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- en rebaja checkbox --}}
                            <div class="form-group mb-4">
                                <label class="mr-sm-2 mb-3 d-block">¿Artículo en rebajas?</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="en_rebaja" id="en_rebaja1"
                                        value="1" {{ $art->en_rebaja == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="en_rebaja1">Si, está rebajado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="en_rebaja" id="en_rebaja2"
                                        value="0" {{ $art->en_rebaja == 0 ? 'checked' : '' }}>
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
                                <label class="mr-sm-2 mb-1" for="precio_rebaja">Precio rebajado del artículo</label>
                                <input type="number" step=".01" id="precio_rebaja" name="precio_rebaja"
                                    class="form-control" placeholder="Introduce el precio rebajado..."
                                    value="{{ old('precio_rebaja', $art->precio_rebaja) }}">
                                @error('precio_rebaja')
                                    <p class="ms-2 mt-1" style="color: #c62828; font-size: .9rem">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary btn-rounded float-end mt-4">
                                <i class="fas fa-plus me-1"></i>
                                Registrar artículo
                            </button>
                        </form>
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
