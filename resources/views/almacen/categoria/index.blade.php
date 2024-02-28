@extends('almacen.app.base')

@section('title', 'Categorías - Olimpo')

@section('content')
    @include('almacen.categoria.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Lista de categorías</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Lista de categorías</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-7 align-self-center">
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
                            <div class="col-5 align-self-center">
                                <div class="customize-input float-end">
                                    <select
                                        class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                        name="orderType" id="orderTypeNombre" form="nombreForm">
                                        <option value="" selected disabled>Nombre</option>
                                        <option value="asc" {{ $order == 'categoria.nombre.asc' ? 'selected' : '' }}>
                                            Nombre ASC</option>
                                        <option value="desc" {{ $order == 'categoria.nombre.desc' ? 'selected' : '' }}>
                                            Nombre DESC</option>
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
                                <div class="customize-input float-end me-3">
                                    <select
                                        class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                        name="orderType" id="orderTypeId" form="idForm">
                                        <option value="" selected disabled>Id</option>
                                        <option value="asc" {{ $order == 'categoria.id.asc' ? 'selected' : '' }}>ID ASC
                                        </option>
                                        <option value="desc" {{ $order == 'categoria.id.desc' ? 'selected' : '' }}>ID
                                            DESC</option>
                                    </select>
                                    <form id="idForm" action="">
                                        <input type="hidden" name="orderBy" value="categoria.id" />
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
                        <div class="row">
                            <!-- Column -->
                            @if (sizeof($categorias) > 0)
                                @foreach ($categorias as $cat)
                                    <div class="col-md-6 col-lg-6 col-xl-3 mb-5">
                                        <div class="card card-hover mb-3">
                                            <div class="p-2 bg-{{ $colors[array_rand($colors)] }} text-center rounded">
                                                <h2 class="font-light text-white">{{ $cat->nombre }}</h2>
                                                <h6 class="text-white">ID: {{ $cat->id }}</h6>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-center gap-2">
                                            <a href="{{ url('almacen/categoria/' . $cat->id) }}"
                                                class="btn btn-primary btn-circle"><i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ url('almacen/categoria/' . $cat->id . '/edit') }}"
                                                class="btn btn-warning btn-circle"><i class="fa fa-pencil-alt"></i>
                                            </a>
                                            <button type="button" data-url="{{ url('almacen/categoria/' . $cat->id) }}"
                                                data-nombre="{{ $cat->nombre }}" data-bs-toggle="modal"
                                                data-bs-target="#deleteCategoriaModal" form="deleteModuloForm"
                                                class="btn btn-danger btn-circle">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted">No hay categorías...</p>
                            @endif
                        </div>
                        {{ $categorias->appends(['rpp' => $rpp, 'orderBy' => $orderBy, 'orderType' => $orderType, 'q' => $q])->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
