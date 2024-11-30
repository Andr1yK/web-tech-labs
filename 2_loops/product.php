<?php

  function calculateProduct() {
    $product = 1;

    for ($j = 1; $j <= 3; $j++) {
      $sum_of_squares = 0;

      for ($i = $j; $i <= $j * $j; $i++) {
        $sum_of_squares += pow($i, 2);
      }

      $sqrt_of_sum = sqrt($sum_of_squares);

      $product *= $sqrt_of_sum;
    }

    return $product;
  }

  $result = calculateProduct();
  echo "Result of the product: $result\n";
?>
