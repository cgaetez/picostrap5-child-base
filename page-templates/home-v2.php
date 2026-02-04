<?php
/**
 * Template Name: Home V2
 * Template Post Type: page
 * Description: Plantilla de la nueva portada
 */
if ( ! defined('ABSPATH') ) exit;
get_header('homev2'); ?>

<main id="primary" class="site-main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); the_content(); endwhile; endif; ?>

  <?php
  // --- Hero ---c
  $hero    = get_field('hero');                          // ID o array
  $hero_id = is_array($hero) ? ($hero['ID'] ?? 0) : (int) $hero;
  ?>
<section class="hero">
  <?php
  $hero       = get_field('hero');         // ID o array
  $hero_m     = get_field('hero_mobile');  // ID o array
  $hero_id    = is_array($hero)   ? ($hero['ID'] ?? 0)   : (int) $hero;
  $hero_m_id  = is_array($hero_m) ? ($hero_m['ID'] ?? 0) : (int) $hero_m;
  $alt_id     = $hero_id ?: $hero_m_id;
  $alt        = $alt_id ? get_post_meta($alt_id, '_wp_attachment_image_alt', true) : '';
  ?>
  <picture class="hero__picture">
    <?php if ($hero_m_id): ?>
      <source media="(max-width: 768px)"
              srcset="<?= esc_url( wp_get_attachment_image_url($hero_m_id, 'hero-mobile') ?: wp_get_attachment_image_url($hero_m_id, 'full') ); ?>">
    <?php endif; ?>
    <?= $hero_id
      ? wp_get_attachment_image($hero_id, 'hero-1920', false, ['class'=>'hero__img','alt'=>$alt,'loading'=>'eager','decoding'=>'async'])
      : ($hero_m_id ? wp_get_attachment_image($hero_m_id, 'hero-1920', false, ['class'=>'hero__img','alt'=>$alt,'loading'=>'eager','decoding'=>'async']) : ''); ?>
  </picture>
</section>


  <?php get_template_part('partials/main/cta-bar'); ?>

  <?php
  $page_id  = get_queried_object_id();
  $title    = get_field('home_cats_title', $page_id) ?: 'Productos de Acero';
  $subtitle = get_field('home_cats_subtitle', $page_id) ?: 'Conoce nuestras categorías';

  $raw     = get_field('home_cats', $page_id);
  $include = is_array($raw) ? array_map('intval', $raw) : [];
  $exclude_ids = [412];

  if (!empty($include)) {
    $terms = get_terms([
      'taxonomy'   => 'product_cat',
      'include'    => $include,
      'orderby'    => 'include',   // respeta orden elegido en ACF
      'hide_empty' => false,
    ]);
  } else {

    $terms = get_terms([
      'taxonomy'   => 'product_cat',
      'parent'     => 0,
      'exclude'    => $exclude_ids,
      'hide_empty' => false,
      'number'     => 12,
      'orderby'    => 'menu_order',
    ]);
  }

  $terms = array_slice((array) $terms, 0, 11);
  $row1  = array_slice($terms, 0, 6);
  $row2  = array_slice($terms, 6, 5);
  ?>

  <section class="homev2-cats container">
    <h1><?= esc_html($title); ?></h1>
    <p><?= esc_html($subtitle); ?></p>

    <!-- Fila 1: 6 -->
    <ul class="cats-row cats-row--top">
      <?php foreach ($row1 as $term):
        if (!$term || is_wp_error($term)) continue;
        $thumb_id = (int) get_term_meta($term->term_id, 'thumbnail_id', true);
        $link     = get_term_link($term);
      ?>
        <li class="homev2-cats__item">
          <a class="circle" href="<?= esc_url($link); ?>" aria-label="<?= esc_attr($term->name); ?>">
            <?= $thumb_id
              ? wp_get_attachment_image($thumb_id, 'medium', false, ['class'=>'circle__img','loading'=>'lazy'])
              : '<span class="circle__placeholder" aria-hidden="true"></span>'; ?>
            <span class="circle__label"><?= esc_html($term->name); ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

    <!-- Fila 2: 5 (centrada) -->
    <?php if (!empty($row2)): ?>
      <ul class="cats-row cats-row--bottom">
        <?php foreach ($row2 as $term):
          if (!$term || is_wp_error($term)) continue;
          $thumb_id = (int) get_term_meta($term->term_id, 'thumbnail_id', true);
          $link     = get_term_link($term);
        ?>
          <li class="homev2-cats__item">
            <a class="circle" href="<?= esc_url($link); ?>" aria-label="<?= esc_attr($term->name); ?>">
              <?= $thumb_id
                ? wp_get_attachment_image($thumb_id, 'medium', false, ['class'=>'circle__img','loading'=>'lazy'])
                : '<span class="circle__placeholder" aria-hidden="true"></span>'; ?>
              <span class="circle__label"><?= esc_html($term->name); ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  <!-- MOBILE: slider -->
