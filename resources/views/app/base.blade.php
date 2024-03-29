<!DOCTYPE html>
<html lang="en">

<head>
    <title>Olimpo Fashion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="{{ url('assets/images/icons/ico_olimpo.svg') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ url('assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/fonts/linearicons-v1.0.0/icon-font.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/animate/animate.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/css-hamburgers/hamburgers.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/animsition/css/animsition.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/select2/select2.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/slick/slick.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/MagnificPopup/magnific-popup.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/main.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="url-base" content="{{ url('') }}">

    <style>
        :root {
            scroll-behavior: smooth
        }
    </style>

</head>

<body class="animsition">

    <header>
        <div class="container-menu-desktop fix-menu-desktop">
            <div class="wrap-menu-desktop" style="top: 0">
                <nav class="limiter-menu-desktop container">

                    <a href="#" class="logo">
                        <img style="max-height: 40px" src="{{ url('assets/images/logo_olimpo_bg.svg') }}"
                            alt="IMG-LOGO">
                    </a>

                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="#">Inicio</a>
                            </li>
                            <li>
                                <a href="#secciones">Secciones</a>
                            </li>
                            <li>
                                <a href="#catalogo">Catálogo</a>
                            </li>
                            @auth
                                <li>
                                    <a href="{{ url('almacen') }}">Almacén</a>
                                </li>
                            @endauth
                        </ul>
                    </div>

                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div id="icono-carrito" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="0">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="wrap-header-mobile">

            <div class="logo-mobile">
                <a href="index.html"><img src="{{ url('assets/images/logo_olimpo_bg.svg') }}" alt="IMG-LOGO"></a>
            </div>

            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div id="icono-carrito-mobile" class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="0">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>
            </div>

            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>

        <div class="menu-mobile">
            <ul class="main-menu-m">
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#categorias">Categorías</a>
                </li>
                <li>
                    <a href="#catalogo">Catálogo</a>
                </li>
            </ul>
        </div>

        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="{{ url('assets/images/icons/icon-close2.png') }}" alt="CLOSE">
                </button>
            </div>
        </div>
    </header>

    @yield('content')

    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Categorías
                    </h4>
                    <ul>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Hombre
                            </a>
                        </li>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Mujer
                            </a>
                        </li>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Relojes
                            </a>
                        </li>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Zapatillas
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Ayuda
                    </h4>
                    <ul>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Política de privacidad
                            </a>
                        </li>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Preguntas frecuentes
                            </a>
                        </li>
                        <li class="p-b-10">
                            <a href="#" class="stext-107 cl7 hov-cl1 trans-04">
                                Tienda
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        CONTACTO
                    </h4>
                    <p class="stext-107 cl7 size-201">
                        Alguna pregunta? No dudes en consultarnos lo que necesites en nuestras redes sociales!
                    </p>
                    <div class="p-t-27">
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-instagram"></i>
                        </a>
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Newsletter
                    </h4>
                    <form>
                        <div class="wrap-input1 w-full p-b-4">
                            <input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email"
                                placeholder="email@ejemplo.com">
                            <div class="focus-input1 trans-04"></div>
                        </div>
                        <div class="p-t-18">
                            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                Suscribirse
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="p-t-40">
                <div class="flex-c-m flex-w p-b-18">
                    <a href="#" class="m-all-1">
                        <img src="{{ url('assets/images/icons/icon-pay-01.png') }}" alt="ICON-PAY">
                    </a>
                    <a href="#" class="m-all-1">
                        <img src="{{ url('assets/images/icons/icon-pay-02.png') }}" alt="ICON-PAY">
                    </a>
                    <a href="#" class="m-all-1">
                        <img src="{{ url('assets/images/icons/icon-pay-03.png') }}" alt="ICON-PAY">
                    </a>
                    <a href="#" class="m-all-1">
                        <img src="{{ url('assets/images/icons/icon-pay-04.png') }}" alt="ICON-PAY">
                    </a>
                    <a href="#" class="m-all-1">
                        <img src="{{ url('assets/images/icons/icon-pay-05.png') }}" alt="ICON-PAY">
                    </a>
                </div>
                <p class="stext-107 cl6 txt-center">

                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> arielguerrero.es | Desarrollada por <a href="https://arielguerrero.es"
                        target="_blank">Ariel Guerrero</a>

                </p>
            </div>
        </div>
    </footer>

    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>
        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ url('assets/images/icons/icon-close.png') }}" alt="CLOSE">
                </button>
                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3"
                                        data-thumb="{{ url('assets/images/product-detail-01.jpg') }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ url('assets/images/product-detail-01.jpg') }}"
                                                alt="IMG-PRODUCT">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-01.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-slick3"
                                        data-thumb="{{ url('assets/images/product-detail-02.jpg') }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ url('assets/images/product-detail-02.jpg') }}"
                                                alt="IMG-PRODUCT">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-02.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-slick3"
                                        data-thumb="{{ url('assets/images/product-detail-03.jpg') }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ url('assets/images/product-detail-03.jpg') }}"
                                                alt="IMG-PRODUCT">
                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-03.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                Lightweight Jacket
                            </h4>
                            <span class="mtext-106 cl2">
                                $58.79
                            </span>
                            <p class="stext-102 cl3 p-t-23">
                                Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat
                                ornare feugiat.
                            </p>

                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>
                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Size S</option>
                                                <option>Size M</option>
                                                <option>Size L</option>
                                                <option>Size XL</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>
                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Red</option>
                                                <option>Blue</option>
                                                <option>White</option>
                                                <option>Grey</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>
                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" value="1">
                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#"
                                        class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                        data-tooltip="Add to Wishlist">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </a>
                                </div>
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('assets/js/shop.js') }}"></script>

    <script src="{{ url('assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <script src="{{ url('assets/vendor/animsition/js/animsition.min.js') }}"></script>

    <script src="{{ url('assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('assets/vendor/select2/select2.min.js') }}"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>

    <script src="{{ url('assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ url('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ url('assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ url('assets/js/slick-custom.js') }}"></script>

    <script src="{{ url('assets/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>

    <script src="{{ url('assets/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>

    <script src="{{ url('assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>

    <script src="{{ url('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.add-to-cart-btn').each(function(e) {
            console.log('prueba')
            var nameProduct = $(this).parent().parent().find('.product-name').html();
            $(this).on('click', function() {
                swal(nameProduct, "añadido al carrito !", "success");
            });
        });
    </script>

    <script src="{{ url('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>

    <script src="{{ url('assets/js/main.js') }}"></script>

    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
</body>

</html>
