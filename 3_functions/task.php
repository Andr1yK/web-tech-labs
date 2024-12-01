<?php
  function z($x) {
    if (abs($x) >= 1) {
      return (sin($x) + 1) / (cos($x) ** 2 + exp($x));
    }

    else {
      $sum = 0;

      for ($k = 0; $k <= 6; $k++) {
        $sum += (pow(2, $k) * pow($x, $k)) / factorial($k);
      }

      return (1 / exp(pow($x, 2))) * $sum;
    }
  }

  function factorial($n) {
    if ($n == 0) {
      return 1;
    }
    $result = 1;
    for ($i = 1; $i <= $n; $i++) {
      $result *= $i;
    }
    return $result;
  }

  function calculate($p) {
    $term1 = z(pow($p, 2) + 1);  // z(p^2 + 1)
    $term2 = z(pow($p, 2) - 1);  // z(p^2 - 1)
    $term3 = 2 * z($p);          // 2z(p)

    return $term1 - $term2 + $term3;
  }

  $p = 0.5;
  $result = calculate($p);
  echo "Result: $result\n";
?>
