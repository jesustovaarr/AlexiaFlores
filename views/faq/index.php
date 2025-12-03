<main class="container my-5 contenido-estatico">
    <div class="row">
        <div class="col-12 encabezado-pagina-estatica">
            <h1 class="display-4 trocchi-font">Preguntas Frecuentes</h1>
        </div>
    </div>

    <div class="row justify-content-center pt-4">
        <div class="col-lg-10">
            <?php if (empty($faqs_agrupadas)): ?>
                <div class="alert alert-info text-center" role="alert">
                    Actualmente no hay preguntas frecuentes para mostrar.
                </div>
            <?php else: ?>
                <?php $indice_categoria = 0; ?>
                <?php foreach ($faqs_agrupadas as $nombre_categoria => $faqs_de_categoria): ?>
                    
                    <h2 class="trocchi-font mt-4 mb-3"><?php echo $nombre_categoria; ?></h2>
                    
                    <div class="accordion" id="accordion-<?php echo $indice_categoria; ?>">
                        <?php $indice_faq = 0; ?>
                        <?php foreach ($faqs_de_categoria as $faq): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading-<?php echo $indice_categoria . '-' . $indice_faq; ?>">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $indice_categoria . '-' . $indice_faq; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $indice_categoria . '-' . $indice_faq; ?>">
                                        <?php echo $faq['pregunta']; ?>
                                    </button>
                                </h2>
                                <div id="collapse-<?php echo $indice_categoria . '-' . $indice_faq; ?>" class="accordion-collapse collapse" aria-labelledby="heading-<?php echo $indice_categoria . '-' . $indice_faq; ?>" data-bs-parent="#accordion-<?php echo $indice_categoria; ?>">
                                    <div class="accordion-body">
                                        <?php echo nl2br($faq['respuesta']); ?>
                                    </div>
                                </div>
                            </div>
                            <?php $indice_faq++; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php $indice_categoria++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>
