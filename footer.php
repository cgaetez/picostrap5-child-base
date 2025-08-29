  </main>
  
<div class="modal fade" tabindex="-1" id="alerta">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header justify-content-center">
        <h5 class="modal-title product_title entry-title text-primary">Información Importante!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <img src="https://acenorchile.com/wp-content/uploads/2024/09/¡ATENCION-PUERTO-MONTT.jpg" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cerrar" style="    background-color: #ecbd16;
    color: #132b51;">Cerrar</button>

		</div>
    </div>
  </div>
</div> 

  <?php if (function_exists("lc_custom_footer")) : ?>
    <?php lc_custom_footer(); ?>
  <?php else : ?>
    <?php get_template_part("partials/footer/footer-full"); ?>

    <?php get_template_part("partials/footer/site-info"); ?>
  <?php endif ?>

  <?php wp_footer(); ?>
  <!--
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>



  <script>
  jQuery(document).ready(function(){
	
       /* let alerta = new bootstrap.Modal(document.getElementById('alerta'), {});
       alerta.toggle();
	       jQuery("#cerrar").click(function(){
         jQuery("#alerta").modal('hide');

      })*/
		 
      jQuery("#scss-compiler-output").remove();
      jQuery('.mega-toggle-blocks-center')
        .append('<h2 class="text-white mt-1">Menú</h2>');

      jQuery('#menu-sidebar .menu-item')
        .filter(':not(.current-menu-item):not(.current-menu-ancestor)')
        .find('a,.sub-menu')
        .addClass('closed');

      jQuery('#menu-sidebar li.menu-item-has-children > a').click(function(e) {
        e.preventDefault();

        const link = jQuery(this);
        const subMenu = link.siblings();

        if (subMenu.hasClass('closed')) {
          link.removeClass('closed');
          subMenu.removeClass('closed');
        } else {
          link.addClass('closed');
          subMenu.addClass('closed');
        }
      })
      
      /*var myModal = new bootstrap.Modal(document.getElementById('modal-sucursal'), {});
      if(myModal){
        myModal.toggle();
      }*/
		
	  
      
    });
	  
	  
 </script>
  

 <style>
  #menu-sidebar .menu-item-has-children > .sub-menu.closed {
    display: none;
  }

  #menu-sidebar .menu-item > a {
    position: relative;
    padding-left: 15px;
  }

  #menu-sidebar .menu-item-has-children > a.closed::before {
    content: '+';
    position: absolute;
    left: 3px;
  }

  #menu-sidebar .menu-item-has-children > a:not(.closed)::before {
    content: '-';
    position: absolute;
    left: 3px;
  }

 </style>
</body>
</html>
