document.addEventListener('DOMContentLoaded', function () {
    function numeroToMoneda(n) {
        return '$' + Number(n).toFixed(2);
    }

    const refs = {
        opcionDomicilio: document.getElementById('opcion-domicilio'),
        opcionApartado: document.getElementById('opcion-apartado'),
        detallesDomicilio: document.getElementById('detalles-domicilio'),
        detallesApartado: document.getElementById('detalles-apartado'),

        inputFechaDomicilio: document.getElementById('fecha-domicilio'),
        inputFechaApartado: document.getElementById('fecha-apartado'),

        botonFechaDomicilio: document.getElementById('btn-fecha-domicilio'),
        botonFechaApartado: document.getElementById('btn-fecha-apartado'),
        
        selectorHoraApartado: document.getElementById('hora-apartado'),

        notaResumen: document.getElementById('nota-resumen'),
        btnAccionPrincipal: document.getElementById('btn-accion-principal'),

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

        fetch('carrito.php', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(() => actualizarResumen())
            .catch(err => console.error(err));
    }

    document.querySelectorAll('.entrada-cantidad').forEach(input => {
        input.addEventListener('change', () => {
            let qty = parseInt(input.value) || 1;
            if (qty < 1) qty = 1;
            input.value = qty;
            actualizarCantidad(input.dataset.id, qty);
        });
    });

    document.querySelectorAll('.quantity-down, .quantity-up').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const input = document.querySelector(`.entrada-cantidad[data-id="${id}"]`);
            let current = parseInt(input.value) || 1;

            if (btn.classList.contains('quantity-down')) {
                if (current === 1) return;
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

        if (total === 0 && refs.cartItemsContainer && refs.resumenColumna) {
            refs.cartItemsContainer.style.display = 'none';
            refs.resumenColumna.style.display = 'none';
            if (refs.cartEmptyMessage) refs.cartEmptyMessage.style.display = 'block';
        }
    }

    function eliminarProducto(id) {
        const formData = new FormData();
        formData.append('id_producto', id);
        formData.append('action', 'remove');

        fetch('carrito.php', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(() => {
                document.getElementById(`row-${id}`).remove();
                actualizarResumen();
            });
    }

    document.querySelectorAll('.link-eliminar').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            eliminarProducto(new URL(link.href).searchParams.get('id'));
        });
    });

    refs.opcionDomicilio?.addEventListener('click', () => {
        refs.opcionDomicilio.classList.add('active');
        refs.opcionApartado.classList.remove('active');

        refs.detallesDomicilio.style.display = 'block';
        refs.detallesApartado.style.display = 'none';

        refs.notaResumen.innerHTML = '<strong>Nota:</strong> Los productos seleccionados se entregarán entre las 17:00 y las 20:00 horas del día seleccionado.';
        refs.btnAccionPrincipal.textContent = 'Proceder al Pago';
        refs.btnAccionPrincipal.setAttribute('formaction', 'checkout.php');
    });

    refs.opcionApartado?.addEventListener('click', () => {
        refs.opcionApartado.classList.add('active');
        refs.opcionDomicilio.classList.remove('active');

        refs.detallesDomicilio.style.display = 'none';
        refs.detallesApartado.style.display = 'block';

        refs.notaResumen.innerHTML = '<strong>Nota:</strong> Tienes hasta la fecha y hora seleccionadas para recoger y pagar tu producto en tienda.';
        refs.btnAccionPrincipal.textContent = 'Confirmar Apartado';
        refs.btnAccionPrincipal.setAttribute('formaction', 'apartar.php');
    });

    let campoDestino = null;
    const manana = new Date(Date.now() + 86400000);
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
                aplicarFechaSeleccionada(dateStr);
                refs.modalFechas.hide();
            }
        });
    }

    function aplicarFechaSeleccionada(fecha) {
        if (!campoDestino) return;

        const input = document.getElementById(campoDestino);
        const boton = campoDestino === "fecha-domicilio" ? refs.botonFechaDomicilio : refs.botonFechaApartado;

        input.value = fecha;
        boton.innerHTML = `<i class="fa-regular fa-calendar-days me-2"></i>${fecha}`;

        if (campoDestino === "fecha-apartado") {
            refs.selectorHoraApartado.disabled = false;
            llenarHoras();
        }
    }

    refs.modalFechasEl?.addEventListener("show.bs.modal", () => inicializarFlatpickr());

    refs.botonFechaDomicilio?.addEventListener("click", () => {
        campoDestino = "fecha-domicilio";
        refs.modalFechas.show();
    });

    refs.botonFechaApartado?.addEventListener("click", () => {
        campoDestino = "fecha-apartado";
        refs.modalFechas.show();
    });

    function llenarHoras() {
        refs.selectorHoraApartado.innerHTML = '<option selected>Elige una hora</option>';
        ["12:00","12:30","13:00","13:30","14:00","14:30","15:00"].forEach(h => {
            refs.selectorHoraApartado.innerHTML += `<option value="${h}">${h}</option>`;
        });
    }

    actualizarResumen();
});