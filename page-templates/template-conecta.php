<?php
/* Template Name: Conecta */
defined('ABSPATH') || exit;
get_header();

$banner_id = (int) get_field('hero_banner');
$title     = trim((string) get_field('hero_title'));
$subtitle  = trim((string) get_field('hero_subtitle'));

if ($title === '') $title = get_the_title();

$alt = $banner_id ? get_post_meta($banner_id, '_wp_attachment_image_alt', true) : '';
if ($alt === '') $alt = $title;
?>
<style>
  .landing-hero { margin: 0 0 ; }
  .landing-hero__banner {
    width: 100%;
    height: 240px;
    object-fit: cover;
    display: block;
  }
  @media (min-width:768px){ .landing-hero__banner{ height: 400px; } }

  .landing-hero__titlebar{
    background:
      radial-gradient(rgba(255,255,255,.08) 1px, transparent 1px) 0 0/18px 18px,
      #0b3a63;
    color:#fff; text-align:center; padding:28px 16px 36px;
  }
  .landing-hero__title{
    margin:0 0 12px; font-weight:800; line-height:1.1;
    font-size:clamp(28px,3.2vw + 8px,44px);
    position:relative; display:inline-block; padding-bottom:8px;
  }
  .landing-hero__title::after{
    content:""; position:absolute; left:8%; right:8%; bottom:0;
    height:3px; background:#fff; border-radius:2px; opacity:.95;
  }
  .landing-hero__subtitle{
    margin:12px auto 0; max-width:960px; color:#e7eef7;
    font-size:16px; line-height:1.6;
  }
  .landing-hero .container{max-width:1200px; margin:0 auto; padding:0 16px;}
  .sub-container{ color: #F3F5F7; !important; text-align: center;  padding: 60px 20px; width: 100%; margin: auto; background: #F3F5F7; }
   
 .sub-container-widh{
  max-width: 980px;
  margin: auto; 
 }
  .sub-container-widh p{
 color: #000; 
 font-size: 18px; 
 font-family: Roboto; 
 }
</style>

<section class="landing-hero">
  <?php if ($banner_id): ?>
    <?= wp_get_attachment_image(
          $banner_id,
          'full', 
          false,
          [
            'class'         => 'landing-hero__banner',
            'alt'           => esc_attr($alt),
            'loading'       => 'eager', 
            'decoding'      => 'async',
            'fetchpriority' => 'high'
          ]
        ); ?>
  <?php endif; ?>
  <div class="landing-hero__titlebar">
    <div class="container">
      <h1 class="landing-hero__title"><?= esc_html($title); ?></h1>

    </div>

  </div>
      <div class="sub-container">
        <div class="sub-container-widh">
              <?php if ($subtitle): ?>
        <p class="landing-hero__subtitle">
  <?= wp_kses_post( wpautop( $subtitle ) ); ?>
</p>
      <?php endif; ?>
              </div>
    </div>
</section>
<?php
$regions = get_field('conecta_regions', 'option') ?: [];
$default_region = get_field('default_region', 'option') ?: ($regions[0]['slug'] ?? '');

$region_map   = []; 
$region_labels = []; 

foreach ($regions as $r) {
  if (!empty($r['slug']) && !empty($r['base_prefix'])) {
    $slug = sanitize_title($r['slug']);
    $base = rtrim($r['base_prefix'], '/') . '/';
    $region_map[$slug]   = $base;
    $region_labels[$slug] = $r['label'] ?: ucfirst($slug);
  }
}

$qs_region     = isset($_GET['region']) ? sanitize_title($_GET['region']) : '';
$active_region = ($qs_region && isset($region_map[$qs_region])) ? $qs_region : $default_region;

$page_id = get_queried_object_id();
?>

<style>
.svc > .container{
  max-width: 1320px;
  margin: 0 auto;
  padding: 0 16px;
}
.svc__head{
  display:flex; align-items:center; justify-content:space-between;
  gap:16px; margin:24px 0 12px;
}
.svc{
  padding-top: 40px !Important; 
}
.svc__grid{
  display:flex;
  flex-wrap:wrap;
  gap:24px;
  justify-content:center; 
  list-style:none; margin:0; padding:0;
}
.svc__item{
  flex: 1 1 calc(25% - 24px); 
  max-width: calc(25% - 24px);
  display:flex;
  
}

.svc-card{
  background: #F3F5F7; ; border:1px solid #e6ebf0; border-radius:12px;
  overflow:hidden; box-shadow:0 1px 2px rgba(16,24,40,.04);
  display:flex; flex-direction:column; height:100%;
}
.svc-card__media img{
  width:100%; height:180px; object-fit:cover; display:block;
}
.svc-card__body{
  padding:16px;
  display:flex; 
  flex-direction:column; 
  gap:10px;
  
}
.svc-card__badge{
  display:inline-block; background:#ffe08a; border-radius:8px;
  padding:4px 10px; font-weight:700; font-size:12px; color:#1f2937; margin-bottom:4px;
}
.svc-card__title{ margin:6px 0 2px; font-size:20px; line-height:1.2; }
.svc-card__title a{ text-decoration:none; color:#101828; }
.svc-card__desc{
  color:#475467; font-size:14px; line-height:1.6;
  flex:1 1 auto;
  min-height:0; 
}
.svc-card__link{
  margin-top:auto;
  display:inline-flex; align-items:center; font-weight:600; font-size:14px; text-decoration:none;
  color: #093866
}
.svc-card__link span{ margin-left:6px; }

@media (max-width: 1200px){
  .svc__item{ flex-basis: calc(33.333% - 24px); max-width: calc(33.333% - 24px); } 
}
@media (max-width: 900px){
  .svc__item{ flex-basis: calc(50% - 24px); max-width: calc(50% - 24px); } 
}

.svc-card__badge{
  align-self: flex-start; 
  display: inline-flex; 
  background:#F1C40F; 
  border-radius:8px; 
  padding:4px 10px; 
  font-weight:700; 
  font-size:12px; 
  color:#1f2937; 
  margin-bottom:4px;
  white-space: nowrap;
}

.region-picker{ position:relative; }
.region-btn{
  display:flex; align-items:center; gap:10px; font-size: 14px; 
  padding:10px 14px; border:1px solid #D0D5DD; border-radius:10px;
  background:#fff; cursor:pointer; font-weight:600; color:#101828;
  box-shadow:0 1px 2px rgba(16,24,40,.04);
}
.region-btn:hover{ background:#F9FAFB; }
.region-btn:focus-visible{ outline:2px solid #155EEF; outline-offset:2px; }
.region-btn .icon{ opacity:.9; }
.region-btn .chev{ transition: transform .18s ease; }
.region-btn[aria-expanded="true"] .chev{ transform: rotate(180deg); }

.region-menu{
  position:absolute; right:0; top:calc(100% + 8px);
  min-width:260px; max-height:60vh; overflow:auto;
  background:#fff; border:1px solid #E4E7EC; border-radius:12px;
  box-shadow:0 16px 32px rgba(16,24,40,.12);
  z-index:50;
}
.region-menu ul{ list-style:none; margin:0; padding:6px 0; }
.region-menu li + li{ border-top:1px solid #F2F4F7; }

.region-option{
  width:100%; text-align:left; padding:12px 16px; background:none; border:0; cursor:pointer;
  font-weight:600; color:#111827;
}
.region-option:hover{ background:#F2F4F7; }
.region-option[aria-selected="true"]{ background:#EEF2FF; color:#1D4ED8; }

.svc__head{ gap:16px; 

margin-bottom: 20px !important; 
}
.svc__head h2{
padding-left: 10px; !important }
</style>

<section class="svc">
  <div class="container svc__head">
    <h2>Tipos de servicios</h2>

    <?php if (!empty($region_map)) : ?>
<div class="region-picker">
  <button type="button" id="btnRegion" class="region-btn" aria-haspopup="listbox" aria-expanded="false">
    <svg class="icon" width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path d="M12 2C8.7 2 6 4.7 6 8c0 4.2 6 12 6 12s6-7.8 6-12c0-3.3-2.7-6-6-6zm0 8.2c-1.2 0-2.2-1-2.2-2.2S10.8 5.8 12 5.8s2.2 1 2.2 2.2S13.2 10.2 12 10.2z" fill="currentColor"/></svg>
    <span id="btnRegionLabel"><?= esc_html($region_labels[$active_region] ?? 'Selecciona tu región') ?></span>
    <svg class="chev" width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><path d="M7 10l5 5 5-5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
  </button>

  <div id="menuRegion" class="region-menu" role="listbox" aria-labelledby="btnRegion" hidden>
    <ul>
      <?php foreach ($region_map as $slug => $base): ?>
        <li>
          <button type="button"
                  class="region-option"
                  role="option"
                  data-slug="<?= esc_attr($slug) ?>"
                  aria-selected="<?= $slug === $active_region ? 'true' : 'false' ?>">
            <?= esc_html($region_labels[$slug]) ?>
          </button>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>

    <?php endif; ?>
  </div>

 <?php
$cards = [];
if (have_rows('cards_conecta', $page_id)) :
  while (have_rows('cards_conecta', $page_id)) : the_row();
    $img_id   = (int) get_sub_field('image');
    $img_html = $img_id ? wp_get_attachment_image($img_id, 'large', false, ['class'=>'svc__img','loading'=>'lazy']) : '';
    $badge    = (string) get_sub_field('badge');
    $title    = (string) get_sub_field('title');
    $desc     = (string) get_sub_field('desc');

    $raw_key  = get_sub_field('service_key');
    $key      = sanitize_title( $raw_key ? $raw_key : $title );

    $label    = trim((string) get_sub_field('link_label')) ?: 'Ver servicio';

    $over = [];
    if (have_rows('links_override')) {
      while (have_rows('links_override')) : the_row();
        $rslug = sanitize_title((string) get_sub_field('region_slug'));
        $curl  = trim((string) get_sub_field('custom_url'));
        if ($rslug && $curl) $over[$rslug] = esc_url_raw($curl);
      endwhile;
    }

    $base_for_active = $region_map[$active_region] ?? '';
    $href = $over[$active_region] ?? ($base_for_active . $key);

    $cards[] = compact('img_html','badge','title','desc','key','label','over','href');
  endwhile;
endif;
?>

<div class="container">
  <div class="only-desktop">
    <ul class="svc__grid">
      <?php foreach ($cards as $c): ?>
      <li class="svc__item">
        <article class="svc-card"
                 data-key="<?= esc_attr($c['key']) ?>"
                 data-overrides='<?= esc_attr(wp_json_encode($c['over'])) ?>'>
          <?php if ($c['img_html']): ?>
            <a class="svc-card__media" href="<?= esc_url($c['href']) ?>"><?= $c['img_html'] ?></a>
          <?php endif; ?>

          <div class="svc-card__body">
            <?php if ($c['badge']): ?><span class="svc-card__badge"><?= esc_html($c['badge']) ?></span><?php endif; ?>
            <h3 class="svc-card__title"><a href="<?= esc_url($c['href']) ?>"><?= esc_html($c['title']) ?></a></h3>
            <?php if ($c['desc']): ?><p class="svc-card__desc"><?= nl2br(esc_html($c['desc'])) ?></p><?php endif; ?>
            <a class="svc-card__link" data-role="svc-link" href="<?= esc_url($c['href']) ?>">
              <?= esc_html($c['label']) ?><span aria-hidden="true"> ›</span>
            </a>
          </div>
        </article>
      </li>
      <?php endforeach; ?>
    </ul>
  </div>
  <div class="only-mobile svc__slider section-circles">
    <div class="splide js-svc-splide" aria-label="Tipos de servicios">
      <div class="splide__track">
        <ul class="splide__list">
          <?php foreach ($cards as $c): ?>
          <li class="splide__slide">
            <article class="svc-card"
                     data-key="<?= esc_attr($c['key']) ?>"
                     data-overrides='<?= esc_attr(wp_json_encode($c['over'])) ?>'>
              <?php if ($c['img_html']): ?>
                <a class="svc-card__media" href="<?= esc_url($c['href']) ?>"><?= $c['img_html'] ?></a>
              <?php endif; ?>

              <div class="svc-card__body">
                <?php if ($c['badge']): ?><span class="svc-card__badge"><?= esc_html($c['badge']) ?></span><?php endif; ?>
                <h3 class="svc-card__title"><a href="<?= esc_url($c['href']) ?>"><?= esc_html($c['title']) ?></a></h3>
                <?php if ($c['desc']): ?><p class="svc-card__desc"><?= nl2br(esc_html($c['desc'])) ?></p><?php endif; ?>
                <a class="svc-card__link" data-role="svc-link" href="<?= esc_url($c['href']) ?>">
                  <?= esc_html($c['label']) ?><span aria-hidden="true"> ›</span>
                </a>
              </div>
            </article>
          </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>

</div>

</section>
<style>
.only-mobile  { display: none !important; }
.only-desktop { display: block !important; }

@media (max-width: 768px){
  .only-mobile  { display: block !important; }
  .only-desktop { display: none !important; }

  .svc__head{
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 8px;
    margin-bottom: 20px !important;
  }
  .svc__head h2{ font-size: 20px; line-height: 1.2; margin: 0; }
  .region-btn{ font-size: 14px; padding: 8px 10px; }

  .svc__slider .splide{
    position: relative;
    padding-bottom: 48px;
  }

  .only-mobile .splide__track { overflow: hidden; }
  .only-mobile .splide__list  { display: flex; margin: 0; padding: 0; }
  .only-mobile .splide__slide { flex: 0 0 100%; list-style: none; }

  .svc__slider .splide__pagination{
    position: absolute;
    left: 0;
    right: auto;
    bottom: 0;
    width: auto;
    transform: none;
    display: flex;
    justify-content: flex-start;
    gap: 8px;
  }
  .svc__slider .splide__pagination__page{
    opacity: 1;
    background: #e5e7eb;
  }
  .svc__slider .splide__pagination__page.is-active{
    background: #f2c116;
    transform: none !important;
  }

  .svc__slider .splide__arrows{
    position: absolute;
    right: 0;
    bottom: 0;
    display: flex;
    gap: 8px;
  }
  .svc__slider .splide__arrow{
    position: static;
    transform: none;
    width: 40px; height: 40px;
    border-radius: 8px;
    background: #fff;
    border: 1px solid #d1d5db;
    color: #111;
  }
}

</style>
<?php $cf7_id = '24b329d';  ?>

<!-- CTA -->
<section class="apply-cta">
  <div class="apply-cta__inner">
    <button id="applyOpen" type="button" class="apply-cta__btn">
      <span class="icon">📝</span>
      ¿Quieres postular a Acenor Conecta?
    </button>
  </div>
</section>

<!-- MODAL: Formulario -->
<div id="applyModal" class="apply-modal" aria-hidden="true" hidden>
  <div class="apply-modal__backdrop" data-close></div>

  <div class="apply-modal__dialog apply-modal__dialog--form"
       role="dialog" aria-modal="true" aria-labelledby="applyFormTitle">
    <button class="apply-modal__close" type="button" data-close aria-label="Cerrar">×</button>

    <div class="apply-form">
      <h3 id="applyFormTitle" class="apply-form__title">Quiero postularme a Acenor Conecta</h3>
      <div class="apply-form__inner">
        <?= do_shortcode('[contact-form-7 id="'.$cf7_id.'"]'); ?>
      </div>
    </div>
  </div>
</div>

<div id="disclaimerModal" class="apply-modal" aria-hidden="true" hidden>
  <div class="apply-modal__backdrop"></div>

  <div class="apply-modal__dialog apply-modal__dialog--narrow" role="dialog" aria-modal="true" aria-labelledby="discTitle">
    <button class="apply-modal__close" type="button" id="disclaimerCloseX" aria-label="Cerrar">×</button>

    <div class="disclaimer">
      <h3 id="discTitle" class="disclaimer__title">Exención de Responsabilidad</h3>
      <div class="disclaimer__body">
        <p><strong>ACENOR</strong> actúa únicamente como un directorio de contacto entre usuarios y proveedores de servicios en los rubros de construcción y metalurgia. La información publicada corresponde a los datos entregados por cada empresa o trabajador, siendo estos los únicos responsables de la veracidad, calidad y condiciones de los servicios ofrecidos.</p>
        <p>ACENOR no participa en la prestación de los servicios, ni garantiza los resultados, tiempos de ejecución, costos o cualquier otro servicio relacionado con la contratación de terceros. Cualquier acuerdo, contratación o eventualidad que surja entre el usuario y el proveedor es de exclusiva responsabilidad de dichas partes.</p>
      </div>

      <div class="disclaimer__actions">
        <button class="btn btn--ghost" type="button" id="disclaimerCancel">Cancelar</button>
        <button class="btn" type="button" id="disclaimerAccept">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<style>
 /* CTA bar */
.apply-cta{ background:#f1c40f; padding:28px 0; margin-top:40px; }
.apply-cta__inner{ max-width:1320px; margin:0 auto; padding:0 16px; text-align:center; }
.apply-cta__btn{
  background:#0b3a63; color:#fff; border:0; border-radius:10px; padding:12px 18px;
  font-weight:700; display:inline-flex; align-items:center; gap:10px; box-shadow:0 1px 2px rgba(16,24,40,.08);
}
.apply-cta__btn .icon{ opacity:.9; }

.apply-modal[aria-hidden="false"]{ display:block; }
.apply-modal__backdrop{
  position:fixed; inset:0; background:rgba(2,8,23,.55); backdrop-filter: blur(2px);
}
.apply-modal__dialog{
  position: fixed;
  left: 50%;
  transform: translateX(-50%);
  top: clamp(24px, 10vh, 80px); 
  right: auto;
  bottom: auto; 
  width: min(92vw, 1100px);
  max-height: calc(100dvh - 2 * clamp(24px, 10vh, 80px));
  background: #f8fafc;
  border-radius: 12px;
  box-shadow: 0 20px 40px rgba(0,0,0,.25);
   max-width: 560px;
  overflow: auto;
}

.apply-modal__dialog--narrow{
  width: min(92vw, 560px);
  max-width: 560px;
}

.apply-modal__dialog--narrow{ max-width:560px; }

.apply-modal__close{
  position:absolute; right:10px; top:10px; width:36px; height:36px; border-radius:8px; border:1px solid #e5e7eb; background:#fff; cursor:pointer;
}

.btn{ background:#0b3a63; color:#fff; border:0; border-radius:8px; padding:10px 14px; font-weight:700; cursor:pointer; }
.btn--ghost{ background:#fff; color:#0b3a63; border:1px solid #cbd5e1; }

/* Form modal */
.apply-form{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:16px; }
.apply-form__title{ text-align:center; margin:6px 0 16px; font-weight:800; }
.apply-form .wpcf7-submit,
.apply-form button[type="submit"]{
  background:#0b3a63 !important; color:#fff; border:0; border-radius:8px; padding:10px 16px;
}
.disclaimer__actions .btn:hover{
  color: #fff; 
}
.disclaimer__actions .btn--ghost:hover{
  color: #0b3a63
}

.disclaimer{ background:#fff; border:1px solid #e5e7eb; border-radius:12px; overflow:hidden; }
.disclaimer__title{
  background:#083457; color:#fff; text-align:center; padding:10px 12px; font-weight:800;
}
.disclaimer__body{ padding:16px; color:#1f2937; font-size:14px; line-height:1.6; }
.disclaimer__body p{ margin:0 0 10px; }
.disclaimer__actions{ display:flex; justify-content:space-between; gap:10px; padding:12px 16px; }

</style>
<script>
(function(){
  const modal   = document.getElementById('applyModal');
  const openBtn = document.getElementById('applyOpen');
  const accept  = document.getElementById('applyAccept');

  function setHidden(h){
    modal.hidden = h;
    modal.setAttribute('aria-hidden', h ? 'true' : 'false');
    document.documentElement.style.overflow = h ? '' : 'hidden';
  }

  function getSubmit(){
    return modal.querySelector('.wpcf7 input[type="submit"], .wpcf7 button[type="submit"]');
  }

  function checkAccepted(){
    const all = [...modal.querySelectorAll('[data-accept]')];
    const ok = all.length ? all.every(ch => ch.checked) : false;
    accept.disabled = !ok;
    const submit = getSubmit();
    if (submit) submit.disabled = !ok; 
  }

  openBtn?.addEventListener('click', ()=> setHidden(false));
  modal?.addEventListener('click', e=>{
    if (e.target.hasAttribute('data-close')) setHidden(true);
  });
  modal?.querySelectorAll('[data-close], .apply-modal__close').forEach(btn=>{
    btn.addEventListener('click', ()=> setHidden(true));
  });


  modal?.querySelectorAll('[data-accept]').forEach(ch=>{
    ch.addEventListener('change', checkAccepted);
  });

  accept?.addEventListener('click', ()=>{
    const first = modal.querySelector('.wpcf7 form input, .wpcf7 form textarea, .wpcf7 form select');
    first && first.focus();
  });

  const submit = getSubmit();
  if (submit) submit.disabled = true;

  document.addEventListener('wpcf7mailsent', ()=> { if (submit) submit.disabled = true; });
})();
</script>

<script>
(function(){
  function setModal(el, open){
    if (!el) return;
    el.hidden = !open;
    el.setAttribute('aria-hidden', open ? 'false' : 'true');
    document.documentElement.style.overflow = open ? 'hidden' : '';
  }

  const formModal = document.getElementById('applyModal');
  const openBtn   = document.getElementById('applyOpen');
  formModal?.addEventListener('click', e => { if (e.target.matches('[data-close], .apply-modal__backdrop')) setModal(formModal, false); });
  formModal?.querySelector('.apply-modal__close')?.addEventListener('click', () => setModal(formModal, false));
  openBtn?.addEventListener('click', () => setModal(formModal, true));

  const discModal   = document.getElementById('disclaimerModal');
  const discAccept  = document.getElementById('disclaimerAccept');
  const discCancel  = document.getElementById('disclaimerCancel');
  const discCloseX  = document.getElementById('disclaimerCloseX');

  const STORAGE_KEY = 'conecta_disclaimer_ok';

  function openDisclaimerIfNeeded(){
    try{
      const ok = localStorage.getItem(STORAGE_KEY) === '1';
      if (!ok) setModal(discModal, true);
    }catch(e){
      setModal(discModal, true);
    }
  }

  function acceptDisclaimer(){
    try{ localStorage.setItem(STORAGE_KEY, '1'); }catch(e){}
    setModal(discModal, false);
  }
  function closeDisclaimerOnce(){
    setModal(discModal, false);
  }

  discAccept?.addEventListener('click', acceptDisclaimer);
  discCancel?.addEventListener('click', closeDisclaimerOnce);
  discCloseX?.addEventListener('click', closeDisclaimerOnce);
  discModal?.querySelector('.apply-modal__backdrop')?.addEventListener('click', closeDisclaimerOnce);

  document.addEventListener('DOMContentLoaded', openDisclaimerIfNeeded);
})();
</script>

<script>
(function(){
  const regionBases = window.regionBases || <?= wp_json_encode($region_map, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>;

  function applyRegion(slug){
    const cards = document.querySelectorAll('.svc-card');
    cards.forEach(card=>{
      const key  = card.dataset.key;
      const over = (()=>{ try{return JSON.parse(card.dataset.overrides||'{}')}catch(e){return{}} })();
      const url  = over[slug] || ((regionBases[slug]||'') + key);
      card.querySelectorAll('a[data-role="svc-link"]').forEach(a => a.href = url);
    });
    localStorage.setItem('conecta_region', slug);
    const u = new URL(location);
    const def = document.getElementById('btnRegion')?.dataset.default;
    if (def && slug===def) u.searchParams.delete('region'); else u.searchParams.set('region', slug);
    history.replaceState({},'',u);
  }
  window.applyRegion = window.applyRegion || applyRegion;

  const btn   = document.getElementById('btnRegion');
  const menu  = document.getElementById('menuRegion');
  const label = document.getElementById('btnRegionLabel');

  function openMenu(){ menu.hidden=false; btn.setAttribute('aria-expanded','true'); }
  function closeMenu(){ menu.hidden=true; btn.setAttribute('aria-expanded','false'); }
  btn.addEventListener('click', ()=> menu.hidden ? openMenu() : closeMenu());
  document.addEventListener('click', e => {
    if (!menu.contains(e.target) && !btn.contains(e.target)) closeMenu();
  });
  document.addEventListener('keydown', e => { if (e.key==='Escape') closeMenu(); });

  document.querySelectorAll('.region-option').forEach(opt=>{
    opt.addEventListener('click', ()=>{
      const slug = opt.dataset.slug;
      label.textContent = opt.textContent.trim();
      document.querySelectorAll('.region-option[aria-selected="true"]').forEach(el=>el.setAttribute('aria-selected','false'));
      opt.setAttribute('aria-selected','true');
      applyRegion(slug);
      closeMenu();
    });
  });
  const qs     = new URLSearchParams(location.search);
  const fromQS = qs.get('region');
  const saved  = localStorage.getItem('conecta_region');
  const list   = Array.from(document.querySelectorAll('.region-option'));
  const slugs  = list.map(l=>l.dataset.slug);
  const start  = slugs.includes(fromQS) ? fromQS : slugs.includes(saved) ? saved : (slugs[0]||'');
  if (start){
    const opt = document.querySelector(`.region-option[data-slug="${start}"]`);
    if (opt){ opt.click(); }
  }
})();
</script>

<?php
while (have_posts()) : the_post();
  the_content();
endwhile;

get_footer();
