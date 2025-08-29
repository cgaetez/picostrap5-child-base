<?php $result = $args['result']; ?>

<div id="info-base" class="branch-info">
    <div class="text-center p-5">
        <img src="/wp-content/uploads/2022/06/logo-acenor-man.png" class="mb-50" style="width: 150px;">

        <h1 class="fs-big-6 text-center text-primary">
            <span class="clearfix lh-1"><?php echo $result->post_count; ?> sucursales</span><span class="lh-1"> a lo
                largo del país</span>
        </h1>
    </div>
</div>

<?php while($result->have_posts()) : $result->the_post(); ?>
<div id="<?php echo $post->post_name; ?>-info" class="branch-info d-none">
    <?php if(get_field('address_iframe')) : ?>
    <div class="embed-responsive embed-responsive-16by9 mb-2">
        <?php  
          echo get_field('address_iframe');
        ?>
    </div>
    <?php endif; ?>

    <div class="px-3">
        <div>
            <strong>Dirección:</strong>

            <?php if(!get_field('address_text')) : ?>
            PRÓXIMAMENTE
            <?php else : ?>
            <?php //echo get_field('address')['address']; 
            echo get_field('address_text');
          ?>
            <?php endif; ?>
        </div>




        <div>


            <?php if(!get_field('phone')) : ?>

            <?php else : ?>
            <?php $phones = explode('|', get_field('phone')); ?>

            <span>
                <?php foreach($phones as $phone) : ?>
                <i class="fa fa-phone text-warning" aria-hidden="true"></i> <a class="text-decoration-none"
                    href="tel:<?php echo str_replace(' ', '', $phone); ?>"><?php echo $phone; ?></a>
                <?php endforeach; ?>
            </span>
            <?php endif; ?>
        </div>



        <div>
            <?php $branchChief = get_field('branch-chief'); ?>
            <?php if($branchChief['name']) : ?>
            <strong>Jefe de sucursal:</strong>
            <?php echo $branchChief['name']; ?>
            <?php if($branchChief['phone']) : ?>
            / <a href="<?php echo $branchChief['phone']; ?>" class="text-decoration-none"
                aria-label="Teléfono Jefe Sucursal <?php the_title(); ?>"
                title="Teléfono Jefe Sucursal <?php the_title(); ?>"><i class="fa fa-phone text-warning"
                    aria-hidden="true"></i><?php echo $branchChief['phone']; ?></a>
            <?php endif; ?>
            <?php else : ?>

            <?php endif; ?>
        </div>

        <div>
            <strong>Horarios:</strong>

            <?php if(!get_field('timetable')) : ?>
            PRÓXIMAMENTE
            <?php else : ?>
            <?php $timetables = explode('|', get_field('timetable')); ?>

            <ul>
                <?php foreach($timetables as $timetable) : ?>
                <li><?php echo $timetable; ?></li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
        <div class="d-flex gap-4 mb-3">
            <div>


                <?php if(!get_field('whatsapp')) : ?>
                <i class="fa fa-whatsapp text-warning" aria-hidden="true"></i>
                PRÓXIMAMENTE
                <?php else : ?>

                <?php $whatsapps = explode('|', get_field('whatsapp')); ?>
                <?php foreach($whatsapps as $whatsapp) : ?>
                <a href="https://wa.me/<?php echo str_replace('+', '', str_replace(' ', '', $whatsapp)); ?>?text=Hola!"
                    class="text-decoration-none whatsapp" style="">
                    <i class="fa fa-whatsapp fs-5" aria-hidden="true"></i>
                    <span><?php echo $whatsapp; ?></span>
                </a>
                <?php endforeach; ?>
                <?php endif; ?>

            </div>
            <div>
                <a href="tel:+562 2925 9200" class="text-white text-decoration-none callcenter"><i
                        class="fas fa-headset mr-2 text-white"></i> +562 2925 9200</a>
            </div>
        </div>
        <p class="text-center">
            <a href="<?php echo get_permalink(); ?>" class="btn btn-primary">Ver más</a>
        </p>
    </div>
</div>
<?php endwhile; wp_reset_postdata(); ?>