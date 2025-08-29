<?php
  $limit = $args['limit'] ?? null;
?>

<?php
  $query = [
    'post_type' => 'cpt-services',
    'post_status' => 'publish',
    'posts_per_page' => $limit
  ];

  $result = new WP_Query($query);
  $index=1;
?>

<?php if($result->have_posts()) : ?>
  <div class="card-group mb-5 ">
  <?php while($result->have_posts()) : $result->the_post();

 ?>

<div class="card border-secondary minh-400px rounded-0 text-white m-1" style="background-size: cover; background-repeat:no-repeat; background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'image'); ?>')">
  <a href="<?php echo get_the_permalink(); ?>" class="card-body minh-25vh text-center">

</a>

  <div class="card-footer p-3 text-center bg-primary border-top-0 text-white">
    <a href="<?php echo get_the_permalink(); ?>" class="btn btn-outline-light px-5"><?php the_title(); ?></a>
  </div>
</div>

<?php if($index % 3 == 0) : ?>
  <div class="w-100 d-none d-lg-block"></div>
<?php endif; ?>

<?php $index++; ?>


<?php endwhile; ?>
</div>
<?php endif; ?>
