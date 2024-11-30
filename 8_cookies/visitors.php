<?php
  include('track_visited_pages.php');
  trackPageVisit();

  $visitorFile = 'visitors_count';

  if (!file_exists($visitorFile)) {
    file_put_contents($visitorFile, json_encode([]));
  }

  $visitors = json_decode(file_get_contents($visitorFile), true);

  if (!isset($_COOKIE['visitor_id'])) {
    $visitorId = uniqid('visitor_', true);

    setcookie('visitor_id', $visitorId, time() + 3600 * 24 * 30, '/');

    if (!in_array($visitorId, $visitors)) {
      $visitors[] = $visitorId;
    }

    file_put_contents($visitorFile, json_encode($visitors));
  } else {
    $visitorId = $_COOKIE['visitor_id'];
  }

  $uniqueVisitorsCount = count($visitors);
  $suggestedPages = getVisitedPages();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Підрахунок відвідувачів</title>
  <style>
      body {
          font-family: Arial, sans-serif;
          margin: 20px;
          padding: 20px;
      }
      h1 {
          color: #333;
      }
      p {
          font-size: 18px;
      }
  </style>
</head>
<body>

<p>User ID: <?php echo isset($visitorId) ? $visitorId : 'Невизначено'; ?></p>

<p>Unique visitors count: <?php echo $uniqueVisitorsCount; ?></p>

</body>
</html>
