<?php
  include('track_visited_pages.php');
  trackPageVisit();

  if (isset($_COOKIE['font_style'])) {
    $fontStyle = $_COOKIE['font_style'];
  } else {
    $fontStyle = 'Arial, sans-serif';
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fontStyle = $_POST['font_style'];
    setcookie('font_style', $fontStyle, time() + 3600, '/');
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  }

  $suggestedPages = getVisitedPages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Font Style Selection</title>
  <style>
      body {
          font-family: <?php echo $fontStyle; ?>;
      }
      .container {
          margin-top: 20px;
      }
      .font-select {
          padding: 10px;
          font-size: 16px;
      }
  </style>
</head>
<body>

<h1>Choose your font style</h1>

<form method="POST" class="container">
  <select name="font_style" class="font-select">
    <option value="Arial, sans-serif" <?php echo ($fontStyle == 'Arial, sans-serif') ? 'selected' : ''; ?>>Arial</option>
    <option value="'Courier New', Courier, monospace" <?php echo ($fontStyle == "'Courier New', Courier, monospace") ? 'selected' : ''; ?>>Courier New</option>
    <option value="'Times New Roman', Times, serif" <?php echo ($fontStyle == "'Times New Roman', Times, serif") ? 'selected' : ''; ?>>Times New Roman</option>
    <option value="Georgia, serif" <?php echo ($fontStyle == 'Georgia, serif') ? 'selected' : ''; ?>>Georgia</option>
  </select>

  <button type="submit">Save Font</button>
</form>

<p>Your current font style is: <?php echo $fontStyle; ?></p>

<h2>Suggested Pages Based on Your Previous Visits:</h2>
<ul>
  <?php
    if (!empty($suggestedPages)) {
      foreach ($suggestedPages as $page) {
        echo "<li><a href='$page'>$page</a></li>";
      }
    } else {
      echo "<li>No previous pages visited yet.</li>";
    }
  ?>
</ul>

</body>
</html>
