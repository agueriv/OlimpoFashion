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
                    <input class="form-control custom-shadow custom-radius border-0 bg-white" type="search"
                        placeholder="Buscar..." aria-label="Search">
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
                                        class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                        <option selected>4</option>
                                        <option value="1">8</option>
                                        <option value="1">16</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5 align-self-center">
                                <div class="customize-input float-end">
                                    <select
                                        class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                        <option selected>Nombre asc</option>
                                        <option value="1">Nombre desc</option>
                                    </select>
                                </div>
                                <div class="customize-input float-end me-3">
                                    <select
                                        class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                        <option selected>ID asc</option>
                                        <option value="1">ID desc</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Column -->
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
                                        <button type="button" form="deleteModuloForm" class="btn btn-danger btn-circle"><i
                                                class="fa fa-trash" data-url="{{ url('almacen/categoria' . $cat->id) }}"
                                                data-nombre="{{ $cat->nombre }}" data-bs-toggle="modal"
                                                data-bs-target="#deleteCategoriaModal"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{ $categorias->appends(['rpp' => $rpp, 'orderBy' => $orderBy, 'orderType' => $orderType, 'q' => $q])->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endsection
