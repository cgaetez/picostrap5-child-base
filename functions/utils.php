<?php
  function is_valid_rut($rut) {
    if (!preg_match('/^[1-9]\d{0,2}((\.\d{3})*|(\d{3})*)-?[\dkK]$/', $rut))
      return false;

    $reverseRut = strrev(strtoupper(str_replace('-', '', str_replace('.', '', $rut))));

    $dv = $reverseRut[0];
    $reverseNumber = substr($reverseRut, 1);

    $sum = 0;
    $multiplier = 2;

    foreach(str_split($reverseNumber) as $number) {
      if ($multiplier == 8) {
        $multiplier = 2;
      }

      $sum += $multiplier * $number;

      $multiplier++;
    }

    $calculatedDv = 11 -($sum % 11);

    switch ($calculatedDv) {
      case 10: return 'K' == $dv;
      case 11: return 0 == $dv;
      default: return $calculatedDv == $dv;
    }
  }