<div class="only-mobile section-circles">
  <div class="splide js-cats-splide" aria-label="Productos de Acero">
    <div class="splide__track">
      <ul class="splide__list">
        <?php foreach ($terms as $term):
          if (!$term || is_wp_error($term)) continue;
          $thumb_id = (int) get_term_meta($term->term_id, 'thumbnail_id', true);
          $link     = get_term_link($term);
        ?>
          <li class="splide__slide">
            <a class="circle" href="<?= esc_url($link); ?>">
              <?= $thumb_id
                  ? wp_get_attachment_image($thumb_id,'medium',false,['class'=>'circle__img','loading'=>'lazy'])
                  : '<span class="circle__placeholder"></span>'; ?>
              <span class="circle__label"><?= esc_html($term->name); ?></span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<div class="only-desktop">
  <?= /* */ '' ?>
</div>

  </section>
  
  <?php
$page_id = get_queried_object_id();

$stitle = get_field('home_services_title', $page_id) ?: 'Servicios';
$ssub   = get_field('home_services_subtitle', $page_id) ?: 'Contamos con gran variedad de servicios';

$sel = (array) get_field('home_services', $page_id);      // array de IDs
$sel = array_values(array_unique(array_map('intval', $sel)));
// $sel = array_slice($sel, 0, 4);                           // límite 4

$service_posts = [];
foreach ($sel as $id) { if ($p = get_post($id)) $service_posts[] = $p; }

if ($service_posts): ?>
<section class="homev2-services section--muted">
  <div class="container">
    <h2><?= esc_html($stitle); ?></h2>
    <p class="homev2-services__sub"><?= esc_html($ssub); ?></p>

    <ul class="services-grid">
      <?php foreach ($service_posts as $sp):
        $thumb_id = get_post_thumbnail_id($sp->ID);
        $url      = get_permalink($sp->ID);
        $title    = get_the_title($sp->ID);
      ?>
      <li class="services-item">
        <a class="circle" href="<?= esc_url($url); ?>" aria-label="<?= esc_attr($title); ?>">
          <?= $thumb_id
            ? wp_get_attachment_image($thumb_id, 'medium', false, ['class'=>'dcircle__img','loading'=>'lazy'])
            : '<span class="circle__placeholder" aria-hidden="true"></span>'; ?>
          <span class="circle__label"><?= esc_html($title); ?></span>
        </a>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <!-- MOBILE: slider -->
<div class="only-mobile section-circles">
  <div class="splide js-services-splide" aria-label="Servicios">
    <div class="splide__track">
      <ul class="splide__list">
        <?php foreach ($service_posts as $sp):
          $thumb_id = get_post_thumbnail_id($sp->ID);
          $url      = get_permalink($sp->ID);
          $title    = get_the_title($sp->ID);
        ?>
        <li class="splide__slide">
          <a class="circle" href="<?= esc_url($url); ?>" aria-label="<?= esc_attr($title); ?>">
            <?= $thumb_id
                ? wp_get_attachment_image($thumb_id, 'medium', false, ['class'=>'circle__img','loading'=>'lazy'])
                : '<span class="circle__placeholder"></span>'; ?>
            <span class="circle__label"><?= esc_html($title); ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<div class="only-desktop">
</div>

</section>
<!--nueva sección servicios complementarios-->
<?php
$sc_title = get_field('servicios-complementarios-titulo', $page_id) ?: '';

$sc_items = [];
for ($i = 1; $i <= 4; $i++) {
  $g = get_field("servicios-complementarios-{$i}", $page_id);
  if (!is_array($g)) continue;

  $icon_raw = $g['icon'] ?? null;
  $title    = trim((string)($g['title'] ?? ''));
  $desc     = trim((string)($g['desc']  ?? ''));
  $url      = trim((string)($g['url']   ?? ''));

  $sc_items[] = compact('icon_raw','title','desc','url');
}
?>

