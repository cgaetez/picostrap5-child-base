<?php
$phone   = get_field('cta_phone', 'option');
$wa      = get_field('cta_whatsapp', 'option');
$contact = get_field('cta_contact_url', 'option');

if (!function_exists('nyx_digits')) {
  function nyx_digits($s){ return preg_replace('/\D+/', '', (string)$s); }
}

$tel_href = $phone ? 'tel:' . nyx_digits($phone) : '';
$wa_href  = $wa    ? 'https://wa.me/' . nyx_digits($wa) : '';

$variant = $args['variant'] ?? 'default';
$message = trim((string)($args['message'] ?? ''));

$classes = 'cta-bar';
if ($variant === 'banner') $classes .= ' cta-bar--banner';
?>

<div class="<?= esc_attr($classes) ?>">
  <div class="cta-bar__inner container">
    <?php if ($message): ?>
      <p class="cta-bar__msg"><?= esc_html($message) ?></p>
    <?php endif; ?>

    <div class="cta-bar__actions">
      <?php if($phone): ?>
        <a class="btn btn--primary llamada-vwo" href="<?= esc_url($tel_href) ?>">
<i class="fa-solid fa-phone fa-fw" aria-hidden="true"></i>
          <span class="btn__label">Llámenos</span>
        </a>
      <?php endif; ?>

      <?php if($wa): ?>
        <a class="btn btn--ghost" href="<?= esc_url($wa_href) ?>" target="_blank" rel="noopener">
 <i class="fa-brands fa-whatsapp fa-fw" aria-hidden="true"></i>
        <span class="btn__label">Escríbanos</span>
        </a>
      <?php endif; ?>

      <?php if($contact): ?>
        <a class="btn btn--outline" href="<?= esc_url($contact) ?>">
 <i class="fa-solid fa-arrow-up-right-from-square fa-fw" aria-hidden="true"></i>
       <span class="btn__label">Contáctenos</span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
  .cta-bar .icon {
  width: 18px;
  height: 18px;
  display: inline-block;
}

