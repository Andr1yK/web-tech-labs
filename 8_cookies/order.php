<?php
  include('track_visited_pages.php');
  trackPageVisit();

  if (isset($_COOKIE['layout'])) {
    $layout = json_decode($_COOKIE['layout'], true);
  } else {
    $layout = ['block1', 'block2', 'block3', 'block4'];
  }

  if (isset($_POST['layout'])) {
    setcookie('layout', $_POST['layout'], time() + 3600, '/');
//    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
  }

  $suggestedPages = getVisitedPages();
?>

<!DOCTYPE html>
<html lang="uk">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change block order</title>
  <style>
      .container {
          display: flex;
          flex-direction: column;
          gap: 10px;
      }

      .draggable {
          padding: 10px;
          background-color: lightgray;
          border: 1px solid #ccc;
          cursor: pointer;
          user-select: none;
      }

      .draggable:hover {
          background-color: #ddd;
      }
  </style>
</head>
<body>

<div class="container" id="container">
  <?php
    foreach ($layout as $blockId) {
      echo "<div class='draggable' id='$blockId' draggable='true'>$blockId</div>";
    }
  ?>
</div>

<button onclick="saveLayout()">Save layout</button>

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

<script>
  let draggedBlock = null;

  const blocks = document.querySelectorAll('.draggable');
  blocks.forEach(block => {
    block.addEventListener('dragstart', function(e) {
      draggedBlock = block;
      setTimeout(function() {
        block.style.display = 'none';
      }, 0);
    });

    block.addEventListener('dragend', function() {
      setTimeout(function() {
        draggedBlock.style.display = 'block';
        draggedBlock = null;
      }, 0);
    });
  });

  const container = document.getElementById('container');
  container.addEventListener('dragover', function(e) {
    e.preventDefault();
  });

  container.addEventListener('dragenter', function(e) {
    e.preventDefault();
  });

  container.addEventListener('drop', function(e) {
    e.preventDefault();

    if (draggedBlock) {
      const allBlocks = [...container.children];
      const draggedIndex = allBlocks.indexOf(draggedBlock);
      const targetIndex = allBlocks.indexOf(e.target);

      if (draggedIndex < targetIndex) {
        container.insertBefore(draggedBlock, e.target.nextSibling);
      } else {
        container.insertBefore(draggedBlock, e.target);
      }
    }
  });

  function saveLayout() {
    const blockIds = Array.from(container.children).map(block => block.id);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onload = function() {
      if (xhr.status == 200) {
        alert("Layout saved successfully");
      }
    };
    xhr.send("layout=" + JSON.stringify(blockIds)); // Відправляємо нове розташування
  }
</script>

</body>
</html>
