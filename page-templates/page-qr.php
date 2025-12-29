<?php
/**
 * Template Name: ACENOR QR Landing
 */
get_header();
?>

<div id="bg-white">
    <main class="py-4 py-md-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">

                    <!-- Header / Intro -->
                    <div class="row align-items-center mt-3 mb-5">
                        <div class="col-3">
                            <?php if(get_field('logo')): ?>
                            <img src="<?php echo get_field('logo'); ?>" alt="Logo" class="w-75">
                            <?php endif; ?>
                        </div>

                        <div class="col">
                            <h1 class="display-3 fw-bold mb-2 text-uppercase">
                                <?php echo get_field('titulo'); ?>
                            </h1>

                            <p class="mb-0 fs-1">
                                <?php echo get_field('subtitulo'); ?>
                            </p>
                        </div>
                    </div>


                    <!-- ITEMS QR (REPEATER) -->
                    <?php if(have_rows('items_qr')): ?>
                    <?php while(have_rows('items_qr')): the_row(); ?>

                    <?php
                                $icono = get_sub_field('icono');
                                $titulo = get_sub_field('titulo_item');
                                $texto = get_sub_field('descripcion_item');
                                $url = get_sub_field('url_item'); // CAMPO TEXTO
                            ?>

                    <a href="<?php echo $url; ?>" class="text-decoration-none my-5 d-block">
                        <div class="row g-0 rounded-3 shadow-sm mb-3 overflow-hidden">

                            <!-- ICONO -->
                            <div class="col-3 col-md-2 bg-primary d-flex align-items-center justify-content-center p-4">
                                <?php if($icono): ?>
                                <img src="<?php echo $icono; ?>" alt="<?php echo $titulo; ?>" class="w-75">
                                <?php endif; ?>
                            </div>

                            <!-- TEXTO -->
                            <div class="col-9 col-md-10 bg-light py-3 px-2 text-center">
                                <div class="fw-bold display-3"><?php echo $titulo; ?></div>
                                <div class="fs-2"><?php echo $texto; ?></div>
                            </div>

                        </div>
                    </a>

                    <?php endwhile; ?>
                    <?php endif; ?>


                    <!-- HORARIO FINAL -->
                    <div class="text-center text-muted fs-1 my-5 d-block mt-5">
                        <div class="fw-semibold mt-2">
                            <?php echo get_field('horario'); ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>


<style>
#wrapper-navbar,
#wrapper-footer-widgets,
#wrapper-topbar,
#wrapper-footer-colophon {
    display: none !important;
}

#bg-white {
    background-color: #fff !important;
    min-height: 100vh;
}

.rounded-3 {
    border-radius: 1rem !important;
}
</style>

<?php get_footer(); ?>