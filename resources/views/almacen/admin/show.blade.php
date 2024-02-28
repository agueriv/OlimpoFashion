@extends('almacen.app.base')

@section('title', 'Usuario - Olimpo')

@section('content')
    @include('almacen.categoria.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detalle de usuario</h4>
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
            <div class="col-12 d-flex flex-column align-items-center">
                <div class="col-xl-4 card card-hover mb-5">
                    <div class="p-2 bg-info text-center rounded">
                        <h2 class="font-light text-white">{{ $user->name }}</h2>
                        <h6 class="text-white">ID: {{ $user->id }}</h6>
                    </div>
                </div>
            </div>
        </div>
    @endsection