<?php if (!empty($sc_items)): ?>
<section class="homev2-quicklinks homev2-quicklinks--sc">
  <div class="container">
    <?php if ($sc_title): ?><h2 class="ql-title"><?= esc_html($sc_title); ?></h2><?php endif; ?>

    <ul class="ql-grid">
      <?php foreach ($sc_items as $idx => $it): ?>
      <li class="ql-item">
  <?php
  $raw  = trim((string) $it['url']);
  $href = '';

  if ($raw !== '') {
    if (stripos($raw, 'tel:') === 0) {
      $num  = preg_replace('/[^\d\+]/', '', substr($raw, 4));
      $href = 'tel:' . $num;
    } elseif (preg_match('/^\+?[0-9\s\-\(\)]+$/', $raw)) {
      $num  = preg_replace('/[^\d\+]/', '', $raw);
      $href = 'tel:' . $num;
    } else {
      $href = $raw;
    }
  }
  ?>

  <?= $href
    ? '<a class="ql-card" href="'.esc_url($href, ['http','https','tel','mailto']).'">'
    : '<div class="ql-card">'; ?>

          <div class="ql-icon">
            <?php
            $icon    = $it['icon_raw'];
            $printed = false;

            $aid = null; $url = null; $dash = null; $html = null;

            if (is_array($icon)) {
              if (!empty($icon['type']) && $icon['type'] === 'media_library' && !empty($icon['value'])) {
                $aid = (int) $icon['value'];
              } elseif (!empty($icon['ID']) || !empty($icon['id'])) {
                $aid = (int)($icon['ID'] ?? $icon['id']);
              }
              if (!$aid && !empty($icon['url'])) $url = $icon['url'];
              if (!empty($icon['class']) && strpos($icon['class'], 'dashicons-') === 0) $dash = $icon['class'];
              if (!empty($icon['html'])) $html = $icon['html'];

            } elseif (is_numeric($icon)) {
              $aid = (int) $icon;

            } elseif (is_string($icon)) {
              $v = trim($icon);
              if (filter_var($v, FILTER_VALIDATE_URL)) $url = $v;
              elseif (strpos($v, 'dashicons-') === 0)   $dash = $v;
              elseif (stripos($v, '<svg') !== false)    $html = $v;
            }

            if ($aid) {
              $mime = get_post_mime_type($aid);
              if ($mime === 'image/svg+xml') {
                echo '<img class="ql-icon__img" src="'.esc_url(wp_get_attachment_url($aid)).'" alt="" width="48" height="48" loading="lazy" decoding="async">';
              } else {
                echo wp_get_attachment_image($aid, 'thumbnail', false, [
                  'class'    => 'ql-icon__img',
                  'loading'  => 'lazy',
                  'decoding' => 'async',
                ]);
              }
              $printed = true;

            } elseif ($url) {
              echo '<img class="ql-icon__img" src="'.esc_url($url).'" alt="" width="48" height="48" loading="lazy" decoding="async">';
              $printed = true;

            } elseif ($html) {
              echo wp_kses($html, [
                'svg'  => ['class'=>[], 'width'=>[], 'height'=>[], 'viewBox'=>[], 'fill'=>[], 'xmlns'=>[], 'aria-hidden'=>[]],
                'path' => ['d'=>[], 'fill'=>[]],
                'use'  => ['href'=>[]],
                'span' => ['class'=>[], 'aria-hidden'=>[]],
                'i'    => ['class'=>[]],
              ]);
              $printed = true;

            } elseif ($dash) {
              echo '<span class="dashicons '.esc_attr($dash).'" aria-hidden="true"></span>';
              $printed = true;
            }

            if (!$printed) echo '<span class="ql-icon__ph"></span>';
            ?>
          </div>

          <?php if (!empty($it['title'])): ?><h3 class="ql-h3"><?= esc_html($it['title']); ?></h3><?php endif; ?>
          <?php if (!empty($it['desc'])):  ?><p class="ql-desc"><?= esc_html($it['desc']); ?></p><?php endif; ?>

        <?= $href ? '</a>' : '</div>'; ?>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>

<!--fin nueva sección-->
<div class="container-fluid my-5 py-3" id="home-sucursales">
  <h2 class="h2-center">Sucursales
    
  </h2>

  <div class="border">
    <?php get_template_part("partials/main/branches-map"); ?>
  </div>
