document.addEventListener('DOMContentLoaded', function () {
    const imagenPrincipal = document.getElementById('mostrar-imagen-principal');
    const miniaturas = document.querySelectorAll('.contenedor-miniaturas img');

    let rutasTodasImagenes = []; 
    let temporizadorImagenes;
    let indiceActual = 0; 

    if (miniaturas.length > 0) {
        // Si hay más de una miniatura, las añade todas
        if (miniaturas.length > 1) {
            miniaturas.forEach(thumb => {
                rutasTodasImagenes.push(thumb.src);
            });
        } else {
             // Si solo hay una miniatura, añade la imagen principal y la miniatura
             rutasTodasImagenes.push(imagenPrincipal.src);
             rutasTodasImagenes.push(miniaturas[0].src);
        }
    } else if (imagenPrincipal) {
        // Si no hay miniaturas pero hay una imagen principal, usa esa
        rutasTodasImagenes.push(imagenPrincipal.src);
    }
    
    function movimientoImagenes() {
        clearInterval(temporizadorImagenes);

        if (rutasTodasImagenes.length > 1) {
            temporizadorImagenes = setInterval(() => {
                // Avanza al siguiente índice
                indiceActual = (indiceActual + 1) % rutasTodasImagenes.length;
                // Cambia la fuente de la imagen principal a la siguiente imagen
                imagenPrincipal.src = rutasTodasImagenes[indiceActual];
            }, 4000);
        }
    }

    if (imagenPrincipal && miniaturas.length > 0) {
        miniaturas.forEach((thumb, index) => {
            thumb.addEventListener('click', function () {
                imagenPrincipal.src = this.src;
                indiceActual = index;
                movimientoImagenes();
            });
        });
        movimientoImagenes();
    }
    
    const menosCantidad = document.querySelector('.menos-cantidad');
    const masCantidad = document.querySelector('.mas-cantidad');
    const campoCantidad = document.querySelector('.entrada-cantidad');

    if (campoCantidad) {
        const maxStock = parseInt(campoCantidad.dataset.stock, 10);

        if (masCantidad) {
            masCantidad.addEventListener('click', function() {
                let valorActual = parseInt(campoCantidad.value, 10);
                if (valorActual < maxStock) {
                    campoCantidad.value = valorActual + 1;
                }
            });
        }

        if (menosCantidad) {
            menosCantidad.addEventListener('click', function() {
                let valorActual = parseInt(campoCantidad.value, 10);
                if (valorActual > 1) {
                    campoCantidad.value = valorActual - 1;
                }
            });
        }

        campoCantidad.addEventListener('change', function() {
            let valorActual = parseInt(campoCantidad.value, 10);
            if (isNaN(valorActual) || valorActual < 1) {
                campoCantidad.value = 1;
            } else if (valorActual > maxStock) {
                campoCantidad.value = maxStock;
            }
        });
    }
});