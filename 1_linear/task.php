<?php
  function calculate_z1($alpha) {
    return (sin(2 * $alpha) + sin(5 * $alpha) - sin(3 * $alpha)) / (cos($alpha) + 1 - 2 * pow(sin(2 * $alpha), 2));
  }

  function calculate_z2($alpha) {
    return 2 * sin($alpha);
  }

  $alpha = pi() / 4;

  $z1 = calculate_z1($alpha);
  $z2 = calculate_z2($alpha);

  echo "z1: " . $z1 . "\n";
  echo "z2: " . $z2 . "\n\n";

  if (abs($z1 - $z2) < 1e-6) {
    echo "Results match.\n";
  } else {
    echo "Results do not match.\n";
  }
?>
