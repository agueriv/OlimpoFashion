@extends('app.base')

@section('content')
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>
        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">
                    Carrito
                </span>
                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>
            <div class="header-cart-content flex-w js-pscroll">
                <ul id="lista-carrito" class="header-cart-wrapitem w-full">
                </ul>
                <div class="w-full">
                    <div id="total-carrito" class="header-cart-total w-full p-tb-40">
                        Total: 0.00€
                    </div>
                    <div class="header-cart-buttons flex-w w-full">
                        <a id="vaciarCarrito" href="#"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Vaciar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                <div class="item-slick1" style="background-image: url({{ url('assets/images/slide-01.jpg') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Colección Mujer 2024
                                </span>
                            </div>
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    NUEVA TEMPORADA
                                </h2>
                            </div>
                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="#catalogo"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Comprar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-slick1" style="background-image: url({{ url('assets/images/slide-02.jpg') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Nueva - Temporada Hombre
                                </span>
                            </div>
                            <div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    Cazadoras y abrigos
                                </h2>
                            </div>
                            <div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
                                <a href="#catalogo"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    COMPRAR
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-slick1" style="background-image: url({{ url('assets/images/slide-03.jpg') }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    Coleccion Hombre 2024
                                </span>
                            </div>
                            <div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    Novedades
                                </h2>
                            </div>
                            <div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
                                <a href="#catalogo"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    Comprar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="sec-banner bg0 p-t-80 p-b-50" id="secciones">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                    <div class="block1 wrap-pic-w">
                        <img src="{{ url('assets/images/banner-01.jpg') }}" alt="IMG-BANNER">
                        <a href="#catalogo" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Mujer
                                </span>
                                <span class="block1-info stext-102 trans-04">
                                    2024
                                </span>
                            </div>
                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Comprar Ahora
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">

                    <div class="block1 wrap-pic-w">
                        <img src="{{ url('assets/images/banner-02.jpg') }}" alt="IMG-BANNER">
                        <a href="#catalogo" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Hombre
                                </span>
                                <span class="block1-info stext-102 trans-04">
                                    2024
                                </span>
                            </div>
                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Comprar Ahora
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">

                    <div class="block1 wrap-pic-w">
                        <img src="{{ url('assets/images/banner-03.jpg') }}" alt="IMG-BANNER">
                        <a href="#catalogo"
                            class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
                                <span class="block1-name ltext-102 trans-04 p-b-8">
                                    Niños
                                </span>
                                <span class="block1-info stext-102 trans-04">
                                    Tendencia
                                </span>
                            </div>
                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">
                                    Comprar Ahora
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg0 p-t-23 p-b-140" id="catalogo">
        <div id="main-container" class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Catálogo OLIMPO
                </h3>
            </div>
            <div class="flex-w flex-sb-m p-b-52">
                <div id="filter-buttons-menu" class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-ftype="all"
                        data-filter="">
                        Todos los artículos
                    </button>
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-ftype="seccion" data-filter="m">
                        Mujer
                    </button>
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-ftype="seccion" data-filter="h">
                        Hombre
                    </button>
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-ftype="seccion" data-filter="n">
                        Niños
                    </button>
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-ftype="categoria"
                        data-filter="zapatillas">
                        Zapatillas
                    </button>
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-ftype="categoria"
                        data-filter="relojes">
                        Relojes
                    </button>
                </div>
                <div class="flex-w flex-c-m m-tb-10">
                    <div
                        class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Filtro
                    </div>
                    <div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
                        <i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
                        <i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Buscar
                    </div>
                </div>

                <div class="dis-none panel-search w-full p-t-10 p-b-15">
                    <div class="bor8 dis-flex p-l-15">
                        <button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        <input id="q-product" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text"
                            name="search-product" placeholder="Buscar...">
                    </div>
                </div>

                <div class="dis-none panel-filter w-full p-t-10">
                    <div class="wrap-filter flex-w bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                        <div class="filter-col1 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Ordenar por
                            </div>
                            <ul id="order-by" class="filter-tope-group">
                                <li class="p-b-6">
                                    <button data-ftype="orderby" data-order="asc" data-filter="articulo.id"
                                        class="filter-link stext-106 trans-04 how-active1">
                                        Por defecto
                                    </button>
                                </li>
                                <li class="p-b-6">
                                    <button data-ftype="orderby" data-order="desc" data-filter="articulo.created_at"
                                        class="filter-link stext-106 trans-04 ">
                                        Más nuevo
                                    </button>
                                </li>
                                <li class="p-b-6">
                                    <button data-ftype="orderby" data-order="asc" data-filter="articulo.nombre"
                                        class="filter-link stext-106 trans-04">
                                        Nombre: Ascendente
                                    </button>
                                </li>
                                <li class="p-b-6">
                                    <button data-ftype="orderby" data-order="desc" data-filter="articulo.nombre"
                                        class="filter-link stext-106 trans-04">
                                        Nombre: Descendente
                                    </button>
                                </li>
                                <li class="p-b-6">
                                    <button data-ftype="orderby" data-order="asc" data-filter="articulo.precio"
                                        class="filter-link stext-106 trans-04">
                                        Precio: Ascendente
                                    </button>
                                </li>
                                <li class="p-b-6">
                                    <button data-ftype="orderby" data-order="desc" data-filter="articulo.precio"
                                        class="filter-link stext-106 trans-04">
                                        Precio: Descendente
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="filter-col3 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Categoría
                            </div>
                            <ul id="list-cat-filter" class="filter-tope-group"></ul>
                        </div>
                        <div class="filter-col4 p-r-15 p-b-27">
                            <div class="mtext-102 cl2 p-b-15">
                                Temporada
                            </div>
                            <ul id="temporada-filt-buttons" class="filter-tope-group">
                                <li class="p-b-6">
                                    <button data-ftype="temporada" data-filter="all"
                                        class="filter-link stext-106 trans-04">
                                        Todo el año
                                    </button>
                                </li>
                                <li class="p-b-6">
                                    <button data-ftype="temporada" data-filter="pri-ver"
                                        class="filter-link stext-106 trans-04">
                                        Primavera / Verano
                                    </button>
                                </li>
                                <li class="p-b-6">
                                    <button data-ftype="temporada" data-filter="oto-inv"
                                        class="filter-link stext-106 trans-04">
                                        Otoño / Invierno
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex-c-m flex-w w-full p-t-45">
                <nav>
                    <ul id="pagination" class="pagination">
                        <li class="page-item">

                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
