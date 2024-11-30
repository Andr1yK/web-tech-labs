<?php
  include('track_visited_pages.php');
  trackPageVisit();

  $suggestedPages = getVisitedPages();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Font Settings</title>
</head>
<body>

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
