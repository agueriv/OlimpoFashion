@extends('almacen.app.base')

@section('title', 'Usuarios - Olimpo')

@section('content')
    @include('almacen.admin.modal.delete')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Lista de usuarios</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ url('almacen') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Lista de usuarios</li>
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
                                            name="orderType" id="orderTypeNombre" form="nombreForm">
                                            <option value="" selected disabled>Nombre</option>
                                            <option value="asc" {{ $order == 'users.name.asc' ? 'selected' : '' }}>
                                                Nombre ASC</option>
                                            <option value="desc"
                                                {{ $order == 'users.name.desc' ? 'selected' : '' }}>
                                                Nombre DESC</option>
                                        </select>
                                        <form id="nombreForm" action="">
                                            <input type="hidden" name="orderBy" value="users.name" />
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
                                            name="orderType" id="orderTypeEmail" form="emailForm">
                                            <option value="" selected disabled class="orderTitle">Email</option>
                                            <option value="asc" {{ $order == 'users.email.asc' ? 'selected' : '' }}>
                                                Email ASC</option>
                                            <option value="desc"
                                                {{ $order == 'users.email.desc' ? 'selected' : '' }}>
                                                Email DESC</option>
                                        </select>
                                        <form id="emailForm" action="">
                                            <input type="hidden" name="orderBy" value="users.email" />
                                            <input type="hidden" name="rpp" value="{{ $rpp }}" />
                                            <input type="hidden" name="q" value="{{ $q }}" />
                                        </form>
                                        <script>
                                            document.getElementById('orderTypeEmail').addEventListener('change', () => {
                                                document.getElementById('emailForm').submit();
                                            })
                                        </script>
                                    </div>
                                    <div class="customize-input float-end me-3 mb-2">
                                        <select
                                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius"
                                            name="orderType" id="orderTypeId" form="idForm">
                                            <option value="" selected disabled>ID</option>
                                            <option value="asc" {{ $order == 'users.id.asc' ? 'selected' : '' }}>ID
                                                ASC
                                            </option>
                                            <option value="desc" {{ $order == 'users.id.desc' ? 'selected' : '' }}>ID
                                                DESC</option>
                                        </select>
                                        <form id="idForm" action="">
                                            <input type="hidden" name="orderBy" value="users.id" />
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
                                @if (sizeof($users) > 0)
                                    @foreach ($users as $user)
                                        <div class="col-sm-6 col-lg-4 d-flex flex-column align-content-stretch mb-4">
                                            <div class="card">
                                                <img class="card-img-top img-fluid"
                                                    src="{{ url('backassets/assets/images/users/profile-pic.svg') }}"
                                                    alt="Imagen de producto"
                                                    style="object-fit: cover; aspect-ratio: 4 / 3;">
                                                <div class="card-body">
                                                    <h4 class="card-title"><a
                                                            href="{{ url('almacen/admin/' . $user->id) }}">{{ $user->name }}</a>
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
                                            <div class="row d-flex justify-content-center gap-2">
                                                <a href="{{ url('almacen/admin/' . $user->id) }}"
                                                    class="btn btn-primary btn-circle"><i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ url('almacen/admin/' . $user->id . '/edit') }}"
                                                    class="btn btn-warning btn-circle"><i class="fa fa-pencil-alt"></i>
                                                </a>
                                                <button type="button"
                                                    data-url="{{ url('almacen/admin/' . $user->id) }}"
                                                    data-nombre="{{ $user->name }}" data-bs-toggle="modal"
                                                    data-bs-target="#deleteAdminModal" form="deleteArticuloForm"
                                                    class="btn btn-danger btn-circle">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">No hay usuarios...</p>
                                @endif
                            </div>
                            {{ $users->appends(['rpp' => $rpp, 'orderBy' => $orderBy, 'orderType' => $orderType, 'q' => $q])->onEachSide(2)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
