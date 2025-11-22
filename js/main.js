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
});
