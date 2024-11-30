<?php
  include('track_visited_pages.php');
  trackPageVisit();

  if (isset($_COOKIE['theme'])) {
    $theme = $_COOKIE['theme'];
  } else {
    $theme = 'light';
  }

  if (isset($_POST['theme'])) {
    setcookie('theme', $_POST['theme'], time() + 3600 * 24 * 30, '/'); // Зберігаємо на 30 днів
    header('Location: ' . $_SERVER['PHP_SELF']); // Перезавантажуємо сторінку
    exit();
  }

  $suggestedPages = getVisitedPages();
?>

<!DOCTYPE html>
<html lang="uk" data-theme="<?php echo $theme; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Вибір кольорової схеми</title>
  <style>
      [data-theme='light'] {
          background-color: #fff;
          color: #000;
      }

      [data-theme='dark'] {
          background-color: #333;
          color: #fff;
      }

      .theme-button {
          margin: 10px;
          padding: 10px;
          cursor: pointer;
          border: none;
          background-color: #ccc;
          font-size: 16px;
      }

      .theme-button:hover {
          background-color: #bbb;
      }
  </style>
</head>
<body class="<?php echo $theme; ?>">

<h1>Theme Selection</h1>
<p>Select the theme you prefer:</p>

<form method="post" action="">
  <button type="submit" name="theme" value="light" class="theme-button">Light Theme</button>
  <button type="submit" name="theme" value="dark" class="theme-button">Dark Theme</button>
</form>

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
