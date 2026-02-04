<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
(function(){
  // mata cualquier style del error o el overlay apenas aparezcan
  const nuke = (root=document){
    root.querySelectorAll('#scss-compiler-output').forEach(n=>n.remove());
    root.querySelectorAll('style').forEach(s=>{
      const t=(s.textContent||'').toLowerCase();
      if (/\b#error-page\b/.test(t) || /body\s*\{[^}]*max-width\s*:\s*700px/.test(t)) s.remove();
    });
    if (document.body){
      const b=document.body.style;
      b.maxWidth=b.margin=b.padding=b.border=b.boxShadow='';
    }
  };

  // Observa todo el documento
  new MutationObserver(muts=>{
    for (const m of muts){
      m.addedNodes && m.addedNodes.forEach(n=>{
        if (n.nodeType!==1) return;
        if (n.id==='scss-compiler-output'){ n.remove(); return; }
        if (n.tagName==='STYLE'){
          const t=(n.textContent||'').toLowerCase();
          if (/\b#error-page\b/.test(t) || /body\s*\{[^}]*max-width\s*:\s*700px/.test(t)) n.remove();
        }
      });
    }
  }).observe(document.documentElement,{childList:true,subtree:true});

  // primera pasada
  nuke();
  document.addEventListener('DOMContentLoaded', nuke);
  window.addEventListener('load', nuke);
})();
</script>

<?php wp_head(); ?>
</head>
<body <?php body_class('header-homev2'); ?>>
    <script>
document.addEventListener('DOMContentLoaded', function () {
  var s = document.getElementById('scss-compiler-output');
  if (s) s.remove();
});
</script>
<style>
  body.header-homev2{ width:auto !important; max-width:none !important; }
@media screen and (min-width: 991px) {
  a.hv2-login-inline.hv2-mobile-only {
    display: none;
  }
}
/* ===== Desktop: logo a la izquierda, menú a la derecha ===== */
@media (min-width: 901px){
  .hv2-brandbar__row{
    display:flex !important;   /* volvemos a flex en escritorio */
    align-items:center;
    gap:20px;
  }

  /* el spacer empuja el nav al extremo derecho */
  .hv2-brandbar__spacer{
    display:block !important;
    flex:1 1 auto;
  }

  /* por si el spacer no está o quedó oculto, esto asegura el empuje */
  .hv2-brandbar__row > .hv2-nav{
    margin-left:auto;
  }

  /* el burger solo en móvil */
  .hv2-burger{
    display:none !important;
  }
}

@media (min-width:901px){
  .menu--homev2 > li.menu-item-has-children > a,
  .menu--homev2 > li.is-mega > a{
    position:relative;
    padding-right:22px;                
  }

  .menu--homev2 > li.menu-item-has-children > a::after,
  .menu--homev2 > li.is-mega > a::after{
    content:"";
    position:absolute;
    right:4px;                      
    top:50%;
    width:7px; height:7px;
    border-right:2px solid currentColor; 
    border-bottom:2px solid currentColor;
    transform:translateY(-50%) rotate(45deg); 
    transition:transform .2s ease;
    opacity:.85;
    pointer-events:none;                 
  }

  /* estado abierto: gira a ▲ */
  .menu--homev2 > li.menu-item-has-children:hover > a::after,
  .menu--homev2 > li.menu-item-has-children.open  > a::after,
  .menu--homev2 > li.is-mega:hover > a::after,
  .menu--homev2 > li.is-mega.open  > a::after{
    transform:translateY(-50%) rotate(-135deg); /* ▲ abierto */
  }
}

</style>

<?php wp_body_open(); ?>

<header class="hv2-header">
  <div class="hv2-top">
    <div class="container hv2-top__row">
      <div class="hv2-top__left">
        <a class="btn-pill btn-pill--yellow" href="https://acenorchile.com/wp-content/uploads/catalogo_acenor_actualizado.pdf" aria-label="Descargar catálogo">
          <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 3a1 1 0 0 1 1 1v9.59l2.3-2.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 1 1 1.4-1.42L11 13.6V4a1 1 0 0 1 1-1zM5 20a1 1 0 1 1 0-2h14a1 1 0 1 1 0 2H5z"/></svg>
          <span>Catálogo</span>
        </a>

        <a class="hv2-top__phone llamada-vwo" href="tel:+56229259200" aria-label="Llamar a +56 2 2925 9200">
          <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1.03-.24c1.12.37 2.33.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.7 21 3 13.3 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.24.2 2.45.57 3.57a1 1 0 0 1-.24 1.03z"/></svg>
          <span>+56 2 2925 9200</span>
        </a>
      </div>

      <div class="hv2-top__right">
        <a class="btn-pill btn-pill--yellow" href="https://acenorchile.com/sucursales/" aria-label="Busca tu sucursal">
          <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2a7 7 0 0 1 7 7c0 5-7 13-7 13S5 14 5 9a7 7 0 0 1 7-7zm0 9.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg>
          <span>Busca tu sucursal</span>
        </a>
        <a class="hv2-top__link" href="https://acenorchile.com/seleccion-de-cotizacion/">Cotiza</a>
        <a class="hv2-top__link" href="https://acenorchile.com/mi-cuenta/">Iniciar sesión</a>
      </div>
    </div>
  </div>

  <div class="hv2-brandbar">
    <div class="container hv2-brandbar__row">
      <a class="hv2-logo" href="<?= esc_url(home_url('/')); ?>" aria-label="ACENOR">
        <img src="https://acenorchile.com/wp-content/uploads/2022/04/logo.png.webp"
             alt="ACENOR Productos de Acero" loading="eager" decoding="async">
      </a>

      <?php
        $login_url = function_exists('wc_get_page_permalink')
          ? wc_get_page_permalink('myaccount')
          : wp_login_url();
      ?>

      <a class="hv2-login-inline hv2-mobile-only" href="<?= esc_url($login_url); ?>">
        <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 12a5 5 0 1 0-5-5 5 5 0 0 0 5 5zm0 2c-4.42 0-8 2.24-8 5v1h16v-1c0-2.76-3.58-5-8-5z"/></svg>
        <span>Iniciar sesión</span>
      </a>

      <div class="hv2-brandbar__spacer"></div>

      <button class="hv2-burger" aria-expanded="false" aria-controls="hv2-offcanvas">
        <span class="hv2-burger__label">Menú</span>
        <span class="hv2-burger__icon" aria-hidden="true">
          <span></span><span></span><span></span>
        </span>
      </button>

      <nav class="hv2-nav" aria-label="Navegación principal">
        <?php
          wp_nav_menu([
            'container'      => false,
            'menu_class'     => 'menu--homev2',
            'depth'          => 3,
            'menu'           => 'Nuevo menú',
            'fallback_cb'    => '__return_empty_string',
          ]);
        ?>
      </nav>
    </div>

    <div class="container hv2-mobile-only hv2-mobile-searchrow">
      <form class="hv2-mobile-search" role="search" method="get" action="<?= esc_url(home_url('/')); ?>">
        <label class="sr-only" for="hv2-mobile-s">Buscar productos</label>
        <input id="hv2-mobile-s" type="search" name="s" placeholder="Buscar productos" autocomplete="off">
        <button type="submit" aria-label="Buscar">
          <svg width="18" height="18" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M15.5 14h-.79l-.28-.27a6.471 6.471 0 0 0 1.57-4.23A6.5 6.5 0 1 0 9.5 16a6.471 6.471 0 0 0 4.23-1.57l.27.28v.79L20 21.49 21.49 20 15.5 14zM9.5 14A4.5 4.5 0 1 1 14 9.5 4.5 4.5 0 0 1 9.5 14z"/></svg>
        </button>
      </form>
    </div>

    <div class="container hv2-mobile-only hv2-mobile-ctarow">
      <a class="btn-pill btn-pill--yellow hv2-mobile-branch" href="#">
        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2a7 7 0 0 1 7 7c0 5-7 13-7 13S5 14 5 9a7 7 0 0 1 7-7zm0 9.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/></svg>
        <span>Busca tu sucursal</span>
      </a>
      <a class="hv2-top__phone hv2-mobile-phone" href="tel:+56229259200">
        <svg width="16" height="16" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1.03-.24c1.12.37 2.33.57 3.57.57a1 1 0 0 1 1 1V20a1 1 0 0 1-1 1C10.7 21 3 13.3 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.24.2 2.45.57 3.57a1 1 0 0 1-.24 1.03z"/></svg>
        <span>+56 2 2925 9200</span>
      </a>
    </div>
  </div>

  <aside id="hv2-offcanvas" class="hv2-offcanvas" hidden>
    <div class="hv2-offcanvas__head">
      <span>Menú</span>
      <button class="hv2-offcanvas__close" aria-label="Cerrar menú">&times;</button>
    </div>

    <nav class="hv2-mobile-nav" aria-label="Navegación móvil">
      <?php
        wp_nav_menu([
          'container'      => false,
          'menu_class'     => 'menu--mobile',
          'menu'        => 'Nuevo menu movil',
          'depth'          => 3,
          'fallback_cb'    => '__return_empty_string',
        ]);
      ?>
    </nav>
  </aside>

  <div class="hv2-offcanvas__backdrop" hidden></div>
</header>



<style>
:root{
  --blue:#0b3a66; --text:#111827; --muted:#e5e7eb;
  --bg:#f2f2f2;   --chip:#f5f6f8; --yellow:#f2c116; 
}

/* ===== TOPBAR ===== */
.hv2-top{ background:var(--blue); color:#fff; font-size:14px; }
.hv2-top__row{ display:flex; align-items:center; justify-content:space-between; gap:16px; padding:8px 0; }
.hv2-top__left, .hv2-top__right{ display:flex; align-items:center; gap:12px; flex-wrap:wrap; }

.btn-pill{
  display:inline-flex; align-items:center; gap:8px;
  padding:6px 12px; border-radius:999px; text-decoration:none; font-weight:700; line-height:1;
}
.btn-pill--yellow{ background:var(--yellow); color:#111; }
.btn-pill--yellow:hover{ filter:brightness(0.95); }
.hv2-top__phone{ display:inline-flex; align-items:center; gap:8px; color:#fff; text-decoration:none; opacity:.9; }
.hv2-top__phone:hover{ opacity:1; text-decoration:underline; }
.hv2-top__link{ color:#fff; text-decoration:none; opacity:.9; font-weight:600; }
.hv2-top__link:hover{ opacity:1; text-decoration:underline; }

.hv2-brandbar{ background:#fff; border-bottom:1px solid var(--muted); margin: 0px 20px;}
.hv2-brandbar__row{
  display:flex; align-items:center; gap:20px; padding:12px 0;
  position:relative;
}
.hv2-logo img{ height:44px; width:auto; display:block; }
.hv2-brandbar__spacer{ flex:1 1 auto; }

@media (max-width:900px){
  .hv2-top__row{ justify-content:center; }
  .hv2-top__right{ display:none; }
  .hv2-logo img{ height:38px; }
  .hv2-brandbar__row{ flex-wrap:wrap; }
}


.hv2-nav{ position:static; z-index:auto; } 
.menu--homev2{ display:flex; gap:24px; list-style:none; margin:0; padding:10px 0; }
.menu--homev2 > li{ position:relative; }
.menu--homev2 > li > a{
  color:#0b3a66; text-decoration:none; font-weight:700; padding:8px 10px; display:inline-block;
}
.menu--homev2 > li > a:hover{ text-decoration:underline; }

.menu--homev2 > li:not(.is-mega) > .sub-menu{
  display:none; position:absolute; left:0; top:100%;
  min-width:220px; background:#f2f2f2; border:1px solid var(--muted);
  border-radius:8px; box-shadow:0 12px 24px rgba(0,0,0,.10);
  padding:8px; list-style:none; margin:0; z-index:1200;
}
.menu--homev2 > li:not(.is-mega):hover > .sub-menu,
.menu--homev2 > li:not(.is-mega):focus-within > .sub-menu{ display:block; }
.menu--homev2 > li:not(.is-mega) > .sub-menu a{
  display:block; padding:6px 8px; color:var(--text); text-decoration:none; border-radius:6px;
}
.menu--homev2 > li:not(.is-mega) > .sub-menu a:hover{ background:#f8f9fb; }

/* ===== MEGA MENU ===== */
.menu--homev2 > li.is-mega{ position:static; }


.hv2-brandbar__row .menu--homev2 > li.is-mega > .sub-menu{
  position:absolute;
  left:0; right:0; top:calc(100% - 1px);
  display:none;
  background:#f2f2f2;
  border-top:1px solid var(--muted);
  box-shadow:0 18px 36px rgba(0,0,0,.08);
  list-style:none; margin:0; padding:18px 20px 22px;
  box-sizing:border-box;
  z-index:1100;

  --col-min:220px;
  grid-template-columns: repeat(auto-fit, minmax(var(--col-min), 1fr));
  column-gap:24px;
  row-gap:12px;
  max-width:100%;
}

.hv2-brandbar__row .menu--homev2 > li.is-mega:hover > .sub-menu,
.hv2-brandbar__row .menu--homev2 > li.is-mega.open  > .sub-menu{
  display:grid !important;
}

.menu--homev2 > li.is-mega > .sub-menu::before{
  content:""; position:absolute; left:0; right:0; top:-24px;  height:24px;   pointer-events:auto;
}

.menu--homev2 > li.is-mega > .sub-menu > li{
  list-style:none; padding:0; border-left:1px solid var(--muted);
  float:none !important; width:auto !important;
}
.menu--homev2 > li.is-mega > .sub-menu > li:first-child{ border-left:0; }

.menu--homev2 > li.is-mega > .sub-menu > li > a{
  display:block; padding:10px 12px; margin:0;
  background:#fff; color:#000; font-weight:700; text-align:center;
  border-bottom:1px solid var(--muted); text-decoration:none;
}

.menu--homev2 > li.is-mega > .sub-menu > li > .sub-menu{
  list-style:none; margin:0; padding:8px 12px 12px;
}
.menu--homev2 > li.is-mega > .sub-menu > li > .sub-menu > li > a{
  display:block; padding:6px 0; color:var(--text); text-decoration:none;
}
.menu--homev2 > li.is-mega > .sub-menu > li > .sub-menu > li > a:hover{
  color:var(--blue); text-decoration:underline;
}
.menu--homev2 > li.is-mega > .sub-menu > li > .sub-menu > li.menu-item-has-children > a{
  display:block; margin:10px 0 6px; padding:8px 10px;
  background:var(--chip); color:var(--text); font-weight:700; text-align:left;
  border-top:1px solid var(--muted); border-bottom:1px solid var(--muted);
  pointer-events:none;
}
.menu--homev2 > li.is-mega > .sub-menu > li > .sub-menu > li > .sub-menu{
  list-style:none; margin:0 0 6px; padding:0;
}
.menu--homev2 > li.is-mega > .sub-menu > li > .sub-menu > li > .sub-menu a{
  display:block; padding:5px 0; color:var(--text); text-decoration:none;
}
.menu--homev2 > li.is-mega > .sub-menu > li > .sub-menu > li > .sub-menu a:hover{
  color:var(--blue); text-decoration:underline;
}

@media (max-width:1200px){
  .hv2-brandbar__row .menu--homev2 > li.is-mega > .sub-menu{
    grid-template-columns:repeat(4, minmax(220px,1fr));
  }
}
@media (max-width:1024px){
  .hv2-brandbar__row .menu--homev2 > li.is-mega > .sub-menu{
    grid-template-columns:repeat(3, minmax(220px,1fr));
  }
}

/* MOVIL */
.hv2-burger{ display:none; margin-left:auto; align-items:center; gap:10px; padding:8px 12px; border:1px solid var(--muted); border-radius:12px; background:#fff; font-weight:700; }
.hv2-burger__icon{ position:relative; width:22px; height:18px; display:inline-block; }
.hv2-burger__icon span{ position:absolute; left:0; right:0; height:2px; background:#0b3a66; transform-origin:center; transition:transform .25s ease, opacity .2s ease, top .25s ease; }
.hv2-burger__icon span:nth-child(1){ top:0; }
.hv2-burger__icon span:nth-child(2){ top:8px; }
.hv2-burger__icon span:nth-child(3){ top:16px; }

.hv2-burger.is-open .hv2-burger__icon span:nth-child(1){ top:8px; transform:rotate(45deg); }
.hv2-burger.is-open .hv2-burger__icon span:nth-child(2){ opacity:0; }
.hv2-burger.is-open .hv2-burger__icon span:nth-child(3){ top:8px; transform:rotate(-45deg); }

.hv2-offcanvas{ position:fixed; inset:0 0 0 auto; width:min(420px, 92vw); background:#fff; box-shadow:-8px 0 28px rgba(0,0,0,.18); transform:translateX(100%); transition:transform .28s ease; z-index:1400; display:flex; flex-direction:column; }
.hv2-offcanvas.is-open{ transform:translateX(0); }
.hv2-offcanvas__head{ display:flex; align-items:center; justify-content:space-between; padding:12px 16px; border-bottom:1px solid var(--muted); font-weight:700; }
.hv2-offcanvas__close{ background:none; border:0; font-size:28px; line-height:1; padding:2px 6px; cursor:pointer; }

.hv2-offcanvas__backdrop{ position:fixed; inset:0; background:rgba(0,0,0,.38); z-index:1300; opacity:0; transition:opacity .28s ease; }
.hv2-offcanvas__backdrop.is-open{ opacity:1; }
body.hv2-lock{ overflow:hidden; }

.hv2-mobile-search{ display:flex; align-items:center; gap:8px; padding:12px 16px; border-bottom:1px solid var(--muted); }
.hv2-mobile-search input{ flex:1; height:42px; padding:0 12px; border:1px solid var(--muted); border-radius:10px; }
.hv2-mobile-search button{ border:1px solid var(--muted); background:#fff; height:42px; width:42px; border-radius:10px; display:grid; place-items:center; }
.sr-only{ position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0 0 0 0); white-space:nowrap; clip-path:inset(50%); }

.hv2-mobile-actions{ display:flex; align-items:center; gap:10px; padding:8px 16px 12px; border-bottom:1px solid var(--muted); }

/* Menú móvil */
.menu--mobile{ list-style:none; margin:0; padding:0; }
.menu--mobile li{ list-style:none; }

.menu--mobile li.menu-item-has-children > a::after{ display:none !important; content:none !important; }

.menu--mobile > li > a{
  display:block; padding:14px 16px; font-weight:700;
  text-decoration:none; color:#0b3a66; border-bottom:1px solid var(--muted);
}

.menu--mobile li.menu-item-has-children{
  display:grid; grid-template-columns:1fr auto; align-items:center;
}
.menu--mobile li.menu-item-has-children > a{ grid-column:1/2; }
.menu--mobile li.menu-item-has-children > .submenu-toggle{
  grid-column:2/3; margin:0 12px 0 8px; width:36px; height:36px;
  border:1px solid var(--muted); border-radius:10px; background:#fff;
  display:inline-grid; place-items:center;
}
.menu--mobile .submenu-toggle .chev{
  width:10px; height:10px; border-right:2px solid #111; border-bottom:2px solid #111;
  transform:rotate(45deg); transition:transform .2s ease;
}
.menu--mobile li.open > .submenu-toggle .chev{ transform:rotate(-135deg); }

/* Subniveles */
.menu--mobile .sub-menu{ grid-column:1/-1; margin:0; padding:0 0 6px 0; border-bottom:1px solid var(--muted); }
.menu--mobile .sub-menu > li > a{ display:block; padding:12px 16px 12px 28px; text-decoration:none; color:var(--text); }
.menu--mobile .sub-menu .menu-item-has-children{ grid-template-columns:1fr auto; }
.menu--mobile .sub-menu .menu-item-has-children > a{ padding-left:28px; }
.menu--mobile .sub-menu .menu-item-has-children > .submenu-toggle{ margin-right:12px; }
.hv2-mobile-only{ display:none; }
@media (max-width:900px){
  .hv2-nav{ display:none !important; }
  .hv2-burger{ display:inline-flex; }

  .hv2-mobile-only{ display:block; width:100%; }
  .hv2-mobile-searchrow{ padding:8px 0 0; }
  .hv2-mobile-actionsrow{
    display:flex; justify-content:space-between; align-items:center;
    gap:12px; padding:0 0 10px; border-bottom:1px solid var(--muted);
  }
  .hv2-mobile-login{ text-decoration:none; font-weight:700; color:#0b3a66; }
}

@media (max-width:900px){
  .hv2-top{ display:none; }
}

.hv2-login-inline{
  display:none; align-items:center; gap:8px; padding:8px 12px;
  border:1px solid var(--muted); border-radius:12px; background:#fff;
  font-weight:700; color:#0b3a66; text-decoration:none;
}
@media (max-width:900px){
  .hv2-login-inline{ display:inline-flex; }
}

/* Filas móviles del header */
.hv2-mobile-only{ display:none; }
@media (max-width:900px){
  .hv2-nav{ display:none !important; }
  .hv2-burger{ display:inline-flex; }

  .hv2-mobile-only{ display:block; width:100%; }
  .hv2-mobile-searchrow{ padding:8px 0 0; }
  .hv2-mobile-ctarow{
    display:flex; align-items:center; justify-content:space-between;
    gap:10px; padding:8px 0 12px; border-bottom:1px solid var(--muted);
  }
  .hv2-mobile-phone{ color:#111; }
}

.hv2-mobile-search{ display:flex; align-items:center; gap:8px; padding:8px 0 12px; }
.hv2-mobile-search input{
  flex:1; height:42px; padding:0 12px; border:1px solid var(--muted); border-radius:10px;
}
.hv2-mobile-search button{
  border:1px solid var(--muted); background:#fff; height:42px; width:42px; border-radius:10px; display:grid; place-items:center;
}

.sr-only{ position:absolute; width:1px; height:1px; overflow:hidden; clip:rect(0 0 0 0); white-space:nowrap; clip-path:inset(50%); }

/* ====== FIX ALINEADO LOGO | INICIAR SESIÓN | MENÚ (MÓVIL) ====== */
@media (max-width:900px){

  .hv2-brandbar__row{ flex-wrap:nowrap; align-items:center; gap:12px; }

  .hv2-mobile-only.hv2-login-inline{
    display:inline-flex !important;
    width:auto !important;
    white-space:nowrap;
    padding:6px 10px;
    gap:8px;
  }

  .hv2-burger{ margin-left:auto; }


  .hv2-brandbar .container{ overflow:hidden; }
}

/* 
@media (max-width:900px){ .hv2-brandbar__row{ flex-wrap:wrap; } }
*/
/* 
@media (max-width:900px){
  /* */
  .hv2-brandbar__row{
    display:grid !important;
    grid-template-columns: auto 1fr auto;
    align-items:center;
    gap:12px;
  }


  .hv2-brandbar__spacer{ display:none !important; }


  .hv2-logo{ justify-self:start; }
  .hv2-burger{ justify-self:end; margin-left:0 !important; } 

  .hv2-login-inline{
    grid-column:2;                /* columna del centro */
    justify-self:center;          /* céntralo horizontalmente */
    display:inline-flex;          /* conserva icono + texto en línea */
    gap:8px; padding:6px 10px;
    width:auto; white-space:nowrap;
  }

}

@media (min-width:901px){

  .hv2-brandbar__row .dgwt-wcas-search-wrapp,
  .hv2-brandbar__row .dgwt-wcas-search-form,
  .hv2-brandbar__row .dgwt-wcas-sf-wrapp{
    margin:0 !important;
  }
  .hv2-brandbar__row .dgwt-wcas-search-wrapp{ align-self:flex-end; }
  .hv2-brandbar__row{ align-items:flex-end; }                        

  .hv2-nav{ align-self:flex-end; padding-bottom:0; }

  .menu--homev2 > li.is-mega::after{
    content:""; position:absolute; left:0; right:0; top:100%;
    height:80px; 
    pointer-events:auto;
  }
  .hv2-brandbar__row .menu--homev2 > li.is-mega > .sub-menu::before{
    content:""; position:absolute; left:0; right:0; top:-80px; height:80px; pointer-events:auto;
  }

  .hv2-brandbar__row{ position:relative; } 
  .hv2-brandbar__row .menu--homev2 > li.is-mega > .sub-menu{
    top:calc(100% - 1px);  
  }
}
/* Mega siempre por encima de FiboSearch */
.hv2-brandbar__row .menu--homev2 > li.is-mega > .sub-menu{
  z-index: 3000 !important;
}



</style>
<script>
(() => {
  const megaLi = document.querySelector('.menu--homev2 > li.is-mega');
  const panel  = megaLi?.querySelector(':scope > .sub-menu');
  if (!panel) return;

  function measure() {
    const cs   = getComputedStyle(panel);
    const rowH = parseFloat(cs.gridAutoRows) || 8;
    const gap  = parseFloat(cs.rowGap) || 0;
    panel.querySelectorAll(':scope > li').forEach(li => {
      li.style.gridRowEnd = 'auto';
      const h = li.offsetHeight; 
      li.style.gridRowEnd = 'span ' + Math.ceil((h + gap) / (rowH + gap));
    });
  }

  let raf = 0, tid = 0;
  function reflow() {
    cancelAnimationFrame(raf); clearTimeout(tid);
    raf = requestAnimationFrame(() => {
      measure();
      raf = requestAnimationFrame(measure);
      tid = setTimeout(measure, 150);
    });
  }

  megaLi.addEventListener('mouseenter', reflow);
  megaLi.addEventListener('focusin', reflow);

  window.addEventListener('load', reflow);
  window.addEventListener('resize', reflow);

  const ro = new ResizeObserver(reflow);
  ro.observe(panel);
  panel.querySelectorAll(':scope > li').forEach(li => ro.observe(li));

  new MutationObserver(reflow).observe(panel, { childList: true, subtree: true, attributes: true });

  panel.querySelectorAll('img').forEach(img => { if (!img.complete) img.addEventListener('load', reflow, { once: true }); });

  if (document.fonts?.ready) document.fonts.ready.then(reflow);
})();
</script>
<!-- MOVIL -->
 <script>
(() => {
  const burger   = document.querySelector('.hv2-burger');
  const drawer   = document.getElementById('hv2-offcanvas');
  const closeBtn = drawer?.querySelector('.hv2-offcanvas__close');
  const backdrop = document.querySelector('.hv2-offcanvas__backdrop');
  if(!burger || !drawer || !backdrop) return;

  const openDrawer = () => {
    burger.classList.add('is-open');
    burger.setAttribute('aria-expanded','true');
    drawer.hidden = false;
    backdrop.hidden = false;
    requestAnimationFrame(() => {
      drawer.classList.add('is-open');
      backdrop.classList.add('is-open');
      document.body.classList.add('hv2-lock');
    });
  };

  const closeDrawer = () => {
    burger.classList.remove('is-open');
    burger.setAttribute('aria-expanded','false');
    drawer.classList.remove('is-open');
    backdrop.classList.remove('is-open');
    document.body.classList.remove('hv2-lock');
    drawer.addEventListener('transitionend', () => {
      if(!drawer.classList.contains('is-open')) { drawer.hidden = true; backdrop.hidden = true; }
    }, { once:true });
  };

  burger.addEventListener('click', () => (drawer.classList.contains('is-open') ? closeDrawer() : openDrawer()));
  closeBtn?.addEventListener('click', closeDrawer);
  backdrop.addEventListener('click', closeDrawer);
  window.addEventListener('keydown', (e) => { if(e.key === 'Escape' && drawer.classList.contains('is-open')) closeDrawer(); });
 const enhanceAccordions = (root) => {
    const parents = root.querySelectorAll('li.menu-item-has-children');
    let i = 0;
    parents.forEach(li => {
      const link = li.querySelector(':scope > a');
      const sub  = li.querySelector(':scope > .sub-menu');
      if(!link || !sub) return;
      const id = sub.id || ('m-sub-' + (++i));
      sub.id = id;
      sub.hidden = true;

      let btn = li.querySelector(':scope > .submenu-toggle');
      if(!btn){
        btn = document.createElement('button');
        btn.className = 'submenu-toggle';
        btn.type = 'button';
        btn.setAttribute('aria-controls', id);
        btn.setAttribute('aria-expanded', 'false');
        btn.innerHTML = '<span class="chev" aria-hidden="true"></span>';
        link.after(btn);
      }

      const toggle = () => {
        const open = btn.getAttribute('aria-expanded') === 'true';
        btn.setAttribute('aria-expanded', String(!open));
        li.classList.toggle('open', !open);
        sub.hidden = open;
      };

      btn.addEventListener('click', toggle);

      link.addEventListener('click', (e) => {
        const href = link.getAttribute('href');
        if (!href || href === '#'){ e.preventDefault(); toggle(); }
      });
    });
  };
  const mobileNav = document.querySelector('.hv2-mobile-nav');
  if(mobileNav) enhanceAccordions(mobileNav);
})();
</script>
<script>
(() => {
  const row   = document.querySelector('.hv2-brandbar__row');
  const nav   = document.querySelector('.menu--homev2');
  const panel = document.querySelector('.menu--homev2 > li.is-mega > .sub-menu');
  if(!row || !nav || !panel) return;

  function setBridge(){
    const rowRect = row.getBoundingClientRect();
    const navRect = nav.getBoundingClientRect();
    const gap = Math.max(0, Math.round(rowRect.bottom - navRect.bottom));
    // colchón de 10px para que sobre un poco
    panel.style.setProperty('--hover-bridge', (gap + 10) + 'px');
  }

  window.addEventListener('load', setBridge);
  window.addEventListener('resize', setBridge);
  new MutationObserver(setBridge).observe(row, {childList:true, subtree:true, attributes:true});
})();
</script>
<script>
/* Hover-intent para el mega: no se cierra al cruzar el hueco */
(() => {
  const li    = document.querySelector('.menu--homev2 > li.is-mega');
  const panel = li?.querySelector(':scope > .sub-menu');
  if (!li || !panel) return;

  let hideTid = null;

  const open  = () => { clearTimeout(hideTid); li.classList.add('open'); };
  const close = () => { hideTid = setTimeout(() => li.classList.remove('open'), 220); };

  // Abrir al pasar por el li
  li.addEventListener('mouseenter', open);

  // Al salir del li, esperamos un poco (tiempo para llegar al panel)
  li.addEventListener('mouseleave', close);

  // Si entras al panel, cancelamos el cierre
  panel.addEventListener('mouseenter', open);

  // Si sales del panel, sí cerramos con retardo
  panel.addEventListener('mouseleave', close);
})();
</script>
