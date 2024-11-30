<?php
  $pattern = '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/';

  $test_values = [
    '#FFFFFF',  // valid
    '#FF3421',  // valid
    '#00ff00',  // valid
    '232323',    // invalid (missing #)
    'f#fddee',   // invalid (wrong format)
    '#fd2',      // invalid (not 3 or 6 characters after #)
  ];

  foreach ($test_values as $value) {
    if (preg_match($pattern, $value)) {
      echo "$value is a valid hex color code.\n\n";
    } else {
      echo "$value is NOT a valid hex color code.\n\n";
    }
  }
?>
