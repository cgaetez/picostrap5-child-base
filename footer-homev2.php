<?php
/**
 * Footer A/B test Home v2
 * Ubícalo como footer-homev2.php y llama get_footer('homev2')
 */
?>
<footer class="homev2-footer" role="contentinfo" aria-label="Pie de página">
  <style>
    .homev2-footer{background:#0b3a63;color:#e8f1fa;position:relative;}
    .homev2-footer a{color:#e8f1fa;text-decoration:none;}
    .homev2-footer a:hover{opacity:.9;text-decoration:underline;}

    .hv2f-container{max-width:1200px;margin:0 auto;padding:28px 16px 18px;box-sizing:border-box;}

    .hv2f-grid{
      display:grid;
      grid-template-columns:1fr;
      gap:24px;
      align-items:start;
    }

    .hv2f-brand{display:flex;flex-direction:column;gap:18px;}
    .hv2f-logos{display:flex;flex-direction:column;gap:14px;}
    .hv2f-logos img{display:block;max-width:160px;height:auto;}
    .hv2f-ecu{margin-top:6px;}
    .hv2f-ecu small{display:block;color:#F1C40F;opacity:.9;margin-bottom:8px;font-weight:600; font-size: 18px}

    .hv2f-group h3{
      margin:0 0 10px;
      font-size:16px;
      line-height:1.2;
      color:#F1C40F;
    }
    .hv2f-list{list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:6px;}
    .hv2f-list li a{display:inline-block}

    .hv2f-aside{display:flex;flex-direction:column;gap:14px;}
    .hv2f-qr{
      width:150px; 
      background:#0a3358;border-radius:12px;padding:10px;text-align:center;border:1px solid rgba(255,255,255,.08);
    }
    .hv2f-qr img{width:100%;height:auto;display:block;border-radius:8px;}
    .hv2f-qr small{display:block;margin-top:6px;font-size:11px;color:#cfe6ff;}

    .hv2f-credit{
      width:190px;
      background:#F1C40F; 
      color:#093866;
      border-radius:12px;
      box-shadow:0 8px 18px rgba(0,0,0,.25);
      padding:10px 12px;
      border:2px solid rgba(0,0,0,.07);
      text-align: center; 
    }
    .hv2f-credit p{margin:0 0 8px;font-size:12px;line-height:1.25;font-weight:700; color: #093866; }
    .hv2f-credit p span{display:block;font-weight:500;}
    .hv2f-credit .btn{
      display:inline-block;
      font-size:12px;
      line-height:1;
      padding:10px 12px;
      background:#0b3a63;
      color:#fff;
      border-radius:8px;
      font-weight:700;
      text-decoration:none;
    }
    .hv2f-credit .btn:hover{opacity:.95;text-decoration:none}

    .hv2f-bottom{border-top:1px solid rgba(255,255,255,.12);margin-top:22px;padding-top:12px;}
    .hv2f-copy{text-align:center;font-size:12px;color:#cfe6ff;}

    /* ====== Desktop ====== */
    @media (min-width: 992px){
      .hv2f-grid{
        grid-template-columns:1.3fr 1fr 1fr 1fr auto;
        column-gap:40px;
      }
      .hv2f-logos img{max-width:170px}
      .hv2f-qr{width:156px}
      .hv2f-credit{width:220px}
    }

    @media (max-width: 991.98px){
      .hv2f-aside{
        align-items:flex-start;
      }
      .hv2f-credit{margin-left:auto;}
    }

  </style>

  <div class="hv2f-container">
    <div class="hv2f-grid">

      <!-- Columna: logos -->
      <section class="hv2f-brand" aria-label="Marcas">
        <div class="hv2f-logos">
            <a href="https://acenorchile.com/">
          <img
            src="https://acenorchile.com/wp-content/uploads/2025/10/9f15cf41c0797b2126d025f1f4ef94b053678384.png"
            alt="Acenor"
            width="170" height="48"
            loading="lazy"></a>
            <a href="http://prorep.cl/">
          <img
            src="https://acenorchile.com/wp-content/uploads/2025/10/64548af2a3438d5df3b4e81cc6225f01a6c12729.png"
            alt="PROREP"
            width="120" height="36"
            loading="lazy"></a>
        </div>

        <div class="hv2f-ecu">
          <small>Tienda en Ecuador</small>
          <a href="https://dipacmanta.com/">
          <img
            src="https://acenorchile.com/wp-content/uploads/2025/10/09964cf1de2cf7db532ddc3fff538e192a7b27c3.png"
            alt="DIPAC"
            width="130" height="38"
            loading="lazy"></a>
        </div>
      </section>

      <!-- Columna: Categorías -->
      <nav class="hv2f-group" aria-label="Categorías">
        <h3>Categorías</h3>
<ul class="hv2f-list">
  <li><a href="https://acenorchile.com/categoria-producto/perfiles-de-acero/">Perfiles de acero</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/estructuras-metalicas/">Fierros metálicos estructurales</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/perfiles-laminados/">Perfiles laminados</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/sistemas-de-techado-y-cerramientos/hojalateria/">Hojalatería</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/parrillas-metalicas/">Parrillas de metal</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/vigas/">Vigas tipo H y tipo I</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/canerias/">Cañerías</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/mallas-y-accesorios/">Mallas y Accesorios</a></li>
  <li><a href="https://acenorchile.com/categoria-producto/accesorios-de-construccion/">Accesorios de construcción</a></li>
</ul>

      </nav>

      <!-- Columna: Contáctanos -->
      <nav class="hv2f-group" aria-label="Contáctanos">
        <h3>Contáctanos</h3>
<ul class="hv2f-list">
  <li><a href="https://acenorchile.com/sucursales">Encuentra tu sucursal</a></li>
  <li><a href="tel:+56229259200">+562 2925 9200</a></li>
  <li><a href="https://wa.me/56954001195" target="_blank" rel="noopener">Whatsapp</a></li>
  <li><a href="mailto:ventas@acenorchile.com">ventas@acenorchile.com</a></li>
  <li><a href="https://www.facebook.com/acenorchile" target="_blank" rel="noopener">Facebook</a></li>
  <li><a href="https://www.instagram.com/acenorchile/" target="_blank" rel="noopener">Instagram</a></li>
</ul>

      </nav>

      <!-- Columna: Nosotros -->
      <nav class="hv2f-group" aria-label="Nosotros">
        <h3>Nosotros</h3>
<ul class="hv2f-list">
  <li><a href="https://acenorchile.com/nuestra-empresa">Nuestra Empresa</a></li>
  <li><a href="https://acenorchile.com/blog">Blog</a></li>
  <li><a href="https://app.genoma.work/jobs/acenor">Trabaja con nosotros</a></li>
  <li><a href="https://acenorchile.com/cambios-y-devoluciones">Cambios y devoluciones</a></li>
  <li><a href="https://acenorchile.com/contacto">Contacto</a></li>
  <li><a href="https://acenorchile.com/politica-de-privacidad-datos-personales/">Políticas de privacidad</a></li>
  <li><a href="https://acenor.buk.cl/cul_partner_complaint/tickets/new">Denuncias</a></li>
</ul>

      </nav>

      <!-- Columna: Tarjetas (QR + crédito) -->
      <aside class="hv2f-aside" aria-label="Accesos rápidos">
       <div class="hv2f-qr">
  <a href="https://acenorchile.com/qr/">
    <img
      src="https://acenorchile.com/wp-content/uploads/2025/10/a8357654c256a289006ab4d5fc5db1d922dda78e.png"
      alt="Catálogo Acenor (QR)">
  </a>
</div>


        <!--<a class="hv2f-credit" href="#" aria-label="Conozca cómo obtener su crédito con Acenor">-->
        <!--  <p>¿Necesita financiamiento <span>para su proyecto?</span></p>-->
        <!--  <p><span>Conozca cómo obtener</span> su crédito con Acenor</p>-->
        <!--  <span class="btn">Haga click aquí</span>-->
        <!--</a>-->
      </aside>

    </div>

    <div class="hv2f-bottom">
      <div class="hv2f-copy">&copy; <?php echo date('Y'); ?> Acenor&reg; Chile. Todos los derechos reservados</div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