.cta-bar .btn--primary .icon { fill: #0b3a66; } 
.cta-bar .btn--ghost .icon,
.cta-bar .btn--outline .icon { fill: #f2c116; }
  .cta-bar {
  background: #0b3a66; 
  padding: 18px 24px;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 40px;
}

.cta-bar .btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 10px 18px;
  border-radius: 8px;
  font-weight: 400;
  line-height: 1;
  border: 2px solid transparent;
  text-decoration: none;
  transition: transform .06s ease, box-shadow .2s ease, background-color .2s ease, color .2s ease, border-color .2s ease;
}

.cta-bar .btn [class^="icon-"], 
.cta-bar .btn [class*=" icon-"] {
  width: 18px;
  height: 18px;
  display: inline-block;
  line-height: 0;
}

.cta-bar .btn:active { transform: translateY(1px); }

.cta-bar .btn--primary {
  background: #f2c116; 
  border-color: #f2c116;
  color: #0b3a66;
  box-shadow: 0 2px 0 rgba(0,0,0,.15);
}
.cta-bar .btn--primary:hover {
  background: #e1b411;
  border-color: #e1b411;
  color: #0b3a66;
}


.cta-bar .btn--ghost,
.cta-bar .btn--outline {
  background: transparent;
  border-color: #f2c116;
  color: #ffffff;
}
.cta-bar .btn--ghost:hover,
.cta-bar .btn--outline:hover {
  background: rgba(242,193,22,.12);
  color: #ffffff;
  border-color: #f2c116;
}
.cta-bar .btn:focus-visible {
  outline: 2px solid #fff;
  outline-offset: 2px;
}

/* Responsivo */
@media (max-width: 992px) {
  .cta-bar { gap: 12px; padding: 14px 16px; }
}
@media (max-width: 768px) {
  .cta-bar { flex-wrap: wrap; }
  .cta-bar .btn { flex: 1 1 100%; justify-content: center; }
}
/* cta amarillo */
.cta-bar__inner{ display:flex; flex-direction:column; align-items:center; gap:12px; }
.cta-bar__actions{ display:flex; gap:12px; flex-wrap:wrap; justify-content:center; }

.cta-bar--banner{
  background:#f2c116; color:#0b3a66; padding:40px 0;
}
.cta-bar--banner .cta-bar__msg{
  max-width:900px; margin:0 auto 8px; font-size:14px; line-height:1.45; text-align:center;
}

.cta-bar--banner .btn--primary{
  background:#0b3a66; border-color:#0b3a66; color:#fff;
}
.cta-bar--banner .btn--ghost,
.cta-bar--banner .btn--outline{
  background:transparent; border-color:#0b3a66; color:#0b3a66;
}
.cta-bar--banner .btn--ghost:hover,
.cta-bar--banner .btn--outline:hover{
  background:rgba(11,58,102,.10);
}

/* Iconos */
.cta-bar--banner .icon{ fill:#0b3a66; }
.cta-bar--banner .btn--primary .icon{ fill:#fff; }

@media (max-width: 768px){
  .cta-bar__actions a.btn{ flex:1 1 100%; justify-content:center; }
}

.cta-bar--banner{
  background:#f2c116;
  color:#0b3a66;
}

.cta-bar--banner .btn--primary{
  background:#0b3a66;
  border-color:#0b3a66;
  color:#fff;
  cursor: pointer; 
}
.cta-bar--banner .btn--primary .icon{ fill:#fff; }

/* Secundarios: borde AZUL, texto e icono AZUL */
.cta-bar--banner .btn--ghost,
.cta-bar--banner .btn--outline{
  background:transparent;
  border-color:#0b3a66;
  color:#0b3a66;
  cursor: pointer; 
}
.cta-bar--banner .btn--ghost .icon,
.cta-bar--banner .btn--outline .icon{ fill:#0b3a66; }

.cta-bar--banner .btn--primary:hover{
  background: var(--cta-blue-hover);
  border-color: var(--cta-blue-hover);
  color:#fff;
  transform: translateY(-1px);
}
/* Tamaño y alineación de íconos Font Awesome dentro de la CTA bar */
.cta-bar .btn i {
  font-size: 16px;
  line-height: 1;
  margin-right: 8px;
}

.cta-bar .btn--primary i { color: #0b3a66; }
.cta-bar .btn--ghost i,
.cta-bar .btn--outline i { color: #f2c116; }

.cta-bar .btn.is-wa i { color: #f2c116; }

/* Hover sutil */
.cta-bar .btn--ghost:hover i,
.cta-bar .btn--outline:hover i { opacity: .9; }
.cta-bar.cta-bar--banner .btn .fa-phone {
  color: #fff !important;
}

.cta-bar.cta-bar--banner .btn .fa-whatsapp, .cta-bar.cta-bar--banner .btn .fa-arrow-up-right-from-square{
color: #0b3a66 !important; 
}
/* ===== Solo móvil: mostrar solo iconos y en una fila ===== */
@media (max-width: 576px){
  .cta-bar__actions{
    gap: 10px;              /* espacio entre iconos */
    flex-wrap: nowrap;      /* no se vayan a segunda línea */
    justify-content: center;
  }

  .cta-bar .btn{
    flex: 0 0 auto;         /* ancho fijo, no estirar */
    width: 44px;
    height: 44px;
    padding: 0;
    border-radius: 8px;     /* como tu mock */
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0;                 /* sin gap porque no hay texto */
  }

  /* El icono centrado y más grande */
  .cta-bar .btn i{
    margin-right: 0;
    font-size: 20px;
    line-height: 1;
  }

  /* Ocultar solo el texto (accesible para lectores de pantalla) */
  .cta-bar .btn .btn__label{
    position: absolute !important;
    width: 1px; height: 1px;
    padding: 0; margin: -1px;
    overflow: hidden; clip: rect(0,0,0,0);
    white-space: nowrap; border: 0;
  }
}

/* Opcional: si prefieres que en tablets también se vean solo iconos,
   sube el breakpoint a 768px en lugar de 576px */

</style>
