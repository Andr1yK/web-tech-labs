<?php

  function find_penultimate_dot($sequence, $r) {
    if ($r <= 1 || $r > strlen($sequence)) {
      return "Invalid value of r.";
    }

    $dot_positions = [];

    for ($i = 0; $i < $r; $i++) {
      if ($sequence[$i] == '.') {
        $dot_positions[] = $i;
      }
    }

    if (count($dot_positions) >= 2) {
      return $dot_positions[count($dot_positions) - 2] + 1;
    } else {
      return "There are less than 2 dots before the character at position r.";
    }
  }

  $sequence = "Hello.world.this.is.a.test.";
  $r = 12;

  $penultimate_dot = find_penultimate_dot($sequence, $r);
  echo "Number of the penultimate dot before the character sr: $penultimate_dot\n";
?>
