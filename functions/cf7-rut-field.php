<?php
  wpcf7_add_form_tag('rut', 'rut_not_required_handler', true);
  wpcf7_add_form_tag('rut*', 'rut_required_handler', true);

  function rut_not_required_handler($tag) { return rut_handler($tag, false); }
  function rut_required_handler($tag) { return rut_handler($tag, true); }

  function rut_handler($tag, $required) {
    $name = 'rut';
    $id = 'rut';
    $class = 'wpcf7-form-control wpcf7-text';
    $placeholder = '';

    if($required) {
      $class .= ' wpcf7-validates-as-required';
    }

    if (!empty($tag['name']))
      $name = $tag['name'];

    for ($i = 0; $i < count($tag['options']); $i++) {
      $option = explode(':', $tag['options'][$i]);

      if ($option[0] == 'id') {
        $id = $option[1];
      } else if ($option[0] == 'class') {
        $class .= " $option[1]";
      } else if ($option[0] == 'placeholder') {
        $placeholder = $option[1];
      }
    }

    $nameTag = "name=\"$name\"";
    $idTag = "id=\"$id\"";
    $classTag = empty($class) ? '' : "class=\"$class\"";
    $placeholderTag = empty($placeholder) ? '' : "placeholder=\"$placeholder\"";
    $sizeTag = "size=\"40\"";
    $ariaRequiredTag = $required ? "aria-required=\"true\"" : "aria-required=\"false\"";
    $ariaInvalidTag = "aria-invalid=\"false\"";

    return "
      <span class=\"wpcf7-form-control-wrap\" data-name=\"$name\">
        <input type=\"text\" $nameTag $idTag $placeholderTag $classTag $sizeTag $ariaRequiredTag $ariaInvalidTag value=\"\" />
      </span>";
  }

  add_filter('wpcf7_validate_rut', 'wpcf7_validate_rut_not_required_handler', 20, 2);
  add_filter('wpcf7_validate_rut*', 'wpcf7_validate_rut_required_handler', 20, 2);

  function wpcf7_validate_rut_not_required_handler($result, $tag) {
    return wpcf7_validate_rut_handler($result, $tag, false);
  }

  function wpcf7_validate_rut_required_handler($result, $tag) {
    return wpcf7_validate_rut_handler($result, $tag, true);
  }

  function wpcf7_validate_rut_handler($result, $tag, $required) {
    $value = $_POST[$tag->name];

    if ($required && empty($value)) {
      $result->invalidate($tag, 'El campo es obligatorio.');
    } elseif (!empty($value) && !is_valid_rut($value)) {
      $result->invalidate($tag, 'El RUT indicado no es válido.');
    }

    return $result;
  }

  if (!function_exists('is_valid_rut')) {
  function is_valid_rut($rut) {
    $rut = preg_replace('/[^0-9kK]/', '', $rut);
    if (strlen($rut) < 2) return false;

    $body = substr($rut, 0, -1);
    $dv = strtoupper(substr($rut, -1));

    $suma = 0;
    $multiplo = 2;

    for ($i = strlen($body) - 1; $i >= 0; $i--) {
      $suma += intval($body[$i]) * $multiplo;
      $multiplo = ($multiplo == 7) ? 2 : $multiplo + 1;
    }

    $resto = $suma % 11;
    $dvEsperado = 11 - $resto;
    $dvEsperado = ($dvEsperado == 11) ? '0' : (($dvEsperado == 10) ? 'K' : (string)$dvEsperado);

    return $dv === $dvEsperado;
  }
}

  add_action('wp_footer', function () {
    echo '<script>
    document.addEventListener("DOMContentLoaded", function () {
      const rutInput = document.getElementById("rut");
      if (!rutInput) return;

      rutInput.addEventListener("input", function () {
        let clean = rutInput.value.replace(/[^0-9kK]/g, "").toUpperCase();
        if (clean.length <= 1) {
          rutInput.value = clean;
          return;
        }

        let body = clean.slice(0, -1);
        let dv = clean.slice(-1);
        body = body.replace(/\./g, "");

        let formatted = "";
        while (body.length > 3) {
          formatted = "." + body.slice(-3) + formatted;
          body = body.slice(0, -3);
        }
        formatted = body + formatted;

        rutInput.value = `${formatted}-${dv}`;
      });
    });
    </script>';
  });

  add_action('wp_footer', function () {
    ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rutInput = document.querySelector('#rut');

    if (!rutInput) return;

    rutInput.addEventListener('input', function() {
        let val = rutInput.value.replace(/[^0-9kK]/g, '').toUpperCase();

        if (val.length <= 1) {
            rutInput.value = val;
            return;
        }

        let cuerpo = val.slice(0, -1);
        let dv = val.slice(-1);

        cuerpo = cuerpo.replace(/\./g, '');

        let formatted = '';
        while (cuerpo.length > 3) {
            formatted = '.' + cuerpo.slice(-3) + formatted;
            cuerpo = cuerpo.slice(0, -3);
        }
        formatted = cuerpo + formatted;

        rutInput.value = `${formatted}-${dv}`;
    });
});
</script>
<?php
});