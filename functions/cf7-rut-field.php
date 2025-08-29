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
