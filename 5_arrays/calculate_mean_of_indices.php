<?php

  function calculate_mean_of_indices($arr) {
    if (empty($arr)) {
      return null;
    }

    $min_value = $arr[0];
    $max_value = $arr[0];
    $min_index = 1;
    $max_index = 1;

    for ($i = 1; $i < count($arr); $i++) {
      if ($arr[$i] < $min_value) {
        $min_value = $arr[$i];
        $min_index = $i + 1;  // 1-based indexing
      }
      if ($arr[$i] > $max_value) {
        $max_value = $arr[$i];
        $max_index = $i + 1;  // 1-based indexing
      }
    }

    $mean_index = ($min_index + $max_index) / 2;

    return $mean_index;
  }

  $A = [1, 2, 3, 4, 5, 6, 0, 7, 8, 9];

  $mean_index = calculate_mean_of_indices($A);
  echo "The arithmetic mean of the indices of the min and max elements is: $mean_index\n";
?>
