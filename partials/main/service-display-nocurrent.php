<?php
  $limit = $args['limit'] ?? null;
  $current = get_the_ID();
  $colors = array(0=>'bg-primary', 1=>'bg-warning', 2=>'bg-secondary');
?>

<?php
  $query = [
    'post_type' => 'cpt-services',
    'post_status' => 'publish',
    'posts_per_page' => $limit
  ];

  $result = new WP_Query($query);
?>
<div class="d-flex flex-wrap justify-content-center justify-content-lg-center ">
  <?php if($result->have_posts()) : $i=0; ?>
    <?php while($result->have_posts()) : $result->the_post(); ?>
      <?php if(get_the_ID() != $current) : ?>
        <div class="mx-2 text-center mt-2 mt-lg-0">
            <a href="<?php echo get_the_permalink(); ?>" class="lh-1 py-4 px-3 btn  btn-circle btn-xl  text-white text-uppercase fs-5   <?php echo $colors[$i]; ?>">
              <?php the_title(); ?>
            </a>
        </div>
      <?php endif; ?>

      <?php
        $i++;

        if($i==3) {
          $i=0;
        }
      ?>
    <?php endwhile; wp_reset_postdata(); ?>
  <?php endif; ?>
</div>
