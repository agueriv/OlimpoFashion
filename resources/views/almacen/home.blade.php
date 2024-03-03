@extends('almacen.app.base')

@section('title', 'Almacén - Olimpo')

@section('content')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Buenos días <span
                        class="text-primary">{{ Auth::user()->name }}</span>!</h3>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- *************************************************************** -->
        <!-- Start First Cards -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-sm-6 col-lg-4">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $totalArt }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Nuevos Artículos
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="shopping-bag"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card border-end ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 w-100 text-truncate font-weight-medium">
                                    {{ $totalPrecioArts }}<sup class="set-doller">€</sup>
                                </h2>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">
                                    Precio total artículos
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="dollar-sign"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="card border-end ">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <div class="d-inline-flex align-items-center">
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ $totalCats }}</h2>
                                </div>
                                <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Nuevas Categrías
                                </h6>
                            </div>
                            <div class="ms-auto mt-md-3 mt-lg-0">
                                <span class="opacity-7 text-muted"><i data-feather="tag"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End First Cards -->
        <!-- *************************************************************** -->
        <!-- *************************************************************** -->
        <!-- Start Sales Charts Section -->
        <!-- *************************************************************** -->
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-5">Artículos añadidos últimos 7 días</h4>
                        <ul class="list-style-none mb-0">
                            @foreach ($lastArts as $art)
                                <a href="{{ url('almacen/articulo/' . $art->id) }}">
                                    <li class="col-12 mb-4 d-flex">
                                        <img class="img col-2" style="aspect-ratio: 4/3; object-fit: cover"
                                            src="data:image/jpeg;base64,{{ $art->picture }}" alt="Art image">
                                        <div
                                            class="content col-10 ps-4 d-flex flex-column align-items-start justify-content-center">
                                            <h4 class="text-black">{{ $art->nombre }}</h4>
                                            <small class="text-muted">
                                                <i
                                                    class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;{{ $secciones[$art->seccion] }}&nbsp;&nbsp;&nbsp;&nbsp;
                                                <i class="fa fa-tag"></i>&nbsp;&nbsp;&nbsp;{{ $art->categoria }}
                                            </small>
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Últimas categorías</h4>
                        <ul class="list-style-none mb-0">
                            @foreach ($lastCats as $cat)
                                <a href="{{ url('almacen/categoria/' . $cat->id) }}">
                                    <li class="col-12 mb-4 d-flex align-items-center justify-content-center bg-primary p-2">
                                        <h4 class="text-white mb-0">{{ $cat->nombre }}</h4>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- *************************************************************** -->
        <!-- End Sales Charts Section -->
        <!-- *************************************************************** -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
