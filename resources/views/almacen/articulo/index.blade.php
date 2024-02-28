@extends('almacen.app.base')

@section('title', 'Artículos - Olimpo')

@section('content')
    @include('almacen.articulo.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Lista de artículos</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Lista de artículos</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <input class="form-control custom-shadow custom-radius border-0 bg-white" name="q"
                        form="searchForm" type="search" placeholder="Buscar..." aria-label="Search"
                        value="{{ $q }}">
                    <form id="searchForm" action="">
                        <input type="hidden" name="orderBy" value="{{ $orderBy }}" />
                        <input type="hidden" name="orderType" value="{{ $orderType }}" />
                        <input type="hidden" name="rpp" value="{{ $rpp }}" />
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center">
                <div class="card col-12">
                    <div class="card-body">
                        <div class="row">
                            <div class="row mb-5">
                                <div class="col-2 align-self-center">
                                    <div class="customize-input float-start">
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
                                </div>
                                <div class="col-10 align-self-center">
                                    <div class="customize-input float-end mb-2">
                                        <select
                                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                            name="orderType" id="orderTypePrecio" form="precioForm">
                                            <option value="" selected disabled>Precio</option>
                                            <option value="asc" {{$order == 'articulo.precio.asc' ? 'selected' : ''}}>
                                                Precio ASC</option>
                                            <option value="desc" {{$order == 'articulo.precio.desc' ? 'selected' : ''}}>
                                                Precio DESC</option>
                                        </select>
                                        <form id="precioForm" action="">
                                            <input type="hidden" name="orderBy" value="articulo.precio" />
                                            <input type="hidden" name="rpp" value="{{ $rpp }}" />
                                            <input type="hidden" name="q" value="{{ $q }}" />
                                        </form>
                                        <script>
                                            document.getElementById('orderTypePrecio').addEventListener('change', () => {
                                                document.getElementById('precioForm').submit();
                                            })
                                        </script>
                                    </div>
                                    <div class="customize-input float-end me-3 mb-2">
                                        <select
                                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                            name="orderType" id="orderTypeNombre" form="nombreForm">
                                            <option value="" selected disabled>Nombre</option>
                                            <option value="asc" {{$order == 'articulo.nombre.asc' ? 'selected' : ''}}>
                                                Nombre ASC</option>
                                                <option value="desc" {{$order == 'articulo.nombre.desc' ? 'selected' : ''}}>
                                                Nombre DESC</option>
                                        </select>
                                        <form id="nombreForm" action="">
                                            <input type="hidden" name="orderBy" value="articulo.nombre" />
                                            <input type="hidden" name="rpp" value="{{ $rpp }}" />
                                            <input type="hidden" name="q" value="{{ $q }}" />
                                        </form>
                                        <script>
                                            document.getElementById('orderTypeNombre').addEventListener('change', () => {
                                                document.getElementById('nombreForm').submit();
                                            })
                                        </script>
                                    </div>
                                    <div class="customize-input float-end me-3 mb-2">
                                        <select
                                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                            name="orderType" id="orderTypeId" form="idForm">
                                            <option value="" selected disabled>ID</option>
                                            <option value="asc" {{$order == 'articulo.id.asc' ? 'selected' : ''}}>ID
                                                ASC
                                            </option>
                                            <option value="desc" {{$order == 'articulo.id.desc' ? 'selected' : ''}}>ID
                                                DESC</option>
                                        </select>
                                        <form id="idForm" action="">
                                            <input type="hidden" name="orderBy" value="articulo.id" />
                                            <input type="hidden" name="rpp" value="{{ $rpp }}" />
                                            <input type="hidden" name="q" value="{{ $q }}" />
                                        </form>
                                        <script>
                                            document.getElementById('orderTypeId').addEventListener('change', () => {
                                                document.getElementById('idForm').submit();
                                            })
                                        </script>
                                    </div>
                                </div>
                            </div>
                            {{-- LISTA DE ARTICULOS --}}
                            <div class="row card-deck">
                                @if (sizeof($articulos) > 0)
                                    @foreach ($articulos as $art)
                                        <div class="col-sm-6 col-lg-4 d-flex flex-column align-content-stretch mb-4">
                                            <div class="card">
                                                <img class="card-img-top img-fluid"
                                                    src="data:image/jpeg;base64,{{ $art->picture }}"
                                                    alt="Imagen de producto"
                                                    style="object-fit: cover; aspect-ratio: 4 / 3">
                                                <div class="card-body">
                                                    <h4 class="card-title"><a
                                                            href="{{ url('almacen/articulo/' . $art->id) }}">{{ $art->nombre }}</a>
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
                                                                class="fa fa-tag"></i>&nbsp;&nbsp;&nbsp;{{ $art->categoria }}</small>
                                                    </p>
                                                </div>
                                                <div class="card-footer">
                                                    @if ($art->en_rebaja)
                                                        <span
                                                            class="badge rounded-pill text-bg-secondary float-end text-decoration-line-through">{{ $art->precio }}
                                                            €</span>
                                                        <span
                                                            class="badge rounded-pill text-bg-primary float-end me-2">{{ $art->precio_rebaja }}
                                                            €</span>
                                                    @else
                                                        <span
                                                            class="badge rounded-pill text-bg-primary float-end">{{ $art->precio }}
                                                            €</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row d-flex justify-content-center gap-2">
                                                <a href="{{ url('almacen/articulo/' . $art->id) }}"
                                                    class="btn btn-primary btn-circle"><i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ url('almacen/articulo/' . $art->id . '/edit') }}"
                                                    class="btn btn-warning btn-circle"><i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <button type="button"
                                                    data-url="{{ url('almacen/articulo/' . $art->id) }}"
                                                    data-nombre="{{ $art->nombre }}" data-bs-toggle="modal"
                                                    data-bs-target="#deleteArticuloModal" form="deleteArticuloForm"
                                                    class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No hay productos...</p>
                                @endif
                            </div>
                            {{ $articulos->appends(['rpp' => $rpp, 'orderBy' => $orderBy, 'orderType' => $orderType, 'q' => $q])->onEachSide(2)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
