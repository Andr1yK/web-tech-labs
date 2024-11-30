<?php
  function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
  }

  function validate_phone($phone) {
    return preg_match('/^\+?\d{1,3}[-\s]?\(?\d{2,4}\)?[-\s]?\d{2,4}[-\s]?\d{2,4}$/', $phone);
  }

  function validate_grade($grade) {
    return is_numeric($grade) && $grade >= 0 && $grade <= 10;
  }

  $animal_type = '';
  $is_student = false;
  $favorite_color = [];
  $subjects = [];
  $errors = [];
  $submitted_data = null;

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $animal_type = $_POST['animal_type'] ?? '';
    $is_student = isset($_POST['is_student']) ? true : false;
    $favorite_color = $_POST['favorite_color'] ?? [];
    $subjects = $_POST['subjects'] ?? [];
    $comments = trim($_POST['comments']);
    $password = trim($_POST['password']);
    $store_name = trim($_POST['store_name']);
    $phone_model = trim($_POST['phone_model']);
    $book_title = trim($_POST['book_title']);
    $student_grade = $_POST['student_grade'] ?? '';

    if (empty($name)) {
      $errors[] = "Name is required.";
    }

    if (!validate_email($email)) {
      $errors[] = "Invalid email address.";
    }

    if (!validate_phone($phone)) {
      $errors[] = "Invalid phone number.";
    }

    if (empty($animal_type)) {
      $errors[] = "Please select an animal type.";
    }

    if (empty($favorite_color)) {
      $errors[] = "Please select your favorite color.";
    }

    if (empty($subjects)) {
      $errors[] = "Please select at least one subject.";
    }

    if (!validate_grade($student_grade)) {
      $errors[] = "Please enter a valid grade (between 0 and 10).";
    }

    if (empty($password)) {
      $errors[] = "Password is required.";
    }

    if (empty($errors)) {
      $submitted_data = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'animal_type' => $animal_type,
        'is_student' => $is_student ? 'Yes' : 'No',
        'favorite_color' => implode(', ', $favorite_color),
        'subjects' => implode(', ', $subjects),
        'comments' => $comments,
        'password' => $password,
        'store_name' => $store_name,
        'phone_model' => $phone_model,
        'book_title' => $book_title,
        'student_grade' => $student_grade
      ];
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Input Form</title>
</head>
<body>
<h1>Data Entry Form</h1>

<?php if (!empty($errors)): ?>
  <div style="color: red;">
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?php echo htmlspecialchars($error); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<?php if ($submitted_data): ?>
  <h2>Submitted Data:</h2>
  <p>Name: <?php echo htmlspecialchars($submitted_data['name']); ?></p>
  <p>Email: <?php echo htmlspecialchars($submitted_data['email']); ?></p>
  <p>Phone: <?php echo htmlspecialchars($submitted_data['phone']); ?></p>
  <p>Animal Type: <?php echo htmlspecialchars($submitted_data['animal_type']); ?></p>
  <p>Is Student: <?php echo htmlspecialchars($submitted_data['is_student']); ?></p>
  <p>Favorite Color: <?php echo htmlspecialchars($submitted_data['favorite_color']); ?></p>
  <p>Subjects: <?php echo htmlspecialchars($submitted_data['subjects']); ?></p>
  <p>Comments: <?php echo nl2br(htmlspecialchars($submitted_data['comments'])); ?></p>
  <p>Password: <?php echo str_repeat('*', strlen($submitted_data['password'])); ?></p>
  <p>Store Name: <?php echo htmlspecialchars($submitted_data['store_name']); ?></p>
  <p>Phone Model: <?php echo htmlspecialchars($submitted_data['phone_model']); ?></p>
  <p>Book Title: <?php echo htmlspecialchars($submitted_data['book_title']); ?></p>
  <p>Grade: <?php echo htmlspecialchars($submitted_data['student_grade']); ?></p>
