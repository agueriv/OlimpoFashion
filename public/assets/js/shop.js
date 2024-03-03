(() => {
    'use strict'

    const urlBase = document.querySelector('meta[name="url-base"]')['content'] + '/';
    const csrf = document.querySelector('meta[name="csrf-token"]')['content'];

    let peticion = (url, processAnswer) => {
        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json'
            }
        })
            .then(response => response.json())
            .then(data => {
                processAnswer(data);
            })
            .catch(error => {
                console.log("Error:", error);
            }
            );
    }

    let catalogar = (url = null) => {
        if (url == null) {
            url = urlBase + 'producto?page=1';
        }
        let index = url.indexOf('&');
        let query = '';
        if (index != -1) query = url.substring(index);
        peticion(url, (data) => {
            // Borrar el contenido anterior
            let oldCat = document.getElementById('catalogo-container');
            if (oldCat) oldCat.innerHTML = '';
            document.getElementById('pagination').innerHTML = '';
            let catalogo = newCatalogo();
            // Montar catalogo de productos
            data.data.forEach((prod) => {
                let template = newProductTemplate(prod);
                catalogo.appendChild(template);
            })
            // Incluimos el catalogo
            let segundoHijo = document.getElementById('main-container').children[1];
            document.getElementById('main-container').insertBefore(catalogo, segundoHijo.nextSibling);

            // Montamos la paginación
            pagination2(data, query);
        })
    }

    // Monta y pinta la paginación de artículos
    function pagination(data) {
        let paginationContainer = document.getElementById('pagination');

        // Boton anterior
        let previus = document.createElement('li');
        previus.className = 'page-item';
        let previusA = document.createElement('a');
        previusA.className = 'page-link';
        previusA.textContent = '‹';
        if (data.prev_page_url != null) {
            previusA.setAttribute('href', '#');
            previusA.onclick = (e) => {
                e.preventDefault();
                catalogar(data.prev_page_url);
            }
        } else {
            previusA.setAttribute('disabled', true);
        }
        previus.appendChild(previusA);
        paginationContainer.appendChild(previus);

        // ! AQUI EN MEDIO VAN LOS ENLACES DE LOS NÚMEROS DE PAGINA

        // Boton siguiente
        let next = document.createElement('li');
        next.className = 'page-item';
        let nextA = document.createElement('a');
        nextA.className = 'page-link';
        nextA.textContent = '›';
        if (data.next_page_url != null) {
            nextA.setAttribute('href', '#');
            nextA.onclick = (e) => {
                e.preventDefault();
                catalogar(data.next_page_url);
            }
        } else {
            nextA.setAttribute('disabled', true);
        }
        next.appendChild(nextA);
        paginationContainer.appendChild(next);
    }

    function pagination2(data, query) {
        let paginationContainer = document.getElementById('pagination');
        if (data.last_page != 1) {
            data.links.forEach((item) => {
                let li = document.createElement('li');
                if (item.active) {
                    li.className = 'page-item active';
                } else li.className = 'page-item';

                let link = document.createElement('a');
                link.className = 'page-link';
                if (item.label.includes('Next')) {
                    item.label = 'Siguiente ›'
                } else if (item.label.includes('Prev')) {
                    item.label = '‹ Anterior';
                }
                link.innerHTML = item.label;
                if (item.url == null) {
                    link.setAttribute('disabled', true);
                } else {
                    link.setAttribute('href', '#');
                    link.onclick = (e) => {
                        e.preventDefault();
                        catalogar(item.url + query);
                    }
                }
                li.appendChild(link);
                paginationContainer.appendChild(li);
            })
        }
    }

    function newCatalogo() {
        let catalogo = document.createElement('div');
        catalogo.setAttribute('id', 'catalogo-container');
        catalogo.className = ('row isotope-grid');
        return catalogo;
    }

    function newProductTemplate(data) {
        let template = document.createElement('div');

        template.className = 'col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ' + data.seccion;
        let block2 = document.createElement('div');
        block2.className = 'block2';

        let block2pic = document.createElement('div');
        block2pic.className = 'block2-pic hov-img0';
        let image = document.createElement('img');
        image.setAttribute('src', 'data:image/jpeg;base64,' + data.picture);
        image.style = 'object-fit: cover; aspect-ratio: 21 / 26;';
        block2pic.appendChild(image);
        let quickVisit = document.createElement('a');
        quickVisit.setAttribute('href', '');
        quickVisit.className = 'block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 add-to-cart-btn';
        quickVisit.textContent = 'Añadir al carrito';
        quickVisit.onclick = (e) => {
            // Añadir al carrito
            e.preventDefault();
            addToCart(data);
        }
        block2pic.appendChild(quickVisit);
        block2.appendChild(block2pic);

        let block2text = document.createElement('div');
        block2text.className = 'block2-txt flex-w flex-t p-t-14';

        let block2textchild1 = document.createElement('div');
        block2textchild1.className = 'block2-txt-child1 flex-col-l';
        let nombre = document.createElement('span');
        nombre.className = 'stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 product-name';
        nombre.textContent = data.nombre;
        block2textchild1.appendChild(nombre);
        if (data.en_rebaja == 1) {
            let precio_tac = document.createElement('span');
            precio_tac.className = 'stext-105 cl3';
            precio_tac.innerHTML = '<span class="d-inline-block mr-3">' + data.precio_rebaja + '€</span><strike class="d-inline-block">' + data.precio + '€</strike>';
            block2textchild1.appendChild(precio_tac);
        } else {
            let precio = document.createElement('span');
            precio.className = 'stext-105 cl3';
            precio.textContent = data.precio + '€';
            block2textchild1.appendChild(precio);
        }
        block2text.appendChild(block2textchild1);

        let block2textchild2 = document.createElement('div');
        block2textchild2.className = 'block2-txt-child2 flex-r p-t-3';
        let cora = document.createElement('a');
        cora.className = 'btn-addwish-b2 dis-block pos-relative js-addwish-b2';
        let img1 = document.createElement('img');
        img1.className = 'icon-heart1 dis-block trans-04';
        img1.setAttribute('src', urlBase + 'assets/images/icons/icon-heart-01.png');
        cora.appendChild(img1);
        let img2 = document.createElement('img');
        img2.className = 'icon-heart2 dis-block trans-04 ab-t-l';
        img2.setAttribute('src', urlBase + 'assets/images/icons/icon-heart-02.png');
        cora.appendChild(img2);
        block2textchild2.appendChild(cora);
        block2text.appendChild(block2textchild2);
        block2.appendChild(block2text);

        template.appendChild(block2);
        return template;
    }

    // Se ejecuta al cargar la pagina por si hay datos en el storage
    function initializeCart() {
        // Comprobamos que el carrito este en localstorage
        if (localStorage.getItem('cart') == null) {
            // Si no esta creamos la variable
            let cart = {
                total: 0,
                totalArticulos: 0,
                articulos: []
            }
            localStorage.setItem('cart', JSON.stringify(cart));
        } else {
            // Si esta lo recorremos y pintamos 
            let cart = JSON.parse(localStorage.getItem('cart'));
            printCart(cart);
        }
    }

    function addToCart(art) {
        // Obtenemos el localstorage
        let cart = JSON.parse(localStorage.getItem('cart'));
        // Comprobamos si el articulo esta almacenado en el storage
        let inStorage = [];
        if(cart.articulos != null) {
            inStorage = cart.articulos.filter((item) => item.data.id == art.id);
        }
        // Si no lo añadimos con cantidad 1
        if (!inStorage.length) {
            // Añadimos al storage
            let articulo = {
                data: art,
                cantidad: 1
            }
            cart.articulos.push(articulo);
        } else {
            // Si está aumentamos su cantidad
            cart.articulos.map((item) => {
                if (item.data.id == art.id) {
                    item.cantidad = item.cantidad + 1;
                    return item;
                } else {
                    return item;
                }
            })
        }
        cart = updateTotals(cart);

        // Actualizamos localstorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Pintamos carrito
        printCart(cart);
    }

    function updateTotals(cart) {
        // Actualizamos el total
        let newTotal = 0;
        let totalProd = 0;
        cart.articulos.forEach((item) => {
            let precio = item.cantidad * (item.data.en_rebaja == 1 ? item.data.precio_rebaja : item.data.precio);
            newTotal = newTotal + precio;
            totalProd = totalProd + item.cantidad;
        })
        newTotal = parseFloat(newTotal.toFixed(2))
        cart.total = newTotal;
        // Actualizamos total de productos
        cart.totalArticulos = totalProd;
        return cart;
    }

    // Vacia el carrito por completo
    function vaciarCarrito() {
        // Restablecemos el cart 
        let cart = {
            total: 0,
            totalArticulos: 0,
            articulos: []
        }
        localStorage.setItem('cart', JSON.stringify(cart))
        // Actualizamos totales
        updateTotals(cart);
        // Pintamos el nuevo carrito vacio
        printCart(cart);
    }

    // Elimina un determinado elemento del carrito
    function eliminarDeCarrito(id) {
        let cart = JSON.parse(localStorage.getItem('cart'));
        let index = cart.articulos.findIndex(item => item.data.id == id);
        if (cart.articulos[index].cantidad == 1) {
            cart.articulos.splice(index, 1);
        } else {
            cart.articulos[index].cantidad = cart.articulos[index].cantidad - 1;
        }
        cart = updateTotals(cart);
        localStorage.setItem('cart', JSON.stringify(cart));
        printCart(cart);
    }

    // Pinta el carrito
    function printCart(cart) {
        // Vaciamos la interfaz del carrito
        document.getElementById('lista-carrito').innerHTML = '';
        // Recorremos el array de articulos y vamos pintando cada uno
        cart.articulos.forEach((item) => {
            printItemCart(item)
        })
        // Actualizamos total y numero de articulos en carrito interfaz
        updateShopCart(cart);
    }
    // Añade al carrito a raiz de un conjunto de data
    function printItemCart(art) {
        let carrito = document.getElementById('lista-carrito');

        let prod = document.createElement('li');
        prod.className = 'header-cart-item flex-w flex-t m-b-12';
        prod.style = 'cursor: zoom-out'
        prod.onclick = (e) => {
            e.preventDefault();
            eliminarDeCarrito(art.data.id);
            prod.remove();
        }

        let headerCartImg = document.createElement('div');
        headerCartImg.className = 'header-cart-item-img';
        let imgProd = document.createElement('img');
        imgProd.style = 'object-fit: cover; aspect-ratio: 21 / 26;';
        imgProd.setAttribute('src', 'data:image/jpeg;base64,' + art.data.picture);
        headerCartImg.appendChild(imgProd);
        prod.appendChild(headerCartImg);

        let headerCartTxt = document.createElement('div');
        headerCartTxt.className = 'header-cart-item-txt p-t-8';
        let enlace = document.createElement('a');
        enlace.setAttribute('href', '#');
        enlace.className = 'header-cart-item-name m-b-18 hov-cl1 trans-04';
        if (art.cantidad > 1) {
            enlace.textContent = art.data.nombre + ' ( ' + art.cantidad + ' )';
        } else {
            enlace.textContent = art.data.nombre;
        }
        headerCartTxt.appendChild(enlace);
        let precio = document.createElement('span');
        precio.className = 'header-cart-item-info precioProd';
        if (art.data.en_rebaja == 1) {
            precio.textContent = art.data.precio_rebaja + '€';
        } else {
            precio.textContent = art.data.precio + '€';
        }
        headerCartTxt.appendChild(precio);
        prod.appendChild(headerCartTxt);

        carrito.appendChild(prod);
    }

    function updateShopCart(cart) {
        // Actualizar el total del carrito
        let carrito = document.getElementById('lista-carrito');
        let total = document.getElementById('total-carrito');
        // Actualizamos el total del carrito con el valor del storage
        let newTotal = cart.total;
        total.textContent = 'Total: ' + newTotal + '€';
        // Actualizar el numero de objetos del carrito
        let iconocarrito = document.getElementById('icono-carrito');
        let iconocarritomobile = document.getElementById('icono-carrito-mobile');
        let newCount = cart.totalArticulos;
        iconocarrito.setAttribute('data-notify', newCount);
        iconocarritomobile.setAttribute('data-notify', newCount);
    }

    // Busqueda
    document.getElementById('q-product').addEventListener('keyup', (e) => {
        if (e.keyCode === 13) {
            e.preventDefault();
            catalogar(urlBase + 'producto?page=1&q=' + e.target.value);
        }
    })

    // Menu de categorias y secciones
    let buttonsMenuFilter = Array.from(document.getElementById('filter-buttons-menu').children);
    buttonsMenuFilter.forEach((item) => {
        item.onclick = (e) => {
            switch (e.target.dataset.ftype) {
                // Si type all
                case 'all':
                    catalogar();
                    break;
                // Si type seccion
                case 'seccion':
                    catalogar(urlBase + 'producto?page=1&seccion=' + item.dataset.filter);
                    break;
                // Si type categoria
                case 'categoria':
                    catalogar(urlBase + 'producto?page=1&categoria=' + item.dataset.filter)
                    break;

                default:
                    break;
            }
        }
    })

    // Ordenación por precio, nombre o mas recientes
    let orderByMenu = Array.from(document.getElementById('order-by').children);
    orderByMenu.forEach((item) => {
        item.onclick = (e) => {
            switch (e.target.dataset.ftype) {
                // Si type all
                case 'orderby':
                    catalogar(urlBase + 'producto?page=1&orderby=' + e.target.dataset.filter + '&ordertype=' + e.target.dataset.order);
                    break;
                default:
                    break;
            }
        }
    })

    document.addEventListener("DOMContentLoaded", function (event) {
        catalogar();
        document.getElementById('vaciarCarrito').onclick = (e) => {
            e.preventDefault();
            // Reseteamos el localstorage
            vaciarCarrito();
        }
        // Comprobar si hay datos de carrito en la sesion o en localstorage
        initializeCart();
    });
})();