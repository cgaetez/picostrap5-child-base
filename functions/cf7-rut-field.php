<?php
  // 1. Registrar los tags personalizados
add_action('wpcf7_init', function () {
  wpcf7_add_form_tag('rut', 'rut_not_required_handler', true);
  wpcf7_add_form_tag('rut*', 'rut_required_handler', true);
});

// 2. Render del campo RUT (obligatorio o no)
function rut_not_required_handler($tag) {
  return rut_handler($tag, false);
}

function rut_required_handler($tag) {
  return rut_handler($tag, true);
}

function rut_handler($tag, $required) {
  $name = $tag['name'];
  $value = isset($_POST[$name]) ? esc_attr($_POST[$name]) : '';
  $id = 'rut';
  $class = 'wpcf7-form-control wpcf7-text';
  $placeholder = '';

  if ($required) {
    $class .= ' wpcf7-validates-as-required';
  }

  foreach ($tag['options'] as $option) {
    $parts = explode(':', $option, 2);
    if ($parts[0] === 'id') {
      $id = esc_attr($parts[1]);
    } elseif ($parts[0] === 'class') {
      $class .= ' ' . esc_attr($parts[1]);
    } elseif ($parts[0] === 'placeholder') {
      $placeholder = esc_attr($parts[1]);
    }
  }

  return sprintf(
    '<span class="wpcf7-form-control-wrap" data-name="%s">
      <input type="text" name="%s" id="%s" value="%s" class="%s" placeholder="%s" size="40" aria-required="%s" aria-invalid="false" />
    </span>',
    esc_attr($name),
    esc_attr($name),
    esc_attr($id),
    $value,
    esc_attr($class),
    $placeholder,
    $required ? 'true' : 'false'
  );
}

// 3. Validación del campo RUT
add_filter('wpcf7_validate_rut', 'wpcf7_validate_rut_not_required_handler', 20, 2);
add_filter('wpcf7_validate_rut*', 'wpcf7_validate_rut_required_handler', 20, 2);

function wpcf7_validate_rut_not_required_handler($result, $tag) {
  return wpcf7_validate_rut_handler($result, $tag, false);
}

function wpcf7_validate_rut_required_handler($result, $tag) {
  return wpcf7_validate_rut_handler($result, $tag, true);
}

function wpcf7_validate_rut_handler($result, $tag, $required) {
  $name = $tag->name;
  $value = isset($_POST[$name]) ? $_POST[$name] : '';

  if ($required && empty($value)) {
    $result->invalidate($tag, 'El campo es obligatorio.');
  } elseif (!empty($value) && !is_valid_rut($value)) {
    $result->invalidate($tag, 'El RUT ingresado no es válido.');
  }

  return $result;
}

// 4. Validador de RUT chileno (Módulo 11)
function is_valid_rut($rut) {
  $rut = preg_replace('/[^0-9kK]/', '', $rut);
  if (strlen($rut) < 2) return false;

  $body = substr($rut, 0, -1);
  $dv = strtoupper(substr($rut, -1));
  $suma = 0;
  $multiplo = 2;

  for ($i = strlen($body) - 1; $i >= 0; $i--) {
    $suma += intval($body[$i]) * $multiplo;
    $multiplo = $multiplo < 7 ? $multiplo + 1 : 2;
  }

  $resto = $suma % 11;
  $dvEsperado = 11 - $resto;
  $dvEsperado = $dvEsperado == 11 ? '0' : ($dvEsperado == 10 ? 'K' : (string)$dvEsperado);

  return $dv === $dvEsperado;
}