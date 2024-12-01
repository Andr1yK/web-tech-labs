<?php
  function count_comma_dash_pairs($sequence) {
    $count = 0;
    $length = strlen($sequence);

    for ($i = 0; $i < $length - 1; $i++) {
      if ($sequence[$i] == ',' && $sequence[$i + 1] == '-') {
        $count++;
      }
    }

    return $count;
  }

  $sequence = "a,b,c,-d,e,f,-g,h,i,-";
  $count = count_comma_dash_pairs($sequence);

  echo "Count of comma-dash pairs in the sequence: $count\n";
?>