</div>
<?php endif; ?>
<?php
$page_id = get_queried_object_id();

$ftitle = get_field('home_feat_title', $page_id) ?: 'Productos destacados del mes';
$fsub   = get_field('home_feat_subtitle', $page_id) ?: 'Conoce nuestros productos destacados';
$limit  = (int) (get_field('home_feat_limit', $page_id) ?: 12);
$fill   = (bool) get_field('home_feat_fill_with_featured', $page_id); 

$manual_ids = array_values(array_unique(array_map('intval', (array) get_field('home_feat_products', $page_id))));
$ids = $manual_ids;

$need = max(0, $limit - count($ids));
if (($fill || empty($ids)) && $need > 0) {
  $auto_ids = wc_get_products([
    'status'   => 'publish',
    'featured' => true,
    'exclude'  => $ids,
    'limit'    => $need,
    'return'   => 'ids',
    'orderby'  => 'date',
    'order'    => 'DESC',
  ]);
  $ids = array_merge($ids, $auto_ids);
}

if (empty($ids)) {
  $ids = wc_get_products([
    'status'  => 'publish',
    'limit'   => $limit,
    'return'  => 'ids',
    'orderby' => 'date',
    'order'   => 'DESC',
  ]);
}

$ids = array_slice($ids, 0, $limit);

$products = wc_get_products([
  'include' => $ids,
  'limit'   => count($ids),
  'orderby' => 'post__in',
]);
?>

<section class="homev2-featured container">
  <h2><?= esc_html($ftitle); ?></h2>
  <p class="sub"><?= esc_html($fsub); ?></p>

  <div class="splide" aria-label="Productos destacados">
    <div class="splide__track">
      <ul class="splide__list">
        <?php foreach ($products as $p):
          $pid   = $p->get_id();
          $url   = $p->get_permalink();
          $title = $p->get_name();
          $price = $p->get_price_html();
        ?>
        <li class="splide__slide">
          <article class="feat-card">
            <a class="feat-card__media" href="<?= esc_url($url); ?>">
              <?= get_the_post_thumbnail($pid, 'medium_large', ['loading'=>'lazy']); ?>
            </a>
            <div class="feat-card__body">
              <h3 class="feat-card__title"><?= esc_html($title); ?></h3>
              <?php if ($price): ?><div class="price"><?= $price; ?></div><?php endif; ?>
              <a class="btn btn--primary featured-button" href="<?= esc_url($url); ?>">Ver Producto</a>
            </div>
          </article>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
<?php
$page_id = get_queried_object_id();

$title  = get_field('about_title', $page_id) ?: 'Nuestra Empresa';
$body   = get_field('about_body',  $page_id);            // texto largo
$img    = get_field('about_image', $page_id);           // ID o array
$img_id = is_array($img) ? ($img['ID'] ?? 0) : (int) $img;

if ( $body || $img_id ): ?>
<section class="homev2-about">
  <div class="container">
    <div class="about-box">
      <div class="about-grid">
        <div class="about-text">
          <h2><?= esc_html($title); ?></h2>
          <div class="about-copy">
            <?= wp_kses_post( wpautop( $body ) ); ?>
          </div>
          <?php /* 
          $cta_txt = get_field('about_cta_label', $page_id);
          $cta_url = get_field('about_cta_url',   $page_id);
          if ($cta_txt && $cta_url): ?>
            <a class="btn btn--primary" href="<?= esc_url($cta_url); ?>"><?= esc_html($cta_txt); ?></a>
          <?php endif; */ ?>
        </div>

        <div class="about-media">
          <?php if ($img_id) {
            echo wp_get_attachment_image($img_id, 'large', false, [
              'class'    => 'about-img',
              'loading'  => 'lazy',
              'decoding' => 'async',
            ]);
          } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php
$banner_msg = get_field('cta_banner_msg');
get_template_part('partials/main/cta-bar', null, [
  'variant' => 'banner',
  'message' => $banner_msg,
]);
?>
<?php
$page_id  = get_queried_object_id();
$ql_title = get_field('quick_title', $page_id) ?: '';

