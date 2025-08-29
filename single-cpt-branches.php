<?php

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();




if ( have_posts() ) :
    while ( have_posts() ) : the_post();

    if (get_the_post_thumbnail_url()){
        ?><div class="d-flex container-fluid" style="height:50vh;background:url(<?php echo get_the_post_thumbnail_url(); ?>)  center / cover no-repeat;"></div>
    <?php } else {
        ?><div class="d-flex container-fluid" style="height:20vh;"></div>
    <?php } ?>

    <div class="container-fluid bg-primary">
        <div class="row text-center">
            <div class="col-md-12">
                <h1 class="text-white text-center py-4 font-weight-normal h1">Sucursal <?php the_title(); ?></h1>
            </div><!-- /col -->
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-4">
                  <?php if(get_field('address_iframe')) : ?>
                    <div class="embed-responsive embed-responsive-16by9 mb-2">
                      <?php //acfMakeMap(get_field('address_text')); 
                      echo get_field('address_iframe');
                      ?>
                    </div>
                  <?php endif; ?>
            </div>
            <div class="col-md-8">

                <div class="px-3 fs-5">
                <div>
                  <strong>Dirección:</strong>

                  <?php if(!get_field('address_text')) : ?>
                    PRÓXIMAMENTE
                  <?php else : ?>
                    <?php echo get_field('address_text'); ?>
                  <?php endif; ?>
                </div>

                
				<div>

                  <?php if(!get_field('phone')) : ?>
                   <?php else : ?>
                    <?php $phones = explode('|', get_field('phone')); ?>
					                 

                    <span>
                      <?php foreach($phones as $phone) : ?>
                        <i class="fa fa-phone text-warning" aria-hidden="true"></i><a href="tel:<?php echo str_replace(' ', '', $phone); ?>" class="text-decoration-none"><?php echo $phone; ?></a>
                      <?php endforeach; ?>
                    </span>
                  <?php endif; ?>
                </div>

                <div>
                  <i class="fa fa-envelope-o text-warning" aria-hidden="true"></i>

                  <?php if(!get_field('email')) : ?>
                    PRÓXIMAMENTE
                  <?php else : ?>
                    <?php $emails = explode('|', get_field('email')); ?>

                    <span>
                      <?php foreach($emails as $email) : ?>
                        <a href="mailto:<?php echo $email ?>" class="text-decoration-none"><?php echo $email; ?></a>
                      <?php endforeach; ?>
                    </span>
                  <?php endif; ?>
                </div>

                

                <div>
                  <strong>Jefe de sucursal:</strong>

                  <?php $branchChief = get_field('branch-chief'); ?>

                  <?php if(!$branchChief['name']) : ?>
                    PRÓXIMAMENTE
                  <?php else : ?>
                    <?php echo $branchChief['name']; ?>
                  <?php endif; ?>
                </div>
				<?php if($branchChief['phone']) : ?>
					<div>
						<i class="fa fa-phone text-warning" aria-hidden="true"></i>
						<a class="text-decoration-none" href="tel:<?php echo $branchChief['phone'];  ?>"><?php echo $branchChief['phone']; ?></a>

					</div>
					<?php endif; ?>
					
					

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






            </div><!-- /col -->
            <div class="d-flex gap-4">
              <div>
                  <?php if(!get_field('whatsapp')) : ?>
                    <i class="fa fa-whatsapp text-warning" aria-hidden="true"></i>
                    PRÓXIMAMENTE
                  <?php else : ?>

                    <?php $whatsapps = explode('|', get_field('whatsapp')); ?>
                    <?php foreach($whatsapps as $whatsapp) : ?>
                    <a href="https://wa.me/<?php echo str_replace('+', '', str_replace(' ', '', $whatsapp)); ?>?text=Hola!" class="text-decoration-none whatsapp" style="">
                          <i class="fa fa-whatsapp fs-5" aria-hidden="true"></i>
                          <span><?php echo $whatsapp; ?></span>
                    </a>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div>
                <a href="tel:+56229259200" class="text-white text-decoration-none callcenter"><i class="fas fa-headset mr-2 text-white"></i> +562 2925 9200</a>
                </div>
            </div>
        </div>
    </div>
  <?php if(get_field('modal')){ ?>
    <div class="modal fade" tabindex="-1" id="modal-sucursal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-body">
            <?php echo get_field('modal');  ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>

<?php
    endwhile;
 else :
     _e( 'Sorry, no posts matched your criteria.', 'picostrap' );
 endif;
 ?>




<?php get_footer();
