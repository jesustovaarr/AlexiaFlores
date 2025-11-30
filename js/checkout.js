document.addEventListener('DOMContentLoaded', function () {
    const btnMercadoPago = document.getElementById('btn-mercadopago');

    if (btnMercadoPago) {
        btnMercadoPago.addEventListener('click', function () {
            // Deshabilitar el botón y mostrar accion
            btnMercadoPago.disabled = true;
            btnMercadoPago.textContent = 'Procesando...';

            // crear el pedido
            fetch('procesar_pedido.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success' && data.init_point) {
                    // pago en una nueva pestaña
                    window.open(data.init_point, '_blank');
                    // redirigir a "Mis Pedidos"
                    window.location.href = 'cliente.php?action=pedidos';
                } else {
                    alert(data.message || 'Ocurrió un error inesperado. Por favor, intenta de nuevo.');
                    btnMercadoPago.disabled = false;
                    btnMercadoPago.textContent = 'Pagar con Mercado Pago';
                }
            })
            .catch(error => {
                console.error('Error en el fetch:', error);
                alert('No se pudo conectar con el servidor. Por favor, revisa tu conexión e intenta de nuevo.');
                btnMercadoPago.disabled = false;
                btnMercadoPago.textContent = 'Pagar con Mercado Pago';
            });
        });
    }
});