$items = [];
for ($i = 1; $i <= 4; $i++) {
  $g = get_field("quick_item_{$i}", $page_id);
  if (!is_array($g)) continue;

  $icon_raw = $g['icon'] ?? null; 
  $title    = trim((string)($g['title'] ?? ''));
  $desc     = trim((string)($g['desc']  ?? ''));
  $url      = trim((string)($g['url']   ?? ''));

  $items[] = compact('icon_raw','title','desc','url');
}
?>

<?php if (!empty($items)): ?>
<section class="homev2-quicklinks">
  <div class="container">
    <?php if ($ql_title): ?><h2 class="ql-title"><?= esc_html($ql_title); ?></h2><?php endif; ?>

    <ul class="ql-grid">
      <?php foreach ($items as $idx => $it): ?>
      <li class="ql-item">
        <?= $it['url'] ? '<a class="ql-card" href="'.esc_url($it['url']).'">' : '<div class="ql-card">'; ?>

<div class="ql-icon">
<?php
$icon = $it['icon_raw'];
$printed = false;

// Normalizar a: $aid (adjunto), $url (imagen), $dash (clase), $html (markup)
$aid = null; $url = null; $dash = null; $html = null;

if (is_array($icon)) {
  // ACF: media library {type: media_library, value: ID}
  if (!empty($icon['type']) && $icon['type'] === 'media_library' && !empty($icon['value'])) {
    $aid = (int) $icon['value'];
  } elseif (!empty($icon['ID']) || !empty($icon['id'])) {
    $aid = (int)($icon['ID'] ?? $icon['id']);
  }
  if (!$aid && !empty($icon['url'])) $url = $icon['url'];
  if (!empty($icon['class']) && strpos($icon['class'], 'dashicons-') === 0) $dash = $icon['class'];
  if (!empty($icon['html'])) $html = $icon['html'];

} elseif (is_numeric($icon)) {
  $aid = (int) $icon;

} elseif (is_string($icon)) {
  $v = trim($icon);
  if (filter_var($v, FILTER_VALIDATE_URL)) $url = $v;
  elseif (strpos($v, 'dashicons-') === 0)   $dash = $v;
  elseif (stripos($v, '<svg') !== false)    $html = $v;
}

// Pintar según lo que tengamos
if ($aid) {
  $mime = get_post_mime_type($aid);
  if ($mime === 'image/svg+xml') {
    echo '<img class="ql-icon__img" src="'.esc_url(wp_get_attachment_url($aid)).'" alt="" width="48" height="48" loading="lazy" decoding="async">';
  } else {
    echo wp_get_attachment_image($aid, 'thumbnail', false, [
      'class'    => 'ql-icon__img',
      'loading'  => 'lazy',
      'decoding' => 'async',
    ]);
  }
  $printed = true;

} elseif ($url) {
  echo '<img class="ql-icon__img" src="'.esc_url($url).'" alt="" width="48" height="48" loading="lazy" decoding="async">';
  $printed = true;

} elseif ($html) {
  // permite SVG/markup básico
  echo wp_kses($html, [
    'svg'  => ['class'=>[], 'width'=>[], 'height'=>[], 'viewBox'=>[], 'fill'=>[], 'xmlns'=>[], 'aria-hidden'=>[]],
    'path' => ['d'=>[], 'fill'=>[]],
    'use'  => ['href'=>[]],
    'span' => ['class'=>[], 'aria-hidden'=>[]],
    'i'    => ['class'=>[]],
  ]);
  $printed = true;

} elseif ($dash) {
  echo '<span class="dashicons '.esc_attr($dash).'" aria-hidden="true"></span>';
  $printed = true;
}

if (!$printed) echo '<span class="ql-icon__ph"></span>';
?>
</div>

          <?php if (!empty($it['title'])): ?><h3 class="ql-h3"><?= esc_html($it['title']); ?></h3><?php endif; ?>
          <?php if (!empty($it['desc'])):  ?><p class="ql-desc"><?= esc_html($it['desc']); ?></p><?php endif; ?>

        <?= $it['url'] ? '</a>' : '</div>'; ?>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
<?php endif; ?>



</main>

<style>
  .hero__picture, .hero__img { display:block; width:100%; height:auto; }

