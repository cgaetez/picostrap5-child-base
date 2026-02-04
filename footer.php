  </main>



  <?php if (function_exists("lc_custom_footer")) : ?>
  <?php lc_custom_footer(); ?>
  <?php else : ?>
  <?php get_template_part("partials/footer/footer-full"); ?>

  <?php get_template_part("partials/footer/site-info"); ?>
  <?php endif ?>

  <?php wp_footer(); ?>



  <script>
jQuery(document).ready(function() {



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




});
  </script>


  <style>
#menu-sidebar .menu-item-has-children>.sub-menu.closed {
    display: none;
}

#menu-sidebar .menu-item>a {
    position: relative;
    padding-left: 15px;
}

#menu-sidebar .menu-item-has-children>a.closed::before {
    content: '+';
    position: absolute;
    left: 3px;
}

#menu-sidebar .menu-item-has-children>a:not(.closed)::before {
    content: '-';
    position: absolute;
    left: 3px;
}
  </style>
  </body>

  </html>