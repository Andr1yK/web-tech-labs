<?php
  function sum_of_min_elements($matrix) {
    $sum = 0;

    foreach ($matrix as $row) {
      $min_value = min($row);

      $sum += $min_value;
    }

    return $sum;
  }

  $matrix = [
    [1, 2, 3, 4],
    [5, 6, 7, 8],
    [9, 1, 3, 4],
    [4, 2, 5, 6]
  ];

  $sum = sum_of_min_elements($matrix);
  echo "Sum of the minimum elements in each row of the matrix: $sum\n";
?>