/* Contenedor y títulos */
.homev2-cats { text-align:center; padding:40px 0; }
.homev2-cats h2 { margin-bottom:6px; }
.homev2-cats p  { margin:0 0 26px; color:#6b7280; }

.cats-row{
  display:grid;
  gap: 32px 26px;
  justify-content: center; 
  margin-bottom: 22px;
}

.cats-row--top    { grid-template-columns: repeat(6, 160px); }
.cats-row--bottom { grid-template-columns: repeat(5, 160px); }

.homev2-cats__item { list-style:none; width:160px; }

.circle{ display:flex; flex-direction:column; align-items:center; text-decoration:none; }
.circle__img, .circle__placeholder{
  width:130px; height:130px; border-radius:50%; object-fit:cover; display:block;
  box-shadow: 0 6px 18px rgba(0,0,0,.10), 0 0 0 14px #fff; margin-bottom: 10px;
}
.circle__placeholder{ background:#e5e7eb; }
.circle__label{ margin-top:12px; font-weight:600; color:#111827; line-height:1.2; }

.circle:hover .circle__img{ transform: translateY(-2px); transition: transform .15s ease; }


@media (max-width: 1200px){
  .cats-row--top    { grid-template-columns: repeat(5, 140px); }
  .cats-row--bottom { grid-template-columns: repeat(4, 140px); }
}
@media (max-width: 992px){
  .cats-row--top,
  .cats-row--bottom { grid-template-columns: repeat(3, 140px); }
}
@media (max-width: 800px){ 
   .cats-row--top,
  .cats-row--bottom  { display:none !important; }
}
@media (max-width: 620px){
  .cats-row--top,
  .cats-row--bottom { grid-template-columns: repeat(2, 140px); }
}
/* Sección Servicios */
.section--muted { background:#E6EBEF80; padding:40px 0 48px; }
.homev2-services h2 { text-align:center; margin:0 0 6px; }
.homev2-services__sub { text-align:center; margin:0 0 28px; color:#6b7280; }

.services-grid {
  display:grid;
  grid-template-columns: repeat(4, 220px);
  gap: 34px 36px;
  justify-content:center;  
}

.services-item { list-style:none; width:180px; }

.circle{ display:flex; flex-direction:column; align-items:center; text-decoration:none; }
.dcircle__img, .circle__placeholder{
  width:160px; height:160px; border-radius:50%; object-fit:cover; display:block;
  box-shadow: 0 6px 18px rgba(0,0,0,.10), 0 0 0 14px #fff; margin-bottom: 10px; 
}
.circle__placeholder{ background:#e5e7eb; }
.circle__label{ margin-top:12px; font-weight:600; color:#111827; line-height:1.2; }
.circle:hover .dcircle__img{ transform:translateY(-2px); transition:transform .15s ease; }

@media (max-width: 1100px){
  .services-grid { grid-template-columns: repeat(3, 180px); }
}
@media (max-width: 800px){
  .services-grid { grid-template-columns: repeat(2, 170px); }
}
@media (max-width: 520px){
  .services-grid { grid-template-columns: repeat(2, 150px); gap: 28px 22px; }
  .services-item { width:150px; }
  .dcircle__img, .circle__placeholder{ width:120px; height:120px; box-shadow: 0 5px 16px rgba(0,0,0,.10), 0 0 0 12px #fff; }
}
.h2-center{
  text-align: center; 
  margin-bottom: 40px;
}
/* destacados */
.homev2-featured { padding: 32px 0 40px; text-align:center; }
.homev2-featured .sub { margin: 6px 0 20px; color:#6b7280; }

.feat-grid {
  display:grid; gap:20px;
  grid-template-columns: repeat(4, minmax(0,1fr));
}
@media (max-width:1100px){ .feat-grid{ grid-template-columns:repeat(3,1fr);} }
@media (max-width:800px){ .feat-grid{ grid-template-columns:repeat(2,1fr);} }
@media (max-width:520px){ .feat-grid{ grid-template-columns:1fr;} .homev2-featured{padding-left: 20px; padding-right: 20px}}

.feat-card { background:#fff; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,.06); overflow:hidden; display:flex; flex-direction:column; }
.feat-card__media img { width:100%; height:190px; object-fit:cover; display:block; }
.feat-card__body { padding:12px; display:flex; flex-direction:column; gap:10px; }
.feat-card__title { font-size:14px; line-height:1.25; min-height:36px; margin:0; }
.price { color:#0b3a66; font-weight:700; }
.feat-card { background:#fff; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,.06); overflow:hidden; display:flex; flex-direction:column; }
.feat-card__media img { width:100%; height:190px; object-fit:cover; display:block; }
.feat-card__body { padding:12px; display:flex; flex-direction:column; gap:10px; }
.feat-card__title { font-size:14px; line-height:1.25; min-height:36px; margin:0; }
.price { color:#0b3a66; font-weight:700; }

.homev2-featured .splide { position: relative; padding-bottom: 44px; }
.homev2-featured .splide__pagination {
  position: absolute; left: 0; right: auto; bottom: 0;
  justify-content: flex-start;
}
.homev2-featured .splide__arrows {
  position: absolute; right: 0; bottom: 0; display: flex; gap: 8px;
}
.homev2-featured .splide__arrow {
  position: static; transform:none; width:36px; height:36px;
  border-radius:8px; background:#fff; border:1px solid #d1d5db;
  color:#111;
}
.featured-button{
  background-color: #093866;
  color: #fff; 
}
.featured-button:hover{
  color: #fff; 
}

/* Sección “Nuestra Empresa” */
.homev2-about { background:#0b3a66; padding:48px 0; color:#fff; }

.homev2-about .about-box{
  background:#0b3a66;
  border-radius:12px;
  padding:28px;
}

.about-grid{
  display:grid;
  grid-template-columns: 1.2fr 1fr;
  gap: 80px;
  align-items:center;
}


.about-text h2{ margin:0 0 12px; font-size: 44px}
.about-copy p{ margin:0 0 10px; color:#e6eef7; }

.about-img{
  width:100%;
  height:auto;
  max-height:360px;
  object-fit:cover;
  border-radius:12px;
  display:block;
}


@media (max-width: 992px){
  .about-grid{ grid-template-columns:1fr; }
  .about-img{ max-height:none; }
}

/* quick links */
.homev2-quicklinks { position: relative; background:#fff; padding:60px 20px; }
.homev2-quicklinks::before{ top:0; }
.homev2-quicklinks::after{ bottom:0; }

.ql-title{ text-align:center; margin:0 0 18px; }

.ql-grid{
  display:grid; grid-template-columns:repeat(4, minmax(0,1fr)); gap: 32px; 
  justify-items:center; align-items:start;
}
@media (max-width: 1024px){ .ql-grid{ grid-template-columns:repeat(2,1fr); } }
@media (max-width: 520px){  .ql-grid{ grid-template-columns:1fr; } }

.ql-item{ list-style:none; width:100%; max-width:260px; }
.ql-card{ display:flex; flex-direction:column; align-items:center; text-align:center; text-decoration:none; color:inherit; }
.ql-card:hover .ql-h3{ text-decoration:underline; }

.ql-icon{
  width:54px; height:54px; border-radius:10px; background:#f2c116;
  display:flex; align-items:center; justify-content:center; margin:0 auto 10px;
}
.ql-icon img{ width:28px; height:28px; object-fit:contain; display:block; }
.ql-icon__ph{ width:20px; height:20px; background:#fff; border-radius:4px; opacity:.5; }

.ql-h3{ font-size:16px; font-weight:700; margin:8px 0 6px; }
.ql-desc{ font-size:13px; color:#4b5563; margin:0; line-height:1.45; }

.only-mobile  { display:none; }
.only-desktop { display:block; }
@media (max-width: 768px){
  .only-mobile  { display:block; }
  .only-desktop { display:none; }
}

.splide .circle{ display:flex; flex-direction:column; align-items:center; text-decoration:none; }
.splide .circle__img, .splide .circle__placeholder{
  width:112px; height:112px; border-radius:50%; object-fit:cover; display:block;
  box-shadow: 0 6px 18px rgba(0,0,0,.10), 0 0 0 14px #fff;
}
.splide .circle__label{ margin-top:10px; font-weight:600; text-align:center; max-width:140px; color:#111827; }

.section-circles .splide { position:relative; padding-bottom:40px; }
.section-circles .splide__pagination{ position:absolute; left:0; bottom:0; justify-content:flex-start; }
.section-circles .splide__arrows{ position:absolute; right:0; bottom:0; display:flex; gap:8px; }
.section-circles .splide__arrow{ position:static; transform:none; width:36px; height:36px; border-radius:8px; background:#fff; border:1px solid #d1d5db; }
.only-mobile  { display:none; }
.only-desktop { display:block; }
@media (max-width: 768px){
  .only-mobile { display:block; }
  .only-desktop{ display:none; }
}

.circle{ display:flex; flex-direction:column; align-items:center; text-decoration:none; }
.circle__img, .circle__placeholder{
  width:112px; height:112px; border-radius:50%; object-fit:cover; display:block;
  box-shadow: 0 6px 18px rgba(0,0,0,.10), 0 0 0 14px #fff;
}
.circle__label{ margin-top:10px; font-weight:600; text-align:center; max-width:140px; color:#111827; }
/*servicios complementarios*/
.homev2-quicklinks--sc{
  background:#111827; 
  color:#f2c116;  
}

.homev2-quicklinks--sc .ql-title,
.homev2-quicklinks--sc .ql-h3,
.homev2-quicklinks--sc .ql-desc{
  color:#f2c116;
}


.homev2-quicklinks--sc .ql-icon img{
  /* si quieres, aquí podrías forzar un filtro, pero normalmente la imagen ya viene correcta */
}

/* CATEGORÍAS GRID (desktop) */
.homev2-cats { text-align:center; padding:40px 0; }
.homev2-cats h2{ margin-bottom:6px; }
.homev2-cats p { margin:0 0 26px; color:#6b7280; }
.cats-row{ display:grid; gap:32px 26px; justify-content:center; margin-bottom:22px; }
.cats-row--top    { grid-template-columns:repeat(6,160px); }
.cats-row--bottom { grid-template-columns:repeat(5,160px); }
.homev2-cats__item{ list-style:none; width:160px; }
@media (max-width:1200px){
  .cats-row--top{ grid-template-columns:repeat(5,140px); }
  .cats-row--bottom{ grid-template-columns:repeat(4,140px); }
}
@media (max-width:992px){
  .cats-row--top, .cats-row--bottom{ grid-template-columns:repeat(3,140px); }
}
@media (max-width:620px){
  .cats-row--top, .cats-row--bottom{ grid-template-columns:repeat(2,140px); }
  .homev2-quicklinks .container{max-width: 100% !important; }
  .homev2-quicklinks .container .ql-grid{padding-left: 0 !important; }
}

/* SERVICIOS GRID (desktop) */
.section--muted { background:#E6EBEF80; padding:40px 0 48px; }
.homev2-services h2{ text-align:center; margin:0 0 6px; }
.homev2-services__sub{ text-align:center; margin:0 0 28px; color:#6b7280; }
.services-grid{ display:grid; grid-template-columns:repeat(4, 200px); gap: 34px 36px; justify-content:center; }
.services-item{ list-style:none; width:200px; }
@media (max-width:1100px){ .services-grid{ grid-template-columns:repeat(3, 180px); } }
@media (max-width:800px){  .services-grid{ grid-template-columns:repeat(2, 170px); display:none; } }

.section-circles .splide{ position:relative; padding-bottom:40px; }
.section-circles .splide__pagination{
  position:absolute; left:0; bottom:0; justify-content:flex-start;
}
.section-circles .splide__arrows{
  position:absolute; right:0; bottom:0; display:flex; gap:8px;
}
.section-circles .splide__arrow{
  position:static; transform:none; width:36px; height:36px;
  border-radius:8px; background:#fff; border:1px solid #d1d5db; color:#111;
}
.section-circles .splide{
  position: relative;
  padding-bottom: 48px; 
}

.section-circles .splide__pagination{
  position: absolute !important;
  left: 0 !important;
  right: auto !important;
  bottom: 0 !important;
  width: auto !important;
  transform: none !important;
  justify-content: flex-start !important;
  gap: 8px;
}

/* estilo de bullets */
.section-circles .splide__pagination__page{
  opacity: 1;
  background: #e5e7eb;
}
.section-circles .splide__pagination__page.is-active{
  background: #f2c116;
  transform: none !important;
}
.splide__pagination__page.is-active{
  background: #f2c116;
}

.section-circles .splide__arrows{
  position: absolute !important;
  right: 0 !important;
  bottom: 0 !important;
  display: flex !important;
  gap: 8px;
}
.section-circles .splide__arrow{
  position: static !important;
  top: auto !important;
  left: auto !important;
  right: auto !important;
  transform: none !important;
  width: 40px; height: 40px;
  border-radius: 8px;
  background: #fff;
  border: 1px solid #d1d5db;
  color: #111;
}
.only-mobile{
  padding-left: 20px; 
  padding-right: 20px; 
}
</style>

<?php get_footer('homev2');
