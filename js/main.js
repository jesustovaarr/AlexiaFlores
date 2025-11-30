document.addEventListener('DOMContentLoaded', function () {

    const iconoBusqueda = document.getElementById('icono-barra-busqueda');
    const barraBusqueda = document.getElementById('barra-busqueda');
    const botonCerrar = document.getElementById('btn-cerrar-barra-busqueda');
    const campoBusqueda = document.querySelector('.campo-texto-barra-busqueda');

    // verificar que todos los elementos existan
    if (iconoBusqueda && barraBusqueda && botonCerrar && campoBusqueda) {
        
        // abrir barra
        iconoBusqueda.addEventListener('click', function (event) {
            event.preventDefault();
            barraBusqueda.classList.add('active');
            setTimeout(() => campoBusqueda.focus(), 300);
        });

        // cerrar mediante boton
        botonCerrar.addEventListener('click', function () {
            barraBusqueda.classList.remove('active');
        });

        // cerrar mediante clic fuera
        document.body.addEventListener('click', function (event) {
            if (barraBusqueda.classList.contains('active') && 
                !barraBusqueda.contains(event.target) && 
                !iconoBusqueda.contains(event.target)) {
                barraBusqueda.classList.remove('active')
            }
        });
    }

    // logica para el modal de Filtrar y Ordenar
    const abrirFiltroOrdenModalBtn = document.getElementById('abrirFiltroOrdenModal');
    const cerrarFiltroOrdenModalBtn = document.getElementById('cerrarFiltroOrdenModal');
    const filtroOrdenModal = document.getElementById('filtroOrdenModal');
    const filtroOrdenForm = document.getElementById('filtroOrdenForm');
    const limpiarFiltrosBtn = document.getElementById('limpiarFiltros');

    if (abrirFiltroOrdenModalBtn && cerrarFiltroOrdenModalBtn && filtroOrdenModal && filtroOrdenForm && limpiarFiltrosBtn) {
        abrirFiltroOrdenModalBtn.addEventListener('click', function (event) {
            event.preventDefault();
            filtroOrdenModal.style.display = 'block';
        });

        cerrarFiltroOrdenModalBtn.addEventListener('click', function () {
            filtroOrdenModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target == filtroOrdenModal) {
                filtroOrdenModal.style.display = 'none';
            }
        });

        // funcion para aplicar filtros y ordenar
        async function aplicarFiltrosOrdenamiento() {
            const formData = new FormData(filtroOrdenForm);
            const params = new URLSearchParams();

            if (formData.get('orden')) {
                params.append('orden', formData.get('orden'));
            }
            if (formData.get('precio_min')) {
                params.append('precio_min', formData.get('precio_min'));
            }
            if (formData.get('precio_max')) {
                params.append('precio_max', formData.get('precio_max'));
            }

            // parametro filtro=true para indicar una solicitud 
            params.append('filtro', 'true');

            try {
                const response = await fetch('productos.php?' + params.toString());
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();

                // actualizar el contenedor de productos
                const contenedorProductos = document.querySelector('.contenedor-productos');
                if (contenedorProductos) {
                    contenedorProductos.innerHTML = data.html;
                }

                // actualizar el contador de resultados
                const spanResultados = document.querySelector('.barra-filtros span');
                if (spanResultados) {
                    spanResultados.textContent = `Mostrando ${data.count} resultados`;
                }

                // cerrar el modal
                filtroOrdenModal.style.display = 'none';

                // actualizar la URL del navegador
                history.pushState(null, '', 'productos.php?' + params.toString().replace('&filtro=true', ''));
            } catch (error) {
                console.error('Error al aplicar filtros:', error);
            }
        }

        filtroOrdenForm.addEventListener('submit', function (event) {
            event.preventDefault();
            aplicarFiltrosOrdenamiento();
        });

        limpiarFiltrosBtn.addEventListener('click', function () {
            filtroOrdenForm.reset();

            // desmarcar radio buttons
            const radioButtons = filtroOrdenForm.querySelectorAll('input[type="radio"]');
            radioButtons.forEach(radio => radio.checked = false);

            const params = new URLSearchParams();
            params.append('filtro', 'true');
            
            fetch('productos.php?' + params.toString())
                .then(response => response.json())
                .then(data => {
                    const contenedorProductos = document.querySelector('.contenedor-productos');
                    if (contenedorProductos) {
                        contenedorProductos.innerHTML = data.html;
                    }
                    const spanResultados = document.querySelector('.barra-filtros span');
                    if (spanResultados) {
                        spanResultados.textContent = `Mostrando ${data.count} resultados`;
                    }
                    history.pushState(null, '', 'productos.php');
                })
                .catch(error => console.error('Error al limpiar filtros:', error));
        });
    }
});