<?php else: ?>
  <form method="POST" action="">
    <!-- Name -->
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>" required><br><br>

    <!-- Email -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required><br><br>

    <!-- Phone -->
    <label for="phone">Phone Number:</label>
    <input type="tel" id="phone" name="phone" value="<?php echo htmlspecialchars($phone ?? ''); ?>" required><br><br>

    <!-- Animal Type (Dropdown) -->
    <label for="animal_type">Animal Type:</label>
    <select id="animal_type" name="animal_type" required>
      <option value="">Select an animal</option>
      <option value="dog" <?php echo ($animal_type == 'dog' ? 'selected' : ''); ?>>Dog</option>
      <option value="cat" <?php echo ($animal_type == 'cat' ? 'selected' : ''); ?>>Cat</option>
      <option value="bird" <?php echo ($animal_type == 'bird' ? 'selected' : ''); ?>>Bird</option>
      <option value="fish" <?php echo ($animal_type == 'fish' ? 'selected' : ''); ?>>Fish</option>
    </select><br><br>

    <!-- Student (Radio buttons) -->
    <label for="is_student">Are you a student?</label>
    <input type="radio" id="is_student_yes" name="is_student" value="yes" <?php echo ($is_student ? 'checked' : ''); ?>> Yes
    <input type="radio" id="is_student_no" name="is_student" value="no" <?php echo (!$is_student ? 'checked' : ''); ?>> No<br><br>

    <!-- Favorite Color (Checkbox) -->
    <label for="favorite_color">Favorite Color:</label>
    <input type="checkbox" id="favorite_color_red" name="favorite_color[]" value="Red" <?php echo (in_array('Red', (array)$favorite_color) ? 'checked' : ''); ?>> Red
    <input type="checkbox" id="favorite_color_blue" name="favorite_color[]" value="Blue" <?php echo (in_array('Blue', (array)$favorite_color) ? 'checked' : ''); ?>> Blue
    <input type="checkbox" id="favorite_color_green" name="favorite_color[]" value="Green" <?php echo (in_array('Green', (array)$favorite_color) ? 'checked' : ''); ?>> Green<br><br>

    <!-- Subjects (Multiple Select) -->
    <label for="subjects">Subjects:</label>
    <select id="subjects" name="subjects[]" multiple required>
      <option value="Math" <?php echo (in_array('Math', $subjects) ? 'selected' : ''); ?>>Math</option>
      <option value="Science" <?php echo (in_array('Science', $subjects) ? 'selected' : ''); ?>>Science</option>
      <option value="History" <?php echo (in_array('History', $subjects) ? 'selected' : ''); ?>>History</option>
      <option value="Literature" <?php echo (in_array('Literature', $subjects) ? 'selected' : ''); ?>>Literature</option>
    </select><br><br>

    <!-- Comments (Multiline) -->
    <label for="comments">Comments:</label><br>
    <textarea id="comments" name="comments"><?php echo htmlspecialchars($comments ?? ''); ?></textarea><br><br>

    <!-- Password -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <!-- Store Name -->
    <label for="store_name">Store Name:</label>
    <input type="text" id="store_name" name="store_name" value="<?php echo htmlspecialchars($store_name ?? ''); ?>"><br><br>

    <!-- Phone Model -->
    <label for="phone_model">Phone Model:</label>
    <input type="text" id="phone_model" name="phone_model" value="<?php echo htmlspecialchars($phone_model ?? ''); ?>"><br><br>

    <!-- Book Title -->
    <label for="book_title">Book Title:</label>
    <input type="text" id="book_title" name="book_title" value="<?php echo htmlspecialchars($book_title ?? ''); ?>"><br><br>

    <!-- Student Grade -->
    <label for="student_grade">Student Grade (0-10):</label>
    <input type="number" id="student_grade" name="student_grade" value="<?php echo htmlspecialchars($student_grade ?? ''); ?>" min="0" max="10" required><br><br>

    <button type="submit">Submit</button>
  </form>
<?php endif; ?>

</body>
</html>
