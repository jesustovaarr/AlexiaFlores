document.addEventListener('DOMContentLoaded', function () {


    function numeroToMoneda(n) {
        return '$' + Number(n).toFixed(2);
    }

    // Referencias al DOM HTML
    const refs = {
        opcionDomicilio: document.getElementById('opcion-domicilio'),
        opcionTienda: document.getElementById('opcion-tienda'),
        detallesDomicilio: document.getElementById('detalles-domicilio'),
        detallesTienda: document.getElementById('detalles-tienda'),

        inputFechaDomicilio: document.getElementById('fecha-domicilio'),
        inputFechaTienda: document.getElementById('fecha-tienda'),

        botonFechaDomicilio: document.getElementById('btn-fecha-domicilio'),
        botonFechaTienda: document.getElementById('btn-fecha-tienda'),
        
        selectorHoraTienda: document.getElementById('hora-tienda'),

        modalFechasEl: document.getElementById('modal-fechas'),
        modalFechas: document.getElementById('modal-fechas') ? new bootstrap.Modal(document.getElementById('modal-fechas')) : null,

        cartItemsContainer: document.getElementById('contenedor-productos-carrito'),
        cartEmptyMessage: document.getElementById('mensaje-carrito-vacio'),
        resumenColumna: document.getElementById('resumen-columna')
    };

    function actualizarCantidad(id_producto, cantidad) {
        const precioEl = document.getElementById('precio-' + id_producto);
        const precio = parseFloat(precioEl?.dataset.precio || 0);

        if (cantidad <= 0) return;

        const subtotal = cantidad * precio;
        const subtotalEl = document.getElementById('subtotal-' + id_producto);
        if (subtotalEl) subtotalEl.textContent = numeroToMoneda(subtotal);

        const formData = new FormData();
        formData.append('id_producto', id_producto);
        formData.append('cantidad', cantidad);
        formData.append('action', 'update');

        // Peticion POST por JSON para recalcular el subtotal
        fetch('carrito.php', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(() => actualizarResumen())
            .catch(err => console.error(err));
    }

    // Cantidad de forma manual
    document.querySelectorAll('.entrada-cantidad').forEach(input => {
        input.addEventListener('change', () => {
            let qty = parseInt(input.value) || 1;
            if (qty < 1) qty = 1;
            input.value = qty;
            actualizarCantidad(input.dataset.id, qty);
        });
    });

    // Clics en btones de + y -
    document.querySelectorAll('.quantity-down, .quantity-up').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const input = document.querySelector(`.entrada-cantidad[data-id="${id}"]`);
            let current = parseInt(input.value) || 1;

            if (btn.classList.contains('quantity-down')) {
                if (current === 1) return eliminarProducto(id);
                current--;
            } else {
                current++;
            }

            input.value = current;
            actualizarCantidad(id, current);
        });
    });

    function actualizarResumen() {
        const total = Array.from(document.querySelectorAll('.entrada-cantidad')).reduce((sum, input) => {
            const qty = parseInt(input.value) || 0;
            const id = input.dataset.id;
            const precio = parseFloat(document.getElementById('precio-' + id)?.dataset.precio || 0);
            return sum + (qty * precio);
        }, 0);

        const resumenSubtotal = document.getElementById('resumen-subtotal');
        if (resumenSubtotal) resumenSubtotal.textContent = numeroToMoneda(total);

        //  mostraru ocultar elementos cuando el carrito queda vacío
        if (total === 0) {
            // Ocultar la lista de productos y el resumen
            if (refs.cartItemsContainer) refs.cartItemsContainer.style.display = 'none';
            if (refs.resumenColumna) refs.resumenColumna.style.display = 'none';
   
            // Mostrar el mensaje de carrito vacío
            if (refs.cartEmptyMessage) refs.cartEmptyMessage.style.display = 'block';
        } 
    }

    function eliminarProducto(id) {
        const formData = new FormData();
        formData.append('id_producto', id);
        formData.append('action', 'remove');

        // Peticion por POST en JSON para eliminar la fila HTML del producto
        fetch('carrito.php', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(() => {
                document.getElementById(`row-${id}`).remove();
                actualizarResumen();
            });
    }

    // Enlace de eliminar
    document.querySelectorAll('.link-eliminar').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            eliminarProducto(new URL(link.href).searchParams.get('id'));
        });
    });

    // opciones de entrega
    refs.opcionDomicilio?.addEventListener('click', () => {
        refs.opcionDomicilio.classList.add('active');
        refs.opcionTienda.classList.remove('active');

        refs.detallesDomicilio.style.display = 'block';
        refs.detallesTienda.style.display = 'none';
    });

    refs.opcionTienda?.addEventListener('click', () => {
        refs.opcionTienda.classList.add('active');
        refs.opcionDomicilio.classList.remove('active');

        refs.detallesDomicilio.style.display = 'none';
        refs.detallesTienda.style.display = 'block';
    });

    //calendario y modal
    let campoDestino = null;
    const manana = new Date(Date.now() + 86400000); // fecha minima mañana
    let datePicker = null;

    function inicializarFlatpickr() {
        if (datePicker) return;

        datePicker = flatpickr("#selector-fechas", {
            minDate: manana,
            dateFormat: "d/m/Y",
            locale: "es",
            inline: true,
            onChange: (selectedDates, dateStr) => {
                if (!dateStr) return;
                // cuando el usuario elgie fecha, se aplica y se cierra
                aplicarFechaSeleccionada(dateStr);
                refs.modalFechas.hide();
            }
        });
    }

    function aplicarFechaSeleccionada(fecha) {
        if (!campoDestino) return;

        const input = document.getElementById(campoDestino);
        const boton = campoDestino === "fecha-domicilio" ? refs.botonFechaDomicilio : refs.botonFechaTienda;

        // Actualizar valores
        input.value = fecha;
        boton.innerHTML = `<i class="fa-regular fa-calendar-days me-2"></i>${fecha}`;

        if (campoDestino === "fecha-tienda") {
            refs.selectorHoraTienda.disabled = false;
            llenarHoras();
        }
    }

    refs.modalFechasEl?.addEventListener("show.bs.modal", () => inicializarFlatpickr());

    refs.botonFechaDomicilio?.addEventListener("click", () => {
        campoDestino = "fecha-domicilio";
        refs.modalFechas.show();
    });

    refs.botonFechaTienda?.addEventListener("click", () => {
        campoDestino = "fecha-tienda";
        refs.modalFechas.show();
    });

    function llenarHoras() {
        refs.selectorHoraTienda.innerHTML = '<option selected>Elige una hora</option>';
        ["17:00","17:30","18:00","18:30","19:00","19:30","20:00"].forEach(h => {
            refs.selectorHoraTienda.innerHTML += `<option value="${h}">${h}</option>`;
        });
    }

    // llamada de la funcion para al cargar la pagina asegurar que el subtotal es correcto y verificar si hay productos
    actualizarResumen();
});