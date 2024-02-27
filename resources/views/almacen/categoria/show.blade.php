@extends('almacen.app.base')

@section('title', 'Categoría - Olimpo')

@section('content')
    @include('almacen.categoria.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detalle de categoría</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('almacen/categoria') }}" class="text-muted">Lista de
                                    categorías</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Detalle de categoría</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center">
                <div class="col-xl-4 card card-hover mb-5">
                    <div class="p-2 bg-info text-center rounded">
                        <h2 class="font-light text-white">{{ $cat->nombre }}</h2>
                        <h6 class="text-white">ID: {{ $cat->id }}</h6>
                    </div>
                </div>
                <div class="card col-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="row">
                                <div class="col-3">
                                    <h3 class="text-dark mb-4 font-weight-medium">Lista de artículos</h3>
                                </div>
                                <div class="col-9 align-self-center">
                                    <div class="customize-input float-end">
                                        <input class="form-control custom-shadow custom-radius border-0 bg-white"
                                            name="q" form="searchForm" type="search" placeholder="Buscar..."
                                            aria-label="Search" value="{{ $q }}">
                                        <form id="searchForm" action="">
                                            <input type="hidden" name="orderBy" value="{{ $orderBy }}" />
                                            <input type="hidden" name="orderType" value="{{ $orderType }}" />
                                            <input type="hidden" name="rpp" value="{{ $rpp }}" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-7 align-self-center">
                                    <div class="customize-input float-start me-3">
                                        <select
                                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                            name="rpp" id="rpp" form="rppForm">
                                            @foreach ($rpps as $index => $value)
                                                <option value="{{ $index }}" {{ $rpp == $index ? 'selected' : '' }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                        <form id="rppForm" action="">
                                            <input type="hidden" name="orderBy" value="{{ $orderBy }}" />
                                            <input type="hidden" name="orderType" value="{{ $orderType }}" />
                                            <input type="hidden" name="q" value="{{ $q }}" />
                                        </form>
                                        <script>
                                            document.getElementById('rpp').addEventListener('change', () => {
                                                document.getElementById('rppForm').submit();
                                            })
                                        </script>
                                    </div>
                                    <div class="customize-input float-start">
                                        <select
                                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                            name="orderType" id="orderTypeNombre" form="nombreForm">
                                            <option value="" selected disabled>Nombre</option>
                                            <option value="asc" {{ $orderType == 'asc' ? 'selected' : '' }}>Nombre ASC
                                            </option>
                                            <option value="desc" {{ $orderType == 'desc' ? 'selected' : '' }}>Nombre DESC
                                            </option>
                                        </select>
                                        <form id="nombreForm" action="">
                                            <input type="hidden" name="orderBy" value="categoria.nombre" />
                                            <input type="hidden" name="rpp" value="{{ $rpp }}" />
                                            <input type="hidden" name="q" value="{{ $q }}" />
                                        </form>
                                        <script>
                                            document.getElementById('orderTypeNombre').addEventListener('change', () => {
                                                document.getElementById('nombreForm').submit();
                                            })
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row card-deck">
                                @if (sizeof($articulos) > 0)
                                    @foreach ($articulos as $art)
                                        <div class="col-sm-6 col-lg-4 d-flex align-content-stretch">
                                            <div class="card">
                                                <img class="card-img-top img-fluid"
                                                    src="data:image/jpeg;base64,{{ $art->picture }}"
                                                    alt="Imagen de producto">
                                                <div class="card-body">
                                                    <h4 class="card-title"><a
                                                            href="{{ url('almacen/articulo/' . $art->id) }}">{{ $art->nombre }}</a>
                                                    </h4>
                                                    <p class="card-text">
                                                        {{ $art->descripcion }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No hay artículos de esta categoría</p>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    {{ $articulos->appends(['rpp' => $rpp])->onEachSide(2)->links() }}
                                </div>
                                <div class="col-4">
                                    <button data-url="{{ url('almacen/categoria/' . $cat->id) }}"
                                        data-nombre="{{ $cat->nombre }}" data-bs-toggle="modal"
                                        data-bs-target="#deleteCategoriaModal" form="deleteModuloForm"
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
